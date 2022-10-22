<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExistingCustomer;
use App\Http\Requests\StoreNewCustomer;
use App\Http\Requests\StoreSeller;
use App\Models\Customer;
use App\Models\Seller;
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
    // CUSTOMER
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
        $user = $this->createUser($request->email, $request->password, 'Cliente');
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
        $user = $this->createUser($request->email, $request->password, 'Cliente');
        return $user;
    }
    // SELLER
    public function create_seller()
    {
        return view('auth.create-seller-account');
    }
    public function store_seller(StoreSeller $request)
    {
        $user = $this->createUser($request->email, $request->password, 'Vendedor');
        $seller = Seller::create([
            'dni' => $request->dni,
            'name' => $request->name,
            'lastName' => $request->lastName,
            'user_id' => $user->id,
        ]);
        return ['user' => $user, 'seller' => $seller];
    }
    private function createUser($email, $password, $userType)
    {
        return User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'usertype_id' => UserType::where('description', $userType)->first()->id,
        ]);
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
