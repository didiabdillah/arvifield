@extends('layout/layout')

@section('title', 'resource')

@section('page')

@include('layout.flash_alert')

<div class="mt-4">
    <h2>Resource</h2>

    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <a href="{{route('resource_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Resource</a>

            </div>
            <div class="card-body">

                <table class="table table-bordered table-hover table-striped projects" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Label</th>
                            <th scope="col">Category</th>
                            <th scope="col">Source</th>
                            <th scope="col">Link</th>
                            <th scope="col">Preview</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resource as $data)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$data->resource_label}}</td>
                            <td>{{$data->category_label}}</td>
                            <td>{{$data->source_label}}</td>
                            <td>
                                @if($data->resource_link)
                                @php
                                $decode_link = json_decode($data->resource_link, true);
                                @endphp
                                @foreach($decode_link as $row)
                                <a href="{{$row}}">{{Str::limit($row, 15)}}</a>
                                <br>
                                @endforeach
                                @else
                                {{"-"}}
                                @endif
                            </td>
                            <td>
                                @if($data->resource_preview)
                                @php
                                $decode_preview = json_decode($data->resource_preview, true);
                                @endphp
                                @foreach($decode_preview as $row)
                                <img src="{{$row}}" alt="{{Str::limit($row, 15)}}" style="width:100px; height:100px; object-fit: contain;" />
                                @endforeach
                                @else
                                {{"-"}}
                                @endif
                            </td>
                            <td>
                                @if($data->resource_active == true)
                                <h5><span class="badge badge-success">Active</span></h5>
                                @else
                                <h5><span class="badge badge-danger">Deactive</span></h5>
                                @endif
                            </td>
                            <td>
                                <form action="{{route('resource_destroy', $data->resource_id)}}" method="POST" class="form-inline form-horizontal">
                                    @csrf
                                    @method('delete')

                                    <a class="btn btn-primary btn-sm ml-1" href="{{route('resource_edit', $data->resource_id)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        {{__('id.edit')}}
                                    </a>

                                    <button class="btn btn-danger btn-sm btn-remove ml-1" type="submit">
                                        <i class="fas fa-trash">
                                        </i>
                                        {{__('id.remove')}}
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin')
<script>
    $(function() {
        $('#myTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "lengthMenu": [50, 100, 200, 500],
        });
    });

    // --------------
    // Delete Button
    // --------------
    $('.btn-remove').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Anda Yakin?',
            text: "Data Yang Terhapus Tidak Dapat Dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endpush