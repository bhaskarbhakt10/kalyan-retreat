(function ($) {
    $(`input[name="tdra_dob"]`).datepicker({
        showAnim: 'slideDown',
        changeMonth: true,
      changeYear: true,
      dateFormat: "dd/mm/yy",
      maxDate: new Date(),
      yearRange: "-100:+0"
    });

    $(document.body).on('click', '.datapicker-icon', function (e) {
        e.preventDefault();
        $(`input[name="tdra_dob"]`).datepicker("show");
    })
}(jQuery))