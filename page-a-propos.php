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
  ?>
      <article>
        <img src="<?= $img; ?>">
        <div>
          <h3><?= $nom; ?></h3>
          <h4><?= $role; ?></h4>
        </div>
        <div>
          <h4><?= $poste; ?></h4>
          <p><?= $desc; ?></p>
        </div>
      </article>
  <?php
    endwhile;
  endif;
  wp_reset_postdata();
  ?>
</main>

<?php
get_footer();
