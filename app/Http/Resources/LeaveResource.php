<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $employeeDetails = $this->employee;

        return [

            'id' => $this->id,
            'reason' => $this->reason,
            'date' => $this->date,
            'employee_details' => new EmployeeResource($employeeDetails),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
