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
                            <th scope="col">#No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Person</th>
                            <th scope="col">Alt. Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($donors as $i => $donor)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><a href="{{ route('donors.show', $donor) }}">{{ $donor->name }}</a></td>
                                    <td>{{ $donor->phone }}</td>
                                    <td>{{ $donor->email }}</td>
                                    <td>{{ $donor->contact_person }}</td>
                                    <td>{{ $donor->alternative_phone }}</td>
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
