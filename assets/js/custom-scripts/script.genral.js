/**
 * 
 * Constants
 * 
 */
window.DOBOPTIONS = {
    showAnim: 'slideDown',
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    maxDate: new Date(),
    yearRange: "-100:+0",
    markerClassName: 'hasDatepicker',
}

// console.log(window.DOBOPTIONS); 


/**
 * 
 * Constants
 * 
 */

function isRequired(formValues) {
    let return_array = new Array();
    formValues.forEach(formValue => {
        const { name } = formValue;
        // console.log($(`[name=${name}]`).closest('.field-parent'));
        $(`[name=${name}]`).closest('.field-parent').find('.validation-message>*').remove();
        if ($(`[name=${name}]`).prop('required') === true && $(`[name=${name}]`).val() === "") {
            if ($(`[name=${name}]`).closest('.field-parent').find('.validation-message>*').length === 0) {
                // console.log($(`[name=${name}]`));
                $(`[name=${name}]`).closest('.field-parent').find('.validation-message').append('<p class="error">' + $(`[name=${name}]`).closest('.field-parent').find('label').text() + ' is Required</p>')
                return_array.push(0);
            }
        }
        else {
            return_array.push(1);
        }

    });

    console.log(return_array);
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




function FormHasUniqueAadhar() {
    if ($(`.tdra_morepaadhar`).length > 0) {
        let returnFlag__ = false;
        let return_array = new Array();
        const more_aadhar_fields = $(`.tdra_morepaadhar`).toArray();
        const moreAAdahr = new Array();
        moreAAdahr.push(parseInt($(`[name="tdra_aadhar_number"]`).val()));
        more_aadhar_fields.forEach(more__adhar => {
            if($(more__adhar).val() !== ''){
                moreAAdahr.push(parseInt($(more__adhar).val()));

            }
            else{
               
            }
        });


        let seen = new Set();
        for (let index = 0; index < moreAAdahr.length; index++) {
            const aadhar = moreAAdahr[index];

            if (seen.has(aadhar)) {
                $(`.tdra_morepaadhar`).closest('.field-parent').addClass('has-error');
                $(`.tdra_morepaadhar`).closest('.field-parent').find('.validation-message').append(`<p class="error">Adhar number should be unique to individual</p>`);
                
                returnFlag__ = false;

                return_array.push(0);
                
                // break;  
            } else {
                seen.add(aadhar);
                return_array.push(1);
               
            }
        }

       

        // console.log(return_array);
        // console.log(seen);
        if (return_array.includes(0)) {
            return false;
        }
        else {
            seen.clear();
            return true;
        }

    } else {
        // Handle the case when there are no additional Aadhar fields
    }
}






/**
 * 
 *  Datatables
 * 
 * 
 */
$('.data-table').DataTable({
    responsive: true
});