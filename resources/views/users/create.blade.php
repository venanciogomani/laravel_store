@extends('layouts.app')

@section('content')
    
    <div class="card card-default">
        <div class="card-header">
            {{ isset($user) ? 'Edit' : 'Create' }} User
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                
                @csrf

                @if (isset($user))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ isset($user) ? $user->name : ''}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" id="email" name="email" value="{{ isset($user) ? $user->email : ''}}" class="form-control">
                </div>

                @if(!isset($user))
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="0">Admin</option>
                        <option value="1">Author</option>
                        <option value="2">Publisher</option>
                        <option value="3">Client</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($user) ? 'Update' : 'Add' }} User</button>
                </div>

            </form>
        </div>

    </div>
@endsection