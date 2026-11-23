<?php
$filtre = '';
$tri = '';

get_header();
?>

<main id="actualites">
  <h1>Actualités</h1>

  <form class="filtre-tri">
    <?php
    $terms = get_terms(array(
      'taxonomy' => 'category',
    ));
    // var_dump($terms);
    ?>
    <div class="filtre">
      <?php for ($i = 0; $i < count($terms); $i++): ?>
        <div><?= $terms[$i]->name; ?></div>
        <!-- <label for=""></label>
        <input type="checkbox" name="" id=""> -->
      <?php endfor; ?>
    </div>
    <div class="parametres-filtre"></div>
    <div class="tri"></div>
    <input type="button" value="Filtrer et trier">
  </form>

  <section id="actus">
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
        <article class="actu-item">
          <a href="<?= the_permalink(); ?>" target="_blank">
            <h3><?= the_title(); ?></h3>
          </a>
          <p><?= the_content(); ?></p>
        </article>
    <?php
      endwhile;
    endif;
    ?>
  </section>
</main>

<?php
get_footer();
