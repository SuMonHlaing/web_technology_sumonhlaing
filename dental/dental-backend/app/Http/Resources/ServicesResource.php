<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\DoctorsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
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
            'name' => $this->name ?? 'N/A',
            'description' => $this->description ?? 'N/A',
            'icon' => $this->icon ? asset('storage/' . $this->icon) : null,
            'doctors' => DoctorsResource::collection($this->whenLoaded('doctors')),

            // 'doctor_name' => $this->doctor->name ?? 'N/A',
            // 'doctor_id' => $this->doctor_id,
            // 'doctor' => new DoctorsResource($this->doctor)
        ];
    }
}
