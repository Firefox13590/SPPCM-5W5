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


<?php get_header(); ?>

<main id="infolettre-description">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php
            $infoDate = get_field('info_date');
            $infoLien = get_field('info_lien');

            $infoDateTimestamp = datefmt_parse($formatteurLogique, str_replace('-', '', $infoDate));
            $infoDateFormattee = datefmt_format($formatteurLisible, $infoDateTimestamp);
            ?>

            <h2 id="info-date"><?= esc_html($infoDateFormattee); ?></h2>

            <div class="info-resume">
                <?= get_field('info_resume'); ?>
            </div>

            <a id="infolettre-lien" href="<?= esc_url($infoLien); ?>" target="_blank" rel="noopener">
                Consulter l'infolettre
            </a>

    <?php endwhile;
    endif; ?>

</main>

<?php get_footer(); ?>