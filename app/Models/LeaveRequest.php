<?php

namespace App\Models;
use App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{     
      protected $guarded = [];

      protected $fillable = [
        'reason',
        'leave_type',
        'date',
        'employee_id',
        ];

      public function employee()
      
      { 
        return $this->belongsTo(Employee::class);

    }
}
