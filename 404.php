<?php
/**
 * Page/section affichée quand une section ou une page n'est pas trouvée (erreur 404).
 * 
 * (Par exemple, le fil RSS n'est plus disponible)
 *
 * @package Underscores-child
 */

get_header();
?>

<main id="main" class="main">
  <section id="error-404">
    <h1>Page non trouvée</h1>
    <p>La page que vous recherchez n'existe pas ou a été déplacée.</p>
  </section>
</main>

<?php
get_sidebar();
get_footer();
?>