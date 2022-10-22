<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExistingCustomer;
use App\Http\Requests\StoreNewCustomer;
use App\Models\Customer;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_existing_customer()
    {
        return view('auth.create-existing-customer');
    }

    public function create_new_customer()
    {
        return view('auth.create-new-customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_new_customer(StoreNewCustomer $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype_id' => UserType::where('description', 'Cliente')->first()->id,
        ]);
        $customer = Customer::create([
            'dni' => $request->dni,
            'name' => $request->name,
            'lastName' => $request->lastName,
            'birthDate' => $request->birthDate,
            'address' => $request->address,
            'email' => $request->email,
            'user_id' => $user->id,
        ]);
        $data = [
            'user' => $user,
            'customer' => $customer,
        ];
        return $data;
    }
    public function store_existing_customer(StoreExistingCustomer $request)
    {
          $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype_id' => UserType::where('description', 'Cliente')->first()->id,
          ]);
        return $user;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function indexAdmin()
    {
        return view('indexAdmin');
    }
}
