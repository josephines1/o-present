<?php

namespace App\Libraries\Validation;

use DateTime;

class myCustomValidation
{
    public function daysAfter($value, string $params): bool
    {
        // Validate the input value as a date
        if (!strtotime($value)) {
            return false;
        }

        // Extract parameters
        $limitMonths = $params;

        // Mendapatkan tanggal hari ini
        $tanggal_sekarang = date('Y-m-d');

        // Menambahkan 3 hari ke dalam tanggal hari ini
        $tanggal_batas = date('Y-m-d', strtotime($tanggal_sekarang . ' +' . $limitMonths . 'days'));

        // Memeriksa apakah tanggal cuti kurang dari 3 hari dari hari ini
        if ($value < $tanggal_batas) {
            return false;
        }

        return true;
    }

    public function offLimitRule($value, string $params, array $data): bool
    {
        // Validate the input value as a date
        if (!strtotime($value)) {
            return false;
        }

        // Extract parameters
        $limitMonths = $params;

        // Validate the limit as a positive integer
        if (!ctype_digit($limitMonths) || intval($limitMonths) <= 0) {
            return false;
        }

        $startDate = $data['tanggal_mulai'];

        // Validate the start date as a valid date
        if (!strtotime($startDate)) {
            return false;
        }

        // Calculate the end date by adding the limit months to the start date
        $endDate = (new DateTime($startDate))->modify('+' . $limitMonths . ' months')->format('Y-m-d');

        // Check if the input value falls within the calculated end date
        return strtotime($value) <= strtotime($endDate);
    }
}
