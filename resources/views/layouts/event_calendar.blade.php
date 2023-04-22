@extends('layouts.core')

@section('title', 'Event Calendar')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Event Calendar</h5>
            <div class="card-content p-2">
                <div class="row">
                    <div class="col-12">
                        <div id="eventCalendar"></div>
                        <script>            
                            let stateCheck = setInterval(() => {
                                if (document.readyState === 'complete') {
                                    clearInterval(stateCheck);
                                    // document ready
                                    let events = @json($events);
                                    events = events.map(v => ({
                                        start: v.start_date,
                                        end: v.end_date,
                                        title: v.activity.name || '',
                                        startEditable: false,
                                    }));
                                    // console.log(events)
                                    
                                    let ec = new EventCalendar(document.getElementById('eventCalendar'), {
                                        events,
                                        view: 'dayGridMonth',
                                        headerToolbar: {
                                            start: 'prev,next today',
                                            center: 'title',
                                            end: 'dayGridMonth,listWeek'
                                        },
                                        eventTimeFormat: time => '',
                                    }); 
                                }           
                            }, 100);                    
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop