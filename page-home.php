<?php
get_header();
?>

<div class="max-w-6xl mx-auto lg:px-0 px-3 py-10">
    <?php if (have_posts()) {
		while (have_posts()) {
			the_post(); ?>
			<div class="page-content">
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
			</div>
	<?php }
	} ?>
</div>

<?php
get_footer();