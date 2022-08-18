<?php

class HomeController extends BaseController {

    public function index() {
        $model_home = new HomeModel();
        $array_main_data = $model_home->GET_DATA();
        return View::make('home')->with('array_main_data', $array_main_data);
    }

    public function store() {
        $model_home = new HomeModel();
        $model_home->insert();
        return Redirect::to('home');
    }

}
