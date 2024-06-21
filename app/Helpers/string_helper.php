<?php
if (!function_exists('transliterate')) {
    function transliterate($text): string
    {
        $translitMap = [
            'q' => 'й', 'w' => 'ц', 'e' => 'у', 'r' => 'к', 't' => 'е', 'y' => 'н', 'u' => 'г', 'i' => 'ш', 'o' => 'щ', 'p' => 'з',
            '[' => 'х', ']' => 'ъ', 'a' => 'ф', 's' => 'ы', 'd' => 'в', 'f' => 'а', 'g' => 'п', 'h' => 'р', 'j' => 'о', 'k' => 'л',
            'l' => 'д', ';' => 'ж', "'" => 'э', 'z' => 'я', 'x' => 'ч', 'c' => 'с', 'v' => 'м', 'b' => 'и', 'n' => 'т', 'm' => 'ь',
            ',' => 'б', '.' => 'ю', '/' => '.',
            'Q' => 'Й', 'W' => 'Ц', 'E' => 'У', 'R' => 'К', 'T' => 'Е', 'Y' => 'Н', 'U' => 'Г', 'I' => 'Ш', 'O' => 'Щ', 'P' => 'З',
            '{' => 'Х', '}' => 'Ъ', 'A' => 'Ф', 'S' => 'Ы', 'D' => 'В', 'F' => 'А', 'G' => 'П', 'H' => 'Р', 'J' => 'О', 'K' => 'Л',
            'L' => 'Д', ':' => 'Ж', '"' => 'Э', 'Z' => 'Я', 'X' => 'Ч', 'C' => 'С', 'V' => 'М', 'B' => 'И', 'N' => 'Т', 'M' => 'Ь',
            '<' => 'Б', '>' => 'Ю', '?' => ','
        ];

        // Инвертируем массив для обратного преобразования
        $reverseTranslitMap = array_flip($translitMap);

        // Объединяем массивы
        $translitMap = array_merge($translitMap, $reverseTranslitMap);

        return strtr($text, $translitMap);
    }
}

if (!function_exists('translate')) {
    function translate(string $key, string $lang): string
    {
        try {
            $langFilePath = base_path("lang/{$lang}.json");
            $fileContent = @file_get_contents($langFilePath);

            // Файл не найден
            if ($fileContent === false) {
                return $key;
            }
            $translations = json_decode($fileContent, true);

            // Перевод для ключа
            return $translations[$key] ?? $key;
        } catch (\Throwable $e) {
            return $key;
        }
    }
}

if (!function_exists('getStringBetween')) {
    function getStringBetween(string $string, string $start, string $end): string
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}

if (!function_exists('generateCode')) {
    function generateCode(): string
    {
        $arrText = [
            "AA", "BB", "CC", "DD", "EE", "FF", "KK", "LL", "II", "MM"
        ];

        return $arrText[rand(0, 9)] . rand(1000, 9999);
    }
}

if (!function_exists('formatDateFromCalendar')) {
    function formatDateFromCalendar(?string $date): string|null
    {
        return !empty($date) ? date('Y-m-d H:i:s', strtotime($date)) : null;
    }
}

if (!function_exists('phoneToDBFormat')) {
    function phoneToDBFormat($phone): string
    {
        $phone = preg_replace('/[^[:digit:]]/', '', $phone);
        if (str_starts_with($phone, '8')) $phone = '7'.substr($phone, 1);
        return $phone;
    }
}

if (!function_exists('phoneMask')) {
    function phoneMask($phone): string
    {
        if (empty($phone)) return '';
        preg_match('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', $phone, $matches);
        return "+{$matches[1]} ({$matches[2]}) {$matches[3]}-{$matches[4]}-{$matches[5]}";
    }
}
