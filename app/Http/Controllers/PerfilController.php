<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('perfil.index');
    }

    public function store(Request $request) {

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required','unique:users','min:3','max:20','not_in:twitter,editar-perfil']
        ]);

        if ($request->imagen) {
            $image = $request->file('imagen');
            $nombreImage = Str::uuid() . "." . $image->extension();
            $imagenServidor = Image::make($image);
            $imagenServidor->fit(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImage;
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImage ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
