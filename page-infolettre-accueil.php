<?php

$formatteurLisible = datefmt_create(
    'fr_CA',
    IntlDateFormatter::NONE,
    IntlDateFormatter::NONE,
    'America/Toronto',
    IntlDateFormatter::GREGORIAN,
    'd MMMM yyyy'
);
$formatteurLogique = datefmt_create(
    'fr_CA',
    IntlDateFormatter::NONE,
    IntlDateFormatter::NONE,
    'America/Toronto',
    IntlDateFormatter::GREGORIAN,
    'yyyyMMdd'
);

?>


<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Underscores-child
 */

get_header();
?>

<main id="infolettres">
    <h2 id="titre-infolettre">Infolettres</h2>
    <?php
    $annee_scolaire = isset($_GET['annee_scolaire']) ? sanitize_text_field($_GET['annee_scolaire']) : '';
    $recherche = isset($_GET['recherche']) ? sanitize_text_field($_GET['recherche']) : '';
    $args = array(
        'post_type' => 'infolettre',
        'posts_per_page' => -1,
        'meta_key' => 'info_date',
        'orderby' => 'meta_value',
        'order' => 'DESC'
    );

    if (!empty($annee_scolaire)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'annee-scolaire',
                'field' => 'slug',
                'terms' => $annee_scolaire,
            ),
        );
    }

    if (!empty($recherche)) {
        $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key' => 'info_date',
                'value' => $recherche,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'info_resume',
                'value' => $recherche,
                'compare' => 'LIKE'
            )
        );
    }

    $queryInfolettre = new WP_Query($args);
    ?>
    <section id="infolettre-filtre">
        <form id="infolettre-filtre-form" method="get">
            <input
                type="search"
                name="recherche"
                id="recherche-infolettre"
                placeholder="Rechercher..."

                value="<?= esc_attr($recherche); ?>">
            <select name="annee_scolaire" id="annee-scolaire" onchange="this.form.submit()">
                <?php
                $annees = get_terms(array(
                    'taxonomy' => 'annee-scolaire',
                    'hide_empty' => false,
                ));
                $derniere_annee = end($annees)->slug;
                foreach ($annees as $annee) {
                    $selected = ($annee->slug === ($annee_scolaire ?: $derniere_annee)) ? 'selected' : '';
                    echo '<option value="' . esc_attr($annee->slug) . '" ' . $selected . '>' . esc_html($annee->name) . '</option>';
                }
                ?>
            </select>
        </form>
    </section>
    <section id="infolettre-grid">
        <?php
        if ($queryInfolettre && $queryInfolettre->have_posts()):
            while ($queryInfolettre->have_posts()):
                $queryInfolettre->the_post();


                $infoDate = get_field('info_date');
                $infoDateTimestamp = datefmt_parse($formatteurLogique, $infoDate);
                $infoDateFormattee = datefmt_format($formatteurLisible, $infoDateTimestamp);
        ?>

                <a role="button" class="info-item <?php if ($queryInfolettre->current_post === 0) echo ('latest'); ?>"
                    href="<?= get_field('info_lien'); ?>" target="_blank">
                    <h2><?= $infoDateFormattee; ?></h2>
                </a>

        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </section>
</main>

<?php
get_sidebar();
get_footer();
?>