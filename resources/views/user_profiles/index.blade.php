@extends('layouts.core')

@section('title', 'User Profile Management')
    
@section('content')
    @include('user_profiles.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th>#No</th>
                            <th>Role</th>
                            <th width="20%">Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $user)
                                <tr>
                                    <th scope="row" style="height: {{ count($users) == 1? '80px': '' }}">{{ $i+1 }}</th>
                                    <td>{{ @$user->roles()->first()->name }}</td>
                                    <td>
                                        <div class="row g-0">
                                            <div class="col-md-3 col-12">
                                                <img src="{{ asset('img/profile-img.jpeg') }}" alt="Profile" class="rounded-circle" width="40" height="40"/>
                                            </div>
                                            <div class="col-md-9 col-12 pt-2 ps-1">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->is_active? 'success' : 'secondary' }} modal-btn" style="cursor:pointer;" role="button" data-bs-toggle="modal" data-bs-target="#status_modal" data-url="{{ route('user_profiles.update', $user) }}">
                                            {{ $user->is_active? 'Active' : 'Inactive' }} <i class="bi bi-caret-down-fill"></i>
                                        </span>
                                    </td>
                                    <td>{!! $user->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('user_profiles.partial.status_modal')
@stop

@section('script')
<script>
    const formAttr = {url: '', status: 'Active'};
    $('table').on('click', '.modal-btn', function() {
        formAttr.url = $(this).attr('data-url');
        formAttr.status = $(this).text().replace(/\s+/g,'');
    });
    $('#status_modal').on('shown.bs.modal', function() {
        $(this).find('form').attr('action', formAttr.url);
        $(this).find('select#status').val((formAttr.status == 'Active'? 1 : 0));
    });
</script>
@stop