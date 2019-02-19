        <tr>
            <td width="30%">{$domain}</td>
            <td>
                <span class="label label-{if ($result.success)}success{else}danger{/if}" role="alert">
                    {$result.msg}
                </span>
            </td>
        </tr>