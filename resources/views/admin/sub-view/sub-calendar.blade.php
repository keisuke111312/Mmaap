@include('components.admin.event-modal')
<link rel="stylesheet" href="{{ asset('css/event.css') }}">
{{-- <section class="section" id="events"> --}}
<div class="event-container">
    <h2 class="section-title">Upcoming Events</h2>
    <div class="events-grid">

        @foreach ($eventCollection as $event)
            @php
                $modalId = 'modal' . $event->id;
            @endphp


            <!-- Event Card 1 -->

            <div class="event-card" onclick="openModal('{{ $modalId }}')">
                <div class="event-image"
                    style="background-image:
                                    linear-gradient(45deg, #0f2f4a, #0f2f4ad7),
                                    url('{{ $event->image ? asset('storage/' . $event->image_path) : 'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2250%22>🎨</text></svg>' }}');">
                    <div class="event-type">{{ $event->type }}</div>
                    <div class="click-hint">Click for details</div>
                </div>
                <div class="event-content">
                    <div class="event-date">{{ \Carbon\Carbon::parse($event->start)->format('F j Y') }}
                    </div>

                    <h3 class="event-title">{{ $event->title }}</h3>
                    <p class="event-description">{{ $event->description }}</p>
                    <div class="event-details">
                        <span class="event-location">📍 {{ $event->location }}</span>
                    </div>
                </div>
            </div>

            <div id="{{ $modalId }}" class="modal">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background-image: linear-gradient(45deg, #0f2f4a, #0f2f4ad7), url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2280%22>🎨</text></svg>');">
                        <span class="close" onclick="closeModal('{{ $modalId }}')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="modal-event-type">{{ $event->type }}</div>
                        <h2 class="modal-title">{{ $event->title }}</h2>
                        <div class="modal-date">
                            📅 {{ \Carbon\Carbon::parse($event->start)->format('F j, Y') }}
                            @if ($event->start_time)
                                | {{ $event->start_time }}
                            @endif
                        </div>
                        <p class="modal-description">{{ $event->description }}</p>
                        <div class="modal-details">
                            <div class="detail-item">
                                <h4>📍 Location</h4>
                                <p>{{ $event->location }}</p>
                            </div>
                            <div class="detail-item">
                                <h4>💰 Price</h4>
                                <p>{{ $event->price ?? 'Free' }}</p>
                            </div>
                            <div class="detail-item">
                                <h4>👥 Capacity</h4>
                                <p>{{ $event->capacity ?? 'N/A' }}</p>
                            </div>
                            <div class="detail-item">
                                <h4>⏱️ Duration</h4>
                                <p>{{ $event->duration ? $event->duration . ' hours' : 'TBD' }}</p>
                            </div>
                        </div>
                        <div class="modal-actions">
                            <button class="register-btn">Register Now</button>
                            <button class="share-btn">Share Event</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
</div>
{{-- </section> --}}



<script>
    // ADD SPONSORS CHIP
    const sponsorInput = document.querySelector('input[placeholder="Search people"]');
    const sponsorChips = sponsorInput.nextElementSibling;

    sponsorInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim() !== '') {
            e.preventDefault();
            const chip = createChip(this.value.trim());
            sponsorChips.appendChild(chip);
            this.value = '';
        }
    });

    // REMOVE CHIP
    sponsorChips.addEventListener('click', function(e) {
        if (e.target.classList.contains('fa-times')) {
            e.target.closest('.chip').remove();
        }
    });

    // CREATE CHIP ELEMENT
    function createChip(label) {
        const div = document.createElement('div');
        div.className = 'chip';
        div.innerHTML = `${label} <i class="fas fa-times"></i>`;
        return div;
    }

    // REMOVE IMAGE
    document.querySelectorAll('.chip span').forEach(span => {
        span.addEventListener('click', function() {
            this.closest('.chip').remove();
        });
    });
</script>

<style>
    .container {
        max-width: 100%;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border: 1px solid rgb(255, 255, 255);

    }

    .header {
        background: linear-gradient(135deg, #032639 0%, #032639ec 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .header h1 {
        font-size: 2.2rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .header p {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 300;
    }

    .main-content {
        display: flex;
        min-height: calc(80vh - 120px);
    }

    .calendar-section {
        flex: 1;
        padding: 30px;
        border-right: 1px solid #e1e5e9;
    }

    .details-section {
        width: 400px;
        background: #fafbfc;
        border-left: 1px solid #e1e5e9;
        display: flex;
        flex-direction: column;
    }

    .details-header {
        background: linear-gradient(135deg, #032639 0%, #032639ec 100%);
        color: white;
        padding: 20px;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .details-content {
        flex: 1;
        padding: 30px;
        overflow-y: auto;
    }

    .no-event-selected {
        text-align: center;
        color: #6c757d;
        margin-top: 100px;
    }

    .no-event-selected .icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .event-details {
        display: none;
    }

    .event-details.active {
        display: block;
    }

    .event-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #032639;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .event-type-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 25px;
        color: white;
    }

    .event-detail-item {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }

    .event-detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .detail-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #032639;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .detail-value {
        color: #495057;
        line-height: 1.5;
    }

    .legend {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
        justify-content: flex-start;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        background: #f8f9fa;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid #e9ecef;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }

    .workshop {
        background-color: #6c757d;
    }

    .exhibition {
        background-color: #495057;
    }

    .convention {
        background-color: #343a40;
    }

    .performance {
        background-color: #032639;
    }

    #calendar {
        background: white;
        border-radius: 6px;
        border: 1px solid #e1e5e9;
        padding: 20px;
    }

    /* FullCalendar Customizations */
    .fc {
        font-family: inherit;
    }

    .fc .fc-toolbar-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #032639;
    }

    .fc .fc-button-primary {
        background-color: #032639;
        border-color: #032639;
        border-radius: 4px;
        padding: 6px 12px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .fc .fc-button-primary:hover {
        background-color: #041f2e;
        border-color: #041f2e;
    }

    .fc .fc-button-primary:focus {
        box-shadow: 0 0 0 2px rgba(3, 38, 57, 0.25);
    }

    .fc .fc-daygrid-day.fc-day-today {
        background-color: rgba(3, 38, 57, 0.05);
    }

    .fc-event {
        border: none !important;
        border-radius: 3px !important;
        padding: 2px 6px !important;
        font-weight: 500 !important;
        cursor: pointer !important;
        font-size: 0.85rem !important;
        transition: all 0.2s ease !important;
    }

    .fc-event:hover {
        opacity: 0.8 !important;
    }

    .fc-event.selected {
        box-shadow: 0 0 0 2px #032639 !important;
        transform: scale(1.02) !important;
    }

    .fc .fc-daygrid-event {
        margin: 1px !important;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .details-section {
            width: 350px;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            flex-direction: column;
        }

        .calendar-section {
            border-right: none;
            border-bottom: 1px solid #e1e5e9;
            padding: 20px;
        }

        .details-section {
            width: 100%;
            border-left: none;
            min-height: 400px;
        }

        .fc .fc-toolbar {
            flex-direction: column;
            gap: 10px;
        }

        .fc .fc-toolbar-title {
            font-size: 1.3rem;
        }

        .header h1 {
            font-size: 1.8rem;
        }

        .header {
            padding: 20px;
        }
    }

    @media (max-width: 480px) {
        .calendar-section {
            padding: 15px;
        }

        .details-content {
            padding: 20px;
        }

        .header h1 {
            font-size: 1.6rem;
        }
    }
</style>
