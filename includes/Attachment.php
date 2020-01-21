<?php

class Attachment {

    private $attachments ;

    public function __construct($files) {
        
        $this->attachments = $this->mountAttachments($files);
       
    }

    private function mountAttachments($files) {
        
        $listAttachments = [];

        if($files) {
            foreach ($files  as $file ) {

                $idAttachment = $file->ID;
                
                $url = $file->guid;
                
                $title = apply_filters( 'the_title', $file->post_title );
                
                $path = str_replace(site_url('/'), ABSPATH, esc_url($url));
                
                if (is_file($path)) {
                    $filesize = size_format(filesize($path));
                    $filename = basename($path);
                }

                array_push($listAttachments, (object)[
                    'idAttachment' => $idAttachment,
                    'url' => $url,
                    'title' => $title,
                    'filesize' => $filesize,
                    'filename' => $filename
                ]);
            }
        }


        return $listAttachments;
    }

    public function getListAttachment() {
        
        return $this->attachments;
    }
}