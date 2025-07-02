@extends('layouts.member')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Upcoming Multimedia Arts Events</h1>
    <div id="events-timeline" class="events-timeline">
        @forelse($events as $event)
            <div class="event-card" tabindex="0">
                <div class="event-date">
                    <span>{{ \Carbon\Carbon::parse($event['date'])->format('M d, Y') }}</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">{{ $event['title'] }}</h3>
                    <p class="event-type">{{ $event['type'] ?? 'Event' }}</p>
                    <p class="event-desc">{{ $event['description'] }}</p>
                    @if(isset($event['image']))
                        <img src="{{ asset('img/' . $event['image']) }}" alt="{{ $event['title'] }}" class="event-img" />
                    @endif
                </div>
            </div>
        @empty
            <div class="no-events">No upcoming events at the moment.</div>
        @endforelse
    </div>
    <h2 class="mt-5 mb-3">Workshops & Conventions</h2>
    <div class="workshops-list">
        @forelse($workshops as $workshop)
            <div class="workshop-card" tabindex="0">
                <div class="workshop-date">
                    <span>{{ \Carbon\Carbon::parse($workshop['date'])->format('M d, Y') }}</span>
                </div>
                <div class="workshop-content">
                    <h4 class="workshop-title">{{ $workshop['title'] }}</h4>
                    <p class="workshop-desc">{{ $workshop['description'] }}</p>
                </div>
            </div>
        @empty
            <div class="no-workshops">No workshops or conventions available at the moment.</div>
        @endforelse
    </div>
    <h2 class="mt-5 mb-3">Industry News</h2>
    <div class="news-list">
        @forelse($news as $item)
            <div class="news-card" tabindex="0">
                <div class="news-date">
                    <span>{{ \Carbon\Carbon::parse($item['date'])->format('M d, Y') }}</span>
                </div>
                <div class="news-content">
                    <h4 class="news-title">{{ $item['title'] }}</h4>
                    <p class="news-desc">{{ $item['description'] }}</p>
                </div>
            </div>
        @empty
            <div class="no-news">No news at the moment.</div>
        @endforelse
    </div>
</div>

<!-- Interactive Timeline/Calendar Styles -->
<style>
.events-timeline {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    position: relative;
    margin: 2rem 0;
    border-left: 4px solid #667eea;
    padding-left: 2rem;
}
.event-card {
    background: #f7fafc;
    border-radius: 8px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    padding: 1.5rem 2rem;
    position: relative;
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
    outline: none;
}
.event-card:focus, .event-card:hover {
    box-shadow: 0 4px 16px rgba(102,126,234,0.15);
    transform: translateY(-2px) scale(1.02);
    border-left: 4px solid #764ba2;
}
.event-date {
    position: absolute;
    left: -7rem;
    top: 1.5rem;
    background: #667eea;
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: bold;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(102,126,234,0.08);
}
.event-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.3rem;
}
.event-type {
    font-size: 1rem;
    color: #764ba2;
    margin-bottom: 0.5rem;
}
.event-desc {
    color: #4a5568;
    font-size: 1rem;
}
.event-img {
    margin-top: 1rem;
    max-width: 100%;
    border-radius: 6px;
    box-shadow: 0 1px 6px rgba(0,0,0,0.07);
}
.workshops-list, .news-list {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
}
.workshop-card, .news-card {
    background: #f7fafc;
    border-radius: 8px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    padding: 1.25rem;
    flex: 1 1 250px;
    min-width: 250px;
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
    outline: none;
}
.workshop-card:focus, .workshop-card:hover, .news-card:focus, .news-card:hover {
    box-shadow: 0 4px 16px rgba(102,126,234,0.15);
    transform: translateY(-2px) scale(1.02);
    border-left: 4px solid #764ba2;
}
.workshop-date, .news-date {
    color: #667eea;
    font-weight: bold;
    margin-bottom: 0.5rem;
}
.workshop-title, .news-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.3rem;
}
.workshop-desc, .news-desc {
    color: #4a5568;
    font-size: 1rem;
}
@media (max-width: 900px) {
    .event-date { left: -5rem; }
}
@media (max-width: 700px) {
    .events-timeline { padding-left: 1rem; }
    .event-date { left: -3.5rem; font-size: 0.9rem; }
    .workshops-list, .news-list { flex-direction: column; }
}
</style>

<!-- Interactive Timeline/Calendar Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Example: Click to expand/collapse event details (can be extended for modal, etc.)
    document.querySelectorAll('.event-card, .workshop-card, .news-card').forEach(function(card) {
        card.addEventListener('click', function() {
            this.classList.toggle('active');
        });
        card.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                this.classList.toggle('active');
            }
        });
    });
});
</script>
@endsection
