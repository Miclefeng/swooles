<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return 'miclefengzss';
    }

    public function hello($name = 'miclefengzss')
    {
        return "Hello {$name}";
    }
}
