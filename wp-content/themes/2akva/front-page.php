<?php get_header();?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="section">
		<div class="wide-blk">
			<h2 class="heading-2">Идеи. Оборудование. Решения.</h2>
			<div class="sep"></div>
			<div class="tov-flex">
				<?php if( have_rows('idei_oborudovanie_reshenija') ): $i=0;
					while( have_rows('idei_oborudovanie_reshenija') ) : the_row();
						$item_link = get_sub_field('item_link');
						// HIDDEN: GEOdek block - remove condition to restore
						if( empty($item_link) ) { $i++; continue; }
						$item_img = get_sub_field('item_img')?>
						<div class="tov-chld animated <?php echo $i%2==0? 'slideInLeft' : 'slideInRight'; ?>">
							<?php if($item_img): ?>
								<div class="tov-img" style="background-image: url('<?=$item_img ?>');"><a href="<?php the_sub_field('item_link') ?>" style="display: block;width: 100%;height: 100%"></a></div>
							<?php endif; ?>
							<div class="div-block-4">
								<a href="<?php the_sub_field('item_link') ?>" class="tov-link"><?php the_sub_field('item_header') ?></a>
								<?php the_sub_field('item_text') ?>
								<a href="<?php the_sub_field('item_link') ?>" class="info-btn w-button">подробнее</a>
							</div>
						</div>
					<?php $i++; endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>


	<div>
		<?php
		$args = array(
			'numberposts' 		 => 10,
			'orderby'			 => 'date',
			'order'				 => 'DESC',
			'post_type'  		 => 'areas_of_use',
			'suppress_filters'   => true,
		);
		$posts = get_posts( $args ); ?>
		<?php if($posts): ?>
			<div class="wide-blk color">
				<h2 class="heading-2 white">Области применения нашего оборудования и решений</h2>
				<div class="tov-flex">
					<?php foreach($posts as $post){
						setup_postdata($post);
						$cur_id2 = get_the_ID();
						$area_of_use_icon = get_field('area_of_use_icon',$cur_id2); ?>
							<a href="<?php the_permalink(); ?>" class="prim-chld w-inline-block">
								<div class="prim-img">
									<img src="<?=$area_of_use_icon?>" alt="" class="image-3">
									<div class="div-block-7"></div>
								</div>
								<div><?php the_title(); ?></div>
							</a>
						<?php
					}
					wp_reset_postdata(); ?>
				</div>
				<div data-poster-url="<?=SPEC_VIDEO?>/videoplayback-poster-00001.jpg" data-video-urls="<?=SPEC_VIDEO?>/videoplayback-transcode.webm,<?=SPEC_VIDEO?>/videoplayback-transcode.mp4" data-autoplay="true" data-loop="true" data-wf-ignore="true" class="background-video w-background-video w-background-video-atom">
					<video autoplay="" loop="" style="background-image:url('<?=SPEC_VIDEO?>/videoplayback-poster-00001.jpg')" muted="" playsinline="" data-wf-ignore="true"><source src="<?=SPEC_VIDEO?>/videoplayback-transcode.webm" data-wf-ignore="true"><source src="<?=SPEC_VIDEO?>/videoplayback-transcode.mp4" data-wf-ignore="true"></video>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php
		$args = array(
			'numberposts' 		 => 3,
			'category_name'		 => 'novosti',
			'orderby'			 => 'date',
			'order'				 => 'DESC',
			'post_type'  		 => 'post',
			'suppress_filters'   => true,
		);

		$posts = get_posts( $args );
		if($posts): ?>
		<div class="section wbg">
			<div class="wide-blk">
				<h2 class="heading-2">Новости компании</h2>
				<div class="tov-flex">
					<?php
						foreach($posts as $post){
							setup_postdata($post);
							$url = get_the_post_thumbnail_url($post->ID,'medium');
							?>
							<div class="news-blk">
								<div class="news-img" style="background-image: url(<?=$url?>);"></div>
								<div class="div-block-6">
									<h4 class="heading-3"><?php the_title(); ?></h4>
									<p><?php echo kama_excerpt(array('maxchar'=>150,'text'=>$post->post_content)); ?></p><a href="<?php the_permalink(); ?>" class="info-btn w-button">подробнее</a>
								</div>
							</div>
						<?php
						}
						wp_reset_postdata(); ?>
				</div>
				<div class="div-block-11"><a href="<?=HOME_URL?>/category/novosti" class="info-btn w-button">Посмотреть все новости</a></div>
			</div>
		</div>
	<?php endif; ?>
<?php endwhile; endif; ?>

<?php get_footer();?>
