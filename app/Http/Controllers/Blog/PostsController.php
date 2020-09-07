<?php

namespace App\Http\Controllers\Blog;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post){
        return view('blog.show')->with('post',$post);
    }

    public function category(Category $category)
    {
        $search = request()->query('search');

        if($search)
        {
            $posts = $category->posts()->where('title', 'LIKE', "%{search}%")->paginate(3);
        } else{
            $posts = $category->posts()->paginate(3);
        }

        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $posts)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {
        $search = request()->query('search');

        if($search)
        {
            $posts = $tag->posts()->where('title', 'LIKE', "%{search}%")->paginate(3);
        } else{
            $posts = $tag->posts()->paginate(3);
        }

        return view('blog.tag')
        ->with('tag', $tag)
        ->with('posts', $posts)
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }


}
