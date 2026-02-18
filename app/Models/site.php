<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';
    protected $primaryKey = 'id';
    protected $fillable = [
        'site_name',
        'client_name',
        'location',
        'date',
        'number_of_employees',
        'shift',
        'reporting_time',
        'status',
    ];

    public function employee()
    {
        return $this->belongsToMany(Employee::class, 'employee_site', 'site_id', 'employee_id');
    }
}
