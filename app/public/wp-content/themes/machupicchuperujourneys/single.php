<?php get_header(); ?>
<?php include(TEMPLATEPATH . "/sidebar-left.php"); ?>
<article class="pages__box">
    <section class="page--content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
        <?php endwhile;
        endif; ?>
    </section>
    <?php include(TEMPLATEPATH . "/sidebar-right.php"); ?>
</article>
<?php get_footer(); ?>