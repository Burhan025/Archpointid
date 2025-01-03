<?php

add_action( 'cmb2_admin_init', 'cmb2_service_metaboxes' );
    /*********************************
    CMB2 FOR SERVICES
    *********************************/
function cmb2_service_metaboxes() {


    /*-----------------------------------------------------------


                      S I N G L E   S E R V I C E 


    -----------------------------------------------------------*/



    /*********************************
    solution 
    *********************************/
    $prefix = 'ap_service_solution_';

    $solution_cmb_main_content = new_cmb2_box(array(
      'id' => $prefix . 'main_content',
      'title' => __('Main Content'),
      'object_types' => array('service'),
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
    
    $solution_cmb = new_cmb2_box(array(
      'id' => $prefix . 'best_solutions',
      'title' => __('Best Solutions List'),
      'object_types' => array('service'),
      'context' => 'advanced',
      'priority'      => 'core',
    ));

    /*Section title*/
    $solution_cmb->add_field( array(
      'name'    => 'Section Title',
      'desc'    => 'Enter a title for this section',
      'id'      => $prefix . 'title',
      'type'    => 'text',
    ) );

    $solution_block_id = $solution_cmb->add_field(array(
      'id' => $prefix . 'group',
      'type' => 'group',
      'options' => array(
          'group_title' => esc_html__('Solution {#}'),
          'add_button' => esc_html__('Add Another Solution'),
          'remove_button' => esc_html__('Remove Solution'),
          'sortable' => true,
      ),
    ));

    /*Solution Name (for each one)*/
    $solution_cmb->add_group_field($solution_block_id, array(
      'name' => __('Solution Title'),
      'id' => $prefix . 'item_title',
      'type' => 'text',
    ));

    $solution_cmb->add_group_field($solution_block_id, array(
      'name' => __('Solution Icon'),
      'desc'    => 'Enter the name of one of the <a href="/wp-content/themes/archpoint-child/fonts/archpoint-iconmoon-font/demo.html" target="_new">following icons</a>',
      'id' => $prefix . 'item_icon',
      'type' => 'text_small'
    ));



    /*********************************
    process 
    *********************************/
    $prefix = 'ap_service_process_';

    $process_cmb = new_cmb2_box(array(
      'id' => $prefix . 'process_involve',
      'title' => __('Process Involves List'),
      'object_types' => array('service'),
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
      'desc'    => 'For adding line breaks add one, or multiple &lt;br&gt; element/s.',
      'name' => __('Description (First item)'),
      'id' => $prefix . 'first_item_description',
      'type' => 'textarea',
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

    /*SECOND ITEM*/
    /*Second item title*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'name' => __('Title (Second item)'),
      'id' => $prefix . 'second_item_title',
      'type'  => 'text'
    ));
    /*Second item description*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'desc'    => 'For adding line breaks add one, or multiple &lt;br&gt; element/s.',
      'name' => __('Description (Second item)'),
      'id' => $prefix . 'second_item_description',
      'type' => 'textarea',
    )); 
    /*Second item see more text*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'name' => __('"See more" text (Second item)'),
      'id' => $prefix . 'second_item_see_more_text',
      'type'  => 'text_small'
    ));
    /*Second item see more url*/
    $process_cmb->add_group_field($process_cmb_id, array(
      'name' => __('"See more" url (Second item)'),
      'id' => $prefix . 'second_item_see_more_url',
      'type'  => 'text_url'
    ));






    /*-----------------------------------------------------------


           'D E N T A L   I M P L A N T S   T E M P L A T E' 


    -----------------------------------------------------------*/

    $prefix = 'ap_dental_implants_services_loop_';


    /*SERVICES LOOP*/
    $di_llbenefits_services_loop_cmb = new_cmb2_box(array(
      'id' => $prefix . 'lifelong_benefits_loop',
      'title' => __('Services Loop'),
      'object_types' => array( 'page' ),
      'show_on' => array( 'key' => 'page-template', 'value' => 'dental-implants.php' ),
      'context' => 'advanced',
      'priority'      => 'core',
    ));

    /*Hide Loop of services*/
    $di_llbenefits_services_loop_cmb->add_field( array(
      'name'    => 'Hide loop of services',
      'desc'    => 'Check if you want to hide the loop of services',
      'id'      => $prefix . 'hide',
      'type'    => 'checkbox',
    ) );

    /*Title*/
    $di_llbenefits_services_loop_cmb->add_field( array(
      'name'    => 'Title',
      'desc'    => 'Enter a title for this section',
      'id'      => $prefix . 'title',
      'type'    => 'text',
    ) );

    /*Subtitle*/
    $di_llbenefits_services_loop_cmb->add_field( array(
      'name'    => 'Subtitle',
      'desc'    => 'Enter a subtitle for this section',
      'id'      => $prefix . 'subtitle',
      'type'    => 'text',
    ) );
    




    $prefix = 'ap_dental_implants_';

    /*BENEFITS SECTION*/
    $di_benefits_cmb = new_cmb2_box(array(
      'id' => $prefix . 'benefits',
      'title' => __('Dental Implants Benefits'),
      'object_types' => array( 'page' ),
      'show_on' => array( 'key' => 'page-template', 'value' => 'dental-implants.php' ),
      'context' => 'advanced',
      'priority'      => 'core',
    ));

    $di_benefits_group_cmb = $di_benefits_cmb->add_field(array(
      'id' => $prefix . 'benefits_group',
      'type' => 'group',
      'options' => array(
          'group_title' => esc_html__('Benefit List {#}'),
          'add_button' => esc_html__('Add Another Benefit List'),
          'remove_button' => esc_html__('Remove Benefit List'),
          'sortable' => true,
      ),
    ));

    /*Title*/
    $di_benefits_cmb->add_group_field($di_benefits_group_cmb, array(
      'desc'    => 'Enter the title for this benefit. (required)',
      'name' => __('Benefit Title'),
      'id' => $prefix . 'title',
      'type' => 'text',
    ));

    /*List*/
    $di_benefits_cmb->add_group_field($di_benefits_group_cmb, array(
      'desc'    => 'Enter the content for this benefit. Example: a list, a description (required)',
      'name' => __('Benefit content'),
      'id' => $prefix . 'content',
      'type' => 'textarea',
    ));

    /*Image*/
    $di_benefits_cmb->add_group_field($di_benefits_group_cmb, array(
      'desc'    => 'Upload an image related to this list of benefits block (optional)',
      'name' => __('Benefit Image'),
      'id' => $prefix . 'image',
      'type' => 'file',
    ));



    /*LIFELONG BENEFITS SECTION*/
    $di_llbenefits_cmb = new_cmb2_box(array(
      'id' => $prefix . 'lifelong_benefits',
      'title' => __('Dental Implants Lifelong Benefits'),
      'object_types' => array( 'page' ),
      'show_on' => array( 'key' => 'page-template', 'value' => 'dental-implants.php' ),
      'context' => 'advanced',
      'priority'      => 'core',
    ));

    /*Lifelong Benefits Main Title*/
    $di_llbenefits_cmb->add_field( array(
      'name'    => 'Section Title',
      'desc'    => 'Enter a title for this section (required)',
      'id'      => $prefix . 'llb_title',
      'type'    => 'text',
    ) );

    /*Lifelong Benefits Subtitle*/
    $di_llbenefits_cmb->add_field( array(
      'name'    => 'Section Subtitle',
      'desc'    => 'Enter a subtitle for this section (optional)',
      'id'      => $prefix . 'llb_subtitle',
      'type'    => 'text',
    ) );

    /*Lifelong Benefits Group*/
    $di_llbenefits_group_cmb = $di_llbenefits_cmb->add_field(array(
      'id' => $prefix . 'llb_group',
      'type' => 'group',
      'desc'    => 'Enter below lifelong benefit list items (at least one required)',
      'options' => array(
          'group_title' => esc_html__('Lifelong Benefit {#}'),
          'add_button' => esc_html__('Add Another Lifelong Benefit'),
          'remove_button' => esc_html__('Remove Lifelong Benefit'),
          'sortable' => true,
      ),
    ));

    /*Lifelong Benefits Group title*/
    $di_llbenefits_cmb->add_group_field($di_llbenefits_group_cmb, array(
      'name' => __('Lifelong Benefit Group Title'),
      'id' => $prefix . 'llg_group_item_title',
      'type' => 'text',
    ));

    /*Lifelong Benefits Group description*/
    $di_llbenefits_cmb->add_group_field($di_llbenefits_group_cmb, array(
      'name' => __('Lifelong Benefit Group Description'),
      'id' => $prefix . 'llg_group_item_description',
      'type' => 'text',
    ));

    /*Lifelong Benefits Group icon*/
    $di_llbenefits_cmb->add_group_field($di_llbenefits_group_cmb, array(
      'name' => __('Lifelong Benefit Group Icon'),
      'desc'    => 'Enter the name of one of the lifelong benefit icons : icon-oneday, icon-bone, icon-foods, icon-healthy, icon-lookandfeel, icon-speak, or icon-mouth',
      'id' => $prefix . 'llg_group_item_icon',
      'type' => 'text_small'
    ));

    /*Lifelong Benefits Button Text*/
    $di_llbenefits_cmb->add_field( array(
      'name'    => 'Button Text',
      'desc'    => 'Enter a button text for this section',
      'id'      => $prefix . 'llb_button_text',
      'type'    => 'text',
    ) );

    /*Lifelong Benefits Button url*/
    $di_llbenefits_cmb->add_field( array(
      'name'    => 'Button url',
      'desc'    => 'Enter a url for the button',
      'id'      => $prefix . 'llb_button_url',
      'type'    => 'text',
    ) );



    /*BIG BANNER*/
    $di_big_banner_cmb = new_cmb2_box(array(
      'id' => $prefix . 'big_banner',
      'title' => __('Dental Implants Big Banner'),
      'object_types' => array( 'page' ),
      'show_on' => array( 'key' => 'page-template', 'value' => 'dental-implants.php' ),
      'context' => 'advanced',
      'priority'      => 'core',
    ));

    /*Big Banner Title*/
    $di_big_banner_cmb->add_field( array(
      'name'    => 'Title',
      'desc'    => 'Enter banner title (required)',
      'id'      => $prefix . 'bb_title',
      'type'    => 'text',
    ) );

    /*Big Banner Subtitle*/
    $di_big_banner_cmb->add_field( array(
      'name'    => 'Subtitle',
      'desc'    => 'Enter banner subtitle (optional)',
      'id'      => $prefix . 'bb_subtitle',
      'type'    => 'text',
    ) );

    /*Big Banner Description*/
    $di_big_banner_cmb->add_field( array(
      'name'    => 'Description',
      'desc'    => 'Enter banner description (required)',
      'id'      => $prefix . 'bb_description',
      'type'    => 'text',
    ) );

    /*Big Banner Button Text*/
    $di_big_banner_cmb->add_field( array(
      'name'    => 'Button text',
      'desc'    => 'Enter banner button text (optional)',
      'id'      => $prefix . 'bb_button_text',
      'type'    => 'text',
    ) );

    /*Big Banner Button url*/
    $di_big_banner_cmb->add_field( array(
      'name'    => 'Button url',
      'desc'    => 'Enter banner button url (required if button text added above)',
      'id'      => $prefix . 'bb_button_url',
      'type'    => 'text',
    ) );

    /*Background image*/
    $di_big_banner_cmb->add_field( array(
      'name'    => 'Background Image',
      'desc'    => 'Upload an optional background image or enter an URL.',
      'id'      => $prefix . 'bb_background_image',
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
}
?>