<?php
// require(__DIR__ . '/utils/oneShotScripts/infolettres.php');

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
FRONT PAGE ENFANT <br>


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
    <h1>Actualités</h1>

    <?php
    if (have_posts()) :
      global $wp_query;
      $wp_query->post_count = 5;
      while (have_posts()):
        the_post();
    ?>

        <article class="actu-item">
          <figure>
            <img src="<?= the_post_thumbnail(); ?>">
            <figcaption>
              <h2><?= the_title(); ?></h2>
              <h4><?= get_the_date(); ?></h4>
            </figcaption>
          </figure>
        </article>

    <?php
      endwhile;
    endif;
    wp_reset_postdata();
    ?>

  </section>

  <section id="acces-rapide-info">
    <h1>Infolettres</h1>
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
        $infoDate = get_field('info_date');
    ?>

        <div class="info-item">
          <a href="<?= get_field('info_lien'); ?>" target="_blank">
            <h2><?= datefmt_format($formatteurLisible, datefmt_parse($formatteurLogique, $infoDate)); ?></h2>
          </a>
          <div><?= get_field('info_resume'); ?></div>
        </div>

    <?php
      endwhile;
    endif;
    wp_reset_postdata();
    ?>
  </section>

  <section id="acces-rapide-faq">
    <h1>FAQ</h1>
    <?php for ($i = 0; $i < 5; $i++): ?>

      <div class="faq-item">
        <input type="checkbox" name="cc-faq-<?= $i; ?>" id="cc-faq-<?= $i; ?>" class="none">
        <label class="faq-item-title" for="cc-faq-<?= $i; ?>">
          <span><?= $i + 1; ?></span>
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
