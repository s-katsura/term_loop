<?php
$page_type = get_post_type();
// echo $page_type;
?>

<h2>FAQ</h2>

<?php
$args = array(
  'posts_per_page' => -1,
  'category_name' => '',
  'orderby' => 'id',
  'include' => '',
  'exclude' => '',
  'post_type' => $page_type,
  'post_status' => 'publish',
);
  $taxonomy_name = $page_type. '_category';
  $taxonomys = get_terms($taxonomy_name,$args);
  if(!is_wp_error($taxonomys) && count($taxonomys)):
  foreach($taxonomys as $taxonomy):
  $url = get_term_link($taxonomy->slug, $taxonomy_name);
  $tax_posts = get_posts(array(
    'post_type' => get_post_type(),
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy'=> $page_type. '_category',
        'terms' => array($taxonomy->slug),
        'field' => 'slug',
        'include_children' => true,
        'operator' => 'IN'
      ),
      'relation' => 'AND'
      )
    ));
  if($tax_posts):
?>
<h3><?php echo esc_html($taxonomy->name); ?></h3>
<?php foreach($tax_posts as $tax_post): ?>
<h4><?php echo $tax_post->post_title; ?></h4>
<div>
  <h5><?php if(get_field('q_zen', $tax_post->ID)) {echo get_field('q_zen', $tax_post->ID);} ?></h5>
  <?php echo $tax_post->post_content; ?>
</div>
<?php endforeach; ?>
<?php endif; endforeach; endif; ?>
