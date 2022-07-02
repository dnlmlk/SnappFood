<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use function Sodium\add;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(AddressResource::collection(User::find(auth()->user()->id)->addresses));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $address = User::find(auth()->user()->id)->addresses()->create([
            'title' => $fields['title'],
            'address' => $fields['address'],
            'latitude' => $fields['latitude'],
            'longitude' => $fields['longitude'],
        ]);

        return response(['Your address is submitted successfully', new AddressResource($address)]);
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
        $address = Address::find($id);
        $gate = Gate::allows('view', $address);

        if ($gate){
            $request->validate([
                'title' => 'string',
                'address' => 'string',
                'latitude' => 'numeric',
                'longitude' => 'numeric',
            ]);
            $address->update($request->all());
            return response(['Your address is updated successfully', new AddressResource($address)]);
        }

        return response("You don't have access", 403);
    }

    /**
     * Set location the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setActiveAddress($id)
    {
        $address = Address::find($id);
        $gate = Gate::allows('view', $address);

        if ($gate) {
            $addresses = User::find(auth()->user()->id)->addresses;
            foreach ($addresses as $address) {
                if ($address->id == $id) $address->update(['active' => '1']);
                else $address->update(['active' => '0']);
            }

            return response(['Your main address is updated', AddressResource::collection(User::find(auth()->user()->id)->addresses)]);
        }

        return response("You don't have access", 403);
    }
}
