<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ChercheurController extends Controller
{
    public function create(){
        $user = Auth::user();
        if ($user->is_superuser) {
            return view('authentification.setting.chercheurRegister');
        }else{
            return redirect()->route('home');
        }

    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->is_superuser){
            $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string', 'max:255'],
                'titre' => ['required', 'string','max:255'],
                'specialite' => ['required', 'string','max:255'],
                'telephone' => ['required', 'min:8'],
                'cv'=>['required','max:10000'],
                'image'=>['image','max:1000'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required','min:8', Rules\Password::defaults()],
            ]);
            /** @var UploadedFile|null $image */
            /** @var UploadedFile|null $cv */
            if($request->password == $request->password_confirmation){
                $image = $request->image;
                $cv = $request->cv;
                if($cv !=null && !$cv->getError()){
                    $file = $request->file('cv');
                    $filename = $file->getClientOriginalName();
                    $cvPath = $file->storeAs('users/cv', $filename,'public');
                    if($image != null && !$image->getError()){
                        $file = $request->file('image');
                        $filename = $file->getClientOriginalName();
                        $imagePath = $file->storeAs('users/image', $filename,'public');
                        $user=User::create([
                            'username' => $request->username,
                            'nom' => $request->nom,
                            'prenom' => $request->prenom,
                            'pays'=>$request->pays,
                            'specialite'=>$request->specialite,
                            'titre_academique'=>$request->titre,
                            'telephone' => $request->telephone,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'is_staff'=>'true',
                            'cv'=>$cvPath,
                            'image'=>$imagePath,
                        ]);
                    }else{
                        $user=User::create([
                            'username' => $request->username,
                            'nom' => $request->nom,
                            'prenom' => $request->prenom,
                            'pays'=>$request->pays,
                            'specialite'=>$request->specialite,
                            'titre_academique'=>$request->titre,
                            'telephone' => $request->telephone,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'is_staff'=>'true',
                            'cv'=>$cvPath
                        ]);
                    }
                    return redirect()->route('equipe')->with('success','compte crée avec success');
                }else{
                    return back()->withErrors([
                        'cv'=> 'Le champ cv est requis'
                    ]);
                }
            }else{
                return back()->withErrors([
                    'password_confirmation'=> 'Mot de passe confirmé ne correspond pas'
                ]);
            }
        }else{
            return redirect()->route('home');
        }
    }
}
