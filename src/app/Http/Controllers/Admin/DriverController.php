<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::where('role_id',3)->get();

        return view('admin/drivers/index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/drivers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driver=new User;

        $driver->name=$request->input('name');
        $driver->email=$request->input('email');
        $driver->password=Hash::make($request->password);
        $driver->company_name=$request->input('company_name');
        $driver->role_id=$request->input('role_id');

        $driver->save();

        return redirect('admin/drivers');
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
        $driver=User::find($id);

        return view('admin/drivers/edit', compact('driver'));
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
        $driver=User::find($id);

        $driver->name=$request->input('name');
        $driver->company_name=$request->input('company_name');
        $driver->email=$request->input('email');

        //DBに保存
        $driver->save();

        return redirect('admin/drivers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver=User::find($id);

        $driver->delete();

        return redirect('admin/drivers');
    }
}
