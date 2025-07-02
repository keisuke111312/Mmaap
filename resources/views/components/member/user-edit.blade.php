    <div class="settings-container">

        <div class="settings-wrapper">
            <!-- Header -->


            <div class="main-content">
                <!-- Main Form -->
                <div class="form-section">
                    <form action="{{ route('update.user-profile', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group avatar-upload-group">
                            {{-- <label for="avatar" class="form-label">AVATAR</label> --}}
                            <div class="avatar-preview">
                                <img id="avatarPreview" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.png') }}" alt="Avatar">

                            </div>
                            <input type="file" id="avatar" name="avatar_url" accept="image/*" class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">FIRST NAME</label>
                            <input type="text" id="name" class="form-input" name="fname" value="{{ $user->fname }}">
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">LAST NAME</label>
                            <input type="text" id="name" class="form-input" name="lname" value="{{ $user->lname }}">
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label"> USERNAME</label>
                            <input type="text" id="name" class="form-input" name="username" value="{{ $user->username }}">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">EMAIL</label>
                            <input type="email" id="email" class="form-input" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">CONTACT</label>
                            <input type="text" id="email" class="form-input" name="contact" value="{{ $user->contact }}">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">PASSWORD</label>
                            <input type="password" id="password" name="password" class="form-input"
                                placeholder="Enter new password">
                        </div>

                        <div class="form-group">
                            <label for="website" class="form-label">WEBSITE</label>
                            <input type="url" id="website" name="portfolio_url" class="form-input" value="{{ old('portfolio_url', $user->portfolio_url ?? 'https://www.yoursite.com') }}">

                        </div>
                        <button type="submit" class="save-btn">SAVE UPDATE</button>
                    </form>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Interest Section -->
                    {{-- <div class="sidebar-section">
                        <h3 class="sidebar-title">INTEREST</h3>

                        <div class="search-wrapper">
                            <input type="text" class="form-input" placeholder="Search interests...">
                            <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <div class="interest-tags">
                            <span class="interest-tag">Technology</span>
                            <span class="interest-tag">Technique</span>
                            <span class="interest-tag">Teacher</span>
                        </div>

                        <div class="interest-categories">
                            <button class="category-btn">FOOD</button>
                            <button class="category-btn">AWARDS</button>
                            <button class="category-btn">SCIENCE</button>
                            <button class="category-btn">TECHNOLOGY</button>
                        </div>
                    </div> --}}

                    <!-- Social Account Section -->
                    <div class="sidebar-section">
                        <h3 class="sidebar-title">ADD SOCIAL ACCOUNT</h3>

                        <div class="social-input-wrapper">
                            <input type="url" class="social-input" placeholder="http://">
                            <button class="social-add-btn">ADD</button>
                        </div>

                        <div class="social-added">
                            <p class="social-added-text">ADDED -</p>
                            <div class="social-icons">
                                <svg class="social-icon" style="color: #3b82f6;" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                <svg class="social-icon" style="color: #1da1f2;" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                                <svg class="social-icon" style="color: #e1306c;" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>