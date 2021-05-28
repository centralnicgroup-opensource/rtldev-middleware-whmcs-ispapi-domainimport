$(document).ready(() => {
    let lenOrginal;
    let form = $('#backform');
    let domains = form.find('input[name="domains"]').val().split("\n");
    let data = {
        gateway: form.find('input[name="gateway"]').val(),
        currency: form.find('input[name="currency"]').val(),
        registrar: form.find('input[name="registrar"]').val(),
        action: 'importsingle'
    };
    // Adjust the width of thead cells with width of tbody cells when window resizes
    $(window).resize(function () {
        const $table = $('table.scrollable');
        const $bodyCells = $table.find('tbody tr:first').children();
        const colWidth = $bodyCells.map(function () {
            return $(this).width();
        }).get();
        if (colWidth.length) {
            $table.find('thead tr').children().each(function (i, v) {
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
        $(`td.result:last`).html(`<span class="label label-${res.success ? 'success' : 'danger'}" role = "alert">${res.msg}</span>`);
        $(window).resize();
        // continue importing domains
        importDomain();
    };

    const importDomain = () => {
        if (!domains.length) {
            $("#inprogress").html(`${translate("status.importdone")}.`);
            return;
        }
        data.domain = domains.shift();
        $.ajax({
            data,
            dataType: 'json',
            type: 'POST',
            beforeSend: () => {
                //create line with spinner icon before import request will be sent
                $("#inprogress").html(`${translate("status.importing")} <b> ${data.domain} </b> ...`);
                $("#importresults").append(`<tr><td>${data.domain}</td> <td class="result"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></td></tr>`);
                $(window).resize();
            }
        }).then((d) => {
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

    const translate = (translationkey) => {
        const lang = ISPAPI.lang;
        if (lang.hasOwnProperty(translationkey)) {
            return lang[translationkey];
        }
        return translationkey;
    };

    domains = domains.filter((domain, idx) => {
        domain = domain.replace(/\s/g, "");
        if (!domain.length) {
            return false;
        }
        if (!/^[a-zA-Z0-9\-\.]+\.[a-zA-Z0-9\-\.]+$/.test(domain)) {
            $("#importresults").append(`<tr><td>${domain}</td><td class="result"><span class="label label-danger" role="alert">${translate('domainnameinvaliderror')}</span></td></tr>`);
            $(window).resize();
            return false;
        }
        return true;
    });
    if (!domains.length) {
        $("#importresults").append(`<tr><td colspan="2"><span class="label label-danger" role="alert">${translate('nothingtoimporterror')}</span></td></tr>`);
        $(window).resize();
        return;
    }
    lenOrginal = domains.length;
    $('#counterleft').attr('aria-valuemax', lenOrginal);
    importDomain();
});