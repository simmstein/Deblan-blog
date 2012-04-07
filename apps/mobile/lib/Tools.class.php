<?php

require_once dirname(__FILE__).'/../../../lib/helper/PostHelper.php';

class Tools {
	public static function slugify($str) {
		$str = trim($str);

		$convertedCharacters = array(
			'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
			'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
			'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
			'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
			'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
			'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
			'Ç' => 'C', 'ç' => 'c',
			'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
			'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
			'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
			'ÿ' => 'y',
			'Ñ' => 'N', 'ñ' => 'n'
		);			

		$str = strtr($str, $convertedCharacters);
		$str = preg_replace('`[^a-zA-Z0-9-]+`', '-', $str);
		$str = preg_replace('`\s+`', '-', $str);
		$str = preg_replace('`--+`', '-', $str);
		$str = trim($str, '-');

		return $str;
	}
}
