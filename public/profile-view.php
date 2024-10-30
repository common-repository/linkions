<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php echo esc_html($title) ?></title>
		<meta name="description" content="<?php echo esc_attr($description) ?>">
		<link href="<?php echo esc_url($stylesheet_url) ?>" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<div class="linkions-profile-wrapper">
				<?php if ($linkions_image) : ?>
					<img src="<?php echo esc_url($linkions_image) ?>" class="linkions-profile-img" alt="<?php echo esc_attr($linkion_page->post_title); ?>" />
				<?php endif; ?>
				<h1 class="linkions-profile-title"><?php echo esc_html($linkion_page->post_title); ?></h1>
				<p class="linkions-profile-desc"><?php echo nl2br(esc_textarea($linkion_page->post_excerpt)); ?></p>
				<div class="linkions-social-wrapper">
					<?php
					if (is_array($linkions_social) && count($linkions_social) > 0) :
						foreach ($linkions_social as $key => $linkions_social_links) :
							if (!empty($linkions_social_links) && $key != 'linkions-social-position') : ?>
								<div class="linkions-social-item">
									<a class="<?php echo esc_attr(strtolower($this->social_profile_names[$key])); ?>" href="<?php echo esc_url($linkions_social_links) ?>" target="_blank"></a>
								</div>
					<?php 	endif;
						endforeach;
					endif; ?>
				</div>
			</div>
		</div><!-- #container -->
	</body>
</html>