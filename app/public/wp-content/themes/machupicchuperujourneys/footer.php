<?php if (ICL_LANGUAGE_CODE == 'en') :
    $contactusfooter = "Get in touch with us";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'es') :
    $contactusfooter = "Ponte en contacto con Nosotros";
endif; ?>
<footer id="footer" class="footer">
    <h2><?php echo $contactusfooter; ?></h2>
    <section class="footer__map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d969.7719352643529!2d-71.95985617076666!3d-13.530206695520937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTPCsDMxJzQ4LjgiUyA3McKwNTcnMzMuNSJX!5e0!3m2!1sen!2sus!4v1678687479346!5m2!1sen!2sus" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    <section class="footer__widgets">
        <?php dynamic_sidebar('footer'); ?>
    </section>
</footer>
<div class="footer__copyright">
    <section class="copyright__box">
        <div class="copy">
            <p>&copy;Copyrigth <?php echo date('Y'); ?>. <?php bloginfo('name'); ?>&reg;</p>
        </div>
        <div class="credits">
            <p><a href="#" class="">&spades; Developed by Hans Ccarita. <img src="<?php bloginfo('template_directory'); ?>/assets/images/project-zion-logo.svg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">Project Zion&trade; Theme.</a></p>
        </div>
    </section>
</div>
<?php wp_footer(); ?>
<?php include(TEMPLATEPATH . "/analytics.php"); ?>
</body><!-- Fin Contenedor body -->

</html>