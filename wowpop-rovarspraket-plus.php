<?php
/*
Plugin Name: WOWPOP Rövarspråket Plus
Plugin URI: http://earthpeople.se/
Description: Rövarspråket. För WordPress.
Version: 1.0
Author: Earth People
Author URI: http://earthpeople.se
License: GPL2

http://sv.wikipedia.org/wiki/R%C3%B6varspr%C3%A5ket

*/

namespace ep\rovarspraket;

class rovarsprak {

	private $vokaler;
	private $konsonanter;
	
	public function __construct() {

		$this->vokaler = preg_split('/(?<!^)(?!$)/u', "aeiouyåäö");
		$this->konsonanter = array_diff(range("a", "z"), $this->vokaler);
		
		add_filter("the_content", array($this, "filter_the_content"));
		add_filter("the_title", array($this, "filter_the_title"));
		add_filter("gettext", array($this, "filter_gettext"), 10, 3);

	}

	// return apply_filters( 'gettext', $translations->translate( $text ), $text, $domain );
	function filter_gettext($text_translated, $text_untranslated, $domain) {
		return $this->rovarize_text($text_translated);
	}

	function filter_the_content($content) {
		return $this->rovarize_text($content);
	}

	function filter_the_title($content) {
		return $this->rovarize_text($content);
	}
	
	
	/**
	 * Do the actual rövarerlizing
	 */
	function rovarize_text($text) {
		
		foreach ($this->konsonanter as $one_char) {
			$text = str_replace($one_char, "{$one_char}o{$one_char}", $text);
		}
		
		return $text;
	}
	

}

$GLOBALS["ep_rovarsprak"] = new rovarsprak();
