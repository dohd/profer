@extends('layouts.core')

@section('title', 'File Import Management')
    
@section('content')
    @include('file_imports.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                {{ Form::open(['route' => 'file_imports.store', 'method' => 'POST', 'files' => true, 'class' => 'form']) }}
                    <div class="row p-2">
                        <div class="col-md-6 col-12 mt-2 mb-3">
                            @php
                                $categories = [
                                    // 'self_advocates' => 'Self-Advocates',
                                    // 'families' => 'Families',
                                    // 'support_groups' => 'Support Groups',
                                ];
                            @endphp
                            <select name="category" id="category" class="custom-control col-12" required>
                                <option value="">-- Select Template Category --</option>
                                <!-- <optgroup label="Rightholder List">
                                    @foreach ([] as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </optgroup> -->
                                <!-- <optgroup label="Timesheet">
                                    <option value="employee_timesheet">Employee Timesheet</option>
                                </optgroup> -->
                            </select>
                        </div>
                        <div class="col-md-12 bg-light pt-3 mb-2">
                            <p>
                                Data format should be as per downloaded template. 
                                <a href="#" class="ms-1 dn-link" download><u><b>Click here to download</b></u></a>
                            </p>
                        </div>
                        <hr style="border: none; border-bottom: 2px solid black;">
                    </div>

                    <div class="row p-2 d-none">
                        <label class="form-label col-md-2" for="employee">Employee Name</label>
                        <div class="col-md-6 col-12">
                            {{ Form::text('employee', null, ['class' => 'form-control', 'placeholder' => 'Employee Name', 'id' => 'employee' ]) }}
                        </div>
                    </div>
                    <div class="row p-2 d-none">
                        <label class="form-label col-md-2" for="month_start">Month Starting</label>
                        <div class="col-md-6 col-12">
                            {{ Form::date('month_start', null, ['class' => 'form-control', 'id' => 'month_start' ]) }}
                        </div>
                    </div>

                    <div class="row p-2">
                        <label class="form-label col-md-2" for="file"></label>
                        <div class="col-md-6 col-12">
                            {{ Form::file('file', ['class' => 'form-control', 'id' => 'file', 'accept' => '.xls, .xlsx', 'required' => 'required' ]) }}
                        </div>
                        <div class="col-md-2 col-12">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Import</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <!-- <div class="card">
        <div class="card-body">
            <div class="card-content">
                <div class="card-content p-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="true">
                                Employee Timesheet
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                            <div class="table-responsive">
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>#No.</th>
                                            <th>Employee Name</th>
                                            <th>Month Starting</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($timesheets as $i => $item)
                                            <tr>
                                                <th>{{ $i+1 }}</th>
                                                <td>{{ $item->employee }}</td>
                                                <td>{{ dateFormat($item->month_start,'d-M-Y') }}</td>
                                                {{-- <td><span class="badge bg-{{ $item->status == 'Approved'? 'success' : 'secondary' }}">{{ $item->status }}</span></td> --}}
                                                <td>{{ dateFormat($item->updated_at, 'd-M-Y') }}</td>
                                                <th>
                                                    <span class="mx-2">
                                                        <a href="{{ route('storage.file_download', 'files,timesheet,' . $item->file_name) }}" target="_blank"><i class="bi bi-download h5 ms-2"></i></a>
                                                    </span>
                                                    <span class="mx-2">
                                                        <a class="destroy" href="javascript:">
                                                            <i class="bi bi-trash text-danger icon-xs"></i>
                                                            <form action="{{ route('file_imports.destroy', $item) }}" method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            </form>
                                                        </a>
                                                    </span>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   -->  
@stop

@section('script')
<script>
    $('#category').change(function() {
        // default anchor link
        if (this.value) {
            $('.dn-link').attr('href', "{{ asset('storage/import_templates') }}/" + this.value  + '.xls');
        } else {
            $('.dn-link').attr('href', '#');
        }  
        
        // template rules
        $('.dn-link').parents('p').next().remove();
        if (['families', 'self_advocates'].includes(this.value)) {
            const el = '<p><span class="text-danger">*</span> <b><i>Column4 - DOB must be Fomarted as General Text instead of Date</i></b></p>';
            $('.dn-link').parents('p').after(el);
        }      
        if (this.value == 'employee_timesheet') {
            $('#employee, #month_start').parents('div.row').removeClass('d-none');
            $('.dn-link').parents('div:first').addClass('d-none');
        } else {
            $('#employee, #month_start').parents('div.row').addClass('d-none');
            $('.dn-link').parents('div:first').removeClass('d-none');
        }
    });
    $('#category').val('');
</script>
@stop

