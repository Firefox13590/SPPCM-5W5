<?php

/**
 * Page de Régie interne
 *
 * @package Underscores
 */
get_header();
?>

<main id="regie-interne">
    <h2 id="titre-regie">Régie interne</h2>
    <?php
    $argRegie = array(
        'post_type' => 'regie_interne',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $queryRegie = new WP_Query($argRegie);
    
?>
    <div class="documents-regie">
    <?php
    if ($queryRegie && $queryRegie->have_posts()):
        while ($queryRegie->have_posts()):
            $queryRegie->the_post();

            $description = get_field('description');
            $icone = get_field('icone');
            $lien = get_field('lien');
    ?>
            <article class="document-regie">
                <!-- icone document -->
                 <div id="document-regie-header">
                <?php if ($icone) : ?>
                    <div class="icone-document">
                        <img src="<?php echo esc_url($icone['url']); ?>" alt="<?php echo esc_attr($icone['alt']); ?>">
                    </div>
                <?php endif; ?>
                <h3 class="titre-document"><?php the_title(); ?></h3>
                    </div>
                <?php if ($description) : ?>
                    <div class="description">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>

                <?php if ($lien) : ?>
                    <a class="lien-document-container" href="<?php echo esc_url($lien); ?>"
                        target="_blank"
                        rel="noopener noreferrer">
                        Voir le document
                    </a>
                <?php endif; ?>

            </article>

    <?php
        endwhile;
    else :
        echo '<p>Aucun document disponible.</p>';
    endif;

    wp_reset_postdata();
    ?>
    </div>
</main>




<?php
get_sidebar();
get_footer();
?>