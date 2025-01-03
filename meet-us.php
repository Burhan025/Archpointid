<?php
/**
 * Template Name: Meet Us
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>


		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #content -->


<?php
$page_ID = get_the_ID(); 

/*---------------------------------

SECTION INTRO

----------------------------------*/

// ap_meet_us_intro_

$hide_intro = get_post_meta( $page_ID, 'ap_meet_us_intro_hide', true);
$title_intro = get_post_meta( $page_ID, 'ap_meet_us_intro_title', true);
$description_intro = get_post_meta( $page_ID, 'ap_meet_us_intro_description', true);

if(!$hide_intro) { ?>

<section class="archpointSection intro bg-whiteGrey animated fadeInUp duration1">
	<div class="container">
		<?php if($title_intro) {
			echo '<div class="row">';
			echo '<div class="col-md-10 offset-md-1">';
			echo '<h2 class="title mt0 h3 text-center">'.$title_intro.'</h2>';
			echo '</div>';
			echo '</div>';
		} ?>
		<?php if($description_intro) {
			echo '<div class="row">';
			echo '<div class="col-md-10 offset-md-1">';
			echo '<p class="description">'.$description_intro.'</p>';
			echo '</div>';
			echo '</div>';
		} ?>
	</div>
</section>

<?php } ?>









<?php 

/*---------------------------------

DOCTORS SECTION

----------------------------------*/

global $post; // required
$args = array(
    'post_type'      => 'doctor',
    'post_status'    => 'publish',
	'numberposts'    => -1,
    
    'meta_query'=> array(
        array(
            'key' => 'ap_doctor_metadata_meet_us', // this key will change!
            'compare' => '==',
            'value' => 'on',
        )
    ),
    'meta_key' => 'ap_doctor_metadata_meet_us',
    
);

$doctors = get_posts($args);
$number_of_doctors = count($doctors);

if($number_of_doctors > 0) {

	$counter = 0;

	echo '<section class="archpointSection doctors bg-white">';
	echo '<div class="container container--extended">';

	foreach($doctors as $doctor) : setup_postdata($doctor);

		$counter++;
		$id = $doctor->ID;
		
		$url=get_permalink($id);
		$permalink=str_replace( home_url().'/doctor/', "", $url );
		$permalink=str_replace( '/', "", $permalink );

		$full_name = get_post_meta( $id, 'ap_doctor_metadata_full_name', true);
		if($full_name == '') {
			$full_name = $doctor->post_title;
		}
		$academic_titles = get_post_meta( $id, 'ap_doctor_metadata_academic_titles', true);
		$short_description = get_post_meta( $id, 'ap_doctor_metadata_short_description', true);
		$biography = get_post_meta( $id, 'ap_doctor_metadata_bio', true);

		// Video
		$youtube_video_url = get_post_meta( $id, 'ap_doctor_metadata_youtube_url', true);
		$alternative_image_id = get_post_meta( $id, 'ap_doctor_metadata_alternative_image_id', true);
		$lastSlashPos = strripos($youtube_video_url, '/') + 1;
		$videoURLClean = substr($youtube_video_url, $lastSlashPos);

		$appointment_button_text = get_post_meta( $id, 'ap_doctor_metadata_appointment_text', true);
		$appointment_button_url = get_post_meta( $id, 'ap_doctor_metadata_appointment_url', true);

		$special_mention = get_post_meta( $id, 'ap_doctor_metadata_special_mention', true);
		$special_mention_logo_id = get_post_meta( $id, 'ap_doctor_metadata_special_mention_logo_id', true);

		$titlesContainerClasses = '';
		if($special_mention && $special_mention_logo_id){
			$titlesContainerClasses .= ' ml30px ';
		}
		$bioClasses = '';
		if($youtube_video_url || $alternative_image) {
			$bioClasses .= '-xl-6';
		}
		$testimonialClasses = '';
		if(!$biography) {
			$testimonialClasses .= ' offset-md-3';
		}
		
		if($full_name){ //Full name is required to display doctor information ?>

		<article class="doctor" id="<?php echo $permalink ?>">
			<header class="d-flex justify-content-start align-items-center mb40px animated fadeInDown duration1 eds-on-scroll">
				<?php if($special_mention && $special_mention_logo_id){ 
					echo '<div class="specialMentionLogoContainer">';
					echo wp_get_attachment_image($special_mention_logo_id, "", "", array("class"=> 'specialMentionLogo',"title"=> 'Special Mention',"alt"=>'Special Mention'));
					echo '</div>'; 
				} ?>
				<div class="titlesContainer <?php echo $titlesContainerClasses; ?>">
					<h2 class="fullName mt0 mb0 pb0">
						<?php
							echo $full_name;
							if($academic_titles){
								foreach ($academic_titles as $academic_title) {
									echo ", ".strtoupper($academic_title);
								}
							}
						?>
						
					</h2>
					<?php if($short_description){ echo '<h3 class="shortDescription">'.$short_description.'</h3>';} ?>			
				</div>
			</header>
			
			<?php if($biography || $youtube_video_url || $alternative_image_id || $appointment_button_text || $appointment_button_url) { ?>
			<div class="doctorMain">
				<div class="row <?php if($counter % 2 == 0){echo 'flex-row-reverse';} ?>">
					<?php if($youtube_video_url || $alternative_image_id || $appointment_button_text || $appointment_button_url) { ?> 
					<div class="col-xl-6 video <?php echo $testimonialClasses; ?> animated fadeInRight delay1 duration1 eds-on-scroll">
						<div class="videoWrapper aa">
							<?php 
								if($youtube_video_url) { ?>
									<iframe width="560" height="349" src="http://www.youtube.com/embed/<?php echo $videoURLClean; ?>?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
								<?php }
								if($alternative_image_id && !$youtube_video_url) {
									echo wp_get_attachment_image( $alternative_image_id, 'large', "");
								}?>
								<?php if($appointment_button_text && $appointment_button_url) { ?>
									<a class="appt-btn" href="<?php echo $appointment_button_url; ?>">
										<?php echo $appointment_button_text; ?>
									</a>
								<?php }
							?>
						</div>
					</div>
					<?php } ?>
					<?php if($biography) { ?>
					<div class="bio col<?php echo $bioClasses; ?>  animated fadeInRight duration1 eds-on-scroll">
						<?php echo $biography; ?>
					</div>
					<?php } ?>
					
					

				</div>
			</div>
			<?php } ?>

		</article>

		<?php } ?>

	<?php endforeach;

	echo '</section>';
	echo '</div>';
} ?>







<?php 


/*---------------------------------

SMILE TRANSFORMATIONS SECTION

----------------------------------*/

$hide_section = get_post_meta( $page_ID, 'ap_meet_us_st_hide', true);
$section_main_title = get_post_meta( $page_ID, 'ap_meet_us_st_section_title', true);
$section_button_text = get_post_meta( $page_ID, 'ap_meet_us_st_button_text', true);
$section_button_url = get_post_meta( $page_ID, 'ap_meet_us_st_button_url', true);

if(!$hide_section && $section_main_title) { 

	echo '<section style="margin-top: 30px;"  class="archpointSection smilesTransformation bg-darkBlue animated fadeInUp duration1 eds-on-scroll">';
		echo '<div class="container mb40px">';
		echo '<div class="row">';
		echo '<div class="col-md-8 offset-md-2">';
			if($section_button_text && $section_button_url) { echo '<header class="text-center">'; }
				echo '<h2 class="title mt0">'.$section_main_title.'</h2>';
			if($section_button_text && $section_button_url) {
				echo '<a href="'.$section_button_url.'" class="button button--secondaryWhite">'.$section_button_text.'</a>';
				echo '</header>';
			}
		echo '</div>'; //close container;
		echo '</div>'; //close col-md-6;
		echo '</div>'; //close row;

		$args = array(
		    'meta_query' => array(
		        array(
		            'key' => 'ap_testimonial_meet',
		            'value' => 'on',

		        )
		    ),
		    'post_type' => 'testimonial',
		    'posts_per_page' => -1
		);
		
		$testimonials = get_posts($args);

	    if(!empty($testimonials)) {

	      echo '<div class="container">';
	      echo '<div class="row">';

	          	echo '<div id="carouselTestimonials" class="carousel carousel--carouselShrinked carousel--carouselLightArrows slide" data-ride="carousel">';
	          		echo '<div class="carousel-inner">';

	          		$testimonialsCounter = 1;
	              	foreach ($testimonials as $testimonial) {
	              		$score =  get_post_meta( $testimonial->ID, 'ap_testimonial_score', true);
						?>

						<div class="carousel-item <?php if($testimonialsCounter == 1){echo 'active';} ?>">
							<div class="row">
								<div class="col-lg-5 col-xs-12 content text-left d-flex align-items-center">
									<div class="innerContainer">	
										<div class="stars">
											<?php for($i=1;$i<=$score;$i++){echo '<span class="icon-star"></span>';} ?>
										</div>
										<h3 class="testimonial-title mt0"><?php echo $testimonial->post_title; ?></h3>
											<p class="testimonial-description">
												<?php echo $testimonial->post_excerpt; ?>
											</p>
									</div>
								</div>
								<div class="col-lg-7 col-xs-12 photo">
									<div class="photoWrapper">
									    <?php echo get_the_post_thumbnail($testimonial->ID, "medium", array("title"=> $testimonial->post_title,"alt"=> $testimonial->post_title, 'class'=>'not-lazy')); ?>
									</div>
								</div>
							</div>
						</div>

					<?php 
					$testimonialsCounter++;
	              	}; //close foreach

	              	wp_reset_postdata();

	              
	            	echo '</div>'; ?>
				<?php if($testimonialsCounter!=2){ ?>
				<a class="carousel-control-prev" href="#carouselTestimonials" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselTestimonials" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>

	            <?php } echo '</div>';

	      echo '<div class="container">';
	      echo '<div class="row">';

	      } // close ap_meet_us_st_testimonials_group 

	echo '</section>'; 

}


	

get_footer();

?>