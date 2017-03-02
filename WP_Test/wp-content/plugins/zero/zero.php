<?php
/*
Plugin Name: Zero plugin
Plugin URI: http://zero-plugin.com
Description: Un plugin d'introduction pour le développement sous WordPress
Version: 0.1
Author: Midnight Falcon
Author URI: http://votre-site.com
License: GPL2
*/

class Zero_Plugin
{
    public function __construct()
    {
        include_once plugin_dir_path( __FILE__ ).'/page_title.php';
        new Zero_Page_Title();

        include_once plugin_dir_path( __FILE__ ).'/newsletter.php';
        new Zero_Newsletter();

        include_once plugin_dir_path( __FILE__ ).'/recent.php';
        new Zero_Recent();


        register_activation_hook(__FILE__, array('Zero_Newsletter', 'install'));
        register_uninstall_hook(__FILE__, array('Zero_Newsletter', 'uninstall'));

        add_action('admin_menu', array($this, 'add_admin_menu'),20);
   }

    public function add_admin_menu()
    {
        add_menu_page('Zero plugin', 'Zero plugin', 'manage_options', 'zero_main', array($this, 'menu_presentation_html'));
        add_submenu_page('zero_main', 'Envoi newsletter', 'Envoi newsletter', 'manage_options', 'zero_apercu', array($this, 'menu_html'));
    }


    public function menu_presentation_html()
    {
      echo '<h1>'.get_admin_page_title().'</h1>';

       echo '<p>Bienvenue sur la page d\'accueil du plugin</p>';
    }


    public function menu_html()
    {
        echo '<h1>'.get_admin_page_title().'</h1>';
        ?>

       <form method="post" action="options.php">
            <?php settings_fields('zero_newsletter_settings') ?>
            <?php do_settings_sections('zero_newsletter_settings') ?>
            <?php submit_button(); ?>
        </form>
        <form method="post" action="">
            <input type="hidden" name="send_newsletter" value="1"/>
            <?php submit_button('Envoyer la newsletter') ?>
        </form>
    <?php
  }
}

new Zero_Plugin();
