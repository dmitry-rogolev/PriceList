<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        "name", 
        "measure", 
        "price", 
        "count", 
    ];

    public function toSearchableArray()
    {
        return [
            "name" => $this->name, 
        ];
    }
}
