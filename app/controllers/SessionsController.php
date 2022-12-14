<?php

class SessionsController extends BaseController {

    public function create() {
        if (Auth::check()) {
            return Redirect::to('add');
        }
        return View::make('sessions.create');
    }

    public function store() {
        if (Auth::attempt(Input::only('username', 'password'))) {
            return Redirect::to('home');
        }
        return Redirect::back()->withInput()->withErrors('Incorrect username & password combination');
    }

    public function destroy() {
        Auth::logout();
        return Redirect::to('home');
    }

}
