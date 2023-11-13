@extends('layouts.core')

@section('title', 'External Meetings Report')
    
@section('content')
    @include('reports.partial.monthly_meetings_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <label for="month">Report Month</label>
                        <input type="text" value="{{ date('m-Y') }}" id="month" class="form-control datepicker" readonly>
                    </div>
                    <div class="col-md-2 col-12">
                        {{ Form::submit('Generate', ['class' => 'btn btn-primary mt-4']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="card-title p-0 pt-2 m-0">MEETING DATA REPORT - NOVEMBER 2023</div>
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
                            <tr>
                                <td>Sample Meeting</td>
                                <td>Nairobi</td>
                                <td>Teachers</td>
                                <td>01-11-2023</td>
                                @foreach (range(1,6) as $n)
                                    <td>1</td>
                                @endforeach
                                <td>6</td>                    
                            </tr>
                            <tr>
                                <td>Sample Meeting 2</td>
                                <td>Mombasa</td>
                                <td>Farmers</td>
                                <td>10-12-2023</td>
                                @foreach (range(1,6) as $n)
                                    <td>2</td>
                                @endforeach
                                <td>12</td>                    
                            </tr>
                        </tbody>
                        <tfoot class="bg-light bg-gradient">
                            <tr>
                                <th colspan="4">Total</th>
                                @foreach (range(1,6) as $n)
                                    <td>3</td>
                                @endforeach
                                <td>18</td>  
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
                            <tr>
                                <td colspan="4">Physical Disability</td>
                                @foreach (range(1,6) as $n)
                                    <td>1</td>
                                @endforeach
                                <td>6</td>
                            </tr>
                            <tr>
                                <td colspan="4">Multiple Disability</td>
                                @foreach (range(1,6) as $n)
                                    <td>2</td>
                                @endforeach
                                <td>12</td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light bg-gradient">
                            <tr>
                                <th colspan="4">Total</th>
                                @foreach (range(1,6) as $n)
                                    <td>3</td>
                                @endforeach
                                <th>18</th>
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

