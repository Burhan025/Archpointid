<?php
/**
* Template Name: Patient Info 
 */

get_header(); ?>

		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #content -->

	<?php $id = get_the_id(); ?>


	<?php /*LIST OF STEPS SECTION*/
	$hide = get_post_meta( get_the_ID(), 'ap_patient_info_list_of_steps_hide', true );
	$group_steps = get_post_meta( get_the_ID(), 'ap_patient_info_list_of_steps_group', true );

	if(!$hide && $group_steps) { ?>
	<section class="archpointSection zigZagBigImgRows arc-box">
		<div class="container">
			
			<?php
			$counter = 1;

			foreach ($group_steps as $step) {

				/*title*/
				$title = false;
				if(isset($step["ap_patient_info_list_of_steps_title"])) {
					$title = $step["ap_patient_info_list_of_steps_title"];
				}

				/*description*/
				$description = false;
				if(isset($step["ap_patient_info_list_of_steps_text_description"])) {
					$description = $step["ap_patient_info_list_of_steps_text_description"];
				}

				/*image*/
				$image_id = false;
				$image = '<img src="/wp-content/themes/archpoint-child/branding/dummy-photo-640x360.jpg" alt="dummy image">';
				if(isset($step["ap_patient_info_list_of_steps_image_id"])) {
					$image_id = $step["ap_patient_info_list_of_steps_image_id"];
					$image = wp_get_attachment_image($image_id , 'medium');
				}

				if($title || $description) {

					$rowClasses = 'row d-flex align-items-center ';
					if($counter %2 == 0) {
						$rowClasses .= ' flex-row-reverse ';
					}

					echo '<div class="'.$rowClasses.'">';
						echo '<div class="text col-lg-6 col-xs-12 rowText">';

							if($counter %2 == 0) {
								echo '<div class="d-flex align-items-center"><span class="circle color-white"><p>'.$counter.'</p></span></div>';
							}
							if($title) {
								echo '<h3 class="title mt0">'.$title.'</h3>';
							}
							if($description) {
								echo '<p>'.$description.'</p>';
							}

						echo '</div>'; ?>

						<!-- Image -->
						<div class="col-lg-6 col-xs-12 rowImage">
							<?php 
							if($counter %2 != 0) {
								echo '<div class="d-flex align-items-center"><span class="circle color-white"><p>'.$counter.'</p></span></div>';
							}
							echo $image;
							?> 				
						</div>
					</div><!-- /.row -->
				<?php $counter++; } //if($title || $description) ?>

			<?php } // foreach ($group_steps as $step) ?>
				
		</div>
	</section>
	<?php } ?>







	<?php
	/*PDF SECTION*/
	$number_fill_pdf_methods = 0;
	$hide = get_post_meta( get_the_ID(), 'ap_patient_info_hide', true );
	$title = get_post_meta( get_the_ID(), 'ap_patient_info_title', true );
	$subtitle = get_post_meta( get_the_ID(), 'ap_patient_info_subtitle', true );

	/*Complete Online*/
	$co_title = get_post_meta( get_the_ID(), 'ap_patient_info_co_title', true );
	$co_link_description = get_post_meta( get_the_ID(), 'ap_patient_info_co_link_description', true );
	$co_link_url = get_post_meta( get_the_ID(), 'ap_patient_info_co_link_URL', true );
	if($co_title && $co_link_description && $co_link_url){
		$number_fill_pdf_methods++;
	}

	/*Download and Print*/
	$dp_title = get_post_meta( get_the_ID(), 'ap_patient_info_dp_title', true );
	$dp_link_description = get_post_meta( get_the_ID(), 'ap_patient_info_dp_link_description', true );
	$dp_link_url = get_post_meta( get_the_ID(), 'ap_patient_info_dp_link_URL', true );
	if($dp_title && $dp_link_description && $dp_link_url){
		$number_fill_pdf_methods++;
	}

	if( !$hide && ($title || $subtitle) && $number_fill_pdf_methods != 0 ) { ?>

	<section class="archpointSection bg-darkBlue">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<?php if($title) { echo '<h1 class="title h2">'.$title.'</h1>';} ?>
					<?php if($subtitle) { echo '<p class="text-center h2-subtitle mb0">'.$subtitle.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<ul class="iconList iconList--medium iconList--half text-left mt100px">

						<?php 
						$liClasses = 'iconList-item color-before-whiteBlueStronger mb0 ';
						if($number_fill_pdf_methods == 1){
							$liClasses .= 'd-block floatNone center-block';
						}
						?>
						
						<?php //Complete Online
						if($co_title && $co_link_description && $co_link_url) { ?>
							<li class="icon-computer <?php echo $liClasses; ?>">
								<span class="iconList-title h3 mt0"><?php echo $co_title; ?></span>
								<span class="iconList-text"><a href="<?php echo $co_link_url; ?>" class="color-white white-btn"><?php echo $co_link_description; ?></a></span>
							</li>
						<?php } ?>

						<?php //Download and Print
						if($dp_title && $dp_link_description && $dp_link_url) { ?>
							<li class="icon-print <?php echo $liClasses; ?>">
								<span class="iconList-title h3 mt0"><?php echo $dp_title; ?></span>
								<span class="iconList-text"><a href="<?php echo $dp_link_url; ?>" class="color-white white-btn"><?php echo $dp_link_description; ?></a></span>
							</li>
						<?php } ?>

					</ul>
				</div>
				
				
			</div>
		</div>
	</section>

	<?php } ?>

	<?php 
		$mainContent = get_the_content();
		if($mainContent) {
	?>
	<section id="primary" class="content-area col-12 archpointSection">
		<main id="main" class="site-main mt0 mb0" role="main">
			<div class="container">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->
	<?php } ?>

<?php
get_footer();
