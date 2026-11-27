<?php
/*
Template Name: Vie syndicale
*/
get_header();
?>

<main class="vie-syndicale">

    <section class="vie-syndicale-banniere">
        <h1>VIE SYNDICALE</h1>
    </section>

    <div class="vie-syndicale-contenu">
        <?php
        // Récupérer les publications du type Vie syndicale.
        $queryVieSyndicale = new WP_Query(array(
            'post_type' => 'vie-syndicale',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        ));

        if ($queryVieSyndicale->have_posts()) :
            while ($queryVieSyndicale->have_posts()) :
                $queryVieSyndicale->the_post();

                $nomVieSyndicale = get_field('nom_vie_syndicale');
                $imageVieSyndicale = get_field('image_vie_syndicale');
                $descriptionVieSyndicale = get_field('description');
                $responsableVieSyndicale = get_field('nom_du_responsable');
                ?>

                <section class="vie-syndicale-item">
                    <h2>
                        <?php echo esc_html($nomVieSyndicale ?: get_the_title()); ?>
                    </h2>

                    <?php if ($imageVieSyndicale) : ?>
                        <img
                            src="<?php echo esc_url($imageVieSyndicale['url']); ?>"
                            alt="<?php echo esc_attr($imageVieSyndicale['alt']); ?>"
                        >
                    <?php endif; ?>

                    <?php if ($descriptionVieSyndicale) : ?>
                        <div class="vie-syndicale-description">
                            <?php echo wpautop(esc_html($descriptionVieSyndicale)); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($responsableVieSyndicale) : ?>
                        <p class="vie-syndicale-responsable">
                            <strong>Responsable :</strong>
                            <?php echo esc_html($responsableVieSyndicale); ?>
                        </p>
                    <?php endif; ?>
                </section>

                <?php
            endwhile;
        else :
            ?>
            <p>Aucune information disponible pour le moment.</p>
        <?php
        endif;

        wp_reset_postdata();
        ?>
    </div>

</main>

<?php get_footer(); ?>