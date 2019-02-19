<form method='POST'>
    <p><b>Query Domainlist</b></p>
    <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
        <tr>
            <td width="15%" class="fieldlabel"><label for="domain">Domain:</label></td>
            <td class="fieldarea">
                <input type="text" name="domain" value="{$smarty.request.domain|htmlspecialchars}" />
            </td>
        </tr>
    </table>

    <p><input type="submit" name="action" value="Pull Domainlist" class="button" /></p>
    <p><b>Import Domains{if isset($count)} ({$count}){/if}</b></p>
    <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
        <tr>
            <td width="15%" class="fieldlabel"><label for="gateway">Payment Gateway</label></td>
            <td class="fieldarea">
                <select name="gateway">
                    {foreach from=$gateways key=gateway item=name}
                        <option value="{$gateway|htmlspecialchars}"{$gateway_selected[$gateway]}>{$name|htmlspecialchars}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td width="15%" class="fieldlabel"><label for="currency">Currency</label></td>
            <td class="fieldarea">
                <select name="currency">
                    {foreach from=$currencies key=id item=currency}
                        <option value="{$id|htmlspecialchars}"{$currency_selected[$id]}>{$currency|htmlspecialchars}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td width="15%" class="fieldlabel"><label for="domains">Domains</label></td>
            <td class="fieldarea">
                <textarea name='domains' id='domains' cols='60' rows='10'>{$smarty.request.domains|htmlspecialchars}</textarea>
            </td>
        </tr>
    </table>

    <p><input type="submit" name="action" value="Import Domains" class="button" /></p>
</form>