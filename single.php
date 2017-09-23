<?php get_header(); ?>
<div class="container index">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Blog Posts</h3>
				</div>

				<div class="panel-body">
					<?php if(have_posts()): ?>
						<?php while(have_posts()): the_post() ?>
							<article class="post">
								<div class="row">
									

										<div class="col-md-12">
										<?php if(has_post_thumbnail()): ?>
											<div class="post-thumbnail">
												<?php the_post_thumbnail(); ?>
											</div>
										<?php endif; ?>
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<p class="meta">
												<?php echo __("Posted at"); ?> <?php the_time(); ?> <?php echo __("on"); ?> <?php the_date(); ?> <?php echo __("by"); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><strong><?php the_author(); ?></strong></a>
											</p>
											<div class="excerpt">
												<?php the_content(); ?>
											</div>
										</div>
								
								</div>
							</article>
						<?php endwhile; ?>
					<?php else: ?>
						<p><?php echo __("Sorry, no posts found...") ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<?php if(is_active_sidebar('sidebar')): ?>
				<?php dynamic_sidebar('sidebar'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>