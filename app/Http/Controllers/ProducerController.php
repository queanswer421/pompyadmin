<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Http\Resources\ProducerResource;


class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProducerResource::collection(Producer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProducerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producers = Producer::create([
            'name' => $request->name,
            'email' => $request->email,
          ]);
    
          return new ProducerResource($producers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function show(Producer $producer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProducerRequest  $request
     * @param  \App\Models\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProducerRequest $request, Producer $producer)
    {
        $producer->update($request->all());
        $producer->save();
          
        return new ProducerResource($producer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producer $producer)
    {
        $producer->delete();
        return response(null, 204);
    }
}
