	</div>

	
	<?php get_template_part('template-parts/footer/footer'); ?>
	<?php if(!is_cart()): ?>
		<?php get_template_part('template-parts/block/cart-sidebar'); ?>
	<?php endif; ?>

	<?php wp_footer(); ?>
	<?php the_field('footer_scripts','option'); ?>
</body>
</html>