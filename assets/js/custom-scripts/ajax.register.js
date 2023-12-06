(function ($) {


    $(document.body).on('submit', '#register', function (e) {
        e.preventDefault();
        const this_form = $(this);
        const action = $(this_form).attr('action');
        const FormValues = $(this_form).serializeArray();
        const RequiredFlag = isRequired(FormValues);
        if (RequiredFlag === true) {
            $.ajax({
                url: action,
                method: 'POST',
                data: FormValues,
                cache: false,
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