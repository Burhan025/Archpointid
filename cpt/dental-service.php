<?php

add_action( 'cmb2_admin_init', 'cmb2_dental_service_metaboxes' );
/*********************************
CMB2 FOR SERVICES
*********************************/
function cmb2_dental_service_metaboxes() {

    /*********************************
    solution 
    *********************************/
    $prefix = 'ap_dental_service_solution_';

    $solution_cmb_main_content = new_cmb2_box(array(
      'id' => $prefix . 'main_content',
      'title' => __('Main Content'),
      'object_types' => array( 'page' ), // Change to 'service' if using a custom post type
      'show_on'       => array( 'key' => 'page-template', 'value' => 'dental-service.php' ),
      'context' => 'advanced',
      'priority' => 'high',
    ));

    /*Background image*/
    $solution_cmb_main_content->add_field( array(
      'name'    => 'Header Background Image',
      'desc'    => 'Upload an image for the header background (if none present, Featured Image will be selected)',
      'id'      => $prefix . 'mh_background_image',
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
    ) );

    /*Introductory title*/
    $solution_cmb_main_content->add_field( array(
      'name'    => 'Introduction Title',
      'desc'    => 'Enter a title the introductory section',
      'id'      => $prefix . 'intro_title',
      'type'    => 'text',
    ));

    /*Introductory description*/
    $solution_cmb_main_content->add_field( array(
      'name'    => 'Introduction Description',
      'desc'    => 'Enter an introductory description for this service',
      'id'      => $prefix . 'intro_description',
      'type'    => 'textarea',
    ) );

  /*********************************
    process 
  *********************************/
    $prefix = 'ap_dental_service_process_';

    $process_cmb = new_cmb2_box(array(
      'id' => $prefix . 'process_involve',
      'title' => __('Process Involves List'),
      'object_types' => array( 'page' ), // Change to 'service' if using a custom post type
      'show_on'       => array( 'key' => 'page-template', 'value' => 'dental-service.php' ),
      'context' => 'advanced',
      'priority'      => 'core',
    ));

    /*Section title*/
    $process_cmb->add_field( array(
      'name'    => 'Section Title',
      'desc'    => 'Enter a title for this section',
      'id'      => $prefix . 'title',
      'type'    => 'text',
    ) );

    $process_cmb_id = $process_cmb->add_field(array(
      'id' => $prefix . 'group_blocks',
      'type' => 'group',
      'options' => array(
          'group_title' => esc_html__('Process Block {#} (up to one image and two list items for this block)'),
          'add_button' => esc_html__('Add Another Process block'),
          'remove_button' => esc_html__('Remove Process block'),
          'sortable' => true,
      ),
    ));

    /*IMAGE*/
    $process_cmb->add_group_field($process_cmb_id, array(
        'name'    => 'Image',
        'desc'    => 'Upload an image related to this process block',
        'id'      => $prefix . 'image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => array(
             'image/gif',
             'image/jpeg',
             'image/png',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );

    /*FIRST ITEM*/
    /*First item title*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'name' => __('Title (First item)'),
      'id' => $prefix . 'first_item_title',
      'type'  => 'text'
    ));
    /*First item description*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'desc'    => 'For adding line breaks, you can use the editor features directly.',
      'name'    => __('Description (First item)'),
      'id'      => $prefix . 'first_item_description',
      'type'    => 'wysiwyg',
      'options' => array(
        'textarea_rows' => 8, // You can change the number of rows if needed
        'media_buttons' => true // Show or hide the media upload button
      ),
    ));
    /*First item see more text*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'name' => __('"See more" text (First item)'),
      'id' => $prefix . 'first_item_see_more_text',
      'type'  => 'text_small'
    ));
    /*First item see more url*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'name' => __('"See more" url (First item)'),
      'id' => $prefix . 'first_item_see_more_url',
      'type'  => 'text_url'
    ));

}
?>