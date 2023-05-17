<?php
get_header(); ?>
<main class="pages__box list__blog">
    <div class="pages__box">
        <header class="archive-header">
            <h1 class="archive-title">
                <?php
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    the_post();
                    echo 'Archivos del autor: ' . get_the_author();
                    rewind_posts();
                } elseif (is_day()) {
                    echo 'Archivos del día: ' . get_the_date();
                } elseif (is_month()) {
                    echo 'Archivos del mes: ' . get_the_date('F Y');
                } elseif (is_year()) {
                    echo 'Archivos del año: ' . get_the_date('Y');
                } else {
                    echo 'Blog';
                }
                ?>
            </h1>
        </header>

        <div class="archive__post">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article <?php post_class(); ?>>
                        <div class="post-content">
                            <div class="post-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="post-details">
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="entry-meta">
                                    <span class="posted-on"><?php the_time('F j, Y'); ?></span>
                                </div>
                                <div class="entry-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile;
            else : ?>
                <p>No se encontraron entradas.</p>
            <?php endif; ?>
        </div>

        <div class="navigation">
            <?php if (function_exists('wp_pagenavi')) {
                wp_pagenavi();
            } else { ?>
                <div class="previous-posts-link"><?php previous_posts_link('&larr; Volver atras') ?></div>
                <div class="next-posts-link"><?php next_posts_link('Ver Siguientes &rarr;') ?></div>
            <?php } ?>
        </div>
    </div>
    <?php include(TEMPLATEPATH . "/sidebar-right.php"); ?>
</main>

<?php get_footer(); ?>