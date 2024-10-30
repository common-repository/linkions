<form method="post" action="#">
    <?php wp_nonce_field('social_action', 'social_action_nonce');
    do_action('social-section-form');
    $linkions_social_posion_array = array('Top' => 'Top', 'Bottom' => 'Bottom');
    $linkions_social = get_option('linkions_social');
    ?>
    <?php settings_errors(); ?>
    <div id="poststuff" class="meta-box-holder" style="<?php echo (!wp_is_mobile()) ? "min-width: 540px; width:540px" : "" ?>">
        <div id="generaldiv1" class="postbox" style="display: none;">
            <div class="postbox-header">
                <h2><?php echo __('Position'); ?></h2>
            </div>
            <div class="inside">
                <h4><?php echo __('Placement of social icons'); ?></h4>
                <?php foreach ($linkions_social_posion_array as $key => $linkions_social_posions) {
                    if (empty($linkions_social['linkions-social-position'])) {
                        if ($key == 'Top') {
                            $linkions_postion_select = 'checked';
                        } else {
                            $linkions_postion_select = '';
                        }
                    } else {
                        if ($linkions_social['linkions-social-position'] == $key) {
                            $linkions_postion_select = 'checked';
                        } else {
                            $linkions_postion_select = '';
                        }
                    }
                    echo '<input type="radio" name="linkions-social-position" value="' . esc_attr($key) . '" ' . esc_attr($linkions_postion_select) . '> ' . esc_html($linkions_social_posions);
                } ?>
                <p><?php echo __('You can select where you want to show the social icons, if you have selected Top the icons will be shown just above the buttons.'); ?></p>
            </div>
        </div>
        <div id="generaldiv2" class="postbox">
            <div class="postbox-header">
                <h2><?php echo __('Social profiles'); ?></h2>
            </div>
            <div class="inside">
                <table class="form-table" role="presentation">
                    <tr>
                        <th><?php echo __('Facebook URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-fb-url" type="url" id="linkions-fb-url" value="<?php echo isset($linkions_social['linkions-fb-url']) ? esc_url($linkions_social['linkions-fb-url']) : ''; ?>" class="regular-text" placeholder="https://facebook.com/facebook">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Twitter URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-twitter-url" type="url" id="linkions-twitter-url" value="<?php echo isset($linkions_social['linkions-twitter-url']) ? esc_url($linkions_social['linkions-twitter-url']) : ''; ?>" class="regular-text" placeholder="https://twitter.com/twitter">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Instagram URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-instagram-url" type="url" id="linkions-instagram-url" value="<?php echo isset($linkions_social['linkions-instagram-url']) ? esc_url($linkions_social['linkions-instagram-url']) : ''; ?>" class="regular-text" placeholder="https://instagram.com/instagram">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Linkedin URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-linkedin-url" type="url" id="linkions-linkedin-url" value="<?php echo isset($linkions_social['linkions-linkedin-url']) ? esc_url($linkions_social['linkions-linkedin-url']) : ''; ?>" class="regular-text" placeholder="https://linkedin.com/company/linkedin/">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Pinterest URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-pinterest-url" type="url" id="linkions-pinterest-url" value="<?php echo isset($linkions_social['linkions-pinterest-url']) ? esc_url($linkions_social['linkions-pinterest-url']) : ''; ?>" class="regular-text" placeholder="https://pinterest.com/pinterest">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Youtube URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-youtube-url" type="url" id="linkions-youtube-url" value="<?php echo isset($linkions_social['linkions-youtube-url']) ? esc_url($linkions_social['linkions-youtube-url']) : ''; ?>" class="regular-text" placeholder="https://youtube.com/c/youtube">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Behance URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-behance-url" type="url" id="linkions-behance-url" value="<?php echo isset($linkions_social['linkions-behance-url']) ? esc_url($linkions_social['linkions-behance-url']) : ''; ?>" class="regular-text" placeholder="https://www.behance.net/behance">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Github URL','linkions'); ?></th>
                        <td>
                            <input name="linkions-github-url" type="url" id="linkions-github-url" value="<?php echo isset($linkions_social['linkions-github-url']) ? esc_url($linkions_social['linkions-github-url']) : ''; ?>" class="regular-text" placeholder="https://github.com/github">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <input type="submit" name="save-changes" id="save-changes" class="button button-primary button-large" value="Save changes">
</form>