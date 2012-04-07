<?php
function parse_php($str) {
	$str = html_entity_decode(trim($str));
	$str = highlight_string($str, true);
	
	$str = str_replace('<font color="', '<span style="color:', $str);
	$str = str_replace('</font>', '</span>', $str);

	$res = '<span class="php_global">'.$str.'</span>';
	
	return $res;
}
?>