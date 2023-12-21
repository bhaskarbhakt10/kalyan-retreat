/***
 * 
 * 
 * check for bug when rows are duplicated
 * 
 * 
 * 
 */
(function ($) {

    /**
     * 
     * More Particiants Check
     * 
     */
    const MorePartcipants = $('#more-Participants');
    let Addbtn = 1;
    let Subbtn = Addbtn;

    const MorePartcipantsFields = $('#more-Participants>*');
    MorePartcipantsFields.detach();
    $(document.body).on('change', '[name="tdra_moreparticipants"]', function (e) {
        const ThisCheckbox = $(this);
        const MoreParticipantsBlock = $(ThisCheckbox).closest('#moreParticipants');
        if ($(ThisCheckbox).prop('checked') === true) {
            if ($(MoreParticipantsBlock).find('.addmoreparticipants').hasClass('hidden')) {
                $(MoreParticipantsBlock).find('.addmoreparticipants').removeClass('hidden');
                $(MoreParticipantsBlock).find('.addmoreparticipants').fadeIn(1000, function () {
                    $(this).append(MorePartcipantsFields);
                })
                $(`[name^="tdra_morepdob"]`).datepicker(DOBOPTIONS)
            }
        }
        else {
            if (!$(MoreParticipantsBlock).find('.addmoreparticipants').hasClass('hidden')) {
                $(MoreParticipantsBlock).find('.addmoreparticipants').addClass('hidden');
                $(MoreParticipantsBlock).find('.addmoreparticipants').fadeOut(1000, function () {
                    MorePartcipantsFields.detach();
                })
                $(`.appended`).remove();
                Addbtn = 1;
            }
        }
    });


    const CreateUniqeName = (allnewinputs, alloldinputs, Addbtn) => {

        for (let index = 0; index < alloldinputs.length; index++) {
            const element = alloldinputs[index];
            const newinput = allnewinputs[index];
            const getCurrentInputName = $(element).attr('name');

            let name__;
            let id__;
            let for__;
            if (getCurrentInputName.split('-').length > 1) {
                const baseName = getCurrentInputName.split('-').slice(0, -1).join('-');

                name__ = `${baseName}-${Addbtn}`;
                id__ = `${baseName}-${Addbtn}`;
                for__ = `${baseName}-${Addbtn}`;
            }
            else {

                name__ = `${getCurrentInputName}-${Addbtn}`;
                id__ = `${getCurrentInputName}-${Addbtn}`;
                for__ = `${getCurrentInputName}-${Addbtn}`;

            }
            $(newinput).attr('name', name__);
            $(newinput).attr('id', id__);
            $(newinput).closest('.field-parent').find('label').attr('for', for__);

            // const splittedname__ = name__.split('-');
            // if(splittedname__[0] === 'tdra_morepdob'){
            //     console.log(splittedname__.join('-'));
            //    console.log($(`.appended-${Addbtn} [name="${splittedname__.join('-')}"]`));
            //     $(`.appended-${Addbtn} [name="${splittedname__.join('-')}"]`).datepicker()
            // }
        }

    }

    /**
     * 
     * Add rows to add details for more participants
     * 
     */


    $(document.body).on('click', '[data-btn="add"]', function (e) {
        e.preventDefault();
        Addbtn = Addbtn + 1;

        const thisbtn = $(this);
        const thisrow = $(thisbtn).closest('.addmoreparticipants-row');
        const elementToAppend = $(thisrow.prop('outerHTML')).addClass(`appended appended-${Addbtn}`)
        $(elementToAppend).find('input').addClass('appended-input');
        const allnewinputs = $(elementToAppend).find('input').toArray();
        const alloldinputs = $(thisrow).find('input').toArray();

        $(MorePartcipants).append(elementToAppend);

        CreateUniqeName(allnewinputs, alloldinputs, Addbtn);


        
        
    })
    
    $(document).on('focus', `[name^=tdra_morepdob-]`, function () {
        const input = $(this);
        console.log(input);
        $(this).datepicker(DOBOPTIONS);
    });

    /**
     * 
     * remove rows to add details for more participants
     * 
     */
    $(document.body).on('click', '[data-btn="remove"]', function (e) {
        e.preventDefault();
        if(Subbtn !== 1){
            const thisbtn = $(this);
            const thisrow = $(thisbtn).closest('.addmoreparticipants-row');
            $(thisrow).remove();
        }
        else{
            $(`[name="tdra_moreparticipants"]`).prop('checked', false);
            $(`[name="tdra_moreparticipants"]`).trigger('change');
        }

    })


    /**
     * 
     * Init appended dob
     * 
     */



    $(document.body).find('.addmoreparticipants').on('click', '.datapicker--icon button', function (e) {
        const ThisName = $(this).closest('.field-parent').find('input[type="text"]').attr('name');
        console.warn(ThisName);
        // if ($("#ui-datepicker-div").is(":visible") || $("#ui-datepicker-div").html() != "") {
        //     // $(`[name="${ThisName}"]`).datepicker('destroy');

        // }
        // else {
            
        // }
        $(`[name^="${ThisName}"]`).datepicker('show');
        // $(`[name="${ThisName}"]`).datepicker();


    })



}(jQuery))