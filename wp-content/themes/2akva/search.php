<?php
/**
 * Displays single page
 *
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
get_header();
global $wp_query;
?>

<div class="cont-sec">
	<div class="content-div">
		<div class="main-wrap">
			<div class="w-richtext">
				<?php if ( have_posts() ) : ?>
					<?php get_search_form(); ?>
					<h2 class="page-title"><?php _e( 'Результаты поиска по запросу ', 'your-theme' ); ?><span>"<?php the_search_query(); ?>"</span></h2>
					<?php while ( have_posts() ) :
						the_post() ?>
						<div id="post-<?php the_ID(); ?>" class="search-result">
						<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>

						<?php if ( $post->post_type == 'post' ) { ?>                                   
							<div class="entry-meta">
								<span class="meta-prep meta-prep-author"><?php _e('By ', 'your-theme'); ?></span>
								<span class="author vcard"><a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'your-theme' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
								<span class="meta-sep"> | </span>
								<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'your-theme'); ?></span>
								<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-dTH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
							</div><!-- .entry-meta -->
						<?php } ?>
						<div class="entry-summary">   
							<?php the_excerpt( __( 'Прочитать полностью <span class="meta-nav">&raquo;</span>', 'your-theme' )  ); ?>
							<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
						</div><!-- .entry-summary -->
	 
						<?php if ( $post->post_type == 'post' ) { ?>
							<div class="entry-utility">
								<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'your-theme' ); ?></span><?php echo get_the_category_list(', '); ?></span>
								<span class="meta-sep"> | </span>
								
							</div><!-- #entry-utility -->
						<?php } ?>
						</div><!-- #post-<?php the_ID(); ?> -->
					<?php endwhile; ?>
 
					<?php
					$total_pages = $wp_query->max_num_pages;
					if ( $total_pages > 1 ) { ?>
						<div id="nav-below" class="navigation">
							<?php
							$big = 999999999; // need an unlikely integer
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages
							) );
							?>
						</div><!-- #nav-below -->
					<?php } ?>
				<?php else : ?>
					<div id="post-0" class="post no-results not-found">
						<h2 class="entry-title"><?php _e( 'К сожалению поиск не дал результатов', 'your-theme' ) ?></h2>
						<div class="entry-content">
							<p><?php _e( 'Извините, но по вашему запросу ничего не найдено. Попробуйте изменить запрос', 'your-theme' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer();?>