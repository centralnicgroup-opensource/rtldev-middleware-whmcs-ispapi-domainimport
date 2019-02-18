<?php
/**
 * WHMCS ISPAPI Domain Import Addon Module
 *
 * This Addon allows to import existing Domains from HEXONET System.
 *
 * @see https://github.com/hexonet/whmcs-ispapi-domainimport/wiki/
 *
 * @copyright Copyright (c) Kai Schwarz, HEXONET GmbH, 2019
 * @license https://github.com/hexonet/whmcs-ispapi-domainimport/blob/master/LICENSE/ MIT License
 */

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\IspapiDomainImport\Admin\AdminDispatcher;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use ISPAPISSL\LoadRegistrars;
use ISPAPISSL\Helper;
require_once(implode(DIRECTORY_SEPARATOR, array(ROOTDIR,"modules","servers","ispapissl","lib","LoadRegistrars.class.php")));
require_once(implode(DIRECTORY_SEPARATOR, array(ROOTDIR,"modules","servers","ispapissl","lib","Helper.class.php")));



/**
 * Define addon module configuration parameters.
 *
 * Includes a number of required system fields including name, description,
 * author, language and version.
 *
 * Also allows you to define any configuration parameters that should be
 * presented to the user when activating and configuring the module. These
 * values are then made available in all module function calls.
 *
 * Examples of each and their possible configuration parameters are provided in
 * the fields parameter below.
 *
 * @return array
 */
function ispapidomainimport_config()
{
    return [
        // Display name for your module
        'name' => 'ISPAPI Domain Import',
        // Description displayed within the admin interface
        'description' => 'This module allows to import existing Domains from HEXONET System.',
        // Module author name
        'author' => 'HEXONET',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0'
    ];
}

/**
 * Admin Area Output.
 *
 * @see AddonModule\Admin\Controller::index()
 *
 * @return string
 */
function ispapidomainimport_output($vars)
{
    //load all the ISPAPI registrars
    $ispapi_registrars = new LoadRegistrars();
    $vars["ispapi_registrar"] = $ispapi_registrars->getLoadedRegistars();
    $smarty = new Smarty;
    $smarty->caching = false;
    $smarty->setCompileDir( $GLOBALS['templates_compiledir'] );
    $smarty->setTemplateDir( implode(DIRECTORY_SEPARATOR, array(".", "..", "modules", "addons", "ispapidomainimport", "templates", "admin")) );
    $smarty->assign($vars);
    if(empty($vars["ispapi_registrar"])){
        $vars["smarty"]->assign("error", $vars["_lang"]["registrarerror"]);
        $vars["smarty"]->display('error.tpl');
        return;
    }
    //call the dispatcher with action and data
    $dispatcher = new AdminDispatcher();
    $dispatcher->dispatch($_REQUEST['action'], $vars, $smarty);
}

/**
 * Admin Area Sidebar Output.
 *
 * Used to render output in the admin area sidebar.
 *
 * @param array $vars
 *
 * @return string
 */
function ispapidomainimport_sidebar($vars)
{
    return '';
}