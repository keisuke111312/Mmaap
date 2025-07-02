@extends('layouts.admin.master')
@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">Community Forum</h1>
                {{-- <button class="dashboard-btn">GO TO DASHBOARD</button> --}}
                <button class="dashboard-btn" onclick="openModal('add-discussion')">CREATE DISCUSSION</button>

            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            {{-- <ul class="tab-items">
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
            </ul> --}}
        </div>
    </nav>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    <div class="container">
        <main class="content">
            {{-- <div class="forum-header">
                <h1>Community Forum</h1>
                <button class="create-btn" id="openEventModalBtn" onclick="openEventModal()">
                    <i class="fas fa-plus"></i>
                    Create Discussion
                </button>
            </div> --}}

            <!-- Discussion Posts -->
            <div id="discussions-container">
                @foreach ($discussions as $discussion)
                    <article class="discussion-card" data-discussion-id="1">
                        <div class="discussion-header">
                            <h2 class="discussion-title">{{ $discussion->title }}</h2>
                            <div class="discussion-meta">
                                <span class="category">Photography</span>

                                <span class="timestamp">{{ $discussion->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="post-content">
                            <div class="user-info">
                                <img src="{{ $discussion->user->avatar_url ? asset('storage/' . $discussion->user->avatar_url) : asset('img/user.png') }}" alt="User Avatar" class="avatar">
                                <div class="user-details">
                                    <strong class="username">{{ $discussion->user->username }}</strong>
                                    <p class="user-role">Community Moderator</p>
                                </div>
                            </div>

                            <div class="post-body">
                                <p>{{$discussion->body}}</p>
                                <div class="post-image">
                                    <img src="{{ $discussion->image_path ? asset('storage/' . $discussion->image_path) : asset('img/user.png') }}"
                                        alt="Avatar">
                                </div>
                            </div>

                            <div class="post-actions">
                                <button class="action-btn like-btn">
                                    <i class="far fa-heart"></i>
                                    <span>{{ $discussion->comments->count() }}</span>
                                </button>
                                <button class="action-btn comment-btn" onclick="toggleComments({{ $discussion->id }})">
                                    <i class="far fa-comment"></i>
                                    <span>{{ $discussion->comments->count() }} Comments</span>
                                </button>
                                <button class="action-btn share-btn">
                                    <i class="far fa-share-square"></i>
                                    Share
                                </button>
                            </div>
                        </div>

                        <!-- Comment Section -->
                        <div id="comments-{{ $discussion->id }}" class="comments-section hidden">
                            <div class="comment-form">
                                <img src="{{ auth()->user()->avatar_url ? asset('storage/' . auth()->user()->avatar_url) : 'https://i.pravatar.cc/32?img=5' }}" alt="Your Avatar" class="comment-avatar">
                                <div class="comment-input-wrapper">
                                    <form action="{{ route('store.comment', ['discussion' => $discussion->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                                        <textarea name="body" placeholder="Write a comment..." class="comment-input"></textarea>
                                        <button type="submit" class="comment-submit-btn">Post</button>
                                    </form>
                                </div>
                            </div>

                            <div class="comments-list">
                                @foreach ($discussion->comments->where('parent_id', null) as $comment)
                                    <div class="comment">
                                        <img src="{{ $comment->user->avatar_url ? asset('storage/' . $comment->user->avatar_url) : 'https://i.pravatar.cc/32?img=' . $comment->user->id }}" alt="User Avatar" class="comment-avatar">
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <strong class="comment-author">{{ $comment->user->username }}</strong>
                                                <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="comment-text">{{ $comment->body }}</p>
                                            <div class="comment-actions">
                                                <button class="comment-action-btn">
                                                    <i class="far fa-heart"></i> 0
                                                </button>
                                                <button class="comment-action-btn reply-btn" onclick="toggleReplyForm(this)">
                                                    <i class="far fa-reply"></i> Reply
                                                </button>
                                            </div>

                                            <!-- Reply Form -->
                                            <div class="reply-form hidden">
                                                <img src="{{ auth()->user()->avatar_url ? asset('storage/' . auth()->user()->avatar_url) : 'https://i.pravatar.cc/24?img=5' }}" alt="Your Avatar" class="reply-avatar">
                                                <div class="reply-input-wrapper">
                                                    <form action="{{ route('store.comment', ['discussion' => $discussion->id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <textarea name="body" placeholder="Write a reply..." class="reply-input"></textarea>
                                                        <button type="submit" class="reply-submit-btn">Reply</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Replies -->
                                            @foreach ($comment->replies as $reply)
                                                <div class="comment reply">
                                                    <img src="{{ $reply->user->avatar_url ? asset('storage/' . $reply->user->avatar_url) : 'https://i.pravatar.cc/32?img=' . $reply->user->id }}" alt="User Avatar" class="comment-avatar">
                                                    <div class="comment-content">
                                                        <div class="comment-header">
                                                            <strong class="comment-author">{{ $reply->user->username }}</strong>
                                                            <span class="comment-time">{{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <p class="comment-text">{{ $reply->body }}</p>
                                                        <div class="comment-actions">
                                                            <button class="comment-action-btn">
                                                                <i class="far fa-heart"></i> 0
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </article>
                @endforeach

                <!-- Discussion 2 -->
                <article class="discussion-card" data-discussion-id="2">
                    <div class="discussion-header">
                        <h2 class="discussion-title">Best Camera Settings for Night Photography</h2>
                        <div class="discussion-meta">
                            <span class="category">Tips & Tricks</span>
                            <span class="timestamp">5 hours ago</span>
                        </div>
                    </div>

                    <div class="post-content">
                        <div class="user-info">
                            <img src="https://i.pravatar.cc/40?img=4" alt="User Avatar" class="avatar">
                            <div class="user-details">
                                <strong class="username">night_shooter</strong>
                                <p class="user-role">Photography Expert</p>
                            </div>
                        </div>

                        <div class="post-body">
                            <p>I've been experimenting with night photography lately and wanted to share some settings that
                                have worked well for me. What are your go-to settings for low light situations?</p>
                        </div>

                        <div class="post-actions">
                            <button class="action-btn like-btn">
                                <i class="far fa-heart"></i>
                                <span>15</span>
                            </button>
                            <button class="action-btn comment-btn" onclick="toggleComments(2)">
                                <i class="far fa-comment"></i>
                                <span>12 Comments</span>
                            </button>
                            <button class="action-btn share-btn">
                                <i class="far fa-share-square"></i>
                                Share
                            </button>
                        </div>
                    </div>

                    <!-- Comment Section -->
                    <div id="comments-{{ $discussion->id }}" class="comments-section hidden">
                        @foreach ($discussions as $discussion)
                            @foreach ($discussion->comments->where('parent_id', null) as $comment)
                                <div class="comment-form">
                                    <img src="https://i.pravatar.cc/32?img=5" alt="Your Avatar" class="comment-avatar">
                                    <div class="comment-input-wrapper">
                                        <textarea placeholder="Write a comment..." class="comment-input"></textarea>
                                        <button class="comment-submit-btn">Post</button>
                                    </div>
                                </div>

                                <div class="comments-list">
                                    <div class="comment">
                                        <img src="https://i.pravatar.cc/32?img=6" alt="User Avatar"
                                            class="comment-avatar">
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <strong class="comment-author">pro_photographer</strong>
                                                <span class="comment-time">3 hours ago</span>
                                            </div>
                                            <p class="comment-text">I usually start with ISO 3200, f/2.8, and 15-30 second
                                                exposures depending on the scene.</p>
                                            <div class="comment-actions">
                                                <button class="comment-action-btn">
                                                    <i class="far fa-heart"></i> 8
                                                </button>
                                                <button class="comment-action-btn reply-btn"
                                                    onclick="toggleReplyForm(this)">
                                                    <i class="far fa-reply"></i> Reply
                                                </button>
                                            </div>

                                            <!-- Reply Form -->
                                            <div class="reply-form hidden">
                                                <img src="https://i.pravatar.cc/24?img=5" alt="Your Avatar"
                                                    class="reply-avatar">
                                                <div class="reply-input-wrapper">
                                                    <textarea placeholder="Write a reply..." class="reply-input"></textarea>
                                                    <button class="reply-submit-btn">Reply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </article>
            </div>
        </main>

        <aside class="sidebar">
            <div class="sidebar-card">
                <div class="card-header">
                    <h3><i class="fas fa-trophy"></i> Top Contributors</h3>
                </div>
                <div class="card-content">
                    <div class="contributor-list">
                        <div class="contributor-item">
                            <img src="https://i.pravatar.cc/32?img=1" alt="John Doe" class="contributor-avatar">
                            <div class="contributor-info">
                                <strong>John Doe</strong>
                                <span class="contributor-score">103 points</span>
                            </div>
                            <div class="contributor-rank">#1</div>
                        </div>
                        <div class="contributor-item">
                            <img src="https://i.pravatar.cc/32?img=2" alt="Agnieszka Bladzik" class="contributor-avatar">
                            <div class="contributor-info">
                                <strong>agnieszka bladzik</strong>
                                <span class="contributor-score">84 points</span>
                            </div>
                            <div class="contributor-rank">#2</div>
                        </div>
                        <div class="contributor-item">
                            <img src="https://i.pravatar.cc/32?img=3" alt="Ian Prince" class="contributor-avatar">
                            <div class="contributor-info">
                                <strong>Ian Prince</strong>
                                <span class="contributor-score">79 points</span>
                            </div>
                            <div class="contributor-rank">#3</div>
                        </div>
                        <div class="contributor-item">
                            <img src="https://i.pravatar.cc/32?img=4" alt="noun" class="contributor-avatar">
                            <div class="contributor-info">
                                <strong>noun</strong>
                                <span class="contributor-score">76 points</span>
                            </div>
                            <div class="contributor-rank">#4</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar-card">
                <div class="card-header">
                    <h3><i class="fas fa-question-circle"></i> Unanswered Talks</h3>
                </div>
                <div class="card-content">
                    <ul class="unanswered-list">
                        <li>
                            <a href="#">The only thing worse than being a GWC is...</a>
                            <span class="question-meta">2 hours ago</span>
                        </li>
                        <li>
                            <a href="#">If there was one thing you could change...</a>
                            <span class="question-meta">4 hours ago</span>
                        </li>
                        <li>
                            <a href="#">Photo correlations</a>
                            <span class="question-meta">1 day ago</span>
                        </li>
                    </ul>
                    <a href="#" class="view-more-btn">View more <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="sidebar-card">
                <div class="card-header">
                    <h3><i class="fas fa-tags"></i> Popular Tags</h3>
                </div>
                <div class="card-content">
                    <div class="tags-container">
                        <span class="tag">photography</span>
                        <span class="tag">landscape</span>
                        <span class="tag">portrait</span>
                        <span class="tag">street</span>
                        <span class="tag">macro</span>
                        <span class="tag">editing</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Create Discussion Modal -->


    <form action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data"
        class="discussion-form">
        @csrf
        <div id="add-discussion" class="modal-overlay hidden">
            <div id="eventModalContent" style="background: none; box-shadow: none;">
                <div class="modal" style="position:relative; margin-top:0;">
                    <button type="button" onclick="closeModal('add-discussion')"
                        style="position:absolute; top:18px; right:18px; background:none; border:none; font-size:2rem; color:#888; cursor:pointer;">&times;</button>
                    <h2>CREATE DISCUSSION</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" placeholder="Discussion Title" name="title">
                        </div>
                        <div class="form-group right-col">
                            <label for="tags">Select a Tag:</label>
                            <select name="tags" id="tags" class="form-input">
                                <option value="">-- Select Tags --</option>
                                <option value="photography">Photography</option>
                                <option value="landscape">Landscape</option>
                                <option value="portrait">Portrait</option>
                                <option value="street">Street</option>
                                <option value="macro">Macro</option>
                                <option value="editing">Editing</option>
                            </select>
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
    <script>
        function openEventModal() {
            const modal = document.getElementById('eventModalOverlay');
            modal.classList.remove('hidden');
            modal.classList.add('active');
        }

        function closeEventModal() {
            const modal = document.getElementById('eventModalOverlay');
            modal.classList.remove('active');
            modal.classList.add('hidden');
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

    <script>
        function toggleComments(discussionId) {
            const commentSection = document.getElementById(`comments-${discussionId}`);
            commentSection.classList.toggle('hidden');
        }

        function toggleReplyForm(button) {
            const replyForm = button.closest('.comment-content').querySelector('.reply-form');
            replyForm.classList.toggle('hidden');
        }

        // Auto-resize textareas
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });
        });
    </script>
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }


        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 1rem;
            }
        }

        /* Forum Header */
        .forum-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .forum-header h1 {
            font-size: 2rem;
            font-weight: 700;
            background: #0f2f4a;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .create-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #ed1c24 0%, #c41e3a 100%);
            color: white;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(237, 28, 36, 0.3);
        }

        .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(237, 28, 36, 0.4);
        }

        /* Discussion Cards */
        .discussion-card {
            background: white;
            margin-bottom: 1.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .discussion-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
        }

        .discussion-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .discussion-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .discussion-meta {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .category {
            padding: 0.25rem 0.75rem;
            background: #0f2f4a;
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .timestamp {
            color: #64748b;
            font-size: 0.875rem;
        }

        /* Post Content */
        .post-content {
            padding: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 3px solid #f1f5f9;
            transition: border-color 0.3s ease;
        }

        .user-details .username {
            font-weight: 600;
            color: #1a202c;
            font-size: 1rem;
        }

        .user-role {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }

        .post-body {
            margin-bottom: 1.5rem;
        }

        .post-body p {
            margin-bottom: 1rem;
            color: #4a5568;
            line-height: 1.7;
        }

        .post-image {
            margin: 1rem 0;
            overflow: hidden;
        }

        .post-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .post-image:hover img {
            transform: scale(1.02);
        }

        /* Post Actions */
        .post-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #f1f5f9;
            color: #475569;
            transform: translateY(-1px);
        }

        .action-btn.active {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        /* Comments Section */
        .comments-section {
            border-top: 1px solid #f1f5f9;
            background: #fafbfc;
        }

        .comments-section.hidden {
            display: none;
        }

        .comment-form {
            display: flex;
            gap: 1rem;
            padding: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .comment-input-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .comment-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            resize: vertical;
            min-height: 80px;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        .comment-input:focus {
            outline: none;
            border-color: #0f2f4a;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .comment-submit-btn {
            align-self: flex-end;
            padding: 0.5rem 1rem;
            background: #0f2f4a;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .comment-submit-btn:hover {
            background: #5a67d8;
        }

        /* Comments List */
        .comments-list {
            padding: 0 1.5rem 1.5rem;
        }

        .comment {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
        }

        .comment.reply {
            margin-left: 2rem;
            background: #f8fafc;
            border-left: 3px solid #0f2f4a;
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .comment-author {
            font-weight: 600;
            color: #1a202c;
        }

        .comment-time {
            color: #64748b;
            font-size: 0.875rem;
        }

        .comment-text {
            color: #4a5568;
            margin-bottom: 0.75rem;
            line-height: 1.6;
        }

        .comment-actions {
            display: flex;
            gap: 1rem;
        }

        .comment-action-btn {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            background: none;
            border: none;
            color: #64748b;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .comment-action-btn:hover {
            background: #f1f5f9;
            color: #475569;
        }

        /* Reply Form */
        .reply-form {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .reply-form.hidden {
            display: none;
        }

        .reply-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .reply-input-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .reply-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            resize: vertical;
            min-height: 60px;
            font-family: inherit;
            font-size: 0.875rem;
        }

        .reply-submit-btn {
            align-self: flex-end;
            padding: 0.375rem 0.75rem;
            background: #0f2f4a;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .sidebar-card {
            background: white;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-header h3 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.125rem;
            font-weight: 700;
            color: #1a202c;
        }

        .card-header i {
            color: #0f2f4a;
        }

        .card-content {
            padding: 1rem 1.5rem 1.5rem;
        }

        /* Contributors */
        .contributor-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contributor-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 12px;
            transition: background-color 0.3s ease;
        }

        .contributor-item:hover {
            background: #f1f5f9;
        }

        .contributor-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .contributor-info {
            flex: 1;
        }

        .contributor-info strong {
            display: block;
            font-weight: 600;
            color: #1a202c;
            font-size: 0.875rem;
        }

        .contributor-score {
            color: #64748b;
            font-size: 0.75rem;
        }

        .contributor-rank {
            font-weight: 700;
            color: #0f2f4a;
            font-size: 0.875rem;
        }

        /* Unanswered Questions */
        .unanswered-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .unanswered-list li {
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .unanswered-list li:hover {
            background: #f1f5f9;
        }

        .unanswered-list a {
            color: #1a202c;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            line-height: 1.4;
            display: block;
            margin-bottom: 0.25rem;
        }

        .unanswered-list a:hover {
            color: #0f2f4a;
        }

        .question-meta {
            color: #64748b;
            font-size: 0.75rem;
        }

        .view-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #0f2f4a;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            margin-top: 1rem;
            transition: color 0.3s ease;
        }

        .view-more-btn:hover {
            color: #5a67d8;
        }

        /* Tags */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .tag {
            padding: 0.375rem 0.75rem;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: #475569;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: lowercase;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .tag:hover {
            background: #0f2f4a;
            color: white;
            transform: translateY(-1px);
        }

        /* Modal Styles */
        /* Form Styles */
        .discussion-form {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0f2f4a;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Upload Area */
        .upload-area {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fafbfc;
        }

        .upload-area:hover {
            border-color: #0f2f4a;
            background: #f8fafc;
        }

        .upload-content i {
            font-size: 2rem;
            color: #0f2f4a;
            margin-bottom: 1rem;
        }

        .upload-content p {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .upload-content small {
            color: #64748b;
        }

        /* File Preview */
        .file-preview {
            margin-top: 1rem;
        }

        .file-preview.hidden {
            display: none;
        }

        .file-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .file-chip i {
            color: #0f2f4a;
        }

        .remove-file-btn {
            background: none;
            border: none;
            color: #dc2626;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .remove-file-btn:hover {
            background: #fef2f2;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f5f9;
        }

        .cancel-btn {
            padding: 0.75rem 1.5rem;
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cancel-btn:hover {
            background: #f1f5f9;
            color: #475569;
        }

        .submit-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #0f2f4a;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .forum-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .forum-header h1 {
                font-size: 1.5rem;
            }

            .discussion-title {
                font-size: 1.25rem;
            }

            .post-actions {
                flex-wrap: wrap;
            }

            .action-btn {
                flex: 1;
                min-width: 120px;
                justify-content: center;
            }

            .comment.reply {
                margin-left: 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .cancel-btn,
            .submit-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Utility Classes */
        .hidden {
            display: none !important;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .discussion-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>
@endsection
