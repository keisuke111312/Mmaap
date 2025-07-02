@extends('layouts.admin.master')
@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">DASHBOARD</h1>
                {{-- <button class="dashboard-btn">GO TO DASHBOARD</button> --}}
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            {{-- <ul class="tab-items">
                <div class="button-container">
                    <li class="tab-item">
                        <button class="filter-tab active" data-filter="all">All Resources</button>
                    </li>
                    <li class="tab-item">
                        <button class="filter-tab" data-filter="articles">Articles</button>
                    </li>
                    <li class="tab-item">
                        <button class="filter-tab" data-filter="tutorials">Tutorials</button>
                    </li>
                    <li class="tab-item">
                        <button class="filter-tab" data-filter="research">Research</button>
                    </li>
                </div>

            </ul>
            <select class="sort-dropdown">
                <option>Sort by: Most Recent</option>
                <option>Sort by: Most Popular</option>
                <option>Sort by: Highest Rated</option>
                <option>Sort by: Title A-Z</option>
            </select> --}}
        </div>
    </nav>
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="dashboard">
        <div class="dashboard-grid">
            <!-- Net Sales card-graph -->
            <div class="card-graph">
                <div class="card-graph-header-graph">
                    <h3>NET SALES</h3>
                    <select class="dropdown">
                        <option>This Week</option>
                        <option>Last Week</option>
                        <option>This Month</option>
                    </select>
                </div>
                <div class="sales-summary">
                    <div class="sales-item">
                        <span class="label">This Week</span>
                        <span class="amount current" id="weekTotalSales">₱5500.00</span>
                    </div>
                    <div class="sales-item">
                        <span class="label">Previous Week</span>
                        <span class="amount previous">₱6550.00</span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Tickets card-graph -->
            <div class="card-graph">
                <div class="card-graph-header-graph">
                    <h3>MEMBERSHIP</h3>
                    <select class="dropdown">
                        <option>This Week</option>
                    </select>
                </div>
                <div class="chart-container doughnut-container">
                    <canvas id="membership"></canvas>
                    <div class="chart-center">
                        <div class="center-number-member">90</div>
                        <div class="center-label">Sold Membership</div>
                    </div>
                </div>
                {{-- <div class="stats-row">
                    <div class="stat">
                        <span class="stat-label">Online</span>
                        <span class="stat-value">$5500.00</span>
                    </div>
                    <div class="stat">
                        <span class="stat-label">Total Seats</span>
                        <span class="stat-value">350</span>
                    </div>
                </div> --}}
            </div>

            <!-- Upcoming Events card-graph -->
            <div class="card-graph">
                <div class="card-graph-header-graph">
                    <h3>UPCOMING EVENTS</h3>
                </div>
                <div class="events-list">
                    @forelse ($upcomingEvents as $event)
                        <div class="event-item">
                            <div class="event-avatar"
                                style="background: linear-gradient(45deg, {{ collect(['#667eea, #764ba2', '#f093fb, #f5576c', '#4facfe, #00f2fe', '#43e97b, #38f9d7'])->random() }});">
                            </div>
                            <div class="event-details">
                                <div class="event-name">{{ $event->title }}</div>
                                <div class="event-location">📍 {{ $event->location ?? 'Unknown Location' }}</div>
                            </div>
                        </div>
                    @empty
                        <p style="padding: 1rem; color: #6c757d;">No upcoming events.</p>
                    @endforelse
                </div>
            </div>
            <!-- Recent Sells card-graph -->
            <div class="card-graph">
                <div class="card-graph-header-graph">
                    <h3>RECENT MEMBER</h3>
                </div>

                <div class="sells-summary">
                    <div class="sells-item">
                        <span class="label">This Week</span>
                        <span class="amount current">{{ $studentCount }} Student</span>
                    </div>
                    <div class="sells-item">
                        <span class="label">This Week</span>
                        <span class="amount previous">{{ $professionalCount }} Professional</span>
                    </div>
                </div>

                <div class="recent-list">
                    @foreach ($recentUsers as $user)
                        @php
                            $colorMap = [
                                'Student' => '#f5576c',
                                'Professional' => '#667eea',
                                'Default' => '#4facfe',
                            ];
                            $accessName = $user->accessLevel->name ?? 'Default';
                            $bgColor = $colorMap[$accessName] ?? $colorMap['Default'];
                        @endphp

                        <div class="recent-item {{ $loop->first ? 'highlighted' : '' }}">
                            <div class="customer-avatar" style="background: {{ $bgColor }};"></div>
                            <div class="customer-details">
                                <div class="customer-name">{{ $user->fname }} {{ $user->lname }}</div>
                                <div class="event-name">{{ $accessName }}</div>
                            </div>
                            <div class="purchase-details">
                                <!-- Optional: Add purchase date or access level duration here -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <!-- Total Seats card-graph -->
            <div class="card-graph">
                <div class="card-graph-header-graph">
                    <h3>TOTAL RESOURCES</h3>
                </div>

                <div class="chart-container doughnut-container">
                    <canvas id="totalResourcesChart"></canvas>
                    <div class="chart-center">
                        <div class="center-number">0</div>
                        <div class="center-label">Total Resources</div>
                    </div>
                </div>

                <div class="stats-row">
                    <div class="stat">
                        {{-- <span class="stat-label">Total Seats</span>
                        <span class="stat-value">350</span> --}}
                    </div>
                    <div class="stat">
                        {{-- <span class="stat-label">Sold Seats</span>
                        <span class="stat-value">90</span> --}}
                    </div>
                </div>
                <div class="progress-indicators">
                    <div class="progress-item">
                        <span class="progress-number">90</span>
                        <span class="progress-label">Sold Seats</span>
                    </div>
                    <div class="progress-item">
                        <span class="progress-number">350</span>
                        <span class="progress-label">Total Seats</span>
                    </div>
                </div>
            </div>

            <!-- Online Sells card-graph -->
            <div class="card-graph">
                <div class="card-graph-header-graph">
                    <h3>ONLINE SELLS</h3>
                </div>
                <div class="online-summary">
                    <div class="online-item">
                        <span class="label">Job List</span>
                        <span class="amount current"></span>

                    </div>
                </div>
                <div class="chart-container mini-chart">
                    <canvas id="jobChart"></canvas>
                </div>
                {{-- <div class="email-section">
                    <h4>EMAIL CAMPAIGN</h4>
                    <div class="email-stats">
                        <div class="email-stat">
                            <span class="email-label">Send Emails</span>
                            <span class="email-value">+165</span>
                        </div>
                        <div class="email-stat">
                            <span class="email-label">Clicks</span>
                            <span class="email-value">+355</span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

    </div>

    <style>
        .tab-container {
            display: flex;
            justify-content: space-evenly;
        }

        .button-container {
            box-sizing: border-box;
            display: flex;
            padding: 12px;
            justify-content: center;
        }

        .filter-section {
            background: white;
            padding: 40px 0;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 70px;
            z-index: 50;
        }

        .filter-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .filter-tabs {
            display: flex;
            gap: 5px;
        }

        .filter-tab {
            padding: 10px 20px;
            background: none;
            border: 2px solid #e5e7eb;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #6b7280;
            margin-right: 5px;
        }

        .filter-tab.active {
            background: #032639;
            color: white;
            border-color: #032639;
        }

        .filter-tab:hover {
            border-color: #032639;
            color: #032639;
        }

        .filter-tab.active:hover {
            color: white;
        }

        .sort-dropdown {
            height: 45px;
            line-height: 18px;
            padding: 10px 16px;
            box-sizing: border-box;
            border: 2px solid #e5e7eb;
            border-radius: 6px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            align-self: center;
        }



        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .dashboard {
            max-width: 1500px;
            margin: 0 auto;
            padding: 20px;
        }

        .dashboard-grid {
            margin-top: 30px;

            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card-graph {
            background: white;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .card-graph-header-graph {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-graph-header-graph h3 {
            font-size: 14px;
            font-weight: 600;
            color: #6c757d;
            letter-spacing: 0.5px;
        }

        .dropdown {
            border: 1px solid #e9ecef;
            padding: 6px 12px;
            font-size: 12px;
            background: white;
            color: #6c757d;
            width: 120px;
        }

        .sales-summary,
        .sells-summary,
        .online-summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .sales-item,
        .sells-item,
        .online-item {
            display: flex;
            flex-direction: column;
        }

        .label {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .amount.current {
            color: #dc3545;
            font-weight: 600;
            font-size: 18px;
        }

        .amount.previous {
            color: #6c757d;
            font-weight: 600;
            font-size: 18px;
        }

        .chart-container {
            position: relative;
            height: 200px;
            margin-bottom: 20px;
        }

        .doughnut-container {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chart-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -70%);
            text-align: center;
        }

        .center-number {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        .center-number-member {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        .center-label {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat {
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .stat-label {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .stat-value {
            font-weight: 600;
            color: #333;
        }

        .events-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .event-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .event-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .event-details {
            flex: 1;
        }

        .event-name {
            font-weight: 500;
            color: #333;
            margin-bottom: 2px;
        }

        .event-location {
            font-size: 12px;
            color: #6c757d;
        }

        .recent-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .recent-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            transition: background-color 0.2s;
        }

        .recent-item.highlighted {
            background-color: #dc3545;
            color: white;
        }

        .recent-item.highlighted .customer-name,
        .recent-item.highlighted .event-name {
            color: white;
        }

        .customer-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .customer-details {
            flex: 1;
        }

        .customer-name {
            font-weight: 500;
            color: #333;
            margin-bottom: 2px;
        }

        .purchase-details {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quantity {
            font-size: 12px;
            color: #6c757d;
        }

        .price {
            font-weight: 600;
            color: #333;
        }

        .progress-indicators {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
        }

        .progress-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .progress-number {
            font-size: 24px;
            font-weight: 700;
            color: #dc3545;
        }

        .progress-label {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }

        .mini-chart {
            height: 80px;
        }

        .email-section {
            margin-top: 20px;
        }

        .email-section h4 {
            font-size: 14px;
            font-weight: 600;
            color: #6c757d;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .email-stats {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .email-stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .email-label {
            font-size: 14px;
            color: #333;
        }

        .email-value {
            font-weight: 600;
            color: #28a745;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .dashboard {
                padding: 10px;
            }

            .card-graph {
                padding: 16px;
            }
        }
    </style>

    <script>
        // Initialize charts when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initSalesChart();
            initMembershipChart();
            initTotalResourcesChart();
            initJobChart();
        });

        function initSalesChart() {
            fetch("{{ route('chart.sales') }}")
                .then(response => response.json())
                .then(chartData => {
                    document.getElementById('weekTotalSales').innerText = '₱' + chartData.week_total.toLocaleString();
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: chartData.labels,
                            datasets: [{
                                data: chartData.data,
                                borderColor: '#dc3545',
                                backgroundColor: 'transparent',
                                borderWidth: 2,
                                pointBackgroundColor: '#dc3545',
                                pointBorderColor: '#dc3545',
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 11
                                        },
                                        color: '#6c757d'
                                    }
                                },
                                y: {
                                    grid: {
                                        color: '#f1f3f4'
                                    },
                                    ticks: {
                                        font: {
                                            size: 11
                                        },
                                        color: '#6c757d',
                                        callback: function(value) {
                                            return '₱' + value;
                                        }
                                    }
                                }
                            },
                            elements: {
                                point: {
                                    hoverBackgroundColor: '#dc3545'
                                }
                            }
                        }
                    });
                });

        }

        function initMembershipChart() {
            fetch("{{ route('chart.membership') }}")
                .then(response => response.json())
                .then(chartData => {
                    const ctx = document.getElementById('membership').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: chartData.labels,
                            datasets: [{
                                data: chartData.data,
                                backgroundColor: ['#dc3545', '#e9ecef'],
                                borderWidth: 0,
                                cutout: '75%'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.label}: ${context.raw} members`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        }


        function initTotalResourcesChart() {
            fetch("{{ route('chart.resources') }}")
                .then(res => res.json())
                .then(stats => {
                    console.log("Fetched stats:", stats); // ✅ should show your JSON

                    const canvas = document.getElementById('totalResourcesChart');
                    if (!canvas) {
                        console.error("Canvas with id 'totalResourcesChart' not found.");
                        return;
                    }

                    const ctx = canvas.getContext('2d');

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: stats.labels,
                            datasets: [{
                                data: stats.data,
                                backgroundColor: ['#dc3545', '#e9ecef'],
                                borderWidth: 0,
                                cutout: '75%'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });

                    const center = document.querySelector('.center-number');
                    if (center) {
                        center.textContent = stats.total;
                    } else {
                        console.warn("Center number element not found");
                    }
                })
                .catch(err => {
                    console.error("Error fetching chart data:", err);
                });
        }




function initJobChart() {
    fetch("{{ route('chart.jobs') }}")
        .then(response => response.json())
        .then(stats => {
            // Insert total job count into the DOM
            document.querySelector('.online-summary .amount.current').textContent = stats.total + " Jobs";

            const ctx = document.getElementById('jobChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: stats.labels,
                    datasets: [{
                        data: stats.data,
                        borderColor: '#dc3545',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        pointRadius: 0,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    },
                    elements: {
                        point: {
                            hoverRadius: 0
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error("Error loading job chart data:", error);
        });
}

    </script>
@endsection
