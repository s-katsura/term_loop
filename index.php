<?php get_header(); ?>

<div id="content">
  <div class="container">
    <?php
    } elseif (is_singular(array('', ''))) {
      get_template_part('template/contents', 'single-');
    } elseif (is_post_type_archive(array('', ''))) {
      get_template_part('template/contents', 'archive-');
    }
    ?>
  </div>
</div>
<?php get_template_part('template/backtotop'); ?>

<?php get_footer(); ?>