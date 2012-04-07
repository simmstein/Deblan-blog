<?php
function parse_css_commentaires_accolades($str) {
	$incolades = array('{', '}');
	$par       = array('&ino&', '&inf&');
	$str = str_replace($incolades, $par, $str);
		
	return '/*'.$str.'*/';
}

function parse_css_commentaires($str) {
	$str = preg_replace('`</?span(.*)>`iU', '', $str);
	$str = '<span class="css_commentaires">/*'.$str.'*/</span>';
	
	$accolades  = array('&ino&', '&inf&');
	$par = array('{', '}');
	$str = str_replace($accolades, $par, $str);

	return $str; 
}

function parse_css_quotes($str, $type) {
	$str = preg_replace('`</?span[a-z= "]?>`iU', '', $str);
	$str = '<span class="css_quotes">'.$type.$str.$type.'</span>';
	return $str; 
}

function parse_css_valeurs($str) {
	$regex = '`:(.*)(;|\})`isU';
	$par   = ':<span class="css_valeurs">$1</span>$2';
	$str = preg_replace($regex, $par, $str);
	
	$ponctuation = array(':', ';');
	$par         = array('<span class="css_deuxpts">:</span>', '<span class="css_ptvirgule">;</span>');
	$str = str_replace($ponctuation, $par, $str);
	
	$regex = '`&([a-z]{2,5})_`isU';
	$par   = '&$1;';
	$str = preg_replace($regex, $par, $str);
	
	$regex = '`&quot;(.*)&quot;`isU';
	$par   = 'return parse_css_quotes($matches[1], "&quot;");';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$regex = '`\'(.*)\'`isU';
	$par   = 'return parse_css_quotes($matches[1], "\'");';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	return $str;
}

function parse_css_accolades($str) {
	$res = '<span class="css_accolades">{</span><span class="css_parametres">';
	$res.= parse_css_valeurs($str);
	$res.= '</span><span class="css_accolades">}</span>';
	return $res;
}

function parse_css($str) {
	$str = htmlentities($str);
	$regex = '`&([a-z]{2,5});`isU';
	$par   = '&$1_';
	$str = preg_replace($regex, $par, $str);
	
	$regex = '`/\*(.*)\*/`isU';
	$par   = 'return parse_css_commentaires_accolades($matches[1]);';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$regex = '`\{(.*)\}`isU';
	$par   = 'return parse_css_accolades($matches[1]);';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$regex = '`/\*(.*)\*/`isU';
	$par   = 'return parse_css_commentaires($matches[1]);';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$regex = '`&([a-z]{2,5})_`isU';
	$par   = '&$1;';
	$str = preg_replace($regex, $par, $str);
	
	$str = str_replace("\r", '<br />', $str);
	$str = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $str);
	$str = str_replace(' ', '&nbsp;', $str);
	$str = str_replace('<span&nbsp;', '<span ', $str);	
	
	$res = '<span class="css_global"><code>'.$str.'</code></span>';

	return $res;
}
?>