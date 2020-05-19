<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => asset('images/'. $this->image),
            'vuforia_id' =>  $this->vuforia_id ?? null,
            'created at' => $this->created_at,
            'updated at' => $this->updated_at,
        ];
    }
}
