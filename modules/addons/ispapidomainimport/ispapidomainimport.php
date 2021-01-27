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

use WHMCS\Module\Addon\IspapiDomainImport\Admin\AdminDispatcher;
use WHMCS\Module\Registrar\Ispapi\Ispapi;
use WHMCS\Module\Registrar\Ispapi\LoadRegistrars;

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
        "name" => "ISPAPI Domain Import",
        // Description displayed within the admin interface
        "description" => "This module allows to import existing Domains from HEXONET System.",
        // Module author name
        "author" => "HEXONET",
        // Default language
        "language" => "english",
        // Version number
        "version" => "3.0.2",
        // fields
        "fields" => []
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
    $registrars = (new LoadRegistrars())->getLoadedRegistars();
    $smarty = new Smarty();
    $smarty->escape_html = true;
    $smarty->caching = false;
    $smarty->setCompileDir($GLOBALS['templates_compiledir']);
    $smarty->setTemplateDir(implode(DIRECTORY_SEPARATOR, array(ROOTDIR, "modules", "addons", "ispapidomainimport", "templates", "admin")));
    if (empty($registrars)) {
        $smarty->assign("error", $vars["_lang"]["registrarerror"]);
        $smarty->display('error.tpl');
        return;
    }

    //populate smarty variables. eg: WEB_ROOT
    global $aInt;
    $aInt->populateStandardAdminSmartyVariables();
    $smarty->assign($aInt->templatevars);

    $smarty->assign($vars);
    $smarty->assign('registrar', $registrars[0]);
    //call the dispatcher with action and data
    $dispatcher = new AdminDispatcher();
    echo $dispatcher->dispatch($_REQUEST['action'], $vars, $smarty);
}
