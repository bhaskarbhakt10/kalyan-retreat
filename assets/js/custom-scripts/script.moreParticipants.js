
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
     * Add rows to add details for more participants
     * 
     */

    let Addbtn = 1;
    $(document.body).on('click', '[data-btn="add"]', function (e) {
        e.preventDefault();

        const thisbtn = $(this);
        const thisrow = $(thisbtn).closest('.addmoreparticipants-row');
        const elementToAppend = $(thisrow.prop('outerHTML')).addClass('appended')
        $(elementToAppend).find('input').addClass('appended-input');
        const allnewinputs = $(elementToAppend).find('input').toArray();
        const alloldinputs = $(thisrow).find('input').toArray();
       
        Addbtn = Addbtn +1;
        


        for (let index = 0; index < alloldinputs.length; index++) {
            const element = alloldinputs[index];
            const newinput = allnewinputs[index];
            const getCurrentInputName = $(element).attr('name');
       
        
            if(getCurrentInputName.split('-').length >1){
                const baseName = getCurrentInputName.split('-').slice(0, -1).join('-');
                $(newinput).attr('name', `${baseName}-${Addbtn}`);
                $(newinput).attr('id', `${baseName}-${Addbtn}`);
                $(newinput).closest('.field-parent').find('label').attr('for', `${baseName}-${Addbtn}`);
            }
            else{
                $(newinput).attr('name', `${getCurrentInputName}-${Addbtn}`);
                $(newinput).attr('id', `${getCurrentInputName}-${Addbtn}`);
                $(newinput).closest('.field-parent').find('label').attr('for', `${getCurrentInputName}-${Addbtn}`);

            }
        }
    
 
        $(MorePartcipants).append(elementToAppend);

        

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