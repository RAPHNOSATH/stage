<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }
    public function utilisateurs(){
        $users = User::all();
        return view('authentification.setting.users', compact('users'));
    }

    public function destroye($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'utilisateur supprimé avec succès!!!');
    }
    public function updated(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation des données soumises
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);
        // mise à jour des données soumises
        $user->username = $request->input('name');
        $user->telephone = $request->input('telephone');
        $user->email = $request->input('email');

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $documentPath = $file->storeAs('users/document', $filename,'public'); // Stocker le fichier dans le dossier 'equipes' (vous pouvez ajuster le chemin selon vos besoins)
            $user->document = $documentPath; // Mettre à jour le chemin du fichier dans la base de données
        }
        if ($request->hasFile('contrat')) {
            $file = $request->file('contrat');
            $filename = $file->getClientOriginalName();
            $contratPath = $file->storeAs('users/contrat', $filename,'public'); // Stocker le fichier dans le dossier 'equipes' (vous pouvez ajuster le chemin selon vos besoins)
            $user->contrat = $contratPath; // Mettre à jour le chemin du fichier dans la base de données
        }
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = $file->getClientOriginalName();
            $cvPath = $file->storeAs('users/cv', $filename,'public'); // Stocker le fichier dans le dossier 'equipes' (vous pouvez ajuster le chemin selon vos besoins)
            $user->cv = $cvPath; // Mettre à jour le chemin du fichier dans la base de données
        }

        $user->save();
        return redirect()->back()->with('success', 'Données utilisateurs mise à jour avec succès!!!');
    }
}
