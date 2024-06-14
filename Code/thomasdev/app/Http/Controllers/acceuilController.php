<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Annonce;
use App\Models\Communique;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class acceuilController extends Controller
{
    function home():View{
        $annonces = Annonce::all();
        $communique = Communique::all();
        return view('authentification.login',compact('annonces','communique'));
    }
    function contact():View{
        $annonces = Annonce::all();
        $communique = Communique::all();
        return view('contact',compact('annonces','communique'));
    }

    public function contactStore(Request $request){
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'msg'=> ['required', 'string'],
        ]);
        if($request->check){
            $user = ['email'=>$request->email, 'message'=> $request->msg];
            Mail::to('sawadogothomas107@gmail.com')->send(new ContactEmail($user));
            return redirect()->back()->with('success','Message envoyé avec succès!!!');

        }else{
            $contact = Contact::create([
                'email' => $request->email,
                'message'=> $request->msg,
            ]);
            return redirect()->back()->with('success','Message envoyé avec succès!!!');
        }
    }
}
