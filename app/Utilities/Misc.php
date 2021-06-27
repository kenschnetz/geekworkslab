<?php


	namespace App\Utilities;


	class Misc {
        public function ShortenBigNumber($number): string {
            if ($number < 1000) {
                $formatted_value = number_format($number);
            } else if ($number < 1000000) {
                $formatted_value = number_format($number / 1000, 1) . 'k';
            } else if ($number < 1000000000) {
                $formatted_value = number_format($number / 1000000, 1) . 'm';
            } else if ($number < 1000000000000) {
                $formatted_value = number_format($number / 1000000000, 1) . 'b';
            } else {
                $formatted_value = number_format($number);
            }
            return $formatted_value;
        }
	}
