<?php
/*****************************************************************
* HOME SETTINGS
******************************************************************/
//home_heading
    $wp_customize->add_setting( 'home_heading', array(
        'sanitize_callback' => 'igthemes_sanitize_textarea',
    ));

    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'home_heading', array(
         'section' => 'home-settings',
         'label' => __( 'Posts', 'base-wp' ),
         'description' => __( '', 'base-wp' ),
         'active_callback' => 'is_home',
    ) ) );
//home_posts_per_page
    $wp_customize->add_setting( 'home_posts_per_page', array(
        'default' => '12',
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control('home_posts_per_page', array(
        'label' => __('', 'base-wp'),
        'description' => __('Change the number of posts showed in the home page.', 'base-wp'),
        'type' => 'number',
        'section' => 'home-settings',
        'settings' => 'home_posts_per_page',
        'input_attrs' => array(
            'style' => 'width: 65px;',
        ),
         'active_callback' => 'is_home',
    ));
//home_portfolio_heading
    $wp_customize->add_setting( 'home_portfolio_heading', array(
        'sanitize_callback' => 'igthemes_sanitize_textarea',
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'home_portfolio_heading', array(
         'section' => 'home-settings',
         'label' => __( 'Portfolio section', 'base-wp' ),
         'description' => __( 'To use this section you must download and install our free <a href="https://wordpress.org/plugins/ig-portfolio/" target="_blank">IG Portfolio</a> plugin.', 'base-wp' ),
         'active_callback' => 'is_home',
    ) ) );
//home_portfolio
    $wp_customize->add_setting('home_portfolio', array(
        'sanitize_callback' => 'igthemes_sanitize_checkbox',
        'default' => 0,
    ));
    $wp_customize->add_control('home_portfolio', array(
        'label' => __('Enable portfolio section?', 'base-wp'),
        'description' => __('', 'base-wp'),
        'type' => 'checkbox',
        'section' => 'home-settings',
        'settings' => 'home_portfolio',
        'active_callback' => 'is_home',
    ));
//home_portfolio_title
    $wp_customize->add_setting('home_portfolio_title', array(
        'default' => __('Our new projects', 'base-wp'),
        'sanitize_callback' => 'igthemes_sanitize_textarea',
    ));
    $wp_customize->add_control('home_portfolio_title', array(
        'label' => __('', 'base-wp'),
        'description' => __('Section title', 'base-wp'),
        'type' => 'text',
        'section' => 'home-settings',
        'settings' => 'home_portfolio_title',
        'active_callback' => 'is_home',
    ));
//home_portfolio_description
    $wp_customize->add_setting('home_portfolio_description', array(
        'sanitize_callback' => 'igthemes_sanitize_text',
        'default' => __('See our latest works!', 'base-wp'),
         'active_callback' => 'is_home',
    ));
    $wp_customize->add_control('home_portfolio_description', array(
        'label' => __('', 'base-wp'),
        'description' => __('Section description', 'base-wp'),
        'type' => 'textarea',
        'section' => 'home-settings',
        'settings' => 'home_portfolio_description',
        'active_callback' => 'is_home',
    ));
//home_portfolio_tax
    $wp_customize->add_setting( 'home_portfolio_tax', array(
        'default' => '',
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control('home_portfolio_tax', array(
        'label' => __('', 'base-wp'),
        'description' => __('Write the slug of the category you want to show', 'base-wp'),
        'type' => 'text',
        'section' => 'home-settings',
        'settings' => 'home_portfolio_tax',
        'active_callback' => 'is_home',
    ));
//home_testimonials_heading
    $wp_customize->add_setting( 'home_testimonials_heading', array(
        'sanitize_callback' => 'igthemes_sanitize_textarea',
    ));

    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'home_testimonials_heading', array(
         'section' => 'home-settings',
         'label' => __( 'Testimonials section', 'base-wp' ),
         'description' => __( 'To use this section you must download and install our free <a href="https://wordpress.org/plugins/ig-testimonals/" target="_blank">IG Testimonials</a> plugin.', 'base-wp' ),
         'active_callback' => 'is_home',
    ) ) );
//home_testimonials
    $wp_customize->add_setting('home_testimonials', array(
        'sanitize_callback' => 'igthemes_sanitize_checkbox',
        'default' => 0,
    ));
    $wp_customize->add_control('home_testimonials', array(
        'label' => __('Enable testimonials section?', 'base-wp'),
        'description' => __('', 'base-wp'),
        'type' => 'checkbox',
        'section' => 'home-settings',
        'settings' => 'home_testimonials',
        'active_callback' => 'is_home',
    ));
//home_testimonials_title
    $wp_customize->add_setting('home_testimonials_title', array(
        'default' => __('What our clients says', 'base-wp'),
         'sanitize_callback' => 'igthemes_sanitize_textarea',
    ));
    $wp_customize->add_control('home_testimonials_title', array(
        'label' => esc_html__('', 'base-wp'),
        'description' => __('Section title', 'base-wp'),
        'type' => 'text',
        'section' => 'home-settings',
        'settings' => 'home_testimonials_title',
        'active_callback' => 'is_home',
    ));
//home_testimonials_description
    $wp_customize->add_setting('home_testimonials_description', array(
        'sanitize_callback' => 'igthemes_sanitize_text',
        'default' => __('We make every thing with best quality, our customers and partners are very happy!', 'base-wp'),
    ));
    $wp_customize->add_control('home_testimonials_description', array(
        'label' => __('', 'base-wp'),
        'description' => __('Section description', 'base-wp'),
        'type' => 'textarea',
        'section' => 'home-settings',
        'settings' => 'home_testimonials_description',
        'active_callback' => 'is_home',
    ));
//home_testimonials_tax
    $wp_customize->add_setting( 'home_testimonials_tax', array(
        'default' => '',
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control('home_testimonials_tax', array(
        'label' => __('', 'base-wp'),
        'description' => __('Write the slug of the category you want to show', 'base-wp'),
        'type' => 'text',
        'section' => 'home-settings',
        'settings' => 'home_testimonials_tax',
        'active_callback' => 'is_home',
    ));
/*****************************************************************
* LAYOUT SETTINGS
******************************************************************/
//Images
    $wp_customize->add_setting('blog-layout', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'blog-layout', array(
        'label' => esc_html__('Blog layout', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'layout-settings',
        'settings' => 'blog-layout',
        'priority'   => 1,
    ) ) );
//main layout
    $wp_customize->add_setting(
        'main_sidebar',
        array(
            'sanitize_callback' => 'igthemes_sanitize_choices',
            'default' => 'right',
    ));
    $wp_customize->add_control(
            new IGthemes_Radio_Image_Control(
            // $wp_customize object
            $wp_customize,
            // $id
            'main_sidebar',
            // $args
            array(
                'label'			=> __( '', 'base-wp' ),
                'description'	=> __( 'Select the blog layout', 'base-wp' ),
                'priority' =>   2, 
                'type'          => 'radio-image',
                'section'		=> 'layout-settings',
                'settings'      => 'main_sidebar',
                'choices'		=> array(
                    'left' 	    => get_template_directory_uri() . '/inc/admin/options/assetts/images/left.png',
                    'right' 	=> get_template_directory_uri() . '/inc/admin/options/assetts/images/right.png'
                )
            )
    ));
//main post content
    $wp_customize->add_setting('main_post_content', array(
        'sanitize_callback' => 'igthemes_sanitize_checkbox',
        'default' => 0,
    ));
    $wp_customize->add_control('main_post_content', array(
        'label' => esc_html__('Display full posts content', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'type' => 'checkbox',
        'section' => 'layout-settings',
        'settings' => 'main_post_content',
        'priority'   => 3
    ));
//Images
    $wp_customize->add_setting('images', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'images', array(
        'label' => esc_html__('Images', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'layout-settings',
        'settings' => 'images',
        'priority'   => 5,
    ) ) );
//main featured images
    $wp_customize->add_setting('main_featured_images', array(
        'sanitize_callback' => 'igthemes_sanitize_checkbox',
        'default' => 1,
    ));
    $wp_customize->add_control('main_featured_images', array(
        'label' => esc_html__('Display posts featured images', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'type' => 'checkbox',
        'section' => 'layout-settings',
        'settings' => 'main_featured_images',
        'priority'   => 6,
    ));
//Navigation
    $wp_customize->add_setting('navigation', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'navigation', array(
        'label' => esc_html__('Navigation', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'layout-settings',
        'settings' => 'navigation',
        'priority'   => 8,
    ) ) );
//breadcrumb
    $wp_customize->add_setting(
        'breadcrumb',
        array(
            'sanitize_callback' => 'igthemes_sanitize_checkbox',
    ));
    $wp_customize->add_control(
        'breadcrumb',
        array(
            'label'         => esc_html__('Display breadcrumb?', 'base-wp'),
            'description'   => __( 'Yoast Breadcrumb supported<br>NavXT Breadcrumb supported', 'base-wp'),
            'priority'      =>  9, 
            'type'          => 'checkbox',
            'section'       => 'layout-settings',
            'settings'      => 'breadcrumb',
    ));
//numeric_pagination
    $wp_customize->add_setting(
        'numeric_pagination',
        array(
            'sanitize_callback' => 'igthemes_sanitize_checkbox',
    ));
    $wp_customize->add_control(
        'numeric_pagination',
        array(
            'label'         => esc_html__('Use numeric pagination ?', 'base-wp'),
            'description'   => __( 'WP-PageNavi supported', 'base-wp'),
            'priority'      => 10,
            'type'          => 'checkbox',
            'section'       => 'layout-settings',
            'settings'      => 'numeric_pagination',
    ));
/*****************************************************************
* HEADER SETTINGS
******************************************************************/
//Header layout
    $wp_customize->add_setting('header-layout', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'header-layout', array(
        'label' => esc_html__('Layout', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'header-settings',
        'settings' => 'header-layout',
        'priority'   => 1,
    ) ) );
//Header menu
    $wp_customize->add_setting('header-menu', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'header-menu', array(
        'label' => esc_html__('Menu', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'header-settings',
        'settings' => 'header-menu',
        'priority'   => 3,
    ) ) );
//Header Colors
    $wp_customize->add_setting('header-colors', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'header-colors', array(
        'label' => esc_html__('Colors', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'header-settings',
        'settings' => 'header-colors',
        'priority'   => 6,
    ) ) );        
//header color
    $wp_customize->add_setting(
        'header_background_color',
        array(
        
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $header_background_color,
        //'transport' => 'postMessage'

    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_background_color',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Background color', 'base-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_background_color',
            )
    ));
//header text color
    $wp_customize->add_setting(
        'header_text_color',
        array(
        
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $header_text_color,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_text_color',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Text color', 'base-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_text_color',
            )
    ));
//header link normal
    $wp_customize->add_setting(
        'header_link_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $header_link_normal,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_link_normal',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Link color', 'base-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_link_normal',
            )
    ));
//header link hover
    $wp_customize->add_setting(
        'header_link_hover',
        array(
        
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $header_link_hover,
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_link_hover',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Link hover color', 'base-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_link_hover',
            )
    ));
/*****************************************************************
* TYPOGRAPHY SETTINGS
******************************************************************/
    //Fonts Colors
    $wp_customize->add_setting('font-colors', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'font-colors', array(
        'label' => esc_html__('Colors', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'typography-settings',
        'settings' => 'font-colors',
        'priority' => 1
    ) ) );  
    //body text color
    $wp_customize->add_setting(
        'body_text_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $body_text_color,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_text_color',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Body text color', 'base-wp'),
                'priority' => 1,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_text_color',
            )
    ));
    //body headings color
    $wp_customize->add_setting(
        'body_headings_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $body_headings_color,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_headings_color',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Headings color', 'base-wp'),
                'priority' => 2,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_headings_color',
            )
    ));
    //body link normal
    $wp_customize->add_setting(
        'body_link_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $body_link_normal,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_link_normal',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Link color', 'base-wp'),
                'priority' => 3,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_link_normal',
            )
    ));
    //body link hover
    $wp_customize->add_setting(
        'body_link_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $body_link_hover,
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_link_hover',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Link hover color', 'base-wp'),
                'priority' => 4,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_link_hover',
            )
    ));
    //Fonts Family
    $wp_customize->add_setting('font-family', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'font-family', array(
        'label' => esc_html__('Font family', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'typography-settings',
        'settings' => 'font-family',
        'priority' => 5
    ) ) ); 
    //Font Size
    $wp_customize->add_setting('font-size', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'font-size', array(
        'label' => esc_html__('Font size', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'typography-settings',
        'settings' => 'font-size',
        'priority' => 9
    ) ) ); 
/*****************************************************************
* BUTTONS SETTINGS
******************************************************************/
    //Main buttons
    $wp_customize->add_setting('button', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'button', array(
        'label' => esc_html__('Colors', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'buttons-settings',
        'settings' => 'button',
        'priority' => 1
    ) ) ); 
    //button background color
    $wp_customize->add_setting(
        'button_background_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $button_background_normal,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_background_normal',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Background color', 'base-wp'),
                'priority' => 1,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_background_normal',
            )
    ));
    //button background hover
    $wp_customize->add_setting(
        'button_background_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $button_background_hover,
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_background_hover',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Background hover', 'base-wp'),
                'priority' => 2,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_background_hover',
            )
    ));
    //button text color
    $wp_customize->add_setting(
        'button_text_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $button_text_normal,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_text_normal',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Text normal', 'base-wp'),
                'priority' => 3,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_text_normal',
            )
    ));
    //button text hover
    $wp_customize->add_setting(
        'button_text_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $button_text_hover,
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_text_hover',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Text hover', 'base-wp'),
                'priority' => 4,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_text_hover',
            )
    ));
/*****************************************************************
* FOOTER SETTINGS
******************************************************************/
    //Footer Colors
    $wp_customize->add_setting('footer-colors', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'footer-colors', array(
        'label' => esc_html__('Colors', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'footer-settings',
        'settings' => 'button',
        'priority' => 1
    ) ) );
    //footer background color
    $wp_customize->add_setting(
        'footer_background_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $footer_background_color,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_background_color',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Background color', 'base-wp'),
                'priority' => 1,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_background_color',
            )
    ));
    //footer text color
    $wp_customize->add_setting(
        'footer_text_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $footer_text_color,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_text_color',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Text color', 'base-wp'),
                'priority' => 2,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_text_color',
            )
    ));
    //footer headings color
    $wp_customize->add_setting(
        'footer_headings_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $footer_headings_color,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_headings_color',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Hedings color', 'base-wp'),
                'priority' => 3,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_headings_color',
            )
    ));
    //footer link normal
    $wp_customize->add_setting(
        'footer_link_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $footer_link_normal,
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_link_normal',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Link color', 'base-wp'),
                'priority' => 4,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_link_normal',
            )
    ));
    //footer link hover
    $wp_customize->add_setting(
        'footer_link_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => $footer_link_hover,
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_link_hover',
            array(
                'label' => __('', 'base-wp'),
                'description' => __('Link hover color', 'base-wp'),
                'priority' => 5,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_link_hover',
            )
    ));
    //Footer Colors
    $wp_customize->add_setting('footer-content', array(
        'default'    		=> null,
        'sanitize_callback' => null,
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'footer-content', array(
        'label' => esc_html__('Footer content', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'footer-settings',
        'settings' => 'footer-content',
        'priority' => 6
    ) ) );
/*****************************************************************
* SOCIAL SETTINGS
******************************************************************/
//facebook
    $wp_customize->add_setting('facebook_url', array(
        'sanitize_callback' => 'igthemes_sanitize_url',
        'default' => 'https://www.facebook.com/iograficathemes'
    ));
    $wp_customize->add_control('facebook_url', array(
        'label' => esc_html__('Facebook url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'facebook_url',
    ));
//twitter
    $wp_customize->add_setting('twitter_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
        'default' => 'https://twitter.com/iograficathemes'
    ));
    $wp_customize->add_control('twitter_url', array(
        'label' => esc_html__('Twitter url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'twitter_url',
    ));
//google
    $wp_customize->add_setting('google_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
        'default' => 'https://plus.google.com/+Iograficathemes'
    ));
    $wp_customize->add_control('google_url', array(
        'label' => esc_html__('Google plus url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'google_url',
    ));
//pinterest
    $wp_customize->add_setting('pinterest_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('pinterest_url', array(
        'label' => esc_html__('Pinterest url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'pinterest_url',
    ));
//tumblr
    $wp_customize->add_setting('tumblr_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('tumblr_url', array(
        'label' => esc_html__('Tumblr url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'tumblr_url',
    ));
//instagram
    $wp_customize->add_setting('instagram_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('instagram_url', array(
        'label' => esc_html__('Instagram url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'instagram_url',
    ));
//linkedin
    $wp_customize->add_setting('linkedin_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('linkedin_url', array(
        'label' => esc_html__('Linkedin url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'linkedin_url',
    ));
//dribbble
    $wp_customize->add_setting('dribbble_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('dribbble_url', array(
        'label' => esc_html__('Dribble url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'dribbble_url',
    ));
//youtube
    $wp_customize->add_setting('youtube_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('youtube_url', array(
        'label' => esc_html__('Youtube url', 'base-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'youtube_url',
    ));
/*****************************************************************
* SHOP SETTINGS
******************************************************************/
    //Shop layout
    $wp_customize->add_setting('shop-layout', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'shop-layout', array(
        'label' => esc_html__('Layout', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop-layout',
        'priority'   => 1
    ) ) );
    //Shop header
    $wp_customize->add_setting('shop-header', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'shop-header', array(
        'label' => esc_html__('Menu', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop-header',
        'priority'   => 4
    ) ) );
    //Shop buttons
    $wp_customize->add_setting('shop-buttons', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Heading( $wp_customize, 'shop-buttons', array(
        'label' => esc_html__('Buttons', 'base-wp'),
        'description' => esc_html__('', 'base-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop-buttons',
        'priority'   => 6
    ) ) );