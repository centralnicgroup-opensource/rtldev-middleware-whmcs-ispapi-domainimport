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
{include file='bttn_back.tpl'}
{include file='css.tpl'}
{include file='import.js.tpl'}