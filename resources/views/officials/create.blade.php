@extends('layouts.admin.main')

@section('content')
    <div class="container max-w-2xl mx-auto py-6">
        <h2 class="text-2xl font-bold mb-4">Add New Official</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('officials.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block font-semibold">Title</label>
                <select name="title_abbreviation" id="title" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Title --</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Dr.">Dr.</option>
                    <option value="Engr.">Engr.</option>
                    <option value="Prof.">Prof.</option>
                </select>
            </div>

            <div>
                <label for="name" class="block font-semibold">Full Name</label>
                <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="position_id" class="block font-semibold">Position</label>
                <select name="position_id" id="position_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Select Position --</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="term_id" class="block font-semibold">Term</label>
                <select name="term_id" id="term_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Select Term --</option>
                    @foreach ($terms as $term)
                        <option value="{{ $term->id }}">
                            {{ $term->year_start }}–{{ $term->year_end }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="photo_url" class="block font-semibold">Photo URL (optional)</label>
                <input type="url" name="photo_url" id="photo_url" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="bio" class="block font-semibold">Affiliation / School (optional)</label>
                <input type="text" name="bio" id="bio" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Official
                </button>
            </div>
        </form>
    </div>
@endsection
