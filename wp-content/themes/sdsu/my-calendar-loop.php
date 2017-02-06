
<div class="calendar_wrapper calendar_feed">
	<h2><?php the_title(); ?></h2>
	<p><?php the_field('date');?></p>
	<p><?php the_field('location');?></p>
	<?php if(get_field('map_it')): ?>
	<p>
		<a title="Get Directions - <?php the_title(); ?>" class="mapit" target="_blank" href="<?php the_field('map_it');?>">Map It</a>
	</p>
	<?php endif; ?>
	<?php if(get_field('calendar_file')): ?>
	<p><a title="Read more details about <?php the_title(); ?>" class="pdf" href="<?php the_field('calendar_file'); ?>" target="_blank">View PDF<br/><img class="pdf_icon" alt="A PDF on <?php echo substr(the_title('', '', FALSE), 0, 25); ?>" src="<?php bloginfo('template_directory');?>/images/pdf-icon.png"/></a><br/></p>
	<?php endif; ?>
	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
</div>