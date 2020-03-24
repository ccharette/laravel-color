<?php

Route::get('/colors', 'Gallea\Color\Tools\Ressources\ColorCategorieRessource@index');
Route::post('/color/categories', 'Gallea\Color\Tools\TestRunning@getCategories');