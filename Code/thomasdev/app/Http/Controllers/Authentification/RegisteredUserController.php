<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create():View {
        return view('authentification.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'min:8'],
            'image'=>['image','max:1000'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required','min:8', Rules\Password::defaults()],
        ]);
        /** @var UploadedFile|null $image */
        if($request->password == $request->password_confirmation){
            $image = $request->image;
            if($image != null && !$image->getError()){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $imagePath = $file->storeAs('users/image', $filename,'public');
                $user=User::create([
                    'username' => $request->username,
                    'nom' =>strtoupper($request->nom) ,
                    'prenom' =>strtoupper($request->prenom) ,
                    'pays' => $request->pays,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'image'=> $imagePath,
                    'password' => Hash::make($request->password),
                ]);
            }
            else{
                $user=User::create([
                    'username' => $request->username,
                    'nom' =>strtoupper($request->nom) ,
                    'prenom' =>strtoupper($request->prenom) ,
                    'pays' => $request->pays,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'password' => Hash::make($request->password),
                ]);
            }
            return redirect()->route('login1')->with('success','compte crée avec success');
        }else{
            return back()->withErrors([
                'password_confirmation'=> 'Mot de passe confirmé ne correspond pas'
            ]);
        }
    }
}
