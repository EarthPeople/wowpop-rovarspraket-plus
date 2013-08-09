<?php
/*
Plugin Name: WOWPOP Rövarspråket Plus
Plugin URI: http://earthpeople.se/
Description: Rövarspråket. För WordPress.
Version: 1.1
Author: Earth People
Author URI: http://earthpeople.se
License: GPL2

http://sv.wikipedia.org/wiki/R%C3%B6varspr%C3%A5ket

*/

// Add our own namespace so our plugin does not collide with any of the many other rövarspråket plugins
namespace ep\rorovovarorsospoprorakoketot;

// Class that handles the translation from regular texts to rövarspråket variants
class rorovovarorsospoprorakoketot {

	private $vovokokaloleror;
	private $kokononsosononanontoteror;
	
	public function __construct() {

		$this->vovokokaloleror = preg_split('/(?<!^)(?!$)/u', "aeiouyåäö");
		$this->kokononsosononanontoteror = array_diff(range("a", "z"), $this->vovokokaloleror);

		add_filter("the_content", array($this, "fofiloltoteror_tothohe_coconontotenontot"));
		add_filter("the_title", array($this, "fofiloltoteror_tothohe_totitotlole"));
		add_filter("gettext", array($this, "fofiloltoteror_gogetottotexoxtot"), 10, 3);
		
	}

	public function fofiloltoteror_gogetottotexoxtot($totexoxtot_totroranonsoslolatotedod, $totexoxtot_unontotroranonsoslolatotedod, $dodomomainon) {
		return $this->rorovovarorizoze_totexoxtot($totexoxtot_totroranonsoslolatotedod);
	}

	public function fofiloltoteror_tothohe_coconontotenontot($coconontotenontot) {
		return $this->rorovovarorizoze_totexoxtot($coconontotenontot);
	}

	public function fofiloltoteror_tothohe_totitotlole($coconontotenontot) {
		return $this->rorovovarorizoze_totexoxtot($coconontotenontot);
	}
	
	
	/**
	 * Do the actual rövarerlizing
	 */
	public function rorovovarorizoze_totexoxtot($totexoxtot) {
		
		foreach ($this->kokononsosononanontoteror as $onone_cochoharor) {

			$totexoxtot = str_replace($onone_cochoharor, "{$onone_cochoharor}o{$onone_cochoharor}", $totexoxtot);
			
			$upoppoperorcocasose_cochoharor = strtoupper($onone_cochoharor);
			$totexoxtot = str_replace($upoppoperorcocasose_cochoharor, "{$upoppoperorcocasose_cochoharor}o{$onone_cochoharor}", $totexoxtot);

		}
		
		return $totexoxtot;
	}
	

}

if (!is_admin()) {
	$GLOBALS["ep_rorovovarorsospoprorakoketot"] = new rorovovarorsospoprorakoketot();
}
