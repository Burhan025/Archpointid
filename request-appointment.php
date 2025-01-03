<?php
/**
* Template Name: Request Appointment
 */

get_header(); ?>
	
	<?php 
		$mainContent = get_the_content();
		if($mainContent) {
	?>

	<section id="primary" class="content-area col-12">
		<main id="main" class="justify-content-around row site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
				?>
				<div class="form-container mb50px col-12 col-lg-10 col-xl-8">
					<div data-paperform-id="7uljhhnw"></div><script>(function() {var script = document.createElement('script'); script.src = "https://paperform.co/__embed.min.js"; document.body.appendChild(script); })()</script>
					</div><?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php } ?>

		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #content -->


<?php

/*-------------------------------------------------------------------------------

"REAL SMILES" BANNER (This page uses the same banner as in the "Real Smiles" page)

-------------------------------------------------------------------------------*/

$show_real_smiles_banner = get_post_meta( get_the_ID(), 'rapointment_page_settings_real_smiles_banner', true);
if($show_real_smiles_banner){
	get_template_part( 'template-parts/banner', 'real-smiles' );
}

?>



<?php
get_footer();