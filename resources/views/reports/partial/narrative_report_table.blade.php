@foreach ($agenda as $i => $agenda_row)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $agenda_row->title }}</td>
        <td class="p-0" colspan="2">
            <table class="table table-bordered m-0 p-0">
                @foreach ($agenda_row->items as $agenda_item)
                    <tr>
                        <td>{{ timeFormat($agenda_item->time_from) }} - {{ timeFormat($agenda_item->time_to) }} <br> <b>{{ $agenda_item->topic }}</b></td>
                        <td class="p-0">
                            <table class="table table-bordered m-0 p-0">
                                @if ($agenda_row->narrative)
                                    @php($n=1)
                                    @foreach ($agenda_row->narrative->items as $item)
                                        @if (@$item->narrative_pointer->value && $item->agenda_item_id == $agenda_item->id)
                                            <tr>
                                                <td>{{ $n }}. {{ $item->narrative_pointer->value }}</td>
                                                <td>{{ $item->response }}</td>
                                            </tr>  
                                            @php($n++) 
                                        @endif
                                    @endforeach
                                @endif
                            </table>
                        </td>                                        
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>   
@endforeach                  
