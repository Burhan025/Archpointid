<?php

add_action( 'cmb2_admin_init', 'cmb2_mainHeader_metaboxes' );
function cmb2_mainHeader_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'ap_mainHeader_';

    $mainHeader_cmb = new_cmb2_box( array(
        'id'            => $prefix . 'header',
        'title'         => __( 'Main Header', 'cmb2' ),
        'object_types'  => array( 'page'), // Post type
        'context'       => 'normal',
        'priority'      => 'core',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );


    /*Hide*/
    $mainHeader_cmb->add_field( array(
      'name'    => 'Hide',
      'desc'    => 'Check if you want to hide the Main Header on this page',
      'id'      => $prefix . 'hide',
      'type'    => 'checkbox',
    ) );

    /*Title*/
    $mainHeader_cmb->add_field( array(
      'name'    => 'Title',
      'desc'    => 'Enter an optional title (will substitue the main page title) ',
      'id'      => $prefix . 'title',
      'type'    => 'text',
    ) );

    /*Subtitle*/
    $mainHeader_cmb->add_field( array(
      'name'    => 'Subtitle',
      'desc'    => 'Enter an optional subtitle',
      'id'      => $prefix . 'subtitle',
      'type'    => 'text',
    ) );

    /*Subhead*/
    $mainHeader_cmb->add_field( array(
      'name'    => 'Subhead',
      'desc'    => 'Enter an optional subhead',
      'id'      => $prefix . 'subhead',
      'type'    => 'textarea',
    ) );


    /*Button group*/
    $mainHeader_cmb_buttons = $mainHeader_cmb->add_field(array(
      'id' => $prefix . 'buttons_group',
      'type' => 'group',
      'options' => array(
          'group_title' => esc_html__('Button {#}'),
          'add_button' => esc_html__('Add Another Button'),
          'remove_button' => esc_html__('Remove Button'),
          'sortable' => true,
      ),
    ));
    /*Button name*/
    $mainHeader_cmb->add_group_field($mainHeader_cmb_buttons, array(
      'name' => __('Button text'),
      'desc' => 'Enter the text for the button (required)',
      'id' => $prefix . 'button_text',
      'type' => 'text',
    ));
    /*Button link*/
    $mainHeader_cmb->add_group_field($mainHeader_cmb_buttons, array(
      'name' => __('Button url'),
      'desc' => 'Enter the button url (required)',
      'id' => $prefix . 'button_url', 
      'type' => 'text',
    ));
    /*Button style*/
    $mainHeader_cmb->add_group_field($mainHeader_cmb_buttons, array(
      'name' => __('Button style'),
      'desc' => 'Select button style',
      'id' => $prefix . 'button_style',
      'type'    => 'radio_inline',
        'options' => array(
          'primary' => __( 'Primary (Standard)', 'cmb2' ),
          'secondary'   => __( 'Secondary', 'cmb2' ),
          'primary-white'     => __( 'Primary White', 'cmb2' ),
          'secondary-white'     => __( 'Secondary White', 'cmb2' ),
        ),
        'default' => 'primary',
    ));


    /*Icons group*/
    $mainHeader_cmb_icons = $mainHeader_cmb->add_field(array(
      'id' => $prefix . 'icons_group',
      'type' => 'group',
      'options' => array(
          'group_title' => esc_html__('Icon {#}'),
          'add_button' => esc_html__('Add Another Icon'),
          'remove_button' => esc_html__('Remove Icon'),
          'sortable' => true,
      ),
    ));
    /*Icon Image*/
    $mainHeader_cmb->add_group_field($mainHeader_cmb_icons, array(
      'name'    => 'Icon Image',
      'desc'    => 'Upload the icon image. Optimum size: 100px x 100px (required)',
      'id'      => $prefix . 'icon_image',
      'type'    => 'file',
      // Optional:
      'options' => array(
        'url' => false, // Hide the text input for the url
      ),
      'text'    => array(
        'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
      ),
      // query_args are passed to wp.media's library query.
      'query_args' => array(
        //'type' => 'application/pdf', // Make library only display PDFs.
        // Or only allow gif, jpg, or png images
        // 'type' => array(
          'image/gif',
          'image/jpeg',
          'image/png',
        // ),
      ),
      'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));
    /*Icon title*/
    $mainHeader_cmb->add_group_field($mainHeader_cmb_icons, array(
      'name' => __('Icon title'),
      'desc' => 'Enter the text for the icon (required)',
      'id' => $prefix . 'icon_title',
      'type' => 'text',
    ));
    /*Icon description*/
    $mainHeader_cmb->add_group_field($mainHeader_cmb_icons, array(
      'name' => __('Icon short description'),
      'desc' => 'Enter a short description (between one and four words long)',
      'id' => $prefix . 'icon_short_desc', 
      'type' => 'text',
    ));
    /*Icon url*/
    $mainHeader_cmb->add_group_field($mainHeader_cmb_icons, array(
      'name' => __('Icon url'),
      'desc' => 'Enter a url for short description',
      'id' => $prefix . 'icon_url',
      'type'  => 'text_url',
    ));


    /*Background color*/
    $mainHeader_cmb->add_field( array(
      'name' => __('Background Color'),
      'desc' => 'Select a background color (only visible if background image is not defined)',
      'id' => $prefix . 'bg_color',
      'type'    => 'radio_inline',
        'options' => array(
          'standard' => __( 'White (Standard)', 'cmb2' ),
          'white-blue'   => __( 'White Blue', 'cmb2' ),
          'sky-blue'   => __( 'Sky Blue', 'cmb2' ),
          'dark-blue'     => __( 'Dark Blue', 'cmb2' ),
          'transparent'     => __( 'Transparent', 'cmb2' ),
        ),
        'default' => 'standard'
    ) );

    /*Background image*/
    $mainHeader_cmb->add_field( array(
      'name'    => 'Background Image',
      'desc'    => 'Upload a hero background image.',
      'id'      => $prefix . 'background_image',
      'type'    => 'file',
      // Optional:
      'options' => array(
        'url' => false, // Hide the text input for the url
      ),
      'text'    => array(
        'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
      ),
      // query_args are passed to wp.media's library query.
      'query_args' => array(
        //'type' => 'application/pdf', // Make library only display PDFs.
        // Or only allow gif, jpg, or png images
        // 'type' => array(
          'image/gif',
          'image/jpeg',
          'image/png',
        // ),
      ),
      'preview_size' => 'medium', // Image size to use when previewing in the admin.
    ) );

    /*Repeat background image*/
    $mainHeader_cmb->add_field( array(
      'name' => 'Repeat Background Image',
      'desc' => 'Check this if you set a background image that is a pattern (leave unchecked if you set a background photo)',
      'id'   => $prefix . 'bg_repeat',
      'type' => 'checkbox',
    ) );

    /*White text*/
    $mainHeader_cmb->add_field( array(
      'name' => 'White text',
      'desc' => 'Check for white text on the Main Header (only applicable if you defined a background image)',
      'id'   => $prefix . 'white_text',
      'type' => 'checkbox',
    ) );

    /*Left aligned*/
    $mainHeader_cmb->add_field( array(
      'name' => 'Left aligned and Half Width',
      'desc' => 'Check for the content to span half the width, and be left aligned (optional)',
      'id'   => $prefix . 'half_width_left_aligned',
      'type' => 'checkbox',
    ) );

    /*Hero Header*/
    $mainHeader_cmb->add_field( array(
      'name' => 'Make Hero Header',
      'desc' => 'Check for the header to be a Hero type (Full screen, Big tittle, and no breadcrumbs)',
      'id'   => $prefix . 'hero_header',
      'type' => 'checkbox',
    ) );

    /*Content below mobile*/
    $mainHeader_cmb->add_field( array(
      'name' => 'Content below on mobile',
      'desc' => 'Check if you want the content to appear below the main header, and not inside in mobile devices',
      'id'   => $prefix . 'content_below_mobile',
      'type' => 'checkbox',
    ) );


}
?>