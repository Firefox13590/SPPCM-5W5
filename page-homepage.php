<?php
// var_dump($_GET);
// var_dump($_SERVER['QUERY_STRING']);
$queryStrings = $_SERVER['QUERY_STRING'];

$filtres = explode('&', $queryStrings) ?? array('');
if (!empty($filtres[0])) {
  foreach ($filtres as $key => $value) {
    $filtres[$key] = explode('=', $value)[1];
  }
}
// var_dump(!empty($filtres[0]));
// var_dump($filtres);
$tris = array('');

$terms = get_terms(array(
  'taxonomy' => 'category',
));
// var_dump($terms);

get_header();
?>

<main id="page-actualites">
  <h1>Actualités</h1>

  <form id="form-filtre-tri">
    <fieldset class="filtre">
      <legend>Filtre</legend>
      <?php for ($i = 0; $i < count($terms); $i++): ?>
        <label for="term-<?= $terms[$i]->slug; ?>" class="bouton">
          <input
            type="checkbox"
            name="terms"
            id="term-<?= $terms[$i]->slug; ?>"
            value="<?= $terms[$i]->slug; ?>"
            <?php if (in_array($terms[$i]->slug, $filtres)) echo ('checked'); ?>
            hidden>
          <h3 class="filtre-item"><?= $terms[$i]->name; ?></h3>
        </label>
      <?php endfor; ?>
    </fieldset>

    <div class="parametres-filtre"></div>

    <div class="tri"></div>

    <input type="submit" value="Filtrer et trier" class="bouton">
  </form>

  <section id="actualites">
    <?php
    $tax_query = null;
    if (!empty($filtres[0])) {
      $tax_query = array(
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $filtres,
        ),
      );
    }

    $argsInfo = array(
      'post_type' => 'post',
      'posts_per_page' => 25,
      'tax_query' => $tax_query,
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
