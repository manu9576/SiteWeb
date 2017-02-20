<?php
/**
 * Welcome screen add-ons template
 */
?>
<?php
    $theme_data = wp_get_theme('base-wp');
    //plugins link
    $shortpixel_url = 'https://shortpixel.com/h/af/LJQZXIM68719';
    $yoastseo_url = 'https://wordpress.org/plugins/wordpress-seo/';
    $woocommerce_url = 'https://wordpress.org/plugins/woocommerce/';
    $beaverbuilder_url= 'https://wordpress.org/plugins/beaver-builder-lite-version/';
    $edd_url= 'https://wordpress.org/plugins/easy-digital-downloads/';
    $elementor_url= 'https://wordpress.org/plugins/elementor/';
?>
<div id="wp_resources" class="panel">
    <h3><?php esc_html_e( 'Recommended Resources', 'base-wp' ); ?></h3>
    <p class="description"><?php printf(esc_html__('%s works well with the following WordPress free and premium plugins and services. Feel free to give they a look.', 'base-wp'), $theme_data->Name); ?></p>
    
    <ul class="resurces">
        <!-- 01 item -->
        <li class="item">
            <a class="image-link" href="<?php echo $shortpixel_url; ?>" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/inc/admin/welcome/images/shortpixel.png" alt="Shortpixel plugin" />
            </a>
            <h4 class="title">
                <?php esc_html_e( 'Shortpixel', 'base-wp' ); ?>
            </h4>
            <p class="description">
                <?php esc_html_e('Speed up your website with beautifully optimized images.', 'base-wp'); ?>
            </p>
            <?php  if ( is_plugin_active( 'shortpixel-image-optimiser/wp-shortpixel.php' ) ) { ; ?>
                <p class="button disabled"><?php esc_html_e( 'plugin active', 'base-wp' ); ?></p>
            <?php  } else { ; ?>
                <a class="button secondary-button" href="<?php echo $shortpixel_url; ?>" target="_blank">
                    <?php esc_html_e( 'view now', 'base-wp' ); ?>
                </a>
            <?php  } ; ?>
        </li>
        <!-- 02 item -->
        <li class="item">
            <a class="image-link" href="<?php echo $yoastseo_url; ?>" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/inc/admin/welcome/images/yoastseo.png" alt="Yoast SEO plugin" />
            </a>
            <h4 class="title">
                <?php esc_html_e( 'Yoast SEO', 'base-wp' ); ?>
            </h4>
            <p class="description">
                <?php esc_html_e('Write better content and have a fully optimized WordPress site using Yoast SEO plugin
.', 'base-wp'); ?>
            </p>
            <?php  if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) { ; ?>
                <p class="button disabled"><?php esc_html_e( 'plugin active', 'base-wp' ); ?></p>
            <?php  } else { ; ?>
                <a class="button secondary-button" href="<?php echo $yoastseo_url; ?>" target="_blank">
                 <?php esc_html_e( 'view now', 'base-wp' ); ?>
                </a>
            <?php  } ; ?>
        </li>
        <!-- 03 item -->
        <li class="item">
            <a class="image-link" href="<?php echo $woocommerce_url; ?>" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/inc/admin/welcome/images/woocommerce.png" alt="Yoast SEO plugin" />
            </a>
            <h4 class="title">
                <?php esc_html_e( 'WooCommerce', 'base-wp' ); ?>
            </h4>
            <p class="description">
                <?php esc_html_e('WooCommerce is a powerful, extendable eCommerce plugin that helps you sell anything.', 'base-wp'); ?>
            </p>
            <?php  if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) { ; ?>
                <p class="button disabled"><?php esc_html_e( 'plugin active', 'base-wp' ); ?></p>
            <?php  } else { ; ?>
                <a class="button secondary-button" href="<?php echo $woocommerce_url; ?>/" target="_blank">
                    <?php esc_html_e( 'view now', 'base-wp' ); ?>
                </a>
            <?php  } ; ?>
        </li>
        <!-- 04 item -->
        <li class="item">
            <a class="image-link" href="<?php echo $beaverbuilder_url; ?>" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/inc/admin/welcome/images/beaverbuilder.png" alt="Beaver Builder plugin" />
            </a>
            <h4 class="title">
                <?php esc_html_e( 'Beaver Builder', 'base-wp' ); ?>
            </h4>
            <p class="description">
         <?php esc_html_e('Easily build beautiful home pages, professional landing pages, and more with this content builder.', 'base-wp'); ?>
            </p>
            <?php  if ( is_plugin_active( 'beaver-builder-lite-version/fl-builder.php' ) ) { ; ?>
                <p class="button disabled"><?php esc_html_e( 'plugin active', 'base-wp' ); ?></p>
            <?php  } else { ; ?>
                <a class="button secondary-button" href="<?php echo $woocommerce_url; ?>/" target="_blank">
                    <?php esc_html_e( 'view now', 'base-wp' ); ?>
                </a>
            <?php  } ; ?>
        </li>
        <!-- 05 item -->
        <li class="item">
            <a class="image-link" href="<?php echo $edd_url; ?>" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/inc/admin/welcome/images/edd.png" alt="Easy Digital Downloads plugin" />
            </a>
            <h4 class="title">
                <?php esc_html_e( 'Easy Digital Downloads', 'base-wp' ); ?>
            </h4>
            <p class="description">
         <?php esc_html_e('Sell digital downloads through WordPress with this complete digital downloads management plugin.', 'base-wp'); ?>
            </p>
            <?php  if ( is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ) ) { ; ?>
                <p class="button disabled"><?php esc_html_e( 'plugin active', 'base-wp' ); ?></p>
            <?php  } else { ; ?>
                <a class="button secondary-button" href="<?php echo $edd_url; ?>/" target="_blank">
                    <?php esc_html_e( 'view now', 'base-wp' ); ?>
                </a>
            <?php  } ; ?>
        </li>
        <!-- 06 item -->
        <li class="item">
            <a class="image-link" href="<?php echo $elementor_url; ?>" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/inc/admin/welcome/images/elementor.png" alt="Elementor plugin" />
            </a>
            <h4 class="title">
                <?php esc_html_e( 'Elementor', 'base-wp' ); ?>
            </h4>
            <p class="description">
         <?php esc_html_e('Elementor is the most advanced frontend drag & drop page builder.', 'base-wp'); ?>
            </p>
            <?php  if ( is_plugin_active( 'elementor/elementor.php' ) ) { ; ?>
                <p class="button disabled"><?php esc_html_e( 'plugin active', 'base-wp' ); ?></p>
            <?php  } else { ; ?>
                <a class="button secondary-button" href="<?php echo $elementor_url; ?>/" target="_blank">
                    <?php esc_html_e( 'view now', 'base-wp' ); ?>
                </a>
            <?php  } ; ?>
        </li>
    </ul>
    
</div><!-- end ig-started -->