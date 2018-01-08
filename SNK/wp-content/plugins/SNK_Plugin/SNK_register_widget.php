<?php

class SNK_register_widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('SNK_Register', 'Enregistrement', array('description' => 'Un formulaire d\'enregistrement à SNK.'));

    }
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        ?>
        <form action="" method="post">
            <p>
                <label for="SNK_newsletter_email">Votre email :</label>
                <input id="SNK_newsletter_email" name="SNK_newsletter_email" type="email"/>
            </p>
            <input type="submit"/>
        </form>
        <?php
        echo $args['after_widget'];
    }
}
