<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user();
            $valid = Validator::make($request->all(), [
                'name' => 'required|string|min:1',
                'photo' => 'required|image',
                'description' => 'string|min:1',
            ], [
                'required' => 'Поле :attribute обязательно для заполнения',
                'min' => 'Поле :attribute должно быть длиной не менее 1 символа',
                'image' => 'Загружайте только изображения!',
            ]);

            if($valid->fails()) {
                return response()->json($valid->errors(), 400);
            }

            $file = $request->file("photo");
            $fileName = uniqid();
            $file->getClientOriginalExtension();
            $file->move(public_path('storage/images/'), $file);

            Post::create([
                'photo' => $fileName . '.' . $fileName,
                'name' => $request['name'],
                'description' => $request['description'],
                'user_id' => $user->id,
            ]);

            return response()->json([
                'status' => true,
            ]);
        }

        return redirect("/home");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //

        return view("posts.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
