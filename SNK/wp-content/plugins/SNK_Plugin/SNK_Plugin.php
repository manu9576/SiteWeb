<?php

/*
Plugin Name: SNK_Plugin
Plugin URI: https://snkinesio.fr/
Description: Plugin pour l'enregistrement et le renouvellement des adhérants
Version: 0.1
Author: manu9576
Author URI: http://manu9576.freeboxos.fr

License: GPL2
*/

class SNK_Plugin
{

  public function __construct()
  {

  
    /* Permet l'enregistrement du fichier */
    include_once plugin_dir_path( __FILE__ ).'/SNK_register.php';
    new SNK_register();

    /* Permet la creation et la suppresion des tables de la base de donnee */
    register_activation_hook(__FILE__, array('SNK_Plugin', 'install'));
    register_uninstall_hook(__FILE__, array('SNK_Plugin', 'uninstall'));

    /* permet l'enregistremen dans la base de données d'un mail */
    add_action('wp_loaded', array($this, 'save_email'));

    /* prepare le menu d'aministation du plug-in */
    add_action('admin_menu', array($this, 'add_admin_menu'),20);

    /* prepare les paramétres de l'envoie d'une newsletter */
    add_action('admin_init', array($this, 'register_settings'));

    /*Permet la creation du short code pour la form d'enregistrement*/
    include_once plugin_dir_path( __FILE__ ).'SNK_register_form.php';
        new SNK_register_form();
  }


  public function register_settings()
  {
    register_setting('SNK_newsletter_settings', 'SNK_newsletter_sender');
    register_setting('SNK_newsletter_settings', 'SNK_newsletter_object');
    register_setting('SNK_newsletter_settings', 'SNK_newsletter_content');

    add_settings_section('SNK_newsletter_section', 'Newsletter parameters', array($this, 'section_html'), 'SNK_newsletter_settings');
    add_settings_field('SNK_newsletter_sender', 'Expéditeur', array($this, 'sender_html'), 'SNK_newsletter_settings', 'SNK_newsletter_section');
    add_settings_field('SNK_newsletter_object', 'Objet', array($this, 'object_html'), 'SNK_newsletter_settings', 'SNK_newsletter_section');
    add_settings_field('SNK_newsletter_content', 'Contenu', array($this, 'content_html'), 'SNK_newsletter_settings', 'SNK_newsletter_section');

  }


  public function send_newsletter()
  {
    global $wpdb;

    $recipients = $wpdb->get_results("SELECT email FROM {$wpdb->prefix}SNK_newsletter_email");
    $object = get_option('SNK_newsletter_object', 'Newsletter');
    $content = get_option('SNK_newsletter_content', 'Mon contenu');
    $sender = get_option('SNK_newsletter_sender', 'no-reply@example.com');
    $header = array('From: '.$sender);
    foreach ($recipients as $_recipient)
    {
      $result = wp_mail($_recipient->email, $object, $content, $header);
    }

  }


  public function section_html()
  {
    echo 'Renseignez les paramètres d\'envoi de la newsletter.';
  }

  public function object_html()
  {?>
    <input type="text" name="SNK_newsletter_object" value="<?php echo get_option('SNK_newsletter_object')?>"/>
    <?php
  }

  public function sender_html()
  {?>
    <input type="text" name="SNK_newsletter_sender" value="<?php echo get_option('SNK_newsletter_sender')?>"/>
    <?php
  }

  public function content_html()
  {?>
    <textarea name="SNK_newsletter_content"><?php echo get_option('SNK_newsletter_content')?></textarea>
    <?php
  }

  public function add_admin_menu()
  {
    add_menu_page('SNK plugin', 'SNK plugin', 'manage_options', 'snk', array($this, 'presentation_html'));
    $hook = add_submenu_page('snk', 'Apercu', 'Apercu', 'manage_options', 'SNK', array($this, 'menu_html'));
    add_action('load-'.$hook, array($this, 'process_action'));
  }


  public function process_action()
  {
    if (isset($_POST['send_newsletter']))
    {
      $this->send_newsletter();
    }
  }

  public function presentation_html()
  {
      echo '<h1>'.get_admin_page_title().'</h1>';
      echo 'Page d\'aministation de ' .get_admin_page_title();
  }

  public function menu_html()
  {
    echo '<h1>'.get_admin_page_title().'</h1>';

    ?>
    <form method="post" action="options.php">
      <?php settings_fields('SNK_newsletter_settings') ?>
      <?php do_settings_sections('SNK_newsletter_settings') ?>
      <?php submit_button(); ?>
    </form>

    <form method="post" action="">
      <input type="hidden" name="send_newsletter" value="1"/>
      <?php submit_button('Envoyer la newsletter') ?>
    </form>

    <?php
  }

  public static function install()
  {
    global $wpdb;

    $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}SNK_register (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL);");
  }

  public static function uninstall()
  {
    global $wpdb;

    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}SNK_register;");
  }

  public function save_email()
  {
    if (isset($_POST['SNK_newsletter_email']) && !empty($_POST['SNK_newsletter_email'])) {
      global $wpdb;
      $email = $_POST['SNK_newsletter_email'];

      $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}SNK_register WHERE email = '$email'");
      if (is_null($row)) {
        $wpdb->insert("{$wpdb->prefix}SNK_register", array('email' => $email));
      }
    }
  }
}

new SNK_Plugin();
