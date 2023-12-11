function isRequired(formValues) {
    let return_array = new Array();
    formValues.forEach(formValue => {
        const { name } = formValue;
        // console.log($(`[name=${name}]`).closest('.field-parent'));
        $(`[name=${name}]`).closest('.field-parent').find('.validation-message>*').remove();
        if ($(`[name=${name}]`).prop('required') === true && $(`[name=${name}]`).val() === "") {
            if ($(`[name=${name}]`).closest('.field-parent').find('.validation-message>*').length === 0) {
                $(`[name=${name}]`).closest('.field-parent').find('.validation-message').append('<p class="error">' + $(`[name=${name}]`).closest('.field-parent').find('label').text() + ' is Required</p>')
                return_array.push(0);
            }
        }
        else {
            return_array.push(1);
        }

    });

    // console.log(return_array);
    if (return_array.includes(0)) {
        return false;
    }
    else {
        return true;

    }
}

const checkIfFieldHasNoError = (formValues) => {
    let return_array = new Array();
    formValues.forEach(formValue => {
        const { name } = formValue;
        if ($(`[name=${name}]`).closest('.field-parent').hasClass('has-error')) {
            if ($(`[name=${name}]`).closest('.field-parent').find('.validation-message>*').length === 0) {
                $(`[name=${name}]`).closest('.field-parent').find('.validation-message').append('<p class="error">' + $(`[name=${name}]`).closest('.field-parent').find('label').text() + ' has an error</p>')
                return_array.push(0);
            }
            
        }
        else {
            $(`[name=${name}]`).closest('.field-parent').removeClass('has-error');
            return_array.push(1);

        }

    });

    if (return_array.includes(0)) {
        return false;
    }
    else {
        return true;
    }

}


const AddRequiredMark = () => {
    const required_Fields = jQuery('[required]').toArray();
    required_Fields.forEach(required_Field => {

        $(required_Field).closest('.field-parent').find('label').addClass('mandatory-mark');
    });
}
AddRequiredMark();


/**
 * 
 *  Datatables
 * 
 * 
 */
$('.data-table').DataTable( {
    responsive: true
} );