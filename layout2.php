<?php
//==================================================================================
//Setup Shortcode Handlers - Layout 2
//==================================================================================
add_shortcode('spp_layout2', 'simple_pp_layout2_shortcode_handler');
function simple_pp_layout2_shortcode_handler( $atts ) {
	global $post;
	$options = get_option( 'simple_pp_options' );
	
	$atts = shortcode_atts(
			array(
					'posts_per_page' => '5',
					'post_type'      => 'spp_project',
					'post_status'    => 'publish',
					'order'          => 'ASC',
					'orderby'       => 'menu_order'
			),
			$atts,
			'spp_layout2'
			);
	
	$count = 0;
	$width = '19%';
	

	switch ($atts['posts_per_page']) {
		case 1:
			$width = '100%';
			break;
		case 2:
			$width = '50%';
			break;
		case 3:
			$width = '33.333%';
			break;
		case 4:
			$width = '25%';
			break;
		case 5:
		default:
			$width = '20%';
			break;
		}

	
	$height = '500px';
	if ( !empty( $options['simple_pp_field_layout2_height'] ) ) {
		$height = $options['simple_pp_field_layout2_height'] . 'px'; // don't forget this is a string now, because 'px' is appended
	}
	
	$wordcount = 50;
	if ( !empty( $options['simple_pp_field_layout2_wordcount'] ) ) {
		$wordcount = $options['simple_pp_field_layout2_wordcount'];
	}
	
	$back_color= '';
	if ( !empty( $options['simple_pp_field_layout2_color'] ) ) {
		$back_color= $options['simple_pp_field_layout2_color'];
	}
	
	$posts = new WP_Query($atts);
	
	$out1 = '<div id="spp_entire_layout2" style="font-size:0;">';
	// set up heads
	if ( $posts->have_posts() )
		while ( $posts->have_posts() ):
			$posts->the_post();
			$count++;
			$out1 .= '
<div class="spp_layout2_title spp_layout2_title_num_' . $count . '" style="display: inline-block; padding: 0px 10px 10px 10px; width:' . $width . ';">
	<h2 class="spp_layout2_title_h2 spp_layout2_h2_num_' . $count . '"><a class="" href="' . get_permalink() . '">' . wp_trim_words($post->post_title, 5). '</a></h2>
</div>';
		endwhile;
	else
		return; // no posts found
	
	$out1 .= '';
	
	$out2 = '<div class="ssp_projects_div_2" data-mh="my-group" style="background-size: cover; height:' . $height .'; max-height:' . $height .';">';
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
		
		//$out2 .= '<div id="spp_' . $post->ID . '" class="spp_project col-lg-5ths" style="height: 500px; background-size: cover; ' . $img_div_html . '"><h3>' . $post->post_title . '</h3></div>';
		$out2 .= '
<div id="spp_full_2_' . $post->ID . '" data-mh="my-group" class="spp_project_shortcode_section_2 spp_layout2_num_' . $count . '" style="padding: 0px 10px 10px 10px; height:' . $height .'; max-height:' . $height .'; width:' . $width . ';">
	<div class="spp_description_2">
		<p style="font-size: 1rem;">' . wp_trim_words($post->post_content, $wordcount) . '</p>
		<a class="layout2_learnmore" href="' . get_permalink() . '">Learn More</a>
	</div>
				
	<div class="clear"></div>
</div>';
		
		// img url hidden value
		$out2 .= '<input id="hidden_img_url_' . $count . '" type="hidden" value="' . $feat_img_url[0] . '" />';
		
		endwhile;
	else
		return; // no posts found
			
	$out2 .= '<div class="clear"></div></div>
<div class="spp_nav_div" style="">
	<input type="hidden" id="spp_what_page" value="1" \>
	<input type="hidden" id="spp_height_setting" value="' . $height . '" \>
	<input type="hidden" value="' . $back_color . '" id="hidden_back_color" \>

	<input style="float:left;" type="button" id="spp_previous" class="" value="<" disabled \>
	<input style="float:right;" type="button" id="spp_next" class="" value=">" \>
	<div class="clear"></div>
</div>';
			
	wp_reset_query();
	return html_entity_decode( trim($out1) . trim($out2) . '</div><!-- #spp_entire_layout2 -->');
}
?>