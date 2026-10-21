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

		<?php
		$partenairesFooter = array();

		if ( function_exists( 'get_field' ) ) {
			// Modification pour pharly: Créer un champ général "partenaires" qui peut prendre plusieurs valeurs
			$publicationsPartenaires = get_posts( array(
				'post_type' => 'sppcm_partenaire',
				'post_status' => 'publish',
				'numberposts' => -1,
				'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC', 'ID' => 'ASC' ),
			) );

			foreach ( $publicationsPartenaires as $publicationPartenaire ) {
				$nomPartenaire = get_the_title( $publicationPartenaire->ID );
				$imagePartenaire = absint( get_field( 'imagePartenaire', $publicationPartenaire->ID ) );
				$lienPartenaire = esc_url( get_field( 'lienPartenaire', $publicationPartenaire->ID ) ?: '', array( 'http', 'https' ) );
				$balisageImagePartenaire = '';

				if ( $imagePartenaire ) {
					$balisageImagePartenaire = wp_get_attachment_image(
						$imagePartenaire,
						'medium',
						false,
						array( 'alt' => $nomPartenaire )
					);
				}

				if ( '' !== trim( $nomPartenaire ) && $balisageImagePartenaire ) {
					$partenairesFooter[] = array(
						'image' => $balisageImagePartenaire,
						'lien' => $lienPartenaire,
					);
				}
			}
		}
		?>

		<?php if ( $partenairesFooter ) : ?>
			<section class="partenaires-footer" aria-labelledby="titre-partenaires-footer">
				<h2 id="titre-partenaires-footer"><?php esc_html_e( 'Nos partenaires', 'underscores-child' ); ?></h2>
				<ul class="liste-partenaires-footer">
					<?php foreach ( $partenairesFooter as $partenaireFooter ) : ?>
						<li class="partenaire-footer">
							<?php if ( $partenaireFooter['lien'] ) : ?>
								<a href="<?php echo esc_url( $partenaireFooter['lien'] ); ?>">
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
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'underscores' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'underscores' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'underscores' ), 'underscores', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
