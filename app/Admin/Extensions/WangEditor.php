<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';

    protected static $css = [
        '/vendor/kindeditor/themes/default/default.css',
        '/vendor/kindeditor/plugins/code/prettify.css',
    ];

    protected static $js = [
        '/vendor/kindeditor/plugins/code/prettify.js',
        '/vendor/kindeditor/kindeditor-all.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);

        $this->script = <<<EOT
    window.editor = KindEditor.create('#{$this->id}',{
        uploadJson : '/vendor/kindeditor/php/upload_json.php',
        fileManagerJson : '/vendor/kindeditor/php/file_manager_json.php',
        filterMode:false,
    });
EOT;
        return parent::render();
    }
}