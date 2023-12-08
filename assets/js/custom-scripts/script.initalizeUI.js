(function ($) {
    $(`input[name="tdra_dob"]`).datepicker({
        showAnim: 'slideDown',
    });

    $(document.body).on('click', '.datapicker-icon', function (e) {
        e.preventDefault();
        $(`input[name="tdra_dob"]`).datepicker("show");
    })
}(jQuery))