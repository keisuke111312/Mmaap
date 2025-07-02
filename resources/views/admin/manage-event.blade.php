@extends('layouts.admin.master')
@section('ribbon')
    @include('ribbon.calendar')
@endsection
@section('content')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

    @include('components.admin.event-modal')


    <script>
        // Pass PHP events to JS

        function isoToMysqlDatetime(isoString) {
            const d = new Date(isoString);
            // yyyy-mm-dd hh:mm:ss
            const yyyy = d.getFullYear();
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const dd = String(d.getDate()).padStart(2, '0');
            const hh = String(d.getHours()).padStart(2, '0');
            const mi = String(d.getMinutes()).padStart(2, '0');
            const ss = String(d.getSeconds()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd} ${hh}:${mi}:${ss}`;
        }

        function openEventModal(startISO, endISO) {
            console.log('cliked');

            document.getElementById('eventModalOverlay').style.display = 'block';

            // Convert ISO to MySQL datetime format
            const startFormatted = isoToMysqlDatetime(startISO);
            const endFormatted = isoToMysqlDatetime(endISO);

            document.getElementById('start_hidden').value = startFormatted;
            document.getElementById('end_hidden').value = endFormatted;

            // For visible date input, just show yyyy-mm-dd (optional)
            const dateOnly = startFormatted.split(' ')[0];
            document.getElementById('start_display').value = dateOnly;
        }

        function closeEventModal() {
            document.getElementById("eventModalOverlay").style.display = "none";

            console.log('clicked');

        }
        const rawEvents = @json($events);

        // Build FullCalendar event objects
        const events = rawEvents.map(ev => ({
            title: ev.title,
            start: ev.start,
            end: ev.end || null,
            allDay: ev.allDay ?? false,
            extendedProps: {
                eventType: ev.extendedProps?.eventType ?? ev.eventType ?? ev.type ?? '',
                location: ev.extendedProps?.location ?? ev.location ?? '',
                instructor: ev.extendedProps?.instructor ?? ev.instructor ?? '',
                description: ev.extendedProps?.description ?? ev.description ?? ''
            },
            backgroundColor: ev.backgroundColor || ev.color || '#6c757d'
        }));

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            let selectedEl = null;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listMonth'
                },
                select: function(info) {
                    openEventModal(info.start.toISOString(), info.end.toISOString());
                },
                dateClick: function(info) {
                    openEventModal(info.dateStr, info.dateStr);
                },
                events: events,
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    showEventDetails(info.event, info.el);
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                height: 'auto',
                eventDisplay: 'block',
                dayMaxEvents: 3
            });

            calendar.render();

            function showEventDetails(event, el) {
                if (selectedEl) selectedEl.classList.remove('selected');
                el.classList.add('selected');
                selectedEl = el;

                document.getElementById('noEventSelected').style.display = 'none';
                const det = document.getElementById('eventDetails');
                det.classList.add('active');

                document.getElementById('eventTitle').textContent = event.title;
                const badge = document.getElementById('eventTypeBadge');
                badge.textContent = event.extendedProps.eventType;
                badge.style.backgroundColor = event.backgroundColor;

                document.getElementById('eventDateTime').textContent = formatEventDate(event);

                toggleItem('locationItem', 'eventLocation', event.extendedProps.location);
                toggleItem('instructorItem', 'eventInstructor', event.extendedProps.instructor);
                toggleItem('descriptionItem', 'eventDescription', event.extendedProps.description);
            }

            function toggleItem(itemId, textId, value) {
                const item = document.getElementById(itemId);
                if (value) {
                    document.getElementById(textId).textContent = value;
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            }

            function formatEventDate(event) {
                const start = new Date(event.start);
                const end = event.end ? new Date(event.end) : null;
                const optsDate = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                let str = start.toLocaleDateString('en-US', optsDate);

                if (!event.allDay) {
                    const optsTime = {
                        hour: '2-digit',
                        minute: '2-digit'
                    };
                    str += ' at ' + start.toLocaleTimeString('en-US', optsTime);
                    if (end && end.toDateString() === start.toDateString()) {
                        str += ' - ' + end.toLocaleTimeString('en-US', optsTime);
                    }
                } else if (end && end.toDateString() !== start.toDateString()) {
                    str += ' - ' + end.toLocaleDateString('en-US', optsDate);
                }
                return str;
            }
        });
    </script>

    <script>
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background: ${type === 'success' ? '#28a745' : '#dc3545'};
            color: white;
            border-radius: 4px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>

    <script>
        @if (session('success'))
            showNotification("{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            showNotification("{{ session('error') }}", 'error');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showNotification("{{ $error }}", 'error');
            @endforeach
        @endif
    </script>
@endsection
