<script type="text/javascript">
<!--
const url = "{$modulelink}";
const gateway = {$smarty.request.gateway|json_encode nofilter};
const currency = {$smarty.request.currency|json_encode nofilter};
const clientpassword = {$smarty.request.clientpassword|json_encode nofilter};
const registrar = {$registrar|json_encode nofilter};
let domains = {$smarty.request.domains|json_encode nofilter}.replace(/\r\n/g, "\n").split("\n");
{literal}
let data = {gateway, currency, clientpassword, registrar, action:'importsingle'};

$(document).ready(() => {
    const showResultContinue = (res) => {
        $(`td.result:last`).html(`<span class="label label-${res.success ? 'success' : 'danger'}" role="alert">${res.msg}</span>`);
        importDomain();
    };
    const importDomain = () => {
        $('#counterleft').html(domains.length);
        const eL = $(`td.result:last`);
        if (eL.length){
            eL.parent().get(0).scrollIntoView();
        }
        if (!domains.length){
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
                $("#importresults").append(`<tr><td>${domain}</td><td class="result"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></td></tr>`);
            }
        })
        .then((d) => {
            //successful http communication, use returned result for output
            console.dir(d);
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
            $("#importresults").append(`<tr><td>${domain}</td><td class="result"><span class="label label-danger" role="alert">Invalid domain name</span></td></tr>`);
            return false;
        }
        return true;
    });
    if (!domains.length){
        $("#importresults").append(`<tr><td colspan="2"><span class="label label-danger" role="alert">Nothing to import ...</span></td></tr>`);
        return;
    }
    importDomain();
});
{/literal}
//-->
</script>