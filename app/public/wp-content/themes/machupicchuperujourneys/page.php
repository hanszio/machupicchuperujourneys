<?php get_header(); ?>
<?php if (ICL_LANGUAGE_CODE == 'en') :
    $travelwhit = "Why travel with us?";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'es') :
    $travelwhit = "¿Por qué viajar con nosotros?";
endif; ?>
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
<section class="frontpage__why-us">
    <div class="why-us__box">
        <h2><?php echo $travelwhit ?></h2>
        <?php if (have_rows('why_us', get_option('page_on_front'))) : ?>
            <div class="why-us">
                <?php while (have_rows('why_us', get_option('page_on_front'))) : the_row(); ?>
                    <?php $reason = get_sub_field('reason', get_option('page_on_front')); ?>
                    <div class="why-us__item">
                        <img src="<?php echo esc_url($reason['reason_image']['url']); ?>" alt="<?php echo esc_attr($reason['reason_image']['alt']); ?>" />
                        <h3><?php echo $reason['reason_title']; ?></h3>
                        <p><?php echo $reason['reason_text']; ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>