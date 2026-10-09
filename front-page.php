FRONT PAGE enfant


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

<main>
  MAIN CONTENT THEME ENFANT
  <?php
  if (have_posts()) :
    echo ("have posts <br>");
    echo ("<section class='container-actu'>");

    while (have_posts()): the_post(); ?>

      <article class="actu-item">
        <figure><img src="<?= the_post_thumbnail(); ?>" alt=""></figure>
        <h2><?= the_title(); ?></h2>
      </article>

    <?php endwhile; ?>
  <?php
    echo ("</section>");
    the_posts_pagination();
  endif;
  ?>
</main>

<?php
get_sidebar();
get_footer();
