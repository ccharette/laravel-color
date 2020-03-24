<?php

namespace Gallea\Color\Models;

use Illuminate\Database\Eloquent\Model;

class ColorCategorie extends Model
{
    public $fillable = ['hex', 'red', 'green', 'blue'];
}
