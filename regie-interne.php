<?php

/**
 * Page de Régie interne
 *
 * @package Underscores
 */
get_header(); 
?>

<main id="regie-interne">
	<h2>Régie interne</h2>
    <h3>Documents</h3>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else :
        echo '<p>Aucun document trouvé.</p>'; //remplacer par page 404 quand fini
    endif;
?>

</main>




<?php
get_sidebar();
get_footer();
?>

