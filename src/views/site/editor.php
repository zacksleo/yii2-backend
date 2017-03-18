<?php

use zacksleo\yii2\ueditor\assets\EditorXiumiAsset;

EditorXiumiAsset::register($this);

$this->registerJsFile('/admin/ueditor/xiumi/script', [
    'depends' => [
        'kucha\ueditor\UeditorAsset'
    ]
]);

echo \kucha\ueditor\UEditor::widget([
    'name' => 'ueditor',
    'clientOptions' => [
        //编辑区域大小
        'initialFrameHeight' => '200',
        //设置语言
        'lang' => 'zh-cn', //中文为 zh-cn
        'zIndex' => '9995',
        //定制菜单
        'toolbars' => [
            [
                'fullscreen', 'source', 'undo', 'redo', '|',
                'fontsize',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                'forecolor', 'backcolor', '|',
                'lineheight', '|',
                'indent', '|', '135editor'
            ],
        ]
    ]
]);
