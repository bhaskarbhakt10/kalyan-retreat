(function ($) {


    const action = $(`#register`).attr('data-retreat');
    $(`#register`).removeAttr('data-retreat');
    console.log(action);
    $(document.body).on('change', '[name="tdra_language"]', function (e) {
        const thisValue = $(this).val();
        const retreatOptions = $(`[name="tdra_retreat"] `);
        const retreatStartDate = $(`#tdra_retreatstartdate`);
        const retreatEndDate = $(`#tdra_retreatenddate`);
        if (thisValue !== '') {
            $.ajax({
                url: action,
                method: 'POST',
                data: { lang: thisValue },
                cache: false,
                beforeSend: function () { },
                complete: function () { },
                success: function (response) {
                    // console.log(response);
                    if(response !== ''){
                        const { status, msg, data } = JSON.parse(response);
                        let Options = '' ;
                        if(status === true ){
                            // console.log(data);

                            const { retreat } = data;

                            
                            for (const key in retreat) {
                                
                                const element = retreat[key];
                                
                                    Options +=`<option value="${element.id}">`;
                                    Options +=`${element.name}`;
                                    Options +=`</option>`;
                                
                            }
                            
                        }
                        else{

                        }
                        if($(retreatOptions).find(`option:not(:first-child)`).length > 0){
                            $(retreatOptions).find(`option:not(:first-child)`).remove();
                        }
                        retreatOptions.append(Options);
                    }
                },
                error: function (error) {
                    console.error(error);
                },
            })
        }

    });


})(jQuery);