<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [


            'designation' => $this->designation,
            'address' => $this->address,
            'epf_number' => $this->epf_number,
            'annual_leave_count' => $this->annual_leave_count,
            'casual_leave_count' => $this->casual_leave_count,


        ];
    }
}
