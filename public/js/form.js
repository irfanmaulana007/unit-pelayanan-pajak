function checkKode(){
    if($("#nama").prop('readonly') == false){
        kode = $("#kode").val();
        url = "/find-kode/" + kode;
        $.ajax({
            url: url,
            type: 'POST',
            data:{
                _token: meta,
                kode: kode,
            },
            beforeSend: function () {
                $("#btnSubmit").append(' <i class="fa fa-spin fa-spinner"></i>');
            },
            success: function (message) {
                $("#btnSubmit i").remove();

                $("#btn-search i").addClass('fa-search');
                $("#btn-search i").removeClass('fa-spin');
                $("#btn-search i").removeClass('fa-spinner');

                if(message.document == "true"){
                    $("#err").html('*Kode sudah digunakan');
                }else{
                    $("#err").html('');
                    $("#form").submit();
                }
            }
        });
    }else{
        $("#form").submit();
    }
}

function readable(boolean){
    $("#nama").prop('readonly', boolean);
    $("#asal").prop('readonly', boolean);
    $("#perihal").prop('readonly', boolean);
    $("#tanggal").prop('readonly', boolean);
    $("#uraian").prop('readonly', boolean);
}

function getData(message){
    $("#err").html('');
    $("#nama").val(message.nama);
    $("#asal").val(message.asal);
    $("#perihal").val(message.perihal);
    $("#tanggal").val(message.tanggal);
    $("#uraian").val(message.uraian);
}

function resetForm(){
    $("#nama").val("");
    $("#asal").val("");
    $("#perihal").val("");
    $("#tanggal").val("");
    $("#kirim").val(0);
    $("#status").val(0);
    $("#uraian").val("");
}

function onOtherPosition(){
    readable(false);
    $("#btnSubmit").prop('disabled', true);
    $("#errDoc").html("*Dokumen sedang diperiksa oleh posisi lain");
}

function init(){
    $("form").attr("action","/document/input");
    $("#btnSubmit").prop('disabled', false);
    readable(false);
    resetForm();
}

function receiveAble(id){
    $("form").attr("action","/transaction/receive/" + id)

    $("#btnSubmit").hide();
    $("#btnReceive").show();
}

function finished(){
    readable(true);
    $("#btnSubmit").prop('disabled', true);
}