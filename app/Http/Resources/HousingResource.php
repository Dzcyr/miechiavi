<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra};

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
        $specials = [];
        foreach ($this->special as $v) {
            $specials[] = HousingSpecial::getDescription($v);
        }
        $extras = [];
        foreach ($this->extra as $v) {
            $extras[] = HousingSpecial::getDescription($v);
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'rent' => $this->rent,
            'floor' => $this->floor,
            'space' => $this->space,
            'type' => HousingType::getDescription($this->type),
            'house_type' => HousingHouseType::getDescription($this->house_type),
            'toward' => HousingToward::getDescription($this->toward),
            'province' => config('position.province.' . $this->province),
            'city' => config('position.city.' . $this->province . '.' . $this->city),
            'district' => config('position.district.' . $this->city . '.' . $this->district),
            'address' => $this->address,
            'heating' => HousingHeating::getDescription($this->heating),
            'special' => implode(',', $specials),
            'extra' => implode(',', $extras),
            'desc' => $this->desc,
            'bedroom_images' => $this->getImages($this->bedroom_images),
            'parlour_images' => $this->getImages($this->parlour_images),
            'kitchen_images' => $this->getImages($this->kitchen_images),
            'toilet_images' => $this->getImages($this->toilet_images),
        ];
    }

    public function getImages($images)
    {
        foreach ($images as $v) {
            $arr[] = Storage::url($v);
        }
        return $arr ?? [];
    }
}