<?php

function DebugPostContent(): void
{
  $argsDebug = array(
    'post_type' => 'page',
    'post_parent' => 5569,
    'posts_per_page' => 1,
  );
  $queryDebug = new WP_Query($argsDebug);

  if ($queryDebug->have_posts()) {
    while ($queryDebug->have_posts()) {
      $queryDebug->the_post();
      $debugContent = get_the_content();
      // echo ($debugContent);
      $arraySplit = explode('<a', $debugContent);
      array_shift($arraySplit);
      // var_dump($arraySplit);
      // var_dump('<a' . $arraySplit[0]);

      $posFinTagA = 0;
      $aTagContent = '';
      $summaryContent = '';
      for ($i = 0; $i < count($arraySplit); $i++) {
        $arraySplit[$i] = '<a' . $arraySplit[$i];

        $posFinTagA = strpos($arraySplit[$i], '</a>');
        echo ("a tag range for element #$i: [0, " . ($posFinTagA + 4) . '] <br>');

        $aTagContent = substr($arraySplit[$i], 0, $posFinTagA + 4);
        echo ('a tag: ' . htmlspecialchars($aTagContent) . '<br>');
        echo ('a tag content: ' .  strip_tags($aTagContent) . '<br>');

        $summaryContent = substr($arraySplit[$i], $posFinTagA + 4);
        echo ('summary: ' . htmlspecialchars($summaryContent) . '<br>');
        echo ('summary content: ' .  strip_tags($summaryContent) . '<br>');

        echo ('<br><br><br>');
      }
    }
  }
}
