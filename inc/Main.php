<?php

namespace Robanostra\SimpleImgSrcReplacer;

/**
 * Class Main
 *
 * @package Robanostra\SimpleImgSrcReplacer
 * 
 * Set up hooks callbacks to capture the output buffer and replace images src attributes URLs when site_url() is there
 */
class Main{

	/**
	 * The target src URL
	 * @var string|string
	 */
	private $srcTo;
	/**
	 * The current site URL
	 * @var string
	 */
	private $currentSiteURL;

	/**
	 * Main constructor.
	 *
	 * @param string $srcTo
	 */
	public function __construct(string $srcTo) {
		$this->srcTo = $srcTo;
		$this->currentSiteURL = get_site_url();
	}

	/**
	 * Adds hooks to capture the buffer very early
	 * after setup theme is normally the earliest used to make sure eveything needed is loaded
	 * @return void
	 */
	public function addHooks() {
		add_action('after_setup_theme', array($this, 'bufferStart') );
		add_action('wp_shutdown', array($this, 'bufferEnd'));
	}

	/**
	 * Defines a callback to ob_start() and runs it
	 * @return void
	 */
	public function bufferStart() {
		ob_start(array($this, 'obCallback'));
	}

	/**
	 * Echoes the (modified) buffer
	 * @return void
	 */
	public function bufferEnd() {
		ob_end_flush();
	}

	/**
	 * @param $buffer
	 *
	 * @return string|string[]|null
	 */
	public function obCallback($buffer) {
		// if it is not HTML then just return it
		if(!$this->isHtmlString($buffer)){
			return $buffer;
		}
		// apply the search and replace for images
		return  $this->replaceImgSrcAttr($buffer);
	}

	/**
	 * @param $string
	 *
	 * @return bool
	 */
	private function isHtmlString($string) {
		// if there aren't tags stripped then it is not an html string
		return strip_tags($string) !== $string;
	}

	/**
	 * @param $input
	 *
	 * @return string|string[]|null
	 */
	private function replaceImgSrcAttr($input) {
		// define the regex to search for <img src="" /> and make it greedy
		$regex = '/<img\s+src="([^"]+)"[^>]+>/siU';
		// check if there are any
		if(preg_match_all($regex, $input, $matches, PREG_SET_ORDER)) {
			// if there are apply the replace callback
			return preg_replace_callback($regex, array($this, 'replaceImgSrcAttrCallback'), $input);
		}
		// if none found just return the HTML
		return $input;
	}

	/**
	 * @param $match
	 *
	 * @return mixed|string|string[]
	 */
	public function replaceImgSrcAttrCallback($match) {
		// if no URL found or it is relative or it doesn't belong to the site, then leave it
		if(!isset($match[1]) || !strstr($match[1], $this->currentSiteURL)) return $match[0];
		// if it does then replace with the new URL to the CDN
		return str_replace($match[1], $this->srcTo . '?url=' . $match[1], $match[0]);
	}
}