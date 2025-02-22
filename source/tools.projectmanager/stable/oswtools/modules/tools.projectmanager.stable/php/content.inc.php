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

$Tool=new \osWFrame\Tools\Tool\ProjectManager('oswframe2k20', 'tools.projectmanager', 'stable');
if (\osWFrame\Core\Settings::getAction()=='noupdate') {
	$Tool->blockUpdate($osW_Template->buildhrefLink('current', 'action=start'));
}
if (\osWFrame\Core\Settings::getAction()=='update') {
	$Tool->installUpdate($osW_Template->buildhrefLink('current', 'action=start'));
}
if ($Tool->hasUpdate()===true) {
	$osW_Template->addJSCodeHead($Tool->getUpdateConfirm($osW_Template->buildhrefLink('current', 'action=update'), $osW_Template->buildhrefLink('current', 'action=noupdate')));
}

$Tool->addNavigationElement('start', ['action'=>'start', 'title'=>'Start', 'icon'=>'fa fa-home fa-fw']);
$Tool->addNavigationElement('more', ['title'=>'More', 'icon'=>'fas fa-cog fa-fw']);
$Tool->addNavigationElement('updatepackagelist', ['action'=>'updatepackagelist', 'title'=>'Update packagelist', 'icon'=>'fas fa-database fa-fw'], 'more');
$Tool->addNavigationElement('changelog', ['action'=>'changelog', 'title'=>'Changelog', 'icon'=>'fas fa-list fa-fw'], 'more');
$Tool->addNavigationElement('about', ['action'=>'about', 'title'=>'About', 'icon'=>'fas fa-info fa-fw'], 'more');
\osWFrame\Core\Settings::setAction($Tool->validateAction(\osWFrame\Core\Settings::getAction()));
$Tool->checkNavigation(\osWFrame\Core\Settings::getAction());

if (in_array(\osWFrame\Core\Settings::getAction(), ['about'])) {
	include \osWFrame\Core\Settings::getStringVar('settings_abspath').'resources'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'about.inc.php';
} elseif (in_array(\osWFrame\Core\Settings::getAction(), ['changelog'])) {
	include \osWFrame\Core\Settings::getStringVar('settings_abspath').'resources'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'changelog.inc.php';
} elseif (in_array(\osWFrame\Core\Settings::getAction(), ['updatepackagelist'])) {
	\osWFrame\Tools\Server::updatePackageList(true);
	\osWFrame\Core\SessionMessageStack::addMessage('session', 'success', ['msg'=>'Packagelist has been successfully updated.']);
	\osWFrame\Core\Network::directHeader($osW_Template->buildhrefLink('current', 'action=start'));
} else {
	if (in_array(\osWFrame\Tools\Helper::getDoAction(), ['install', 'update', 'remove'])) {
		$Manager=new \osWFrame\Tools\Tool\ProjectManager('oswframe2k20', 'tools.projectmanager', 'stable');
		$Manager->loadPackages(false);
		$manager_serverlist=\osWFrame\Core\Settings::catchStringValue('manager_serverlist');
		$manager_package=\osWFrame\Core\Settings::catchStringValue('manager_package');
		$manager_release=\osWFrame\Core\Settings::catchStringValue('manager_release');
	}
	if (in_array(\osWFrame\Tools\Helper::getDoAction(), ['install', 'update'])) {
		if (in_array(\osWFrame\Tools\Helper::getDoAction(), ['update'])) {
			$Tool->removePackage($manager_serverlist, $manager_package, $manager_release, true);
		}
		$Manager->installPackage($manager_serverlist, $manager_package, $manager_release);
		\osWFrame\Core\Network::dieJSON($Manager->getCheckList());
	}
	if (in_array(\osWFrame\Tools\Helper::getDoAction(), ['remove'])) {
		$Manager->removePackage($manager_serverlist, $manager_package, $manager_release);
		\osWFrame\Core\Network::dieJSON([md5($manager_serverlist.'#'.$manager_package.'#'.$manager_release)=>$Manager->getPackageDetails($manager_serverlist, $manager_package, $manager_release)]);
	}
	$jsfiles=['resources'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'tools.projectmanager.js'];
	$osW_Template->addTemplateJSFiles('head', $jsfiles);

	$Tool->loadPackages();
	$Tool->getPackages();
	$Tool->setSL(\osWFrame\Core\Settings::catchStringValue('sl'));
}

$osW_Template->setVar('Tool', $Tool);

?>