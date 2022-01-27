<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRemark extends Model
{
    use HasFactory;
    // protected $table='loan_remarks';
    public function users(){
        return $this->hasMany(User::class);
    }
}
