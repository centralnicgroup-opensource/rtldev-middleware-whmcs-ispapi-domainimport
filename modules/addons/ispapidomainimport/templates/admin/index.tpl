<form class="form-horizontal" method="POST">
    <input type="hidden" name="search" id="search" value="1"/>
    <input type="hidden" name="action" id="action" value="pull"/>
    {if empty($smarty.request.domains)}
        <h2>{$_lang['h2.fetchdomainlist']}</h2>
    {else}
        <h2 style="text-decoration:line-through">{$_lang['h2.fetchdomainlist']}</h2>
    {/if}
    <div class="form-group">
        <label for="domain" class="control-label col-sm-2">{$_lang['label.domain']}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="domain" name="domain" value="{$smarty.request.domain}" placeholder="{$_lang['ph.domainfilter']}" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="pull" class="btn btn-default actionBttn">{$_lang['bttn.pulldomainlist']}</button>
        </div>
    </div>
    <div class="form-group"{if !isset($smarty.request.search)} style="display:none"{/if}>
        <label for="domains" class="control-label col-sm-2" style="padding-top:0px">{$_lang['label.domains']} {if isset($count)} ({$count}){/if}</label>
        <div class="col-sm-10">
            {if empty($smarty.request.domains)}
                {include file='error.tpl' error=$_lang['nodomainsfounderror']}
            {else}
                {include file='success.tpl' msg=$_lang['domainsfound']}<br/><br/>
                <textarea name="domains" id="domains" rows="10" class="form-control">{$smarty.request.domains}</textarea>
            {/if}
        </div>
    </div>

    {if !empty($smarty.request.domains)}
        <h2>{$_lang['h2.importdomainlist']}</h2>
        <div class="form-group">
            <label for="gateway" class="control-label col-sm-2">{$_lang['label.gateway']}</label>
            <div class="col-sm-10">
                <select id="gateway" name="gateway" class="form-control">
                    {foreach from=$gateways key=gateway item=name}
                        <option value="{$gateway}"{$gateway_selected[$gateway]}>{$name}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="currency" class="control-label col-sm-2">{$_lang['label.currency']}</label>
            <div class="col-sm-10">
                <select id="currency" name="currency" class="form-control">
                    {foreach from=$currencies key=id item=currency}
                        <option value="{$id}"{$currency_selected[$id]}>{$currency}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="currency" class="control-label col-sm-2"><i class="glyphicon glyphicon-question-sign" title="{$_lang["title.pwcharset"]}"></i> {$_lang['label.clientpassword']}</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="clientpassword" name="clientpassword" value="{$smarty.request.clientpassword}" placeholder="{$_lang['ph.clientpassword']}" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="import" class="btn btn-default actionBttn">{$_lang['bttn.importdomainlist']}</button>
            </div>
        </div>
    {/if}
</form>
<script type="text/javascript">
<!--
$('button[class*="actionBttn"').click(function(){
    $('#action').val(this.id);
    this.form.submit();
});
// -->
</script>