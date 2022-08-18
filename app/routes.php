<?php

//Company Add, Edit, and Delete
Route::get('add_company', function() {
    return View::make('AddCompany');
})->before('auth');

Route::get('edit_company/{id_company?}', function($id_company) {
    $model_home = new HomeModel();
    $array_data = $model_home->get_using_id($id_company);
    return View::make('EditCompany')->with('array_data', $array_data);
})->before('auth');

Route::get('api/delete_company', function() {
    $model_home = new HomeModel();
    return $model_home->delete_id();
});

//Transactions Add, Edit, and Delete
Route::get('add_transaction', function() {
    $model_transaction = new TransactionModel();
    $array_company_name = $model_transaction->GET_COMPANY_LIST();
    $array_company_name[''] = '';
    asort($array_company_name);
    return View::make('AddTransaction')->with('array_company_name', $array_company_name);
})->before('auth');

Route::get('edit_transaction/{id_transaction?}', function($id_transaction) {
    $model_transaction = new TransactionModel();
    $array_data = $model_transaction->get_using_id($id_transaction);
    $array_company_name = $model_transaction->GET_COMPANY_LIST();
    return View::make('EditTransaction')->with('array_data', $array_data)->with('array_company_name', $array_company_name);
})->before('auth');

Route::get('api/delete_transaction', function() {
    $model_transaction = new TransactionModel();
    return $model_transaction->delete_id();
});

Route::get('login', 'SessionsController@create');

Route::get('logout', 'SessionsController@destroy');

Route::resource('home', 'HomeController');

Route::resource('transactions', 'TransactionController');

Route::resource('sessions', 'SessionsController');

Route::resource('transactions', 'TransactionController');

Route::get('/', function() {
    return View::make('hello');
});

Route::get('/initialize', function() {
    $array_insert = array();
    Schema::dropIfExists('transactions');
    Schema::dropIfExists('companies');
    Schema::create('companies', function($table) {
        $table->increments('id_company');
        $table->char('company_name', 100);
        $table->text('remarks');
        $table->date('date_established');
    });
    $array_insert[] = array('company_name' => 'Gerard Store', 'remarks' => 'My first store', 'date_established' => '2021-07-01');
    $array_insert[] = array('company_name' => 'Jerome Store', 'remarks' => 'My second store', 'date_established' => '2021-07-02');
    $array_insert[] = array('company_name' => 'Reyes Store', 'remarks' => 'My third store', 'date_established' => '2021-07-03');
    DB::table('companies')->insert($array_insert);

    $array_insert = array();
    Schema::create('transactions', function($table) {
        $table->increments('id_transaction');
        $table->integer('id_company')->unsigned();
        $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade');
        $table->char('transaction_name', 100);
        $table->text('remarks');
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    });
    $array_insert[] = array('id_company' => 1, 'transaction_name' => 'Buy', 'remarks' => 'Gerard Store Transaction 1');
    $array_insert[] = array('id_company' => 1, 'transaction_name' => 'Sell', 'remarks' => 'Gerard Store Transaction 2');
    $array_insert[] = array('id_company' => 2, 'transaction_name' => 'Buy', 'remarks' => 'Jerome Store Transaction 1');
    $array_insert[] = array('id_company' => 2, 'transaction_name' => 'Sell', 'remarks' => 'Jerome Store Transaction 2');
    $array_insert[] = array('id_company' => 3, 'transaction_name' => 'Buy', 'remarks' => 'Reyes Store Transaction 2');
    $array_insert[] = array('id_company' => 3, 'transaction_name' => 'Sell', 'remarks' => 'Reyes Store Transaction 2');
    DB::table('transactions')->insert($array_insert);

    Schema::dropIfExists('users');
    Schema::create('users', function($table) {
        $table->increments('id');
        $table->char('username', 60);
        $table->char('password', 60);
        $table->char('access', 1);
        $table->timestamps();
        $table->rememberToken();
        $table->unique('username');
    });
    User::create(['username' => 'admin', 'access' => 1, 'password' => Hash::make('admin')]);
    User::create(['username' => 'gerard', 'access' => 1, 'password' => Hash::make('gerard')]);
    User::create(['username' => 'user', 'access' => 0, 'password' => Hash::make('user')]);
    return 'OK';
});
