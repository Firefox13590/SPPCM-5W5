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

<main id="front-page">
  <section id="acces-rapide-actu">
    <h2>Actualités</h2>

    <?php
    $queryActu = new WP_Query(array(
      'post_type' => 'post',
      'posts_per_page' => 7,
      'ignore_sticky_posts' => true,
    ));
    if ($queryActu->have_posts()) :
      while ($queryActu->have_posts()):
        $queryActu->the_post();

        $actuImgCouverture = get_the_post_thumbnail();
        // var_dump($actuImgCouverture);
    ?>

        <article role="button" class="btn-root actu-item">
          <a href="<?= the_permalink(); ?>">
            <figure>
              <?php if ($actuImgCouverture !== ''): ?>
                <?= $actuImgCouverture; ?>
              <?php endif; ?>
              <figcaption>
                <h2><?= the_title(); ?></h2>
                <h4><?= get_the_date(); ?></h4>
              </figcaption>
            </figure>
          </a>
        </article>

    <?php
      endwhile;
    endif;
    wp_reset_postdata();
    ?>

    <a role="button" href="http://localhost/Refonte_SPPCM/wordpress/category/actualite/" class="btn-root voir-plus">
      <h2 class="indice-lien-interne">Voir plus</h2>
    </a>

  </section>

  <section id="acces-rapide-info">
    <h2>Infolettres</h2>
    <?php
    $argsInfo = array(
      'post_type' => 'infolettre',
      'posts_per_page' => 5,
      'tax_query' => array(
        array(
          'taxonomy' => 'annee-scolaire',
          'field' => 'term_id',
          'terms' => 218,
          'include_children' => false,
          'operator' => 'NOT IN',
        ),
      ),
      'orderby' => 'meta_value_num',
      'meta_key' => 'info_date',
    );
    $queryInfo = new WP_Query($argsInfo);

    if ($queryInfo && $queryInfo->have_posts()):
      while ($queryInfo->have_posts()):
        $queryInfo->the_post();
        // var_dump($queryInfo->current_post);

        $infoDate = get_field('info_date');
        $infoDateTimestamp = datefmt_parse($formatteurLogique, str_replace('-', '', $infoDate));
        $infoDateFormattee = datefmt_format($formatteurLisible, $infoDateTimestamp);
        // var_dump($infoDate);
        // var_dump(str_replace('-', '', $infoDate));
        // var_dump($infoDateTimestamp);
        // var_dump($infoDateFormattee);
    ?>

        <a role="button" class="btn-root info-item <?php if ($queryInfo->current_post === 0) echo ('latest'); ?>"
          href="<?= get_field('info_lien'); ?>" target="_blank">
          <h2 class="indice-lien-interne"><?= $infoDateFormattee; ?></h2>
        </a>

    <?php
      endwhile;
    endif;
    wp_reset_postdata();
    ?>

    <a role="button" href="http://localhost/Refonte_SPPCM/wordpress/infolettre-accueil/" class="btn-root info-item voir-plus">
      <h2 class="indice-lien-interne">Voir plus</h2>
    </a>
  </section>

  <section id="acces-rapide-faq">
    <h2>FAQ</h2>
    <?php for ($i = 0; $i < 5; $i++): ?>

      <div role="button" class="faq-item js-accordeon">
        <input type="checkbox" name="cc-faq-<?= $i; ?>" id="cc-faq-<?= $i; ?>" class="none">
        <label class="faq-item-title" for="cc-faq-<?= $i; ?>">
          <h3>Question</h3>
          <span>+</span>
        </label>
        <div class="faq-item-content">
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Nulla necessitatibus labore nisi,
            esse facere ducimus id saepe impedit ipsam,
            inventore cum ex repellendus autem enim amet laborum?
            Enim, voluptatum fuga?
          </p>
        </div>
      </div>

    <?php endfor; ?>
  </section>
</main>

<?php
get_sidebar();
get_footer();
