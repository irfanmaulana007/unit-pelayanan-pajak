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
    $("form").attr("action","/transaction/input");
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