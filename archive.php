
<?php

get_header();
?>

<h1><?php the_archive_title(); ?></h1>

<!-- <h1><?php 
if (is_category()) {
    single_cat_title();
}
if  (is_author()) {
    echo 'Posts by'; the_author();
}
?></h1> -->

<?php 
while(have_posts()) {
    the_post();?>
    <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
    <p>Posted by <?php the_author_posts_link(); ?>  on <?php the_time('d-n-Y'); ?> in <?php echo get_the_category_list(', '); ?></p>
    <div><?php the_excerpt(); ?></div>
    <p><a href="<?php the_permalink(); ?>">Continue Reading</a></p>
    <hr>

<?php } 
?>
<div>
<?php
echo paginate_links();
?>    
</div>
<?php 
get_footer();
?>



