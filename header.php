<?php
/*
 * HEADER DU SITE
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <header class="entete-site">

            <div class="barre-entete">

                <!-- LOGO -->
                <a
                    class="logo-entete"
                    href="<?php echo esc_url(home_url('/')); ?>"
                    rel="home"
                >
                    <img
                        src="<?php echo esc_url(get_stylesheet_directory_uri() . '/images/logo.png'); ?>"
                        alt="Logo du SPPCM"
                    >
                </a>

                <!-- BOUTON DU MENU -->
                <button
                    class="bouton-menu"
                    type="button"
                    aria-label="Ouvrir le menu"
                    aria-controls="navigation-principale"
                    aria-expanded="false"
                >
                    <span aria-hidden="true"></span>
                </button>

                <!-- NAVIGATION PRINCIPALE -->
                <nav
                    id="navigation-principale"
                    class="navigation-principale"
                    aria-label="Navigation principale"
                >

                    <ul class="liste-menu">

                        <!-- ACTUALITÉS -->
                        <li>
                            <a href="<?php echo esc_url(home_url('category/actualite/')); ?>">
                                Actualités
                            </a>
                        </li>

                        <!-- INFOLETTRE -->
                        <li>
                            <a href="<?php echo esc_url(home_url('/infolettre-accueil/')); ?>">
                                Infolettre
                            </a>
                        </li>

                        <!-- VOS DROITS -->
                        <li>
                            <details class="groupe-menu">

                                <summary>Vos droits</summary>

                                <ul class="sous-menu">

                                    <li>
                                        <a href="<?php echo esc_url(home_url('/relations-de-travail/')); ?>">
                                            Relations de travail
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo esc_url(home_url('/publications/')); ?>">
                                            Avantages sociaux
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo esc_url(home_url('/convention-collective/')); ?>">
                                            Convention collective
                                        </a>
                                    </li>

                                </ul>

                            </details>
                        </li>
                                    <li>
                                        <a href="<?php echo esc_url(home_url('/vie-syndicale/')); ?>">
                                            Vie syndicale
                                        </a>
                                    </li>

                        <li>
                            <details class="groupe-menu">
                            <summary>À Propos</summary>
                            <ul class="sous-menu">
                                <li>
                                    <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                                        Contact
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/instances-syndicales-et-representants-es-des-enseignants-es/a-propos/')); ?>">
                                        Comité exécutif
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/regie-interne/')); ?>">
                                        Régie interne
                                    </a>
                                </li>
                        </ul>

                    </nav>

                    <!-- RECHERCHE -->
                    <form
                        class="recherche-entete"
                        role="search"
                        method="get"
                        action="<?php echo esc_url(home_url('/')); ?>">
                        <label class="texte-cache" for="recherche-site">Rechercher sur le site</label>
                        <input
                            id="recherche-site"
                            type="search"
                            name="s"
                            placeholder="Rechercher..."
                        >

                        <button type="submit" aria-label="Rechercher">
                            <svg viewBox="0 0 24 24" aria-hidden= "true">
                                <circle cx="10" cy="10" r="7" />
                                <path d="M15 15 L22 22" />
                            </svg>
                        </button>
                    </form>
            </div>

        </header>