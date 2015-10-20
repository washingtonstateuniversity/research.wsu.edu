<?php

get_header();

// If a featured image is assigned to the post, display as a background image.
if ( spine_has_background_image() ) {
	$background_image_src = spine_get_background_image_src();

	?><style> html { background-image: url('<?php echo esc_url( $background_image_src ); ?>'); }</style><?php
}
?>

<main>
	<div class="header-wrap">
<?php

/**
 * Retrieve an array of values to be used in the header.
 *
 * site_name
 * site_tagline
 * page_title
 * post_title
 * section_title
 * subsection_title
 * posts_page_title
 * sup_header_default
 * sub_header_default
 * sup_header_alternate
 * sub_header_alternate
 */
$spine_main_header_values = spine_get_main_header();

if ( spine_get_option( 'main_header_show' ) == 'true' ) :

?>
<header class="main-header">
	<div class="header-group hgroup guttered padded-bottom short">

		<sup class="sup-header" data-section="<?php echo $spine_main_header_values['section_title']; ?>" data-pagetitle="<?php echo $spine_main_header_values['page_title']; ?>" data-posttitle="<?php echo $spine_main_header_values['post_title']; ?>" data-default="<?php echo esc_html($spine_main_header_values['sup_header_default']); ?>" data-alternate="<?php echo esc_html($spine_main_header_values['sup_header_alternate']); ?>"><span class="sup-header-default"><?php echo strip_tags( $spine_main_header_values['sup_header_default'], '<a>' ); ?></span></sup>
		<sub class="sub-header" data-sitename="<?php echo $spine_main_header_values['site_name']; ?>" data-pagetitle="<?php echo $spine_main_header_values['page_title']; ?>" data-posttitle="<?php echo $spine_main_header_values['post_title']; ?>" data-default="<?php echo esc_html($spine_main_header_values['sub_header_default']); ?>" data-alternate="<?php echo esc_html($spine_main_header_values['sub_header_alternate']); ?>"><span class="sub-header-default"><?php echo strip_tags( $spine_main_header_values['sub_header_default'], '<a>' ); ?></span></sub>

	</div>
</header>

<?php endif; ?>
<?php
if ( function_exists( 'wsuwp_uc_get_object_type_slugs' ) && in_array( get_post_type(), wsuwp_uc_get_object_type_slugs() ) ) {
	if ( 'wsuwp_uc_person' === get_post_type() ) {
		get_template_part( 'parts/single-layout', 'wsuwp_uc_person' );
	} else {
		get_template_part( 'parts/single-layout', 'university-center' );
	}
} else {
	if ( spine_has_featured_image() ) {
		 get_template_part('parts/featured-images');
	}

?>
</div>
<?php 
	get_template_part( 'parts/single-layout', get_post_type() );
}
?>
<footer class="main-footer">
	<section class="row halves pager prevnext gutter pad-ends">
		<div class="column one">
			<?php previous_post_link(); ?>
		</div>
		<div class="column two">
			<?php next_post_link(); ?>
		</div>
	</section><!--pager-->
</footer>

	<?php get_template_part( 'parts/footers' ); ?>

</main><!--/#page-->

<?php get_footer(); ?>