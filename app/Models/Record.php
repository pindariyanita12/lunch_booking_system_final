<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
       'email',
       'guests',
       'is_taken'
        ];
        public function user(){
            return $this->belongsTo(User::class,'email','email');
        }

}
