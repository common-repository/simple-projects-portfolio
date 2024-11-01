<?php
//==================================================================================
//Setup Shortcode Handlers - Layout 1
//==================================================================================
add_shortcode('spp_layout1', 'simple_pp_layout1_shortcode_handler');
function simple_pp_layout1_shortcode_handler( $atts ) {
	global $post;
	$options = get_option( 'simple_pp_options' );
	
	$atts = shortcode_atts(
			array(
					'posts_per_page' => '-1',
					'post_type'      => 'spp_project',
					'post_status'    => 'publish',
					'order'          => 'ASC',
					'orderby'       => 'menu_order'
			),
			$atts,
			'spp_layout1'
			);
	
	$height = '500px';
	if ( !empty( $options['simple_pp_field_layout1_height'] ) ) {
		$height = $options['simple_pp_field_layout1_height'] . 'px'; // don't forget this is a string now, because 'px' is appended
	}
	
	$wordcount = 50;
	if ( !empty( $options['simple_pp_field_layout1_wordcount'] ) ) {
		$wordcount = $options['simple_pp_field_layout1_wordcount'];
	}
	
	$title_color = '';
	if ( !empty( $options['simple_pp_field_layout1_text_color'] ) ) {
		$title_color = $options['simple_pp_field_layout1_text_color'];
	}
	
	$title_html = '';
	if ( !empty( $options['simple_pp_field_layout1_text'] ) ) {
		$title_html = '<div class="ssp_opt_title" style="background: ' . $title_color . ';"><h1>' . $options['simple_pp_field_layout1_text'] . '</h1></div><div class="clear"></div>';
	}
	
	$width = '19%';
	if ($atts['posts_per_page'] > 5) {
		$atts['posts_per_page'] = 5;
	} else if ($atts['posts_per_page'] != '-1') {
		switch ($atts['posts_per_page']) {
			case 1:
				$width = '100%';
				break;
			case 2:
				$width = '49%';
				break;
			case 3:
				$width = '33%';
				break;
			case 4:
				$width = '24%';
				break;
			case 5:
				$width = '19%';
				break;
		}
	}
	
	$posts = new WP_Query($atts);
	$out = '<div class="ssp_projects_div" ' . ($options['simple_pp_field_has_space'] == 1 ? '' : 'style="font-size:0;"' ) . '>' . $title_html;
	$count = 0;
	
	if ( $posts->have_posts() )
		while ( $posts->have_posts() ):
		$posts->the_post();
		$count++;
		
		$feat_img_id  = get_post_thumbnail_id();
		$feat_img_url = wp_get_attachment_image_src($feat_img_id, 'full');
		$img_div_html = '';
		
		if ( isset ( $feat_img_url[0] ) && !empty ( $feat_img_url[0] ) ) {
			$img_div_html = 'background-image: url(' . $feat_img_url[0] . ');';
		}
		
		//$out .= '<div id="spp_' . $post->ID . '" class="spp_project col-lg-5ths" style="height: 500px; background-size: cover; ' . $img_div_html . '"><h3>' . $post->post_title . '</h3></div>';
		
		$out .= '
<div id="spp_full_' . $post->ID . '" class="spp_project_shortcode_section spp_num_' . $count . '" style="min-height:' . $height . '; width:' . $width . '; background-size: cover; ' . $img_div_html . '">
	<input class="button spp_close_btn" type="button" value="X">
	<div class="spp_description">
		<h2>' . $post->post_title . '</h2>
		<p ' . ($options['simple_pp_field_has_space'] == 1 ? '' : 'style="font-size:1rem;"' ) . '>' . wp_trim_words($post->post_content, $wordcount) . '</p>
		<a href="' . get_permalink() . '"><input class="button spp_learn_more_btn" type="button" value="Learn More"></a>
	</div>
				
	<div class="expand_btn_div"><input class="button spp_expand_btn" type="button" value="Expand"></div>
				
	<div class="clear"></div>
</div>';
		
		endwhile;
		else
			return; // no posts found
			
			$out .= '<div class="clear"></div></div>';
			
			
			wp_reset_query();
			return html_entity_decode( trim($out) );
}
?>