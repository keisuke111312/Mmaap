    <div class="container">
        {{-- <div class="header">
            <h1>Multimedia Arts Events Calendar</h1>
            <p>Interactive schedule showcasing upcoming events, workshops, and conventions</p>
        </div> --}}

        <div class="main-content">
            <div class="calendar-section">
                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-color workshop"></div>
                        <span>Workshops</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color exhibition"></div>
                        <span>Exhibitions</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color convention"></div>
                        <span>Conventions</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color performance"></div>
                        <span>Performances</span>
                    </div>
                </div>

                <div id="calendar"></div>
            </div>

            <div class="details-section">
                <div class="details-header">
                    Event Details
                </div>
                <div class="details-content">
                    <div class="no-event-selected" id="noEventSelected">
                        <div class="icon">📅</div>
                        <h3>Select an Event</h3>
                        <p>Click on any event in the calendar to view its details here.</p>
                    </div>

                    <div class="event-details" id="eventDetails">
                        <div class="event-title" id="eventTitle"></div>
                        <div class="event-type-badge" id="eventTypeBadge"></div>

                        <div class="event-detail-item">
                            <div class="detail-label">Date & Time</div>
                            <div class="detail-value" id="eventDateTime"></div>
                        </div>

                        <div class="event-detail-item" id="locationItem" style="display: none;">
                            <div class="detail-label">Location</div>
                            <div class="detail-value" id="eventLocation"></div>
                        </div>

                        <div class="event-detail-item" id="instructorItem" style="display: none;">
                            <div class="detail-label">Instructor</div>
                            <div class="detail-value" id="eventInstructor"></div>
                        </div>

                        <div class="event-detail-item" id="descriptionItem" style="display: none;">
                            <div class="detail-label">Description</div>
                            <div class="detail-value" id="eventDescription"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>