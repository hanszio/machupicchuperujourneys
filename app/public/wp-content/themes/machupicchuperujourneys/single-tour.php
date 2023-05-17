<?php

/**
 * Template Name: Itinerarios
 * Template Post Type: Tour
 */
get_header(); ?>
<?php if (ICL_LANGUAGE_CODE == 'en') :
    $travelwhit = "Why travel with us?";
    $reserve = "Book Now";
    $formRes = "Inquire About";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'es') :
    $travelwhit = "¿Por qué viajar con nosotros?";
    $reserve = "Reservar Ahora";
    $formRes = "Consultar sobre";
endif; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="itinerarios__banner">
            <?php
            // Obtener el array de imágenes de ACF
            $galeria_itinerario = get_field('galeria_itinerario');

            // Verificar si hay imágenes en la galería
            if ($galeria_itinerario) {
            ?>
                <div class="itinerarios__galeria">
                    <div class="itinerario-titulo">
                        <h1><?php the_title(); ?></h1> <!-- Título de la página -->
                    </div>
                    <div id="slider__itinerario" class="slider__itinerario">
                        <?php
                        // Recorrer el array de imágenes
                        foreach ($galeria_itinerario as $imagen) {
                            $url = $imagen['url'];
                            $alt = $imagen['alt'];
                        ?>
                            <div class="slider__slide">
                                <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <main class="itinerarios__box">
            <article>
                <section id="post-<?php the_ID(); ?>" class="itinerary--content">
                    <?php the_content(); ?>
                </section>
            </article>
            <aside class="general_sidebar">
                <div class="itinerary__wetravel">
                    <?php if (get_field('codigo_wetravel')) : ?>
                        <?php $link = get_field('codigo_wetravel');
                        if ($link) : ?>
                            <a class="button wtrvl-checkout_button" href="https://www.wetravel.com/checkout_embed?uuid=<?php echo $link; ?>" target="_blank"><?php echo $reserve; ?></a>
                            <script src="https://cdn.wetravel.com/master/core-app/assets/embed_checkout.js"></script>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="itinerarios__form">
                    <p><strong><?php echo ($formRes); ?></strong></p>
                    <h4><?php the_title(); ?></h4>
                </div>
                <?php if (
                    !function_exists('dynamic_sidebar')
                    || !dynamic_sidebar('tours_widgets')
                ) : ?>
                <?php endif; ?>
            </aside>
        </main>
<?php endwhile;
endif; ?>
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