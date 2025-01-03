<?php

$page_ID = get_the_ID();




/*---------------------------------------

			SECTION 1

/*--------------------------------------*/


$hide_section_1 = get_post_meta($page_ID, 'ap_home_section1_hide', true);
$full_height_section_1 = get_post_meta($page_ID, 'ap_home_section1_full_height', true);
$title_section_1 = get_post_meta($page_ID, 'ap_home_section1_title', true);
$subtitle_section_1 = get_post_meta($page_ID, 'ap_home_section1_subtitle', true);

/*list*/
$list_section_1 = get_post_meta($page_ID, 'ap_home_section1_list_group', true);

/*buttons (group)*/
$button_text_section_1 = get_post_meta($page_ID, 'ap_home_section1_button_text', true);
$button_url_section_1 = get_post_meta($page_ID, 'ap_home_section1_button_url', true);
$button_style_section_1 = get_post_meta($page_ID, 'ap_home_section1_button_style', true);

/*Image*/
$image_id_section_1 = get_post_meta($page_ID, 'ap_home_section1_image_id', true);
$image_alt_section_1 = get_post_meta($image_id_section_1, '_wp_attachment_image_alt', true);
$bg_repeat_section_1 = get_post_meta($page_ID, 'ap_home_section1_bg_repeat', true);

if (wp_is_mobile()) {
	$image_url_section_1 = wp_get_attachment_image_src(get_post_meta($page_ID, 'ap_home_section1_image_id', true), 'medium');
} else {
	$image_url_section_1 = wp_get_attachment_image_src(get_post_meta($page_ID, 'ap_home_section1_image_id', true), 'large');
}

$image_url_section_1 = $image_url_section_1[0];

/*Section 1 classes*/
$section1_classes = '';

if ($background_image_url_section_1) {
	$section1_classes .= ' has-bgimage ';
}
if ($bg_repeat_section_1) {
	$section1_classes .= ' bg-repeat ';
}
if ($full_height_section_1) {
	$section1_classes .= ' full-height d-flex align-items-center ';
}
?>

<?php if (!$hide_section_1) { ?>
	<section class="archpointSection section1 <?php echo $section1_classes; ?> eds-on-scroll" <?php if ($background_image_url_section_1) {
																																echo 'style="background-image:url(' . $background_image_url_section_1 . ')"';
																															} ?>>
		<div class="container">
			<div class="row section1 semiTransparentWhiteBackground">

				<?php
				// Classes for the image column
				$imageClasses = 'image d-flex align-items-center col-lg-6 img-responsive eds-on-scroll';

				// Classes for the content column
				$contentClasses = 'content d-flex align-items-center col';
				// if image exists, we want the content col to span half the content
				if ($image_url_section_1) {
					$contentClasses .= '-lg-6';
				}
				?>

				<div class="<?php echo $contentClasses; ?>">
					<div class="content-container">
						<?php
						// Title
						if ($title_section_1) {
							echo '<h2 class="mainTitle">' . $title_section_1 . '</h2>';
						}
						// Subtitle
						if ($subtitle_section_1) {
							echo '<h1 class="subtitle h3">' . $subtitle_section_1 . '</h1>';
						}

						//List
						if ($list_section_1) {

							echo '<ul class="iconList iconList--grayIcons list">';
							foreach ($list_section_1 as $list_item) {

								// link title
								$list_item_title = false;
								$key = array_search($list_item, $list_section_1);
								if (isset($list_item["ap_home_section1_item_title"]) && $list_item["ap_home_section1_item_title"]) {
									$list_item_title = $list_item["ap_home_section1_item_title"];
								}

								// Only print item if at least title exist
								if ($list_item_title) {
									echo '<li class="iconList-item eds-on-scroll' . $key . '">';
									echo $list_item_title;
									echo '</li>';
								}
							}
							echo '</ul>';
						}

						// Button
						if ($button_text_section_1 && $button_url_section_1) {

							$buttonClasses = '';

							if ($button_style_section_1 == 'primary') {
								$buttonClasses .= ' button--primary';
							} else if ($button_style_section_1 == 'secondary') {
								$buttonClasses .= ' button--secondary';
							} else if ($button_style_section_1 == 'primary-white') {
								$buttonClasses .= ' button--primaryWhite';
							} else if ($button_style_section_1 == 'secondary-white') {
								$buttonClasses .= ' button--secondaryWhite';
							}

							$buttonClasses .= ' eds-on-scroll' . ($key + 1) . ' ';

							echo '<a href="' . $button_url_section_1 . '" class="button ' . $buttonClasses . '">' . $button_text_section_1 . '</a>';
						}
						?>
					</div>
				</div>

				<?php if ($image_url_section_1) { ?>
					<div class="<?php echo $imageClasses; ?>">
						<img src="<?php echo $image_url_section_1 ?>" <?php if ($image_alt_section_1) {
																			echo 'alt="' . $image_alt_section_1 . '"';
																		} ?>>
					</div>
				<?php } ?>

			</div>
		</div>
	</section>
<?php } ?>




<?php
/*---------------------------------------

		     SECTION 2

/*--------------------------------------*/


$hide_section_2 = get_post_meta($page_ID, 'ap_home_section2_hide', true);
$full_height_section_2 = get_post_meta($page_ID, 'ap_home_section2_full_height', true);
$title_section_2 = get_post_meta($page_ID, 'ap_home_section2_title', true);
$subtitle_section_2 = get_post_meta($page_ID, 'ap_home_section2_subtitle', true);

/*list*/
$list_section_2 = get_post_meta($page_ID, 'ap_home_section2_list_group', true);

/*button*/
$button_text_section_2 = get_post_meta($page_ID, 'ap_home_section2_button_text', true);
$button_url_section_2 = get_post_meta($page_ID, 'ap_home_section2_button_url', true);
$button_style_section_2 = get_post_meta($page_ID, 'ap_home_section2_button_style', true);


$background_color_section_2 = get_post_meta($page_ID, 'ap_home_section2_background_color', true);

if (wp_is_mobile()) {
	$background_image_1_url_section_2 = wp_get_attachment_image_src(get_post_meta($page_ID, 'ap_home_section2_background_image_1_id', true), 'medium');
	$background_image_2_url_section_2 = wp_get_attachment_image_src(get_post_meta($page_ID, 'ap_home_section2_background_image_2_id', true), 'medium');
} else {
	$background_image_1_url_section_2 = wp_get_attachment_image_src(get_post_meta($page_ID, 'ap_home_section2_background_image_1_id', true), 'large');
	$background_image_2_url_section_2 = wp_get_attachment_image_src(get_post_meta($page_ID, 'ap_home_section2_background_image_2_id', true), 'large');
}

/*Section 2 classes*/
$section2_classes = '';

if ($background_image_1_url_section_2) {
	$section2_classes .= ' has-bgimage ';
}
if ($full_height_section_2) {
	$section2_classes .= ' full-height d-flex align-items-center ';
}
?>

<?php if (!$hide_section_2) { ?>
	<section class="archpointSection section2 <?php echo $section2_classes; ?> eds-on-scroll" style="
					<?php
					if (wp_is_mobile()) {
						echo 'background-position: bottom;padding: 0 0 200px!important;';
					}
					if ($background_color_section_2) {
						echo 'background-color:' . $background_color_section_2 . ';';
					}
					if ($background_image_1_url_section_2) {
						echo 'background-image:url(' . $background_image_1_url_section_2[0] . ')';
					}
					if ($background_image_2_url_section_2) {
						echo ', url(' . $background_image_2_url_section_2[0] . ')';
					}
					?>">
		<div class="container meetUs">
			<div class="row">

				<?php
				// Classes for the content column
				$contentClasses = 'content d-flex align-items-center offset-lg-7 col-lg-5 col-md-12';
				?>

				<div class="<?php echo $contentClasses; ?>">
					<div class="content-container">
						<?php
						// Title
						if ($title_section_2) {
							echo '<h2 class="mainTitle">' . $title_section_2 . '</h2>';
						}
						// Subtitle
						if ($subtitle_section_2) {
							echo '<h3 class="subtitle">' . $subtitle_section_2 . '</h3>';
						}

						//List
						if ($list_section_2) {

							echo '<ul class="linkedList list">';

							foreach ($list_section_2 as $list_item) {

								// link title
								$list_item_title = false;
								if (isset($list_item["ap_home_section2_item_title"]) && $list_item["ap_home_section2_item_title"]) {
									$list_item_title = $list_item["ap_home_section2_item_title"];
								}
								// link url
								$list_item_url = false;
								if (isset($list_item["ap_home_section2_item_url"]) && $list_item["ap_home_section2_item_url"]) {
									$list_item_url = $list_item["ap_home_section2_item_url"];
								}
								// link description
								$list_item_description = false;
								if (isset($list_item["ap_home_section2_item_description"]) && $list_item["ap_home_section2_item_description"]) {
									$list_item_description = $list_item["ap_home_section2_item_description"];
								}
								$key = array_search($list_item, $list_section_2);
								// Only print item if at least title exist
								if ($list_item_title) {
									echo '<li class="linkedList-item eds-on-scroll' . $key . '">';
									if ($list_item_url) {
										echo '<a href="' . $list_item_url . '" class="linkedList-item-link">' . $list_item_title . '</a>';
									} else {
										echo $list_item_title;
									}
									//description
									if ($list_item_description) {
										echo '<span class="linkedList-item-text">';
										echo $list_item_description;
										echo '</span>';
									}
									echo '</li>';
								}
							} //close foreach

							echo '</ul>';
						}

						// Button
						if ($button_text_section_2 && $button_url_section_2) {
							echo '<a href="' . $button_url_section_2 . '" class="button ' . $button_style_section_2 . '">' . $button_text_section_2 . '</a>';
						} ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>








<?php
/*---------------------------------------

SECTION 3

/*--------------------------------------*/


$hide_section_3 = get_post_meta($page_ID, 'ap_home_section3_hide', true);
$full_height_section_3 = get_post_meta($page_ID, 'ap_home_section3_full_height', true);

/*title*/
$title_section_3 = get_post_meta($page_ID, 'ap_home_section3_title', true);

/*button*/
$button_text_section_3 = get_post_meta($page_ID, 'ap_home_section3_button_text', true);
$button_url_section_3 = get_post_meta($page_ID, 'ap_home_section3_button_url', true);

/*testimonials playlist*/
$testimonials_playlist_3 = get_post_meta($page_ID, 'ap_home_section3_testimonials_playlist', true);

/*background color*/
$background_color_section_3 = get_post_meta($page_ID, 'ap_home_section3_bg_color', true);

/*Section 3 classes*/
$section3_classes = ' color-white ';

if ($full_height_section_3) {
	$section3_classes .= ' full-height d-flex align-items-center ';
}
if ($background_color_section_3 == 'sky-blue') {
	$section3_classes .= ' bg-skyBlue ';
} else if ($background_color_section_3 == 'dark-blue') {
	$section3_classes .= ' bg-darkBlue ';
}

?>

<?php if (!$hide_section_3) { ?>
	<section class="archpointSection section3 <?php echo $section3_classes; ?> animated fadeInUp duration1 eds-on-scroll" style="background-color:<?php echo $background_color_section_3; ?>">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php
					// Classes for the content column
					$contentClasses = 'content';
					?>

					<div class="<?php echo $contentClasses; ?>">
						<div class="content-container text-center">
							<?php
							// Title
							if ($title_section_3) {
								echo '<h2 class="mainTitle">' . $title_section_3 . '</h2>';
							}

							echo do_shortcode('[automatic_youtube_gallery playlist="' . $testimonials_playlist_3 . '" theme=slider columns="1" per_page="50" thumb_excerpt_length="0" controls=1 pagination_type="load_more"]');

							// Button
							if ($button_text_section_3 && $button_url_section_3) {
								echo '<a href="' . $button_url_section_3 . '" class="button button--secondaryWhite -inline-block mt-5">' . $button_text_section_3 . '</a>';
							}

							?>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>








<?php
/*---------------------------------------

         	     BANNER 1

/*--------------------------------------*/

$hide_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_hide', true);

/*title*/
$title_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_title', true);

/*description*/
$description_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_description', true);

/*button 1*/
$button_1_text_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_button_1_text', true);
$button_1_link_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_button_1_url', true);
$button_1_style_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_button_1_style', true);

$buttonClasses_btn_1 = '';

if ($button_1_style_banner_1 == 'primary') {
	$buttonClasses_btn_1 .= ' button--primary';
} else if ($button_1_style_banner_1 == 'secondary') {
	$buttonClasses_btn_1 .= ' button--secondary';
} else if ($button_1_style_banner_1 == 'primary-white') {
	$buttonClasses_btn_1 .= ' button--primaryWhite';
} else if ($button_1_style_banner_1 == 'secondary-white') {
	$buttonClasses_btn_1 .= ' button--secondaryWhite';
}

/*button 2*/
$button_2_text_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_button_2_text', true);
$button_2_link_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_button_2_url', true);
$button_2_style_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_button_2_style', true);

$buttonClasses_btn_2 = '';

if ($button_2_style_banner_1 == 'primary') {
	$buttonClasses_btn_2 .= ' button--primary';
} else if ($button_2_style_banner_1 == 'secondary') {
	$buttonClasses_btn_2 .= ' button--secondary';
} else if ($button_2_style_banner_1 == 'primary-white') {
	$buttonClasses_btn_2 .= ' button--primaryWhite';
} else if ($button_2_style_banner_1 == 'secondary-white') {
	$buttonClasses_btn_2 .= ' button--secondaryWhite';
}


/*background color*/
$background_color_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_bg_color', true);

/*background image*/
$background_image_url_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_background_image', true);

/*background repeat*/
$background_repeat_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_bg_repeat', true);

/*white color*/
$background_white_text_banner_1 = get_post_meta($page_ID, 'ap_home_banner1_white_text', true);

/*Banner 1 classes*/
$banner1_classes = ' color-white ';

if (!$background_image_url_banner_1) {
	if ($background_color_banner_1 == 'sky-blue') {
		$banner1_classes .= ' bg-skyBlue ';
	} else if ($background_color_banner_1 == 'dark-blue') {
		$banner1_classes .= ' bg-darkBlue ';
	}
}
if ($background_repeat_banner_1) {
	$banner1_classes .= ' bg-repeat ';
}

$banner1_classes .= ' animated fadeInUp delay1 duration1 eds-on-scroll ';
$buttonClasses_btn_1 .= ' animated push delay5 duration1 eds-on-scroll ';
$buttonClasses_btn_2 .= ' animated push delay6 duration1 eds-on-scroll ';

if (!$hide_banner_1 && $title_banner_1) { ?>

	<article class="archpointBanner banner1 <?php echo $banner1_classes; ?>" style="<?php if ($background_image_url_banner_1) {
																						echo 'background-image:url(' .

																							$background_image_url_banner_1 . ')';
																					} ?>">

		<h2 class="archpointBanner-title animated fadeInDown delay1 duration1 eds-on-scroll">
			<?php echo $title_banner_1; ?>
		</h2>

		<?php if ($description_banner_1) { ?>
			<p class="archpointBanner-description animated fadeInDown delay2 duration1 eds-on-scroll">
				<?php echo $description_banner_1; ?>
			</p>
		<?php } ?>

		<?php if ($button_1_text_banner_1 && $button_1_link_banner_1) { ?>
			<a href="<?php echo $button_1_link_banner_1; ?>" class="button <?php echo $buttonClasses_btn_1; ?>">
				<?php echo $button_1_text_banner_1; ?>
			</a>
		<?php } ?>

		<?php if ($button_2_text_banner_1 && $button_2_link_banner_1) { ?>
			<a href="<?php echo $button_2_link_banner_1; ?>" class="button <?php echo $buttonClasses_btn_2; ?>">
				<?php echo $button_2_text_banner_1; ?>
			</a>
		<?php } ?>

	</article>

<?php } ?>









<?php
/*---------------------------------------

         	   SERVICES

/*--------------------------------------*/

/*hide section*/
$hide_section_services = get_post_meta($page_ID, 'ap_home_services_hide', true);

/*title*/
$title_services = get_post_meta($page_ID, 'ap_home_services_title', true);

/*description*/
$description_services = get_post_meta($page_ID, 'ap_home_services_description', true);

/*background color*/
$background_color_services = get_post_meta($page_ID, 'ap_home_services_bg_color', true);

/*Section 3 classes*/
$services_classes = 'text-center animated fadeInUp delay1 duration1 eds-on-scroll ';

if ($background_color_services == 'sky-blue') {
	$services_classes .= ' bg-skyBlue ';
} else if ($background_color_services == 'white-blue') {
	$services_classes .= ' bg-whiteBlue ';
} else if ($background_color_services == 'dark-blue') {
	$services_classes .= ' bg-darkBlue ';
}

if (!$hide_section_services && $title_services) { ?>

	<section class="archpointSection sectionServices <?php echo $services_classes; ?>">
		<div class="container">
			<header class="mb40px">
				<?php if ($title_services) {
					// Title
					echo '<h2 class="mb0 mt0 animated fadeInDown delay2 duration1 eds-on-scroll ">' . $title_services . '</h2>';
				} ?>

				<?php if ($description_services) {
					// Description
					echo '<p class="description h2-subtitle animated fadeInDown delay3 duration1 eds-on-scroll ">' . $description_services . '</p>';
				} ?>
			</header>
			<?php get_template_part('template-parts/services-loop'); ?>
		</div>
	</section>
<?php } ?>