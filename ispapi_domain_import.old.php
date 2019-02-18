<?php

ini_set("display_errors", 1);

$registrar = "ispapi";

#include_once dirname(__FILE__)."/../../../dbconnect.php";
#include_once dirname(__FILE__)."/../../../includes/functions.php";
include_once dirname(__FILE__)."/../../../includes/registrarfunctions.php";
include_once dirname(__FILE__)."/../../registrars/$registrar/$registrar.php";

print "<h3>Import Domains from ".strtoupper($registrar)." Account</h3>";

$params = getregistrarconfigoptions($registrar);

if (!strlen($params["Username"])) {
    print "You need to configure the Registrar Module '<b>$registrar</b>' before using this tool!";
    print "<ul><li><a href='configregistrars.php?registrar=$registrar'>Configure Registrar Module '<b>$registrar</b>'</li></ul>";
    return;
}

if ($params["TestMode"] == "on") {
    print strtoupper($registrar)." Test Account: <b>".$params["Username"]." - ";
} else {
    print strtoupper($registrar)." Production Account: <b>".$params["Username"]." - ";
}

$ispapi_config = ispapi_config(getregistrarconfigoptions($registrar));

$c = array("COMMAND" => "StatusAccount");
$r = ispapi_call($c, $ispapi_config);

if (!($r["CODE"] == 200)) {
    print "<font color='#a00000'>".$r["DESCRIPTION"]."</font>";
    print "<ul><li><a href='configregistrars.php?registrar=$registrar'>Configure Registrar Module '<b>$registrar</b>'</li></ul>";
    return;
}

print "<font color='#00a000'>Connected!</font>";
print "<br />";
print "<br />";

//...

print "<form method='POST'>";

$gateways = ispapi_find_paymentgateways();
$gateway_selected[$_REQUEST["gateway"]] = " selected";

$currencies = ispapi_find_currencies();
$currency_selected[$_REQUEST["currency"]] = " selected";

print '<p><b>Query Domainlist</b></p>';
print '<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">';

print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="domain">Domain:</label></td>';
print '<td class="fieldarea">';
if (!isset($_REQUEST["domain"])) {
    $_REQUEST["domain"] = "*";
}
print '<input type="text" name="domain" value="'.htmlspecialchars($_REQUEST["domain"]).'" />';
print '</td>';
print '</tr>';

print '</table>';

print '<p>';
print '<input type="submit" name="action_list" value="Pull Domainlist" class="button" />';
print '</p>';


print '<p><b>Import Domains</b></p>';
print '<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">';
print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="gateway">Payment Gateway</label></td>';
print '<td class="fieldarea">';
print '<select name="gateway">';
foreach ($gateways as $gateway => $name) {
    print '<option value="'.htmlspecialchars($gateway).'"'.$gateway_selected[$gateway].'>'.htmlspecialchars($name).'</option>';
}
print '</select>';
print '</td>';
print '</tr>';

print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="currency">Currency</label></td>';
print '<td class="fieldarea">';
print '<select name="currency">';
foreach ($currencies as $id => $currency) {
    print '<option value="'.htmlspecialchars($id).'"'.$currency_selected[$id].'>'.htmlspecialchars($currency).'</option>';
}
print '</select>';
print '</td>';
print '</tr>';



print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="domains">Domains</label></td>';
print '<td class="fieldarea">';
print "<textarea name='domains' id='domains' cols='60' rows='10'>";
print htmlspecialchars($_REQUEST["domains"]);
print "</textarea>";
print '</td>';
print '</tr>';
print '</table>';

print '<p>';
print '<input type="submit" name="action_import" value="Import Domains" class="button" />';
print '</p>';

print "</form>";