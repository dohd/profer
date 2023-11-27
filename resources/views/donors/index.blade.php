@extends('layouts.core')

@section('title', 'Donor Management')
    
@section('content')
    @include('donors.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th>#No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Contact Person</th>                            
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($donors as $i => $donor)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td>{{ $donor->name }}</td>
                                    <td>{{ $donor->phone }}</td>
                                    <td>{{ $donor->email }}</td>
                                    <td>{{ $donor->contact_person }}</td>
                                    <td>{!! $donor->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    
</script>
@stop
