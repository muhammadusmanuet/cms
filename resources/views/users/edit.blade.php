@extends('layouts.app')

@section('content')
       
            <div class="card">
                <div class="card-header">{{ 'My Profile' }}</div>

                <div class="card-body">
                    @include('partials.errors')
                    <form action="{{ route('users.update-profile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" value='{{ $user->name }}'>
                        </div>

                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea id="about" cols='5' rows='5' class="form-control" type="text" name="about" >
                                {{ $user->about }}
                            </textarea>
                        </div>

                        <button class="btn btn-success" type="submit">Update Profile</button>
                    </form>
                    
                </div>
            </div>

@endsection
