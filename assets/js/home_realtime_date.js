setInterval(function() {
    var d = new Date();
    var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var timezone = ["", "", "", "", "", "", "", "WIB", "WITA", "WIT"];
    var gmt = -(d.getTimezoneOffset() / 60);
    var date_time = days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear() + ' ' + (d.getHours()<10?'0':'') + d.getHours() + ':' + (d.getMinutes()<10?'0':'') + d.getMinutes() + ' ' + timezone[gmt];
    $('.tgls').html(date_time);
});