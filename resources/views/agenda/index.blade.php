@extends('layouts.core')

@section('title', 'Agenda Management')
    
@section('content')
    @include('agenda.header')
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
                            @foreach ($agenda as $i => $agenda)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><a href="{{ route('agenda.show', $agenda) }}">{{ $agenda->name }}</a></td>
                                    <td>{{ $agenda->phone }}</td>
                                    <td>{{ $agenda->email }}</td>
                                    <td>{{ $agenda->contact_person }}</td>
                                    <td>{{ $agenda->alternative_phone }}</td>
                                    <td>{!! $agenda->action_buttons !!}</td>
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
