@extends('layouts.core')

@section('title', 'Monthly Meetings Report')
    
@section('content')
    @include('reports.partial.monthly_meetings_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="row">
                    {{-- <div class="col-md-3 col-12">
                        <label for="month">Report Month</label>
                        <select id="month" class="custom-select col-12 mt-2">
                            <option value="">-- Select Month --</option>
                            @foreach (range(1,12) as $no)
                                <option value="{{ $no }}">
                                    {{ DateTime::createFromFormat('!m', $no)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-3">
                        <label for="month">Report Month</label>
                        <input type="text" value="{{ date('m-Y') }}" id="month" class="form-control datepicker" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="card-title p-0 pt-2 m-0">MONTHLY MEETING REPORT - NOVEMBER 2023</div>
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead class="bg-light bg-gradient">
                            <tr>
                                <th colspan="4"></th>
                                <th colspan="2">PWDs</th>
                                <th colspan="2">Families & Support Ps</th>
                                <th colspan="2">Others</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Meeting Description</th>
                                <th>Activity Venue</th>
                                <th>Target Group</th>
                                <th>Activity Date</th>
                                @foreach (range(1,3) as $i)
                                    <th>M</th>
                                    <th>F</th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>Sample Meeting</td>
                            <td>Nairobi</td>
                            <td>Teachers</td>
                            <td>01-11-2023</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>6</td>                    
                        </tbody>
                        <tfoot class="bg-light bg-gradient">
                            <tr>
                                <th colspan="4">Total</th>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>6</td>  
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div> 

    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead class="bg-light bg-gradient">
                            <tr>
                                <th colspan="4"></th>
                                @foreach (['Under 18 Yrs', '18-35 Yrs', '36 Yrs & Above'] as $value)
                                    <th colspan="2">{{ $value }}</th>
                                @endforeach
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="4">Type of Disability</th>
                                @foreach (range(1,3) as $i)
                                    <th>M</th>
                                    <th>F</th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td colspan="4">Physical Disability</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>6</td>
                        </tbody>
                        <tfoot class="bg-light bg-gradient">
                            <tr>
                                <th colspan="4">Total</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>6</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div> 
@stop

@section('script')
<script>
    $('#month').datepicker({
        autoHide: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        format: 'MM-yyyy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
</script>
@stop

