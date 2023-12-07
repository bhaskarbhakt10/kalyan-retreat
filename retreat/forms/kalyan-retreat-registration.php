<?php
$languagesjsons = file_get_contents(ROOT_PATH . 'assets/json/language.json');
$languagesArray = json_decode($languagesjsons, true);

$accommodationjsons = file_get_contents(ROOT_PATH . 'assets/json/accommodation.json');
$accommodationArray = json_decode($accommodationjsons, true);


?>
<div class="h-screen flex items-center ">

    <div class="sm:container sm:mx-auto lg:py-8 lg:px-8 md:ps-6 md:pe-6 ps-4 pe-4 py-5 rounded-xl shadow-lg shadow-zinc-200 bg-white">
        <div class="block w-full mb-5">
            <h1 class="text-4xl font-bold capitalize text-center "> Kalyan registration </h1>
        </div>
        <div class="form-container mx-auto">
            <form action="<?php echo FORM_ACTION . 'action.register.php'; ?>" method="POST" id="register" class="register" novalidate>
                <div class="grid grid-cols-1 gap-x-3 md:grid-cols-6">
                    
                    <div class="md:col-span-3 mb-3 field-parent">
                        <label for="tdra_fullname" class="block text-sm font-medium leading-7 text-gray-900"> Full Name </label>
                        <input type="text" name="tdra_fullname" id="tdra_fullname" placeholder="Jhon Doe" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-3 mb-3 field-parent">
                        <label for="tdra_dob" class="block text-sm font-medium leading-7 text-gray-900"> DOB </label>
                        <input type="date" name="tdra_dob" id="tdra_dob" placeholder="20" class="block w-full rounded-md border-0 ring-inset ring-1 ring-gray-300 shadow-sm py-2 px-3 text-gray-900  remove-arrow focus:outline-none focus:ring focus:ring-violet-300" required />
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-3 md:grid-cols-6">

                    <div class="md:col-span-3 mb-3 field-parent">
                        <label for="tdra_phone_number" class="block text-sm font-medium leading-7 text-gray-900"> Phone Number </label>
                        <div class="relative rounded-md shadow-sm ">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-900 sm:text-md">+91</span>
                            </div>
                            <input type="tel" name="tdra_phone_number" id="tdra_phone_number" class="block w-full rounded-md border-0 ps-11 py-2 px-3 text-gray-900 ring-inset ring-1 shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" placeholder="9096471732" required />
                            <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                        </div>
                    </div>
                    <div class="md:col-span-3 mb-3 field-parent">
                        <label for="tdra_email" class="block text-sm font-medium leading-7 text-gray-900"> Email </label>
                        <input type="email" name="tdra_email" id="tdra_email" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required  placeholder="example@email.com"/>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-6 mb-3 field-parent">
                        <label for="tdra_aadhar_number" class="block text-sm font-medium leading-7 text-gray-900"> Aadhar Number </label>
                        <input type="text" name="tdra_aadhar_number" id="tdra_aadhar_number" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required />
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 ">
                    <div class="col-span-12 mb-3 field-parent">
                        <label for="tdra_address" class="block text-sm leading-7 text-gray-900 font-medium"> Address </label>
                        <textarea name="tdra_address" id="tdra_address" class="w-full block rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" rows="4" required placeholder="123, Buffalo Street NY, USA"></textarea>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                </div>
                <div class="grid class grid-cols-1 gap-x-3 md:grid-cols-6">
                    <div class="md:col-span-3 mb-3 field-parent">
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
                    <div class="md:col-span-3 mb-3 field-parent">

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
                    

                </div>
                <div class="block w-full pt-3">
                    <button class="py-3 px-10 text-white rounded-3xl bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 uppercase font-medium tracking-wide transition-all"> Register </button>
                </div>
            </form>
        </div>
    </div>

</div>