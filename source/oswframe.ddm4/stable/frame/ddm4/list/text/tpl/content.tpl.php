<?php

/**
 * This file is part of the osWFrame package
 *
 * @author Juergen Schwind
 * @copyright Copyright (c) JBS New Media GmbH - Juergen Schwind (https://jbs-newmedia.com)
 * @package osWFrame
 * @link https://oswframe.com
 * @license MIT License
 */

$list_display_length=intval($this->getListElementOption($element, 'list_display_length'));

if ($list_display_length!=0) {
	$view_data[$this->getListElementValue($element, 'name')]=\osWFrame\Core\StringFunctions::truncateString($view_data[$this->getListElementValue($element, 'name')], $list_display_length, '...');
} else {
	$view_data[$this->getListElementValue($element, 'name')]=$view_data[$this->getListElementValue($element, 'name')];
}

?>