<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Underscores
 */

?>

<footer id="colophon" class="site-footer">


	<!-- Ici ce trouve 67 (coordonnées)-->
	<!--
    <ul>
        <li>
            <a href="sppcm@cmaisonneuve.qc.ca">Icône de email</a>
        </li>
        <li>
            <a href="(514) 254-7131">Icône de téléphone</a>
        </li>
        <li>
            <a href="3800, rue Sherbrooke Est, Local : A-4452 Montréal (Québec) H1X 2A2">Icône de point</a>
        </li>
    </ul>
 -->


	<div id="logo">
		<img src="http://localhost/Refonte_SPPCM/wordpress/wp-content/uploads/2018/02/cropped-sppcm_logo_rgb.png" alt="Logo SPPCM">
	</div>

	<!-- Ici ce trouve 66 (réseaux sociaux)-->
	<div class="reseaux">
		<ul>
			<li>
				<a href="https://www.facebook.com/SPPCMaisonneuve#"><img src="http://localhost/Refonte_SPPCM/wordpress/wp-content/uploads/2018/03/logo_fb.png" alt="facebook"></a>
			</li>
			<li>
				<a href="mailto:sppcm@cmaisonneuve.qc.ca"><img src="http://localhost/Refonte_SPPCM/wordpress/wp-content/uploads/2018/03/logo_mail.png" alt="email"></a>
			</li>
			<li>
				<a href="https://www.csn.qc.ca/"><img src="http://localhost/Refonte_SPPCM/wordpress/wp-content/uploads/2018/03/logo_csn.png" alt="CSN"></a>
			</li>
			<li>
				<a href="https://fneeq.qc.ca/fr/accueil/"><img src="http://localhost/Refonte_SPPCM/wordpress/wp-content/uploads/2018/03/logo_fneeq.png" alt="FNEEQ"></a>
			</li>
		</ul>
	</div>

	<?php
	$partenairesFooter = array();

	if (function_exists('get_field')) {
		// Modification pour pharly: Créer un champ général "partenaires" qui peut prendre plusieurs valeurs
		$publicationsPartenaires = get_posts(array(
			'post_type' => 'sppcm_partenaire',
			'post_status' => 'publish',
			'numberposts' => -1,
			'orderby' => array('menu_order' => 'ASC', 'title' => 'ASC', 'ID' => 'ASC'),
		));

		foreach ($publicationsPartenaires as $publicationPartenaire) {
			$nomPartenaire = get_the_title($publicationPartenaire->ID);
			$imagePartenaire = absint(get_field('imagePartenaire', $publicationPartenaire->ID));
			$lienPartenaire = esc_url(get_field('lienPartenaire', $publicationPartenaire->ID) ?: '', array('http', 'https'));
			$balisageImagePartenaire = '';

			if ($imagePartenaire) {
				$balisageImagePartenaire = wp_get_attachment_image(
					$imagePartenaire,
					'medium',
					false,
					array('alt' => $nomPartenaire)
				);
			}

			if ('' !== trim($nomPartenaire) && $balisageImagePartenaire) {
				$partenairesFooter[] = array(
					'image' => $balisageImagePartenaire,
					'lien' => $lienPartenaire,
				);
			}
		}
	}
	?>

	<?php if ($partenairesFooter) : ?>
		<section class="partenaires-footer" aria-labelledby="titre-partenaires-footer">
			<h2 id="titre-partenaires-footer"><?php esc_html_e('Nos partenaires', 'underscores-child'); ?></h2>
			<ul class="liste-partenaires-footer">
				<?php foreach ($partenairesFooter as $partenaireFooter) : ?>
					<li class="partenaire-footer">
						<?php if ($partenaireFooter['lien']) : ?>
							<a href="<?php echo esc_url($partenaireFooter['lien']); ?>" target="_blank" rel="noopener noreferrer">
								<?php echo $partenaireFooter['image'];  ?>
							</a>
						<?php else : ?>
							<?php echo $partenaireFooter['image']; ?>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endif; ?>

	<div class="site-info">
		COPYRIGTH 
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>




</body>

</html>