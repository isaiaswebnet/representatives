<?
// Style Geral
$r_font_size = get_option('r_font_size');
if(!$r_font_size){$r_font_size = '11';}
		
$r_background_color =	get_option('r_background_color');
if(!$r_background_color){$r_background_color = 'ebebeb';}

$r_border_color	= get_option('r_border_color');
if(!$r_border_color){$r_border_color = '999999';}
		
$r_text_color	= get_option('r_text_color');
if(!$r_text_color){$r_text_color = '333333';}

$r_padding	= get_option('r_padding');
if(!$r_padding){$r_padding = '10';}

// Style Map
$r_max_width = get_option('r_max_width');
if(!$r_max_width){$r_max_width = '500';}
		
$r_min_width = get_option('r_min_width'); 
if(!$r_min_width){$r_min_width = '400';}
		
$r_height = get_option('r_height'); 
if(!$r_height){$r_height = '400';}
		
$r_hover	= get_option('r_hover');
if (!$r_hover) {$r_hover = '728E24';}
		
$r_active	= get_option('r_active');
if (!$r_active) {$r_active = 'B82200';}

// Page Form
$r_page	= get_option('r_page'); 
