<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\helpers;

use DateTime;

class PolishDateTime extends DateTime
{
    protected $translation = [
        "Jan" => "Styczeń",
        "Feb" => "Luty",
        "Mar" => "Marzec",
        "Apr" => "Kwiecień",
        "May" => "Maj",
        "Jun" => "Czerwiec",
        "Jul" => "Lipiec",
        "Aug" => "Sierpień",
        "Sep" => "Wrzesień",
        "Oct" => "Październik",
        "Nov" => "Listopad",
        "Dec" => "Grudzień"
    ];

    public function format($format)
    {
        $engDate = parent::format($format);

        return str_replace(array_keys($this->translation), array_values($this->translation), $engDate);
    }
}
