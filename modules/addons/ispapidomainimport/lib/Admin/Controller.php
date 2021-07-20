<?php

namespace WHMCS\Module\Addon\IspapiDomainImport\Admin;

use WHMCS\Module\Registrar\Ispapi\Ispapi;
use WHMCS\Module\Registrar\Ispapi\Helper;

/**
 * Admin Area Controller
 */
class Controller
{
    /**
     * Index action. Display the Form.
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string html code
     */
    public function index($vars, $smarty)
    {
        $gateways = Helper::getPaymentMethods();
        if (empty($gateways)) {
            $smarty->assign('error', $vars["_lang"]["nogatewayerror"]);
            return $smarty->fetch('error.tpl');
        }

        $smarty->assign('gateways', $gateways);
        $smarty->assign('gateway_selected', [ $_REQUEST["gateway"] => " selected" ]);
        $smarty->assign('currencies', Helper::getCurrencies());
        $smarty->assign('currency_selected', [ $_REQUEST["currency"] => " selected" ]);
        if (!isset($_REQUEST["domain"])) {
            $_REQUEST["domain"] = "*";
        }
        return $smarty->fetch('index.tpl');
    }

    /**
     * pull action. Fetch the domain list using the provided domain name filter.
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string html code
     */
    public function pull()
    {
        header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Content-type: application/json; charset=utf-8');

        // fetch list of domains from API
        $r = Ispapi::call(array(
            "COMMAND" => "QueryDomainList",
            "UNIQUE" => 1,
            "USERDEPTH" => "SELF",
            "ORDERBY" => "DOMAIN",
            "LIMIT" => 10000,
            "DOMAIN" => $_REQUEST["domain"],
        ));
        $json = array(
            "success" => ($r["CODE"] == 200),
            "msg" => $r["DESCRIPTION"]
        );


        $clientdetails = "";
        if ($_REQUEST["toClientImport"] === "1" && isset($_REQUEST['clientid'])) {
            $result = localAPI('GetClientsDetails', [
                'clientid' => $_REQUEST['clientid'],
                'stats' => false
            ]);
            if ($result["result"] === "success") {
                $clientdetails = (
                    $result["client"]["fullname"] . "<br/>" .
                    $result["client"]["companyname"] . "<br/>" .
                    $result["client"]["email"] . "<br/>" .
                    $result["client"]["phonenumberformatted"] . "<br/>" .
                    $result["client"]["address1"] . "<br/>" .
                    (empty($result["client"]["address2"]) ? "" : $result["client"]["address2"] . "<br/>") .
                    $result["client"]["postcode"] . " " . $result["client"]["city"] . "<br/>" .
                    $result["client"]["state"] . ", " . $result["client"]["country"] . "<br/>"
                );
            }
        }

        if ($json["success"]) {
            $json["domains"] = $r["PROPERTY"]["DOMAIN"];
            $json["clientdetails"] = $clientdetails;
        }
        die(json_encode($json));
    }

    /**
     * import action. trigger import of domain list through javascript.
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string html code
     */
    public function import($vars, $smarty)
    {
        // import logic done on jscript-side
        return $smarty->fetch('import.tpl');
    }

    /**
     * importsingle action. import a signle domain.
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string html code
     */
    public function importsingle($vars, $smarty)
    {
        header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Content-type: application/json; charset=utf-8');

        $contacts = array();
        $result = Helper::importDomain( // TODO update this method for direct client import
            $_REQUEST["domain"],
            $_REQUEST["registrar"],
            $_REQUEST["gateway"],
            $_REQUEST["currency"],
            Helper::generateRandomString(),
            $contacts,
            [
                "toClientImport" => (int) $_REQUEST["toClientImport"],
                "clientid" => (int) $_REQUEST["clientid"]
            ]
        );
        if ($result["msgid"]) {
            $result["msg"] = $vars["_lang"][$result["msgid"]];
        }
        //if custom translation does not exist for 'msgid' in the module
        if (!$result["msg"]) {
            $result["msg"] = \Lang::trans($result["msgid"]);
        }

        die(json_encode($result));
    }

    /**
     * getlang action. return translation texts in javascript source file format.
     * save this as asset under assets/translations.js
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string json response
     */
    public function getlang($vars, $smarty)
    {
        header('Content-Type: application/javascript');
        echo $smarty->fetch('getlang.tpl');
        die();
    }
}
