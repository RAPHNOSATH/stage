<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Communique;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AnnonceController extends Controller
{
    public function create(){
        $user = Auth::user();
        if ($user->is_superuser) {
            return view('authentification.setting.annonceForm');
        }else{
            return redirect()->route('home');
        }

    }

    public function create1(){
        $user = Auth::user();
        if ($user->is_superuser) {
            return view('authentification.setting.communiqueForm');
        }else{
            return redirect()->route('home');
        }

    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store1(Request $request){
        $user = Auth::user();
        $communique =Communique::findOrFail(1);
        if($user->is_superuser){
            $request->validate([
                'document' => ['required', 'max:30000']
            ]);
            /** @var UploadedFile|null $document */
            $document = $request->document;
            if($communique!= null){
                if($document!=null && !$document->getError()){
                    if ($communique->document_c) {
                        Storage::disk('public')->delete($communique->document_c);
                    }

                    $file = $request->file('document');
                    $filename = $file->getClientOriginalName();
                    $documentPath = $file->storeAs('communique/document', $filename,'public');
                    $communique->update([
                        'document_c' => $documentPath,
                    ]);
                    return redirect()->route('equipe')->with('success','Communiqué soumis avec success!!!');
                }else{
                    return back()->withErrors([
                        'document'=> 'fichier erroné'
                    ]);
                }
            }else{
                if($document!=null && !$document->getError()){
                    $file = $request->file('document');
                    $filename = $file->getClientOriginalName();
                    $documentPath = $file->storeAs('communique/document', $filename,'public');
                    Communique::create([
                        'document_c' => $documentPath,
                    ]);
                    return redirect()->route('equipe')->with('success','Communiqué soumis avec success!!!');
                }else{
                    return back()->withErrors([
                        'document'=> 'fichier erroné'
                    ]);
                }
            }
        }else{
            return redirect()->route('home');
        }
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->is_superuser){
            $request->validate([
                'titre' => ['required', 'string', 'max:255'],
                'contenu' => ['required', 'string'],
                'fichier'=>['max:30000'],
            ]);
            /** @var UploadedFile|null $fichier */
            $fichier = $request->fichier;
            if($fichier != null && !$fichier->getError()){
                $file = $request->file('fichier');
                $filename = $file->getClientOriginalName();
                $fichierPath = $file->storeAs('annonce/document', $filename,'public');
                Annonce::create([
                    'title' => $request->titre,
                    'content'=>$request->contenu,
                    'file'=>$fichierPath,
                ]);
            }else{
                Annonce::create([
                    'title' => $request->titre,
                    'content'=>$request->contenu,
                ]);
            }
            return redirect()->route('equipe')->with('success','Annonce envoyé avec success!!!');
        }else{
            return redirect()->route('home');
        }
    }

    public function annonce(){
        $user = Auth::user();
        $annonces = Annonce::all();
        if ($user->is_superuser) {
            return view('authentification.setting.annonce',compact('annonces'));
        }else{
            return redirect()->route('/');
        }
    }
}
