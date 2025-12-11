<?php

namespace App\Models;

use App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'address',
        'epf_number',
        'designation',
        'annual_leave_count',
        'casual_leave_count',
        'image'
    ];
    //relationshipleave request

    public function user()

    {
        return $this->belongsTo(User::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
