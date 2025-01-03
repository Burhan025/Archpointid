<?php

add_action( 'cmb2_admin_init', 'cmb2_doctor_metaboxes' );
    /*********************************
    CMB2 FOR SERVICES
    *********************************/
function cmb2_doctor_metaboxes() {


    /*-----------------------------------------------------------


                      S I N G L E   D O C T O R 


    -----------------------------------------------------------*/


    /*********************************
    video
    *********************************/

    $prefix = 'ap_doctor_metadata_';

    $doctor_metadata_cmb = new_cmb2_box( array(
        'id'            => 'cmb',
        'title'         => __( 'Doctor Metadata', 'cmb2' ),
        'object_types'  => array( 'doctor', ), // Post type
        'context'       => 'normal',
        'priority'      => 'core',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );


    // Full name
    $doctor_metadata_cmb->add_field( array(
        'name' => 'Full Name (Required)',
        'desc' => 'Enter the doctor full name (e.g.: "Michael Oppedisano") This value will override the main title of this doctor post',
        'id'   => $prefix . 'full_name',
        'type' => 'text',
    ) );

    // Academic Titles
    $doctor_metadata_cmb->add_field( array(
      'name'    => 'Academic Titles',
      'desc'    => 'Select the academic titles',
      'id'      => $prefix . 'academic_titles',
      'type'    => 'multicheck',
        'options' => array(
        'Dmd' => 'DMD',
        'Dds' => 'DDS',
        'Md' => 'MD',
        'Ms' => 'MS',
      ),
    ) );

    // Short Description
    $doctor_metadata_cmb->add_field( array(
        'name' => 'Short Description Subtitle',
        'desc' => 'Enter a short description Subtitle (e.g.: "Founding Member and Board Certified Prosthodontist")',
        'id'   => $prefix . 'short_description',
        'type' => 'text',
    ) );

    // Biography
    $doctor_metadata_cmb->add_field( array(
        'name' => 'Biography',
        'desc' => 'Enter the doctor biography',
        'id'   => $prefix . 'bio',
        'type' => 'textarea',
    ) );

    // Youtube video url
    $doctor_metadata_cmb->add_field( array(
        'name' => 'Youtube video url',
        'desc' => 'Enter the youtube video url for this doctor (On Youtube: Share > COPY)',
        'id'   => $prefix . 'youtube_url',
        'type' => 'text_url',
    ) );

    /*Appointment text*/
    $doctor_metadata_cmb->add_field( array(
      'name' => __('Appointment button text'),
      'desc' => 'Enter the text for Appointment button',
      'id' => $prefix . 'appointment_text',
      'type' => 'text',
    ));
    /*Appointment url*/
    $doctor_metadata_cmb->add_field( array(
      'name' => __('Appointment button url'),
      'desc' => 'Enter the url for Appointment button',
      'id' => $prefix . 'appointment_url',
      'type'  => 'text_url'
    ));

    // Alternative image
    $doctor_metadata_cmb->add_field( array(
        'name'    => 'Alternative image',
        'desc' => 'Select an alternative image if no youtube video is provided above. (Width should be 960px).',
        'id'   => $prefix . 'alternative_image',
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
            'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            // 'type' => array(
            //  'image/gif',
            //  'image/jpeg',
            //  'image/png',
            // ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) ); 

    // Meet Us Page
    $doctor_metadata_cmb->add_field( array(
        'name' => 'Show On "Meet Us" Page',
        'desc' => 'Check if you want this doctor to be displayed on the "Meet Us" page',
        'id'   => $prefix . 'meet_us',
        'type' => 'checkbox',
    ) );

    // Special Mention
    $doctor_metadata_cmb->add_field( array(
        'name' => 'Special Mention',
        'desc' => 'Check if this doctor has a special mention (Also add the special mention image/logo below, that will appear next to this doctor name, on the "Meet Us" page)',
        'id'   => $prefix . 'special_mention',
        'type' => 'checkbox',
    ) );

    // Special Mention Logo
    $doctor_metadata_cmb->add_field( array(
        'name'    => 'Special Mention Logo',
        'desc' => 'Select the special mention image/logo',
        'id'   => $prefix . 'special_mention_logo',
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
            'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            // 'type' => array(
            //  'image/gif',
            //  'image/jpeg',
            //  'image/png',
            // ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) ); 



    

}
?>