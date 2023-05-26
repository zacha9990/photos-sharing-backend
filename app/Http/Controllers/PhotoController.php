<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Like;
use Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return response()->json($photos);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $photo = new Photo;
        $photo->caption = $request->input('caption');
        $photo->tags = $request->input('tags');

        if ($request->hasFile('photo')) {
            $photo->filename = $request->file('photo')->store('photos');
        } else {
            // Handle the case when the photo file is not present in the request
            return response()->json(['error' => 'Photo file is missing'], 400);
        }

        $photo->user_id = $user->id;
        $photo->save();

        return response()->json($photo, 201);
    }

    public function show($id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        return response()->json($photo);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $photo = Photo::where('id', $id)->where('user_id', $user->id)->first();

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $photo->caption = $request->input('caption');
        $photo->tags = $request->input('tags');

        if ($request->hasFile('photo')) {
            // Delete the existing photo file
            Storage::delete($photo->filename);

            // Store the new photo file
            $photo->filename = $request->file('photo')->store('photos');
        }

        $photo->save();

        return response()->json($photo);
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $photo = Photo::where('id', $id)->where('user_id', $user->id)->first();

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        // Delete the photo file from storage
        Storage::delete($photo->filename);

        // Delete the photo record from the database
        $photo->delete();

        return response()->json(['message' => 'Photo deleted']);
    }

    public function like($id)
    {
        $user = Auth::user();

        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $like = Like::where('user_id', $user->id)->where('photo_id', $photo->id)->first();

        if ($like) {
            return response()->json(['message' => 'You already liked this photo']);
        }

        $like = new Like;
        $like->user_id = $user->id;
        $like->photo_id = $photo->id;
        $like->save();

        return response()->json(['message' => 'Photo liked']);
    }

    public function unlike($id)
    {
        $user = Auth::user();

        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $like = Like::where('user_id', $user->id)->where('photo_id', $photo->id)->first();

        if (!$like) {
            return response()->json(['message' => 'You have not liked this photo']);
        }

        $like->delete();

        return response()->json(['message' => 'Photo unliked']);
    }
}
