
<?php

get_header();
?>

<h1>All Events</h1>

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
    <p><a href="#">
                <span><?php
                $eventDate = new DateTime(get_field('event_date'));
                echo $eventDate->format('M');
                ?></span>
                 <span><?php 
                echo $eventDate->format('d');
                ?></span>
            </a></p>
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

<div>
<p><a href="<?php echo site_url('/past-events'); ?>">Menneet tapahtumat</a></p>
</div>

<?php 
get_footer();
?>



