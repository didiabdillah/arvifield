@extends('layout/layout')

@section('title', 'Add Category')

@section('page')

@include('layout.flash_alert')

<div class="mt-4">
    <h2>Add Category</h2>

    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <a href="{{route('category')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</a>

            </div>
            <div class="card-body">
                <form action="{{route('category_store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Enter Label" value="{{old('label')}}">
                        @error('label')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Insert</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection