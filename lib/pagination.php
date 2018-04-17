<?php
$_previous_text = "หน้าที่แล้ว";
$_next_text = "หน้าถัดไป";
$_first_text = "หน้าแรก";
$_last_text = "หน้าสุดท้าย";
$_rows_per_page = 10;
$_current_page = 1;
$_start_row = 0;
$_total_rows = 0;
$_total_pages = 0;
$_pagenums_size = 1;
$_previous_link = "";
$_next_link = "";
$_pagenum_links = array();
$_first_link = "";
$_last_link = "";
$_rand=0;
$_qrystr = "";
parse_str($_SERVER['QUERY_STRING'], $_qrystr);

if(@$_GET['page'] && is_numeric(@$_GET['page'])) {
	$_current_page = intval(@$_GET['page']);
	if($_current_page == 0) {
		$_current_page = 1;
	}
}

$_start_row = ($_current_page - 1) * $_rows_per_page;

function page_query($link, $sql, $rows_per_page=10) {
	global $_start_row, $_rows_per_page, $_total_rows, $_current_page, $_total_pages;

	if(is_numeric($rows_per_page) && intval($rows_per_page) >= 1) {
		$_rows_per_page = $rows_per_page;
	}
	else {
		$_rows_per_page = 10;
	}

	$_start_row = ($_current_page - 1) * $_rows_per_page;

	$sql =  trim($sql);
	$pat_select = "/^select/i";
	$sql = preg_replace($pat_select, "SELECT SQL_CALC_FOUND_ROWS ", $sql);

	$pat_end_semicolon = "/;*$/i";
	$sql = preg_replace($pat_end_semicolon, "", $sql);
	$sql .= " LIMIT $_start_row, $_rows_per_page";
	$result = mysqli_query($link,$sql) or die(mysqli_error($link));

	$found_rows = mysqli_query($link, "SELECT FOUND_ROWS()") or die(mysqli_error($link));
	$row = mysqli_fetch_row($found_rows);
	$_total_rows = $row[0];
	$_total_pages = ceil($_total_rows/$_rows_per_page);

	return $result;
}

function _page_links() {
	global $_qrystr, $_current_page, $_total_pages;
	global $_previous_link, $_next_link, $_pagenum_links, $_pagenums_size;
	global $_previous_text, $_next_text;
	global $_first_text, $_last_text, $_first_link, $_last_link;

	$_pagenum_links = array();

	$half_size = intval($_pagenums_size/2) ;
	if($half_size < 1) {
		$half_size = 1;
	}

	$pagenum_start = $_current_page - $half_size;
	$pagenum_stop = $_current_page + $half_size;

	if($_pagenums_size % 2 == 0) {
		$pagenum_start++;
	}

	if($pagenum_start < 1) {
		$pagenum_stop += 1 - $pagenum_start;
 		$pagenum_start = 1;
	}
	if($pagenum_stop > $_total_pages) {
 		$diff = $pagenum_stop - $_total_pages;
		$pagenum_start -= $diff;
		if($pagenum_start < 1) {
			$pagenum_start = 1;
		}
		$pagenum_stop = $_total_pages;
	}

	if($_qrystr) {
		if($_qrystr['page']) {
			if($_current_page > 1) {
				 $_previous_link = _page_element("a", $_qrystr['page']-1, $_previous_text);
				 $_first_link = _page_element("a", 1, $_first_text);
			}
			if($_current_page < $_total_pages) {
				$_next_link = _page_element("a", $_qrystr['page']+1,$_next_text);
				$_last_link = _page_element("a", $_total_pages, $_last_text);
			}
	 		if($pagenum_start > 1) {
				array_push($_pagenum_links,  _page_element( "a",$pagenum_start-1,"..."));
			}

			for($i = $pagenum_start; $i <= $pagenum_stop; $i++) {
				if($i == $_current_page) {
					array_push($_pagenum_links,  _page_element( "span",$i, $i));
				}
				else {
					array_push($_pagenum_links,   _page_element( "a",$i, $i));
				}
			}
	 		if($pagenum_stop < $_total_pages) {
				array_push($_pagenum_links,  _page_element( "a",$pagenum_stop+1,"..."));
			}
		}
		else {
			if($_current_page > 1) {
				 $_previous_link = _page_element( "a",$_current_page-1,$_previous_text, "&");
				 $_first_link = _page_element( "a",1,$_first_text, "&");
			}
			if($_current_page < $_total_pages) {
				$_next_link = _page_element( "a",$_current_page+1,$_next_text, "&");
				 $_last_link = _page_element( "a",$_total_pages,$_last_text, "&");
			}

	 		if($pagenum_start > 1) {
				array_push($_pagenum_links, _page_element( "a",$pagenum_start-1,"...", "&"));
			}

			for($i = $pagenum_start; $i <= $pagenum_stop; $i++) {
				if($i == $_current_page) {
					array_push($_pagenum_links,   _page_element( "span",$i,$i, "&"));
				}
				else {
					array_push($_pagenum_links,   _page_element( "a",$i,$i, "&"));
				}
			}
	 		if($pagenum_stop < $_total_pages) {
				array_push($_pagenum_links,  _page_element( "a",$pagenum_stop+1,"...", "&"));
			}
		}
	}
	else {
		if($_current_page > 1) {
			 $_previous_link =  _page_element( "a",$_current_page-1,$_previous_text, "?");
				$_first_link =  _page_element( "a",1,$_first_text, "?");
		}
		if($_current_page < $_total_pages) {
			$_next_link = _page_element( "a",$_current_page+1,$_next_text, "?");
			$_last_link =  _page_element( "a",$_total_pages,$_last_text, "?");
		}

	 	if($pagenum_start > 1) {
			array_push($_pagenum_links,  _page_element( "a",$pagenum_start-1,"...", "?"));
		}

		for($i = $pagenum_start; $i <= $pagenum_stop; $i++) {
			if($i == $_current_page) {
				array_push($_pagenum_links,  _page_element( "span",$i,$i,"?"));
			}
			else {
				array_push($_pagenum_links,  _page_element( "a",$i,$i,"?"));
			}
		}
	 	if($pagenum_stop < $_total_pages) {
			array_push($_pagenum_links,  _page_element( "a",$pagenum_stop+1,"...","?"));
		}
	}
}
function _page_element($e,$p,$t,$q="") {
	global $_qrystr, $_rand;
	if($q=="") {
		$params =  $_qrystr;
		$params['page'] = $p;
		$q = http_build_query($params);
	}
	else if($q=="&") {
		$q = $_SERVER['QUERY_STRING'] . "&page=$p";
	}
	else if($q=="?") {
		$q = "page=$p";
	}

	if($e=="a") {
		return "<a href=\"{$_SERVER['PHP_SELF']}?$q\" class=\"page-$_rand\">$t</a>";
	}
	else if($e=="span") {
		return "<span class=\"page-$_rand\">$t</span>";
	}
}

function page_echo_prevnext($show_first_last=true, $show_current_total=true) {
	_page_styles();
	_page_links();
	global $_previous_link, $_next_link, $_first_link, $_last_link, $_rand;
	$cur_total = "";
	if(_bool_type($show_current_total)) {
		$cur_total = "<span class=\"page-$_rand\">" . page_current() . "/" . page_total() . "</span>";
	}
	$prev_next =  $_previous_link . $cur_total  . $_next_link;
	if(!_bool_type($show_first_last)) {
		echo $prev_next;
	}
	else {
		echo $_first_link . $prev_next . $_last_link;
	}
}

function page_echo_pagenums($half_size=5, $show_prevnext=true, $show_first_last=false) {
	global $_previous_link, $_next_link, $_pagenum_links, $_first_link, $_last_link, $_pagenums_size;
	if(is_numeric($half_size)) {
		$_pagenums_size = $half_size;
	}
	else {
		$_pagenums_size = 5;
	}
	_page_styles();
	_page_links();

	if(_bool_type($show_prevnext)) {
		$prev_next = $_previous_link . implode("", $_pagenum_links)  . $_next_link;
		if(_bool_type($show_first_last)) {
			echo $_first_link . $prev_next . $_last_link;
		}
		else {
			echo $prev_next;
		}
	}
	else {
		if(_bool_type($show_first_last)) {
			echo  $_first_link . implode("", $_pagenum_links) . $_last_link;
		}
		else {
			echo implode("", $_pagenum_links);
		}
	}
}
function page_prevnext_text($prev_text, $next_text) {
	global $_previous_text, $_next_text;
	if(strlen(trim($prev_text)) > 0) {
		$_previous_text = $prev_text;
	}
	if(strlen(trim($next_text)) > 0) {
		$_next_text = $next_text;
	}
}
function page_first_last_text($first_text, $last_text) {
	global $_first_text, $_last_text;
	if(strlen(trim($first_text)) > 0) {
		$_first_text = $first_text;
	}
	if(strlen(trim($last_text)) > 0) {
		$_last_text = $last_text;
	}
}
function page_current() {
	global $_current_page;
	return $_current_page;
}
function page_total() {
	global $_total_pages;
	return $_total_pages;
}
function page_start_row() {
	global $_start_row;
	return $_start_row + 1;
}
function page_stop_row() {
	global $_start_row, $_total_rows, $_rows_per_page;
	if($_start_row + $_rows_per_page < $_total_rows) {
		return $_start_row + $_rows_per_page;
	}
	else {
		return $_total_rows;
	}
}
function page_total_rows() {
	global $_total_rows;
	return $_total_rows;
}

$_border_style = "none";
$_border_width = "0px";
$_border_color = "inherit";
$_border_radius = "4px";
$_bg_color = "inherit";
$_bg_hover_color = "inherit";
$_font_size = "inherit";
$_font_bold = "normal";
$_font_italic = "normal";
$_text_decoration = "underline";
$_font_family = "inherit";
$_color = "#00f";
$_hover_color = "#f00";
$_cur_border_style = "none";
$_cur_border_width = "0px";
$_cur_border_color = "inherit";
$_cur_bg_color = "inherit";
$_cur_color = "inherit";

function page_link_border($style, $width, $color) {
	global $_border_style, $_border_width, $_border_color;
	$_border_style = $style;
	if(is_numeric($width)) { $width .= "px"; }
	$_border_width = $width;
	$_border_color = $color;
}
function page_cur_border($style, $width, $color) {
	global $_cur_border_style, $_cur_border_width, $_cur_border_color;
	$_cur_border_style = $style;
	if(is_numeric($width)) { $width .= "px"; }
	$_cur_border_width = $width;
	$_cur_border_color = $color;
}
function page_border_radius($radius) {
	global $_border_radius;
	if(is_numeric($radius)) { $radius .= "px"; }
	$_border_radius = $radius;
}
function page_link_bg_color($bg_color, $bg_hover_color="inherit") {
	global $_bg_color, $_bg_hover_color;
	$_bg_color = $bg_color;
	$_bg_hover_color = $bg_hover_color;
}
function page_cur_bg_color($bg_color) {
	global $_cur_bg_color;
	$_cur_bg_color = $bg_color;
}
function page_link_color($color, $hover_color="inherit") {
	global $_color, $_hover_color;
	$_color = $color;
	$_hover_color = $hover_color;
}
function page_cur_color($color) {
	global $_cur_color;
	$_cur_color = $color;
}
function page_link_font($size, $is_bold=false, $is_italic=false, $is_underline=true, $family="inherit") {
	global $_font_size, $_font_bold, $_font_italic, $_text_decoration, $_font_family;
	if(is_numeric($size)) { $size .= "px"; }
	$_font_size = $size;
	if(_bool_type($is_bold)) { $_font_bold = "bold"; }
	if(_bool_type($is_italic)) { $_font_italic = "italic"; }
	if(!_bool_type($is_underline)) { $_text_decoration = "none"; }
	$_font_family = $family;
}
function _bool_type($var) {
	if(gettype($var)=="boolean" && $var==true) {
		return true;
	}
	else if(gettype($var)=="string") {
		if(strtolower($var)=="true") {
			return true;
		}
	}
	return false;
}
function _page_styles() {
	global $_border_style, $_border_width, $_border_color, $_border_radius;
	global $_bg_color, $_bg_hover_color;
	global $_font_size, $_font_bold, $_font_italic, $_text_decoration, $_font_family;
	global $_color, $_hover_color;
	global $_cur_border_style, $_cur_border_width, $_cur_border_color, $_cur_bg_color, $_cur_color,$_rand;

	$rand=0;
	do {
		$rand = rand();
	} while($rand == $_rand);
	$_rand = $rand;
	echo "<style>
				a.page-$_rand {
					color: $_color;
					border: $_border_style $_border_width $_border_color;
					background: $_bg_color;
					text-decoration: $_text_decoration;
				}
				a.page-$_rand:hover {
					color: $_hover_color;
					background: $_bg_hover_color;
				}
				span.page-$_rand {
					color: $_cur_color;
					border: $_cur_border_style $_cur_border_width $_cur_border_color;
					background: $_cur_bg_color;
				}
				a.page-$_rand, span.page-$_rand {
					font: $_font_bold $_font_italic normal $_font_size $_font_family;
					font-size: $_font_size;
					border-radius: $_border_radius;
					padding: 3px;
					margin: 3px 3px;
				}
			</style>";
}
 ?>
