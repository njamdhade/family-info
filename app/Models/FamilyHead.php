<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHead extends Model
{
    use HasFactory;
        protected $fillable = [
        'name','surname','birth_date','mobile_no',
        'address','state','city','pincode',
        'marital_status','wedding_date','hobbies','photo'
    ];

    protected $cast =[
        'hobbies'=>'array',
        'birth_date'=>'date',
        'wedding_date'=>'date',
    ];

    public function familyMembers(){
        return $this->hasMany(FamilyMember::class);
    }
}
