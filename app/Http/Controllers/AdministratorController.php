<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Http\Requests\StoreAdministratorRequest;
use App\Http\Requests\UpdateAdministratorRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
        /**
     * Write code on Method
     *
     * @return response()
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'admin']);
            
            $admin = Administrator::select('administrators.*')->find(auth()->guard('admin')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('MyAdministrator',['admin'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard(){
    $data = [
        [
        'id'=> 1,
        'icon' => "mdi-sun-thermometer",
        'title' => "Pompy",
        'count' => \App\Models\Pump::all()->count()
        ],
        [
            'id' => 2,
            'icon' => "mdi-home-city",
            'title' => "Firmy",
            'count' => \App\Models\Company::all()->count()
        ],
        [
            'id' => 3,
            'icon' => "mdi-account-outline",
            'title' => "Pracownicy",
            'count' => \App\Models\Employer::all()->count()
        ],
        [
            'id' => 4,
            'icon' => "mdi-cog",
            'title' => "Producenci",
            'count' => \App\Models\Producer::all()->count()
        ]
    ];

        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "TEST OK";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdministratorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdministratorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdministratorRequest  $request
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdministratorRequest $request, Administrator $administrator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        //
    }
}
