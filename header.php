<?php
/*
    HEADER DU SITE
*/
?>
<doctype html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header class= "entete-site"> 
            <div class= "barre-entete">

            <!-- LOGO -->
            <a class = "logo-entete" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Logo du SPPCM" />
            </a>    

            <!-- BOUTON DU MENU -->
             <button class= "bouton-menu" type="button" aria-label="Ouvrir le menu" aria-controls="navigation-principale" aria-expanded="false">
                <span aria-hidden="true"></span>
            </button>

            <!-- NAVIGATION PRINCIPALE -->
             <nav
                id="navigation-principale"
                clas="navigation-principale"
                aria-label="Navigation principale"
            >
            <ul class="liste-menu">
                <li>
                    <a href="<?php echo esc_url(home_url('/actualites')); ?>"> Actualités </a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/infolettre/')); ?>"> Infolettre </a>
</li>