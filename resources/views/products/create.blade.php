@extends('layouts.app')

@section('content')
    
    <div class="card card-default">
        <div class="card-header">
            {{ isset($product) ? 'Edit' : 'Create' }} Product
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
            <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
                
                @csrf

                @if (isset($product))
                    @method('PUT')
                @endif
                
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" id="title" name="title" value="{{ isset($product) ? $product->title : ''}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($product) ? $product->description : ''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="name">Price</label>
                    <input type="text" id="price" name="price" value="{{ isset($product) ? $product->price : ''}}" class="form-control">
                </div>
                
                @if (isset($product))
                    <div class="form-group">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" style="width: 100%;">
                    </div>
                @endif
                <div class="form-group">
                    <label for="name">Image</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if (isset($product))
                                    @if ($category->id === $product->category_id)
                                        selected
                                    @endif
                                @endif
                                >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="0">Pending</option>
                        <option value="1">Published</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($product) ? 'Update' : 'Add' }} Product</button>
                </div>

            </form>
        </div>

    </div>
@endsection