<?php
/*
Plugin Name: Poll  
Description: Un plugin permettant de proposer un sondage au visiteurs
Version: 0.1
Author: engel731
*/

include_once plugin_dir_path( __FILE__ ).'/pollwidget.php';

/**
 * Classe Poll_Plugin
 * Déclare le plugin
 */
class Poll_Plugin
{
    /**
     * Constructeur
     */
    public function __construct()
    {
        add_action('widgets_init', function() {
            //Enregistrement du widget
            register_widget('Poll_Widget');
        });

        // Appelle les méthodes correspondant à l'évènement déclenché
        register_activation_hook(__FILE__, array('Poll_Plugin', 'install'));
        register_uninstall_hook(__FILE__, array('Poll_Plugin', 'uninstall'));

        add_action('admin_init', array($this, 'register_settings')); // Le système d'administration est initialisé
        add_action('admin_menu', array($this, 'add_admin_menu')); // chargement des menus de WordPress

        // Lorsqu'une page est chargé
        add_action('wp_loaded', array($this, 'process_action_visiteur'));
    }

    /**
     * Methode statique d'installation
     */
    public static function install()
    {
        global $wpdb;

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}poll_options (id INT AUTO_INCREMENT PRIMARY KEY, label VARCHAR(255) NOT NULL);");
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}poll_results (option_id INT NOT NULL, total INT NOT NULL);");
    }

    /**
     * Methode statique de désinstallation
     * Suppression des tables du sondage
     */
    public static function uninstall()
    {
        global $wpdb;

        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}poll_options;");
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}poll_results;");
    }

    /**
     * Ajouter une page de sous-menu pour le menu principal Paramètres.
     */
    public function add_admin_menu() {
        //Fonctions dédiées qui appellent en interne add_submenu_page()
        $hook = add_options_page(
            __('Poll', 'textdomain'),
            __('Poll edition', 'textdomain'),
            'manage_options',
            'poll',
            array($this, 'menu_html')
        );

        // Instant où la page options.php est chargé
        add_action('load-options.php', array($this, 'process_action_admin'));
         // Instant ou la page du plugin est chargé
        add_action('load-'.$hook, array($this, 'process_action_admin'));
    }

    /**
     * Crée le formulaire pour la question du sondage
     */
    public function register_settings()
    {
        register_setting('poll_settings', 'poll_question');

        add_settings_section(
            'poll_section',
            __('Edit the poll', 'textdomain'),
            array($this, 'section_html'),
            'poll_settings'
        );

        add_settings_field(
            'poll_question',
            __('Poll question : ', 'textdomain'),
            array($this, 'question_html'),
            'poll_settings',
            'poll_section'
        );
    }

    /**
     * La méthode de rendu de la section question
     */
    public function section_html()
    {
        echo __('Fill out the survey question with its different options', 'textdomain');
    }

    /**
     * La méthode de rendu du champ "question"
     */
    public function question_html()
    {
        ?><input
            type="text"
            name="poll_question"
            value="<?php echo get_option('poll_question')?>"
        /><?php
    }

    /*
     * Affichage de la page d'accueil du plugin
     */
    public function menu_html()
    {
        echo '<h1>'.get_admin_page_title().'</h1>'; ?>

        <form method="post" action="options.php">
            <?php
                global $wpdb;

                settings_fields('poll_settings');
                do_settings_sections('poll_settings');

                $recipients = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}poll_options");
                $i = 1;
            ?>

            <!-- Boucle des options  -->
            <table class="form-table">
                <tbody>
                    <?php foreach ($recipients as $_recipient) : ?>
                        <tr>
                            <th><?php echo $i++ . ' )' ?></th>
                            <td>
                                <input
                                    type="text"
                                    name="<?php echo 'poll_option-'.$_recipient->id; ?>"
                                    value="<?php echo $_recipient->label; ?>"
                                />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Champ de base -->
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><?php echo __('New option : ', 'textdomain'); ?></th>
                        <td><input type="text" name="poll_option" /></td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
        </form>

        <form method="post" action="">
            <input type="hidden" name="delete_poll" value="1"/>
            <?php submit_button(__('Reset Votes and Options', 'textdomain')); ?>
        </form><?php
    }

    public function process_action_visiteur() {
        //Check option
        if(isset($_POST['poll'])) {
            if(!isset($_COOKIE['poll'])) {
                setcookie('poll', 'true');
                do_action('widgets_init');
                $this->check_option($_POST['poll_check_option']);
            }
        }
    }

    public function process_action_admin()
    {
        //Save option
        if(isset($_POST['poll_option']) && !empty($_POST['poll_option'])) {

            global $wpdb;

            $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}poll_options WHERE label = '{$new_option->label}'");

            if(is_null($row)) {
                $this->save_option(array('label' => $_POST['poll_option']));
            }
        }

        //Update option
        if(preg_match('#poll_option-[0-9]#', implode(' ', array_keys($_POST)))) {
            global $wpdb;

            $options = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}poll_options");

            foreach ($options as $current_option) {
                $cle = 'poll_option-'.$current_option->id;

                if(isset($_POST[$cle]) && !empty($_POST[$cle])) {
                    if ($current_option->label != $_POST[$cle]) {

                        //Update option
                        $this->update_options(
                            $current_option,
                            array('label' => $_POST[$cle])
                        );
                    }
                } else if(isset($_POST[$cle]) && empty($_POST[$cle])) {
                    //Delete option
                    $this->delete_option($current_option);
                }
            }
        }

        //Delete poll
        if(isset($_POST['delete_poll'])) {
            $this->delete_poll();
        }
    }

    public function check_option($option_id) {
        global $wpdb;

        $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}poll_results WHERE option_id = '$option_id'");

        if(is_null($row)) {
            $wpdb->insert(
                "{$wpdb->prefix}poll_results",
                array('option_id' => $option_id, 'total' => 1)
            );
        } else {
            $total = intval($row->total) + 1;

            $wpdb->update(
                "{$wpdb->prefix}poll_results",
                array('total' => $total),
                array('option_id' => $option_id)
            );
        }
    }

    public function save_option($new_option)
    {
        global $wpdb;

        $wpdb->insert(
            "{$wpdb->prefix}poll_options",
            $new_option
        );
    }

    public function update_options($current_option, $new_option)
    {
        global $wpdb;

        $wpdb->update(
            "{$wpdb->prefix}poll_options",
            $new_option,
            array('id' => $current_option->id)
        );
    }

    public function delete_option($option) {
        global $wpdb;

        $wpdb->delete("{$wpdb->prefix}poll_options", array('id' => $option->id));
        $wpdb->delete("{$wpdb->prefix}poll_results", array('option_id' => $option->id));
    }

    public function delete_poll()
    {
        global $wpdb;

        $wpdb->query("DELETE FROM {$wpdb->prefix}poll_options WHERE 1");
        $wpdb->query("DELETE FROM {$wpdb->prefix}poll_results WHERE 1");

        delete_option('poll_question');
    }
}

new Poll_Plugin();
