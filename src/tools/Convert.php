<?php

namespace Gallea\Color\Tools;

class Convert
{
    /**
     * Get the RGB value
     * 
     * @param string $colorHEX Color code in HEX format (with '#')
     * @return array RGB value
     */
    static function hexToRgb ($colorHEX){
    
        $unit = str_split($colorHEX); // Array contain each character
        unset($unit[0]); // Remove the "#" character
        $unit = array_values($unit); // Reset index

        return [
            "red" => hexdec($unit[0].$unit[1]),
            "green" => hexdec($unit[2].$unit[3]),
            "blue" => hexdec($unit[4].$unit[5])
        ];
    }
}
