<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

  
    public function create()
    {
        return view('tags.create');   
    }

    
    public function store(CreateTagRequest $request)
    {
        Tag::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag created succesfully');

        return redirect(route('tags.index'));
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }

    
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag Updated Succesfully');

        return redirect(route('tags.index'));
    }

   
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){
            session()->flash('error', 'Tag cannot be deleted it has some posts');
        }
        
        else{
            $tag->delete();
            session()->flash('success', 'Tag deleted succesfully');
        }

        return redirect(route('tags.index'));
    }
}
