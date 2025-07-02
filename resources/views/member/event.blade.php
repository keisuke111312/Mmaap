@extends('layouts.member.master')
@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">EVENTS</h1>
                <button class="dashboard-btn">GO TO DASHBOARD</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            
        </div>
    </nav>
@endsection
@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }


        .section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #333;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #0f2f4a 0%, #0f2f4ad7 100%);
            border-radius: 2px;
        }

        /* Event Cards */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .event-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
            cursor: pointer;
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .event-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .event-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .event-content {
            padding: 2rem;
        }

        .event-date {
            background: linear-gradient(135deg, #0f2f4a 0%, #0f2f4ad7 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .event-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .event-description {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .event-location,
        .event-price {
            font-size: 0.9rem;
            color: #888;
        }

        .event-price {
            font-weight: bold;
            color: #0f2f4a;
        }

        .event-type {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            color: #0f2f4a;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            z-index: 2;
        }

        .click-hint {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 0.8rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-card:hover .click-hint {
            opacity: 1;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideIn 0.3s ease;
        }

        .modal-header {
            position: relative;
            height: 300px;
            background-size: cover;
            background-position: center;
            border-radius: 20px 20px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 20px 20px 0 0;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 25px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            z-index: 3;
            background: rgba(0, 0, 0, 0.5);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .close:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-event-type {
            background: linear-gradient(135deg, #0f2f4a 0%, #0f2f4ad7 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .modal-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .modal-date {
            font-size: 1.2rem;
            color: #0f2f4a;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .modal-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 2rem;
        }

        .modal-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .detail-item {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
        }

        .detail-item h4 {
            color: #0f2f4a;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .detail-item p {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .register-btn,
        .share-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .register-btn {
            background: linear-gradient(135deg, #0f2f4a 0%, #0f2f4ad7 100%);

            color: white;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .share-btn {
            background: transparent;
            color: #0f2f4a;
            border: 2px solid #0f2f4a;
        }

        .share-btn:hover {
            background: #0f2f4a;
            color: white;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .event-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .event-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .event-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .event-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .nav-links {
                display: none;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 40px 0;
            }

            .modal-content {
                width: 95%;
                margin: 20px;
            }

            .modal-title {
                font-size: 2rem;
            }

            .modal-actions {
                flex-direction: column;
            }
        }
    </style>

    <main>
        <section class="section" id="events">
            <div class="container">
                {{-- <h2 class="section-title">Upcoming Events</h2> --}}
                <div class="events-grid">

                    @foreach ($events as $event)
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
        </section>
    </main>



    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
                document.body.style.overflow = 'auto';
                XMLDocument
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const activeModal = document.querySelector('.modal.active');
                if (activeModal) {
                    activeModal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endsection
