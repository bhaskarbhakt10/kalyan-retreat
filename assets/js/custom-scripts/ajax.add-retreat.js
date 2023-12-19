(function ($) {

    $(document.body).on('submit', '#add-retreat', function (e) {
        e.preventDefault();
        const this_form = $(this);
        const action = $(this_form).attr('action');
        const Response = $(this_form).find('#form-response');
        const FormValues = $(this_form).serializeArray();
        const RequiredFlag = isRequired(FormValues);
        const NoError = checkIfFieldHasNoError(FormValues);
        if (RequiredFlag === true && NoError === true) {
            $.ajax({
                url: action,
                method: 'POST',
                data: FormValues,
                cache: false,
                beforeSend: function () { },
                complete: function () { },
                success: function (response) {
                    console.log(response);
                 },
                error: function (error) {
                    console.error(error);
                },
            })

        }
    })

}(jQuery))