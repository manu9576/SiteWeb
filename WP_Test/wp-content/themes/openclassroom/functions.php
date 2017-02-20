<?php
add_action('widgets_init','tp_add_sidebar');
function tp_add_sidebar()
{
  register_sidebar(array(
    'id' => 'zone_widget_droite',
    'name' => 'Zone latérale droite',
    'description' => 'Apparait sur la droite site',
    'before_widget' => '<aside>',
    'after_widget' => '</aside>',
    'before_title' => '<h1>',
    'after_title' => '</h1>'
  ));
}

add_action('init', 'tp_add_menu');
function tp_add_menu()
{
  register_nav_menu('main_menu', 'Menu principal');
}


