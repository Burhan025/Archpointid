<?php

/**
* Template Name: Dental Implants
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #content -->


	<?php

	$hideLoopServices = get_post_meta( get_the_ID(), 'ap_dental_implants_services_loop_hide', true ); 
	$servicesTitle = get_post_meta( get_the_ID(), 'ap_dental_implants_services_loop_title', true );
	if(!$servicesTitle){
		$servicesTitle = get_the_title();
	}
	$servicesSubTitle = get_post_meta( get_the_ID(), 'ap_dental_implants_services_loop_subtitle', true );

	if(!$hideLoopServices) {

		// Loop of Services
		$hasServicesPosts = get_posts('services');
		if( !empty ( $hasServicesPosts ) ) {

			$servicesOuterContainer = 'servicesOuterContainer archpointSection bg-whiteBlue';
		?>

		<div class="<?php echo $servicesOuterContainer; ?>">
			<div class="container">

				<?php
					if($servicesTitle || $servicesSubTitle) {

						echo '<header class="mb50px">';
							if($servicesTitle) {
								echo '<h2 class="text-center mb0">'.$servicesTitle.'</h2>';
							}
							if($servicesSubTitle) {
								echo '<p class="text-center h2-subtitle mb0">'.$servicesSubTitle.'</p>';
							}	
						echo '</header>';

					}

				?>

				<?php get_template_part( 'template-parts/services-loop' ); ?>
			</div>
		</div>

		<?php } //$hasServicesPosts
	} //$hideLoopServices ?>




	<!-- Benefits Section -->
	<?php
		$benefits_group = get_post_meta( get_the_ID(), 'ap_dental_implants_benefits_group', true );

		if($benefits_group) {

			echo '<section class="benefits archpointSection">';
			echo '<div class="container">';

				$counter = 1; // used to reverse column order if the row is even (2,4,6, etc..)

				foreach ($benefits_group as $benefit) {

					$title = false;
					if (array_key_exists('ap_dental_implants_title', $benefit)) {
						$title = $benefit['ap_dental_implants_title'];
					}

					$image_id = false;
					if (array_key_exists('ap_dental_implants_image', $benefit)) {
						$image_id = $benefit['ap_dental_implants_image_id'];
						$image = wp_get_attachment_image($image_id , 'full');
					}

					$content = false;
					if (array_key_exists('ap_dental_implants_content', $benefit)) {
						$content = $benefit['ap_dental_implants_content'];
					}


					// Classes for the image column
					
					$imageClasses = 'image d-flex align-items-center col';
					// if image exists, we want the image col to span half the content
					if($image_id) {$imageClasses .= '-lg-6';}
					// if the row is even, we want to swap the image col with the content col
					if($counter % 2 == 0) { $imageClasses .= ' order-lg-1';}


					// Classes for the content column
					
					$contentClasses = 'benefits-content d-flex align-items-center col';
					// if image exists, we want the content col to span half the content
					if($image_id) {$contentClasses .= '-lg-6';}
					// if the row is even, we want to swap the image col with the content col
					if($counter % 2 == 0) { $contentClasses .= ' order-lg-2';}


					if($title && $content) { //only show benefit if title and content is present

						echo '<div class="row benefits-row">';

							//content
							echo '<div class="'.$contentClasses.'">';
								echo '<div>';
									echo '<h2 class="h2 benefits-content-title">'.$title.'</h2>';
									echo $content;
								echo '</div>';
							echo '</div>';

							//image
							if($image_id) {
								echo '<div class="'.$imageClasses.'">';
									echo $image;
								echo '</div>';
							}

						echo '</div>';
					}

					$counter++;

				} // foreach 

			echo '</div>'; //Close .container
			echo '</section>';
		}
	?>
	<!-- /Benefits Section -->




	<!-- Lifelong Benefits Section -->
	<?php
		//Only display the section if title, and at least one lifelong benefit list item are available
		
		$lifelong_benefits_main_title =  get_post_meta( get_the_ID(), 'ap_dental_implants_llb_title', true );
		$lifelong_benefits_subtitle =  get_post_meta( get_the_ID(), 'ap_dental_implants_llb_subtitle', true );
		$lifelong_benefits_button_text =  get_post_meta( get_the_ID(), 'ap_dental_implants_llb_button_text', true );
		$lifelong_benefits_button_url =  get_post_meta( get_the_ID(), 'ap_dental_implants_llb_button_url', true );
		$lifelong_benefits_group = get_post_meta( get_the_ID(), 'ap_dental_implants_llb_group', true );

		if($lifelong_benefits_main_title && $lifelong_benefits_group) {

			echo '<section class="archpointSection lifeLongBenefits bg-skyBlue">';
				echo '<div class="container">';

					echo '<h2 class="mainTitle mb0 mt0 text-center">'.$lifelong_benefits_main_title.'</h2>';

					if($lifelong_benefits_subtitle) {
						echo '<div class="row">';
						echo '<div class="col-md-8 offset-md-2">';
						echo '<h3 class="h3-subtitle mt0 mb80px text-center">'.$lifelong_benefits_subtitle.'</h3>';
						echo '</div>';
						echo '</div>';
					}

					//List of benefits
					echo '<div class="row">';
					echo '<div class="col-md-10 offset-md-1">';
					echo '<ul class="iconList iconList--big iconList--half text-left">';
						foreach ($lifelong_benefits_group as $lifelong_benefit) {

							$llb_title = false;
							if (array_key_exists('ap_dental_implants_llg_group_item_title', $lifelong_benefit)) {
								$llb_title = $lifelong_benefit['ap_dental_implants_llg_group_item_title'];
							}
							$llb_description = false;
							if (array_key_exists('ap_dental_implants_llg_group_item_description', $lifelong_benefit)) {
								$llb_description = $lifelong_benefit['ap_dental_implants_llg_group_item_description'];
							}

							/*icon*/
							$iconListClasses = 'iconList-item ';
							if (array_key_exists('ap_dental_implants_llg_group_item_icon', $lifelong_benefit)) {
								$llb_icon_class = $lifelong_benefit['ap_dental_implants_llg_group_item_icon'];
								$iconListClasses .= $llb_icon_class;
							}

							echo '<li class="'.$iconListClasses.'">';
								if($llb_title){
									echo '<span class="iconList-title">'.$llb_title.'</span>';
								}
								if($llb_description){
									echo '<span class="iconList-text">'.$llb_description.'</span>';
								}
							echo '</li>';
						}
					echo '</ul>';
					echo '</div>';
					echo '</div>';

					if($lifelong_benefits_button_text && $lifelong_benefits_button_url) {
						echo '<div class="lifeLongBenefits-buttonwWrapper">';
						echo '<a class="lifeLongBenefits-button button button--secondaryWhite" href="'.$lifelong_benefits_button_url.'">'.$lifelong_benefits_button_text.'</a>';
						echo '</div>';
					}


				echo '</div>';
			echo '</section>';

		}

		if($benefits_group) {

		}
	?>
	<!-- /Lifelong Benefits Section -->



	<!-- Big Banner Section -->
	<?php 
		//Only display the big banner if title and at least description are available
		$big_banner_title =  get_post_meta( get_the_ID(), 'ap_dental_implants_bb_title', true );
		$big_banner_subtitle =  get_post_meta( get_the_ID(), 'ap_dental_implants_bb_subtitle', true );
		$big_banner_description =  get_post_meta( get_the_ID(), 'ap_dental_implants_bb_description', true );
		$big_banner_button_text =  get_post_meta( get_the_ID(), 'ap_dental_implants_bb_button_text', true );
		$big_banner_button_url =  get_post_meta( get_the_ID(), 'ap_dental_implants_bb_button_url', true );
		$big_banner_background_image_url =  get_post_meta( get_the_ID(), 'ap_dental_implants_bb_background_image', true );
		$big_banner_dark_background =  get_post_meta( get_the_ID(), 'ap_dental_implants_bb_dark_background', true );
		$sectionStyle = '';

		if($big_banner_background_image_url) {
			$sectionStyle .= 'background-image:url("'.$big_banner_background_image_url.'")';
		}

		if($big_banner_title) {
			echo '<section class="archpointSection archpointSection--tallerPadding bigBanner text-center bg-darkBlue bg-cover" style='.$sectionStyle.'>';
				echo '<div class="container">';
					echo '<h2 class="bigBanner-title mt0 mb0 pb0">'.$big_banner_title.'</h2>';

					if($big_banner_subtitle) {
						echo '<h3 class="bigBanner-subtitle">'.$big_banner_subtitle.'</h3>';
					}

					if($big_banner_description) {
						echo '<p class="bigBanner-description">'.$big_banner_description.'</p>';
					}

					if($big_banner_button_text && $big_banner_button_url) {
						echo '<div class="bigBanner-buttonwWrapper">';
							echo '<a class="bigBanner-button button button--primaryWhite" href="'.$big_banner_button_url.'">'.$big_banner_button_text.'</a>';
						echo '</div>';
					}

				echo '</div>';
			echo '</section>';
		}
	?>
	<!-- /Big Banner Section -->


	



	<!-- More Information Here Section -->
	<?php
	global $post; // required
	$args = array(
	    'post_type'      => 'post',
	    'post_status'    => 'publish',
	    'posts_per_page' => '6'
	);
	$custom_posts = get_posts($args);
	$number_of_services = count($custom_posts);

	if($number_of_services > 0) {

	    $i = 1; ?>

	    <section class="archpointSection full-width text-center bg-white more-info">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col">
	    			    <div class="content">
	    			        <div class="content-container text-center archpointBlog">
	    						<h2 class="mb50px mt0 more-information">More Information Here</h2>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    <?php

	    echo '<div class="row text-left">';
	    foreach($custom_posts as $post) : setup_postdata($post);

	        $title = get_the_title();
	        $url = get_the_permalink();

	        // Background Image
	        $has_post_thumbnail = false;

	        if (has_post_thumbnail( $post->ID ) ):
	            $has_post_thumbnail = true;
	            $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
	            $image = wp_get_attachment_image($post_thumbnail_id , 'full');
	        endif;?>
	        
	        <div class="col-lg-4 col-xs-12 col-news">
	            <?php get_template_part( 'template-parts/post', 'card' ); ?>
	        </div>

	        <?php
	        	if($i % 3 == 0 && $i != $number_of_services) {echo '</div><div class="row text-left mt50px">';}
	        	if($i == $number_of_services) {echo '</div>';}
	        	$i++;
	    endforeach;
	    wp_reset_postdata();
	
	}?>

			</div>
		</div>
	</section><!-- /archpointSection -->

	<!-- /More Information Here Section -->

	


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
