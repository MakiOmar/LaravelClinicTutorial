<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient_doctor_rel extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';
    protected $table      = 'patient_doctor_rel';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = array(
        'doctor_id',
        'patient_id',
        'stage',
        'diagnose',
        'details',
        'prescription',
    );
}
