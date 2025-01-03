<?php



/*
INDEX:

01 - Wp Enqueue Styles and Scripts
02 - Remove sidebar and footer-3 (we don't need them) and custom add sidebars
03 - Child Theme Customizer Options
04 - Allow Guttemberg full width block
05 - Custom Post Types
06 - CMB2
07 - (removed)
08 - Register "Contact" Menu (Goes in the header navbar)
09 - Use modified wp-bootstrap_navwaler in child theme, instead of parent
10 - Limit the excerpt for the post cards descriptions
11 - Add class to body if the navbar is black text
12 - Remove editor for ALL but posts, office and pages that are not using a custom template
13 - Remove unnecesary metaboxes 
14 - Move Yoast metabox to bottom
15 - Add dark nav class to posts
16 - Use the description to include hashtags
17 - Add custom image thumb size ()
18 - retrieves the attachment ID from the file URL
19 - Ajax image load for masonry
20 - Allow webp in media library

*/

/*------------------------------------------------------------------------------------------------*/


// 01 - Wp Enqueue Styles and Scripts

function my_theme_enqueue_styles()
{

	$parent_style = 'Archpoint'; // 

	/*Parent Stylesheet*/
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');

	/*Masonry scripts*/
	wp_enqueue_script('masonry-script', get_stylesheet_directory_uri() . '/scripts/masonry.js', array('jquery'));
	/*Masonry imagesload helper (rearrange grid items if some of them got overlaped)*/
	wp_enqueue_script('masonry-imagesloaded', get_stylesheet_directory_uri() . '/scripts/masonry-images-loaded.js');
	/*isotope scripts*/
	wp_enqueue_script('isotope-script', get_stylesheet_directory_uri() . '/scripts/isotope.pkgd.js', array('jquery'));

	/*Ekko Lightbox*/
	wp_enqueue_script('ekko-lightbox', get_stylesheet_directory_uri() . '/scripts/ekko-lightbox.min.js', array('jquery'));

	/*Archpoint scripts*/
	wp_enqueue_script('archpoint-scripts', get_stylesheet_directory_uri() . '/scripts/archpointid.js', array('jquery', 'wp-bootstrap-starter-themejs', 'masonry-script'));

	/*Google Fonts*/
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800|Source+Sans+Pro:400,700" rel="stylesheet"', false);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

//Custom Stylesheet
function custom_enqueue_styles() {
    // Register the stylesheet
    wp_register_style('custom-style', get_stylesheet_directory_uri() . '/cro-style.css?v='.time(), array() );

    // Enqueue the stylesheet
    wp_enqueue_style('custom-style');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_styles');


/*------------------------------------------------------------------------------------------------*/


// 02 - Remove sidebar and footer-3 (we don't need them) and custom add sidebars

function wp_bootstrap_starter_widgets_init_child()
{

	unregister_sidebar('sidebar-1');
	unregister_sidebar('footer-3');


	//Banner
	register_sidebar(array(
		'name'          => esc_html__('Stop Scrolling Banner', 'wp-bootstrap-starter'),
		'id'            => 'stop-scrolling-banner',
		'description'   => esc_html__('Add widgets here.', 'wp-bootstrap-starter'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	//Office 1
	register_sidebar(array(
		'name'          => esc_html__('Office 1', 'wp-bootstrap-starter'),
		'id'            => 'office-1',
		'description'   => esc_html__('Add widgets here.', 'wp-bootstrap-starter'),
		'before_widget' => '<div class="map">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	//Office 2
	register_sidebar(array(
		'name'          => esc_html__('Office 2', 'wp-bootstrap-starter'),
		'id'            => 'office-2',
		'description'   => esc_html__('Add widgets here.', 'wp-bootstrap-starter'),
		'before_widget' => '<div class="map">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	
}
add_action('widgets_init', 'wp_bootstrap_starter_widgets_init_child', 15);


/*------------------------------------------------------------------------------------------------*/


// 03 - Child Theme Customizer Options

require get_stylesheet_directory() . '/inc/child_customizer.php';


/*------------------------------------------------------------------------------------------------*/


// 04 - Allow Guttemberg full width block: Register support for Gutenberg wide images in your theme

function allow_guttemberg_img_blocks_full_width()
{
	add_theme_support('align-wide');
}
add_action('after_setup_theme', 'allow_guttemberg_img_blocks_full_width');


/*------------------------------------------------------------------------------------------------*/


// 05 - Custom Post Types

function create_post_type()
{

	/*Doctors*/
	register_post_type(
		'doctor',
		array(
			'labels' => array(
				'name' => __('Doctors'),
				'singular_name' => __('Doctor'),
				'add_new_item' => __('Add New Doctor'),
				'search_items' => __('Search Doctors'),
				'edit_item' => __('Edit Doctor'),
				'new_item' => __('New Doctor'),
				'all_items' => __('All Doctors'),
				'view_item' => __('View Doctor'),
				'search_items' => __('Search Doctors'),
				'not_found' =>  __('No doctors found'),
				'not_found_in_trash' => __('No doctors found in Trash'),
				'menu_name' => __('Doctors')
			),
			'public' => true,
			'menu_icon' => 'dashicons-businessman',
			'has_archive' => false,
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
		)
	);

	/*Services*/
	register_post_type(
		'service',
		array(
			'labels' => array(
				'name' => __('Services'),
				'singular_name' => __('Service'),
				'add_new_item' => __('Add New Service'),
				'search_items' => __('Search Services'),
				'edit_item' => __('Edit Service'),
				'new_item' => __('New Service'),
				'all_items' => __('All Services'),
				'view_item' => __('View Service'),
				'search_items' => __('Search Services'),
				'not_found' =>  __('No service found'),
				'not_found_in_trash' => __('No services found in Trash'),
				'menu_name' => __('Services')
			),
			'public' => true,
			'menu_icon' => 'dashicons-admin-tools',
			'has_archive' => false,
			'supports' => array('title', 'author', 'thumbnail', 'excerpt')
		)
	);

	/*Testimonials*/
	register_post_type(
		'testimonial',
		array(
			'labels' => array(
				'name' => __('testimonials'),
				'singular_name' => __('testimonial'),
				'add_new_item' => __('Add New testimonial'),
				'search_items' => __('Search testimonials'),
				'edit_item' => __('Edit testimonial'),
				'new_item' => __('New testimonial'),
				'all_items' => __('All testimonials'),
				'view_item' => __('View testimonial'),
				'search_items' => __('Search testimonials'),
				'not_found' =>  __('No testimonials found'),
				'not_found_in_trash' => __('No testimonials found in Trash'),
				'menu_name' => __('Testimonials')
			),
			'public' => true,
			'menu_icon' => 'dashicons-format-chat',
			'has_archive' => false,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
		)
	);

	/*Offices*/
	register_post_type(
		'office',
		array(
			'labels' => array(
				'name' => __('Offices'),
				'singular_name' => __('Office'),
				'add_new_item' => __('Add New Office'),
				'search_items' => __('Search Offices'),
				'edit_item' => __('Edit Office'),
				'new_item' => __('New Office'),
				'all_items' => __('All Offices'),
				'view_item' => __('View Office'),
				'search_items' => __('Search Offices'),
				'not_found' =>  __('No office found'),
				'not_found_in_trash' => __('No offices found in Trash'),
				'menu_name' => __('Offices')
			),
			'public' => true,
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-admin-multisite',
			'has_archive' => false,
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
		)
	);
}
add_action('init', 'create_post_type');

function my_remove_wp_seo_meta_box()
{
	remove_meta_box('wpseo_meta', "office", 'normal');
	remove_meta_box('wpseo_meta', "testimonial", 'normal');
	remove_meta_box('wpseo_meta', "doctors", 'normal');
}
add_action('add_meta_boxes', 'my_remove_wp_seo_meta_box', 100);


/* Change title default "Enter title here" placeholder */
function wpb_change_title_text($title)
{
	$screen = get_current_screen();

	if ('doctor' == $screen->post_type) {
		$title = 'Enter doctor full name';
	}
	if ('service' == $screen->post_type) {
		$title = 'Enter service name';
	}

	return $title;
}

add_filter('enter_title_here', 'wpb_change_title_text');


/*------------------------------------------------------------------------------------------------*/


// 06 - CMB2

// /*page general settings*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/page-settings.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/page-settings.php';
}

if (file_exists(__DIR__ . '/inc/cmb2/init.php')) {
	require_once __DIR__ . '/inc/cmb2/init.php';
}

/*Services Custom Post Type*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/cpt-services.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/cpt-services.php';
}

/*Offices Custom Post Type*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/cpt-offices.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/cpt-offices.php';
}

/*Doctors Custom Post Type*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/cpt-doctors.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/cpt-doctors.php';
}

/*dental service*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/dental-service.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/dental-service.php';
}

/*mainHeader Module*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/module-mainHeader.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/module-mainHeader.php';
}

/*regular section*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/regular-section.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/regular-section.php';
}

/*home*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/page-home.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/page-home.php';
}

/*why archpoint*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/page-why-archpoint.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/page-why-archpoint.php';
}

/*meet us*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/page-meet-us.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/page-meet-us.php';
}

/*real smiles*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/page-real-smiles.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/page-real-smiles.php';
}

/*request appointment*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/request-appointment.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/request-appointment.php';
}

/*banner header*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/module-banner-header.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/module-banner-header.php';
}

/*patient info*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/patient-info.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/patient-info.php';
}

/*testimonials info*/
if (file_exists(__DIR__ . '/inc/cmb2-custom-metaboxes/cpt-testimonials.php')) {
	require_once __DIR__ . '/inc/cmb2-custom-metaboxes/cpt-testimonials.php';
}

/*------------------------------------------------------------------------------------------------*/



// 07 - CMB2 Backend styling (removed)


/*------------------------------------------------------------------------------------------------*/


// 08 - Register "Contact" Menu (Goes in the header navbar)


function register_contact_menu()
{
	register_nav_menu('contact-menu', __('Contact Menu'));
}
add_action('init', 'register_contact_menu');






/*------------------------------------------------------------------------------------------------*/


// 09 - Use modified wp-bootstrap_navwaler in child theme, instead of parent
// Serch for "archpoint modification" to see the edit

require_once dirname(__FILE__) . '/inc/wp_bootstrap_navwalker.php';




/*------------------------------------------------------------------------------------------------*/


// 10 - Limit the exceprt for the post cards descriptions

function custom_excerpt_length($length)
{
	return 30;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);



/*------------------------------------------------------------------------------------------------*/


// 11 - Add class to body if the navbar is black text

add_filter('body_class', 'custom_class');
function custom_class($classes)
{

	$page_ID = get_queried_object_id();
	$nav_dark_text = false;
	if (get_post_meta($page_ID, 'ap_page_general_settings_nav_text_dark', true)) {
		$nav_dark_text = get_post_meta($page_ID, 'ap_page_general_settings_nav_text_dark', true);
		$classes[] = 'nav-dark-text';
	}
	return $classes;
}



/*------------------------------------------------------------------------------------------------*/


// 12 - Remove editor for ALL but posts, office and pages that are not using a custom template
function reset_editor()
{
	global $_wp_post_type_features;
	$post_types = get_post_types();
	$feature = "editor";
	if (isset($_GET['post'])) {
		$template = get_post_meta($_GET['post'], '_wp_page_template', true);
	} else {
		$template = '';
	}
	foreach ($post_types as $post_type) {
		if (isset($_wp_post_type_features[$post_type])) {
			if (isset($_wp_post_type_features[$post_type][$feature])) {
				if (!($post_type == 'post' || $post_type == 'office')) {
					if (!($template == 'default' || $template == 'patient-info.php' || $template == 'dental-service.php'))
						unset($_wp_post_type_features[$post_type][$feature]);
				}
			}
		}
	}
}

add_action("init","reset_editor");


/*------------------------------------------------------------------------------------------------*/


// 13 - Remove unnecesary metaboxes 

function my_remove_meta_boxes_archpoint()
{

	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		remove_meta_box('linktargetdiv', $post_type, 'normal');
		remove_meta_box('linkxfndiv', $post_type, 'normal');
		remove_meta_box('linkadvanceddiv', $post_type, 'normal');
		if (!($post_type == 'post' || $post_type == 'testimonial')) {
			remove_meta_box('postexcerpt', $post_type, 'normal');
		}
		remove_meta_box('trackbacksdiv', $post_type, 'normal');
		remove_meta_box('postcustom', $post_type, 'normal');
		remove_meta_box('commentstatusdiv', $post_type, 'normal');
		remove_meta_box('commentsdiv', $post_type, 'normal');
		remove_meta_box('authordiv', $post_type, 'normal');
		//remove_meta_box( 'slugdiv', $post_type, 'normal' ); /* this prevents permalink to be changed */
		remove_meta_box('sqpt-meta-tags', $post_type, 'normal');
		delete_user_meta(get_current_user_id(), 'meta-box-order_yourposttype');
	}
}

add_action('admin_menu', 'my_remove_meta_boxes_archpoint');


/*------------------------------------------------------------------------------------------------*/


// 14 - Move Yoast metabox to bottom
function yoasttobottom()
{
	return 'low';
}
add_filter('wpseo_metabox_prio', 'yoasttobottom');


/*------------------------------------------------------------------------------------------------*/


// 15 - Add dark nav class to posts
// 

function add_black_class_to_posts($classes, $class)
{
	global $post;
	if (is_single($post->ID))
		if ($post->post_type == "post" || $post->post_type == "office") {
			$classes[] = 'nav-dark-text';
		}
	return $classes;
}
add_filter("body_class", "add_black_class_to_posts", 10, 2);

// 16 - Use the description to include tags

function prefix_nav_description($item_output, $item, $depth, $args)
{
	if (!empty($item->description)) {

		$item_output = str_replace($item->url, $item->url . '#' . $item->description, $item_output);
	}

	return $item_output;
}
add_filter('walker_nav_menu_start_el', 'prefix_nav_description', 10, 4);


/*------------------------------------------------------------------------------------------------*/


// 16 - Add form to body on gravity form submission success, on the contact page (in order to hide the mainheader title, subtitle, and make the main header shorter)

add_action('gform_after_submission', 'add_confirmation_class', 10, 2);
function add_confirmation_class()
{
	add_filter('body_class', 'add_gravity_classes');
	function add_gravity_classes($classes)
	{
		$classes[] = 'gravity-form-submitted';
		return $classes;
	}
}

/*------------------------------------------------------------------------------------------------*/

// 17 - Add custom image thumb size ()
add_theme_support('post-thumbnails');
add_image_size('thumbnailSmaller', 292, 195, true); // Hard Crop Mode 


// 18 - retrieves the attachment ID from the file URL
function pippin_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}



// 19 - Ajax image load for masonry
add_action('wp_ajax_get_images_ajax_blocks', 'get_images_ajax_blocks');
add_action('wp_ajax_nopriv_get_images_ajax_blocks', 'get_images_ajax_blocks');

function get_images_ajax_blocks()
{
	//global $wpdb; // this is how you get access to the database
	extract($_POST);
	$tour_our_offices_images = get_post_meta($officeId, 'ap_office_list_office_images_rest_api', true);
	$officeImg = '';
	$i = (int)$offset;
	$j = 1;
	foreach ($tour_our_offices_images as $imgId => $url) {

		if ($i < (int)$offset + (int)$posts_per_page && $j > (int)$offset) {
			$large = wp_get_attachment_image_src($imgId, 'large', false);
			$thumb = wp_get_attachment_image_src($imgId, 'thumbnailSmaller', false);
			$officeImg .= '<div class="grid-item" data-style="height:' . $thumb[2] . 'px;">';
			$officeImg .= '<a href="' . $large[0] . '" data-toggle="lightbox" data-gallery="' . $officeId . '">';
			$officeImg .= wp_get_attachment_image($imgId, 'thumbnailSmaller', false);
			$officeImg .= '</a></div>';
			$i++;
		}

		$j++;
	}

	$response['found_posts'] = count($tour_our_offices_images);
	$response['offset'] = (int)$offset;
	$response['posts_per_page'] = (int)$posts_per_page;
	$response['posts'] = $officeImg;
	echo json_encode($response);
	wp_die(); // this is required to terminate immediately and return a proper response
}

/*------------------------------------------------------------------------------------------------*/


/**
 * 20 - Sets the extension and mime type for .webp files.
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
    if ( false !== strpos( $filename, '.webp' ) ) {
        $types['ext'] = 'webp';
        $types['type'] = 'image/webp';
    }

    return $types;
}

//21 - Register Service Navigation
function register_service_navigation_menu() {
    register_nav_menu('service_navigation', __('Service Navigation'));
}
add_action('after_setup_theme', 'register_service_navigation_menu');

//22 - Menu Widget //
// Register the widget
function register_custom_menus_widget() {
    register_widget( 'Custom_Menus_Widget' );
}
add_action( 'widgets_init', 'register_custom_menus_widget' );

// Define the custom widget class
class Custom_Menus_Widget extends WP_Widget {

    // Constructor
    function __construct() {
        parent::__construct(
            'custom_menus_widget',  // Base ID
            esc_html__( 'Custom Menus Widget', 'text_domain' ),  // Widget name
            array( 'description' => esc_html__( 'A widget to display a selected WordPress menu', 'text_domain' ) )  // Args
        );
    }

    // Front-end display of widget
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        // Get selected menu from the widget settings
        $selected_menu = ! empty( $instance['menu'] ) ? $instance['menu'] : false;

        // Display the selected menu
        if ( $selected_menu ) {
            wp_nav_menu( array(
                'menu' => $selected_menu,
                'container' => 'nav',
                'container_class' => 'custom-menu-class',
            ) );
        } else {
            echo 'No menu selected.';
        }

        echo $args['after_widget'];
    }

    // Back-end widget form
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Menu', 'text_domain' );
        $selected_menu = ! empty( $instance['menu'] ) ? $instance['menu'] : '';

        // Get all registered menus
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'menu' ) ); ?>"><?php esc_attr_e( 'Select Menu:', 'text_domain' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'menu' ) ); ?>">
                <option value=""><?php esc_attr_e( 'Select Menu', 'text_domain' ); ?></option>
                <?php
                if ( ! empty( $menus ) ) {
                    foreach ( $menus as $menu ) {
                        echo '<option value="' . esc_attr( $menu->term_id ) . '" ' . selected( $selected_menu, $menu->term_id, false ) . '>' . esc_html( $menu->name ) . '</option>';
                    }
                } else {
                    echo '<option value="">' . esc_html__( 'No menus found', 'text_domain' ) . '</option>';
                }
                ?>
            </select>
        </p>
        <?php
    }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['menu'] = ( ! empty( $new_instance['menu'] ) ) ? strip_tags( $new_instance['menu'] ) : '';
        return $instance;
    }
}

// Add a meta box for menu selection on the "Dental Service" template or the "service" post type
function custom_menu_meta_box() {
    // Get the current post object
    global $post;

    // Check if we are in the admin area and if we have a post object
    if ( is_admin() && $post ) {
        // Get the page template
        $template = get_page_template_slug( $post->ID );

        // Check if the page template is 'dental-service.php' or the post type is 'service'
        if ( 'dental-service.php' === $template || 'service' === $post->post_type ) {
            add_meta_box(
                'custom_menu_meta', // ID of the meta box
                __( 'Select Menu for Page', 'text_domain' ), // Title of the meta box
                'custom_menu_meta_box_callback', // Callback function
                $post->post_type, // Post type where the meta box will appear
                'side' // Context where the meta box will appear (side, normal, advanced)
            );
        }
    }
}
add_action( 'add_meta_boxes', 'custom_menu_meta_box' );

// Callback function for the meta box
function custom_menu_meta_box_callback( $post ) {
    $selected_menu = get_post_meta( $post->ID, '_custom_menu', true );
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

    wp_nonce_field( 'save_custom_menu_meta_box', 'custom_menu_meta_box_nonce' );

    echo '<p><label for="custom_menu_select">' . __( 'Select a Menu:', 'text_domain' ) . '</label></p>';
    echo '<select id="custom_menu_select" name="custom_menu_select">';
    echo '<option value="">' . __( 'Select Menu', 'text_domain' ) . '</option>';

    if ( ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            echo '<option value="' . esc_attr( $menu->term_id ) . '" ' . selected( $selected_menu, $menu->term_id, false ) . '>' . esc_html( $menu->name ) . '</option>';
        }
    } else {
        echo '<option value="">' . __( 'No menus found', 'text_domain' ) . '</option>';
    }

    echo '</select>';
}

// Save the custom meta box data
function save_custom_menu_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['custom_menu_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['custom_menu_meta_box_nonce'], 'save_custom_menu_meta_box' ) ) {
        return;
    }

    if ( isset( $_POST['custom_menu_select'] ) ) {
        $menu_id = sanitize_text_field( $_POST['custom_menu_select'] );
        update_post_meta( $post_id, '_custom_menu', $menu_id );
    }
}
add_action( 'save_post', 'save_custom_menu_meta_box_data' );

// 24 - HTml support
function allow_iframes_in_wysiwyg( $allowedposttags ) {
    $allowedposttags['iframe'] = array(
        'src'             => true,
        'width'           => true,
        'height'          => true,
        'frameborder'     => true,
        'allow'           => true,
        'allowfullscreen' => true,
        'loading'         => true,
        'style'           => true,
    );
    return $allowedposttags;
}
add_filter( 'wp_kses_allowed_html', 'allow_iframes_in_wysiwyg', 1 );


/**
 * Adds webp filetype to allowed mimes
 * 
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 * 
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
function wpse_mime_types_webp( $mimes ) {
    $mimes['webp'] = 'image/webp';

  return $mimes;
}


