<form method="post" action="">
    <?php wp_nonce_field('appearance_action', 'appearance_action_nonce');
    do_action('appearance-section-form');

    $last_linkions_id = $this->linkions_latest_id();

    if (!empty($last_linkions_id)) {
        $post = get_post($last_linkions_id);
        $linkions_slug = $post->post_name;
        $linkions_title = $post->post_title;
        $linkions_excerpt = $post->post_excerpt;

        $linkions_appearance_image_id = get_post_meta($last_linkions_id, '_thumbnail_id', true);
        if (empty($linkions_appearance_image_id)) {
            $linkions_appearance_image_id = 0;
        }
        $page_url = site_url($linkions_slug);
    } else {
        $linkions_slug = '';
        $linkions_title = '';
        $linkions_excerpt = '';
        $linkions_appearance_image_id = 0;
        $page_url = '';
    }

    ?>
    <?php settings_errors(); ?>
    <div id="poststuff" class="meta-box-holder" style="<?php echo (!wp_is_mobile()) ? "min-width: 540px; width:540px" : "" ?>">
        <div id="generaldiv" class="postbox">
            <div class="postbox-header">
                <h2><?php echo __('Appearance Settings'); ?></h2>
            </div>
            <div class="inside">
                <p><?php echo __('Settings to add the Profile URL, description and profile logo'); ?></p>
                <h3><?php echo __('URL'); ?></h3>
                <table class="form-table" role="presentation">
                    <tr>
                        <td><?php echo __('Enter URL for the page'); ?></td>
                        <td><input name="linkions-url" type="text" id="linkions-url" value="<?php echo esc_attr($linkions_slug); ?>" class="regular-text" placeholder="profile-url">
                        </td>
                    </tr>
                    <?php if ($page_url !== '') : ?>
                        <tr>
                            <td></td>
                            <td><a href="<?php echo esc_url($page_url); ?>" target="_blank"><?php echo esc_url($page_url) ?></a></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <div id="generaldiv" class="postbox">
            <div class="postbox-header">
                <h2><?php echo __('Profile Settings','linkions'); ?></h2>
            </div>
            <div class="inside">
                <p><?php echo __('Add the Title and Description you prefer for the page','linkions'); ?></p>
                <table class="form-table" role="presentation">
                    <tr>
                        <th><?php echo __('Title','linkions'); ?></th>
                        <td>
                            <input name="linkions-title" type="text" id="linkions-title" value="<?php echo esc_attr($linkions_title); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Bio description','linkions'); ?></th>
                        <td>
                            <textarea name="linkions-description" type="text" id="linkions-description" class="regular-text"><?php echo esc_textarea($linkions_excerpt); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Profile logo','linkions'); ?></th>
                        <td><?php

                            if ($linkions_appearance_image = wp_get_attachment_image_src($linkions_appearance_image_id)) {

                                echo '<a href="#" class="linkion-profile-upload"><img src="' . esc_url($linkions_appearance_image[0]) . '" /></a>
													<a href="#" class="linkion-profile-remove">Remove image</a>
													<input type="hidden" name="linkion-profile-image" value="' . esc_attr($linkions_appearance_image_id) . '">';
                            } else {

                                echo '<a href="#" class="linkion-profile-upload">Upload image</a>
													<a href="#" class="linkion-profile-remove" style="display:none">Remove image</a>
													<input type="hidden" name="linkion-profile-image" value="">';
                            } ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" name="last_linkions_id" value="<?php echo esc_attr($last_linkions_id); ?>">
    <input type="submit" name="save-changes" id="save-changes" class="button button-primary button-large" value="Save changes">
</form>