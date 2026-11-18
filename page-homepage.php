<?php
get_header();
?>

<main id="actualites">
  <h2>Actualités</h2>
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
      <div>
        <h3><?= the_title(); ?></h3>
        <p><?= the_content(); ?></p>
      </div>
  <?php
    endwhile;
  endif;
  ?>
</main>

<?php
get_footer();
