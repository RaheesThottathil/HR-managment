<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'employee_code',
        'phone',
        'address',
        'aadhar_no',
        'joining_date',
        'qr_token',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsToMany(Site::class, 'employee_site', 'employee_id', 'site_id');
    }
}
