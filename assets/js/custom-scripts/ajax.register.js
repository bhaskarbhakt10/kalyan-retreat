(function ($) {


    $(document.body).on('submit', '#register', function (e) {
        e.preventDefault();
        const this_form = $(this);;
        const action = $(this_form).attr('action');
        const Response = $(this_form).find('#form-response');
        const FormValues = $(this_form).serializeArray();
        const RequiredFlag = isRequired(FormValues);
        const modof = jQuery(`.addmoreparticipants-row`).length > 0 ? jQuery(`.addmoreparticipants-row`).find(`input`).length / jQuery(`.addmoreparticipants-row`).length : null;
        // FormValues = { name: mod, value: modof };
        FormValues.push({ name: 'mod', value: modof });
        console.log(FormValues);
        const NoError = checkIfFieldHasNoError(FormValues);
        if (RequiredFlag === true && NoError === true) {
            // alert('proceed to sjax')


            $.ajax({
                url: action,
                method: 'POST',
                data: FormValues,
                cache: false,
                beforeSend: function () { },
                complete: function () { },
                success: function (response) {
                    // console.log(response);
                    
                    if(response !== ''){
                        const { status, msg } = JSON.parse(response);
                        let responseHtml;
                        if(status === true){

                            responseHtml = 
                            `
                            <div class="flex items-center p-4 mt-3 text-base text-green-800 border border-green-300 rounded-lg bg-green-100" role="alert">
                                <i class="fa-duotone fa-badge-check"></i>
                                <div>
                                    <span class="font-medium ps-1">${msg}</span>
                                </div>
                    
                            </div>
                            `;
                            


                        }
                        else{

                            responseHtml = 
                            `
                            <div class="flex items-center p-4 mt-3 text-base text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                                <i class="fa-duotone fa-triangle-exclamation"></i>
                                <div>
                                    <span class="font-medium ps-1">${msg}</span>
                                </div>
                            </div>
                            `

                        }
                        Response.hide().fadeIn(1000);
                        $(Response).append(responseHtml);
                        setTimeout(() => {
                            $(this_form).get(0).reset();
                            $(this_form).parent().find('[role="alert"]').fadeOut(1000, function() {
                                $(this).remove();
                              });
                            window.location.reload();
                        }, 5*1000);

                    }
                    
                },
                error: function (error) {
                    console.error(error);
                },
            })


        }
    })

})(jQuery);