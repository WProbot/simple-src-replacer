<?php
/**
 * Plugin Name: Simple IMG SRC Replacer
 * Description: Replaces img tag src attribute url when contains site_url() with $srcTo?url=site_url()
 * Author: Riccardo Strobbia
 * License: GPL-3.0
 */


namespace Robanostra\SimpleImgSrcReplacer;

if(!defined('ABSPATH')) return;

define('SIMPLE_REPLACER_TARGET_URL', 'http://anothersite.com/remote/');

require_once __DIR__ . '/vendor/autoload.php';

function initSimpleImgReplacer() {
	$main = new Main( SIMPLE_REPLACER_TARGET_URL );
	$main->addHooks();
}
initSimpleImgReplacer();