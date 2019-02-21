<?php

namespace WHMCS\Module\Addon\IspapiDomainImport\Admin;
use ISPAPISSL\Helper;

/**
 * Admin Area Controller
 */
class Controller {

    private function getPaymentGateways()
    {
        $gateways = array();
        $rows = Helper::SQLCall("SELECT `gateway`, `value` FROM tblpaymentgateways WHERE setting=:setting and `order`", array(
            ":setting" => "name"
        ), "fetchall");
        foreach ($rows as $key => $v) {
            $gateways[$v["gateway"]] = $v["value"];
        }
        return $gateways;
    }

    private function getCurrencies()
    {
        $currencies = array();
        $rows = Helper::SQLCall("SELECT `code`, `id` FROM tblcurrencies", array(), "fetchall");
        foreach ($rows as $key => $v) {
            $currencies[$v["id"]] = $v["code"];
        }
        return $currencies;
    }

    private function getClientByEmail($email)
    {
        $row = Helper::SQLCall("SELECT `id` FROM tblclients WHERE email=:email LIMIT 1", array(
            ":email" => $email
        ), "fetch");
        if ($row){
            return $row["id"];
        }
        return false;
    }

    private function getCurrencyByClient($clientid)
    {
        $row = Helper::SQLCall("SELECT `currency` FROM tblclients WHERE id=:id", array(
            ":id" => $clientid
        ), "fetch");
        if ($row){
            return $row["currency"];
        }
        return false;
    }

    function getDomainPrices($currencyid)
    {
        $rows = Helper::SQLCall("SELECT tdp.extension, tp.type, msetupfee year1, qsetupfee year2, ssetupfee year3, asetupfee year4, bsetupfee year5, monthly year6, quarterly year7, semiannually year8, annually year9, biennially year10 FROM tbldomainpricing tdp, tblpricing tp WHERE tp.relid=tdp.id AND tp.currency=:currency", array(
            ":currency" => $currencyid
        ), "fetchall");
        foreach ($rows as $key => &$row){
            for ($i=1; $i<=10; $i++){
                if ($row['year'.$i] != 0) {
                    $domainprices[$row['extension']][$row['type']][$i] = $row['year'.$i];
                }
            }
        }
        return $domainprices;
    }

    private function createClient($contact)
    {
        $info = array(
            ":firstname" => $contact["FIRSTNAME"][0],
            ":lastname" => $contact["LASTNAME"][0],
            ":companyname" => $contact["ORGANIZATION"][0],
            ":email" => $contact["EMAIL"][0],
            ":address1" => $contact["STREET"][0],
            ":address2" => $contact["STREET"][1],
            ":city" => $contact["CITY"][0],
            ":state" => $contact["STATE"][0],
            ":postcode" => $contact["ZIP"][0],
            ":country" => strtoupper($contact["COUNTRY"][0]),
            ":phonenumber" => $contact["PHONE"][0],
            ":password" => "",
            ":currency" => $_REQUEST["currency"],
            ":language" => "English",
            ":credit" => "0.00",
            ":lastlogin" => "0000-00-00 00:00:00",
            ":phonenumber" => preg_replace('/^\+/', '', $info["phonenumber"]) || "NONE",
            ":postcode" => preg_replace('/[^0-9a-zA-Z ]/', '', $info["postcode"] || "N/A")
        );
        $info = array_map(function($v){
            return (is_null($v)) ? "" : $v;
        },$info);
        $keys = implode(", ", preg_replace("/:/", " ", array_keys($info)));
        $vals = implode(", ", array_keys($info));
        Helper::SQLCall("INSERT INTO tblclients (datecreated, $keys) VALUES (now(), $vals)", $info, "execute");
        return $this->getClientByEmail($contact["EMAIL"][0]);
    }

    private function createDomain($domain, $tld, $client, $domainprices)
    {
        $recurringamount = $domainprices[$tld]['domainrenew'][1];
        $info = array(
            ":userid" => $client,
            ":orderid" => 0,
            ":type" => "Register",
            ":registrationdate" => $r["PROPERTY"]["CREATEDDATE"][0],
            ":domain" => strtolower($domain),
            ":firstpaymentamount" => $recurringamount,
            ":recurringamount" => $recurringamount,
            ":paymentmethod" => $_REQUEST["gateway"],
            ":registrar" => "ispapi",
            ":registrationperiod" => 1,
            ":expirydate" => $r["PROPERTY"]["PAIDUNTILDATE"][0],
            ":subscriptionid" => "",
            ":status" => "Active",
            ":nextduedate" => $r["PROPERTY"]["PAIDUNTILDATE"][0],
            ":nextinvoicedate" => $r["PROPERTY"]["PAIDUNTILDATE"][0],
            ":dnsmanagement" => "on",
            ":emailforwarding" => "on"
        );
        $info = array_map(function($v){
            return (is_null($v)) ? "" : $v;
        },$info);
        $keys = implode(", ", preg_replace("/:/", " ", array_keys($info)));
        $vals = implode(", ", array_keys($info));
        $result = Helper::SQLCall("INSERT INTO tbldomains ($keys) VALUES ($vals)", $info, "execute");
        return $result ? true : false;
    }

    private function importDomain($domain, $registrar, &$contacts, $smarty)
    {
        if (!preg_match('/(\..*)$/i', $domain, $m)) {
            return array(
                success => false,
                msg => 'Could not find TLD in Domain Name'
            );
        }
        $tld = strtolower($m[1]);
        $row = Helper::SQLCall("SELECT `id` FROM tbldomains WHERE domain=:domain AND status IN ('Pending', 'Pending Transfer', 'Active') AND registrar='ispapi' LIMIT 1", array(
            ":domain" => $domain
        ), "fetch");
        if ($row){
            return array(
                success => false,
                msg => 'Already existing'
            );
        }
        $r = Helper::APICall($registrar, array(
            "COMMAND" => "StatusDomain",
            "DOMAIN"  => $domain
        ));
        if (!($r["CODE"] == 200)) {
            return array(
                success => false,
                msg => $r["DESCRIPTION"]
            );
        }
        $registrant = $r["PROPERTY"]["OWNERCONTACT"][0];
        if (!$registrant) {
            return array(
                success => false,
                msg => "No Registrant assigned"
            );
        }
        if (!isset($contacts[$registrant])) {
            $r2 = Helper::APICall($registrar, array(
                "COMMAND" => "StatusContact",
                "CONTACT"  => $registrant
            ));
            if (!($r2["CODE"] == 200)) {
                return array(
                    success => false,
                    msg => "Error with Registrant data"
                );
            }
            $contacts[$registrant] = $r2["PROPERTY"];
        }
        $contact = $contacts[$registrant];
        if ((!$contact["EMAIL"][0]) || (preg_match('/null$/i', $contact["EMAIL"][0]))) {
            $contact["EMAIL"][0] = "info@".$domain;
        }
        $client = $this->getClientByEmail($contact["EMAIL"][0]);
        if (!$client) {
            $client = $this->createClient($contact);
            if (!$client) {
                return array(
                    success => false,
                    msg => "Could not create client"
                );
            }
        }
        $domainprices = $this->getDomainPrices($this->getCurrencyByClient($client));
        if (!isset($domainprices[$tld]['domainrenew'][1])) {
            return array(
                success => false,
                msg => "Could not find domain renewal price for TLD {$tld}"
            );
        }
        $result = $this->createDomain($domain, $tld, $client, $domainprices);
        if (!$result) {
            return array(
                success => false,
                msg => "Could not create domain in database"
            );
        }
        return array(
            success => true,
            msg => "OK"
        );
    }

    /**
     * Index action. Display the Form.
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string
     */
    public function index($vars, $smarty)
    {
        // get payment gateways
        $gateways = $this->getPaymentGateways();
        if (empty($gateways)){
            $smarty->assign('error', "No Payment Gateway configured.");
            return $smarty->fetch('error.tpl');
        }
        $smarty->assign('gateways', $gateways);
        $smarty->assign('gateway_selected', array( $_REQUEST["gateway"] => " selected" ));
        $smarty->assign('currencies', $this->getCurrencies());
        $smarty->assign('currency_selected', array( $_REQUEST["currency"] => " selected" ));
        $smarty->assign('domain', array( $_REQUEST["currency"] => " selected" ));
        if (!isset($_REQUEST["domain"])) {
            $_REQUEST["domain"] = "*";
        }
        // show form
        return $smarty->fetch('index.tpl');
    }

    /**
     * List action.
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string
     */
    public function pulldomainlist($vars, $smarty)
    {
        $_REQUEST["domains"] = "";
        $registrar = $smarty->getTemplateVars('registrar');
        // fetch list of domains from API
        $r = Helper::APICall($registrar,  array(
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
     * Import action.
     *
     * @param array $vars Module configuration parameters
     * @param Smarty $smarty Smarty template instance
     *
     * @return string
     */
    public function importdomains($vars, $smarty)
    {
        // build list of domains from POST data
        $domains = array();
        foreach (explode("\n", $_REQUEST["domains"]) as $domain) {
            if (preg_match('/([a-zA-Z0-9\-\.]+)/', $domain, $m)) {
                $domains[] = $m[1];
            }
        }

        // perfom import and show result
        $html = $smarty->fetch("import_header.tpl");
        if (!empty($domains)) {
            $registrar = $smarty->getTemplateVars('registrar');
            $contacts = array();
            foreach($domains as $domain){
                $smarty->assign("domain", $domain);
                $smarty->assign("result", $this->importDomain($domain, $registrar, $contacts, $smarty));
                $html .= $smarty->fetch('import_result.tpl');
                //ob_flush();
                //flush();
            }
        }
        $html .= $smarty->fetch('import_footer.tpl');
        return $html;
    }
}