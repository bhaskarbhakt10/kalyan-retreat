<?php

$cipher = CIPHER;
$key = KEY;
$ivlen = openssl_cipher_iv_length($cipher);
$iv = openssl_random_pseudo_bytes($ivlen);

?>
<div class="lg:max-w-[1200px] md:max-w-[90%] mx-auto px-3">
    <div class="container">
        <div class="my-2 pb-3">
            <h1 class="text-center text-3xl uppercase font-bold leading-7">Registrations Listing</h1>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-5">
            <table class="table table-auto w-full text-left border border-slate-250 ">
                <thead class="text-sm text-white font-normal uppercase tracking-wide bg-purple-600 ">
                    <th class="py-3 px-3">
                        Sr No
                    </th>
                    <th class="py-3 px-3">
                        Register Id
                    </th>
                    <th class="py-3 px-3">
                        Name
                    </th>
                    <th class="py-3 px-3">
                        Phone No
                    </th>
                    <th class="py-3 px-3">
                        Email
                    </th>
                    <th class="py-3 px-3">
                        Action
                    </th>
                </thead>
                <tbody class="text-md">
                    <?php
                    $results = $register->ShowData();
                    if ($results !== false) {
                        $rowCount = 0;
                        if ($results->num_rows > 0) {
                            while ($row = $results->fetch_assoc()) {
                               
                                $aadharno = $row['Register_AadharNumber']; 

                                         
                                $rowCount = $rowCount + 1;
                    ?>
                                <tr class="odd:bg-white  even:bg-gray-50 border-b hover:bg-gray-100  text-black transition-all">
                                    <td class="py-3 px-3"><?php echo $rowCount; ?></td>
                                    <td class="py-3 px-3"><?php echo !empty($row['Register_ID']) ? $row['Register_ID'] : ''; ?></td>
                                    <td class="py-3 px-3">
                                        <?php
                                        if (!empty($row['Register_Json'])) {
                                            $register_data = json_decode($row['Register_Json'], true);
                                            echo !empty($register_data['tdra_fullname']) ? $register_data['tdra_fullname'] : '';
                                        }
                                        ?>
                                    </td>
                                    <td class="py-3 px-3"><?php echo !empty($row['Register_PhoneNo']) ? $row['Register_PhoneNo'] : ''; ?></td>

                                    <td class="py-3 px-3"><?php echo !empty($row['Register_Email']) ? $row['Register_Email'] : ''; ?></td>

                                    <td class="py-3 px-3">
                                        <div class="flex gap-x-2">
                                            <a class="print-pdf block text-center cursor-pointer md:px-2 sm:py-1 sm:px-1 sm:py-1 px-2 py-1 rounded-md border-2 border-purple-600 text-purple-600 hover:bg-purple-300 transition ease-in delay-10 hover:text-white max-w-[100px] w-full" alt="Print Pdf">
                                                <i class="fa-solid fa-print"></i>
                                            </a>

                                            <a class="print-pdf block text-center cursor-pointer md:px-2 sm:py-1 sm:px-1 sm:py-1 px-2 py-1 rounded-md border-2 border-purple-600 text-purple-600 hover:bg-purple-300 transition ease-in delay-10 hover:text-white max-w-[100px] w-full" alt="View Pdf">
                                                <i class="fa-duotone fa-file-pdf"></i>
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