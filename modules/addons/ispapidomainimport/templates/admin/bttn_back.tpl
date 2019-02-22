<br/><br/>
<form method="POST">
    <input type="hidden" name="gateway" value="{$smarty.request.gateway|htmlspecialchars}" />
    <input type="hidden" name="currency" value="{$smarty.request.currency|htmlspecialchars}" />
    <input type="hidden" name="domain" value="{$smarty.request.domain|htmlspecialchars}" />
    <input type="hidden" name="domains" value="{$smarty.request.domains|htmlspecialchars}" />
    <input type="submit" value="{$_lang["bttn.back"]}" class="btn btn-default" />
</form>