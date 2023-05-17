<?php if (ICL_LANGUAGE_CODE=='es' ) : $error404 ="Error 404"; $haga ="Haga "; $click ="click aquí"; $paginaP =" para volver a la página principal"; $noEncontrada ="Página no encontrada."; endif; ?>
<?php get_header(); ?>
<?php include(TEMPLATEPATH."/sidebar-left.php");?>
<main class='full-with paginaError'>
    <div class="contenedor">
        <div class="ErrorIzq">
            <h1><?php echo $error404; ?></h1>
            <p><?php echo $noEncontrada; ?></p>
            <h2><?php echo $haga; ?><a href="<?php echo home_url(); ?>"><?php echo $click; ?></a><?php echo $paginaP; ?></h2>
        </div>
        <div class="ErrorDer">
            <img src="<?php bloginfo('template_directory'); ?>/assets/images/404.svg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
        </div>
    </div> 
</main>
<?php include(TEMPLATEPATH."/sidebar-right.php");?>
<?php get_footer(); ?>