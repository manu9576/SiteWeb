<?php

class Zero_Page_Title
{
    public function __construct()
    {
        add_filter('wp_title',array($this, 'modify_page_title'), 20) ;
       
    }

    public function modify_page_title($title)
    {
        return $title . ' par les zéros ';
    }
}