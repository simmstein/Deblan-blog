<?php
function parse_as($str) {
	$str = '<?php'.trim($str).'?>';
	$str = highlight_string($str, true);
	
	$str = str_replace('<font color="', '<span style="color:', $str);
	$str = str_replace('</font>', '</span>', $str);
	$str = str_replace('&lt;?php', '', $str);
	$str = str_replace('?&gt;', '', $str);
	
	$str = str_replace('?&gt;', '', $str);
	$str = str_replace('?&gt;', '', $str);
	
	$res = '<span class="as_global">'.$str.'</span>';
	
	return $res;
}
?>