<form class="form-horizontal" method="POST">
    <input type="hidden" name="action" id="action" value="pull"/>
    <h2>{$_lang['h2.fetchdomainlist']}</h2>
    <div class="form-group">
        <label for="domain" class="control-label col-sm-2">{$_lang['label.domain']}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="domain" name="domain" value="{$smarty.request.domain|htmlspecialchars}" placeholder="{$_lang['ph.domainfilter']}" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="button" id="pull" value="{$_lang['bttn.pulldomainlist']}" class="btn btn-default actionBttn" />
        </div>
    </div>

    <h2>{$_lang['h2.importdomainlist']}{if isset($count)} ({$count}){/if}</h2>
    <div class="form-group">
        <label for="gateway" class="control-label col-sm-2">{$_lang['label.gateway']}</label>
        <div class="col-sm-10">
            <select id="gateway" name="gateway" class="form-control">
                {foreach from=$gateways key=gateway item=name}
                    <option value="{$gateway|htmlspecialchars}"{$gateway_selected[$gateway]}>{$name|htmlspecialchars}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="currency" class="control-label col-sm-2">{$_lang['label.currency']}</label>
        <div class="col-sm-10">
            <select id="currency" name="currency" class="form-control">
                {foreach from=$currencies key=id item=currency}
                    <option value="{$id|htmlspecialchars}"{$currency_selected[$id]}>{$currency|htmlspecialchars}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="domains" class="control-label col-sm-2">{$_lang['label.domains']}</label>
        <div class="col-sm-10">
            <textarea name="domains" id="domains" rows="10" class="form-control">{$smarty.request.domains|htmlspecialchars}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="button" id="import" value="{$_lang['bttn.importdomainlist']}" class="btn btn-default actionBttn" />
        </div>
    </div>
</form>
<script type="text/javascript">
<!--
$('input[type="button"][class*="actionBttn"').click(function(){
    $('#action').val(this.id);
    this.form.submit();
});
// -->
</script>