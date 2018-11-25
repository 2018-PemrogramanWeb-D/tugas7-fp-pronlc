<?php

namespace App\Http\Controllers;

use App\forum;
use App\Tags;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
use Storage;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index','show','populars');
    }

    public function populars()
    {
        $populars = DB::table('forums')
                    ->join('views','forums.id','=','views.viewable_id')
                    ->select(DB::raw('count(viewable_id) as count'),'forums.id','forums.title','forums.slug')
                    ->groupBy('id','title','slug')
                    ->orderBy('count','desc')
                    ->take(10)
                    ->get();
        return view('forum.popular', compact('populars'));
    }

    public function index()
    {
        $populars = DB::table('forums')
                    ->join('views','forums.id','=','views.viewable_id')
                    ->select(DB::raw('count(viewable_id) as count'),'forums.id','forums.title','forums.slug')
                    ->groupBy('id','title','slug')
                    ->orderBy('count','desc')
                    ->take(5)
                    ->get();
        $forums = Forum::paginate(5);
        return view('forum.index', compact('forums', 'populars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forums = Forum::orderBy('id', 'desc')->paginate(1);
        $tags = Tags::all();
        return view('forum.create', compact('tags', 'forums'));
        $tags = Tags::all();
        return view('forum.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $forums = New Forum;
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->slug = str_slug($request->title);
        $forums->description = $request->description;
        if($request->file('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);
            $forums->image = $filename;
        }

        $forums->save();
        $forums->tags()->sync($request->tags);

        return back()->withInfo('Pertanyaan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $populars = DB::table('forums')
                    ->join('views','forums.id','=','views.viewable_id')
                    ->select(DB::raw('count(viewable_id) as count'),'forums.id','forums.title','forums.slug')
                    ->groupBy('id','title','slug')
                    ->orderBy('count','desc')
                    ->take(5)
                    ->get();
        $forums = Forum::paginate(5);
        $forums = Forum::where('id', $slug)->orWhere('slug', $slug)->firstOrFail();
        $forums->addViewWithExpiryDate(Carbon::now()->addHours(2));
        return view('forum.show', compact('forums','populars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tags = Tags::all();
        $forum = Forum::where('id', $slug)->orWhere('slug', $slug)->firstOrFail();
        return view('forum.edit', compact('forum','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $forums = forum::find($id);
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        // biar gak merubah slug
        // $forums->slug = str_slug($request->title);
        $forums->description = $request->description;
        if($request->file('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);

            $oldImage = $forums->image;
            \Storage::delete($oldImage);

            $forums->image = $filename;
        }

        $forums->save();
        $forums->tags()->sync($request->tags);

        return back()->withInfo('Pertanyaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::find($id);
        Storage::delete($forum->image);
        $forum->tags()->detach();
        $forum->delete();
        return back()->withInfo('Pertanyaan berhasil dihapus.');
    }
}
