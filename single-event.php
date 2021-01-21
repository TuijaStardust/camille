<?php
    get_header();

    while(have_posts()) {
        the_post();?>
        <h2><?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>

    <?php 
    }
    ?>
    <div>
        <h3><a href="<?php echo get_post_type_archive_link('event'); ?>">Kaikki tapahtumat</a></h3>
    </div>

<?php
    get_footer();
?>
