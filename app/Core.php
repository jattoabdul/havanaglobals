<?php

namespace App;


abstract class Core
{
    static function slugger($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) { return 'n-a'; }
		return $text;
	}

	static function orderStatusToString($status, $html=false)
	{
		if($status == 0) { return ($html)?htmlentities("<p class='text-warning'>Pending</p>"):"Pending"; }
		if($status == 1) { return ($html)?htmlentities("<p class='text-success'>Success</p>"):"Success"; }
		if($status == 2) { return ($html)?htmlentities("<p class='text-danger'>Failed</p>"):"Failed"; }
		if($status == 3) { return ($html)?htmlentities("<p class='text-info'>Shipped</p>"):"Shipped"; }
		if($status == 4) { return ($html)?htmlentities("<p class='text-success'>Complete</p>"):"Complete"; }

		return null;
	}
}
