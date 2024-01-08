(function ($) {


    const action = $(`#register`).attr('data-retreat');
    $(`#register`).removeAttr('data-retreat');
    const retreatStartDate = $(`#tdra_retreatstartdate`);
    const retreatEndDate = $(`#tdra_retreatenddate`);
    const retreatvenue = $(`#tdra_retreatvenue`);
    
    // console.log(action);
    $(document.body).on('change', '[name="tdra_language"]', function (e) {
        const thisValue = $(this).val();
        $(retreatEndDate).val('');
        $(retreatStartDate).val('');
        $(retreatvenue).val('');
        const retreatOptions = $(`[name="tdra_retreat"]`);
        const email  = ($(`[name="tdra_email"]`).val()!=='') ? $(`[name="tdra_email"]`).val() : null ;
        const phoneNumber  = ($(`[name="tdra_phone_number"]`).val() !== '') ? $(`[name="tdra_phone_number"]`).val() : null ;
        if (thisValue !== '') {
            $.ajax({
                url: action,
                method: 'POST',
                data: { lang: thisValue, email:email,phone:phoneNumber },
                cache: false,
                beforeSend: function () { },
                complete: function () { },
                success: function (response) {
                    // console.log(response);
                    if (response !== '') {
                        const { status, msg, data } = JSON.parse(response);
                        let Options = '';
                        if ($(retreatOptions).find(`option:not(:first-child)`).length > 0) {
                            $(retreatOptions).find(`option:not(:first-child)`).remove();
                        }
                        if (status === true) {
                            // console.log(data);

                            const { retreat, total_retreat_found } = data;


                            for (const key in retreat) {

                                const element = retreat[key];

                                Options += `<option value="${element.id}" data-venue="${element.venue}" data-start="${element.start_date.toString()}" data-end="${element.end_date.toString()}">`;
                                Options += `${element.name}`;
                                Options += `</option>`;


                            }
                            retreatOptions.append(Options);

                            window.alert(`${total_retreat_found} Retreat/s Found For The Selected Language`);
                        }
                        else {

                            window.alert(`No Retreat Found For The Selected Language`);

                        }

                    }
                },
                error: function (error) {
                    console.error(error);
                },
            })
        }

    });

    /**
     * 
     * Load dates and details
     * 
     */

    $(document.body).on('change', 'select[name="tdra_retreat"]', function (e) {

        $(retreatEndDate).val('');
        $(retreatStartDate).val('');
        $(retreatvenue).val('');
       
        
        const ThisField = $(this).find('option:selected');
    
        $(retreatStartDate).val(ThisField.data('start'));
        $(retreatEndDate).val(ThisField.data('end'));
        $(retreatvenue).val(ThisField.data('venue'));



    })

})(jQuery);