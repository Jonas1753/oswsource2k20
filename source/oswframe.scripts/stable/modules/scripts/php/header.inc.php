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

\osWFrame\Core\Settings::setStringVar('frame_default_engine', 'scripts');
\osWFrame\Core\Settings::setStringVar('frame_default_output', 'scripts');
if (\osWFrame\Core\Settings::catchIntValue('session_enabled', 0, 'pg')==0) {
	\osWFrame\Core\Settings::setBoolVar('session_enabled', false);
}

?>