<?php

/**
 * Débogue et récupère les textes importants. 
 * 
 * Ne sert qu'à rapidement prendre le contenu des infolettres et les traduire en post ACF.
 * 
 * Fonction défectueuse qui va faire des erreur et rater des données. Le but est de faire la majorité du travail, pas la totalité.
 */
function DebugPostContent(): void
{
  $argsDebug = array(
    'post_type' => 'page',
    'post_parent' => 5569,
    'posts_per_page' => 1,
  );
  $queryDebug = new WP_Query($argsDebug);

  $formatter = datefmt_create(
    'fr_CA',
    IntlDateFormatter::NONE,
    IntlDateFormatter::NONE,
    'America/Toronto',
    IntlDateFormatter::GREGORIAN,
    'd MMMM yyyy'
  );

  if ($queryDebug->have_posts()) {
    while ($queryDebug->have_posts()) {
      $queryDebug->the_post();
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
        $dateConvResult = datefmt_parse($formatter, strip_tags($aTagNContent));
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
      }

      MassCreatePosts($dateConvResult, $hrefContent, $summaryNContent);

      // echo ('<br><br><br><br><br>');
    }
  }
}

function MassCreatePosts(int|float|false $date, string|false $lien, string|false $content): void {}
