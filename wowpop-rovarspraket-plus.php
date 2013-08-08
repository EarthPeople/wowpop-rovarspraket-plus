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

// Add our own namespace so our plugin does not collide with any of the many other rövarspråket plugins
namespace ep\rovarspraket;

// Class that handles the translation from regular texts to rövarspråket variants
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
	public function filter_gettext($text_translated, $text_untranslated, $domain) {
		return $this->rovarize_text($text_translated);
	}

	public function filter_the_content($content) {
		return $this->rovarize_text($content);
	}

	public function filter_the_title($content) {
		return $this->rovarize_text($content);
	}
	
	
	/**
	 * Do the actual rövarerlizing
	 */
	public function rovarize_text($text) {
		
		foreach ($this->konsonanter as $one_char) {

			$text = str_replace($one_char, "{$one_char}o{$one_char}", $text);
			
			$uppercase_char = strtoupper($one_char);
			$text = str_replace($uppercase_char, "{$uppercase_char}o{$one_char}", $text);

		}
		
		return $text;
	}
	

}

$GLOBALS["ep_rovarsprak"] = new rovarsprak();
