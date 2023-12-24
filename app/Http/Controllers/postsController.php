<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Http\Controllers\File;
use DB;
// use Illuminate\Support\Facades\File as FacadesFile;

class postsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //to get all posts
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::orderBy("created_at","desc")->get();
        //$posts = Post::where("title","Post Two")->get();
        // $posts = Post::orderBy("created_at","desc")->take(1)->get();
        // $posts = Post::orderBy("created_at","desc")->paginate(1);
        // $post = DB::select('select * from posts'); //to write raw quries
        return view("posts.index")->with("posts",$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
        // $url = env('APP_URL');
        // return "The base URL is ".$url;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "title" => "required",
            "body" => "required",
            "cover_image" => "image|nullable|max:1999",
        ]);
        // dd($request->"cover_image");
        if($request->hasFile("cover_image")){
            //get the file name with extension
            $filenamewithext = $request->file("cover_image")->getClientOriginalName();

            //get just filename
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $ext = pathinfo($filenamewithext, PATHINFO_EXTENSION);
            $filenametostore = $filename."_".time().".".$ext;
            $path = $request->file("cover_image")->storeAs("public/cover_image", $filenametostore);
        }
        else{
            $filenametostore = "noimage.jpg";
        }


        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenametostore;
        $post->save();
        return redirect("/posts")->with("success","Your blog has been uploaded");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        // return $post;
        return view("posts.show")->with("posts",$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);

        // check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect("/posts")->with("error","Unauthorized Page");
        }
        return view("posts.edit")->with("posts",$post);
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
        $this->validate($request,[
            "title" => "required",
            "body" => "required",
            "cover_image" => "image|nullable|max:1999",
        ]);
        if($request->hasFile("cover_image")){
            //get the file name with extension
            $filenamewithext = $request->file("cover_image")->getClientOriginalName();

            //get just filename
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $ext = pathinfo($filenamewithext, PATHINFO_EXTENSION);
            $filenametostore = $filename."_".time().".".$ext;
            $path = $request->file("cover_image")->storeAs("public/cover_image", $filenametostore);
        }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        if($request->hasFile("cover_image")){
            if($post->cover_image != 'noimage.jpg'){
                //delete the image
                // dd("".$post->cover_image);
                Storage::delete("public/cover_image/".$post->cover_image);
            }
            $post->cover_image = $filenametostore;
        }
        $post->save();
        // return "";
        return redirect("/posts/")->with("success","Blog has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect("/posts")->with("error","Unauthorized Page");
        }
        if($post->cover_image != 'noimage.jpg'){
            //delete the image
            // dd("".$post->cover_image);
            Storage::delete("public/cover_image/".$post->cover_image);
        }

        $post->delete();
        return redirect("/posts")->with("success","Blog deleted successfully");
    }
}
