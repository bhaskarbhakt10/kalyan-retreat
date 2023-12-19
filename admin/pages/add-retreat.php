<?php
$languagesjsons = file_get_contents(ROOT_PATH . 'assets/json/language.json');
$languagesArray = json_decode($languagesjsons, true);



?>
<div class="2xl:h-auto 2xl:min-h-[720px] xl:min-h-full xl:h-screen sm:h-screen flex items-center xl:max-w-[900px] lg:max-w-[70%] md:max-w-[80%] sm:max-w-[90%] mx-auto py-6 pt-0">
    <div class="sm:container mx-auto w-full lg:py-6 lg:px-6 md:ps-6 md:pe-6 ps-4 pe-4 py-5 rounded-xl shadow-lg shadow-zinc-200 bg-white">
        <div class="block w-full mb-5">
            <h1 class="text-4xl font-bold capitalize text-center "> Retreats </h1>
        </div>
        <div class="form-container mx-auto">
            <form action="<?php echo FORM_ACTION . 'admin.add_retreat.php'; ?>" method="POST" id="add-retreat" class="add-retreat" novalidate>
                <div class="grid grid-cols-1 gap-x-3 md:grid-cols-6">

                    <div class="md:col-span-6 mb-2 field-parent">
                        <label for="tdra_retreatname" class="block text-sm font-medium leading-7 text-gray-900"> Retreat Name </label>
                        <input type="text" name="tdra_retreatname" id="tdra_retreatname" placeholder="New Year Retreat" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-3 mb-2 field-parent">
                        <label for="tdra_retreatsdate" class="block text-sm font-medium leading-7 text-gray-900"> Start Date </label>
                        <div class="relative flexd datapicker-icon">
                            <input type="text" name="tdra_retreatsdate" id="tdra_retreatsdate" placeholder="dd/mm/yyyy" class="block w-full rounded-md border-0 ring-inset ring-1 ring-gray-300 shadow-sm py-2 px-3 text-gray-900  remove-arrow focus:outline-none focus:ring focus:ring-violet-300" readonly required />
                            <button class="bg-red-600 block px-3 py-1 absolute inset-y-0 end-0 rounded-md border-0 z-10 text-white bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 tarnsition-all" type="button">
                                <i class="fa-duotone fa-calendar-days"></i>
                            </button>
                        </div>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-3 mb-2 field-parent">
                        <label for="tdra_retreatedate" class="block text-sm font-medium leading-7 text-gray-900"> Start Date </label>
                        <div class="relative flexd datapicker-icon">
                            <input type="text" name="tdra_retreatedate" id="tdra_retreatedate" placeholder="dd/mm/yyyy" class="block w-full rounded-md border-0 ring-inset ring-1 ring-gray-300 shadow-sm py-2 px-3 text-gray-900  remove-arrow focus:outline-none focus:ring focus:ring-violet-300" readonly required />
                            <button class="bg-red-600 block px-3 py-1 absolute inset-y-0 end-0 rounded-md border-0 z-10 text-white bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 tarnsition-all" type="button">
                                <i class="fa-duotone fa-calendar-days"></i>
                            </button>
                        </div>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-2 mb-2 field-parent">
                        <label for="tdra_retreatlimit" class="block text-sm font-medium leading-7 text-gray-900"> Retreat Limit </label>
                        <input type="number" name="tdra_retreatlimit" id="tdra_retreatlimit" placeholder="80" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset shadow-sm ring-gray-300 focus:outline-none focus:ring focus:ring-violet-300" required />
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-2 mb-2 field-parent">
                        <label for="tdra_retreatvenue" class="block text-sm leading-7 text-gray-900 font-medium"> Retreat venue </label>
                        <select name="tdra_retreatvenue" id="tdra_retreatvenue" class="block w-full py-2 px-3 text-gray-900 rounded-md ring-1 ring-inset border-0 ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" required>
                            <option value="" hidden> Select a Venue</option>
                            <option value="T.A"> Tabor Ashram</option>
                            <option value="T.B"> Tabor Bhavan</option>
                        </select>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>
                    <div class="md:col-span-2 mb-2 field-parent">
                        <label for="tdra_retreatlang" class="block text-sm leading-7 text-gray-900 font-medium"> Retreat Language </label>
                        <select name="tdra_retreatlang" id="tdra_retreatlang" class="block w-full py-2 px-3 text-gray-900 rounded-md ring-1 ring-inset border-0 ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" required>
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
                    <div class="md:col-span-6 mb-2 field-parent">
                        <label for="tdra_retreattype" class="block text-sm leading-7 text-gray-900 font-medium"> Type Of Retreat </label>
                        <select name="tdra_retreattype" id="tdra_retreattype" class="block w-full py-2 px-3 text-gray-900 rounded-md ring-1 ring-inset border-0 ring-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-violet-300" required>

                            <option value="D" selected>Default</option>

                        </select>
                        <div class="validation-message text-red-600 text-xs font-medium italic"></div>
                    </div>

                </div>
                <div class="block w-full pt-3">
                    <button class="py-3 px-10 text-white rounded-3xl bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 uppercase font-medium tracking-wide transition-all"> Add Retreat </button>
                </div>
                <div class="form-response" id="form-response">

                </div>
            </form>
        </div>

    </div>
</div>