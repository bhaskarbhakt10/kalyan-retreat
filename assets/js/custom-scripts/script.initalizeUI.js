(function ($) {
    /**
     * 
     * initalization for ui elemets that are present on screen. NOT DYNAMIC ELEMENTS
     * 
     */
    // console.log(window.DOBOPTIONS);
    $(`input[name="tdra_dob"]`).datepicker(window.DOBOPTIONS);
    // $(`[name=tdra_morepdob]`).datepicker(DOBOPTIONS);
   

    $(`input[name="tdra_retreatsdate"] , input[name="tdra_retreatedate"]`).datepicker({
        showAnim: 'slideDown',
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: "-100:+0"
    });

    
    $('.datapicker-icon button').on('click',  function (e) {
        e.preventDefault();
        $(this).closest('.field-parent').find('input[type="text"]').datepicker("show");
    })
    


    
})(jQuery);