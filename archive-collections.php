<?php get_header(); ?>
<?php
    $args = [
        'post_type' => 'collections',
        'posts_per_page' => -1,
    ];
    
    $query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>

    <div class="page-heading">
        <?php if (!empty(get_the_title())) : ?>
            <div class="page-heading__title">
                <h1 class="lg"><?php _e('COLLECTIONS');?></h1>
            </div>
        <?php endif; ?>
    </div>

    <section class="collections">
        <div class="container container--full">
            <ul class="collections__list">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                    $title = get_the_title();
                    $link = get_the_permalink();
                    $img_url = get_the_post_thumbnail_url();
                    $img_caption = get_the_post_thumbnail_caption() ?: get_the_title();
                    ?>
                    
                    <?php if ($img_url && $title) : ?>
                        <li class="list--item">
                            <a href="<?php echo esc_url($link); ?>" class="list--item__link">
                                <div class="list--item__bg">
                                    <img src="<?php echo esc_url($img_url); ?>"
                                         alt="<?php echo esc_attr($img_caption); ?>">
                                </div>
                                <div class="list--item__title">
                                    <?php echo $title; ?>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php wp_reset_postdata(); ?>
                <?php endwhile; ?>
            </ul>
        </div>
    </section>

<?php endif; ?>
<?php get_footer(); ?>