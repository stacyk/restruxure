<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yoga
 */

get_header(); ?>


	<div class="primary content-area">
		<main id="main" class="site-main facetwp-template" role="main">

		<?php
		if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h2 class="page-title">', '</h2>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<!-- Display Filters -->
			<div class="filter-archive">
				<h4>Narrow by pose category:</h4>
				<?php echo facetwp_display( 'facet', 'categories' ); ?>
			</div>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- .primary -->


 <?php
//if ( get_query_var('paged') ) $paged = get_query_var('paged');
//if ( get_query_var('page') ) $paged = get_query_var('page');


$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$args = array(
	'post_type' => 'question',
	'tax_query' => array(
		array(
			'taxonomy' => 'question_category',
			'field'    => 'slug',
			'terms'    => $term->slug,
		),
	),
);

$query = new WP_Query( $args );


if ( $query->have_posts() ) : ?>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="entry">
			<h2 class="title">
				<?php the_title(); ?>
			</h2>
			<?php the_excerpt(); ?>
		</div>
	<?php endwhile; wp_reset_postdata(); ?>
	<!-- show pagination here -->
<?php else : ?>
	<!-- show 404 error here -->
<?php endif; ?>


<?php get_footer(); ?>
