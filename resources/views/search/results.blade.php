@extends('layouts.admin.master')

@section('content')
<div class="search-results-container">
    <div class="search-header">
        <h2>Search Results for "{{ $query }}"</h2>
        <p>Found {{ $results->count() }} results</p>
    </div>

    <div class="search-filters">
        <div class="filter-group">
            <label>Filter by:</label>
            <select id="type-filter">
                <option value="all">All</option>
                <option value="events">Events</option>
                <option value="users">Users</option>
                <option value="resources">Resources</option>
            </select>
        </div>
    </div>

    <div class="search-results">
        @forelse($results as $result)
            <div class="result-card">
                <div class="result-icon">
                    @if($result->type === 'event')
                        <i class="fas fa-calendar"></i>
                    @elseif($result->type === 'user')
                        <i class="fas fa-user"></i>
                    @elseif($result->type === 'resource')
                        <i class="fas fa-file"></i>
                    @endif
                </div>
                <div class="result-content">
                    <h3>{{ $result->title }}</h3>
                    <p>{{ $result->description }}</p>
                    <div class="result-meta">
                        <span class="result-type">{{ ucfirst($result->type) }}</span>
                        <span class="result-date">{{ $result->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="result-actions">
                    <a href="{{ $result->url }}" class="view-btn">View Details</a>
                </div>
            </div>
        @empty
            <div class="no-results">
                <i class="fas fa-search"></i>
                <p>No results found for your search query.</p>
                <p>Try different keywords or check your spelling.</p>
            </div>
        @endforelse
    </div>

    @if($results->hasPages())
        <div class="pagination">
            {{ $results->appends(['query' => $query])->links() }}
        </div>
    @endif
</div>

<style>
.search-results-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.search-header {
    margin-bottom: 30px;
}

.search-header h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.search-filters {
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-group select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.result-card {
    display: flex;
    align-items: center;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 15px;
}

.result-icon {
    font-size: 24px;
    color: #666;
    margin-right: 20px;
}

.result-content {
    flex: 1;
}

.result-content h3 {
    margin: 0 0 10px 0;
    color: #333;
}

.result-meta {
    display: flex;
    gap: 15px;
    color: #666;
    font-size: 14px;
}

.result-actions {
    margin-left: 20px;
}

.view-btn {
    padding: 8px 16px;
    background: #007bff;
    color: white;
    border-radius: 4px;
    text-decoration: none;
    transition: background 0.3s;
}

.view-btn:hover {
    background: #0056b3;
}

.no-results {
    text-align: center;
    padding: 40px;
    color: #666;
}

.no-results i {
    font-size: 48px;
    margin-bottom: 20px;
    color: #ddd;
}

.pagination {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}
</style>
@endsection 