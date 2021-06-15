<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

class ArticlesController extends AdminController
{
    protected $title = '文章';

    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->filter(function($filter){
            $filter->like('title', '名称');
            // 范围过滤器，调用模型的`onlyTrashed`方法，查询出被软删除的数据。
            $filter->scope('trashed', '回收站')->onlyTrashed();
        });

        $grid->id('ID')->sortable();
        $grid->title('名称')->editable()->copyable();
        
        
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Article());
        $form->text('id', 'ID')->rules('required');
        $form->text('title', '名称')->rules('required');
        $form->editor('desc', '内容')->rules('required');

        return $form;
    }
}