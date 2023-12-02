@foreach ($agenda as $i => $agenda_row)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ dateFormat($agenda_row->date, 'd-M-Y') }}<br><b>{{ $agenda_row->title }}</b></td>
        <td class="p-0" colspan="2">
            @php
                // filter agenda items by narrative responses
                $agenda_items = [];
                foreach ($agenda_row->items as $agenda_item) {
                    $has_response = false;
                    foreach ($agenda_row->narrative->items as $item) {
                        if (@$item->narrative_pointer->value && $item->agenda_item_id == $agenda_item->id) {
                            if ($item->response) {
                                $agenda_items[] = $agenda_item;
                                $has_response = true;
                            }
                        }
                        if ($has_response) break;
                    }
                }
            @endphp

            <table class="table table-bordered m-0 p-0">
                @foreach ($agenda_items as $agenda_item)
                    <tr>
                        <td>{{ timeFormat($agenda_item->time_from) }} - {{ timeFormat($agenda_item->time_to) }} <br> <b>{{ $agenda_item->topic }}</b></td>
                        <td class="p-0">
                            <table class="table table-bordered m-0 p-0">
                                @if ($agenda_row->narrative)
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach ($agenda_row->narrative->items as $item)
                                        @if (@$item->narrative_pointer->value && $item->agenda_item_id == $agenda_item->id)
                                            <tr>
                                                <td class="quiz">{{ $n }}. {{ $item->narrative_pointer->value }}</td>
                                                <td>{{ $item->response }}</td>
                                            </tr>  
                                            @php
                                                $n++;
                                            @endphp
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
