<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HousingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'rent' => $this->rent,
            'floor' => $this->floor,
            'space' => $this->space,
            'type' => $this->type,
            'house_type' => $this->house_type,
            'toward' => $this->toward,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'address' => $this->address,
            'heating' => $this->heating,
            'special' => $this->special,
            'extra' => $this->extra,
            'desc' => $this->desc,
            'image' => $this->image
        ];
    }
}