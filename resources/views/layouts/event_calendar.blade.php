<div class="row">
    <div class="col-12">
        <div id="eventCalendar"></div>
        <script>            
            let stateCheck = setInterval(() => {
                if (document.readyState === 'complete') {
                    clearInterval(stateCheck);
                    // document ready
                    let ec = new EventCalendar(document.getElementById('eventCalendar'), {
                        view: 'dayGridMonth',
                        headerToolbar: {
                            start: 'prev,next today',
                            center: 'title',
                            end: 'dayGridMonth,listWeek'
                        },
                        events: [
                            {
                                start: '2023-04-22 08:00:00',
                                end: '2023-04-22 17:00:00',
                                title: 'Sample Event 1',
                                startEditable: false,
                            },
                            {
                                start: '2023-04-22 08:00:00',
                                end: '2023-04-22 17:00:00',
                                title: 'Sample Event 2',
                                startEditable: false,
                            },
                            {
                                start: '2023-04-21',
                                end: '2023-04-22 17:00:00',
                                title: 'Sample Event 3',
                                startEditable: false,
                            }
                        ]
                    }); 
                }           
            }, 100);                    
        </script>
    </div>
</div>
