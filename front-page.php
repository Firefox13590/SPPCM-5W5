<?php
require(__DIR__ . '/utils/oneShotScripts/infolettres.php');
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
    ?>

  </section>

  <section id="acces-rapide-info">
    <h1>Infolettres</h1>
    <?php
    $pageInfolettres = get_page_by_path('infolettre-accueil');
    $argsPage = array(
      'post_type' => 'page',
      'post_status' => 'publish',
      'post_parent' => $pageInfolettres ? $pageInfolettres->ID : 0,
    );
    // Sans page parent, ne pas afficher d'autres pages à la place des infolettres.
    $queryPage = $pageInfolettres && $pageInfolettres->post_status === 'publish' ? new WP_Query($argsPage) : null;

    if ($queryPage && $queryPage->have_posts()):
      while ($queryPage->have_posts()):
        $queryPage->the_post();
        $pageContent = get_the_content();
    ?>

        <div class="info-item">
          <h2><?= the_title(); ?></h2>
          <h4><?= get_the_date(); ?></h4>
        </div>

    <?php
      endwhile;
    else:
    ?>
      <p>Aucune infolettre n’est disponible pour le moment.</p>
    <?php
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

<div>
  <?php
  DebugPostContent();
  ?>
</div>

<?php
get_sidebar();
get_footer();
