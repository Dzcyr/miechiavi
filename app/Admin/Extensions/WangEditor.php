<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';

    protected static $js = [
        'https://unpkg.com/wangeditor/dist/wangEditor.min.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);

        $this->script = <<<EOT
var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.config.zIndex = 0;
editor.config.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('input[name="_token"]').val()
}
editor.config.uploadImgServer = '/admin/editor/image';
editor.config.uploadFileName = 'image';
editor.config.onchange = function (html) {
    $('input[name=$name]').val(html);
}
editor.config.uploadImgHooks = {
    // 图片上传并返回了结果，但图片插入时出错了
    fail: function(xhr, editor, resData) {
        toastr.error(resData.msg)
    }
}
editor.create();
EOT;
        return parent::render();

    }
}
