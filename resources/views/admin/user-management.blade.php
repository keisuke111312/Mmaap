@extends('layouts.admin.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/ribbon.css') }}">


    <div class="head">
        <div class="head-container">
            <h1 class="settings-title">USER MANAGEMENT</h1>
            <div class="head-body">

                <div class="settings-header">

                    <nav class="tabs-nav">
                        <ul class="tabs-list">
                            <li><button class="tab-button" data-tab="profile">YOUR PROFILE</button></li>
                            <li><button class="tab-button" data-tab="notification">NOTIFICATION</button></li>
                            <li><button class="tab-button" data-tab="personal">AS PERSONAL</button></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
{{-- 
    @include('components.admin.user-profile')
    @include('components.admin.user-dashboard') --}}

    @include('components.admin.user-status')



@endsection


