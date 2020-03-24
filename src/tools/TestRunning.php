<?php

namespace Gallea\Color\Tools;

use App\Http\Controllers\Controller;
use Gallea\Color\Tools\Convert;
use Gallea\Color\Tools\Ressources\ColorCategorieRessource;
use Gallea\Color\Models\ColorCategorie;
use Gallea\Color\Tools\Categorie;
use Illuminate\Http\Request;

class TestRunning extends Controller
{
    public function getCategories(Request $request, Categorie $categorie)
    {

        $rgb = Convert::hexToRgb($request->hex);
        var_dump($rgb);
        
        //ColorCategorie::truncate();
        //ColorCategorieRessource::store(config('colors.categories'));
        $categories = $categorie->getCategories($rgb);

        $hex = $request->hex;
        $hexCategorie = $categories->hex;

        return view('color::color-test', compact('hex', 'hexCategorie'));
        dd($categories);
    }
}
