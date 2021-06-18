<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra, HousingStatus};

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
            $extras[] = HousingExtra::getDescription($v);
        }
        $user = $request->user();
        $view_status = $user->favoriteHousings()->find($this->id);
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
            'special' => implode('、', $specials),
            'extra' => implode('、', $extras),
            'desc' => $this->desc,
            'bedroom_images' => $this->getImages($this->bedroom_images, '卧室'),
            'parlour_images' => $this->getImages($this->parlour_images, '客厅'),
            'kitchen_images' => $this->getImages($this->kitchen_images, '厨房'),
            'toilet_images' => $this->getImages($this->toilet_images, '公共卫生间'),
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'status' => HousingStatus::getDescription($this->status),
            'view_status' => ($view_status) ? 1 : 0
        ];
    }

    public function getImages($images, $name)
    {
        $num = 1;
        foreach ($images as $v) {
            $arr[] = [
                'id' => $num++,
                'name' => $name,
                'image' => Storage::url($v)
            ];
        }
        return $arr ?? [];
    }
}
