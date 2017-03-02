<?php

/**
 * Classe Poll_Widget 
 */
class Poll_Widget extends WP_Widget
{
    /**
     * Constructeur
     */
    public function __construct()
    {
        parent::__construct(
            false,
            __('Poll'),
            array('description' => __('A widget to propose the poll to visitors', 'textdomain'))
        );
    }

    /**
     * Affichage du widget
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];

        global $wpdb;
        $options = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}poll_options"); ?>

        <h3><?php echo get_option('poll_question'); ?></h3>

        <form action="" method="post">
            <ol>
                <?php if(isset($_COOKIE['poll']) || isset($_POST['poll'])) : ?>
                    <?php foreach ($options as $current_option) : ?>
                        <?php $row = $wpdb->get_row("SELECT total FROM {$wpdb->prefix}poll_results WHERE option_id = '{$current_option->id}'"); ?>
                        <li>
                            <label><?php echo $current_option->label . ' : '; ?> </label>
                            <span><?php echo (!empty($row->total) ? $row->total.' '.__('Vote', 'textdomain') : '0 '.__('Vote', 'textdomain')); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php foreach ($options as $current_option) : ?>
                        <li>
                            <input
                                type="radio"
                                name="poll_check_option"
                                value="<?php echo $current_option->id; ?>"
                                id="<?php echo 'poll_option_check-'.$current_option->id; ?>"
                            />

                            <label for="<?php echo 'poll_option_check-'.$current_option->id; ?>">
                                <?php echo $current_option->label; ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ol>

            <input type="hidden" name="poll" value="1"/>
            <?php echo (isset($_COOKIE['poll']) || isset($_POST['poll']) ? '' : '<input type="submit" />'); ?>
        </form>

        <?php echo $args['after_widget'];
    }

    /**
     * Affichage du formulaire dans l'administration
     */
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';

        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php echo __( 'Title:' ); ?>
            </label>

            <input
                class="widefat"
                id="<?php echo $this->get_field_id( 'title' ); ?>"
                name="<?php echo $this->get_field_name( 'title' ); ?>"
                type="text"
                value="<?php echo $title; ?>"
            />
        </p>

        <?php
    }
}
