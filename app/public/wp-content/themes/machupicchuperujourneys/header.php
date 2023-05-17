<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <title><?php wp_title('', true, 'right'); ?></title>
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <script type="text/javascript">
        var templateUrl = '<?= get_bloginfo("template_url"); ?>';
    </script>
    <?php wp_head(); ?>
</head>
<!-- Inicio contenedor -->

<body class="loading">
    <header class="header__<?php if (is_front_page() == true) {
                                echo "frontpage";
                            } else {
                                echo "innerpages";
                            } ?>">
        <div class="header__nav">
            <section class="header__content">
                <!-- Inicio Logo -->
                <div class="header__logo">
                    <?php if (has_custom_logo()) {
                        the_custom_logo();
                    } else { ?>
                        <h1><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php } ?>
                </div>
                <!-- Fin Logo -->
                <!-- Inicio Menu -->
                <div class="header__menu">
                    <!-- Inicio Menu Mobil -->
                    <input id="menu__burger" type="checkbox" />
                    <label for="menu__burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                    <!-- Fin Menu Mobil -->
                    <nav id="menu" class="menu__nav">
                        <?php if (function_exists('wp_nav_menu')) {
                            wp_nav_menu(array('container' => false, 'theme_location' => 'menu-principal', 'depth' => '4', 'show_home' => 'true'));
                        } else { ?>
                            <ul>
                                <li class="<?php if (is_home()) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home">Home</a></li>
                                <?php wp_list_pages('title_li=&sort_column=menu_order&depth=4');   ?>
                            </ul>
                        <?php } ?>
                    </nav>
                </div>
                <!-- Fin Menu -->
                <!-- Inicio Widgets -->
                <?php if (!wp_is_mobile() == true) { ?>
                    <div class="header__widgets">
                        <?php if (ICL_LANGUAGE_CODE == 'en') :
                            $languageswi = "Language";
                        endif; ?>
                        <?php if (ICL_LANGUAGE_CODE == 'es') :
                            $languageswi = "Idioma";
                        endif; ?>
                        <p><?php echo $languageswi; ?>:</p><?php dynamic_sidebar('header'); ?>
                    </div>
                <?php } ?>
                <!-- Fin Widgets -->
            </section>
        </div>
        <?php if (is_front_page() == true) { ?>
            <div class="header__banner">
                <?php if (pll_current_language() == 'es') { ?>
                    <?php echo do_shortcode('[transitionslider id="1"]'); ?>
                <?php } elseif (pll_current_language() == 'en') { ?>
                    <?php echo do_shortcode('[transitionslider id="2"]'); ?>
                <?php } ?>
            </div>
        <?php } ?>

    </header>