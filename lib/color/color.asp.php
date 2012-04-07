<?php
function parse_asp($str) {
	$str = trim($str);

	$str = str_replace('<%', '<?php', $str);
	$str = str_replace('%>', '?>', $str);
	
	$str = highlight_string($str, true);
	
	$str = str_replace('&lt;?php', '&lt;%', $str);
	$str = str_replace('?&gt;', '%&gt;', $str);
	
	$str = str_replace('<font color="', '<span style="color:', $str);
	$str = str_replace('</font>', '</span>', $str);

	$res = '<span class="asp_global">'.$str.'</span>';
	
	return $res;
}
?>