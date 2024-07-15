<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_demandeur',
        'email',
        'id_service',
        'id_product',
        'description',
        'status',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

}
