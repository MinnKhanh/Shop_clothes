<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_detail';
    public function Img()
    {
        return $this->morphMany(Img::class, 'product', 'type');
    }
}
