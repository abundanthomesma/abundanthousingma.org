<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "Learn more" button to the excerpt
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return '…<div class="wp-block-buttons"><div class="wp-block-button"><a class="wp-block-button__link" href="' . get_permalink() . '">' . __('Learn more', 'sage') . '</a></div></div>';
});
