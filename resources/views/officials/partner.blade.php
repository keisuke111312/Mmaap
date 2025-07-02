@extends('layouts.admin.master')

<head>
    <link rel="stylesheet" href="{{ asset('css/modal2.css') }}">
    <style>
        /* Filter Tabs */
        .filterhead {
            text-align: center;
            padding-top: 35px;
            padding-bottom: 35px;
        }

        .filterhead h1 {
            text-align: center;
        }

        .filter-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 48px;
        }

        .filter-tab {
            background: white;
            border: 2px solid #E09900;
            color: #E09900;
            padding: 12px 24px;
            border-radius: 25px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .filter-tab:hover,
        .filter-tab.active {
            background: #E09900;
            color: white;
        }

        /* Members Grid */
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
            margin-bottom: 48px;
        }

        .member-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .member-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .member-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin: 0 auto 16px;
            border-radius: 8px;
        }

        .member-name {
            font-size: 18px;
            font-weight: 700;
            color: #032639;
            margin-bottom: 8px;
        }

        .member-type {
            font-size: 14px;
            color: #E09900;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .member-description {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        /* Loading and Empty States */
        .loading-state {
            text-align: center;
            padding: 48px 0;
            color: #666;
        }

        .empty-state {
            text-align: center;
            padding: 48px 0;
            color: #666;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #E09900;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 16px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">USER MANAGEMENT</h1>
                <div>
                    {{-- <a href="{{ route('admin.official') }}" class="dashboard-btn">GO TO OFFICIALS</a> --}}
                    {{-- <a href="{{route('admin.official')}}" class="dashboard-btn">GO TO INDUSTRY</a> --}}
                    <button class="dashboard-btn" onclick="openModal('add-partner')">ADD PARTNER</button>


                </div>

            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <div class="filters-section">

            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="filter-tabs">
        <a href="#" class="filter-tab active" data-filter="all">All Members</a>
        <a href="#" class="filter-tab" data-filter="industry">Industry Members</a>
        <a href="#" class="filter-tab" data-filter="academe">Academe Members</a>
        <a href="#" class="filter-tab" data-filter="vendor">Vendor Members</a>
        <a href="#" class="filter-tab" data-filter="affiliate">Professional Affiliates</a>
        <a href="#" class="filter-tab" data-filter="partners">Partners</a>
    </div>


    <!-- Members Grid -->
    <div class="members-grid" id="membersGrid">
        <div class="loading-state" id="loadingState">
            <div class="spinner"></div>
            <p>Loading members...</p>
        </div>

        @foreach ($partners as $member)
            <div class="member-card" data-type="{{ $member->type }}">
                <img src="{{ asset($member->logo_url) }}" alt="{{ $member->name }} logo" class="member-logo" />

                <div class="member-name">{{ $member->name }}</div>
                <div class="member-type">
                    {{ $typeLabels[$member->type] ?? ucfirst($member->type) }}
                </div>
                <div class="member-description">{{ $member->description }}</div>
            </div>
        @endforeach

        <div class="empty-state" id="emptyState" style="display: none;">
            <p>No members found for this category.</p>
        </div>
    </div>


    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div id="add-partner" class="modal-overlay hidden">
        <div class="form-section">
            
            <h3>Add New Partner/Industry Member</h3>

            <form method="POST" action="{{ route('partner.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>

                    <!-- Type -->
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type">
                            <option value="">-- Select Type --</option>
                            <option value="industry">Industry Member</option>
                            <option value="academe">Academe Member</option>
                            <option value="vendor">Vendor Member</option>
                            <option value="affiliate">Professional Affiliate</option>
                            <option value="partners">Partner</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                </div>

                <!-- Logo Upload -->
                <div class="form-group">
                    <label for="logo_url">Upload Logo</label>
                    <div class="image-upload">
                        <input type="file" name="image_path" id="logo_url" accept="image/*">
                        <span class="image-upload-text">Click to upload image</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Save</button>
                <button  type="button" onclick="closeModal('add-partner')" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>



    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterTabs = document.querySelectorAll('.filter-tab');
            const memberCards = document.querySelectorAll('.member-card');
            const loadingState = document.getElementById('loadingState');
            const emptyState = document.getElementById('emptyState');

            setTimeout(() => {
                if (loadingState) loadingState.style.display = 'none';
            }, 1000);

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');
                    let visibleCount = 0;

                    memberCards.forEach(card => {
                        const cardType = card.getAttribute('data-type');
                        const matches = filter === 'all' || cardType === filter;

                        card.style.display = matches ? 'block' : 'none';
                        if (matches) visibleCount++;
                    });

                    emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
                });
            });
        });



        function loadMembers(filter = 'all') {
            const loadingState = document.getElementById('loadingState');
            const membersGrid = document.getElementById('membersGrid');

            // Show loading state
            loadingState.style.display = 'block';

            fetch(`/api/members?filter=${filter}`)
                .then(response => response.json())
                .then(data => {
                    // Hide loading state
                    loadingState.style.display = 'none';

                    // Clear existing cards (except loading/empty states)
                    const existingCards = membersGrid.querySelectorAll('.member-card');
                    existingCards.forEach(card => card.remove());

                    // Add new cards
                    data.members.forEach(member => {
                        const card = document.createElement('div');
                        card.className = 'member-card';
                        card.setAttribute('data-type', member.type);
                        card.innerHTML = `
                <img src="${member.logo_url}" alt="${member.name} logo" class="member-logo" />
                <div class="member-name">${member.name}</div>
                <div class="member-type">${member.type}</div>
                <div class="member-description">${member.description}</div>
              `;
                        membersGrid.appendChild(card);
                    });

                    // Show empty state if no members
                    if (data.members.length === 0) {
                        document.getElementById('emptyState').style.display = 'block';
                    } else {
                        document.getElementById('emptyState').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error loading members:', error);
                    loadingState.style.display = 'none';
                });
        }
    </script>
@endsection
