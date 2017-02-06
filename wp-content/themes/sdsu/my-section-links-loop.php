<?php if(get_field('sections')): ?>
						<?php while(has_sub_field('sections')): ?>
							<div class="section_link_wrapper">
							<?php if(get_sub_field('section_title')):?>
							<h2><?php the_sub_field('section_title'); ?></h2>
							<?php endif; ?>
							<?php if(get_sub_field('section_assets') ): ?>
								<?php while(has_sub_field('section_assets') ): ?>
									<?php if(get_sub_field('file_or_link') == "File"): ?>
										<p>
											<a target="_blank" title="<?php the_sub_field('file_title'); ?>"  href="<?php the_sub_field('file'); ?>"><?php the_sub_field('file_title'); ?></a>
										</p>
									<?php endif; ?>
									<?php if(get_sub_field('file_or_link') == "Link"): ?>
										<p>
											<a target="_blank" title="<?php the_sub_field('link_title'); ?>"  href="<?php the_sub_field('link'); ?>"><?php the_sub_field('link_title'); ?></a>
										</p>
									<?php endif; ?>
								<?php endwhile; ?>
							<?php endif; ?>
							</div><!-- end of section_link_wrapper -->   
						<?php endwhile; ?>
					<?php endif; ?>