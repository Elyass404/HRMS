<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;


class ContractType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function annonces(){
        return $this->hasMany(User::class);
    }
}
