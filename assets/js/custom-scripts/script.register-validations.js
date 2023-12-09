(function ($) {


    /**
     * 
     * Aadhar number
     */
    $(document.body).on('keyup', 'input[name=tdra_aadhar_number]', function (e) {
        const aadhar = new RegExp('^\\d{12}$');
        const thisVal = $(this).val();
        const currentlength = $(this).val().length;
        console.log(currentlength);
        $(this).closest('.field-parent').find('.validation-message>*').remove();
        $(this).closest('.field-parent').removeClass('has-error');

        if (!aadhar.test(thisVal)) {
            if (currentlength < 12) {
                $(this).closest('.field-parent').addClass('has-error');
                $(this).closest('.field-parent').find('.validation-message').append(`<p class="error">Invalid Aaadhar. Aadhar Number should be 12 digits long. Found ${currentlength} digits only!</p>`)
            }
            else if (currentlength > 12) {

                $(this).closest('.field-parent').addClass('has-error');
                $(this).closest('.field-parent').find('.validation-message').append(`<p class="error">Invalid Aaadhar. Aadhar Number should be 12 digits long. Found ${currentlength} digits </p>`)

            }
            else {

            }
        }
    })

    /**
     * 
     * Phone Number
     * 
     */

    $(document.body).on('keyup', 'input[name=tdra_phone_number]', function (e) {
        const phone = new RegExp('^\\d{10}$');
        const thisVal = $(this).val();
        const currentlength = $(this).val().length;
        console.log(currentlength);
        $(this).closest('.field-parent').find('.validation-message>*').remove();
        $(this).closest('.field-parent').removeClass('has-error');

        if (!phone.test(thisVal)) {
            if (currentlength < 10) {
                $(this).closest('.field-parent').addClass('has-error');
                $(this).closest('.field-parent').find('.validation-message').append(`<p class="error">Invalid Phone Number. Phone Number should be 10 digits long. Found ${currentlength} digits only!</p>`)
            }
            else if (currentlength > 10) {

                $(this).closest('.field-parent').addClass('has-error');
                $(this).closest('.field-parent').find('.validation-message').append(`<p class="error">Invalid Phone Number. Phone Number should be 10 digits long. Found ${currentlength} digits </p>`)

            }
            else {

            }
        }
    })

    /**
     * 
     * Email
     * 
     */

    $(document.body).on('keyup', 'input[name="tdra_email"]', function (e) {


        const lengthRegex = new RegExp('^.{3,}$');
        const beforeAtRegex = new RegExp('^[^\\s@]{3,}@');
        const dotRegex = new RegExp('([^\\s@]{3,}\\.)+');
        const tldRegex = new RegExp('[a-zA-Z]{2,}$');

        const email = $(this).val();

        let messages = new Array();
        $(this).closest('.field-parent').removeClass('has-error');

        if (email.trim() === "") {
            $(this).closest('.field-parent').addClass('has-error');
            messages.push("Email address cannot be empty");
        }

        // Check length
        else if (!lengthRegex.test(email)) {
            $(this).closest('.field-parent').addClass('has-error');
            messages.push("Email should have more than 3 characters");
        }

        // Check before '@'
        else if (!beforeAtRegex.test(email)) {
            $(this).closest('.field-parent').addClass('has-error');
            messages.push("Invalid characters before '@'");
        }

        // Check for at least one dot after '@'
        else if (!dotRegex.test(email)) {
            $(this).closest('.field-parent').addClass('has-error');
            messages.push("Email should contain at least one dot after '@'");
        }

        // Check TLD
        else if (!tldRegex.test(email)) {
            $(this).closest('.field-parent').addClass('has-error');
            messages.push("Invalid top-level domain (TLD)");
        }
        else {

        }



        if ($(this).closest('.field-parent').find('.validation-message >*').length !== 0) {
            $(this).closest('.field-parent').find('.validation-message>*').remove();
        }

        $(this).closest('.field-parent').find('.validation-message').append(`<p class="error ">${messages.join(' & ')}</p>`);

    })


    /**
     * 
     * Full name
     * 
     */
    $(document.body).on('keyup','input[name="tdra_fullname"]', function(e){
        // first name has alteast 3 characters and 3 in length
        const firstNameRegex = new RegExp('^[A-Z][a-z]+(?: [A-Z][a-z]+)*$');
        

        const name = $(this).val();
        let messages = Array();
        if(name.trim() === ""){
            $(this).closest('.field-parent').addClass('has-error');
            messages.push("Full Name Can't Empty");
        }
        else if(!firstNameRegex.test(name)){
            $(this).closest('.field-parent').addClass('has-error');
            messages.push('invalid');
        }
        
        if ($(this).closest('.field-parent').find('.validation-message >*').length !== 0) {
            $(this).closest('.field-parent').find('.validation-message>*').remove();
        }

        $(this).closest('.field-parent').find('.validation-message').append(`<p class="error ">${messages.join(' & ')}</p>`);

    })


}(jQuery))