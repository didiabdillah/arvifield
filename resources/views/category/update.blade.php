@extends('layout/layout')

@section('title', 'Edit Category')

@section('page')

@include('layout.flash_alert')

<div class="mt-4">
    <h2>Edit Category</h2>

    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <a href="{{route('category')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{route('category_update', $category->category_id)}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Enter Label" value="{{$category->category_label}}">
                        @error('label')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil"></i> Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection