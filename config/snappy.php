<?php

return array(


    'pdf' => array(
        'enabled' => true,
        //'binary' => env('WKHTMLTOPDF', 'vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        //'binary'=>'C:\Program Files (x86)\wkhtmltopdf\bin',
        'binary'=> "\"C:\\Program Files (x86)\\wkhtmltopdf\\bin\\wkhtmltopdf.exe\"",
        'timeout' => false,
        'options' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => env('WKHTMLTOIMAGE','vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
         'binary'=> "\"C:\\Program Files (x86)\\wkhtmltopdf\\bin\\wkhtmltoimage.exe\"",
        'timeout' => false,
        'options' => array(),
    ),


);
