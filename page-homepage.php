<?php
get_header();
?>

<main id="actualites">
  <h1>Actualités</h1>
  
  <?php
  $argsInfo = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
  );
  $queryInfo = new WP_Query($argsInfo);

  if ($queryInfo && $queryInfo->have_posts()):
    while ($queryInfo->have_posts()):
      $queryInfo->the_post();
  ?>
      <article class="actualite-item">
        <a href="<?= the_permalink(); ?>" target="_blank">
          <h3><?= the_title(); ?></h3>
        </a>
        <p><?= the_content(); ?></p>
      </article>
  <?php
    endwhile;
  endif;
  ?>
</main>

<?php
get_footer();
