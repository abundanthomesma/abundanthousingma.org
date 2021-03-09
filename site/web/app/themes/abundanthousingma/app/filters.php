<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "Learn more" button to the excerpt
 */
add_filter('excerpt_more', function () {
    return '…<div class="wp-block-buttons"><div class="wp-block-button"><a class="wp-block-button__link" href="' . get_permalink() . '">' . __('Learn more', 'sage') . '</a></div></div>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

/**
 * Add or update a WordPress user with their Stripe Customer ID
 */
add_action('gform_stripe_customer_after_create', function ($customer, $feed, $entry, $form) {
    // README: Loop over all the fields of the form, and collect the field IDs
    //          of the entry values we want.
    foreach ($form['fields'] as $field) {
        if ($field->type == 'name') {
            // README: The Gravity Forms docs show in multiple places that
            //          the decimal values here are hard-coded, so we'll go with it.
            $first_name_field_id = "{$field->id}.3";
            $last_name_field_id  = "{$field->id}.6";
        }

        if ($field->type == 'email') {
            $email_field_id = $field->id;
        }
    }

    $first_name = rgar($entry, $first_name_field_id);
    $last_name  = rgar($entry, $last_name_field_id);
    $user_email = rgar($entry, $email_field_id);
    $user_id    = email_exists($user_email);

    // README: If the user does not exist, we generate a password & use that to create one.
    //          While usernames cannot be changed, it is possible to register oneself with
    //          something else as your username, so we key off email as globally unique ID.
    if (!$user_id) {
        $random_password = wp_generate_password($length = 12, $include_standard_special_chars = true);
        $userdata = array(
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'role'       => 'subscriber',
            'user_email' => $user_email,
            'user_login' => $user_email,
            'user_pass'  => $random_password,
        );

        $user_id = wp_insert_user($userdata);
    }

    update_user_meta($user_id, 'ahma_stripe_customer_id', $customer->id);
}, 10, 4);

/**
 * Get current Stripe Customer ID to change billing.
 * Test if user has a customer ID, and return that to update it.
 */
add_filter('gform_stripe_customer_id', function ($customer_id, $feed, $entry, $form) {
    // README: Loop over all the fields of the form, and collect the field IDs
    //          of the entry values we want.
    foreach ($form['fields'] as $field) {
        if ($field->type == 'email') {
            $email_field_id = $field->id;
        }
    }

    $user_email = rgar($entry, $email_field_id);
    $user_id    = email_exists($user_email);

    if ($user_id) {
        // README: If the meta value does not exist it returns an empty string with the
        //          last parameter, $single, set to true
        //          http://developer.wordpress.org/reference/functions/get_user_meta/
        $customer_id = get_user_meta($user_id, 'ahma_stripe_customer_id', true);
    }

    return $customer_id;
}, 10, 4);
