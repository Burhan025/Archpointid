<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
	


		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #content -->



	<?php 

	// CMB2 Custom Fields
	 
	//Introductory section
	$introductory_title = get_post_meta( get_the_ID(), 'ap_service_solution_intro_title', true );
	$introductory_description = get_post_meta( get_the_ID(), 'ap_service_solution_intro_description', true );
	
	//solutions section:
	$solutions_section_title = get_post_meta( get_the_ID(), 'ap_service_solution_title', true );
	$solutions_list_items = get_post_meta( get_the_ID(), 'ap_service_solution_group', true );

	//Process Involved section:
	$process_section_title = get_post_meta( get_the_ID(), 'ap_service_process_title', true );
	$process_group_of_blocks = get_post_meta( get_the_ID(), 'ap_service_process_group_blocks', true );

	?>

	
		<?php if($introductory_title || $introductory_description) {
		echo '<section class="archpointSection introduction bg-whiteGrey">';
			echo '<div class="container">';
				if($introductory_title){
					echo '<h2 class="text-center mt0">'.$introductory_title.'</h2>';
				}

				if($introductory_description){
					echo '<div class="row">';
						if(strlen($introductory_description) > 600) {
							echo '<div class="col">';
								echo '<p class="twoCols">'.$introductory_description.'</p>';
							echo '</div>';
						} else {
							echo '<div class="col-md-8 offset-md-2">';
								echo '<p>'.$introductory_description.'</p>';
							echo '</div>';
						}
					echo '</div>';
				}

			echo '</div>';
		echo '</section>';
		} ?>
	

		<main id="main" class="site-main" role="main">		

			<?php if($solutions_section_title || $solutions_list_items) { ?>
			<!-- Solutions Section -->
			<section class="archpointSection solutions bg-skyBlue">

				<div class="container">
					
					<?php if($solutions_section_title) {?>
					<!-- Solutions Title -->
					<h2 class="text-center h2 mt0"><?php echo $solutions_section_title; ?></h2>
					<?php } ?>

					<?php if($solutions_list_items) {?>
					<!-- List of solutions -->

					<ul class="iconList iconList--big iconList--landscape mb0">
						<?php
						foreach ($solutions_list_items as $solution) {

							$icon_image = false;
							if($solution['ap_service_solution_item_icon']) {
								$icon_image = $solution['ap_service_solution_item_icon'];
							}

							echo '<li class="iconList-item '.$icon_image.'"><span class="iconList-title">'.$solution["ap_service_solution_item_title"].'</span></li>';
						}
						?>
					</ul>
					<?php } ?>

				</div>

			</section>
			<!-- /Solutions Section -->
			<?php } ?>


			<?php if($process_section_title || $process_group_of_blocks) { ?>
			<!-- Process Involves Section -->
			<section class="archpointSection process">

				<div class="container">
				
					<div class="navigation-left col-lg-3 col-md-4">
						<?php
						$selected_menu = get_post_meta( get_the_ID(), '_custom_menu', true );

						// If a menu is selected, display it
						if ( ! empty( $selected_menu ) ) {
							wp_nav_menu( array(
								'menu' => $selected_menu,
								'container' => 'nav',
								'container_class' => 'menu-services-container',
							) );
						} else {
							echo '<p>' . __( 'No menu selected for this page.', 'text_domain' ) . '</p>';
						}
						?>
					</div>
						
					<div class="service-content-right col-lg-9 col-md-8">
					<?php if($process_section_title) {?>
					<!-- Process Title -->
					<h2 class="text-center mt0 mb80px"><?php echo $process_section_title; ?></h2>
					<?php } ?>


					<?php if($process_group_of_blocks) {

						$counter = 1; // used to reverse column order if the row is even (2,4,6, etc..)

						foreach ($process_group_of_blocks as $process_block) {

							// only image for both processes items
							$image_id = false;
							if (array_key_exists('ap_service_process_image', $process_group_of_blocks[0])) {
								$image_id = $process_block['ap_service_process_image_id'];
								$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
							}				

							/*first item*/
							$first_item_title = false;
							if (array_key_exists('ap_service_process_first_item_title', $process_block)) {
								$first_item_title = $process_block['ap_service_process_first_item_title'];
							}
							$first_item_description = false;
							if (array_key_exists('ap_service_process_first_item_description', $process_block)) {
								$first_item_description = $process_block['ap_service_process_first_item_description'];
							}
							$first_item_see_more_text = false;
							if (array_key_exists('ap_service_process_first_item_see_more_text', $process_block)) {
								$first_item_see_more_text = $process_block['ap_service_process_first_item_see_more_text'];
							}
							$first_item_see_more_url = false;
							if (array_key_exists('ap_service_process_first_item_see_more_url', $process_block)) {
								$first_item_see_more_url = $process_block['ap_service_process_first_item_see_more_url'];
							}
							

							/*second item*/
							$second_item_title = false;
							if (array_key_exists('ap_service_process_second_item_title', $process_block)) {
								$second_item_title = $process_block['ap_service_process_second_item_title'];
							}
							$second_item_description = false;
							if (array_key_exists('ap_service_process_second_item_description', $process_block)) {
								$second_item_description = $process_block['ap_service_process_second_item_description'];
							}
							$second_item_see_more_text = false;
							if (array_key_exists('ap_service_process_second_item_see_more_text', $process_block)) {
								$second_item_see_more_text = $process_block['ap_service_process_second_item_see_more_text'];
							}
							$second_item_see_more_url = false;
							if (array_key_exists('ap_service_process_second_item_see_more_url', $process_block)) {
								$second_item_see_more_url = $process_block['ap_service_process_second_item_see_more_url'];
							}

							// Classes for the image column
							
							$imageClasses = 'image col ';
							// if image exists, we want the image col to span half the content
							if($image_id) {$imageClasses .= '-lg-5';}
							// if the row is even, we want to swap the image col with the content col
							if($counter % 2 == 0) { $imageClasses .= ' order-lg-2 text-lg-right ';}


							// Classes for the content column
							
							$contentClasses = 'content col';
							// if image exists, we want the content col to span half the content
							if($image_id) {$contentClasses .= '-lg-7';}
							// if the row is even, we want to swap the image col with the content col
							if($counter % 2 == 0) { $contentClasses .= ' order-lg-1';}
		
							?>

							<div class="row processRow" id="section-<?php echo $counter; ?>">

								<?php if($image_id) { ?>
									<div class="<?php echo $imageClasses; ?>">
										<?php echo wp_get_attachment_image($image_id, "medium", "false", array("title"=> $image_alt,"alt"=> $image_alt)); ?>
									</div>
								<?php } ?>

								<?php if($first_item_title || $first_item_description || $second_item_title || $second_item_description) { ?>
								<div class="<?php echo $contentClasses; ?>">
									<div class="content-container">
										<ul class="iconList iconList--medium iconList--biggerTitle">
										<?php 
											// first item
											if($first_item_title || $first_item_description) { ?>
												<li class="iconList-item">
													<span class="iconList-title"><?php echo $first_item_title; ?></span>
													<span class="iconList-text"><?php echo $first_item_description ?></span>

													<?php if($first_item_see_more_text && $first_item_see_more_url) { ?>
													<a class="iconList-link" href="<?php echo $first_item_see_more_url; ?>">
														<?php echo $first_item_see_more_text; ?>
													</a>
													<?php } ?>
												</li>
											<?php }

											// second item
											if($second_item_title || $second_item_description) { ?>
												<li class="iconList-item">
													<span class="iconList-title"><?php echo $second_item_title; ?></span>
													<span class="iconList-text"><?php echo $second_item_description ?></span>

													<?php if($second_item_see_more_text && $second_item_see_more_url) { ?>
													<a class="iconList-link" href="<?php echo $second_item_see_more_url; ?>">
														<?php echo $second_item_see_more_text; ?>
													</a>
													<?php } ?>
												</li>
											<?php } ?>
										</ul>
									</div>

								</div><!-- //.col.content -->
								<?php } ?>

								<?php $counter++; ?>

							</div><!-- /.row.processRow -->
						<?php } ?>

					<?php } //process_group_of_blocks ?>
					</div>
				</div>

			</section><!-- /archpointSection.process -->
			<?php } //Process Involves Section ?>

		</main><!-- #main -->


<?php
get_footer();
