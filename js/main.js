//////////// Global variables ////////////
var animate_timer = 250;
var delay_timer   = 275;
var fadein_timer  = 300;
//////////////////////////////////////////

function simple_pp_1_inHandler() {
	
	jQuery('.spp_expand_btn').hide();
	
	var thisdiv   = jQuery(this).parents('.spp_project_shortcode_section');
	var num       = jQuery( ".spp_project_shortcode_section" ).length;
	var sec_width = '19%';
	var pid       = thisdiv.attr('id');
	var id        = pid.replace('spp_', '');
	var classList = thisdiv.attr('class').split(/\s+/);
	
	switch(num) {
	    case 1:
	    	sec_width = '100%';
	        break;
	    case 2:
	    	sec_width = '49%';
	        break;
	    case 3:
	    	sec_width = '33%';
	        break;
	    case 4:
	    	sec_width = '24%';
	        break;
	    case 5:
	    	sec_width = '19%';
	        break;
	    default:
	    	sec_width = '19%';
	}
	
	var num = 0;
	jQuery.each(classList, function(index, item) {
		if (item.indexOf("spp_num_") >= 0) {
	        num = item.replace('spp_num_', '');
	    }
	});
	
	jQuery('.spp_project_shortcode_section').not('.spp_num_' + num).animate( { width:'toggle' } , animate_timer);
	thisdiv.animate( { width:'100%' } , delay_timer, function() {
		//thisdiv.css('background-size', '100% 100%');
		thisdiv.find('.spp_description').fadeIn(fadein_timer);
		thisdiv.find('.spp_close_btn').show();
		thisdiv.find('.spp_learn_more_btn').fadeIn(fadein_timer);
	} );
	
}

function simple_pp_1_outHandler() {
	//jQuery('.spp_expand_btn').hide();
}

jQuery(function($) {
	
	//jQuery('.spp_layout2_title_h2').matchHeight();
	$('.spp_layout2_title').not('.spp_layout2_title_num_1, .spp_layout2_title_num_2, .spp_layout2_title_num_3, .spp_layout2_title_num_4, .spp_layout2_title_num_5').hide();
	$('.spp_project_shortcode_section_2').not('.spp_layout2_num_1, .spp_layout2_num_2, .spp_layout2_num_3, .spp_layout2_num_4, .spp_layout2_num_5').hide();
	var num_secs1 =  parseInt( $('.spp_project_shortcode_section_2').length );
	if (num_secs1 <= 5) {
		$('#spp_previous').hide();
		$('#spp_next').hide();
	}
	
	$('#spp_next').on('click', function() {
		var num_secs =  parseInt( $('.spp_project_shortcode_section_2').length );
		var height = $('#spp_height_setting').val();
		var page = parseInt( $('#spp_what_page').val() );
		var new_page = page + 1;
		var secs_to_display = [ (new_page * 5)-4, (new_page * 5)-3, (new_page * 5)-2, (new_page * 5)-1, (new_page * 5) ];
		
		$('.spp_layout2_title').hide();
		$('.spp_project_shortcode_section_2').hide();
		$('.ssp_projects_div_2').css('background-image', '');
		
		$.each(secs_to_display, function(index, value) {
			$('.spp_layout2_title_num_' + value.toString() ).fadeIn();
			$('.spp_layout2_num_' + value.toString() ).css('height', height).fadeIn();
		});
		
		$('#spp_what_page').val(new_page);
		
		if (num_secs > (new_page * 5) ) {
			$('#spp_previous').prop("disabled" , false);
			$('#spp_next').prop("disabled" , false);
		} else if (num_secs <= (new_page * 5) ) {
			$('#spp_next').prop("disabled" , true);
			$('#spp_previous').prop("disabled" , false);
		}
		
	});
	
	$('#spp_previous').on('click', function() {
		var num_secs = $('.spp_project_shortcode_section_2').length;
		var height = $('#spp_height_setting').val();
		var page = parseInt( $('#spp_what_page').val() );
		var new_page = page - 1;
		var secs_to_display = [ (new_page * 5)-4, (new_page * 5)-3, (new_page * 5)-2, (new_page * 5)-1, (new_page * 5) ];
		
		$('.spp_layout2_title').hide();
		$('.spp_project_shortcode_section_2').hide();
		$('.ssp_projects_div_2').css('background-image', '');
		
		$.each(secs_to_display, function(index, value) {
			$('.spp_layout2_title_num_' + value.toString() ).fadeIn();
			$('.spp_layout2_num_' + value.toString() ).fadeIn();
		});
		
		$('#spp_what_page').val(new_page);
		
		if ( $('.spp_layout2_num_1').css('display') != 'none' ) {
			$('#spp_previous').prop("disabled" , true);
			$('#spp_next').prop("disabled" , false);
		} else if ($('.spp_layout2_num_1').css('display') == 'none') {
			$('#spp_previous').prop("disabled" , false);
		}
	});
	
	/**********************************************************************
	 * Layout 1
	 **********************************************************************/
	
	var num = jQuery( ".spp_project_shortcode_section" ).length;
	var sec_width = '19%';
	
	switch(num) {
	    case 1:
	    	sec_width = '100%';
	        break;
	    case 2:
	    	sec_width = '49%';
	        break;
	    case 3:
	    	sec_width = '33%';
	        break;
	    case 4:
	    	sec_width = '24%';
	        break;
	    case 5:
	    	sec_width = '19%';
	        break;
	    default:
	    	sec_width = '19%';
	}
	
	
	// hover handler
	$('.spp_expand_btn').hover(simple_pp_1_inHandler, simple_pp_1_outHandler);
	$('.ssp_projects_div').mouseleave(function() {
		
		$('.spp_project_shortcode_section').animate( { width:sec_width } , 10);
		$('.spp_description').hide();
		$('.spp_close_btn').hide();
		$('.spp_learn_more_btn').hide();
		$('.spp_expand_btn').show();
		$('.spp_project_shortcode_section').fadeIn();
	});
	
	// close button click handler
	$('.spp_close_btn').click(function() {
		//var thisdiv = jQuery(this).parents('.spp_project_shortcode_section');
		
		$('.spp_project_shortcode_section').animate( { width:sec_width } , 10);
		$('.spp_description').hide();
		$('.spp_close_btn').hide();
		$('.spp_learn_more_btn').hide();
		$('.spp_expand_btn').show();
		$('.spp_project_shortcode_section').fadeIn();
	});
	
	/**********************************************************************
	 * Layout 2
	 **********************************************************************/
	$('.spp_layout2_title').hover(simple_pp_2_inHandler, simple_pp_2_outHandler);
	$('#spp_entire_layout2').mouseleave(function() {
		$('.spp_layout2_title_h2').show();
		$('.spp_project_shortcode_section_2').css('visibility', 'visible');
		$('.spp_project_shortcode_section_2').animate({opacity:1}).css('background', 'transparent');
		$('.spp_layout2_title').css('background', 'transparent');
		$( ".ssp_projects_div_2" ).css( 'background-image', '' );
	});
});

function simple_pp_2_inHandler() {
	var thisdiv     = jQuery(this).find('.spp_layout2_title_h2');
	var classList   = thisdiv.attr('class').split(/\s+/);
	var current_num = 0;
	jQuery.each(classList, function(index, item) {
		if (item.indexOf("spp_layout2_h2_num_") >= 0) {
			current_num = item.replace('spp_layout2_h2_num_', '');
	    }
	});
	var imgUrl = jQuery('#hidden_img_url_' + current_num).val();
	var color = jQuery('#hidden_back_color').val();

	jQuery('.spp_layout2_title').css('background', 'transparent');
	jQuery('.spp_project_shortcode_section_2').css('visibility', 'visible');
	
	jQuery('.spp_project_shortcode_section_2').not('.spp_layout2_num_' + current_num).css('visibility', 'hidden'); // hide other descriptions only
	jQuery('.spp_layout2_title_num_' + current_num + ', .spp_layout2_num_' + current_num).css('opacity', 0).css('background-color', color).animate({opacity:1}); // animate text background color
	jQuery( ".ssp_projects_div_2" ).css('opacity', 0).css( 'background-image', 'url(' + imgUrl + ')' ).animate({opacity:1}); // animate background image

}

function simple_pp_2_outHandler() {

}

