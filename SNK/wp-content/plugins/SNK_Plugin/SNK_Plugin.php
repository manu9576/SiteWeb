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

class SNK_plugin
{

  public function __construct()
  {

    /*Permet la creation du short code pour la form d'enregistrement*/
    include_once plugin_dir_path( __FILE__ ).'SNK_registration.php';
    include_once plugin_dir_path( __FILE__ ).'SNK_registrationManager.php';
    include_once plugin_dir_path( __FILE__ ).'SNK_Adm_ListeRegistrations.php';
    include_once plugin_dir_path( __FILE__ ).'SNK_Adm_Newsletter.php';

    /*Permet la creation du short code pour la form d'enregistrement*/
    include_once plugin_dir_path( __FILE__ ).'SNK_register_form.php';
    new SNK_register_form();

    /* Permet la creation et la suppresion des tables de la base de donnee */
    register_activation_hook(__FILE__, array('SNK_plugin', 'install'));
    register_uninstall_hook(__FILE__, array('SNK_plugin', 'uninstall'));

    /* prepare le menu d'aministation du plug-in */
    add_action('admin_menu', array($this, 'add_admin_menu'),20);
  }

  //          GESTION DES MENUS D'ADMINISTRATION
  public function add_admin_menu()
  {
    add_menu_page('SNK plugin', 'SNK plugin', 'manage_options', 'snk', array($this, 'presentation_html'));

    // ajour du menu pour l'envoi de la newsletter
    $newletter = new SNK_Adm_Newsletter();
    $hook = add_submenu_page('snk', 'Envoi d\'une newsletter', 'Envoi newsletter', 'manage_options', 'SNK_send_newsletter', array($newletter, 'contenu_newsletter_html'));
    add_action('load-'.$hook, array($newletter, 'process_action'));

    // ajout du menu d'administration avec la liste des enregistrements
    $listeEnregistrement=  new SNK_Adm_ListeRegistrations();
    add_submenu_page('snk', 'Liste des enregistrements', 'Enregistrements', 'manage_options', 'SNK_manage_registration', array($listeEnregistrement, 'affichagePage'));
  }

  public function presentation_html()
  {
      echo '<h1>'.get_admin_page_title().'</h1>';
      echo 'Page d\'aministation de ' .get_admin_page_title();
  }

  /* fonction appelée à la l'activation du plugin, cree les tables dans la base de données*/
  public static function install()
  {
    global $wpdb;

    $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}SNK_registrations (`id` int(11) NOT NULL AUTO_INCREMENT,
    `id_WP` int(11) NOT NULL DEFAULT '0',
    `nom` text NOT NULL,
    `prenom` text NOT NULL,
    `adresse` text NOT NULL,
    `codePostal` int(11) NOT NULL DEFAULT '0',
    `ville` text NOT NULL,
    `telephone` text NOT NULL,
    `email` text NOT NULL,
    `nombreHeuresValidees` int(11) NOT NULL DEFAULT '0',
    `valider` tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)  ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1" );
  }

  /* fonction appelée à la suppression du plugin, détruit les tables dans la base de données*/
  public static function uninstall()
  {
    global $wpdb;

    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}SNK_registrations;");
  }

}

new SNK_Plugin();
