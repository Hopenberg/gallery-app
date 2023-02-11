<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoCollection;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PhotoCollection
     */
    public function index()
    {
        return new PhotoCollection(Photo::all());
    }

    public function indexWebView()
    {
        return view('photos-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('photos-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Photo
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'image' => ['required', 'file', 'max:2048', 'mimes:jpg,bmp,png'],
        ]);

        $result = new Photo();
        $result->first_name = $request->first_name;
        $result->last_name = $request->last_name;
        $result->client_name = $request->file('image')->getClientOriginalName();
        $result->app_name = hash('md5', $result->client_name . microtime()) . '.' . $request->file('image')->extension();
        Storage::put($result->app_name, file_get_contents($request->file('image')->getRealPath()));
        $result->save();

        return $result;        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try 
        {
            return response(Photo::findOrFail($id));
        }
        catch (ModelNotFoundException $e) 
        {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response(view('photos-edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try 
        {
            $result = Photo::findOrFail($id);
            $result->first_name = $request->first_name;
            $result->last_name = $request->last_name;
            $result->image = $request->image;
            $result->save();
    
            return response($result);
        }
        catch (ModelNotFoundException $e) 
        {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Photo::destroy($id);
        return response()->noContent();
    }
}
