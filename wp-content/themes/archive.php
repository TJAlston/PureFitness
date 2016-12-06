<?php

get_header();

if (have_posts()) :

  ?>
  <h2> <?php
  if (is_category()) {
    single_cat_title();
  } elseif (is_tag()) {
    single_tag_title();
  } elseif (is_author()) {
    the_post();
    echo 'Author Archives: ' . get_the_author();
    rewind_posts();
  } elseif (is_day()) {
    echo 'Daily Archives: ' . get_the_date();
  } elseif (is_month()) {
    echo 'Monthly Archives: ' . get_the_date('F Y');
  } elseif (is_year()) {
    echo 'Yearly Archives: ' . get_the_date('Y');
  } else {
    echo 'Archives';
  }
  ?></h2>

  <?php
  while (have_posts()) : the_post(); ?>

<article class="post <?php if ( has_post_thumbnail() ) {?> has-thumbnail <?php } ?>">
  <h2> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

  <p class="post-info"><?php the_time('F j, Y g:i a'); ?> | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> | Posted in <?php
  $categories = get_the_category();
  $separator = ", ";
  $output = '';

  if ($categories) {

    foreach ($categories as $category) {
      $output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator; $category->cat_name . $separator;
    }

    echo trim($output, $separator);
  }
  //trim gets rid of the extra comma at the end of the categories section

   ?></p>

  <!-- Format display that codes the date F (spell out month) jS(j-day without leading 0 - S suffix of day ie 4th) Y (year) g:i a'(exact time published)-->
  <div class="post-thumbnail">
    <?php the_post_thumbnail('small-thumbnail'); ?>
 </div>

   <!-- <div class="has-thumbnail"> -->
    <p>
    <?php echo get_the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>"> Read more&raquo;</a>
  </p>
<!-- </div> -->
</article>

  <?php endwhile;

  else :
    echo '<p> No content found</p>';

  endif;

get_footer();
 ?>
