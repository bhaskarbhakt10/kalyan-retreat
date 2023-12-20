(function ($) {
    const InitDOB =() =>{

    $(`input[name="tdra_dob"],.tdra_morepdob`).datepicker({
        showAnim: 'slideDown',
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        maxDate: new Date(),
        yearRange: "-100:+0"
    });
    }
    InitDOB();
    $(`input[name="tdra_retreatsdate"] , input[name="tdra_retreatedate"]`).datepicker({
        showAnim: 'slideDown',
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: "-100:+0"
    });

    $(document.body).on('click', '.datapicker-icon', function (e) {
        e.preventDefault();

        $(this).find('input').datepicker("show");
        // $(`input[name="tdra_dob"]`).datepicker("show");
    })
}(jQuery))