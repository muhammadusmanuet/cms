@extends('layouts.app')

@section('content')


    <div class="d-flex justify-content-end mb-2 ">
        <a class="btn btn-success float-right rounded-0" href="{{ route('posts.create') }}">Add Post</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
           
        @if($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ asset('storage/'.$post->image) }}" alt="" height="60px" width="100px"></td>
                            
                            <td style="vertical-align: middle;">
                                {{ $post->title }}
                            </td>
                            @if(isset($post->category))
                            <td  style="vertical-align: middle;">
                                <a href="{{ route('categories.edit' , $post->category->id) }}">{{ $post->category->name }}</a>
                            </td>
                            @endif
                            
                            @if(!$post->trashed())
                               
                                <td  style="vertical-align: middle;"><a href="{{ route('posts.edit', $post->id) }}"  class="btn btn-primary btn-sm">Edit</a></td>
                               
                                @else
                                <td  style="vertical-align: middle;">
                                    
                                    <form action="{{ route('restore-posts',$post->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit"  class="btn btn-primary btn-sm">Restore</button>
                                    
                                    </form>
                                </td>
                            @endif
                            <td style="vertical-align: middle;" >
                                 
                                <form action="{{ route('posts.destroy', $post->id) }} " method="POST">
                                 
                                    @csrf
                                    @method('DELETE')
                                   
                                    <button type="submit" class="btn btn-danger btn-sm"  >{{ $post->trashed() ? 'Delete' : 'Trash' }}</button>
                              
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h5 class="text-center">No Posts Yet</h5>
        @endif
        </div>
    </div>
@endsection