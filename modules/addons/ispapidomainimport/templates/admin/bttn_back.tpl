<br/><br/>
<form method="POST">
    <input type="hidden" name="gateway" value="{$smarty.request.gateway}" />
    <input type="hidden" name="currency" value="{$smarty.request.currency}" />
    <input type="hidden" name="domain" value="{$smarty.request.domain}" />
    <input type="hidden" name="domains" value="{$smarty.request.domains}" />
    <input type="hidden" name="action" value="index" />
    <input type="submit" value="{$_lang["bttn.back"]}" class="btn btn-default" />
</form>