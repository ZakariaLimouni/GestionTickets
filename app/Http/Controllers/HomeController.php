<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Ville;
use App\Models\Agence;
use App\Models\TypeTicket;
use App\Models\TypeDocument;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
class HomeController extends Controller
{


// User controller:
    



    public function index(){
        $users = User::where('userType', '!=', 'admin')->get();
        return view('admin.User.gestionUser', ['users' => $users]);
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function CreateUser(){
        $roles=Role::pluck('name','name')->all();
        $villes = Ville::all();        
        $agences = Agence::all();        
        return view('admin.User.CreateUser', compact('villes','agences'),
                    ['roles'=>$roles]
                );
    }
    public function storeUser(Request $request)
    {

            $request->validate([
                'photo_profile' => 'image',
                'Matricule' => 'required|unique:users,Matricule',
                'name' => 'required',
                'Prenom' => 'required',
                'ville_id'=>'required',
                'agence_id'=>'required',
                'Telephone' => 'required',
                'email' => 'required',
                'password' => 'required|min:8|max:20',
                'status' => 'required',
                'roles' => 'required',
                ]);
                if ($request->hasFile('photo_profile')) {

                    $image = $request->file('photo_profile');
                    $imageName = $request->name.$request->Prenom.'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public', $imageName);
                }
               
            $user=User::create([
                'photo_profile'=>$imageName,
                'Matricule'=>$request->Matricule,
                'name'=>$request->name,
                'Prenom'=>$request->Prenom,
                'ville_id'=>$request->ville_id,
                'agence_id'=>$request->agence_id,
                'Telephone'=>$request->Telephone,
                'email'=>$request->email,
                'userType' => 'user',
                'password'=>$request->password,
                'status'=>$request->status,
            ]);

            $user->syncRoles($request->roles);
            return redirect()->route('admin.gestionUser');
    }
    public function showUser($id){
        $user = User::with('ville','agence')->findOrFail($id);

        return view('admin.User.UsersShow',compact('user') );
    }
    public function userEdit(string $id)
    {
        $roles=Role::pluck('name','name')->all();
        $user = User::findOrFail($id);
        $villes = Ville::all();        
        $agences = Agence::all();
        $userRoles = $user->roles->pluck('name','name')->all();

        return view('admin.User.userEdit', compact('user','villes','agences'),
        ['roles'=>$roles,
         'userRoles'=>$userRoles
        ]);
    }
    public function updateUser(Request $request, string $id)
    {
        $request->validate([
            'photo_profile' => 'image',
            'Matricule' => 'required',
            'name' => 'required',
            'Prenom' => 'required',
            'ville_id' => 'required',
            'agence_id' => 'required',
            'Telephone' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'roles' => 'required',
        ]);
    
        $user = User::findOrFail($id);
    
        $validatedData = [
            'Matricule' => $request->Matricule,
            'name' => $request->name,
            'Prenom' => $request->Prenom,
            'ville_id' => $request->ville_id,
            'agence_id' => $request->agence_id,
            'Telephone' => $request->Telephone,
            'email' => $request->email,
            'status' => $request->status,
        ];
    
        if ($request->hasFile('photo_profile')) {
            if ($user->photo_profile) {
                Storage::delete($user->photo_profile);
            }
    
            $validatedData['photo_profile'] = $request->file('photo_profile')->store('public');
        }
    
        $user->update($validatedData);
    
        $user->syncRoles($request->roles);
    
        return redirect()->route('admin.gestionUser');
    }
    public function deleteUser(string $id)
    {

    $user = User::findOrFail($id);

    $user->delete();

    return redirect()->route('admin.gestionUser');
    }
    public function blockerUser($id)
{
    $user = User::findOrFail($id);
    $user->status = 'blocked';
    $user->save();
    
    return redirect()->back()->with('success', 'User blocked successfully.');
}
    public function unblockerUser($id)
{
    $user = User::findOrFail($id);
    $user->status = 'active';
    $user->save();
    
    return redirect()->back()->with('success', 'User unblocked successfully.');
}
    public function validateUser($id)
{

    $user = User::findOrFail($id);

    $user->status = 'active';
    $user->save();

    return redirect()->back()->with('success', 'User has been validated successfully.');
}



 



// Ville Controller :
    public function gestionVille(){
        return view('admin.Ville.gestionVille');
    }
    public function storeVille(Request $request)
    {

            $validatedData = $request->validate([
                'codeVille' => 'required',
                'ville' => 'required',
                'status' => 'required',
                ]);

            Ville::create($validatedData);
            return redirect()->route('admin.gestionVille');
    }
    public function updateVille(Request $request, string $id)
    {
            
        $validatedData = $request->validate([
            'codeVille' => 'required',
            'ville' => 'required',
            'status' => 'required',
            ]);
            $ville = Ville::findOrFail($id);
            $ville->update($validatedData);
            return redirect()->route('admin.gestionVille');
    }
    public function deleteVille(string $id)
    {

    $ville = Ville::findOrFail($id);

    $ville->delete();

    return redirect()->route('admin.gestionVille');
    }





// Agence Controller :
public function storeAgence(Request $request)
{

        $validatedData = $request->validate([
            'codeAgence' => 'required',
            'agence' => 'required',
            'status' => 'required',
            'ville_id'=>'required',
            ]);

        Agence::create($validatedData);
        return redirect()->route('admin.gestionAgence');
}  
public function updateAgence(Request $request, string $id)
{
        
    $validatedData = $request->validate([
        'codeAgence' => 'required',
        'agence' => 'required',
        'status' => 'required',
        'ville_id'=>'required',
        ]);
        $agence = Agence::findOrFail($id);
        $agence->update($validatedData);
        return redirect()->route('admin.gestionAgence');
}
public function deleteAgence(string $id)
{

$agence = Agence::findOrFail($id);

$agence->delete();

return redirect()->route('admin.gestionAgence');
}
public function gestionAgence(){
    $villes = Ville::all();
    return view('admin.Agence.gestionAgence', compact('villes'));
}

//Type Ticket
public function storeTypeTicket(Request $request)
{

        $validatedData = $request->validate([
            'libelle' => 'required',
            'status' => 'required',
            ]);

        TypeTicket::create($validatedData);
        return redirect()->route('admin.gestionTypeTicket');
}  
public function updateTypeTicket(Request $request, string $id)
{
        
    $validatedData = $request->validate([
        'libelle' => 'required',
        'status' => 'required',
        ]);
        $TypeTicket = TypeTicket::findOrFail($id);
        $TypeTicket->update($validatedData);
        return redirect()->route('admin.gestionTypeTicket');
}
public function deleteTypeTicket(string $id)
{

$TypeTicket = TypeTicket::findOrFail($id);

$TypeTicket->delete();

return redirect()->route('admin.gestionTypeTicket');
}
public function gestionTypeTicket(){
    return view('admin.TypeTicket.gestionTypeTicket');
}

//type document
public function storeTypeDocument(Request $request)
{

        $validatedData = $request->validate([
            'libelle' => 'required',
            'status' => 'required',
            ]);

        TypeDocument::create($validatedData);
        return redirect()->route('admin.gestionTypeDocument');
}  
public function updateTypeDocument(Request $request, string $id)
{
        
    $validatedData = $request->validate([
        'libelle' => 'required',
        'status' => 'required',
        ]);
        $TypeDocument = TypeDocument::findOrFail($id);
        $TypeDocument->update($validatedData);
        return redirect()->route('admin.gestionTypeDocument');
}
public function deleteTypeDocument(string $id)
{

$TypeDocument = TypeDocument::findOrFail($id);

$TypeDocument->delete();

return redirect()->route('admin.gestionTypeDocument');
}
public function gestionTypeDocument(){
    return view('admin.TypeDocument.gestionTypeDocument');
}





    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}