<?php


	namespace App\Utilities;


	use App\Models\Post;
    use Carbon\Carbon;
    use Str;

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

        public function ShortenDate($date_string) {
            $date = Carbon::parse($date_string);
            $value = '';
            $years = $date->diff(Carbon::now())->format('%y');
            if ($years > 0) {
                $value .= $years . 'y';
            }
            $months = $date->diff(Carbon::now())->format('%m');
            if ($months > 0) {
                $value .= ' ' . $months . 'm';
            }
            $days = $date->diff(Carbon::now())->format('%d');
            if ($days > 0) {
                $value .= ' ' . $days . 'd';
            }
            return empty($value) ? 'Today' : $value;
        }

        public function GenerateUniqueSlug($title) {
            $slug = Str::slug($title);
            $counter = 1;
            while(Post::where('slug', $counter > 1 ? $slug . '-' . $counter : $slug)->exists()) {
                $counter++;
            }
            return $slug . '-' . $counter;
        }
	}
