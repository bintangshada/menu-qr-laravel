<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuImage extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'image_path'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}

