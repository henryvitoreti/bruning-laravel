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
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'mother_name' => $this->mother_name,
            'father_name' => $this->father_name,
            'document' => $this->document_formatted,
            'birth_date' => $this->birth_date_formatted,
            'role' => $this->role,
        ];
    }
}
