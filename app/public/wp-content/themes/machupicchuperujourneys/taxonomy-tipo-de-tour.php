<?php get_header(); ?>
<?php if (ICL_LANGUAGE_CODE == 'en') :
    $duracion = "Duration: ";
    $booknow = "Book<br>Now: ";
    $features = "Our best fearured";
    $veritinerario = "Itinerary";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'es') :
    $duracion = "Duración: ";
    $booknow = "Ver<br>Más: ";
    $features = "Nuestras mejores caracteristicas";
    $veritinerario = "Ver Itinerario";
endif; ?>
<main class="list__post">
    <?php
    $args = array(
        'post_type' => 'tour', // Nombre de tu Custom Post Type
        'orderby' => 'date', // Ordenar por fecha
        'order' => 'ASC', // Orden descendente (inverso)
        'posts_per_page' => -1, // Mostrar todas las entradas
        'tax_query' => array(
            array(
                'taxonomy' => 'tipo-de-tour', // Nombre de tu taxonomía
                'field' => 'slug',
                'terms' => get_queried_object()->slug
            )
        )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
        <section class="title__category">
            <h1><?php echo single_cat_title(); ?></h1>
            <?php the_archive_description(); ?>
        </section>
        <section class="frontpage__besttours tours__category">
            <?php while ($query->have_posts()) : $query->the_post();
                $titulo = get_the_title();
                $imagen_destacada = get_the_post_thumbnail();
                $link = get_permalink();
                $excerpt = get_the_excerpt();
            ?>
                <div class="besttours__card">
                    <div class="card-image">
                        <?php echo $imagen_destacada; ?>
                    </div>
                    <div class="card-text">
                        <div class="card-textbox">
                            <h2><?php echo $titulo; ?></h2>
                        </div>
                    </div>
                    <div class="card-after">
                        <h2><?php echo $titulo; ?></h2>
                        <p class="card-duration"><span><?php echo $duracion; ?></span><?php the_secondary_title(); ?></p>
                        <p class="card-excerpt"><?php echo $excerpt; ?></p>
                        <a class="button-book" href="<?php echo $link; ?>"><?php echo $veritinerario; ?></a>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </section>
        <section class="navigation__category">
            <?php if (function_exists('wp_pagenavi')) {
                wp_pagenavi();
            } else { ?>
                <div class="previous-posts-link"><?php previous_posts_link('&larr; Volver atras') ?></div>
                <div class="next-posts-link"><?php next_posts_link('Ver Siguientes &rarr;') ?></div>
            <?php } ?>
        </section>
    <?php else : ?>
        <section>
            <h2>No se ha encontrado</h2>
            <p>Lo sentimos, pero usted está buscando algo que no está aquí.</p>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>