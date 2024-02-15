@extends('layouts.core')

@section('title', 'View | Deadline Management')
    
@section('content')
    @include('deadlines.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Deadline Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $due = 0;
                        $total = 0;
                        $overdue = 0;
                        if ($deadline->module == 'ACTION-PLAN') {
                            $due = $deadline->action_plans()->whereDate('created_at', '<=', $deadline->date)->count();
                            $total = $deadline->action_plans()->count();
                            $overdue = $total - $due;
                        } elseif ($deadline->module == 'AGENDA') {
                            $due = $deadline->agendas()->whereDate('created_at', '<=', $deadline->date)->count();
                            $total = $deadline->agendas()->count();
                            $overdue = $total - $due;
                        }
                        
                        $details = [
                            'Subject' => $deadline->subject,
                            'Deadline Date' => dateFormat($deadline->date, 'd-M-Y'),
                            'Module' => $deadline->module,
                            'Status' => $deadline->active_status,
                            'Due Submissions' => $due? "{$due} / {$total}" : 0,
                            'Overdue Submissions' => $overdue? "{$overdue} / {$total}" : 0,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>
                                {{ $val}}
                            </td>
                        </tr>
                    @endforeach
                </table><br>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    
</script>
@endsection
