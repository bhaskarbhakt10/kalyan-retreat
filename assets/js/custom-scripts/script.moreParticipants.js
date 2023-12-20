
(function ($) {
    
    /**
     * 
     * More Particiants Check
     * 
     */
    const MorePartcipants = $('#more-Participants');
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

            }
        }
        else {
            if (!$(MoreParticipantsBlock).find('.addmoreparticipants').hasClass('hidden')) {
                $(MoreParticipantsBlock).find('.addmoreparticipants').addClass('hidden');
                $(MoreParticipantsBlock).find('.addmoreparticipants').fadeOut(1000, function () {
                    MorePartcipantsFields.detach();
                })

            }
        }
    });

    /**
     * 
     * count rows
     * 
     */

    function CountRows(all_inputs, all_inputsValue) {
        all_inputs.forEach((all_input, n) => {
            $(all_input).attr('name', 'option_' + (n + 1));
            $(all_input).attr('id', 'option_' + (n + 1));
            $(all_input).closest('.field-parent').find('label').attr('for', 'option_' + (n + 1));
            $(all_input).closest('.field-parent').find('label').text('option ' + (n + 1));
        });

    }

    /**
     * 
     * Add rows to add details for more participants
     * 
     */

    // let Addbtn = 1;
    $(document.body).on('click', '[data-btn="add"]', function (e) {
        e.preventDefault();

        const thisbtn = $(this);
        const thisrow = $(thisbtn).closest('.addmoreparticipants-row');
        const elementToAppend = $(thisrow.prop('outerHTML')).addClass('appended')
        $(MorePartcipants).append(elementToAppend);
        $(`.tdra_morepdob`).datepicker();
 

    })

    /**
     * 
     * remove rows to add details for more participants
     * 
     */
    $(document.body).on('click', '[data-btn="remove"]', function (e) {
        e.preventDefault();
       
            const thisbtn = $(this);
            const thisrow = $(thisbtn).closest('.addmoreparticipants-row');
            $(thisrow).remove();
           
        

       
    })





}(jQuery))