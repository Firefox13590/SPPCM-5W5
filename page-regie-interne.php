blah

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
    test
    <?php
    $argRegie = array(
        'post_type' => 'regie_interne',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $queryRegie = new WP_Query($argRegie);


    if ($queryRegie && $queryRegie->have_posts()):
        while ($queryRegie->have_posts()):
            $queryRegie->the_post();

            $description = get_field('description');
            $lien = get_field('lien');
    ?>
            <article class="document-regie">

                <h3><?php the_title(); ?></h3>

                <?php if ($description) : ?>
                    <div class="description">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>

                <?php if ($lien) : ?>
                    <a href="<?php echo esc_url($lien); ?>"
                        target="_blank"
                        rel="noopener noreferrer">
                        Consulter le document
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
</main>




<?php
get_sidebar();
get_footer();
?>