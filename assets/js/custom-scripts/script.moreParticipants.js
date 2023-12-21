
(function ($) {

    /**
     * 
     * More Particiants Check
     * 
     */
    const MorePartcipants = $('#more-Participants');
    let Addbtn = 1;
    let Subbtn;

    const MorePartcipantsFields = `<div class="gap-x-3 flex md:flex-nowrap flex-wrap addmoreparticipants-row">
        <div class="grow md:basis-[28%] basis-[48%] shrink-0 mb-2 field-parent">
            <label for="tdra_morepfullname" class="block text-sm font-medium leading-7 text-gray-900"> Full Name </label>
            <input type="text" name="tdra_morepfullname" id="tdra_morepfullname" placeholder="John Smith" class="tdra_morepfullname block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required>
            <div class="validation-message text-red-600 text-xs font-medium italic"></div>
        </div>
        <div class="grow md:basis-[28%] basis-[48%] shrink-0 mb-2 field-parent">
            <label for="tdra_morepdob" class="block text-sm font-medium leading-7 text-gray-900"> DOB </label>
            <div class="relative flexd datapicker--icon">
                <input data-date="picker" type="text" name="tdra_morepdob" id="tdra_morepdob" placeholder="dd/mm/yyyy" class="tdra_morepdob block w-full rounded-md border-0 ring-inset ring-1 ring-gray-300 shadow-sm py-2 px-3 text-gray-900  remove-arrow focus:outline-none focus:ring focus:ring-violet-300" readonly required />
                <button class="bg-red-600 block px-3 py-1 absolute inset-y-0 end-0 rounded-md border-0 z-auto text-white bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 tarnsition-all" type="button">
                    <i class="fa-duotone fa-calendar-days"></i>
                </button>
            </div>
            <div class="validation-message text-red-600 text-xs font-medium italic"></div>
        </div>
        <div class="grow md:basis-[28%] basis-[48%] shrink-0 mb-2 field-parent">
            <label for="tdra_morepaadhar" class="block text-sm font-medium leading-7 text-gray-900"> Aadhar Number </label>
            <input type="number" name="tdra_morepaadhar" id="tdra_morepaadhar" class="tdra_morepaadhar block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required />
            <div class="validation-message text-red-600 text-xs font-medium italic"></div>
        </div>
        <div class="grow md:basis-[10%] basis-[48%] shrink-0 mb-2 field-parent">
            <div class="flex items-end justify-center h-full gap-x-2">
                <button data-btn="add" class="inline-block text-center cursor-pointer md:px-2 sm:py-1 sm:px-1 sm:py-1 px-3 py-2 rounded-md border-2 border-green-600 green-600 hover:bg-green-300 transition ease-in delay-10 hover:text-white max-w-[40px] w-full">
                    <i class="fa-solid fa-plus"></i>
                </button>
    
                <button data-btn="remove" class="inline-block text-center cursor-pointer md:px-2 sm:py-1 sm:px-1 sm:py-1 px-3 py-2 rounded-md border-2 border-red-600 red-600 hover:bg-red-300 transition ease-in delay-10 hover:text-white max-w-[40px] w-full">
                    <i class="fa-duotone fa-trash"></i>
                </button>
    
            </div>
        </div>
    </div>`;
    // MorePartcipantsFields.detach();

    $(document.body).on('change', '[name="tdra_moreparticipants"]', function (e) {
        const ThisCheckbox = $(this);
        const MoreParticipantsBlock = $(ThisCheckbox).closest('#moreParticipants');
        console.log();
        if ($(ThisCheckbox).prop('checked') === true) {
            if ($(MoreParticipantsBlock).find('.addmoreparticipants').hasClass('hidden')) {
                $(MoreParticipantsBlock).find('.addmoreparticipants').removeClass('hidden');
                $(MoreParticipantsBlock).find('.addmoreparticipants').append(MorePartcipantsFields);
                $(`[name="tdra_morepdob"]`).datepicker(window.DOBOPTIONS);
            }
        } else {
            if (!$(MoreParticipantsBlock).find('.addmoreparticipants').hasClass('hidden')) {
                $(MoreParticipantsBlock).find('.addmoreparticipants').addClass('hidden');
                $(MoreParticipantsBlock).find('.addmoreparticipants >*').remove();
                
                
                Addbtn = 1;
                Subbtn = Addbtn;
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
            } else {
                name__ = `${getCurrentInputName}-${Addbtn}`;
                id__ = `${getCurrentInputName}-${Addbtn}`;
                for__ = `${getCurrentInputName}-${Addbtn}`;
            }
            $(newinput).attr('name', name__);
            $(newinput).attr('id', id__);
            $(newinput).closest('.field-parent').find('label').attr('for', for__);

            const datePickerElement = $(`[name="${name__}"]`);
            const existingDatePicker = datePickerElement.datepicker('widget');

            if (existingDatePicker) {
                // Destroy existing datepicker instance
                datePickerElement.datepicker('destroy');
            }

            // Reinitialize datepicker
            datePickerElement.datepicker(window.DOBOPTIONS);
        }
    };

    $(document.body).on('click', '[data-btn="add"]', function (e) {
        e.preventDefault();
        Addbtn = Addbtn + 1;
        Subbtn = Addbtn;
        console.warn(Subbtn);
        const thisbtn = $(this);
        const thisrow = $(thisbtn).closest('.addmoreparticipants-row');
        const elementToAppend = $(MorePartcipantsFields).addClass(`appended appended-${Addbtn}`);
        $(elementToAppend).find('input').addClass('appended-input');
        const allnewinputs = $(elementToAppend).find('input').toArray();
        const alloldinputs = $(thisrow).find('input').toArray();

        $(MorePartcipants).append(elementToAppend);

        CreateUniqeName(allnewinputs, alloldinputs, Addbtn);

        $(`[name^="tdra_morepdob"]`).datepicker(window.DOBOPTIONS);
    });

    /**
     * 
     * remove rows to add details for more participants
     * 
     */
    $(document.body).on('click', '[data-btn="remove"]', function (e) {
        e.preventDefault();
        let delbtnlength = $(`[data-btn="remove"]`).length;
        console.log(Subbtn === undefined ? Subbtn=1 : Subbtn = Subbtn );
        if (Subbtn <= 1) {
            $(MorePartcipantsFields).remove();
            $(`[name="tdra_moreparticipants"]`).prop('checked', false);
            $(`[name="tdra_moreparticipants"]`).trigger('change');
        } else {
            const thisbtn = $(this);
            const thisrow = $(thisbtn).closest('.addmoreparticipants-row');
            $(thisrow).remove();
        }
            Subbtn = Subbtn - 1;
    });

    /**
     * 
     * Init appended dob
     * 
     */
    $(document.body).find('.addmoreparticipants').on('click', '.datapicker--icon button', function (e) {
        const ThisName = $(this).closest('.field-parent').find('input[type="text"]').attr('name');
        console.warn(ThisName);
        $(`[name^="${ThisName}"]`).datepicker('show');
    });

})(jQuery);
