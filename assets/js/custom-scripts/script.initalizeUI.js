(function ($) {

    let DOBOPTIONS = {
        showAnim: 'slideDown',
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        maxDate: new Date(),
        yearRange: "-100:+0"
    }
    $(`input[name="tdra_dob"]`).datepicker(DOBOPTIONS);
   // $(`.tdra_morepdob`).datepicker(DOBOPTIONS);
   

    $(`input[name="tdra_retreatsdate"] , input[name="tdra_retreatedate"]`).datepicker({
        showAnim: 'slideDown',
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: "-100:+0"
    });

    
    $(document.body).on('click', '.datapicker-icon', function (e) {
        e.preventDefault();
        // INITDOB($(this), DOBOPTIONS);
        // $(this).find('input[type="text"]').datepicker("show");
        // $(`input[name="tdra_dob"]`).datepicker("show");
    })
    const INITDOB =  (element, options) => {
        
       
        console.error(element);
        $(document).find(element).datepicker(options);
    }

    $(document).on('focus', '.tdra_morepdob', function (e) {
        // const thisinput = $(this).attr('name');
        // console.warn(thisinput);
        // INITDOB($(`[name="${thisinput}"]`), DOBOPTIONS);
    });


    
}(jQuery))