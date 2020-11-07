<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Contact;
use Illuminate\Support\Facades\Session;

Route::group(['middleware'=>'api'], function(){

    // GET ALL CONTACTS
    Route::get('contacts', function(){
        return Contact::latest()->orderBy('created_at', 'desc')->get();
    });


    // GET SINGLE CONTACT
    Route::get('contact/{id}', function($id){
        return Contact::findOrFail($id);
    });


    // POST REQUEST
    Route::post('contact/store', function(Request $request){

        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'note'=> 'required',
        ]);

        Contact::create( $request->all() );
        Session::flash('success', $request->name .' has been contacted successfully :)');
        return redirect('contacts');

    });



    // UPDATE REQUEST
    Route::patch('contact/{id}', function(Request $request, $id){
            $contact = Contact::findOrFail($id);

            $request->validate([
                'name'=> 'required',
                'email'=> 'required',
                'phone'=> 'required',
                'note'=> 'required',
            ]);

            $contact->update( $request->all() );
            Session::flash('success', $request->name . ' has been updated successfully :)');
            return redirect('contacts');

    });




    // DELETE REQUEST
    Route::delete('contact/{id}', function($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();

        Session::flash('success', 'Contact has been deleted successfully :)');
        return redirect('contacts');
    });

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
