<?php

const SCRIPT_EXECUTED = true;
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
  'yyyy-MM-dd'
);

/**
 * Débogue et récupère les textes importants. 
 * 
 * Ne sert qu'à rapidement prendre le contenu des infolettres et les traduire en post ACF.
 * 
 * Fonction défectueuse qui va faire des erreur et rater des données. Le but est de faire la majorité du travail, pas la totalité.
 */
function DebugPostContent(): void
{
  if (SCRIPT_EXECUTED) return;

  global $formatteurLisible;
  $argsDebug = array(
    'post_type' => 'page',
    'post_parent' => 5569,
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
  );
  $queryDebug = new WP_Query($argsDebug);

  if ($queryDebug->have_posts()) {
    while ($queryDebug->have_posts()) {
      $queryDebug->the_post();
      // the_title();
      // echo ('<br><br>');

      $debugContent = get_the_content();
      // echo ($debugContent);

      $arraySplit = explode('<a', $debugContent);
      array_shift($arraySplit);
      // var_dump($arraySplit);
      // var_dump('<a' . $arraySplit[0]);
      // echo ('there are ' . count($arraySplit) . ' elements');
      // echo ('<br><br>');

      $dateConvResult = false;
      $hrefContent = false;
      $summaryNContent = false;
      for ($i = 0; $i < count($arraySplit); $i++) {
        $arraySplit[$i] = '<a' . $arraySplit[$i];

        $posFinTagA = strpos($arraySplit[$i], '</a>');
        $posFinTagA += 4;
        // echo ("a tag range for element #$i: [0, " . ($posFinTagA) . '] <br>');

        $aTagNContent = substr($arraySplit[$i], 0, $posFinTagA);
        // echo ('a tag: ' . htmlspecialchars($aTagNContent) . '<br>');
        // echo ('a tag content: ' .  strip_tags($aTagNContent) . '<br>');
        $dateConvResult = datefmt_parse($formatteurLisible, strip_tags($aTagNContent));
        // var_dump($dateConvResult);

        $posDebutHref = strpos($aTagNContent, 'href="');
        $posDebutHref += 6;
        $posFinHref = strpos($aTagNContent, '"', $posDebutHref);
        $hrefContent = substr(
          $aTagNContent,
          $posDebutHref,
          $posFinHref - $posDebutHref
        );
        // echo ('href content: ' . $hrefContent . '<br>');

        $summaryNContent = substr($arraySplit[$i], $posFinTagA);
        // echo ('summary: ' . htmlspecialchars($summaryNContent) . '<br>');
        // echo ('summary content: ' .  strip_tags($summaryNContent) . '<br>');

        // echo ('<br><br><br>');


        MassCreatePosts($dateConvResult, $hrefContent, $summaryNContent);
      }

      // echo ('<br><br><br><br><br>');
    }
  }
  wp_reset_postdata();

  // var_dump(date('j F Y', mktime(0, 0, 0, 6, 1, 2026)));
  // var_dump(strtotime(date('j F Y', mktime(0, 0, 0, 6, 1, 2026))));
  // var_dump(strtotime('2026-06-30'));
  // var_dump(strtotime('2026-06'));
  // var_dump(strtotime('2026-06-01') > strtotime('2026-06'));
  // var_dump(strtotime('2026-06-30') > strtotime('2026-06'));
  // var_dump(strtotime('2026-06-01') == strtotime('2026-06'));
  // var_dump(strtotime('2025-07') < strtotime('2026-06-01') && strtotime('2026-06-01') < strtotime('2026-07'));
}

function MassCreatePosts(int|float|false $timestamp, string|false $lien, string|false $content): void
{
  if (SCRIPT_EXECUTED) return;
  if ($timestamp === false) return;

  global $formatteurLisible;
  global $formatteurLogique;

  $date = datefmt_format($formatteurLisible, $timestamp);
  $moisComparaison = '-07'; // juillet
  $intervalleAnnee = [];
  $parentId = 0;
  $termId = 0;

  // var_dump($timestamp . '<br>');
  // var_dump($date . '<br>');
  // echo (date('Y', $timestamp) . '<br>');
  // echo (date('F', $timestamp) . '<br>');
  // var_dump($lien . '<br>');
  // var_dump($content . '<br>');

  $argsParentsInfo = array(
    'post_type' => 'infolettre',
    'tax_query' => array(
      array(
        'taxonomy' => 'annee-scolaire',
        'field' => 'term_id',
        'terms' => 218,
        'include_children' => false,
      ),
    ),
  );
  $queryParentsInfo = new WP_Query($argsParentsInfo);

  if ($queryParentsInfo->have_posts()) {
    while ($queryParentsInfo->have_posts()) {
      $queryParentsInfo->the_post();

      // the_title();
      // echo ('<br>');
      // var_dump($date);
      // var_dump(datefmt_format($formatteurLogique, $timestamp));
      // var_dump(date('Ymd', $timestamp));
      // echo ('<br>');
      // var_dump(the_title(display: false) . '-annee-scolaire');
      // echo ('<br>');
      $intervalleAnnee = explode('-', the_title(display: false));
      // var_dump($intervalleAnnee);
      // var_dump(
      //   strtotime($intervalleAnnee[0] . $moisComparaison) < strtotime(datefmt_format($formatteurLogique, $timestamp)) &&
      //     strtotime(datefmt_format($formatteurLogique, $timestamp)) < strtotime($intervalleAnnee[1] . $moisComparaison)
      // );
      // echo ('<br>');

      $parentId = get_the_ID();
      // var_dump($parentId);
      // echo ('<br>');

      $termId = $intervalleAnnee[0][0] . substr($intervalleAnnee[0], 2);
      // var_dump($termId);
      // echo ('<br>');
      $termId = (int) $termId;
      // var_dump($termId);
      // echo ('<br>');

      if (
        strtotime($intervalleAnnee[0] . $moisComparaison) < strtotime(datefmt_format($formatteurLogique, $timestamp)) &&
        strtotime(datefmt_format($formatteurLogique, $timestamp)) < strtotime($intervalleAnnee[1] . $moisComparaison)
      ) {
        break;
      }
    }
  }
  wp_reset_postdata();

  if ($date !== false) {
    // echo ('can create post: ');
    // the_title();
    // echo ('<br>');
    // echo (the_title(display: false) . '-annee-scolaire');
    // echo ('<br>');

    $postDetails = array(
      'post_title' => $date,
      'post_content' => 'Utiliser get_fields() du plugin ACF.',
      'post_author' => 1,
      'post_status' => 'publish',
      'post_type' => 'infolettre',
      'post_parent' => $parentId,
    );
    $postId = 0;
    $postId = wp_insert_post($postDetails);

    if ($postId && !is_wp_error($postId)) {
      // the_title();
      // echo ('<br>');
      // var_dump($termId);
      // echo ('<br>');

      // donne la bonne taxonomie
      wp_set_object_terms($postId, $termId, 'annee-scolaire');

      // donner valeur aux champs ACF
      update_post_meta($postId, 'info_date', date('Ymd', $timestamp));
      update_post_meta($postId, 'info_lien', $lien);
      update_post_meta($postId, 'info_resume', $content);
    }
  }
  // echo ('<br>');
}
