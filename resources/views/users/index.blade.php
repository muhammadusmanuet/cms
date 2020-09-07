@extends('layouts.app')

@section('content')


    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
           
        @if($users->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td> 
                                <img src="{{ Gravatar::src('$user->email') }}" width='40px' height='40px' style='border-radius:50%;' alt="">
                            </td>
                            
                            <td style="vertical-align: middle;">
                                {{ $user->name }}
                            </td>
    
                            <td  style="vertical-align: middle;">
                            {{ $user->email }}
                            </td>
                            
                            <td style="vertical-align: middle;" >
                                @if(!($user->isAdmin()))
                                <form method="POST" action="{{route('users.make-admin', $user->id)}}">
                                    @csrf
                                    <button class="btn btn-success" type="submit">Make Admin</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h5 class="text-center">No Users Yet</h5>
        @endif
        </div>
    </div>
@endsection