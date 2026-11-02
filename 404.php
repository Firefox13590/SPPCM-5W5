<?php
/*
    VARIABLES
*/
$erreurFlux = is_front_page() && ($_GET['erreur-flux'] ?? '') === '1';
$erreurInfolettres = is_front_page() && ($_GET['erreur-infolettres'] ?? '') === '1';
$erreurService = $erreurFlux || $erreurInfolettres;

$titre = 'Page non trouvée';
$message = "La page que vous recherchez n'existe pas ou a été déplacée.";
$lienAccueil = home_url('/');

/*
    EXECUTION
*/
// Choisir le message selon le type d’erreur.
if ($erreurService) {
    $lienAccueil = add_query_arg('retour-accueil', '1', $lienAccueil);

    if ($erreurFlux) {
        $titre = 'Actualités temporairement indisponibles';
        $message = 'Impossible de charger les actualités pour le moment. Veuillez réessayer plus tard.';
    } else {
        $titre = 'Infolettres temporairement indisponibles';
        $message = 'Aucune infolettre n’est disponible pour le moment. Veuillez réessayer plus tard.';
    }
}

get_header();
?>

<!-- CONTENU DE LA PAGE D’ERREUR -->
<main id="main" class="main page-erreur">
    <section id="error-404" class="<?php echo $erreurService ? 'erreur-service' : 'erreur-page'; ?>" aria-labelledby="titre-erreur">
        <span class="code-erreur" aria-hidden="true">
            <?php echo $erreurService ? '503' : '404'; ?>
        </span>

        <div class="contenu-erreur">
            <h1 id="titre-erreur"><?php echo esc_html($titre); ?></h1>
            <p><?php echo esc_html($message); ?></p>

            <!-- BOUTONS -->
            <div class="actions-erreur">
                <a class="btn-retour" href="<?php echo esc_url($lienAccueil); ?>">
                    <span>Retour à l’accueil</span>
                    <span aria-hidden="true">→</span>
                </a>

                <?php if ($erreurService) : ?>
                    <a class="btn-reessayer" href="<?php echo esc_url(home_url('/')); ?>">
                        Réessayer
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
