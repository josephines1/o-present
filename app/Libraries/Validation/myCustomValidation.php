<?php

namespace App\Libraries\Validation;

use DateTime;

class myCustomValidation
{
    public function daysAfter($value, string $params, array $data, ?string &$error = null): bool
    {
        // Validate the input value as a date
        if (!strtotime($value)) {
            return false;
        }

        if ($data['tanggal_mulai'] > $data['tanggal_berakhir']) {
            $error = "Tanggal mulai harus lebih awal dari tanggal selesai.";
            return false;
        }

        // Extract parameters
        $limitMonths = $params;

        // Mendapatkan tanggal hari ini
        $tanggal_sekarang = date('Y-m-d');

        // Cek Tipe Ketidakhadiran
        // Jika Izin/Sakit (Ketidakhadiran Mendadak)
        if ($data['tipe_ketidakhadiran'] != 'CUTI') {
            if ($data['tipe_ketidakhadiran'] == 'IZIN') {
                /*
                * Izin dapat diajukan pada hari yang sama dan bebas memilih hari di masa depan
                */
                if ($value < $tanggal_sekarang) {
                    $error = "Tidak dapat mengajukan izin untuk tanggal kemarin atau sebelumnya.";
                    return false;
                } else {
                    return true;
                }
            } else if ($data['tipe_ketidakhadiran'] == 'SAKIT') {
                /*
                * Sakit dapat diajukan pada hari yang sama 
                * atau H-1 (hari sebelumnya)
                */
                if ($value < $tanggal_sekarang) {
                    $error = "Tidak dapat mengajukan izin karena sakit untuk tanggal kemarin atau sebelumnya.";
                    return false;
                } else if ($value != $tanggal_sekarang && $value != date('Y-m-d', strtotime($tanggal_sekarang . ' -1 day'))) {
                    $error = "Tanggal mulai tidak hadir karena sakit hanya dapat hari ini atau besok.";
                    return false;
                } else {
                    return true;
                }
            }
        }

        // Menambahkan 3 hari ke dalam tanggal hari ini
        $tanggal_batas = date('Y-m-d', strtotime($tanggal_sekarang . ' +' . $limitMonths . 'days'));

        // Memeriksa apakah tanggal cuti kurang dari 3 hari dari hari ini
        if ($value < $tanggal_batas) {
            $error = "Pengajuan cuti harus minimal 3 hari sebelum tanggal yang diinginkan.";
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

    public function valid_timezone($value): bool
    {
        return in_array($value, timezone_identifiers_list());
    }
}
