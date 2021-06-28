<header class="page-header wp-block-group">
  <div class="wp-block-group__inner-container">
    <h2 class="page-header__headline">Together, we can make Massachusetts for everyone</h2>

    <div class="header-signup">
      <script src="https://actionnetwork.org/widgets/v4/form/join-our-mailing-list-82?format=js&source=widget&referrer=group-abundant-housing-ma"></script>
      <script>
        var observer = new MutationObserver(function(mutations) {
          if (jQuery("#can-form-area-join-our-mailing-list-82 form").length) {
            console.log("Exists, let’s do something");

            let auth_token = jQuery('#can-form-area-join-our-mailing-list-82 input[name=authenticity_token]').val();
            jQuery('#real_auth_token').val(auth_token);

            observer.disconnect();
            // We disconnect observer once the element exists; we don’t want to keep observing changes
          }
        });

        // Start observing
        observer.observe(document.body, { // document.body is node target to observe
          childList: true, // This is a must have for the observer with subtree
          subtree: true // Set to true if changes must also be observed in descendants.
        });
      </script>

      <div id="can-form-area-join-our-mailing-list-82" style="display: none;"></div>

      <!-- Begin Newsletter Signup Form -->
      <form accept-charset="utf-8" action="https://actionnetwork.org/forms/join-our-mailing-list-82/answers"  class="mc-embedded-subscribe-form validate" id="new_answer" method="post" target="_blank">
        <input type="hidden" name="utf8" value="✓">
        <input type="hidden" name="authenticity_token" value="" id="real_auth_token">
        <input type="hidden" name="version" value="v4">
        <input type="hidden" name="redirect" id="redirect">

        <h3>Sign up to get the latest updates</h3>

        <div class="mc-field-group">
          <label for="mce-EMAIL" class="screen-reader-text">Email</label>
          <input type="email" name="answer[email]" id="mce-EMAIL" placeholder="Email address" title="The domain portion of the email address is invalid (the portion after the @)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required>
        </div>

        <div class="mc-field-group">
          <label for="mce-MMERGE8" class="screen-reader-text">Zip code</label>
          <input type="text" value="" name="answer[zip_code]" id="mce-MMERGE8" placeholder="Zip code" required>
        </div>

        <div>
          <input type="submit" value="Join" name="commit" id="mc-embedded-subscribe" class="button">
        </div>

        <select id="form-country" name="answer[country]" style="display: none;">
          <option value="US" selected="">United States</option>
        </select>

        <input type="hidden" name="subscription[group]" value="206786" id="name_optin1" checked="checked">
        <input type="hidden" name="subscription[sub_group_id]" value="206786">
        <input type="hidden" name="subscription[group_referrer]" value="206786" id="name_optin1" checked="checked">
        <input type="hidden" name="subscription[sub_group_referrer_id]" value="206786">
        <input type="hidden" name="subscription[http_referer]" value="abundanthousingma.test">
        <input type="hidden" name="subscription[source]" value="widget" id="subscription_source">
        <input type="hidden" name="answer[tag_list]" class="js-tag_list" id="answer_tag_list">
      </form>
    </div>
  </div>
</header>
