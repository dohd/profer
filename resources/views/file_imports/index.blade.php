@extends('layouts.core')

@section('title', 'File Import Management')
    
@section('content')
    @include('file_imports.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                {{ Form::open(['route' => 'file_imports.store', 'method' => 'POST', 'files' => true, 'class' => 'form']) }}
                    <div class="row p-2">
                        <div class="col-md-3 col-12">
                            <label for="date">Date</label>
                            {{ Form::date('date', null, ['class' => 'form-control mt-2']) }}
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="file_category">File Category</label>
                            <select name="category_dir" id="category_dir" class="custom-control col-12 mt-3">
                                <option value="">-- Select Category --</option>
                                @foreach (['participant_list' => 'Participant List'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            {{ Form::hidden('category', null, ['id' => 'category']) }}
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label" for="file">File</label>
                            {{ Form::file('file', ['class' => 'form-control', 'id' => 'file', 'accept' => '.csv, .pdf, .xls, .xlsx, .doc, .docx', 'required' => 'required' ]) }}
                        </div>
                        <div class="col-md-2 col-12">
                            {{ Form::submit('Upload', ['class' => 'btn btn-primary', 'style' => 'margin-top: 2em']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless" id="fileImportsTbl">
                        <thead>
                            <tr>
                                <th scope="col">#No</th>
                                <th scope="col">File Name</th>
                                <th scope="col">File Category</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    $('#category_dir').change(function() {
        $('#category').val($(this).find(':selected').text());
    });
    

    // fetch file imports
    $.post("{{ route('file_imports.datatable') }}", data => {
        $('#fileImportsTbl tbody').html(data);
        new simpleDatatables.DataTable($('#fileImportsTbl')[0]);
    });
</script>
@stop

