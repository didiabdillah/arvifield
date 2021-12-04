@extends('layout/layout')

@section('title', 'Edit Resource')

@section('page')

@include('layout.flash_alert')

<div class="mt-4">
    <h2>Edit Resource</h2>

    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <a href="{{route('resource')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</a>

            </div>
            <div class="card-body">
                <form action="{{route('resource_update', $resource->resource_id)}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Enter Label" value="{{$resource->resource_label}}">
                        @error('label')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" placeholder="Description">{{$resource->resource_desc}}</textarea>
                        @error('desc')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="source">Source</label>
                        <select class="form-control select2-source @error('source') is-invalid @enderror" style="width: 100%;" name="source" id="source">
                            <option value="">--Select Source--</option>
                            @foreach($source as $data)
                            <option value="{{$data->source_id}}" @if($resource->resource_source_id==$data->source_id){{'selected'}}@endif>{{$data->source_label}}</option>
                            @endforeach
                        </select>
                        @error('source')
                        <div class="invalid-feedback">
                            Pilih Source
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control select2-category @error('category') is-invalid @enderror" style="width: 100%;" name="category" id="category">
                            <option value="">--Select Category--</option>
                            @foreach($category as $data)
                            <option value="{{$data->category_id}}" @if($resource->resource_category_id==$data->category_id){{'selected'}}@endif>{{$data->category_label}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="invalid-feedback">
                            Pilih Category
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <textarea class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Enter Link">@php
                              if($resource->resource_link){
                                $decode_link = json_decode($resource->resource_link, true);
                                $fetch = "";
                                foreach($decode_link as $row){
                                $fetch .= $row . "; ";
                                }
                                echo $fetch;
                              }
                                @endphp
                        </textarea>
                        @error('link')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="preview">Preview</label>
                        <textarea class="form-control @error('preview') is-invalid @enderror" id="preview" name="preview" placeholder="Enter Preview">@php
                              if($resource->resource_preview){
                                $decode_preview = json_decode($resource->resource_preview, true);
                                $fetch = "";
                                foreach($decode_preview as $row){
                                $fetch .= $row . "; ";
                                }
                                echo $fetch;
                              }
                                @endphp
                        </textarea>
                        @error('preview')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="active" name="active" @if($resource->resource_active){{'checked'}}@endif>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil"></i> Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin')
<!-- Select2 -->
<script src="{{URL::asset('assets/js/select2/js/select2.full.min.js')}}"></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2-category').select2()
        $('.select2-source').select2()
    });
</script>
@endpush