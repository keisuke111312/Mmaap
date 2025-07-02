<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type', 'all');

        $results = collect();

        if ($type === 'all' || $type === 'events') {
            $events = Event::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->get()
                ->map(function ($event) {
                    return (object) [
                        'type' => 'event',
                        'title' => $event->title,
                        'description' => $event->description,
                        'created_at' => $event->created_at,
                        'url' => route('admin.calendar')
                    ];
                });
            $results = $results->concat($events);
        }

        if ($type === 'all' || $type === 'users') {
            $users = User::where('fname', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->get()
                ->map(function ($user) {
                    return (object) [
                        'type' => 'user',
                        'title' => $user->fname,
                        'description' => $user->email,
                        'created_at' => $user->created_at,
                        'url' => route('search.show', ['id' => $user->id])
                    ];
                });

            $results = $results->concat($users);
        }

        if ($type === 'all' || $type === 'resources') {
            $resources = Resources::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->get()
                ->map(function ($resource) {
                    return (object) [
                        'type' => 'resource',
                        'title' => $resource->title,
                        'description' => $resource->description,
                        'created_at' => $resource->created_at,
                        'url' => route('resource.management')
                    ];
                });
            $results = $results->concat($resources);
        }

        // Sort results by created_at
        $results = $results->sortByDesc('created_at');

        // Convert to pagination
        $page = $request->input('page', 1);
        $perPage = 10;
        $results = new \Illuminate\Pagination\LengthAwarePaginator(
            $results->forPage($page, $perPage),
            $results->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('search.results', [
            'query' => $query,
            'results' => $results
        ]);
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        $user_education = $user->load(['experiences', 'education', 'skill']);

        return view('results.profile', compact('user', 'user_education'));
    }



}