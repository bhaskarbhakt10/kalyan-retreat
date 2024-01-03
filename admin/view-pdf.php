<?php

/**
 * 
 * Including Config file
 * 
 */
require_once dirname(__DIR__, 1) . '/__config.php';
require_once ROOT_PATH . '/backend/packages/tcpdf/tcpdf.php';
require_once ROOT_PATH . '/backend/classes/register/class.register.php';

if (array_key_exists('q', $_GET)) {

    $regId = preg_replace('/__/', '#', $_GET['q']);

    $reg = new Register();
    $alldetails = $reg->GetCompleteData($regId);
    // print_r($alldetails);

    $encArray = json_decode($alldetails['Register_Json'], true);
    $moreParticipants = !empty($alldetails['Register_MorePar']) && $alldetails['Register_MorePar'] !== NULL ? json_decode($alldetails['Register_MorePar'], true) : '';

    // print_r($moreParticipants);
    $mainTable = '';
    if (!empty($alldetails)) {
        $mainTable = '<table style="width:100%;border-collapse: collapse;" border="1" cellspacing="" cellpadding="5px">';
        //head start
        $mainTable .= '<thead style="width:100%">';
        $mainTable .= '<tr>';

        $mainTable .= '<th style="width:10%;">';
        $mainTable .= 'Sr No';
        $mainTable .= '</th>';

        $mainTable .= '<th style="width:25%;">';
        $mainTable .= 'Reg Id';
        $mainTable .= '</th>';

        $mainTable .= '<th style="width:25%;">';
        $mainTable .= 'Full Name';
        $mainTable .= '</th>';

        $mainTable .= '<th style="width:20%;">';
        $mainTable .= 'Phone Number';
        $mainTable .= '</th>';

        $mainTable .= '<th style="width:20%;">';
        $mainTable .= 'Aadhar No';
        $mainTable .= '</th>';

        $mainTable .= '</tr>';
        $mainTable .= '</thead>';
        //head end

        //body start
        //main participant
        $mainTable .= '<tbody style="width:100%">';
        $mainTable .= '<tr>';

        $mainTable .= '<td style="width:10%;">';
        $mainTable .= 1;
        $mainTable .= '</td>';

        $mainTable .= '<td style="width:25%;">';
        $mainTable .= $alldetails['Register_ID'];
        $mainTable .= '</td>';

        $mainTable .= '<td style="width:25%;">';
        $mainTable .= $encArray['tdra_fullname'];
        $mainTable .= '</td>';


        $mainTable .= '<td style="width:20%;">';
        $mainTable .= '+91 ' . $encArray['tdra_phone_number'];
        $mainTable .= '</td>';

        $mainTable .= '<td style="width:20%;">';
        $mainTable .= $reg->DecryptData($encArray['enc_aadhar'], $encArray['enc_iv']);
        $mainTable .= '</td>';
        $mainTable .= '</tr>';

        //main participant
        
        

        if (!empty($moreParticipants)) {
            $parCount = 1;
            foreach ($moreParticipants as $moreParkey => $moreParValue) {
                $parCount += 1;
                $mainTable .= "<tr>";


                $mainTable .= '<td style="width:10%;">';
                $mainTable .= $parCount;
                $mainTable .= '</td>';

                $mainTable .= '<td style="width:25%;">';
                $mainTable .= $moreParValue['ID'];
                $mainTable .= '</td>';

                $mainTable .= '<td style="width:25%;">';
                $mainTable .= $moreParValue['tdra_morepfullname'];
                $mainTable .= '</td>';


                $mainTable .= '<td style="width:20%;">';
                $mainTable .= '-';
                $mainTable .= '</td>';

                $mainTable .= '<td style="width:20%;">';
                $mainTable .= $reg->DecryptData($moreParValue['enc']['enc_aadhar'], $moreParValue['enc']['enc_iv']);
                $mainTable .= '</td>';


                $mainTable .= "</tr>";
            }
        }
        $mainTable .= '</tbody>';
        //body end
        $mainTable .= '</table>';
    }

    // echo $mainTable;


    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF
    {

        //Page header
        public function Header()
        {
            // Logo
            $header_image = PDF_IMAGES . 'header/logo.png';
            $html = '';
            $html .= '<style>.header-image{width:90px;}</style>';
            $html .= '<table class=""><tr><td style="text-align:center"><img src="' . $header_image . '" class="header-image"></td></tr></table>';

            $this->writeHTML($html, false, false, false, false, 'L');
        }

        // Page footer
        public function Footer()
        {
            $footer_image = PDF_IMAGES . 'header/logo.png';
            $footer_image = 'FOOTER TEXT';
            $html = '';
            $html .= '<style>.header-image{width:90px;}</style>';
            $html .= '<table class=""><tr><td style="text-align:center"><img src="' . $footer_image . '" class="header-image"></td></tr></table>';

            $this->writeHTML($html, false, false, false, false, 'L');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 003');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(12, 35, 12);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('times', 'BI', 12);

    // add a page
    $pdf->AddPage();




    $main_body = $mainTable;

    // print a block of text using Write()
    $pdf->writeHTML($main_body);

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('example_003.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
} else {
    exit();
}
