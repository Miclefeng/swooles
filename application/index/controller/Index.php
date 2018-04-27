<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        echo 'Miclefeng__'.$_GET['name'];
    }

    public function hello()
    {
        return "Hello {$_GET['name']}";
    }
}
