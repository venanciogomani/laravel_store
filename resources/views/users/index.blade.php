@extends('layouts.app')

@section('content')
    
    <div class="d-flex justify-content-end">
        <a href="{{ route('users.create') }}" class="btn btn-success float-right mb-2">
            Add User
        </a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                @if ($user->role === 0)
                                    Admin
                                @elseif ($user->role === 1)
                                    Author
                                @elseif ($user->role === 2)
                                    Publisher
                                @else
                                    Client
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $user->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="deleteUserForm">
                        <div class="modal-content">
                            
                            @csrf

                            @method('DELETE')

                            <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Yes, delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            $('#deleteModal').modal('show')

            var form = document.getElementById('deleteUserForm')

            form.action = '/users/' + id
        }
    </script>
@endsection