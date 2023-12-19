<?php


?>
<div class="lg:max-w-[1250px] md:max-w-[90%] mx-auto px-3">
    <div class="container">
        <div class="my-2 pb-3">
            <h1 class="text-center text-3xl uppercase font-bold leading-7">Retreats Listing</h1>
        </div>
        <div class="relative  sm:rounded-lg my-5">
            <table class="data-table shadow-md table table-auto w-full text-left border border-slate-250">
                <thead class="text-sm text-white font-normal uppercase tracking-wide bg-purple-600 ">
                    <th class="py-3 px-3">
                        Sr No
                    </th>
                    <th class="py-3 px-3">
                        Retreat Name
                    </th>
                    <th class="py-3 px-3">
                        Start Date
                    </th>
                    <th class="py-3 px-3">
                        End Date
                    </th>
                    <th class="py-3 px-3">
                        Participant Limit
                    </th>
                    <th class="py-3 px-3">
                        Venue
                    </th>
                    <th class="py-3 px-3">
                        Language
                    </th>
                    <th class="py-3 px-3">
                        Action
                    </th>
                </thead>
                <tbody class="text-md">
                    <?php
                    $results = $retreat->readActiveRetreats();
                    if ($results !== false) {
                        $rowCount = 0;
                        if ($results->num_rows > 0) {
                            while ($row = $results->fetch_assoc()) {
                                
                                
                                
                                $rowCount = $rowCount + 1;
                    ?>
                                <tr class="odd:bg-white  even:bg-gray-50 border-b hover:bg-gray-100  text-black transition-all">
                                    <td class="py-3 px-3"><?php echo $rowCount; ?></td>
                                    <td class="py-3 px-3"><?php echo !empty($row['Retreat_Name']) ? $row['Retreat_Name'] : ''; ?></td>
                                    
                                    <td class="py-3 px-3"><?php echo !empty($row['Retreat_StartDate']) ? $row['Retreat_StartDate'] : ''; ?></td>

                                    <td class="py-3 px-3"><?php echo !empty($row['Retreat_EndDate']) ? $row['Retreat_EndDate'] : ''; ?></td>
                                    
                                    <td class="py-3 px-3"><?php echo !empty($row['Retreat_Limit']) ? $row['Retreat_Limit'] : ''; ?></td>

                                    <td class="py-3 px-3"><?php echo !empty($row['Retreat_Venue']) ? $row['Retreat_Venue'] : ''; ?></td>

                                    <td class="py-3 px-3"><?php echo !empty($row['Retreat_Language']) ? $row['Retreat_Language'] : ''; ?></td>
                                    
                                    <td class="py-3 px-3">
                                        <div class="flex gap-x-2">
                                            <button class="py-2 px-5 text-white rounded-3xl bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 uppercase text-sm font-medium tracking-wide transition-all text-center" >
                                                Edit
                                            </button>

                                            <a href="#!" class="py-2 px-5 text-white rounded-3xl bg-violet-900 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 uppercase text-sm font-medium tracking-wide transition-all text-center">
                                                View
                                            </a>

                                        </div>



                                    </td>
                                </tr>
                        <?php
                            }
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6"  class="py-3 px-3">
                                No Result Found
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>