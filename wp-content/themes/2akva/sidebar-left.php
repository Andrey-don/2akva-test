<div class="left-navdiv">
	<?php $cur_id = get_the_ID();
	$post_type = get_post_type( $cur_id );
	$obj = get_post_type_object($post_type); ?>
	<h3 class="cat-header"><?php echo $obj->labels->singular_name; ?></h3>
	<?php
	// print("<pre>".print_r($cur_id,true)."</pre>");
	// print("<pre>".print_r($post_type,true)."</pre>");
	// print("<pre>".print_r($obj,true)."</pre>");
	$check = 0;
	if(is_archive()){
		$check = 1;
	}
	if($check==1){
		$args = array(
			'numberposts' 		 => 99,
			'orderby'			 => 'menu_order',
			'order'				 => 'DESC',
			'post_type'  		 => $post_type,
			'suppress_filters'   => true, // подавление работы фильтров изменения SQL запроса
			'post_parent'		 => 0,
		);
		$posts = get_posts( $args );
		if($posts):
			foreach($posts as $post){
				setup_postdata($post); 
				$cur_id2 = get_the_ID(); ?>
					<a href="<?php the_permalink(); ?>" class="cat-link w-inline-block <?php echo ($check==0 && $cur_id==$cur_id2)?"w--current":"";?>">
						<div><?php the_title(); ?></div>
					</a>
				<?php 
			}
			wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php }
	else{
		$childrens = get_children(array('post_parent'=>$cur_id,'post_type'=>'equipmente','numberposts'=>-1,'order'=>'ASC'));
		if($childrens){
			foreach( $childrens as $children ){
				$cur_id3 = $children->ID; ?>
				<a href="<?php the_permalink($cur_id3); ?>" class="cat-link w-inline-block <?php echo ($check==0 && $cur_id==$cur_id3)?"w--current":"";?>">
					<div>&nbsp;&nbsp;<?=$children->post_title; ?></div>
				</a>
			<?php }
		}
	} ?>
</div>