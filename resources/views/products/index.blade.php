@extends('layouts.app')

@section('content')
    
    <div class="d-flex justify-content-end">
        <a href="{{ route('products.create') }}" class="btn btn-success float-right mb-2">
            Add Product
        </a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Products
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th><Title></Title></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" width="60px" height="60px" alt="">
                            </td>

                            <td>
                                {{ $product->title }}
                            </td>

                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    
                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">Trash</button>
                                
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="deleteProductForm">
                        <div class="modal-content">
                            
                            @csrf

                            @method('DELETE')

                            <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
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

            var form = document.getElementById('deleteProductForm')

            form.action = '/products/' + id
        }
    </script>
@endsection