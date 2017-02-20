<?php get_header(); ?>

<div class="container">
    <div class="content">
      <?php
      while (have_posts()) {
        the_post();
        get_template_part('content');
      }?>
    </div>
    <?php get_sidebar() ?>
</div>


<?php get_footer();
