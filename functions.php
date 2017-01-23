<?php
/*================================================
管理画面一覧にカスタムタクソノミー、タームを表示、ソート機能追加
===============================================*/
//　カスタムタクソノミー名の列追加
function add_custom_column_news( $defaults ) {
  $defaults['カスタム投稿名_category'] = 'カテゴリ';
  return $defaults;
}
add_filter('manage_カスタム投稿名_posts_columns', 'add_custom_column_news');

// ターム表示
function add_custom_column_id_news($column_name, $id) {
  if( $column_name == 'カスタム投稿名_category' ) {
    echo get_the_term_list($id, 'カスタム投稿名_category', '', ', ');
  }

}
add_action('manage_カスタム投稿名_posts_custom_column', 'add_custom_column_id_news', 10, 2);

//　ソート機能
function add_post_taxonomy_restrict_filter() {
  global $post_type;
  if ('カスタム投稿名' == $post_type) {
    echo '<select name="カスタム投稿名_category">';
      echo '<option value="">カテゴリー指定なし</option>';
      $terms = get_terms('カスタム投稿名_category', 'hide_empty=0');
      foreach ($terms as $term) {
        echo '<option value="' . $term->slug  . '">' . $term->name . '</option>';
      }
    echo '</select>';
  }
}
add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );