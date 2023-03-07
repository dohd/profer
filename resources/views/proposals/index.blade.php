@extends('layouts.core')

@section('title', 'Proposal Management')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Status</th>
                                    <td>Pending</td>
                                    <td>Approved</td>
                                    <td>Rejected</td>
                                </tr>
                                <tr>
                                    <th>Count</th>
                                    <td>{{ numberFormat($pending_count, 0) }}</td>
                                    <td>{{ numberFormat($approved_count, 0) }}</td>
                                    <td>{{ numberFormat($rejected_count, 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless" id="proposal_tbl">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Status</th>
                        <th scope="col">Donor</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    $.post("{{ route('proposals.datatable') }}", data => {
        $('#proposal_tbl tbody').html(data);
        new simpleDatatables.DataTable($('#proposal_tbl')[0]);
    });
</script>
@stop
