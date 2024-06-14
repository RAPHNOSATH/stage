<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PartenaireController extends Controller
{
    public function create(){
        $user = Auth::user();
        if ($user->is_superuser) {
            return view('authentification.setting.partenaireRegister');
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
                'adresse' => ['required', 'string','max:255'],
                'service' => ['required', 'string'],
                'telephone' => ['required', 'min:8','integer'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required','min:8', Rules\Password::defaults()],
                'document' =>['required','max:30000'],
                'image'=>['image','max:1000'],
            ]);
            /** @var UploadedFile|null $image */
            /** @var UploadedFile|null $document */
            if($request->password == $request->password_confirmation){
                $image = $request->image;
                $document = $request->document;
                if($document !=null && !$document->getError()){
                    $file = $request->file('document');
                    $filename = $file->getClientOriginalName();
                    $documentPath = $file->storeAs('users/document', $filename,'public');
                    if($image != null && !$image->getError()){
                        $file = $request->file('image');
                        $filename = $file->getClientOriginalName();
                        $imagePath = $file->storeAs('users/image', $filename,'public');
                        $user=User::create([
                            'username' => $request->username,
                            'intitule'=>$request->intitule,
                            'adresse'=>$request->adresse,
                            'service'=>$request->service,
                            'telephone' => $request->telephone,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'is_staff'=>'true',
                            'document'=>$documentPath,
                            'image'=>$imagePath,
                        ]);
                    }else{
                        $user=User::create([
                            'username' => $request->username,
                            'intitule'=>$request->intitule,
                            'adresse'=>$request->adresse,
                            'service'=>$request->service,
                            'telephone' => $request->telephone,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'is_staff'=>'true',
                            'document'=>$documentPath
                        ]);
                    }
                    return redirect()->route('equipe')->with('success','compte crée avec success');
                }else{
                    return back()->withErrors([
                        'document'=> 'Le champ vide ou fichier érroné'
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
