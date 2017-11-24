<?php
namespace app\index\controller;

use app\common\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    public function index()
    {
        return view('index/index');
    }
}
