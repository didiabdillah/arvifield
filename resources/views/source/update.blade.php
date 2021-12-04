@extends('layout/layout')

@section('title', 'Edit Source')

@section('page')

@include('layout.flash_alert')

<div class="mt-4">
    <h2>Edit Source</h2>

    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <a href="{{route('source')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</a>

            </div>
            <div class="card-body">
                <form action="{{route('source_update', $source->source_id)}}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Enter Label" value="{{$source->source_label}}">
                        @error('label')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Enter Link" value="{{$source->source_link}}">
                        @error('link')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="active" name="active" @if($source->source_active){{'checked'}}@endif>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Insert</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection