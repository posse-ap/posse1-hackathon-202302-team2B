<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryAddress;
use App\Http\Requests\DeliveryAddress\CreateFormRequest;

class DeliveryAddressController extends Controller
{
    public function index()
    {
        $delivery_addresses = DeliveryAddress::where('user_id', Auth::id())->get();

        return view('delivery.address.index', compact('delivery_addresses'));
    }

    public function showCreateForm()
    {
        return view('delivery.address.create');
    }

    public function create(CreateFormRequest $request)
    {
        DeliveryAddress::create([
            'user_id'     => Auth::id(),
            'name'        => $request->input('name'),
            'tel'         => $request->input('tel'),
            'sort_number' => 999,
            'postal_code' => $request->input('postal_code'),
            'prefecture'  => '東京都',
            'city'        => $request->input('city'),
            'address_1'   => $request->input('address_1'),
            'address_2'   => $request->input('address_2'),
        ]);

        return redirect()
                ->route('delivery-address')
                ->with([
                    'flush.message'    => '配送先の追加が完了しました',
                    'flush.alert_type' => 'success',
                ]);
    }
}
