 $(document).ready(function() {
    $.fn.datepicker.dates['id'] = {
        days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        daysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        daysMin: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        today: 'Hari Ini',
        clear: 'Clear',
        /*format: 'yyyy-mm-dd',
        titleFormat: 'MM yyyy', */
        weekStart: 0
        };

    $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight:'TRUE',
            orientation: 'bottom',
            language: 'id',
            placeholder: 'dd-mm-yyyy',
    /*}).on('change', function(){
        $('.datepicker').hide();*/
    });
});