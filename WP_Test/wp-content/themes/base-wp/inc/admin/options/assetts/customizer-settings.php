<?php
//start class
class IGthemes_Customizer {
	//start
    public function __construct() {
			add_action( 'customize_register',              array( $this, 'customize_register' ), 10 );
			add_action( 'customize_controls_print_styles', array( $this, 'customizer_custom_control_css' ), 30 );
    }
    /*+++++++++++++++++++++++++++++++++++++++++++++
    CUSTOMIZER SETTINGS AND OPTIONS
    +++++++++++++++++++++++++++++++++++++++++++++*/
    public function customize_register($wp_customize) {
        //DEFAULTS
        include dirname( __FILE__ ) . '/customizer-defaults.php';
        //PANEL
        $wp_customize->add_panel( 'igtheme_options', array(
          'title' => __( 'Theme Settings', 'base-wp'),
          'description' => '', 
          'priority' => 10, 
        ) );
        // HOME
        $wp_customize->add_section('home-settings', array(
            'title' => __('Home', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 5, 
         ));
        // LAYOUT
        $wp_customize->add_section('layout-settings', array(
            'title' => __('Layout', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 10, 
         ));
        // HEADER
        $wp_customize->add_section( 'header-settings' , array(
          'title' => __( 'Header', 'base-wp'),
          'panel' => 'igtheme_options',
          'priority' => 20, 
        ) );
        // TYPOGRAPHY
        $wp_customize->add_section('typography-settings', array(
            'title' => __('Typography', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 30, 
        ));
        // BUTTONS
        $wp_customize->add_section('buttons-settings', array(
            'title' => __('Buttons', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 40, 
         ));
        // FOOTER
        $wp_customize->add_section('footer-settings', array(
            'title' => __('Footer', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 50, 
        ));
        // SOCIAL
        $wp_customize->add_section('social-settings', array(
            'title' => __('Social', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 60, 
        ));
        // SHOP
        $wp_customize->add_section('shop-settings', array(
            'title' => esc_html__('Shop', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 70,
        ));
        // ADVANCED
        $wp_customize->add_section('advanced-settings', array(
            'title' => esc_html__('Advanced', 'base-wp'),
            'panel' => 'igtheme_options',
            'priority' => 80,
        ));

        //PREMIUM OPTIONS
        include dirname( __FILE__ ) . '/customizer-premium.php';
        //THEME IPTIONS
        include dirname( __FILE__ ) . '/customizer-options.php';
        //END
    }

    /*+++++++++++++++++++++++++++++++++++++++++++++
    CUSTOM CONTROL CSS
    +++++++++++++++++++++++++++++++++++++++++++++*/
    public function customizer_custom_control_css() {
        ?>
        <style>
        .customize-control-radio-image .image.ui-buttonset input[type=radio] {
            height: auto;
        }
        .customize-control-radio-image .image.ui-buttonset label {
            display: inline-block;
            width: 30%;
            padding: 1%;
            box-sizing: border-box;
        }
        .customize-control-radio-image .image.ui-buttonset label.ui-state-active {
            background: none;
        }
        .customize-control-radio-image .customize-control-radio-buttonset label {
            background: #f7f7f7;
            line-height: 35px;
        }
        .customize-control-radio-image label img {
            border: 2px solid #eee;
        }
        #customize-controls .customize-control-radio-image label img {
            height: auto;
        }
        .customize-control-radio-image label.ui-state-active img {
            border: 2px solid #fff;
            background: #fff;
        }
        .customize-control-radio-image label.ui-state-hover img {
            border: 2px solid #fff;
        }
        .customize-control-heading {
            background: #fafafa;
            margin: 0 -12px 12px -12px;
            padding: 12px 12px 8px 12px;
            border-top: 1px solid #eaeaea;
            border-bottom: 1px solid #eaeaea;
        }
        #customize-control-upgrade_premium .button-upgrade {
              background: #fc3;
              border: 1px solid #e6ac00;
              color: #5d4b16;
              text-transform: uppercase;
              display: inline-block;
              text-decoration: none;
              font-size: 13px;
              line-height: 30px;
              height: 32px;
              margin: 15px 0;
              padding: 0 20px 1px;
              cursor: pointer;
              -webkit-appearance: none;
              -webkit-border-radius: 2px;
              border-radius: 2px;
              white-space: nowrap;
              -webkit-box-sizing: border-box;
              -moz-box-sizing: border-box;
              box-sizing: border-box;
              text-shadow: 2px 2px #fd3;
        }
        #customize-control-upgrade_premium .button-upgrade:hover {
            background: #fd3;
            color: #5d4b16;
            border-color: #ffc61a;
        }
        #customize-control-upgrade_premium ul {
            list-style: square;
            margin: 10px 16px;
        }
        </style>
        <?php
    }
//END OF CLASS
}
return new IGthemes_Customizer();
