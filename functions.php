<?php

/**
 * Charge les styles du thème parent et du thème enfant.
 */
function underscores_child_assets()
{

    // Style du thème parent
    wp_enqueue_style(
        'underscores-style',
        get_template_directory_uri() . '/style.css'
    );

    // style.css du thème enfant
    wp_enqueue_style(
        'underscores-child-style',
        get_stylesheet_uri(),
        array('underscores-style')
    );

    // CSS compilé depuis Sass
    wp_enqueue_style(
        'underscores-child-main',
        get_stylesheet_directory_uri() . '/css/main.css',
        array('underscores-child-style')
        // Version dynamique recommandée en production :
        // , filemtime( get_stylesheet_directory() . '/css/main.css' )
    );
}
add_action('wp_enqueue_scripts', 'underscores_child_assets');


/**
 * Enregistre et charge le script JS principal du thème enfant en tant que module ES natif.
 *
 * Utilise wp_enqueue_script_module() (disponible depuis WordPress 6.5), qui permet
 * d'utiliser directement la syntaxe import/export dans main.js sans bundler (webpack, etc.).
 */
function underscores_child_scripts()
{

    wp_enqueue_script_module(
        'underscores-child-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        array(),                // Dépendances de modules (autres modules requis avant celui-ci, si besoin).
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'underscores_child_scripts');


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



/* 
Retire l'éditeur par défaut pour des types d'articles spécifiques
*/
function remove_editor()
{
    // ajouter la clé du post type dans ce array pour inclure d'autres post types
    $targetPostTypes = array(
        'infolettre',
    );
    foreach ($targetPostTypes as $targetPostType) {
        remove_post_type_support($targetPostType, 'editor');
    }
}
add_action('admin_init', 'remove_editor');

/**
 * Vérifie si un import Feedzy des actualités a échoué à sa dernière exécution.
 */
function VerifierErreurActualites()
{
    $importsActualites = get_posts(array(
        'post_type' => 'feedzy_imports',
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_key' => 'import_post_type',
        'meta_value' => 'post',
    ));

    foreach ($importsActualites as $importActualites) {
        $erreursImport = get_post_meta($importActualites->ID, 'import_errors', true);
        $resultatImport = get_post_meta($importActualites->ID, 'import_info', true);

        // Feedzy enregistre import_info quand l'import se termine normalement,
        // même sans nouvel article. Une erreur d'image ne bloque donc pas la page.
        if (!empty($erreursImport) && empty($resultatImport)) {
            return true;
        }
    }

    return false;
}

/**
 * Dirige vers la page d'erreur si l'import des actualités échoue.
 */
function RedirigerErreurActualites()
{
    if (!is_front_page() || is_feed() || is_preview()) {
        return;
    }

    // Le lien de retour permet de consulter l'accueil même pendant une panne.
    if (isset($_GET['retour-accueil']) && $_GET['retour-accueil'] === '1') {
        return;
    }

    if (!isset($_GET['erreur-flux']) && !isset($_GET['erreur-infolettres']) && VerifierErreurActualites()) {
        wp_safe_redirect(add_query_arg('erreur-flux', '1', home_url('/')), 302);
        exit;
    }
}
add_action('template_redirect', 'RedirigerErreurActualites');

/**
 * Vérifie que la page des infolettres et ses pages annuelles sont disponibles.
 */
function VerifierErreurInfolettres()
{
    $pageInfolettres = get_page_by_path('infolettre-accueil');

    if (!$pageInfolettres || $pageInfolettres->post_status !== 'publish') {
        return true;
    }

    $pagesInfolettres = get_posts(array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_parent' => $pageInfolettres->ID,
        'posts_per_page' => 1,
        'fields' => 'ids',
    ));

    return empty($pagesInfolettres);
}

/**
 * Dirige vers la page d'erreur quand la liste des infolettres est indisponible.
 */
function RedirigerErreurInfolettres()
{
    if ((!is_front_page() && !is_page('infolettre-accueil')) || is_feed() || is_preview()) {
        return;
    }

    if (isset($_GET['retour-accueil']) && $_GET['retour-accueil'] === '1') {
        return;
    }

    if (!isset($_GET['erreur-flux']) && !isset($_GET['erreur-infolettres']) && VerifierErreurInfolettres()) {
        wp_safe_redirect(add_query_arg('erreur-infolettres', '1', home_url('/')), 302);
        exit;
    }
}
add_action('template_redirect', 'RedirigerErreurInfolettres');

/**
 * Réutilise le gabarit d'erreur pour les actualités ou les infolettres indisponibles.
 */
function ChoisirPageErreurActualites($gabarit)
{
    $erreurFlux = isset($_GET['erreur-flux']) && $_GET['erreur-flux'] === '1';
    $erreurInfolettres = isset($_GET['erreur-infolettres']) && $_GET['erreur-infolettres'] === '1';

    if (is_front_page() && ($erreurFlux || $erreurInfolettres)) {
        status_header(503);
        nocache_headers();
        return get_stylesheet_directory() . '/404.php';
    }

    return $gabarit;
}
add_filter('template_include', 'ChoisirPageErreurActualites');
