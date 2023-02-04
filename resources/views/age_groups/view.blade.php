@extends('layouts.core')

@section('title', 'View | Age Group Management')
    
@section('content')
    @include('age_groups.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Age Group Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Age Group Bracket' => $age_group->bracket,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $val}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop
