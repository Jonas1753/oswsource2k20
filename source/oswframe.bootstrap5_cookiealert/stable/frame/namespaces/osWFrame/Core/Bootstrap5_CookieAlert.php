<?php

/**
 *
 * @author Juergen Schwind
 * @copyright Copyright (c), Juergen Schwind
 * @package osWFrame
 * @link https://oswframe.com
 * @license MIT License
 */

namespace osWFrame\Core;

class Bootstrap5_CookieAlert {

	use BaseStaticTrait;

	/**
	 * Major-Version der Klasse.
	 */
	private const CLASS_MAJOR_VERSION=1;

	/**
	 * Minor-Version der Klasse.
	 */
	private const CLASS_MINOR_VERSION=0;

	/**
	 * Release-Version der Klasse.
	 */
	private const CLASS_RELEASE_VERSION=0;

	/**
	 * Extra-Version der Klasse.
	 * Zum Beispiel alpha, beta, rc1, rc2 ...
	 */
	private const CLASS_EXTRA_VERSION='';

	/**
	 * Bootstrap5 Version.
	 *
	 * @var string
	 */
	protected const CURRENT_RESOURCE_VERSION='1.0.0';

	/**
	 * Bootstrap5_CookieAlert constructor.
	 */
	private function __construct() {
	}

	/**
	 * @param string $text
	 * @param string $button
	 * @param string $link
	 * @param string $link_button
	 * @return string
	 */
	public static function getDiv(string $text='', string $button='', string $link='', string $link_button=''):string {
		if ($text=='') {
			$text='Diese Webseite verwendet ausschließlich notwendige Cookies.';
		}
		if ($button=='') {
			$button='OK!';
		}
		if ($link_button=='') {
			$link_button='Mehr ...';
		}
		$output='';
		$output.='<div class="alert alert-dismissible text-center cookiealert" role="alert">';
		$output.='<div class="cookiealert-container">';
		$output.=HTML::outputString($text);
		$output.='<button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">'.HTML::outputString($button).'</button>';
		if ($link!='') {
			$output.='&nbsp;<a href="'.$link.'" class="btn btn-primary btn-sm" role="button">'.HTML::outputString($link_button).'</a>';
		}
		$output.='</div>';
		$output.='</div>';

		return $output;
	}

}

?>