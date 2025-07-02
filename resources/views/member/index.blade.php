@extends('layouts.member.master')
@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">SETTING</h1>
                <button class="dashboard-btn">GO TO DASHBOARD</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <ul class="tab-items">
                <li class="tab-item">
                    <a href="#" class="tab-link active">
                        <span class="tab-indicator"></span>
                        YOUR PROFILE
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#" class="tab-link">
                        <span class="tab-indicator"></span>
                        PAYMENT
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#" class="tab-link">
                        <span class="tab-indicator"></span>
                        NOTIFICATION
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#" class="tab-link">
                        <span class="tab-indicator"></span>
                        AS PERSONAL
                    </a>
                </li>
            </ul>
        </div>
    </nav>
@endsection

