<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Housing;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\InfoBox;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('首页')
            ->row(view('admin.home.title'))
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $column->append($this->InfoBox('用户数量', 'users', 'aqua', '/admin/users', User::get()->count()));
                });
                $row->column(4, function (Column $column) {
                    $column->append($this->InfoBox('房源数量', 'housings', 'red', '/admin/housings', Housing::get()->count()));
                });
            });
    }

    public function InfoBox($title, $icon, $color, $href, $data)
    {
        // 参数1为标题 参数2为图标 参数3为颜色 参数4为跳转链接 参数5为数据
        $infoBox = new InfoBox($title, $icon, $color, $href, $data);
        return $infoBox->render();
    }
}