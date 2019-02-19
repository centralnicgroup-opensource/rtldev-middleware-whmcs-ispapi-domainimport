<form class="form-horizontal" method="POST">
    <h2>Query Domainlist</h2>
    <div class="form-group">
        <label for="domain" class="control-label col-sm-2">Domain</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="domain" name="domain" value="{$smarty.request.domain|htmlspecialchars}" placeholder="Enter Domain Name Filter" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="action" value="Pull Domainlist" class="btn btn-default" />
        </div>
    </div>

    <h2>Import Domains{if isset($count)} ({$count}){/if}</h2>
    <div class="form-group">
        <label for="gateway" class="control-label col-sm-2">Payment Gateway</label>
        <div class="col-sm-10">
            <select id="gateway" name="gateway" class="form-control">
                {foreach from=$gateways key=gateway item=name}
                    <option value="{$gateway|htmlspecialchars}"{$gateway_selected[$gateway]}>{$name|htmlspecialchars}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="currency" class="control-label col-sm-2">Currency</label>
        <div class="col-sm-10">
            <select id="currency" name="currency" class="form-control">
                {foreach from=$currencies key=id item=currency}
                    <option value="{$id|htmlspecialchars}"{$currency_selected[$id]}>{$currency|htmlspecialchars}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="domains" class="control-label col-sm-2">Domains</label>
        <div class="col-sm-10">
            <textarea name="domains" id="domains" rows="10" class="form-control">{$smarty.request.domains|htmlspecialchars}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="action" value="Import Domains" class="btn btn-default" />
        </div>
    </div>
</form>