<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class MinistereController extends Controller
{
    public function create(){
        $user = Auth::user();
        if ($user->is_superuser) {
            return view('authentification.setting.ministereRegister');
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
                'intitule' => ['required', 'string','max:255'],
                'service' => ['required', 'string'],
                'adresse' => ['required', 'string','max:255'],
                'telephone' => ['required', 'min:8','integer'],
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
                        'intitule'=>$request->intitule,
                        'service'=>$request->service,
                        'adresse'=>$request->adresse,
                        'email' => $request->email,
                        'telephone' => $request->telephone,
                        'password' => Hash::make($request->password),
                        'image'=>$imagePath,
                        'is_staff'=>'true',
                    ]);
                }else{
                    $user=User::create([
                        'username' => $request->username,
                        'intitule'=>$request->intitule,
                        'service'=>$request->service,
                        'adresse'=>$request->adresse,
                        'email' => $request->email,
                        'telephone' => $request->telephone,
                        'password' => Hash::make($request->password),
                        'is_staff'=>'true',
                    ]);
                }
                return redirect()->route('equipe')->with('success','compte crée avec success');
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
