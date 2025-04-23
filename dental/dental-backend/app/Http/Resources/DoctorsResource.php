<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? 'N/A',
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'experience' => $this->experience ?? 'N/A',
            'phone' => $this->phone ?? 'N/A',
            'email' => $this->email ?? 'N/A',
            'location' => $this->location ?? 'N/A',
            'working_hours' => $this->working_hours ?? 'N/A',
            'certifications' => $this->certifications ?? 'N/A',
            'about' => $this->about ?? 'N/A',
        ];
    }
}
