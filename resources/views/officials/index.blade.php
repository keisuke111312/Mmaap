<section class="team-section" id="who-are">
    <h2>Meet the People Behind <span>MMAAP!</span></h2>

    @if ($currentTerm)
        <h4>MMAAP-CL Interim Officers {{ $currentTerm->year_start }}–{{ $currentTerm->year_end }}</h4>

        <div class="team-grid">
            @foreach ($officials as $official)
                <div class="team-member">
                    <div class="member-photo">
                        @if ($official->photo_url)
                            <img src="{{ $official->photo_url }}" alt="{{ $official->name }}">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div class="member-info">
                        <div class="member-name">{{ $official->name }}</div>
                        <div class="member-position">{{ $official->position->title }}</div>
                        <div class="member-bio">{{ $official->bio }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No current term officials found.</p>
    @endif
</section>