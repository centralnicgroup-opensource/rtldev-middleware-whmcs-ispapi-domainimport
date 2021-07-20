const ta = $("#domains");
const showNumber = (num) => {
    const eL = $("#labeldomains");
    eL.text(eL.text().replace(/\s?\([0-9]+\)$/, ''));
    eL.text(eL.text() + `(${num})`);
};
const listDomains = (d) => {
    $("div.listdomains").css('display', '');
    $(".resultmsg").css('display', 'none');
    ta.css('display', '').val("");
    showNumber(0);
    if (d.success) {
        if (d.clientdetails && d.clientdetails.length) {
            $("div.clientdetails").css('display', '');
            $("#clientdetailscont").html(d.clientdetails);
        }
        if (d.domains && d.domains.length) {
            $(".resultmsg:last").css('display', '');
            showNumber(d.domains.length);
            ta.css('display', '').val(d.domains.join("\n"));
            return;
        }
    }
    $(".resultmsg:first").css('display', '');
};
const updateTextarea = () => {
    const val = ta.val();
    if (val !== "") {
        listDomains({
            success: true,
            domains: val.split("\n")
        });
    }
};
$('#toClientImport').click(function(){
    const $eL = $('#importform input[name="clientid"]');
    const status = $eL.prop('disabled');
    $eL.prop('disabled', !status);
    if (!status) {
        $eL.val('');
        $('div.clientdetails').css('display', '');
        $("#clientdetailscont").html('');
    }
});
$('button[class*="actionBttn"').click(function () {
    $('#importform input[name="action"]').val(this.id);
    if (this.id === "pull") {
        $.ajax({
            type: "POST",
            data: $(this.form).serialize(),
            dataType: 'json'
        }).then((d) => {
            //successful http communication, use returned result for output
            listDomains(d);
        }, (d) => {
            //failed http communication, show error
            listDomains({
                success: false,
                msg: `${d.status} ${d.statusText}`
            });
        });
    } else {
        this.form.submit();
    }
});
updateTextarea();
