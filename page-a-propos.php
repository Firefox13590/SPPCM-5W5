<p>
  PAGE COMITE EXECUTIF <br>
  ENFANT
</p>

<?php
$intervalleAnnee = '';
[$moisCourant, $anneeCourante] = [(int)date('m'), (int)date('Y')];
// var_dump($moisCourant);
// echo ('<br>');
// var_dump($anneeCourante);
// echo ('<br>');

if ($moisCourant > 7) {
  $intervalleAnnee = $anneeCourante . '-' . $anneeCourante + 1;
} else {
  $intervalleAnnee = $anneeCourante - 1 . '-' . $anneeCourante;
}
// var_dump($intervalleAnnee);
// echo ('<br>');

get_header();
?>

<main id="comite-executif">
  <h2>
    Comité exécutif
    <span><?= $intervalleAnnee; ?></span>
  </h2>
  <section id="membres-comite-executif">
    <?php
    $argsComite = array(
      'post_type' => 'membre-executif',
      'posts_per_page' => -1,
    );
    $queryComite = new WP_Query($argsComite);

    if ($queryComite && $queryComite->have_posts()):
      while ($queryComite->have_posts()):
        $queryComite->the_post();

        $champs = get_fields();
        // var_dump($champs);
        // echo ('<br>');
        [$img, $nom, $role, $poste, $desc] =
          [
            $champs['comite_image'],
            $champs['comite_nom_complet'],
            $champs['comite_role'],
            $champs['comite_poste'],
            $champs['comite_description'],
          ];
        // var_dump($img);
        // echo ('<br>');
        // var_dump($nom);
        // echo ('<br>');
        // var_dump($role);
        // echo ('<br>');
        // var_dump($poste);
        // echo ('<br>');
        // var_dump($desc);
        // echo ('<br>');

        $targetCC = "cc-membre-" . $queryComite->current_post;
    ?>
        <article class="membre">
          <input type="checkbox" name="<?= $targetCC; ?>" id="<?= $targetCC; ?>" class="none">
          <label for="<?= $targetCC; ?>" role="button" class="button">
            <div class="membre-front">
              <img src="<?= $img; ?>">
              <div class="membre-front-info">
                <h3><?= $nom; ?></h3>
                <h4><?= $role; ?></h4>
              </div>
            </div>
          </label>
          <div class="membre-desc">
            <label for="<?= $targetCC; ?>" class="button" role="button">
              <span class="p">X</span>
            </label>
            <h4>Role éxécutif:<br><?= $role; ?></h4>
            <?php if ($poste): ?>
              <h4>Poste au collège:<br><?= $poste; ?></h4>
            <?php endif; ?>
            <p><?= $desc; ?></p>
          </div>
        </article>
    <?php
      endwhile;
    endif;
    wp_reset_postdata();
    ?>
  </section>
</main>

<?php
get_footer();
