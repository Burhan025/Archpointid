  <?php   

          $page_ID = get_the_ID();

          // For displaying the mainHeader settings for the page used for the blog
          if( is_home() && get_option( 'page_for_posts' ) ) { 
            $page_ID = get_option( 'page_for_posts' ); 
          }

          $mainHeaderCssClasses = 'desktop d-flex align-items-center ';
          $titleCssClasses = '';
          $subtitleCssClasses = '';

          $hideMainHeader = get_post_meta( $page_ID, 'ap_mainHeader_hide', true );
          $title = get_the_title($page_ID);
          $titleAlternative = get_post_meta( $page_ID, 'ap_mainHeader_title', true );
          $mainHeader_subtitle = get_post_meta( $page_ID, 'ap_mainHeader_subtitle', true );
          $mainHeader_subhead = get_post_meta( $page_ID, 'ap_mainHeader_subhead', true );
          $buttons_group = get_post_meta( get_the_ID(), 'ap_mainHeader_buttons_group', true );
          $icons_group = get_post_meta( get_the_ID(), 'ap_mainHeader_icons_group', true );
          $mainHeader_bg_color = get_post_meta( $page_ID, 'ap_mainHeader_bg_color', true );
          $mainHeader_background_image_url = get_post_meta( $page_ID, 'ap_mainHeader_background_image', true );
          $mainHeader_bg_repeat = get_post_meta( $page_ID, 'ap_mainHeader_bg_repeat', true );
          $mainHeader_white_text = get_post_meta( $page_ID, 'ap_mainHeader_white_text', true );
          $half_width_left_aligned = get_post_meta( $page_ID, 'ap_mainHeader_half_width_left_aligned', true );
          $hero_header = get_post_meta( $page_ID, 'ap_mainHeader_hero_header', true );
          $content_below_mobile =  get_post_meta( $page_ID, 'ap_mainHeader_content_below_mobile', true );      

          if(!$hideMainHeader) {
          
            /*if 'titleAlternative' is present, it overrides the default page title*/
            if($titleAlternative) {
              $title = $titleAlternative;
            }
            /*mainHeader classes*/
            if($hero_header) {
              $mainHeaderCssClasses .= ' mainHeader--hero ';
            }
            if($mainHeader_background_image_url) {
              $mainHeaderCssClasses .= ' has-bgimage ';
            }
            if($mainHeader_white_text && $mainHeader_background_image_url) {
              // white text option is only applicable if a background image has been set. Else white text will be
              // automatically applied for dark colored background (darkblue, and skyblue) 
              $mainHeaderCssClasses .= ' color-white ';
            }
            if($half_width_left_aligned) {
              $mainHeaderCssClasses .= ' text-left ';          
            }
            if(!$mainHeader_background_image_url) {
              if($mainHeader_bg_color == 'white-blue') {
                $mainHeaderCssClasses .= ' bg-whiteBlue ';          
              } else if ($mainHeader_bg_color == 'sky-blue') {
                $mainHeaderCssClasses .= ' bg-skyBlue color-white ';  
              } else if ($mainHeader_bg_color == 'dark-blue') {
                $mainHeaderCssClasses .= ' bg-darkBlue color-white ';  
              } else if ($mainHeader_bg_color == 'standard'){
                $mainHeaderCssClasses .= ' bg-white ';   
              } else if ($mainHeader_bg_color == 'transparent'){
                $mainHeaderCssClasses .= ' bg-transparent ';   
              }
            }
            if($mainHeader_bg_repeat) {
              $mainHeaderCssClasses .= ' bg-repeat ';
            }

            /*mainHeader container classes*/
            $mainHeaderContainerClasses = 'mainHeader-container container ';
            if($content_below_mobile){
              $mainHeaderContainerClasses .= ' d-none d-md-block ';
            }

            /*title class (if header is hero type, h1 should look like h1, if not like h2*/
            if(!$hero_header) {
              $titleCssClasses .= ' h2 ';          
            }
            /*subtitle class (if header is hero type, subtitle should look like h3, if not like p*/
            if($hero_header) {
              $subtitleCssClasses .= ' h3 ';          
            }
            ?>


<?php if($mainHeader_background_image_url){
				if(wp_is_mobile()){
					$mainHeader_background_image_url = wp_get_attachment_image_src(get_post_meta( $page_ID, 'ap_mainHeader_background_image_id', true ), 'medium');
				}else{
					$mainHeader_background_image_url = wp_get_attachment_image_src(get_post_meta( $page_ID, 'ap_mainHeader_background_image_id', true ), 'full');
				}
} ?>



            <!-- Desktop header -->
            <header class="mainHeader <?php echo $mainHeaderCssClasses; if($hero_header){echo 'animated fadeInUp duration1';}?>" <?php if($mainHeader_background_image_url) echo  'style="background-image:url('.$mainHeader_background_image_url[0].')"';  ?>  >
                <div class="<?php echo $mainHeaderContainerClasses; ?>">
                      
                  <?php
                    if($half_width_left_aligned) {
                      echo '<div class="col-lg-6 col-sm-6 col-md-11">';
                    } else {
                      echo '<div class="col">';
                    }
                  ?>
                  
                    <?php
                        /*Yoast breadcrumbs*/ 
                        if ( function_exists('yoast_breadcrumb') ) {
                          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        }
                    ?>
                    
                    <!-- Title -->
                    <h2 class="h1 mainHeader-title animated fadeInDown duration1 <?php echo $titleCssClasses;?>"><?php echo $title; ?></h2>

                    <?php /*Icons*/
                        if($icons_group) {

                          echo '<div class="iconsRow d-flex justify-content-between">';
                          $delay=2;

                          foreach ($icons_group as $icon) {

                            $icon_image = $icon["ap_mainHeader_icon_image_id"];
                            $icon_title = $icon["ap_mainHeader_icon_title"];
                            $icon_short_desc = $icon["ap_mainHeader_icon_short_desc"];
                            $icon_url = $icon["ap_mainHeader_icon_url"];
                            $delay++;

                            if( isset($icon["ap_mainHeader_icon_title"]) && isset($icon["ap_mainHeader_icon_image"])) {
                              echo '<div class="iconItem animated fadeInDown duration1 delay'.$delay.'">
                                      <div class="iconItem-image">
                                       '.wp_get_attachment_image($icon_image, '', "true", array( "class"=>"","title"=> $icon_title,"alt"=> $icon_title)).'
                                      </div>
                                      <div class="iconItem-textContainer">
                                      <a href="'.$icon_url.'">
                                        <h3 class="iconItem-title">'.$icon_title.'</h3>
                                        <h4 class="iconItem-shortDescription">'.$icon_short_desc.'</h4>
                                        </a>
                                      </div>
                                    </div>';
                            }
                          }

                          echo '</div>';

                        }
                    ?>

                    <?php /*Subtitle*/
                        if($mainHeader_subtitle) {
                            echo '<p class="mainHeader-subtitle '.$subtitleCssClasses.'">'.$mainHeader_subtitle.'</p>';
                        }
                    ?>

                    <?php /*Subhead*/
                        if($mainHeader_subhead) {
                            echo '<p class="mainHeader-subHead">'.$mainHeader_subhead.'</p>';
                        }
                    ?>

                    <?php /*Buttons*/
                        if($buttons_group) {

                          $botNumber=0;
                          foreach ($buttons_group as $button) {
                            
                            if( isset($button["ap_mainHeader_button_text"]) && isset($button["ap_mainHeader_button_url"]) && $button["ap_mainHeader_button_url"] != '') {
                              $botNumber++;
                              $buttonClasses = '';
                              if($button["ap_mainHeader_button_style"] == 'primary'){
                                $buttonClasses .= ' button--primary';
                              } else if($button["ap_mainHeader_button_style"] == 'secondary'){
                                $buttonClasses .= ' button--secondary';
                              } else if ($button["ap_mainHeader_button_style"] == 'primary-white'){
                                $buttonClasses .= ' button--primaryWhite';
                              } else if ($button["ap_mainHeader_button_style"] == 'secondary-white'){
                                $buttonClasses .= ' button--secondaryWhite';
                              } 

                              $buttonClasses .= ' animated push delay'.(7+$botNumber).' duration1 ';

                              echo '<a href="'.$button["ap_mainHeader_button_url"].'" class="button '.$buttonClasses.'">'.$button["ap_mainHeader_button_text"].'</a>';
                            }
                          }
                        }
                    ?>

                  </div><!-- /.col -->
                </div><!-- /.container -->
            </header>

            
            <?php if($content_below_mobile) { ?>
            <!-- Mobile header (only title, subtitule, and buttons) -->
            <header class="mainHeader mobile d-md-none">
                <div class="mainHeader-container container">
                    <div class="row">
                      <div class="col">
                      
                        <!-- Title -->
                        <h1 class="mainHeader-title animated fadeInDown duration1 <?php echo $titleCssClasses;?>"><?php echo $title; ?></h1>

                        <?php /*Subtitle*/
                            if($mainHeader_subtitle) {
                                echo '<p class="mainHeader-subtitle '.$subtitleCssClasses.'">'.$mainHeader_subtitle.'</p>';
                            }
                        ?>

                        <?php /*Buttons*/
                            if($buttons_group) {
                              foreach ($buttons_group as $button) {
                                
                                if( isset($button["ap_mainHeader_button_text"]) && isset($button["ap_mainHeader_button_url"])) {

                                  echo '<a href="'.$button["ap_mainHeader_button_url"].'" class="button button--primary">'.$button["ap_mainHeader_button_text"].'</a>';
                                }
                              }
                            }
                        ?>
                        
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.col -->
                </div><!-- /.container -->
            </header>
            <?php }

          } //$hideMainHeader ?>