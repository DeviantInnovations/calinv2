<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    if(Auth::check())
    	return Redirect::to("/home");
    else
		return Redirect::to("/login");
});


Route::get('/home', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('home', 1);
		$user = User::find(Auth::user()->id);


		$transactions = DB::table('transactions')->where("user_id", Auth::user()->id)->orderBy('updated_at', 'DESC')
	            ->paginate(10);
      	
		return View::make('members.home')->with('user', $user)->with('transactions', $transactions);
	}
});


Route::get('/register', function()
{

	return View::make('register');

});
Route::post('register', array('uses' => 'AuthController@register', 'as'=>'register'));

Route::get('/login', function()
{
	 if(Auth::check())
    	return Redirect::to("/home");

	return View::make('login');
});

Route::post('login', array('uses' => 'AuthController@login', 'as'=>'login'));

Route::get('logout', array('uses' => 'AuthController@logout', 'as'=>'logout'));


Route::group(['prefix' => 'admin'],  function() 
{

Route::get('/developertools', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('developertools', 1);
		return View::make('inventory.developertools');
	}
})->before('admin');

Route::get('/fabrics/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = Fabric::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit fabric.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$fabric = Fabric::find($id);
		return View::make('inventory.edit_fabrics')->with('fabric', $fabric);
	}


})->before('admin');
Route::post('/fabrics/edit/{id}', array('uses' => 'FabricController@edit'))->before('admin');
Route::get('/fabrics', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$fabrics = DB::table('fabrics')
	            ->paginate(10);
	
		return View::make('inventory.fabrics')->with('fabrics', $fabrics);
	}
})->before('admin');
Route::post('/fabrics', array('uses' => 'FabricController@add', 'as'=>'fabrics'))->before('admin');
Route::get('/fabrics/delete/{id}', array('uses' => 'FabricController@delete'))->before('admin');
Route::post('/fabrics/rolls/add', array('uses' => 'FabricController@rollAdd', 'as' => '/admin/fabrics/rolls/add'))->before('admin');
Route::get('/fabrics/rolls/delete/{id}', array('uses' => 'FabricController@rollDelete'))->before('admin');

Route::get('/members', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$members = DB::table('users')->where('type', '!=', 0)
	            ->paginate(10);
	
		return View::make('inventory.members')->with('members', $members);
	}
})->before('admin');
Route::post('/members/edit/{id}', array('uses' => 'MemberController@edit'))->before('admin');
Route::get('/members/activate/{id}', array('uses' => 'MemberController@activate'))->before('admin');
Route::get('/members/deactivate/{id}', array('uses' => 'MemberController@deactivate'))->before('admin');
Route::get('/members/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = User::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit member.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$member = User::find($id);
		return View::make('inventory.edit_member')->with('member', $member);
	}


})->before('admin');


Route::get('/transactions', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		$transactions = DB::table('transactions')->orderBy('updated_at', 'DESC')
	            ->paginate(10);
	
		Session::put('transactions', 1);
		return View::make('inventory.transactions')->with('transactions', $transactions);
	}
})->before('admin');


});
Route::post('/edit/account', array('uses' => 'MemberController@editProfile', 'as'=>'/edit/account'));
Route::get('/edit/account', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('account', 1);
		 $exist = User::where('id', Auth::user()->id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit member.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$member = User::find(Auth::user()->id);
		return View::make('members.edit_profile')->with('member', $member);
	}


});
Route::post('/search', array('uses' => 'FabricController@search', 'as'=>'/search'));

Route::get('/search', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('search', 1);
      	$fabrics =  DB::table('fabrics')->orderBy('code', 'ASC')->paginate(10);
	
		return View::make('members.browse_inventory')->with('fabrics', $fabrics);
	}

});

Route::get('/transact/debit', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{	
		Session::put('debit', 1);
		return View::make('members.debit');
	}

})->before('auth');
Route::get('/transact/credit', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{	
		Session::put('credit', 1);
		return View::make('members.credit');
	}

})->before('auth');
Route::post('/transact/debit', array('uses' => 'FabricController@debit', 'as'=>'/transact/debit'));
Route::post('/transact/credit', array('uses' => 'FabricController@credit', 'as'=>'/transact/credit'));
Route::post('/resetpassword', array('uses' => 'MemberController@resetPassword', 'as'=>'/resetpassword'));
