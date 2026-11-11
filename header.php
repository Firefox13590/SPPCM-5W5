<?php
/* HEADER DU SITE */
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
    <a class="lien-evitement" href="#contenu-site">Aller au contenu</a>
    <header class="entete-site <?php echo is_front_page() ? 'entete-accueil' : ''; ?>">
        <div class="barre-entete">
            <a class="logo-entete" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="SPPCM — Accueil">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/images/logo.png'); ?>" alt="SPPCM" width="342" height="90">
            </a>

            <button class="bouton-menu" type="button" aria-label="Ouvrir le menu" aria-controls="navigation-principale" aria-expanded="false">
                <span class="icone-menu" aria-hidden="true"></span>
            </button>

            <nav id="navigation-principale" class="navigation-principale" aria-label="Navigation principale">
                <ul class="liste-menu">
                    <li><a href="<?php echo esc_url(home_url('/category/actualite/')); ?>">Actualités</a></li>
                    <li>
                        <details class="groupe-menu">
                            <summary>Conditions de travail</summary>
                            <ul class="sous-menu">
                                <li><a href="<?php echo esc_url(home_url('/publications/convention-collective/')); ?>">Convention collective et outils</a></li>
                                <li><a href="<?php echo esc_url(home_url('/publications/')); ?>">Avantages sociaux</a></li>
                                <li><a href="<?php echo esc_url(home_url('/publications/assurances/')); ?>">Assurances collectives</a></li>
                            </ul>
                        </details>
                    </li>
                    <li><a href="<?php echo esc_url(home_url('/publications/vie-syndicale/')); ?>">Vie syndicale</a></li>
                    <li><a href="<?php echo esc_url(home_url('/infolettre-accueil/')); ?>">Infolettres</a></li>
                    <li>
                        <details class="groupe-menu">
                            <summary>À propos du SPPCM</summary>
                            <ul class="sous-menu">
                                <li><a href="<?php echo esc_url(home_url('/instances-syndicales-et-representants-es-des-enseignants-es/a-propos/')); ?>">Comité exécutif</a></li>
                                <li><a href="<?php echo esc_url(home_url('/publications/regie-interne/')); ?>">Régie interne</a></li>
                                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </nav>


            <details class="recherche-bureau">
                <summary aria-label="Ouvrir la recherche">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 5 5"/></svg>
                </summary>
                <form class="recherche-entete" role="search" aria-label="Recherche sur le site" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <label class="texte-cache" for="recherche-bureau">Rechercher sur le site</label>
                    <input id="recherche-bureau" type="search" name="s" placeholder="Rechercher…" value="<?php echo esc_attr(get_search_query()); ?>">
                    <button type="submit" aria-label="Lancer la recherche">→</button>
                </form>
            </details>
        </div>

        <?php if (is_front_page()) : ?>
            <div class="presentation-entete">
                <p class="sigle-entete">SPPCM</p>
                <p>Le Syndicat des<br class="saut-tablette"> professeures et professeurs du Collège Maisonneuve</p>
            </div>
        <?php endif; ?>
    </header>
    <div id="contenu-site" tabindex="-1"></div>
