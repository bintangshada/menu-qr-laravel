<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'qr_code_path',
    ];
    
    public function images()
    {
        return $this->hasMany(MenuImage::class);
    }
}

