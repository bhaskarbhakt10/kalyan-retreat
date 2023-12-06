(function ($) {


    $(document.body).on('submit', '#register', function (e) {
        e.preventDefault();
        const this_form = $(this);
        const FormValues = $(this_form).serializeArray();
        const RequiredFlag = isRequired(FormValues);
        $.ajax()
    })

}(jQuery))