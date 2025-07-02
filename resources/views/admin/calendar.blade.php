@extends('layouts.admin.master')

@section('content')
    <div class="calendar-flex-container">
        <div id="calendar"></div>
        <aside id="eventDetailPanel" class="event-detail-panel collapsed">
            <button type="button" class="close-btn" onclick="closeEventDetailPanel()">&times;</button>
            <div id="eventDetailContent">
                <div id="eventDetailDefault" class="event-detail-default">
                    <p style="color:#bbb;text-align:center;margin-top:40%;">Select an event to see details</p>
                </div>
                <div id="eventDetailData" style="display:none;">
                    <div id="eventDetailImageContainer" class="event-detail-image"></div>
                    <h2 id="eventDetailTitle"></h2>
                    <div id="eventDetailDescription" class="event-detail-description"></div>
                    <div class="event-detail-row"><i class="fas fa-calendar-alt"></i> <strong>Date:</strong> <span id="eventDetailDate"></span></div>
                    <div class="event-detail-row"><i class="fas fa-clock"></i> <strong>Time:</strong> <span id="eventDetailTime"></span></div>
                    <div class="event-detail-row"><i class="fas fa-hourglass-half"></i> <strong>Duration:</strong> <span id="eventDetailDuration"></span></div>
                    <div class="event-detail-row"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> <span id="eventDetailLocation"></span></div>
                    <div class="event-detail-row"><i class="fas fa-bell"></i> <strong>Reminder:</strong> <span id="eventDetailReminder"></span></div>
                </div>
            </div>
        </aside>
    </div>

    @include('components.admin.event-modal')

    <style>
        body {
            background: #f7f8fa;
            font-family: 'Inter', sans-serif;
        }
    
        .calendar-flex-container {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            max-width: 1440px;
            margin: 0 auto;
            padding: 40px 16px;
            /* gap: 32px; */
            flex-wrap: wrap;
        }
        
    
        #calendar {
            flex: 1 1 1000px;
            min-width: 320px;
            background: #fff;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            padding: 32px 24px;
            transition: box-shadow 0.2s;
        }
    
        /* FullCalendar overrides */
        .fc {
            background: transparent;
        }
    
        .fc-daygrid-day {
            border: 1px solid #ececec;
            background: #fff;
            transition: background 0.2s;
        }
    
        .fc-daygrid-day:hover {
            background: #f3f6fa;
        }
    
        .fc-daygrid-event {
            background: none;
        }
    
        .fc-event {
            border: none;
            background: #ed1c24;
            color: #ffffff;
            padding: 4px 14px;
            font-weight: 600;
            font-size: 0.98rem;
            box-shadow: 0 2px 8px rgba(80,120,255,0.07);
            display: flex;
            align-items: center;
            /* gap: 8px; */
            transition: background 0.18s, box-shadow 0.18s;
        }
    
        .fc-event:hover {
            background: #ed1c24;
            box-shadow: 0 4px 16px rgba(80,120,255,0.13);
        }
    
        .fc-event .fc-event-title {
            font-weight: bold;
        }
    
        .fc-event .fc-event-icon {
            margin-right: 6px;
            font-size: 1.1em;
        }
    
        .event-detail-panel {
            width: 400px;
            max-width: 100vw;
            background: #fff;
            box-shadow: 0 4px 24px rgba(0,0,0,0.09);
            padding: 0;
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 500px;
            transition: transform 0.3s cubic-bezier(.4,0,.2,1), opacity 0.2s, right 0.3s;
            overflow: hidden;
        }
    
        .event-detail-panel.collapsed {
            right: -420px;
            opacity: 0.5;
            pointer-events: none;
        }
    
        .event-detail-panel:not(.collapsed) {
            right: 0;
            opacity: 1;
            pointer-events: auto;
        }
    
        .event-detail-panel .close-btn {
            position: absolute;
            top: 18px;
            right: 18px;
            background: none;
            border: none;
            font-size: 2rem;
            color: #bbb;
            cursor: pointer;
            transition: color 0.18s;
            z-index: 2;
        }
    
        .close-btn:hover {
            color: #e63946;
        }
    
        .event-detail-image {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #e3eafe 0%, #f7f8fa 100%);
            border-radius: 0 0 18px 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
    
        .event-detail-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    
        .event-detail-description {
            color: #444;
            font-size: 1.08rem;
            margin-bottom: 1.2rem;
            padding: 0 24px;
        }
    
        .event-detail-row {
            margin-bottom: 0.7rem;
            color: #232323;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 24px;
        }
    
        .event-detail-panel h2 {
            color: #457b9d;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.7rem;
            padding: 0 24px;
        }
    
        .event-detail-panel .event-detail-default {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #bbb;
            font-size: 1.1rem;
            padding: 40px 0;
        }
    
        @media (max-width: 1024px) {
            .calendar-flex-container {
                flex-direction: column;
                align-items: stretch;
            }
    
            .event-detail-panel {
                width: 100%;
                border-radius: 18px 18px 0 0;
                min-height: 320px;
            }
        }
    
        @media (max-width: 600px) {
            #calendar {
                padding: 8px 2px 18px 2px;
            }
    
            .event-detail-panel {
                padding: 0;
                min-height: 220px;
            }
    
            .event-detail-row, .event-detail-panel h2, .event-detail-description {
                padding: 0 8px;
            }
        }
    </style>
    

    <script>
        const eventsFromBackend = @json($events);
    </script>

    <script>
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
            const modal = document.getElementById('eventModalOverlay');
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';

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
            const modal = document.getElementById('eventModalOverlay');
            modal.style.display = 'none';
        }

        // Show event detail side panel with image or placeholder
        function showEventDetail(eventObj) {
            document.getElementById('eventDetailDefault').style.display = 'none';
            document.getElementById('eventDetailData').style.display = 'block';
            document.getElementById('eventDetailPanel').classList.remove('collapsed');
            document.getElementById('eventDetailTitle').textContent = eventObj.title || 'No Title';
            document.getElementById('eventDetailDescription').textContent = eventObj.description || 'No Description';
            document.getElementById('eventDetailDate').textContent = eventObj.date || '-';
            document.getElementById('eventDetailTime').textContent = eventObj.time || '-';
            document.getElementById('eventDetailDuration').textContent = eventObj.duration || '-';
            document.getElementById('eventDetailLocation').textContent = eventObj.location || '-';
            document.getElementById('eventDetailReminder').textContent = eventObj.reminder || '-';
            // Image or placeholder
            const imgContainer = document.getElementById('eventDetailImageContainer');
            imgContainer.innerHTML = '';
            if (eventObj.image_path) {
                const img = document.createElement('img');
                img.src = eventObj.image_path;
                img.alt = 'Event Image';
                imgContainer.appendChild(img);
            } else {
                imgContainer.innerHTML = '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#bbb;font-size:2.5rem;"><i class="fas fa-image"></i></div>';
            }
        }
        function closeEventDetailPanel() {
            document.getElementById('eventDetailDefault').style.display = 'block';
            document.getElementById('eventDetailData').style.display = 'none';
            document.getElementById('eventDetailPanel').classList.add('collapsed');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                selectMirror: true,
                editable: true,
                events: eventsFromBackend, // <-- Add your events here
                select: function(info) {
                    openEventModal(info.start.toISOString(), info.end.toISOString());
                },
                eventClick: function(info) {
                    // Prepare event detail data
                    const event = info.event;
                    const ext = event.extendedProps || {};
                    showEventDetail({
                        title: event.title,
                        description: ext.description,
                        date: event.start ? event.start.toLocaleDateString() : '-',
                        time: event.start ? event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : '-',
                        duration: ext.duration || '-',
                        location: ext.location || '-',
                        reminder: ext.reminder || '-',
                        image_path: ext.image_path || null
                    });
                },
                eventContent: function(arg) {
                    // Custom rendering for event pills with icon
                    let icon = '<span class="fc-event-icon"><i class="fas fa-calendar-check"></i></span>';
                    let title = arg.event.title;
                    return { html: icon + '<span class="fc-event-title">' + title + '</span>' };
                }
            });

            calendar.render();

            // Hide modal on page load
            document.getElementById('eventModalOverlay').style.display = 'none';
            // Show default message in event detail panel on load
            closeEventDetailPanel();
        });
    </script>
@endsection
