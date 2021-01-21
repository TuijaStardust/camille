
<?php

get_header();
?>

<h1>Past Events</h1>

<?php 

$today = date('Ymd');
$pastEvents = new WP_Query(array( 
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',   // järjestyksen suunta ASC / DESC
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'compare' => '<',
            'value' => date($today),
            'type' => 'numeric' 
        )
    )
));

while($pastEvents->have_posts()) {
    $pastEvents-> the_post();?>
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

<?php } wp_reset_postdata();
?>
<div>
<?php
echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
));
?>    
</div>

<?php 
get_footer();
?>
