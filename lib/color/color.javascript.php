<?php
function parse_js_commentaires($str) {
	$str = preg_replace('`</?span(.*)>`iU', '', $str);
	$str = '<span class="js_commentaires">/*'.$str.'*/</span>';
	return $str; 
}

function parse_js_commentaires2($str) {
	$str = preg_replace('`</?span(.*)>`iU', '', $str);
	$str = '<span class="js_commentaires">//'.$str.'</span>';
	return $str; 
}

function parse_js_quotes($str, $type) {
	$str = preg_replace('`</?span(.*)>`iU', '', $str);
	$str = '<span class="js_quotes">'.$type.$str.$type.'</span>';
	return $str; 
}

function parse_javascript($str) {
	$str = htmlentities($str);
	$str = trim($str);

	$functions = explode("\n", file_get_contents(ROOT.'/system/class/functions/color/dico.js.inc.txt'));
	foreach($functions as $vl) { $regex[] = '`'.$vl.'[^a-zA-Z0-9]`iU'; } // [^a-zA-Z0-9]
	$par = '<span class="js_functions">$0</span>';
	$str = preg_replace($regex, $par, $str);	
	unset($regex);
	
	$autres = explode(':', 'function:if:else:for:while:do:var');
	foreach($autres as $vl) { $regex[] = '`'.$vl.'[^a-zA-Z0-9]`iU'; }    // [^a-zA-Z0-9]
	$par = '<span class="js_controles">$0</span>';
	$str = preg_replace($regex, $par, $str);	
	unset($regex);
	
	$str = str_replace(
			array('(', ')', '<</span>', "\'", '\&quot;'), 
			array('<span class="js_controles">(</span>', '<span class="js_controles">)</span>', '</span><', '&__&', '&___&'), $str);
	
	$regex = '`&quot;(.*)&quot;`isU';
	$par   = 'return parse_js_quotes($matches[1], "&quot;");';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);


	$regex = '`\'(.*)\'`isU';
	$par   = 'return parse_js_quotes($matches[1], "\'");';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$str = str_replace(
			array('&__&', '&___&'), 
			array("\'", '\&quot;'), $str);	
	
	$regex = '`/\*(.*)\*/`isU';
	$par   = 'return parse_js_commentaires($matches[1]);';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$regex = "`//([^\n]+)`is";
	$par   = 'return parse_js_commentaires2($matches[1]);';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$str = str_replace("\r", '<br />', $str);
	$str = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $str);
	$str = str_replace(' ', '&nbsp;', $str);
	$str = str_replace('<span&nbsp;', '<span ', $str);
	
	$res = '<span class="js_global"><code>'.$str.'</code></span>';
	return $res;
}
?>