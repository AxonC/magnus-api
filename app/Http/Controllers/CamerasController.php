<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CamerasController extends Controller
{
    public function all()
    {
        $cameras = Camera::all();

        return response()->json(['data' => $cameras]);
    }

    public function show($id)
    {
        try {
            $camera = Camera::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Camera with that key is not found.'], 404);
        }

        return response()->json(['data' => $camera]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'camera_address' => 'required|string',
            'building_id'    => 'required|numeric',
        ]);

        $token = sha1(str_random(32));

        $camera = Camera::create([
            'camera_address' => $request->input('camera_address'),
            'building_id'    => $request->input('building_id'),
            'token'          => $token,
        ]);

        return response()->json(['token' => $token, 'camera' => $camera], 201)
            ->header('Location', route('camera.show', $camera));
    }
}
