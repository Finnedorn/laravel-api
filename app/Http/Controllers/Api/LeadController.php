<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data= $request->all();
        $validator = Validator::make($data, [
            'name'=> 'required',
            'email'=> 'required | email',
            'address'=> 'required',
            'message'=> 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success'=>false,
                'errors'=> $validator->errors()
            ]);
        }


        $newLead= new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('info@boolpress.com')->send(new NewContact($newLead));

        // volendo posso aggiungere altre chiavi come results o altro per dare un messaggio
        return response()->json([
            'success'=> true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
