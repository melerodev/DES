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
        $songs = [];
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:songs|max:100|min:2',
            'artist' => 'required|max:100|min:2',
        ]);
        if ($validator->passes()) {
            $message = '';
            $result = Song::create($request->all());
            if($result) {
                $songs = Song::orderBy('title')->paginate(10)->setPath(url('song'));
            } else {
                $message = 'Message song has not been saved.';
            }
        } else {
            $result = false;
            $message = $validator->getMessageBag();
        }
        return response()->json(['result' => $result, 'message' => $message, 'songs' => $songs]);
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
        return response()->json(['result' => $result, 'message' => $message, 'songs' => $songs]);
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