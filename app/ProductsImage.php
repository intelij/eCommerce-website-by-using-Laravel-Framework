<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    // Table Name
    protected $table = 'products_images';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
