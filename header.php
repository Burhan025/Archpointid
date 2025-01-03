<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<script src="https://www.googleoptimize.com/optimize.js?id=OPT-5WN96GD"></script>
	<!-- Google Tag Manager 
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PP4RHMT');</script>-->
    <!-- End Google Tag Manager -->
   
	<?php 
	if(wp_is_mobile()){
		$mainHeader_background_image = get_post_meta( get_the_ID(), 'ap_mainHeader_background_image_id', true );
		if($mainHeader_background_image){
					$image_mobile = wp_get_attachment_image_src(get_post_meta( get_the_ID(), 'ap_mainHeader_background_image_id', true ), 'medium');
					echo '<link rel="preload" as="image" href="'.$image_mobile[0].'.webp">';
		}
	}
	?>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
	<meta name="google-site-verification" content="PZnbPrLQUQnhY55m_Q8_XF3d4FcnoPQ8snVt2TqgVzY" />
</head>

<body <?php body_class(); ?>>

	<!-- Google Tag Manager (noscript) 
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PP4RHMT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>-->
    <!-- End Google Tag Manager (noscript) -->

	<div id="page-anim-preloader"></div>
	<div id="page" class="site">
		<?php if (!is_page_template('blank-page.php') && !is_page_template('blank-page-with-container.php')) : ?>
			<header id="masthead" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
				<div class="masheadInnerContainer">

					<?php
					//Top navbar call to action (Appereance > Customize > Site Identity > Archpoint Top navbar call to action)
					$top_navbar_call_to_action = get_theme_mod('archpoint_navbar_top_call_to_action');
					if ($top_navbar_call_to_action) { ?>
						<div class="headerCallToAction bg-blue text-center color-white"><?php echo $top_navbar_call_to_action; ?></a></div>
						
					<?php } ?>

					<div class="container">
						<nav class="navbar navbar-dark navbar-expand-lg p-0 justify-content-between">

							<div class="navbar-brand align-self-baseline p-10">
								<?php

								$siteTitle = get_bloginfo('name') . " | " . get_bloginfo('description');

								if (get_theme_mod('archpoint_nav_isotype')) :
									echo '<a href="' . esc_url(home_url('/')) . '">';

									echo wp_get_attachment_image(get_theme_mod('archpoint_nav_isotype'), "", "true", array(
										"class" => "nav-isotype isotype style-svg", 
										"width" => "44px", 
										"height" => "45px", 
										"title" => $siteTitle, 
										"alt" => $siteTitle));

									if (get_theme_mod('archpoint_nav_isotype_diapo')) {
										echo wp_get_attachment_image(get_theme_mod('archpoint_nav_isotype_diapo'), "", "true", array(
											"class" => "nav-isotype-diapo isotype style-svg", 
											"width" => "44px", 
											"height" => "45px", 
											"title" => $siteTitle, "alt" => $siteTitle));
									}
									if (get_theme_mod('archpoint_nav_isotype')) {
										echo wp_get_attachment_image(get_theme_mod('archpoint_nav_logotype'), "", "true", array(
											"class" => "nav-logotype style-svg", 
											"width" => "150px", 
											"height" => "35px", 
											"title" => $siteTitle, "alt" => $siteTitle));
									}

									echo '</a>';
								else :
									echo '<a class="site-title" href="' . esc_url(home_url('/')) . '">' . esc_url(bloginfo('name')) . '</a>';
								endif;
								?>
							</div>

							<div class="right-side">

								<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
									<div class="navTrigger"><i></i><i></i><i></i>
								</button> -->

								<?php

								if (has_nav_menu('contact-menu')) {
									// User has assigned menu to this location;
									// output it
									wp_nav_menu(array(
										'theme_location'    => 'contact-menu',
										'container'       => 'div',
										'container_id'    => 'contact-nav',
										'container_class' => 'collapse navbar-collapse justify-content-end',
										'menu_id'         => false,
										'menu_class'      => 'navbar-nav',
										'depth'           => 3,
										'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
										'walker'          => new wp_bootstrap_navwalker()
									));
								}

								wp_nav_menu(array(
									'theme_location'    => 'primary',
									'container'       => 'div',
									'container_id'    => 'main-nav',
									'container_class' => 'collapse navbar-collapse justify-content-end',
									'menu_id'         => false,
									'menu_class'      => 'navbar-nav',
									'depth'           => 3,
									'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
									'walker'          => new wp_bootstrap_navwalker()
								));


								?>

							</div>

						</nav>
					</div>
				</div><!-- /.masheadInnerContainer -->
			</header><!-- #masthead -->



			<div id="content" class="site-content">

				<?php
				$post_type = get_post_type();
				/*mainHeader (should not be visible on posts)*/
				if (!is_single()) {
					get_template_part('template-parts/mainHeader');
				} else { // On single posts display a banner type instead of the mainHeader module
					if ($post_type == 'service') {
						get_template_part('template-parts/banner-headerService');
					} else {
						get_template_part('template-parts/banner-headerPost');
					}
				} ?>

				<div class="container">
					<div class="row">
					<?php endif; ?>