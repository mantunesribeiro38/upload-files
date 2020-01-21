<?php

include plugin_dir_path( __FILE__ ) . 'Upload.php';

include plugin_dir_path( __FILE__ ) . 'Config.php';

include plugin_dir_path( __FILE__ ) . 'Attachment.php';

function register_meta_boxes() {
    add_meta_box( ID, TITLE, CALLBACK, PAGE );
}

add_action( 'add_meta_boxes', 'register_meta_boxes' );

function display_input_attachment($post) { 
    
    $args = array(
        'post_type'   => 'attachment',
        'post_parent' => $post->ID,
        'post_mime_type' =>'application/pdf',
    );

        
    $attachments = new Attachment(get_posts( $args ));
    
    $attachmentsList = $attachments->getListAttachment();
   
    include plugin_dir_path( __FILE__ ) . '../form/form.php';
}

function save_meta_box_attachment() {
    global $post;

    if ( 'POST' == $_SERVER['REQUEST_METHOD']  and $_FILES) {
        $files = $_FILES["wp_custom_attachment"];
        $upload = new Upload( $files, $post->ID);

        $upload->saveAttachment();
    }
}

add_action( 'save_post', 'save_meta_box_attachment' );

function update_edit_form() {
    echo 'enctype="multipart/form-data"';
}

add_action( 'post_edit_form_tag', 'update_edit_form' );

function load_js(){
	echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js''></script>";
    wp_enqueue_script( 'load_js', plugins_url( '../assets/js/main.js', __FILE__ ), array('jquery') );
}

add_action('admin_enqueue_scripts', 'load_js');

function eps_footer() {
    echo "<script>var ajaxurl = '".admin_url( 'admin-ajax.php' )."'</script>";
}

add_action('wp_footer', 'eps_footer');

function ajax_login_init(){
    wp_localize_script('ajax-login-script','ajax_login_object',array('ajaxurl' => admin_url('admin-ajax.php')));
}

function attachment_delete () {
    $form = $_POST;
    wp_delete_attachment( $form['id_attachment'], true );
    wp_die();
}

add_action('wp_ajax_nopriv_attachment_delete', 'attachment_delete');

add_action('wp_ajax_attachment_delete', 'attachment_delete');

add_filter('use_block_editor_for_post', '__return_false');