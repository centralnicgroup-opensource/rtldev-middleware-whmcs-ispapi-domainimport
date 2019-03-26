// access /admin/addonmodules.php?module=ispapidomainimport&action=getlang
// ... and save it as this file
// we could automate this in CI
if (typeof ISPAPI === "undefined") {
    ISPAPI = {};
}
ISPAPI.lang = {
    "ok": "OK",
    "registrarerror": "The ispapi registrar authentication failed! Please verify your registrar credentials and try again.",
    "actionerror": "Invalid action requested. Please go back and try again.",
    "domaincreateerror": "Unable to create domain.",
    "tldrenewalpriceerror": "Unable to determinate domain renewal price.",
    "registrantcreateerror": "Unable to create client.",
    "registrantcreateerrornophone": "Unable to create client (no phone number).",
    "registrantfetcherror": "Unable to load registrant data.",
    "registrantmissingerror": "Missing Registrant in domain configuration.",
    "alreadyexistingerror": "Domain name already exists.",
    "domainnameinvaliderror": "Invalid domain name.",
    "nogatewayerror": "No Payment Gateway configured.",
    "domainlistfetcherror": "Failed to load list of domains.",
    "nodomainsfounderror": "The query did not return any domains names.",
    "domainsfound": "The query returned the below domain names.",
    "nothingtoimporterror": "Nothing to import.",
    "label.domain": "Domain",
    "label.domains": "Domains",
    "label.gateway": "Payment Method",
    "label.currency": "Currency",
    "ph.domainfilter": "Enter Domain Name Filter",
    "bttn.pulldomainlist": "Pull Domain list",
    "bttn.importdomainlist": "Import Domains",
    "bttn.back": "Back",
    "col.domain": "Domain",
    "col.importresult": "Import Result",
    "col.left": "Left",
    "status.importing": "Importing",
    "status.importdone": "Import done"
};