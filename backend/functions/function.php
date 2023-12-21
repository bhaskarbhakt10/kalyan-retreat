<?php


function CONVERTDATEFORMAT_READ($date_format_from ,$date_format_to, $date)
{
    $formattedDate = DateTime::createFromFormat($date_format_from, $date);
    if ($formattedDate !== false) {
        return $formattedDate->format($date_format_to);
    }
}
