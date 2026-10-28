<?php
/**
 * Page affichée pour une adresse introuvable ou un flux indisponible.
 *
 * @package Underscores-child
 */
$erreurFlux = is_front_page() && isset($_GET['erreur-flux']) && $_GET['erreur-flux'] === '1';
$erreurInfolettres = is_front_page() && isset($_GET['erreur-infolettres']) && $_GET['erreur-infolettres'] === '1';
$lienAccueil = ($erreurFlux || $erreurInfolettres) ? add_query_arg('retour-accueil', '1', home_url('/')) : home_url('/');
get_header();
?>

<!-- Générer un message d'erreur si le flux marche pas pour les actualités -->
<main id="main" class="main">
  <section id="error-404">
    <?php if ($erreurFlux) : ?>
      <h1>Actualités temporairement indisponibles</h1>
      <p>Impossible de charger les actualités pour le moment. Veuillez réessayer plus tard.</p>
      <a href="<?php echo esc_url(home_url('/')); ?>">Réessayer</a>
    <?php elseif ($erreurInfolettres) : ?>
      <h1>Infolettres temporairement indisponibles</h1>
      <p>Aucune infolettre n’est disponible pour le moment. Veuillez réessayer plus tard.</p>
      <a href="<?php echo esc_url(home_url('/')); ?>">Réessayer</a>
    <?php else : ?>
  <!-- Message typique page 404 -->
      <h1>Page non trouvée</h1>
      <p>La page que vous recherchez n'existe pas ou a été déplacée.</p>
    <?php endif; ?>
    <a class="btn-retour" href="<?php echo esc_url($lienAccueil); ?>"><span>Retour à l'accueil </span>
    <span class="btn-retour__fleche" aria-hidden="true">→</span></a>
  </section>
</main>

<?php
get_footer();
?>
