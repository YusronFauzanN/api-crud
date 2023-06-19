<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price'];

    public function camp_benefit()
    {
        return $this->hasMany(CampBenefit::class);
    }
}
