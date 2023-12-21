<?php
$languagesjsons = file_get_contents(ROOT_PATH . 'assets/json/language.json');
$languagesArray = json_decode($languagesjsons, true);

$accommodationjsons = file_get_contents(ROOT_PATH . 'assets/json/accommodation.json');
$accommodationArray = json_decode($accommodationjsons, true);


?>
<div class="2xl:h-auto 2xl:min-h-[720px] flex items-center xl:max-w-[900px] lg:max-w-[70%] md:max-w-[80%] sm:max-w-[90%] mx-auto py-6 pt-0">
    <div class="sm:container mx-auto w-full lg:py-6 lg:px-6 md:ps-6 md:pe-6 ps-4 pe-4 py-5 rounded-xl shadow-lg shadow-zinc-200 bg-white">
        <div class="block w-full mb-5">
            <h1 class="text-4xl font-bold capitalize text-center "> Tabor Ashram Registration Form </h1>
        </div>
        <div class="form-container mx-auto">
            <form action="<?php echo FORM_ACTION . 'action.register.php'; ?>" data-retreat=<?php echo FORM_ACTION . 'action.get_retreat.php'; ?> method="POST" id="register" class="register" novalidate>
                <div class="grid grid-cols-1 gap-x-3 md:grid-cols-6">

                    <div class="md:col-span-3 mb-2 field-parent">
                        <label for="tdra_fullname" class="block text-sm font-medium leading-7 text-gray-900"> Full Name </label>
                        <input type="text" name="tdra_fullname" id="tdra_fullname" placeholder="John Smith" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-3 mb-2 field-parent">
                        <label for="tdra_dob" class="block text-sm font-medium leading-7 text-gray-900"> DOB </label>
                        <div class="relative flexd datapicker-icon">
                            <input type="text" name="tdra_dob" id="tdra_dob" placeholder="dd/mm/yyyy" class="block w-full rounded-md border-0 ring-inset ring-1 ring-gray-300 shadow-sm py-2 px-3 text-gray-900  remove-arrow focus:outline-none focus:ring focus:ring-violet-300" readonly required />
                            <button class="bg-red-600 block px-3 py-1 absolute inset-y-0 end-0 rounded-md border-0 z-10 text-white bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 tarnsition-all" type="button">
                                <i class="fa-duotone fa-calendar-days"></i>
                            </button>
                        </div>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-3 md:grid-cols-12">

                    <div class="md:col-span-4 mb-2 field-parent">
                        <label for="tdra_phone_number" class="block text-sm font-medium leading-7 text-gray-900"> Phone Number </label>
                        <div class="relative rounded-md shadow-sm ">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-900 sm:text-md">+91</span>
                            </div>
                            <input type="tel" name="tdra_phone_number" id="tdra_phone_number" class="block w-full rounded-md border-0 ps-11 py-2 px-3 text-gray-900 ring-inset ring-1 shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" placeholder="9096471356" required />
                        </div>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-4 mb-2 field-parent">
                        <label for="tdra_email" class="block text-sm font-medium leading-7 text-gray-900"> Email </label>
                        <input type="email" name="tdra_email" id="tdra_email" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required placeholder="example@email.com" />
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-4 mb-2 field-parent">
                        <label for="tdra_aadhar_number" class="block text-sm font-medium leading-7 text-gray-900"> Aadhar Number </label>
                        <input type="number" name="tdra_aadhar_number" id="tdra_aadhar_number" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required />
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                </div>

                <div class="grid class grid-cols-1 gap-x-3 md:grid-cols-6">

                    <div class="md:col-span-3 mb-2 field-parent">

                        <label for="tdra_accommodation" class="block text-sm text-gray-900 font-medium leading-7"> Accommodation </label>
                        <select name="tdra_accommodation" id="tdra_accommodation" class="block w-full rounded-md py-2 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" required>
                            <option value="" hidden> Select a room Type </option>

                            <?php
                            foreach ($accommodationArray as $key => $accommod) {
                                foreach ($accommod as $acc) {
                            ?>
                                    <option value="<?php echo $acc['code'] ?>"> <?php echo $acc['name']; ?></option>
                            <?php
                                }
                            }

                            ?>
                        </select>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>

                    </div>
                    <div class="md:col-span-3 mb-2 field-parent">
                        <label for="tdra_language" class="block text-sm leading-7 text-gray-900 font-medium"> Language </label>
                        <select name="tdra_language" id="tdra_language" class="block w-full py-2 px-3 text-gray-900 rounded-md ring-1 ring-inset border-0 ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" required>
                            <option value="" hidden> Select a Language</option>
                            <?php
                            foreach ($languagesArray as $key => $language) {
                                foreach ($language as $lang) {
                            ?>
                                    <option value="<?php echo $lang['code'] ?>"> <?php echo $lang['name']; ?></option>
                            <?php
                                }
                            }

                            ?>

                        </select>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>

                </div>

                <div class="grid class grid-cols-1 gap-x-3 md:grid-cols-12">
                    <div class="md:col-span-6 mb-2 field-parent">
                        <label for="tdra_retreat" class="block text-sm leading-7 text-gray-900 font-medium"> Retreat </label>
                        <select name="tdra_retreat" id="tdra_retreat" class="block w-full py-2 px-3 text-gray-900 rounded-md ring-1 ring-inset border-0 ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" required>
                            <option value="" hidden> Select a Retreat</option>
                        </select>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-3 mb-2 field-parent">
                        <label for="tdra_retreatstartdate" class="block text-sm font-medium leading-7 text-gray-900"> Retreat Start Date </label>
                        <input type="number" name="" id="tdra_retreatstartdate" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required readonly disabled />
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-3 mb-2 field-parent">
                        <label for="tdra_retreatenddate" class="block text-sm font-medium leading-7 text-gray-900"> Retreat End Date </label>
                        <input type="text" name="" id="tdra_retreatenddate" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required readonly disabled />
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                </div>
                <div class="grid class grid-cols-1 gap-x-3 md:grid-cols-12" id="moreParticipants">
                    <div class="md:col-span-12 mb-2 field-parent">
                        <div class="flex items-center gap-x-2">
                            <input type="checkbox" name="tdra_moreparticipants" id="tdra_moreparticipants" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="tdra_moreparticipants" class=" text-sm font-medium leading-7 text-gray-900"> I wish to add more participants. </label>
                        </div>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-12 col-span-6 mb-2 field-parent hidden addmoreparticipants" id="more-Participants">
                        
                    </div>
                </div>

                <div class="grid grid-cols-1 ">
                    <div class="col-span-12 mb-2 field-parent">
                        <label for="tdra_address" class="block text-sm leading-7 text-gray-900 font-medium"> Address </label>
                        <textarea name="tdra_address" id="tdra_address" class="w-full block rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" rows="2" required placeholder="123, Buffalo Street NY, USA"></textarea>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                </div>
                <div class="block w-full pt-3">
                    <button class="py-3 px-10 text-white rounded-3xl bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 uppercase font-medium tracking-wide transition-all"> Register </button>
                </div>
                <div class="form-response" id="form-response">

                </div>
            </form>
        </div>

    </div>
</div>