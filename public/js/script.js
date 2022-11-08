function select2_to_val_json( val ) {
    var arr = [];
    for(j = 0; j < val.length; j++){
        arr.push(val[j].id);
    }
    return JSON.stringify(arr);
}

function toYYYYMMDD(dateString) {
    return dateString.split("/").reverse().join("-");
}

function toDDMMYYYY(val) {
    if (String(val).length < 8)
        return "";
    var code='-'
    var result='/'
    var TG = val.split(code).reverse();
    if(TG.length !== 3) return '';

    var Ngay = TG[0] < 10 ? ('0' + parseInt(TG[0])) : TG[0];
    var Thang = TG[1] < 10 ? ('0' + parseInt(TG[1])) : TG[1];
    var Nam = TG[2] < 10 ? ('0' + parseInt(TG[2])) : TG[2];
    return Ngay + result + Thang + result + Nam;
}

function toDDMMYYYY_HHMMSS(val) {
    if (String(val).length < 12)
        return "";
    var giatri = val.trim();
    giatri= giatri.split(' ').reverse();
    console.log(giatri[1]);
    var ngay = giatri[1];
    var code='-'
    var result='/'
    var TG = ngay.split(code).reverse();
    if(TG.length !== 3) return '';

    var Ngay = TG[0] < 10 ? ('0' + parseInt(TG[0])) : TG[0];
    var Thang = TG[1] < 10 ? ('0' + parseInt(TG[1])) : TG[1];
    var Nam = TG[2] < 10 ? ('0' + parseInt(TG[2])) : TG[2];
    return Ngay + result + Thang + result + Nam + " - " +giatri[0];
}
