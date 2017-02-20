<article class="post">
  <h1><?php the_title() ?></h1>
  <div>
    <?php the_content(); ?>
  </div>
  <?php comments_template() ?>
  <?php comment_form(); ?>
</article>


