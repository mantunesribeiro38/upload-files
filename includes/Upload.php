<?php

class Upload {

    private $files;

    private $post_id;
    
    private $attachment;
    
    public  function  __construct( $files, $post_id){
        $this->files = $files ;
        $this->post_id = $post_id ;
    }

    public function saveAttachment() {
        foreach ( $this->files['name'] as $key => $value ) {
            $this->validate($key);
            $this->store($this->attachment);
        }
    }

    private function validate($key) {

        $file = array(
            'name'     => $this->files['name'][ $key ],
            'type'     => $this->files['type'][ $key ],
            'tmp_name' => $this->files['tmp_name'][ $key ],
            'error'    => $this->files['error'][ $key ],
            'size'     => $this->files['size'][ $key ]
        );

        $supported_types = array( 'application/pdf' );
        $array_file_type = wp_check_filetype( basename( $file['name'] ) );
        $uploaded_type = $array_file_type['type'];

        if (in_array( $uploaded_type, $supported_types ) ) {

            $_FILES = array( "wp_custom_attachment" => $file );
            $this->attachment = $_FILES;
        }
    }

    private function  store($attachment) {
        foreach ( $attachment as $file => $array ) {
            $this->myHandle( $file, $this->post_id);
        }
    }

    private function myHandle( $file_handler, $post_id) {

        if ( $_FILES[ $file_handler ]['error'] !== UPLOAD_ERR_OK ) {
            __return_false();
        }

        require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
        require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
        require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

        $attach_id = media_handle_upload( $file_handler, $post_id );

        if ( is_numeric( $attach_id ) ) {
            add_post_meta( $post_id, 'wp_custom_attachment', $attach_id );
            update_post_meta( $post_id, 'wp_custom_attachment', $attach_id );
        }
    }
}

