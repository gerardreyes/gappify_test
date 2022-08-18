<?php

class TransactionController extends BaseController {

    public function insert() {
        if (Auth::attempt(Input::only('username', 'password'))) {
            return Redirect::to('home');
        }
        return Redirect::back()->withInput()->withErrors('Incorrect username & password combination');
    }

    public function destroy() {
        Auth::logout();
        return Redirect::to('home');
    }

    public function index() {
        $model_transaction = new TransactionModel();
        $array_main_data = $model_transaction->GET_DATA();
        return View::make('transactions')->with('array_main_data', $array_main_data);
    }

    public function store() {
        $model_transaction = new TransactionModel();
        $model_transaction->insert();
        return Redirect::to('transactions');
    }

}
