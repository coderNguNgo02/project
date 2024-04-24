<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_size_detail';

    public function size()
    {
        return $this->belongsTo(Size::class, 'id_size', 'id_size');
    }
}
