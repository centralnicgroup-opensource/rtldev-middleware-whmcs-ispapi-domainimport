<link rel="stylesheet" type="text/css" href="${WEB_ROOT}/modules/addons/ispapidomainimport/assets/styles.css"/>
<table class="table table-condensed small scrollable">
    <thead>
        <tr>
            <th>{$_lang['col.domain']}</th>
            <th>{$_lang['col.importresult']}</th>
        </tr>
    </thead>
    <tbody id="importresults">
    </tbody>
</table>
<div class="row" style="margin-top:30px">
    <div class="col-md-3">
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="counterleft">0%</div>
        </div>
        <div id="inprogress"></div>
    </div>
</div>
<br/><br/>
<form method="POST" id="backform">
    <input type="hidden" name="gateway" value="{$smarty.request.gateway}" />
    <input type="hidden" name="registrar" value="{$smarty.request.registrar}" />
    <input type="hidden" name="currency" value="{$smarty.request.currency}" />
    <input type="hidden" name="domain" value="{$smarty.request.domain}" />
    <input type="hidden" name="domains" value="{$smarty.request.domains}" />
    <input type="hidden" name="action" value="index" />
    <input type="submit" value="{$_lang["bttn.back"]}" class="btn btn-default" />
</form>
<script type="text/javascript" src="${WEB_ROOT}/modules/addons/ispapidomainimport/assets/translations.js?{mktime()}"></script>
<script type="text/javascript" src="${WEB_ROOT}/modules/addons/ispapidomainimport/assets/import.js"></script>