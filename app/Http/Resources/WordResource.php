<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordResource extends JsonResource
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
            'word' => $this->word,
            'ar_translation' => $this->ar_translation,
            'en_translation' => $this->en_translation,
            'added_by' => $this->whenLoaded('user')?->name,
            'language_level' => $this->whenLoaded('languageLevel')?->level,
            'type' => $this->whenLoaded('type')?->type,
        ];
    }
}
