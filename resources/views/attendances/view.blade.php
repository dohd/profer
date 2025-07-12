@extends('layouts.core')
@section('title', 'View | Attendance Management')
    
@section('content')
    @include('attendances.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Attendance Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Family Name' => @$attendance->family_name,                            
                            'Date' => dateFormat($attendance->date, 'd-M-Y'),
                            'Compiled By' => $attendance->prepared_by,
                            'Member List File' => $attendance->doc_file,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>
                                @if ($key == 'Member List File' && $val)
                                    <a href="{{ route('storage.file_download', 'attendance,' . $attendance->doc_file) }}" target="_blank">{{ $val }}<i class="bi bi-download h5 ms-2"></i></a>
                                    <span class="del ms-3" style="cursor: pointer;" name="doc_file"><i class="bi bi-trash text-danger icon-xs"></i></span>
                                @else  
                                    {{ $val}}  
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>

                <!-- participants -->     
                <div class="table-responsive">
                    <table class="table table-cstm" id="participants_tbl">
                        <thead>
                            <tr class="table-primary">
                                <th>#</th>
                                <th>Member Name</th>
                                <th>Residence</th>
                                <th>Phone No.</th>
                                <th>Gender</th>
                                <th width="10%">Age Group</th>                                
                                <th>Male</th>
                                <th>Female</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance->items as $i => $item)
                                <tr>
                                    <td class="p-3 num">{{ $i+1 }}</td>
                                    <td>{{ @$item->member_name }}</td>
                                    <td>{{ @$item->residence }}</td>
                                    <td>{{ @$item->phone_no }}</td>
                                    <td>{{ @$item->gender }}</td>
                                    <td>{{ @$item->age_group->bracket }}</td>
                                    <td>{{ $item->male }}</td>
                                    <td>{{ $item->female }}</td>
                                    <td>{{ $item->total }}</td>                          
                                </tr>
                            @endforeach
                            <tr class="bg-light bg-gradient">
                                <td colspan="6"><b>Total</b></td>
                                <td><b>{{ $attendance->items->sum('male') }}</b></td>
                                <td><b>{{ $attendance->items->sum('female') }}</b></td>
                                <td><b>{{ $attendance->items->sum('total') }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    $(document).on('click', '.del', function() {
        const field = $(this).attr('name');
        const attendance_id = @json($attendance->id);
        const url = @json(route('attendances.delete_file'));
        if (confirm('Are you sure?')) {
            $.post(url, {attendance_id, field})
            .done((data) => flashMessage(data))
            .catch((data) => flashMessage(data));
        }
    });
</script>
@endsection