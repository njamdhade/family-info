<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'family_head_id','name','m_birth_date','marital_status','wedding_date',
        'education', 'photo'
    ];
    protected $casts = [
        'm_birthdate' => 'date',
        'wedding_date' => 'date'
    ];
    public function familyHead(){
        return $this->belongsTo(FamilyHead::class,'family_head_id');
    }
}
