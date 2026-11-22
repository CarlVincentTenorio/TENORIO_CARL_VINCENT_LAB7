<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class UserController extends Controller {
 public function index(){return view('users',['users'=>User::latest()->get()]);}
 public function create(){return view('users.form',['user'=>new User]);}
 public function store(Request $request){$data=$request->validate(['username'=>'required|string|max:255|unique:users,username','full_name'=>'required|string|max:255']);User::create($data);return redirect()->route('users')->with('success','User created.');}
 public function edit(User $user){return view('users.form',compact('user'));}
 public function update(Request $request,User $user){
  $data=$request->validate(['username'=>['required','string','max:255',Rule::unique('users','username')->ignore($user->id)],'full_name'=>'required|string|max:255','avatar'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048']);
  unset($data['avatar']);
  if($request->hasFile('avatar')){
   $image=(new ImageManager(new Driver()))->read($request->file('avatar')->getRealPath());
   $image->scaleDown(width:256,height:256);
   $encoded=$image->toJpeg(quality:82);
   $path='avatars/'.(string) \Illuminate\Support\Str::uuid().'.jpg';
   if(!Storage::disk('public')->put($path,(string)$encoded)){return back()->withErrors(['avatar'=>'Avatar could not be saved.'])->withInput();}
   $old=$user->avatar;$data['avatar']=$path;
  }
  $user->update($data);
  if(isset($old) && $old){Storage::disk('public')->delete($old);}
  return redirect()->route('users')->with('success','User updated.');
 }
}
