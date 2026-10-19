<?php

/**
 * Charge les styles du thème parent et du thème enfant.
 */
function underscores_child_assets() {

    // Style du thème parent
    wp_enqueue_style(
        'underscores-style',
        get_template_directory_uri() . '/style.css'
    );

    // style.css du thème enfant
    wp_enqueue_style(
        'underscores-child-style',
        get_stylesheet_uri(),
        array( 'underscores-style' )
    );

    // CSS compilé depuis Sass
    wp_enqueue_style(
        'underscores-child-main',
        get_stylesheet_directory_uri() . '/css/main.css',
        array( 'underscores-child-style' )
        // Version dynamique recommandée en production :
        // , filemtime( get_stylesheet_directory() . '/css/main.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'underscores_child_assets' );


/**
 * Enregistre et charge le script JS principal du thème enfant en tant que module ES natif.
 *
 * Utilise wp_enqueue_script_module() (disponible depuis WordPress 6.5), qui permet
 * d'utiliser directement la syntaxe import/export dans main.js sans bundler (webpack, etc.).
 */
function underscores_child_scripts() {

    wp_enqueue_script_module(
        'underscores-child-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        array(),                // Dépendances de modules (autres modules requis avant celui-ci, si besoin).
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'underscores_child_scripts' );


/**
 * [ALTERNATIVE — désactivée] Enregistre et charge main.js via l'API classique wp_enqueue_script().
 *
 * À utiliser pour les équipes qui écrivent leur JS en procédural plutôt qu'en orienté objet
 * (voir l'alternative correspondante dans main.js).
 *
 * Si le projet grandit et que d'autres fichiers JS s'ajoutent, ceux-ci peuvent être enregistrés
 * séparément et déclarés comme dépendances dans le tableau ci-dessous pour garantir leur ordre
 * de chargement avant main.js.
 */
/*
function underscores_child_scripts() {

    wp_enqueue_script(
        'main',
        get_stylesheet_directory_uri() . '/js/main.js',
        array(),
        '1.0.0',
        array( 'strategy' => 'defer' )
    );
}
add_action( 'wp_enqueue_scripts', 'underscores_child_scripts' );
*/


/**
 * Ajouter un menu de gestion des partenaires du footer dans WordPress pour pas se casser
 * la tête si on veut ajouter ou enlever un partenaire
 * @return void
 */
function EnregistrerPartenairesFooter() {
    register_post_type( 'sppcm_partenaire', array(
        'labels' => array(
            'name' => 'Partenaires',
            'singular_name' => 'Partenaire',
            'add_new' => 'Ajouter un partenaire',
            'add_new_item' => 'Ajouter un partenaire',
            'edit_item' => 'Modifier le partenaire',
            'all_items' => 'Tous les partenaires',
            'search_items' => 'Rechercher des partenaires',
            'not_found' => 'Aucun partenaire trouvé.',
        ),

        // Les partenaires sont affichés dans le footer.
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => array( 'title', 'page-attributes' ),
        'capability_type' => 'page',
        'map_meta_cap' => true,
        'rewrite' => false,
        'query_var' => false,
    ) );
}
add_action( 'init', 'EnregistrerPartenairesFooter' );
