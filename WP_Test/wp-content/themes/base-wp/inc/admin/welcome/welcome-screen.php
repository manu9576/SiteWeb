<?php
/**
 * Welcome Screen Class
 */
class IGthemes_Welcome {

    /**
     * Constructor
     * Sets up the welcome screen
     */
    public function __construct() {

        add_action( 'admin_menu', array( $this, 'igthemes_welcome_register_menu' ) );
        add_action( 'load-themes.php', array( $this, 'igthemes_activation_admin_notice' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'igthemes_welcome_style' ) );

        add_action( 'igthemes_welcome', array( $this, 'igthemes_welcome_tabs' ), 10 );
        add_action( 'igthemes_welcome', array( $this, 'igthemes_welcome_getting_started' ), 20 );
        add_action( 'igthemes_welcome', array( $this, 'igthemes_welcome_wp_resources' ), 30 );
        add_action( 'igthemes_welcome', array( $this, 'igthemes_welcome_sysinfo' ), 40 );
    } // end constructor

    /**
     * Adds an admin notice upon successful activation.
     */
    public function igthemes_activation_admin_notice() {
        global $pagenow;

        if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // input var okay
            add_action( 'admin_notices', array( $this, 'igthemes_welcome_admin_notice' ), 99 );
        }
    }

    /**
     * Display an admin notice linking to the welcome screen
     */
   public function igthemes_welcome_admin_notice() {
        ?>
    <div class="updated notice is-dismissible">
        <p>
            <?php echo esc_html__( 'Thanks for choosing ', 'base-wp' ). wp_get_theme()->get( 'Name' );
            echo sprintf( esc_html__('! You can read documentation to how get the most out of your new theme on the %swelcome screen%s.', 'base-wp' ), '<a href="' . esc_url( admin_url( 'themes.php?page=igthemes-welcome' ) ) . '">', '</a>' ); ?>
        </p>
        <p>
            <a href="<?php echo esc_url( admin_url( 'themes.php?page=igthemes-welcome' ) ); ?>" class="button button-primary" style="text-decoration: none;">
                <?php echo sprintf( esc_html__( 'Get started with %s', 'base-wp' ), wp_get_theme()->get( "Name" ) ); ?>
            </a>
        </p>
    </div>
        <?php
    }

    /**
     * Load welcome screen css
     */
    public function igthemes_welcome_style( $hook_suffix ) {
        if ( 'appearance_page_igthemes-welcome' == $hook_suffix ) {
            wp_enqueue_style( 'igthemes-welcome-screen', get_template_directory_uri() . '/inc/admin/welcome/css/welcome.css', '1.0' );
            wp_enqueue_script( 'igthemes-welcome-tab-script',  get_template_directory_uri() . '/inc/admin/welcome/js/tab.js' , '1.0' );
        }
    }

    /**
     * Creates the dashboard page
     */
    public function igthemes_welcome_register_menu() {
        add_theme_page( wp_get_theme()->get( 'Name' ), wp_get_theme()->get( 'Name' ), 'read', 'igthemes-welcome', array( $this, 'igthemes_welcome_screen' ) );
    }

    /**
     * The welcome screen
     */
    public function igthemes_welcome_screen() {
        require_once( ABSPATH . 'wp-load.php' );
        require_once( ABSPATH . 'wp-admin/admin.php' );
        require_once( ABSPATH . 'wp-admin/admin-header.php' );
        ?>
        <div class="wrap about-wrap">
            <?php do_action( 'igthemes_welcome' ); ?>
        </div>
        <?php
    }

    /**
     * Welcome screen tabs
     */
    public function igthemes_welcome_tabs() {
        require_once( get_template_directory() . '/inc/admin/welcome/sections/tabs.php' );
    }
    /**
     * Welcome screen getting started
     */
    public function igthemes_welcome_getting_started() {
        require_once( get_template_directory() . '/inc/admin/welcome/sections/getting-started.php' );
    }
    /**
     * Welcome screen free resource
     */
    public function igthemes_welcome_wp_resources() {
        require_once( get_template_directory() . '/inc/admin/welcome/sections/wp-resources.php' );
    }
    /**
     * Welcome screen system info
     */
    public function igthemes_welcome_sysinfo() {
        require_once( get_template_directory() . '/inc/admin/welcome/sections/system-info.php' );
    }

}

$GLOBALS['IGthemes_Welcome'] = new IGthemes_Welcome();
