@extends("layouts.default")

@section("content")

    <div id="calendar"></div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section("js")

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfTokenMeta = document.querySelector("meta[name='csrf-token']");
            if (!csrfTokenMeta) {
                console.error("CSRF token meta tag not found");
                return;
            }
            
            const csrfToken = csrfTokenMeta.content;

            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                events: "./admin/get-all-slots",
                slotDuration: "01:00",
                slotMinTime: "08:00",
                slotMaxTime: "20:00",
                expandRows: true,
                initialView: 'timeGridWeek',
                locale: "fr",
                selectable: true,
                buttonText: {
                    today: "Aujourd'hui"
                },
                eventClick: async function(info) {
                    try {
                        const response = await fetch("./slots/take-slot", {
                            method: "POST",
                            headers: {
                                "Accept": "application/json",
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken
                            },
                            credentials: "same-origin",
                            body: JSON.stringify({
                               id: info.event.id
                            })
                        });

                        const result = await response.json();
                        if (result && result.error === false) {
                            calendar.refetchEvents();
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            });
            calendar.render();
        });
    </script>

@endsection