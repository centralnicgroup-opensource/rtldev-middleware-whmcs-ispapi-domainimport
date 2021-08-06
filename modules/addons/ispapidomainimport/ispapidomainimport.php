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
    $logo_src = file_get_contents(implode(DIRECTORY_SEPARATOR, [ROOTDIR, "modules", "addons", "ispapidomainimport", "logo.png"]));
    $logo_data = ($logo_src) ? 'data:image/png;base64,' . base64_encode($logo_src) : '';
    return [
        // Display name for your module
        "name" => "ISPAPI Domain Import",
        // Description displayed within the admin interface
        "description" => "This module allows to import existing Domains from HEXONET System.",
        // Module author name
        "author" => '<a href="https://www.hexonet.net/" target="_blank"><img style="max-width:100px" src="' . $logo_data . '" alt="HEXONET" /></a>',
        // Default language
        "language" => "english",
        // Version number
        "version" => "3.1.1",
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
    $smarty = new Smarty();
    $smarty->escape_html = true;
    $smarty->caching = false;
    $smarty->setCompileDir($GLOBALS['templates_compiledir']);
    $smarty->setTemplateDir(implode(DIRECTORY_SEPARATOR, array(ROOTDIR, "modules", "addons", "ispapidomainimport", "templates", "admin")));
    // check if the ispapi module can be loaded and is active
    $registrar = new \WHMCS\Module\Registrar();
    if (!$registrar->load("ispapi") || !$registrar->isActivated()) {
        $smarty->assign("error", $vars["_lang"]["registrarerror"]);
        $smarty->display('error.tpl');
        return;
    }

    //populate smarty variables. eg: WEB_ROOT
    global $aInt;
    $aInt->populateStandardAdminSmartyVariables();
    $smarty->assign($aInt->templatevars);

    $smarty->assign($vars);
    $smarty->assign('registrar', 'ispapi');
    //call the dispatcher with action and data
    $dispatcher = new AdminDispatcher();
    echo $dispatcher->dispatch($_REQUEST['action'], $vars, $smarty);
}
