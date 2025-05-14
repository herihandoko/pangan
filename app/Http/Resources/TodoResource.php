<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id_kmd'         => $this->id_kmd,
            // 'title'      => $this->title,
            // // 'completed'  => (bool) $this->completed,
            // 'created_at' => $this->created_at->toIso8601String(),
            // 'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
