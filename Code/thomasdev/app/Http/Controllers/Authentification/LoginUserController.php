<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Equipe;
use App\Models\Membre;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use App\Models\User;

class LoginUserController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('authentification.login');
    }

    public function createMembre(): View
    {
        return view('authentification.membreLogin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(Route('home'))->with('success','Vous êtes connecté!!!');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('home');
    }

    public function storeMembre(LoginRequest $request){
        $membre = Membre::where('email',$request->email)->first();
        $credentials =  $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required','min:8', Rules\Password::defaults()],
        ]);
        if($membre != null){
            if($membre->equipe->statut_equipe == "Actif"){
                if($membre->statut_membre == "Actif"){
                    if (Auth::guard('membre')->attempt($credentials)) {
                        $request->session()->regenerate();
                        return redirect()->intended('home')->with('success','Vous êtes connecté!!!');
                    }else{
                        return redirect()->back()->with('error', 'Informations incorrectes!!!');
                    }
                } else{
                    return redirect()->back()->with('error', 'Votre compte a été désactivé!!!');
                }
            }else if($membre->equipe->statut_equipe == "En pause"){
                if($membre->statut_membre == "Actif"){
                    if($membre->is_superuser || $membre->is_staff){
                        if (Auth::guard('membre')->attempt($credentials)) {
                            $request->session()->regenerate();
                            return redirect()->intended('home')->with('success','Vous êtes connecté!!!');
                        }else{
                            return redirect()->back()->with('error', 'Informations incorrectes!!!');
                        }
                    }else{
                        return redirect()->back()->with('error', 'Équipe en pause; Accès impossible pour le moment!!!');
                    }
                } else{
                    return redirect()->back()->with('error', 'Accès impossible, compte désactivé!!!');
                }
            }else if($membre->equipe->statut_equipe == "Inactif"){
                return redirect()->back()->with('error', 'Accès impossible, équipe inactive!!!');
            }
        }else{
            return redirect()->back()->with('error', 'compte non trouvé!!!');
        }

    }
}
