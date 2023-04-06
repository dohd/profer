@extends('layouts.core')

@section('title', 'Proposal Management')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row">
                    <div class="col-5">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th rowspan="2">Proposal Status <div>&nbsp;</div></th>
                                    <td rowspan="2">Pending <div>&nbsp;</div></td>
                                    <td rowspan="2">Approved <div>&nbsp;</div></td>
                                    <td rowspan="2">Review <div>&nbsp;</div></td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <th>Count</th>
                                    <td>{{ numberFormat(@$status_count['pending'], 0) }}</td>
                                    <td>{{ numberFormat(@$status_count['approved'], 0) }}</td>
                                    <td>{{ numberFormat(@$status_count['review'], 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-7">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Approved Proposal</th>
                                    <td>W/O Log Frame</td>
                                    <td>W/O Action Plan</td>
                                    <td>W/O Participant</td>
                                    <td>W/O Narrative</td>
                                </tr>
                                <tr>
                                    <th>Count</th>
                                    <td>{{ numberFormat(@$status_count['pending'], 0) }}</td>
                                    <td>{{ numberFormat(@$status_count['approved'], 0) }}</td>
                                    <td>{{ numberFormat(@$status_count['review'], 0) }}</td>
                                    <td>{{ numberFormat(@$status_count['review'], 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5"></div>
                    <div class="col-7">
                        <select name="" id="" class="custom-control col-4">
                            <option value="">-- Select Filter --</option>
                            <option value="">W/O Log Frame</option>
                            <option value="">W/O Action Plan</option>
                            <option value="">W/O Participant</option>
                            <option value="">W/O Narrative</option>
                        </select>
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
