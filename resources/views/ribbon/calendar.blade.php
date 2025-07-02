    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">Events Calendar</h1>
                <button class="dashboard-btn">GO TO DASHBOARD</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <ul class="tab-items">
                <li class="tab-item">
                    <a href="#" class="tab-link active" data-tab="calendar">
                        <span class="tab-indicator"></span>
                        CALENDAR
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#" class="tab-link" data-tab="event">
                        <span class="tab-indicator"></span>
                        EVENT
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="tab-content">
        <div id="calendar-tab" class="tab-pane">
            @include('admin.sub-view.sub-events')
        </div>
        <div id="event-tab" class="tab-pane hidden">
            @include('admin.sub-view.sub-calendar')

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabPanes = {
                calendar: document.getElementById('calendar-tab'),
                event: document.getElementById('event-tab')
            };

            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove 'active' from all tabs
                    tabLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    // Hide all panes
                    Object.values(tabPanes).forEach(pane => pane.classList.add('hidden'));

                    // Show selected pane
                    const selected = this.dataset.tab;
                    if (tabPanes[selected]) {
                        tabPanes[selected].classList.remove('hidden');
                    }
                });
            });
        });
    </script>

    <style>
        .tab-pane.hidden {
            display: none;
        }
    </style>
