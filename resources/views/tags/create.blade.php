@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ isset($tag) ? $tag->name : '' }}" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success rounded-0">{{ isset($tag) ? 'Update Tag' : 'Add Tag' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection