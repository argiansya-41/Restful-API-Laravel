<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HasilPanenResource extends JsonResource
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
            'commodity' => strtoupper($this->nama_komoditas), // Transformasi data
            'weight' => $this->jumlah_kg . ' kg',
            'harvested_at' => $this->tanggal_panen,
            'created_format' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
