<?php

namespace WHMCS\Module\Addon\IspapiDomainImport\Admin;

use ISPAPINEW\Helper;

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
        // get payment gateways
        $gateways = Helper::getPaymentGateways();
        if (empty($gateways)) {
            $smarty->assign('error', $vars["_lang"]["nogatewayerror"]);
            return $smarty->fetch('error.tpl');
        }
        $smarty->assign('gateways', $gateways);
        $smarty->assign('gateway_selected', array( $_REQUEST["gateway"] => " selected" ));
        $smarty->assign('currencies', Helper::getCurrencies());
        $smarty->assign('currency_selected', array( $_REQUEST["currency"] => " selected" ));
        if (!isset($_REQUEST["domain"])) {
            $_REQUEST["domain"] = "*";
        }
        if (empty($_REQUEST["clientpassword"])) {
            $_REQUEST["clientpassword"] = Helper::generateRandomString();
        }
        // show form
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
    public function pull($vars, $smarty)
    {
        $_REQUEST["domains"] = "";
        $registrar = $smarty->getTemplateVars('registrar');
        // fetch list of domains from API
        $r = Helper::APICall($registrar, array(
            "COMMAND" => "QueryDomainList",
            "USERDEPTH" => "SELF",
            "ORDERBY" => "DOMAIN",
            "LIMIT" => 10000,
            "DOMAIN" => $_REQUEST["domain"],
        ));
        if (!($r["CODE"] == 200)) {
            $smarty->assign('error', $r["DESCRIPTION"]);
            return $smarty->fetch('list_error.tpl');
        }
        foreach ($r["PROPERTY"]["DOMAIN"] as $domain) {
            $_REQUEST["domains"] .= "$domain\n";
        }
        $smarty->assign('count', $r["PROPERTY"]["COUNT"][0]);
        return $this->index($vars, $smarty);
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
        if (empty($_REQUEST["clientpassword"])) {
            $smarty->assign('error', $vars["_lang"]['noblankpassworderror']);
            return (
                $smarty->fetch('error.tpl') .
                $smarty->fetch('bttn_back.tpl')
            );
        }
        if (!preg_match("/^[" . Helper::$stringCharset . "]+$/", $_REQUEST["clientpassword"])) {
            $smarty->assign('error', $vars["_lang"]['passwordcharseterror']);
            return (
                $smarty->fetch('error.tpl') .
                $smarty->fetch('bttn_back.tpl')
            );
        }
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
        $result = Helper::importDomain(
            $_REQUEST["domain"],
            $_REQUEST["registrar"],
            $_REQUEST["gateway"],
            $_REQUEST["currency"],
            $_REQUEST["clientpassword"],
            $contacts
        );
        if ($result["msgid"]) {
            $result["msg"] = $vars["_lang"][$result["msgid"]];
        }
        die(json_encode($result));
    }
}
