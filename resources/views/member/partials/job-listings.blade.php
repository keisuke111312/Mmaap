<div class="listings-header">
    <div class="listings-count">Showing {{ $jobs->total() }} jobs</div>
    <select class="sort-dropdown">
        <option>Sort by: Most Recent</option>
        <!-- You can expand this with real sorting logic later -->
    </select>
</div>

@forelse ($jobs as $job)
    <article class="job-card {{ $job->is_featured ? 'featured-job' : '' }}">
        @if ($job->is_featured)
            <div class="featured-badge">Featured</div>
        @endif

        <div class="job-header">
            <div>
                <h3 class="job-title">{{ $job->title }}</h3>
                <div class="job-company">{{ $job->company_name }}</div>
                <div class="job-location">📍 {{ $job->location }}</div>
            </div>
            <div class="job-type {{ $job->type }}">{{ ucfirst($job->type) }}</div>
        </div>
        <p class="job-description">
            {{ Str::limit($job->description, 200) }}
        </p>
        <div class="job-tags">
            @foreach ($job->tags as $tag)
                <span class="job-tag">{{ $tag->tag }}</span>
            @endforeach
        </div>
        <div class="job-footer">
            <div>
                <div class="job-salary">
                    @if ($job->salary_min && $job->salary_max)
                        ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                    @elseif($job->salary_min)
                        From ${{ number_format($job->salary_min) }}
                    @else
                        Not specified
                    @endif
                </div>
                <div class="job-posted">Posted {{ \Carbon\Carbon::parse($job->posted_at)->diffForHumans() }}
                </div>
            </div>
            <button class="apply-btn">Apply Now</button>
        </div>
    </article>
@empty
    <p>No jobs found matching your criteria.</p>
@endforelse

{{ $jobs->withQueryString()->links() }} 