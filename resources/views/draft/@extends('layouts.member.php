    @extends('layouts.member.main')
    @section('content')
        {{-- <div class="ribbon" style="background: #FFF;"  class="ribbon-header">
        <h1>COMMUNITY FORUM</h1>

    </div> --}}
        <div class="container">
            <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
            <main class="content">

                <!-- Add Create Discussion Button -->
                {{-- <button class="btn" style="margin-bottom: 20px; background:#ed1c24;" onclick="openEventModal()">Create
                    Discussion</button> --}}
                @foreach ($discussions as $discussion)
                    <div class="discussion-header">

                        <div class="post">
                            <div class="discussion-header">
                            <h2 class="discussion-title">{{ $discussion->title }}</h2>
                        </div>
                        <div class="user">
                            <img src="https://i.pravatar.cc/40?img=1" alt="avatar" />
                            <div>
                                <div>
                                    <strong>{{ $discussion->user->username }}</strong>
                                    <p>{{ $discussion->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        <p>{{ $discussion->body }}</p>
                        {{-- <img src="{{ asset('img/02_events.jpg') }}" alt=""> --}}
                        <img src="{{ $discussion->image_path ? asset('storage/' . $discussion->image_path) : asset('images/default-avatar.png') }}"
                            alt="Avatar">
                        <p></p>
                        <button onclick="toggleComments({{ $discussion->id }})" class="toggle-comments-btn">
                            Show/Hide Comments
                        </button>
                    </div>
                    <div class="comment-box">

                        <form action="{{ route('store.comment', ['discussion' => $discussion->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                            <textarea name="body" placeholder="Type here to reply..."></textarea>
                            <button type="submit">Post comment</button>
                        </form>
                    </div>
                </div>

                <div class="comments-section">
                    @php
                        $totalComments = 0;
                        foreach ($discussions as $discussion) {
                            $totalComments += $discussion->comments->count();
                        }
                    @endphp

                    <h3>{{ $totalComments }} comments</h3>

                    <div id="comments-{{ $discussion->id }}" class="comments-section hidden">
                        @foreach ($discussions as $discussion)
                            @foreach ($discussion->comments->where('parent_id', null) as $comment)
                                <div class="comment">
                                    <div class="user">
                                        <img src="https://i.pravatar.cc/40?u={{ $comment->user->id }}" alt="avatar" />
                                        <div>
                                            <strong>{{ $comment->user->username }}</strong>
                                            <p>{{ $comment->body }}</p>
                                            <span class="liked">Liked • {{ $comment->created_at->diffForHumans() }}</span>

                                            {{-- Reply Button --}}
                                            <button class="reply-button"
                                                onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')">
                                                Reply
                                            </button>

                                            {{-- Hidden Reply Form --}}
                                            <form id="reply-form-{{ $comment->id }}" class="mt-2 hidden"
                                                action="{{ route('store.comment', ['discussion' => $comment->discussion_id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="discussion_id"
                                                    value="{{ $comment->discussion_id }}">
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <textarea name="body" rows="2" placeholder="Write your reply..." class="w-full p-2 border rounded"></textarea>
                                                <button type="submit"
                                                    class="mt-1 bg-blue-500 text-white px-3 py-1 rounded">Reply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                {{-- Replies --}}
                                @foreach ($comment->replies as $reply)
                                    <div class="comment reply" style="margin-left: 2rem;">
                                        <div class="user">
                                            <img src="https://i.pravatar.cc/40?u={{ $reply->user->id }}" alt="avatar" />
                                            <div>
                                                <strong>{{ $reply->user->username }}</strong>
                                                <p>{{ $reply->body }}</p>
                                                <span class="liked">Liked •
                                                    {{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endforeach
                    </div>


                </div>
        </main>
        @endforeach

        <aside class="sidebar">
            <div class="card">
                <h3>Top Contributors</h3>
                <ul>
                    <li><strong>John Doe</strong> - 103</li>
                    <li>agnieszka bladzik - 84</li>
                    <li>Ian Prince - 79</li>
                    <li>noun - 76</li>
                </ul>
            </div>

            <div class="card">
                <h3>Unanswered Talks</h3>
                <ul>
                    <li>The only thing worse than being a GWC is...</li>
                    <li>If there was one thing you could change...</li>
                    <li>Photo correlations</li>
                </ul>
                <a href="#">View more</a>
            </div>
        </aside>
    </div>

    <form action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data" class="discussion-form">
        @csrf

        <div id="eventModalOverlay" class="modal-overlay hidden">
            <div id="eventModalContent"
                style="padding: 2rem; border-radius: 10px; width: 90%; max-width: 1200px; margin:0;">
                <div class="modal" style="position:relative; margin-top:0;">
                    <button type="button" onclick="closeEventModal()"
                        style="position:absolute; top:18px; right:18px; background:none; border:none; font-size:2rem; color:#888; cursor:pointer;">&times;</button>
                    <h2>CREATE DISCUSSION</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" placeholder="Music Awards" name="title">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <textarea placeholder="Description here" name="body"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>UPLOAD IMAGE</label>
                            <div class="chips">
                                <div class="chip"><i class="fas fa-image"></i> Event_Image.jpg <span
                                        style="color: red; margin-left: 5px; cursor: pointer;">Remove</span></div>
                            </div>
                            <div class="upload-box" id="uploadBox" onclick="triggerFileInput()">
                                <i class="fas fa-cloud-upload-alt"></i><br>
                                You can also upload image here
                                <input type="file" name="image_path" id="image_path" accept="image/*"
                                    style="display:none;">
                            </div>

                        </div>

                    </div>
                    <button type="submit" class="btn">Post Discussion</button>

                </div>

            </div>

        </div>

    </form>




    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #222;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            gap: 30px;
        }

        .content {
            flex: 3;
        }

        .sidebar {
            flex: 1;
        }

        .back {
            color: #555;
            text-decoration: none;
            font-size: 14px;
        }

        .discussion-title {
            margin-top: 10px;
        }

        .discussion-title h1 {
            font-size: 24px;
        }


        .actions a {
            font-size: 12px;
            margin-right: 10px;
            color: #888;
            text-decoration: none;
        }

        .discussion-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .discussion-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
            line-height: 1.3;
        }

        .post-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }


        .post {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        .post img {
            width: auto;
            max-width: 800px;
        }

        .user {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 1.5rem;
            margin-top: 1.5rem;

        }

        .user img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .comment-box {
            margin-top: 15px;
        }

        .comment-box textarea {
            width: 100%;
            height: 60px;
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .comment-box button {
            margin-top: 10px;
            padding: 8px 14px;
            background-color: #ed1c24;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comments-section {
            margin-top: 30px;
            background: none;
            padding: 0 0 0 0;
        }

        .comment {
            background: #fff;
            padding: 14px 18px 14px 18px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
            border-left: 4px solid transparent;
            position: relative;
            transition: box-shadow 0.18s;
        }

        .comment:hover {
            box-shadow: 0 2px 8px rgba(237, 28, 36, 0.08);
        }

        .comment.reply {
            margin-left: 36px;
            border-left: 3px solid #ed1c24;
            background: #fafbfc;
        }

        .user {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 0;
        }

        .user img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: 2px;
        }

        .user>div {
            flex: 1;
        }

        .liked {
            color: #777;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .sidebar .card {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        .sidebar .card h3 {
            margin-top: 0;
            font-size: 16px;
        }

        .sidebar .card ul {
            list-style: none;
            padding-left: 0;
            font-size: 14px;
        }

        .sidebar .card ul li {
            margin: 8px 0;
        }

        .sidebar .card a {
            display: inline-block;
            margin-top: 10px;
            color: #5c67f2;
            text-decoration: none;
            font-size: 14px;
        }
    </style>

    {{-- <script>
        function toggleComments(discussionId) {
            const commentSection = document.getElementById(comments - $ {
                discussionId
            });
            commentSection.classList.toggle('hidden');
        }
    </script> --}}

    <script>
        function toggleComments(discussionId) {
            const commentSection = document.getElementById(`comments-${discussionId}`);
            commentSection.classList.toggle('hidden');
        }
    </script>



    <script>
        window.triggerFileInput = function() {
            document.getElementById('image_path').click();
        };

        window.removeFile = function() {
            const fileInput = document.getElementById('image_path');
            fileInput.value = '';
            document.querySelector('.chips').innerHTML = '';
        };

        window.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('image_path');
            if (!fileInput) return;

            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const chipsContainer = document.querySelector('.chips');
                chipsContainer.innerHTML = '';

                if (file) {
                    const chip = document.createElement('div');
                    chip.classList.add('chip');
                    chip.innerHTML = `
                <i class="fas fa-file-alt"></i> ${file.name}
                <span style="color: red; margin-left: 5px; cursor: pointer;" onclick="removeFile()">Remove</span>
            `;
                    chipsContainer.appendChild(chip);
                }
            });
        });
    </script>
@endsection
