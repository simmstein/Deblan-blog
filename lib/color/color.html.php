<?php
function parse_html_commentaires($str) {
	$str = preg_replace('`</?span(.*)>`iU', '', $str);
	$str = '<span class="html_commentaires">'.$str.'</span>';
	return $str; 
}

function parse_html_quotes($str, $type) {
	$str = preg_replace('`</?span(.*)>`iU', '', $str);
	$str = '<span class="html_balise_quotes">'.$type.$str.$type.'</span>';
	return $str; 
}

function parse_html_balise($str) {
	$res = '<span class="html_balises">&lt;<span class="html_balise_parametres">';
	
	$regex = '`&quot;(.*)&quot;`isU';
	$par   = 'return parse_html_quotes($matches[1], "&quot;");';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);


	$regex = '`\'(.*)\'`isU';
	$par   = 'return parse_html_quotes($matches[1], "\'");';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);
	
	$res.= $str.'</span>&gt;</span>';
	return $res;
}

function parse_html($str) {
	$str = htmlentities($str);
	$regex = '`&lt;(.*)&gt;`isU';
	$par   = 'return parse_html_balise($matches[1]);';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);

	$regex = '`&lt;<span class="[a-zA-Z0-9_-]+">!--(.*)--</span>&gt;`isU';
	$par   = 'return parse_html_commentaires($matches[0]);';
	$str = preg_replace_callback($regex, create_function('$matches', $par), $str);

	// $str = str_replace("\r", '<br />', $str);
	$str = str_replace("\r", '<br />', $str);
	$str = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $str);
	$str = str_replace(' ', '&nbsp;', $str);
	$str = str_replace('<span&nbsp;', '<span ', $str);

	$res = '<span class="html_global"><code>'.$str.'</code></span>';

	return $res;
}
?>