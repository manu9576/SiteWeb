<?php
/*****************************************************************
* PREMIUM
******************************************************************/
    if ( apply_filters( 'igthemes_customizer_more', true ) ) {
        
        $wp_customize->add_section( 'upgrade_premium' , array(
            'title'      		=> __( 'More Options', 'base-wp' ),
            'panel'             => 'igtheme_options',
            'priority'   		=> 1,
        ) );

        $wp_customize->add_setting( 'upgrade_premium', array(
            'default'    		=> null,
            'sanitize_callback' => 'igthemes_sanitize_text',
        ) );

        $wp_customize->add_control( new IGthemes_More_Control( $wp_customize, 'upgrade_premium', array(
            'label'    			=> __( 'Looking for more options?', 'base-wp' ),
            'section'  			=> 'upgrade_premium',
            'settings' 			=> 'upgrade_premium',
            'priority' 			=> 1,
        ) ) );
        
// LAYOUT SETTINGS ****************************

//main_posts_columns
    $wp_customize->add_setting('main_posts_columns', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'main_posts_columns', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Show posts in columns', 'base-wp'),
        'section' => 'layout-settings',
        'settings' => 'main_posts_columns',
        'priority'   => 3
    ) ) );   
//lightbox
    $wp_customize->add_setting('lightbox', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'lightbox', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Enable image lightbox', 'base-wp'),
        'section' => 'layout-settings',
        'settings' => 'lightbox',
        'priority'   => 7
    ) ) );
        
// HEADER SETTINGS ****************************
//header_layout
    $wp_customize->add_setting('header_layout', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'header_layout', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Select the header layout', 'base-wp'),
        'section' => 'header-settings',
        'settings' => 'header_layout',
        'priority'   => 2
    ) ) );
//header_mobile_nav
    $wp_customize->add_setting('header_mobile_nav', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'header_mobile_nav', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Choose the mobile menu: Off-Canvas - Multi-Level - Standard', 'base-wp'),
        'section' => 'header-settings',
        'settings' => 'header_mobile_nav',
        'priority'   => 4
    ) ) );
//header_nav_sticky
    $wp_customize->add_setting('header_nav_sticky', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'header_nav_sticky', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Enable sticky menu', 'base-wp'),
        'section' => 'header-settings',
        'settings' => 'header_nav_sticky',
        'priority'   => 5
    ) ) );

        
// TYPOGRAPHY SETTINGS ****************************
     
    //font_google
    $wp_customize->add_setting('font_google', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_google', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Add your preferred Google Font', 'base-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_google',
        'priority'   => 6

    ) ) );
    //font_family_headings
    $wp_customize->add_setting('font_family_headings', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_family_headings', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Headings font family', 'base-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_family_headings',
        'priority'   => 7
    ) ) );
    //font_family_body
    $wp_customize->add_setting('font_family_body', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_family_body', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Body font family', 'base-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_family_body',
        'priority'   => 8
    ) ) );
    //font_size
    $wp_customize->add_setting('font_size', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_size', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Change body and headings font size', 'base-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_size',
    ) ) );
// FOOTER SETTINGS ****************************
    //footer_remove_credits
    $wp_customize->add_setting('footer_remove_credits', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'footer_remove_credits', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Remove footer credits', 'base-wp'),
        'section' => 'footer-settings',
        'settings' => 'footer_remove_credits',
    ) ) );
    //footer_text
    $wp_customize->add_setting('footer_text', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'footer_text', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Custom footer text', 'base-wp'),
        'section' => 'footer-settings',
        'settings' => 'footer_text',
    ) ) );
// SHOP SETTINGS ****************************
    //shop_sidebar
    $wp_customize->add_setting('shop_sidebar', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_sidebar', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Select the shop layout', 'base-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_sidebar',
        'priority'   => 2
    ) ) );
    //shop_products_number
    $wp_customize->add_setting('shop_products_number', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_products_number', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Products per page', 'base-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_products_number',
        'priority'   => 3
    ) ) );
    //shop_menu_link
    $wp_customize->add_setting('shop_menu_link', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_menu_link', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Display shopping cart link', 'base-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_menu_link',
        'priority'   => 5
    ) ) );

    //shop_button_colors
    $wp_customize->add_setting('shop_button_colors', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_button_colors', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => esc_html__('Change shop buttons colors', 'base-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_button_colors',
    ) ) );
        
// ADVANCED SETTINGS ****************************   
        
    //custom_css
    $wp_customize->add_setting('custom_css', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'custom_css', array(
        'label' => esc_html__('Custom CSS', 'base-wp'),
        'description' => esc_html__('Add your custom css code', 'base-wp'),
        'section' => 'advanced-settings',
        'settings' => 'custom_css',
    ) ) );
    //custom_js
    $wp_customize->add_setting('custom_js', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'custom_js', array(
        'label' => esc_html__('Custom JS', 'base-wp'),
        'description' => esc_html__('Add your custom js code', 'base-wp'),
        'section' => 'advanced-settings',
        'settings' => 'custom_js',
    ) ) );
    //end
  }