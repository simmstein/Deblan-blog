<?php
function parse_console($str) {
	$str = htmlentities($str);
	$str = str_replace("\r", '<br />', $str);
	$str = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $str);
	$str = str_replace(' ', '&nbsp;', $str);
	$str = str_replace('<span&nbsp;', '<span ', $str);
	
	$res = '<span class="console_global"><code>'.$str.'</code></span>';
	return $res;
}
?>
