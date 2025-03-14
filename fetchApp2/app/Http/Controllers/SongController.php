<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller {

    function main() {
        $songs = Song::orderBy('title')->get();
        return view('main', compact('songs'));
    }

    public function index(Request $request) {
        return response()->json([
            'songs' => Song::orderBy('title')->paginate(10),
            'user' => Auth::user()
        ]);
    }

    public function index1() {
        return response()->json([
            'songs' => Song::orderBy('title')->get()
        ]);
    }

    public function store(Request $request) {
        $message = '';
        $result = false;
        $songs = [];
    
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|min:2|unique:songs,title',
            'artist' => 'required|max:100|min:2',
            'category_id' => 'required|exists:categories,id',
            'route_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'route_song' => 'required|file|mimes:mp3,wav,ogg|max:10240'
        ]);
    
        if ($validator->passes()) {
            try {
                // Manejar la subida de archivos
                $imageFile = $request->file('route_image');
                $songFile = $request->file('route_song');
                
                // Generar nombres únicos para los archivos
                $imageName = time() . '_' . $imageFile->getClientOriginalName();
                $songName = time() . '_' . $songFile->getClientOriginalName();
                
                // Guardar los archivos en el almacenamiento
                $imageFile->move(storage_path('app/public/imgs'), $imageName);
                $songFile->move(storage_path('app/public/songs'), $songName);
                
                // Crear la canción en la base de datos
                $song = new Song();
                $song->title = $request->title;
                $song->artist = $request->artist;
                $song->category_id = $request->category_id;
                $song->route_image = $imageName;
                $song->route_song = $songName;
                $song->save();
                
                $result = true;
                $songs = Song::orderBy('title')->paginate(10)->setPath(url('song'));
            } catch (\Exception $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = $validator->getMessageBag();
        }
    
        return response()->json([
            'result' => $result,
            'message' => $message,
            'songs' => $songs,
            'user' => Auth::user()
        ]);
    }

    public function show($id) {
        $song = Song::find($id);
        $message = '';
        if($song === null) {
            $message = 'Song not found.';
        }
        return response()->json([
            'message' => $message,
            'song' => $song
        ]);
    }

    public function update(Request $request, $id) {
        $message = '';
        $song = Song::find($id);
        $songs = [];
        $result = false;
        if($song != null) {
            $validator = Validator::make($request->all(), [
                'title'  => 'required|max:100|min:2|unique:songs,title,' . $song->id,
                'artist' => 'required|max:100|min:2',
                'category_id' => 'required|exists:categories,id' // Cambiar 'category' a 'category_id'
            ]);
            if($validator->passes()) {
                $result = $song->update($request->all());
                if($result) {
                    $songs = Song::orderBy('title')->paginate(10)->setPath(url('song'));
                } else {
                    $message = 'Song has not been updated.';
                }
            } else {
                $message = $validator->getMessageBag();
            }
        } else {
            $message = 'Song not found';
        }
        return response()->json([
            'result' => $result,
            'message' => $message,
            'songs' => $songs,
            'user' => Auth::user() // Agrega la información del usuario a la respuesta
        ]);
    }
    
    public function destroy(Request $request, $id) {
        $message = '';
        $songs = [];
        $song = Song::find($id);
        $result = false;
        if($song != null) {
            try {
                $result = $song->delete();
                $songs = Song::orderBy('title')->paginate(10)->setPath(url('song'));
                if($songs->isEmpty()) {
                    $page = $songs->lastPage();
                    $request->merge(['page' => $page]);
                    $songs = Song::orderBy('title')->paginate(10)->setPath(url('song'));
                }
            } catch(\Exception $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = 'Song not found';
        }
        return response()->json([
            'message' => $message,
            'songs' => $songs,
            'result' => $result
        ]);
    }
}