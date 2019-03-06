<script type="text/javascript">
<!--
const url = "{$modulelink}";
const gateway = {$smarty.request.gateway|json_encode nofilter};
const currency = {$smarty.request.currency|json_encode nofilter};
const registrar = {$registrar|json_encode nofilter};
let domains = {$smarty.request.domains|json_encode nofilter}.replace(/\r\n/g, "\n").split("\n");
const lang = {$_lang|json_encode nofilter};

{literal}
let lenOrginal;
let data = {gateway, currency, registrar, action:'importsingle'};

$(document).ready(() => {
    // Adjust the width of thead cells with width of tbody cells when window resizes
    $(window).resize(function() {
        const $table = $('table.scrollable');
        const $bodyCells = $table.find('tbody tr:first').children();
        const colWidth = $bodyCells.map(function() {
            return $(this).width();
        }).get();
        if (colWidth.length){
            $table.find('thead tr').children().each(function(i, v) {
                $(v).width(colWidth[i]);
            });
        }
    });

    const showResultContinue = (res) => {
        // update progress bar
        const lenNow = domains.length;
        const progress = lenOrginal - lenNow;
        const html = `${Math.round(progress / (lenOrginal / 100))}%`;
        $('#counterleft')
            .html(html)
            .css('width', html)
            .attr('aria-valuenow', progress);
        // output last import result
        $(`td.result:last`).html(`<span class="label label-${res.success ? 'success' : 'danger'}" role="alert">${res.msg}</span>`);
        $(window).resize();
        // continue importing domains
        importDomain();
    };
    const importDomain = () => {
        if (!domains.length){
            $("#inprogress").html(`${lang["status.importdone"]}.`);
            return;
        }
        const domain = domains.shift();
        data.domain = domain;
        $.ajax(url, {
            data,
            dataType: 'json',
            type: 'POST',
            beforeSend: () => {
                //create line with spinner icon before import request will be sent
                $("#inprogress").html(`${lang["status.importing"]} <b>${domain}</b> ...`);
                $("#importresults").append(`<tr><td>${domain}</td><td class="result"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></td></tr>`);
                $(window).resize();
            }
        })
        .then((d) => {
            //successful http communication, use returned result for output
            showResultContinue(d);
        }, (d) => {
            //failed http communication, show error
            showResultContinue({
                success: false,
                msg: `${d.status} ${d.statusText}`
            });
        });
    };
    domains = domains.filter((domain, idx) => {
        domain = domain.replace(/\s/g, "");
        if (!domain.length){
            return false;
        }
        if (!/^[a-zA-Z0-9\-\.]+\.[a-zA-Z0-9\-\.]+$/.test(domain)){
            $("#importresults").append(`<tr><td>${domain}</td><td class="result"><span class="label label-danger" role="alert">${lang.domainnameinvaliderror}</span></td></tr>`);
            $(window).resize();
            return false;
        }
        return true;
    });
    if (!domains.length){
        $("#importresults").append(`<tr><td colspan="2"><span class="label label-danger" role="alert">${lang.nothingtoimporterror}</span></td></tr>`);
        $(window).resize();
        return;
    }
    lenOrginal = domains.length;
    $('#counterleft').attr('aria-valuemax', lenOrginal);
    importDomain();
});
{/literal}
//-->
</script>