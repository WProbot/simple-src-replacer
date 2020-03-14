# Simple Img Src Replacer for Wordpress

A very basic plugin to search and replace img tag src attribute
with absolute URL to current Wordpress install, with a new URL, CDN compliant in the form: "http://anothersite.com/remote/?url=http://example.com/image.jpg"

## Features

- Defined as composer package
- OOP
- Runs as earlier as possible on "after_setup_theme"
- Process the full HTML output - not only the content
- Autoloads included class

## Usage

Open plugin.php file and customise: 
    
    define('SIMPLE_REPLACER_TARGET_URL', 'http://anothersite.com/remote/');

to the desired target URL.

### Prerequisites

1. Composer, Wordpress, php

### Setting up and developing

1. `cd` to your plugins directory in your WordPress install
1. Run `git clone https://github.com/rogopag/simple-src-replacer.git`
1. `cd simple-src-replacer`
1. For simplicity being this a demonstration I've commited - I would never do that in real life - vendor/ dir with autoloaders so that the plugin can be directly used.

Note: you may want to use a plugin such as [WP Rocket](https://wp-rocket.me) with apache mod_deflate or [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/) to enable GZIP compression and enhance performance.
