<?php

use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Admin\Extensions\WangEditor;
use App\Admin\Actions\Post\Restore;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map']);

Form::extend('editor', WangEditor::class);

// 表格初始化
Grid::init(function (Grid $grid) {
    $grid->disableRowSelector();
    $grid->actions(function (Grid\Displayers\Actions $actions) {
        $actions->disableView();
        if (\request('_scope_') == 'trashed') {
            $actions->add(new Restore());
        }
    });
});

// 表单初始化
Form::init(function (Form $form) {
    $form->tools(function (Form\Tools $tools) {
        // 去掉`查看`按钮
        $tools->disableView();
    });

    $form->footer(function ($footer) {
        // 去掉`查看`checkbox
        $footer->disableViewCheck();
    });
});