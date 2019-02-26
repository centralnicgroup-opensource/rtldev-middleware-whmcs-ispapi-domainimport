<script type="text/javascript">
<!--
const url = "{$modulelink}";
const gateway = {$smarty.request.gateway|json_encode nofilter};
const currency = {$smarty.request.currency|json_encode nofilter};
const clientpassword = {$smarty.request.clientpassword|json_encode nofilter};
const registrar = {$registrar|json_encode nofilter};
let domains = {$smarty.request.domains|json_encode nofilter}.replace(/\r\n/g, "\n").split("\n");
const errorInvalidDomain = {$_lang.domainnameinvaliderror|json_encode nofilter};
const errorImportNothing = {$_lang.nothingtoimporterror|json_encode nofilter};

{literal}
let lenOrginal;
let data = {gateway, currency, clientpassword, registrar, action:'importsingle'};

$(document).ready(() => {
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
        // continue importing domains
        importDomain();
    };
    const importDomain = () => {
        if (!domains.length){
            $("#inprogress").css("display", "none");
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
                $("#inprogress").html(`Importing <b>${domain}</b> ...`);
                $("#importresults").append(`<tr><td>${domain}</td><td class="result"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></td></tr>`);
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
            $("#importresults").append(`<tr><td>${domain}</td><td class="result"><span class="label label-danger" role="alert">${errorInvalidDomain}</span></td></tr>`);
            return false;
        }
        return true;
    });
    if (!domains.length){
        $("#importresults").append(`<tr><td colspan="2"><span class="label label-danger" role="alert">${errorImportNothing}</span></td></tr>`);
        return;
    }
    lenOrginal = domains.length;
    $('#counterleft').attr('aria-valuemax', lenOrginal);
    importDomain();
});
{/literal}
//-->
</script>