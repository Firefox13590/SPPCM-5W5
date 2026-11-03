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


/**
 * Permet de téléverser une image par programmation.
 * 
 * @link https://rudrastyh.com/wordpress/how-to-add-images-to-media-library-from-uploaded-files-programmatically.html#upload-image-from-url
 */
function UploadMediaParProg(): void {
    // it allows us to use download_url() and wp_handle_sideload() functions
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
    // update medatata, regenerate image sizes
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

    echo(dirname(__DIR__));
}

/**TEST
 * SIMON 
 */
function underscores_child_menus() {
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Header', 'underscores' ),
            'menu-2' => esc_html__( 'Footer', 'underscores' ),
        )
    );
}
add_action( 'after_setup_theme', 'underscores_child_menus', 20 );



/**
 * Ajoute au Customizer une section de réglages propres au SPPCM.
 *
 * @param WP_Customize_Manager $wp_customize Objet du Customizer, fourni par le hook.
 * @return void
 */
function underscores_child_parametres_ajustables( $wp_customize ) {
	
    // Section : regroupe les contrôles dans un panneau du Customizer (priorité 30 : sous l'identité du site).
    $wp_customize->add_section( 
		'sppcm_parametres_ajustables', 
		array(
			'title' => __( 'Contrôles personnalisés pour SPPCM' ),
			'priority' => 30
		)
	);

	/**
     * Texte de présentation de l'organisation (footer).
     */

    // Réglage : définit la donnée stockée (en base de données, dans les options du thème).
	$wp_customize->add_setting( 
		'sppcm_presentation_syndicat_footer'
	);

    // Contrôle : le champ affiché dans l'interface, lié au réglage par le même identifiant.
	$wp_customize->add_control( 
        'sppcm_presentation_syndicat_footer', 
        array(
            'type' => 'textarea',
            'label' => __( 'Présentation de l\'organisation dans le footer' ),
            'section' => 'sppcm_parametres_ajustables'
        ) 
    );

}
add_action( 'customize_register', 'underscores_child_parametres_ajustables' );