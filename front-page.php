<?php

get_header();

?>

<div>
    <h2>Parhaat jälkiruoat:</h2>

    <?php
    $homepagePosts = new WP_Query(array(
        'posts_per_page' => 2,
        'category_name' => 'jalkiruoka',
        'post_type' => 'post'
    ));

    while ($homepagePosts->have_posts()) {
        $homepagePosts->the_post(); ?>
        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
        <p><?php if (has_excerpt()) {
           echo get_the_excerpt();
            } else {
            echo wp_trim_words(get_the_content(), 20);
            }?>
        </p>
    <?php    
    } wp_reset_postdata();
    ?>
</div>

<div>
    <h2>Tulevat tapahtumat:</h2>
    
    <?php 
    $today = date('Ymd');
    $homepageEvents = new WP_Query(array(
        'posts_per_page' => 2, // Value -1 shows all items
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',   // järjestyksen suunta ASC / DESC
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => date($today),
                'type' => 'numeric' 
            )
        )
    ));

    while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post(); ?>
        <div>
            <a href="#">
                <span><?php
                $eventDate = new DateTime(get_field('event_date'));
                echo $eventDate->format('M');
                ?></span>
                 <span><?php 
                echo $eventDate->format('d');
                ?></span>
            </a>
        </div>
        <h2><a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php if (has_excerpt()) {
           echo get_the_excerpt();
            } else {
            echo wp_trim_words(get_the_content(), 20);
            }?>
            </p>
        <a href=" <?php the_permalink(); ?> ">Lisätietoa ></a>
    <?php     
    } wp_reset_postdata();
    ?>
</div>
<div>
    <h3><a href="<?php echo get_post_type_archive_link('event'); ?>">Näytä kaikki tapahtumat</a></h3>
</div>

<?php 
get_footer();
?>