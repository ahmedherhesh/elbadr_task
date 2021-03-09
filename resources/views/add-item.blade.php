@extends('master')
@section('title')
    <title>Add-Item</title>
@endsection
@section('content')
    {{View::make('navbar')}}
    <div class="container top col-md-4 offset-md-4">
        <h1 class="text-center">Add Item</h1>
        <form action="{{route('add_item')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif
            <div class="form-group">
                <input  class="form-control" type="text" name="name" id="name" placeholder="Item Name">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <textarea  class="form-control" name="description" id="description" placeholder="Description"></textarea>
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <input  class="form-control" type="number" name="original_price" id="original_price"  placeholder="Original Price">
                @error('original_price')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <input  class="form-control" type="number" name="price"  placeholder="Price">
                @error('price')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <input  class="form-control" type="number" name="count" id="count"  placeholder="Count">
                @error('count')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <select class="custom-select" name="categories" id="categories">
                    <option value="" selected>Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <select class="custom-select" name="sub_categories" id="sub_categories">
                    
                </select>
                @error('sub_categories')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="tags" class="form-control" placeholder="write tags with separator mark , (ex,ex,ex)">
            </div>
            <div class="form-group">
                <div class="custom-file text-left">
                    <input type="file" name="image" class="custom-file-input" >
                    <label class="custom-file-label" for="inputGroupFile03">Choose image</label>
                  </div>
                  @error('image')
                    <div class="text-danger">{{$message}}</div>
                  @enderror
            </div>
            <span>Total original price : </span> <span id="total_original_price">0</span>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
@endsection