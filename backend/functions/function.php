<?php


function CONVERTDATEFORMAT_READ($date_format_from, $date_format_to, $date)
{
    $formattedDate = DateTime::createFromFormat($date_format_from, $date);
    if ($formattedDate !== false) {
        return $formattedDate->format($date_format_to);
    }
}


function GetAllLanguages()
{
    $languagesjsons = file_get_contents(ROOT_PATH . 'assets/json/language.json');
    $languagesArray = json_decode($languagesjsons, true);

    return $languagesArray;
}


function GetAllAccodation()
{

    $accommodationjsons = file_get_contents(ROOT_PATH . 'assets/json/accommodation.json');
    $accommodationArray = json_decode($accommodationjsons, true);
    
    return $accommodationArray;
}
