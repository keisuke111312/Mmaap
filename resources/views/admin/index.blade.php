@extends('layouts.admin')
@section('content')
    <style>
        :root {
            --primary: #032639;
            --accent: #ed8936;
            --bg: #f8fafc;
            --text: #1a1a1a;
            --muted: #6b7280;
            --card-bg: #fff;
            --radius: 16px;
            --shadow: 0 2px 16px 0 rgba(3, 38, 57, 0.07);
        }
        body {
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }
        .hero {
            position: relative;
            background: url('{{ asset('img/02_events.jpg') }}') center center/cover no-repeat;
            color: #fff;
            min-height: 340px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero::before {
            content: '';
            position: absolute;
            left: 0; top: 0; right: 0; bottom: 0;
            background: rgba(3, 38, 57, 0.65);
            z-index: 1;
            border-radius: 0 0 var(--radius) var(--radius);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 60px 20px 40px 20px;
        }
        .hero-content h1 {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 18px;
            letter-spacing: -1.5px;
            text-shadow: 0 2px 16px rgba(0,0,0,0.18);
        }
        .hero-content p {
            font-size: 1.25rem;
            opacity: 0.92;
            margin-bottom: 32px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }
        .hero-content .cta-btn {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 16px 38px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: background 0.18s;
        }
        .hero-content .cta-btn:hover {
            background: #ff9c4a;
        }
        .event-list-section {
            max-width: 900px;
            margin: 40px auto 0 auto;
            padding: 0 16px;
        }
        .event-list-title {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 24px;
            text-align: left;
        }
        .event-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 28px;
        }
        .event-card {
            position: relative;
            background: url('{{ asset('img/02_events.jpg') }}') center center/cover no-repeat;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 220px;
        }
        .event-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; right: 0; bottom: 0;
            background: rgba(3, 38, 57, 0.55);
            z-index: 1;
        }
        .event-card-content {
            position: relative;
            z-index: 2;
            padding: 24px 18px 18px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        .event-card-title {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 6px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.18);
        }
        .event-card-meta {
            font-size: 0.97rem;
            color: #f3f3f3;
            margin-bottom: 8px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }
        .event-card-desc {
            font-size: 0.98rem;
            color: #e5e7eb;
            margin-bottom: 0;
            text-shadow: 0 2px 8px rgba(0,0,0,0.10);
        }
        /* Modal Styles */
        .modal-bg {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.32);
            justify-content: center;
            align-items: center;
        }
        .modal-bg.active {
            display: flex;
        }
        .modal {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 38px 28px 32px 28px;
            max-width: 420px;
            width: 95vw;
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 16px;
            right: 18px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--muted);
            cursor: pointer;
        }
        .modal h2 {
            color: var(--primary);
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 18px;
            text-align: center;
        }
        .event-form label {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-weight: 500;
        }
        .event-form input,
        .event-form textarea {
            width: 100%;
            padding: 12px 10px;
            margin-bottom: 18px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            background: #f9fafb;
            transition: border 0.15s;
        }
        .event-form input:focus,
        .event-form textarea:focus {
            border: 1.5px solid var(--accent);
            outline: none;
        }
        .event-form button {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 14px 0;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.18s;
        }
        .event-form button:hover {
            background: var(--accent);
        }
        @media (max-width: 600px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            .event-list-section {
                padding: 0 4px;
            }
            .modal {
                padding: 18px 4px 14px 4px;
            }
        }
    </style>
    <div class="hero">
        <div class="hero-content">
            <h1>Create Your Next Event</h1>
            <p>Bring people together. Plan, organize, and share your event in minutes.</p>
            <button class="cta-btn" onclick="openModal()">Create Event</button>
        </div>
    </div>
    <section class="event-list-section">
        <div class="event-list-title">Upcoming Events</div>
        <div class="event-list">
            <div class="event-card">
                <div class="event-card-content">
                    <div class="event-card-title">Events Shape Us, Big or Small</div>
                    <div class="event-card-meta">2024-07-01 | New York</div>
                    <div class="event-card-desc">Even the smallest gesture presents a major life shift...</div>
                </div>
            </div>
            <div class="event-card">
                <div class="event-card-content">
                    <div class="event-card-title">Some Events Are Life-Changing</div>
                    <div class="event-card-meta">2024-07-10 | London</div>
                    <div class="event-card-desc">Trigger moments deserve deep reflection and action...</div>
                </div>
            </div>
            <div class="event-card">
                <div class="event-card-content">
                    <div class="event-card-title">Every Event Is a New Beginning</div>
                    <div class="event-card-meta">2024-07-15 | Paris</div>
                    <div class="event-card-desc">The next week always brings renewal. Step forward...</div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal-bg" id="eventModal">
        <div class="modal">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h2>Add New Event</h2>
            <form class="event-form" method="POST" action="#" enctype="multipart/form-data" onsubmit="closeModal(); return false;">
                <label for="name">Event Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter event name">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" required placeholder="Event location">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required placeholder="Describe your event"></textarea>
                <label for="image">Event Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <button type="submit">Create Event</button>
            </form>
        </div>
    </div>
    <script>
        function openModal() {
            document.getElementById('eventModal').classList.add('active');
        }
        function closeModal() {
            document.getElementById('eventModal').classList.remove('active');
        }
        // Optional: Close modal on background click
        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
@endsection
