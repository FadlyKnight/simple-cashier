<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    // BETTER CHANGE TO FILLABLE FOR MORE SECURITY
    protected $guarded = [];
}
