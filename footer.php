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
		// Les partenaires sont gérés dans la page "Instances Syndicales" et ensuite affichés dans le footer
		$pagePartenaires = get_page_by_path( 'instances-syndicales-et-representants-es-des-enseignants-es' );
		$partenairesFooter = array();
		$champsPartenaires = array( 'partenaireCsn', 'partenaireFneeq', 'partenaireMainRouge', 'partenairePlanete' );

		if ( function_exists( 'get_field' ) && $pagePartenaires instanceof WP_Post ) {
			foreach ( $champsPartenaires as $nomChampPartenaire ) {
				$donneesPartenaire = get_field( $nomChampPartenaire, $pagePartenaires->ID );

				if ( ! is_array( $donneesPartenaire ) ) {
					continue;
				}

				$nomPartenaire = trim( (string) ( $donneesPartenaire['nom'] ?? '' ) );
				$imagePartenaire = absint( $donneesPartenaire['image'] ?? 0 );
				$lienPartenaire = esc_url( $donneesPartenaire['lien'] ?? '', array( 'http', 'https' ) );
				$balisageImagePartenaire = '';

				// WordPress génère l'image avec le nom du partenaire.
				if ( $imagePartenaire ) {
					$balisageImagePartenaire = wp_get_attachment_image(
						$imagePartenaire,
						'medium',
						false,
						array( 'alt' => $nomPartenaire )
					);
				}

				if ( '' !== $nomPartenaire && '' !== $balisageImagePartenaire ) {
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
