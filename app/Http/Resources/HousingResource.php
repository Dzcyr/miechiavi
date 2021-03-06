<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra, HousingLease, HousingWithdraw, HousingCost, HousingStatus};

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
        $user = $request->user();
        $specials = [];
        foreach ($this->special as $v) {
            $specials[$v] = HousingSpecial::getDescription($v);
        }
        $extras = [];
        if(!empty($this->extra)) {
            foreach ($this->extra as $v) {
                $extras[$v] = HousingExtra::getDescription($v);
            }
        }
        $res = [
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
            'desc' => $this->desc,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'is_lease' => $this->is_lease,
            'is_withdraw' => $this->is_withdraw,
            'is_lease_word' => HousingLease::getDescription($this->is_lease),
            'is_withdraw_word' => HousingWithdraw::getDescription($this->is_withdraw),
            'begin_date' => $this->begin_date,
            'end_date' => $this->end_date,
            'cost' => $this->cost,
            'is_cost_word' => HousingCost::getDescription($this->cost),
        ];
        if (!$this->showInfoFields) {
            $res['extra'] = (!empty($this->extra)) ? implode('、', $extras) : '';
            $res['bedroom_images'] = $this->getImages($this->bedroom_images);
        }
        if ($this->showInfoFields) {
            $res['extra'] = (!empty($this->extra)) ? $this->format($extras) : [];
            $res['images'] = array_merge(
                $this->getImagesInfo($this->bedroom_images, '卧室'),
                $this->getImagesInfo($this->parlour_images, '客厅'),
                $this->getImagesInfo($this->kitchen_images, '厨房'),
                $this->getImagesInfo($this->toilet_images, '公共卫生间'),
            );
            $res['image_url'] = array_merge(
                $this->getImages($this->bedroom_images),
                $this->getImages($this->parlour_images),
                $this->getImages($this->kitchen_images),
                $this->getImages($this->toilet_images),
            );
            $res['status'] = HousingStatus::getDescription($this->status);
            $res['favorite_status'] = ($user && !empty($user->favoriteHousings()->find($this->id))) ? 1 : 0;
        }
        return $res;
    }

    public function showInfoFields()
    {
        $this->showInfoFields = true;

        return $this;
    }

    public function getImages($images)
    {
        foreach ($images as $v) {
            if ($v != 'others/empty.jpg') {
                $arr[] = Storage::url($v);
            }
        }
        return $arr ?? [];
    }

    public function getImagesInfo($images, $name)
    {
        $num = 1;
        foreach ($images as $v) {
            if ($v != 'others/empty.jpg') {
                $arr[] = [
                    'id' => $num++,
                    'name' => $name,
                    'image' => Storage::url($v)
                ];
            }
        }
        return $arr ?? [];
    }

    public function format($arr)
    {
        $res = [];
        if (!empty($arr)) {
            foreach ($arr as $k => $v) {
                $res[] = ['id' => $k, 'name' => $v, 'url' => HousingExtra::getIcon($k)];
            }
        }
        return ($res) ?? [];
    }
}
