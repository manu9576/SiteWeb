<?php

include_once plugin_dir_path( __FILE__ ).'/SNK_register_widget.php';

class SNK_register
{
  public function __construct()
  {
    add_action('widgets_init', function(){register_widget('SNK_Register_Widget');});
  }
}
