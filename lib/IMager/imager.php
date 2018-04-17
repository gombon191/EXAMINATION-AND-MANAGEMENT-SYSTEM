<?php /* Imager v1.0; Banchar Paseelatesang (banchar_pa@yahoo.com); All rights reserved */
function image_load($file_name) {
	$type = image_type($file_name);
	if($type=="gif") {
		return imagecreatefromgif($file_name);
	}
	else if($type=="png") {
		return imagecreatefrompng($file_name);
	}
	else if($type=="jpg" || $type=="jpeg" || $type=="pjpeg") {
		return imagecreatefromjpeg($file_name);
	}	
}
function image_upload($input_name, $index="") {
	$f = $_FILES[$input_name];
	if(is_uploaded_file($f['tmp_name']) || is_uploaded_file($f['tmp_name'][$index])) {
		$t = (!is_numeric($index))?$f['type']:$f['type'][$index];
		if($t=="image/gif") {
			return (!is_numeric($index))?imagecreatefromgif($f['tmp_name']):imagecreatefromgif($f['tmp_name'][$index]);
		}
		else if($t=="image/png") {
			return (!is_numeric($index))?imagecreatefrompng($f['tmp_name']):imagecreatefrompng($f['tmp_name'][$index]);
		}
		else if($t=="image/jpg" || $t=="image/jpeg" || $t=="image/pjpeg") {
			return (!is_numeric($index))?imagecreatefromjpeg($f['tmp_name']):imagecreatefromjpeg($f['tmp_name'][$index]);
		}			
	}	
}
function image_type($file_name) {
	$info = pathinfo($file_name);
	return strtolower($info['extension']);
}
function image_mime_type($file_name) {
	$type = image_type($file_name);
	if($type=="jpg" || $type=="jpeg" || $type=="pjpeg") {
		$type = "jpeg";
	}
	return "image/$type";
}
function image_save($img, $file_name) {
	$type = image_type($file_name);
	if($type=="gif") {
		imagegif($img, $file_name);
	}
	else if($type=="jpg" || $type=="jpeg" || $type=="pjpeg") {
		imagejpeg($img, $file_name);
	}
	else if($type=="png") {
		imagepng($img, $file_name);
	}	
}
function image_to_jpg($img) {
	$w = imagesx($img);
	$h = imagesy($img);
	$new_img = imagecreatetruecolor($w, $h);
	$bg = imagecolorallocate($new_img, 255, 255, 255);
	imagefill($new_img, 0, 0, $bg);
	imagecopy($new_img, $img, 0, 0, 0, 0, $w, $h);
	return $new_img;
}
function image_load_db($data) {
	return imagecreatefromstring($data);
}
function image_store_db($img, $img_type) {
	$t = strtolower($img_type);
	ob_start();
	if($t=="gif"||$t=="image/gif") {
		imagegif($img);
	}
	else if($t=="png"||$t=="image/png") {
		imagepng($img);
	}
	else if($t=="jpg"||$t=="image/jpg"||$t=="jpeg"||$t=="image/jpeg"||$t=="pjpeg"||$t=="image/pjpeg") {
		imagejpeg($img,null,100);
	}
	$content = ob_get_contents();
	ob_end_clean();
	return addslashes($content);
}
function image_width($img_or_file_name) {
	if(is_string($img_or_file_name)) {
		$s = getimagesize($img_or_file_name);
		return $s['width'];
	}
	else if(is_resource($img_or_file_name)) { 
		return imagesx($img_or_file_name);
	}
}
function image_height($img_or_file_name) {
	if(is_string($img_or_file_name)) {
		$s = getimagesize($img_or_file_name);
		return $s['height'];
	}
	else if(is_resource($img_or_file_name)) {
		return imagesy($img_or_file_name);
	}
}
function image_size($file_name) {
	return filesize($file_name);
}
function image_resize_pct($img, $percent) {
	$p = $percent/100;
	$src_w = image_width($img);
	$src_h = image_height($img);
	$new_w = $src_w * $p;
	$new_h = $src_h * $p;
	$img_new = imagecreatetruecolor($new_w, $new_h);
	imagecopyresampled($img_new, $img, 0,0,0,0,$new_w, $new_h, $src_w, $src_h);	
	return $img_new;
}
function image_resize_to($img, $width, $height) {
	$src_w = image_width($img);
	$src_h = image_height($img);
	$img_new = imagecreatetruecolor($width, $height);
	imagecopyresampled($img_new, $img, 0,0,0,0,$width,$height, $src_w, $src_h);	
	return $img_new;	
}
function image_resize_to_width($img, $width) {
	$r = $width/imagesx($img);
	$height = imagesy($img) * $r;
	return image_resize_to($img, $width, $height);
}
function image_resize_to_height($img, $height) {
	$r = $height/imagesy($img);
	$width = imagesx($img) * $r;
	return image_resize_to($img, $width, $height);
}
function image_resize_max($img, $max_width, $max_height) {
	$src_width = imagesx($img);
	$src_height = imagesy($img);
	$width = $src_width;
	$height = $src_height;
	
	if($width > $height) {
		if($width > $max_width) {
			$r = $width / $max_width;
			$height = intval($height / $r);
			$width = $max_width;
			
			if($height > $max_height) {
				$r = $height / $max_height;
				$width = intval($width / $r);
				$height = $max_height;
			}
		}
		else {
			if($height > $max_height) {
				$r = $height / $max_height;
				$width = intval($width / $r);
				$height = $max_height;
			}
		}
	}
	else {
		if($height > $max_height) {
			$r = $height / $max_height;
			$width = intval($width / $r);
			$height = $max_height;
			if($width > $max_width) {
				$r = $width / $max_width;
				$height = intval($heigh / $r);
				$width = $max_width;	
			}
		}
		else {
			if($width > $max_width) {
				$r = $width / $max_width;
				$height = intval($height / $r);
				$width = $max_width;		
			}
		}
	}

 	$img_new = imagecreatetruecolor($width, $height);
	imagecopyresampled($img_new, $img, 0,0,0,0, $width, $height, $src_width, $src_height);	
	return $img_new; 	
}
function image_rgb2hex($red, $green, $blue) {
	return "#".dechex($red).dechex($green).dechex($blue);
}
function __image_get_color($color) {
	$r = 0;
	$g = 0;
	$b = 0;
	if(substr($color,0,1)=="#") {
		if(strlen($color)==4) {
			$h1 =  substr($color,1,1);
			$r = hexdec($h1.$h1);
			$h2 =  substr($color,2,1);
			$g = hexdec($h2.$h2);
			$h3 =  substr($color,3,1);
			$b = hexdec($h3.$h3);			
			return array($r,$g,$b);
		}
		else if(strlen($color)==7) {
			$h1 =  substr($color,1,2);
			$r = hexdec($h1);
			$h2 =  substr($color,3,2);
			$g = hexdec($h2);
			$h3 =  substr($color,5,2);
			$b = hexdec($h3);			
			return array($r,$g,$b);			
		}
		else {
			return array($r,$g,$b);
		}
	}
	return name2rgb($color);
}
function image_crop($img, $pos, $width, $height,$pad_x, $pad_y) {
	$xy = __image_pos_xy($img, $width, $height, $pos, $pad_x, $pad_y);
	if(!$xy) {
		return $img_src;
	}
	$x = $xy[0];
	$y = $xy[1];	
	$img_new = imagecreatetruecolor($width, $height);
	imagecopy($img_new, $img, 0, 0, $x, $y, $width, $height);
	return $img_new;
}
function image_crop_xy($img, $x, $y, $width, $height) {
	$img_new = imagecreatetruecolor($width, $height);
	imagecopy($img_new, $img, 0, 0, $x, $y, $width, $height);
	return $img_new;	
}
function __image_pos_xy($img_src, $dest_w, $dest_h, $pos, $px, $py) {
	$src_w = imagesx($img_src);
	$src_h = imagesy($img_src);
	if($pos==TOP_LEFT) {
		return array($px, $py);
	}
	else if($pos==TOP_CENTER) {
		$x = $src_w/2 - $dest_w/2;
		return array($x, $py);
	}
	else if($pos==TOP_RIGHT) {
		$x = $src_w - $dest_w - $px;
		return array($x, $py);
	}
	else if($pos==CENTER_LEFT) {
		$y = $src_h/2 - $dest_h/2;
		return array($px, $y);		
	}
	else if($pos==CENTER_CENTER) {
		$x = $src_w/2 - $dest_w/2;
		$y = $src_h/2 - $dest_h/2;
		return array($x, $y);
	}
	else if($pos==CENTER_RIGHT) {
		$x = $src_w - $dest_w - $px;
		$y = $src_h/2 - $dest_h/2;
		return array($x, $y);			
	}
	else if($pos==BOTTOM_LEFT) {
		$y = $src_h - $dest_h - $py;
		return array($px, $y);			
	}
	else if($pos==BOTTOM_CENTER) {
		$x = $src_w/2 - $dest_w/2;
		$y = $src_h - $dest_h - $py;
		return array($x, $y);	
	}
	else if($pos==BOTTOM_RIGHT) {
		$x = $src_w - $dest_w - $px;
		$y = $src_h - $dest_h - $py;
		return array($x, $y);			
	}
	else {
		return false;
	}	
}
function image_merge($img_src, $img_merge, $pos, $pad_x, $pad_y, $opacity) {
	$mrg_w = imagesx($img_merge);
	$mrg_h = imagesy($img_merge);
	$xy = __image_pos_xy($img_src, $mrg_w, $mrg_h, $pos, $pad_x, $pad_y);
	if(!$xy) {
		return $img_src;
	}
	$x = $xy[0];
	$y = $xy[1];
	imagecopymerge($img_src,$img_merge,$x,$y,0,0,$mrg_w,$mrg_h,$opacity);
	return $img_src;	
}
function image_transparent($img, $bg_color) {
	$c = __image_get_color($bg_color);
	$cc = imagecolorallocate($img,$c[0],$c[1],$c[2]);
	imagecolortransparent($img, $cc);
	return $img;
}
function image_text_xy($img, $text, $x, $y, $font_size, $color, $font_file="Tahoma.ttf") {
	$c = __image_get_color($color);
	$ca = imagecolorallocate($img, $c[0],$c[1],$c[2]);
	$f = dirname(__FILE__)."/$font_file";
	imagettftext($img, $font_size, 0, $x, $y, $ca, $f, $text);
	return $img;
}
function image_text($img, $text, $pos, $pad_x, $pad_y, $font_size, $color, $font_file="Tahoma.ttf") {
	$f = dirname(__FILE__)."/$font_file";
	$bbox = imagettfbbox($font_size, 0,  $f, $text);
	$w = abs($bbox[4] - $bbox[0]);
	$h = abs($bbox[5] - $bbox[1]);
	if($pos==TOP_LEFT||$pos==TOP_CENTER||$pos==TOP_RIGHT){$pad_y+=$h;}
	else if($pos==CENTER_LEFT||$pos==CENTER_CENTER||$pos==CENTER_RIGHT){$h-=$h;}
	else if($pos==BOTTOM_LEFT||$pos==BOTTOM_CENTER||$pos==BOTTOM_RIGHT){$pad_y-=$h;}	
	$xy = __image_pos_xy($img, $w, $h, $pos, $pad_x, $pad_y);
	return image_text_xy($img, $text, $xy[0], $xy[1], $font_size, $color, $font_file);
}
function __image_flip($img, $mode){
	if(function_exists("imageflip")) {
		return imageflip($img, $mode);
	}
    $width = imagesx($img);
    $height = imagesy($img);
    $src_x = 0;
    $src_y =  0;
    $src_width =  $width;
    $src_height =  $height;
    switch($mode) {
        case FLIP_HORIZONTAL: 
            $src_x = $width -1;
            $src_width = -$width;
        	break;
        case FLIP_VERTICAL:
            $src_y = $height -1;
            $src_height = -$height;
        	break;
        case FLIP_BOTH:
            $src_x = $width -1;
            $src_y = $height -1;
            $src_width = -$width;
            $src_height = -$height;
        	break;
        default: return $img;
    }
    $img_new = imagecreatetruecolor($width, $height);
    return (imagecopyresampled($img_new, $img, 0, 0, $src_x, $src_y , $width, $height, $src_width, $src_height))?$img_new:$img;
}
function image_flip_horz($img) {  
	return __image_flip($img, FLIP_HORIZONTAL);
}
function image_flip_vert($img) {	
	return __image_flip($img, FLIP_VERTICAL);	
}
function image_flip_both($img) { 	
	return __image_flip($img, FLIP_BOTH);
}
function image_rotate($img, $degree) {
	return imagerotate($img, $degree, 0);
}
function image_destroy() {
	$c = func_num_args();
	for($i=0;$i<$c;$i++){
		@imagedestroy(func_get_arg($i));
	}
}
function image_echo($img) {
	image_echo_jpg($img);
}
function image_echo_jpg($img) {
	header("content-type: image/jpeg");
	imagejpeg($img,null,100);
}
function image_echo_png($img) {
	header("content-type: image/png");
	imagepng($img);	
}
function image_echo_gif($img) {
	header("content-type: image/gif");
	imagegif($img);	
}
function name2rgb($color_name){$colors=array('aliceblue'=>'f0f8ff','antiquewhite'=>'faebd7','aqua'=>'00ffff','aquamarine'=>'7fffd4','azure'=>'f0ffff','beige'=>'f5f5dc','bisque'=>'ffe4c4','black'=>'000000','blanchedalmond '=>'ffebcd','blue'=>'0000ff','blueviolet'=>'8a2be2','brown'=>'a52a2a','burlywood'=>'deb887','cadetblue'=>'5f9ea0','chartreuse'=>'7fff00','chocolate'=>'d2691e','coral'=>'ff7f50','cornflowerblue'=>'6495ed','cornsilk'=>'fff8dc','crimson'=>'dc143c','cyan'=>'00ffff','darkblue'=>'00008b','darkcyan'=>'008b8b','darkgoldenrod'=>'b8860b','darkgray'=>'a9a9a9','darkgreen'=>'006400','darkgrey'=>'a9a9a9','darkkhaki'=>'bdb76b','darkmagenta'=>'8b008b','darkolivegreen'=>'556b2f','darkorange'=>'ff8c00','darkorchid'=>'9932cc','darkred'=>'8b0000','darksalmon'=>'e9967a','darkseagreen'=>'8fbc8f','darkslateblue'=>'483d8b','darkslategray'=>'2f4f4f','darkslategrey'=>'2f4f4f','darkturquoise'=>'00ced1','darkviolet'=>'9400d3','deeppink'=>'ff1493','deepskyblue'=>'00bfff','dimgray'=>'696969','dimgrey'=>'696969','dodgerblue'=>'1e90ff','firebrick'=>'b22222','floralwhite'=>'fffaf0','forestgreen'=>'228b22','fuchsia'=>'ff00ff','gainsboro'=>'dcdcdc','ghostwhite'=>'f8f8ff','gold'=>'ffd700','goldenrod'=>'daa520','gray'=>'808080','green'=>'008000','greenyellow'=>'adff2f','grey'=>'808080','honeydew'=>'f0fff0','hotpink'=>'ff69b4','indianred'=>'cd5c5c','indigo'=>'4b0082','ivory'=>'fffff0','khaki'=>'f0e68c','lavender'=>'e6e6fa','lavenderblush'=>'fff0f5','lawngreen'=>'7cfc00','lemonchiffon'=>'fffacd','lightblue'=>'add8e6','lightcoral'=>'f08080','lightcyan'=>'e0ffff','lightgoldenrodyellow'=>'fafad2','lightgray'=>'d3d3d3','lightgreen'=>'90ee90','lightgrey'=>'d3d3d3','lightpink'=>'ffb6c1','lightsalmon'=>'ffa07a','lightseagreen'=>'20b2aa','lightskyblue'=>'87cefa','lightslategray'=>'778899','lightslategrey'=>'778899','lightsteelblue'=>'b0c4de','lightyellow'=>'ffffe0','lime'=>'00ff00','limegreen'=>'32cd32','linen'=>'faf0e6','magenta'=>'ff00ff','maroon'=>'800000','mediumaquamarine'=>'66cdaa','mediumblue'=>'0000cd','mediumorchid'=>'ba55d3','mediumpurple'=>'9370d0','mediumseagreen'=>'3cb371','mediumslateblue'=>'7b68ee','mediumspringgreen'=>'00fa9a','mediumturquoise'=>'48d1cc','mediumvioletred'=>'c71585','midnightblue'=>'191970','mintcream'=>'f5fffa','mistyrose'=>'ffe4e1','moccasin'=>'ffe4b5','navajowhite'=>'ffdead','navy'=>'000080','oldlace'=>'fdf5e6','olive'=>'808000','olivedrab'=>'6b8e23','orange'=>'ffa500','orangered'=>'ff4500','orchid'=>'da70d6','palegoldenrod'=>'eee8aa','palegreen'=>'98fb98','paleturquoise'=>'afeeee','palevioletred'=>'db7093','papayawhip'=>'ffefd5','peachpuff'=>'ffdab9','peru'=>'cd853f','pink'=>'ffc0cb','plum'=>'dda0dd','powderblue'=>'b0e0e6','purple'=>'800080','red'=>'ff0000','rosybrown'=>'bc8f8f','royalblue'=>'4169e1','saddlebrown'=>'8b4513','salmon'=>'fa8072','sandybrown'=>'f4a460','seagreen'=>'2e8b57','seashell'=>'fff5ee','sienna'=>'a0522d','silver'=>'c0c0c0','skyblue'=>'87ceeb','slateblue'=>'6a5acd','slategray'=>'708090','slategrey'=>'708090','snow'=>'fffafa','springgreen'=>'00ff7f','steelblue'=>'4682b4','tan'=>'d2b48c','teal'=>'008080','thistle'=>'d8bfd8','tomato'=>'ff6347','turquoise'=>'40e0d0','violet'=>'ee82ee','wheat'=>'f5deb3','white'=>'ffffff','whitesmoke'=>'f5f5f5','yellow'=>'ffff00','yellowgreen'=>'9acd32');$color_name=strtolower($color_name);if(isset($colors[$color_name])){$r=substr($colors[$color_name],0,2);$g=substr($colors[$color_name],2,2);$b=substr($colors[$color_name],4,2);return array(hexdec($r),hexdec($g),hexdec($b));}else{return array(0,0,0);}}
?>