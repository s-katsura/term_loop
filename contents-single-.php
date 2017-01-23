<?php
$page_type = get_post_type();
 echo $page_type;
?>

<h2>FAQ</h2>

<?php if(have_posts()): while (have_posts()): the_post(); ?>
<?php
$terms = wp_get_object_terms($post->ID, $page_type. '_category');
if(!empty($terms)){
  if(!is_wp_error( $terms)){
    foreach($terms as $term){
      echo '<h3>'.$term->name.'</h3>';
    }
  }
}
?>
<h4><?php the_title(); ?></h4>
<div>
  <h5><?php if(get_field('q_zen')) {echo get_field('q_zen');} ?></h5>
  <p><?php the_content(); ?></p>
</div>
<?php endwhile; wp_reset_query(); else:?>
<p>No Data.</p>
<?php endif; ?>
