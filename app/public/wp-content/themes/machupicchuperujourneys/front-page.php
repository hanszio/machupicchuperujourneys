<?php get_header(); ?>
<?php if (ICL_LANGUAGE_CODE == 'en') :
    $travelwhit = "Why travel with us?";
    $moreabout = "More About Us";
    $customizetrip = "Customize Trip";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'es') :
    $travelwhit = "¿Por qué viajar con nosotros?";
    $moreabout = "Más Sobre Nosotros";
    $customizetrip = "Personalizar Viaje";
endif; ?>
<main id="bottom" class="frontpage">
    <section class="frontpage__welcome">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
        <?php endwhile;
        endif; ?>
    </section>
    <section class="frontpage__packages">
        <?php include(TEMPLATEPATH . "/packages-home.php") ?>
    </section>
    <section class="frontpage__personalized">
        <?php if (have_rows('personalized_adventures')) : ?>
            <?php while (have_rows('personalized_adventures')) : the_row();
                // Get sub field values.
                $perimage = get_sub_field('personalized_adventures_image');
                $pergroup = get_sub_field('personalized_adventures_group');
                $pertitle = $pergroup['personalized_adventures_title'];
                $pertext = $pergroup['personalized_adventures_text'];
                $perlink = $pergroup['personalized_adventures_link'];
            ?>
                <div class="personalized__box">
                    <img src="<?php echo esc_url($perimage['url']); ?>" alt="<?php echo esc_attr($perimage['alt']); ?>" />
                    <div class="personalized__box-content">
                        <h2><?php echo $pertitle; ?></h2>
                        <p><?php echo $pertext; ?></p>
                        <a class="button-mpj" href="<?php echo $perlink; ?>"><?php echo $customizetrip; ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
    <section class="frontpage__about">
        <?php $about = get_field('about_us');
        if ($about) : ?>
            <div class="about__box">
                <div class="about__box-content">
                    <img src="<?php echo esc_url($about['about_us_image']['url']); ?>" alt="<?php echo esc_attr($about['about_us_image']['alt']); ?>" />
                    <p><?php echo $about['about_us_text']; ?></p>
                    <a class="button-mpj" href="<?php echo esc_url($about['about_us_link']); ?>"><?php echo $moreabout; ?></a>
                </div>
                <div class="about__box-facebook">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMachupicchuperujourneys&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <section class="frontpage__why-us">
        <div class="why-us__box">
            <h2><?php echo $travelwhit; ?></h2>
            <?php if (have_rows('why_us')) : ?>
                <div class="why-us">
                    <?php while (have_rows('why_us')) : the_row(); ?>
                        <?php $reason = get_sub_field('reason'); ?>
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
    <section class="frontpage__testimonials">
        <div class="testimonials__box">
            <?php echo do_shortcode('[trustindex no-registration=tripadvisor]'); ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>