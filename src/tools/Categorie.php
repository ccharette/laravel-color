<?php

namespace Gallea\Color\Tools;

use Illuminate\Support\Arr;
use Gallea\Color\Models\ColorCategorie;

class Categorie
{
    protected $categories; // all categories in database
    public $rgb; // Array RGB
    public $red; // Red color
    public $green; // Green color
    public $blue; // Blue color

    public function __construct()
    {
        $this->categories = ColorCategorie::all();
    }
    /**
     * Get the most similar color
     * 
     * @param Array $colorRGB color to search
     */
    public function getCategories ($colorRGB) 
    {
        $this->rgb = Arr::sort($colorRGB);
        $this->red = $colorRGB['red'];
        $this->green = $colorRGB['green'];
        $this->blue = $colorRGB['blue'];

        $max = array_keys($colorRGB, max($colorRGB)); // Max color

        // Black to white
        /*if (max($this->rgb) <= 32 
            || abs($this->red - $this->green)<= 10 
            && abs($this->red - $this->blue) <= 10 
            && abs($this->green - $this->blue) <= 10) { 
                
                $categorie = $this->getWhitetoBlack(); 
        }*/

        // Black to white
        if (max($this->rgb) <= 32 
            || $this->red === $this->green && $this->red === $this->blue){
                $categorie = $this->getWhitetoBlack(); 
        }

        // Red dominance
        elseif ($max[0] === 'red') {
            $categorie = $this->dominanceRed();
        }
        // Green dominance
        else if ($max[0] === 'green') {
            $categorie = $this->dominanceGreen();
        }
        // Blue dominance
        else if ($max[0] === 'blue') {
            $categorie = $this->dominanceBlue();
        }

        return ColorCategorie::find($categorie);



        /*$max = array_keys($colorRGB, max($colorRGB));
        var_dump($max);

    
        $RvsG = abs($colorRGB['red'] - $colorRGB['green']); // Red vs Green
        $RvsB = abs($colorRGB['red'] - $colorRGB['blue']); // Red vs Blue
        $GvsB = abs($colorRGB['green'] - $colorRGB['blue']); // Green vs Blue
    
        if ($RvsG <= 10 && $RvsB <= 10 && $GvsB <= 10) { Categorie::getWhitetoBlack($colorRGB); } // Black to white
        else if (in_array('red', $max, true)) { Categorie::dominanceRed($colorRGB); }*/
    }
    
    /**
     * Find red dominance category
     *
     * @return Integer Category id
     */
    public function dominanceRed() {
        if ($this->green === $this->blue) return 5; // red
        else if ($this->blue > $this->green) {
            if ($this->red === $this->blue) return 14; // violet
            else return 4; // pink
        } 
        else if ($this->red === $this->green) { 
            if ($this->green <= 128) return 10; // green
            else return 8; // yellow
        }
        else if ($this->green > $this->blue && $this->red === 255 && $this->green < 165) return 6; // orange
        else return 7; // brown
    }
        
    /**
     * Find green dominance category
     *
     * @return Integer Category id
     */
    public function dominanceGreen() {
        if ($this->blue < 50 && $this->green > 200) return 9; // yellow-green
        else if ($this->blue > $this->red && $this->blue > 128) return 11; // blue-green
        else return 10; // green
    }
        
    /**
     * Find blue dominance category
     *
     * @return Integer Category id
     */
    public function dominanceBlue() {
        if ($this->green > $this->red && $this->blue - $this->green < 64) return 12; // blue-1
        if ($this->green < $this->red) return 14; // purple
        else return 13; // blue-2
    }
    
    /**
     * Category black to white 
     * (3 equal color)
     *
     * @return Integer Category id
     */
    public function getWhitetoBlack() {
        if (max($this->rgb) <= 32) return 3; // 0 to 32
        elseif (max($this->rgb) > 32 && max($this->rgb) < 223) return 2; // 32 to 223
        elseif (min($this->rgb) === 255) return 1; // 223 to 255
    }
}



?>