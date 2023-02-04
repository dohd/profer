@extends('layouts.core')

@section('title', 'View | Disability Management')
    
@section('content')
    @include('disabilities.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Disability Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Disability' => $disability->name,
                            'Code' => $disability->code,
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
