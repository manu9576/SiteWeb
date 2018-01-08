<?php


class SNK_Adm_Newsletter
{
  function __construct()
  {
    $this->register_settings();

    /* permet l'enregistremen dans la base de données d'un mail */
    add_action('wp_loaded', array($this, 'save_email'));

    /* prepare les paramétres de l'envoie d'une newsletter */
    add_action('admin_init', array($this, 'register_settings'));
  }

  /* fonction qui cree les paramétres pour la newsletter */
  public function register_settings()
  {
    register_setting('SNK_newsletter_settings', 'SNK_newsletter_object');
    register_setting('SNK_newsletter_settings', 'SNK_newsletter_content');

    add_settings_section('SNK_newsletter_section', 'Envoi d\'une newsletter', array($this, 'envoi_newsletter_html'), 'SNK_newsletter_settings');
    add_settings_field('SNK_newsletter_object', 'Objet', array($this, 'object_html'), 'SNK_newsletter_settings', 'SNK_newsletter_section');
    add_settings_field('SNK_newsletter_content', 'Contenu', array($this, 'content_html'), 'SNK_newsletter_settings', 'SNK_newsletter_section');

  }

  /* fonction qui envoie la news la lettre */
  public function send_newsletter()
  {
    global $wpdb;

    $recipients = $wpdb->get_results("SELECT email FROM {$wpdb->prefix}SNK_newsletter_email");
    $object = get_option('SNK_newsletter_object', 'Newsletter');
    $content = get_option('SNK_newsletter_content', 'Mon contenu');
    $header = array('From: '.$sender);
    foreach ($recipients as $_recipient)
    {
      $result = wp_mail($_recipient->email, $object, $content, $header);
    }

  }

  public function save_email()
  {
    if (isset($_POST['SNK_newsletter_email']) && !empty($_POST['SNK_newsletter_email']))
    {
      global $wpdb;
      $email = $_POST['SNK_newsletter_email'];

      $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}SNK_register WHERE email = '$email'");
      if (is_null($row)) {
        $wpdb->insert("{$wpdb->prefix}SNK_register", array('email' => $email));
      }
    }
  }

  /* Menu generale qui affiche la page de garde du plugin */
  public function envoi_newsletter_html()
  {
    echo 'Renseignez les paramètres d\'envoi de la newsletter.';
  }

  public function object_html()
  {?>
    <input type="text" name="SNK_newsletter_object" value="<?php echo get_option('SNK_newsletter_object')?>"/>
    <?php
  }

  public function content_html()
  {?>
    <textarea name="SNK_newsletter_content"><?php echo get_option('SNK_newsletter_content')?></textarea>
    <?php
  }

  public function process_action()
  {
    if (isset($_POST['send_newsletter']))
    {
      $this->send_newsletter();
    }
  }

  public function contenu_newsletter_html()
  {
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
}

?>
