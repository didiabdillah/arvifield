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
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td></td>
                        </tr>

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
</script>
@endpush