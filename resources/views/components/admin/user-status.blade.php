
    <style>


        .user-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }



        .tabs-list {
            list-style: none;
            display: flex;
            gap: 0;
            padding: 0;
            border-bottom: 1px solid #e9ecef;
        }

        .tab-button {
            background: none;
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            font-weight: 500;
            color: #6c757d;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .tab-button:hover,
        .tab-button.active {
            color: #0f2f4a;
            border-bottom-color: #0f2f4a;
        }

        .main {
            display: grid;
            grid-template-columns: 300px 1fr 350px;
            gap: 20px;
            height: calc(80vh - 200px);
        }

        .sidebar {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar-title {
            font-size: 14px;
            font-weight: 600;
            color: #6c757d;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .content {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .details-panel {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .message-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .message-row {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .message-row:hover {
            transform: translateY(-2px);
        }

        .message-row.selected {
            background-color: #e3f2fd;
        }

        .message-table td {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 16px;
            vertical-align: middle;
            transition: all 0.3s ease;
        }

        .message-row:hover td {
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* .message-row td:first-child {
            border-radius: 8px 0 0 8px;
        }

        .message-row td:last-child {
            border-radius: 0 8px 8px 0;
        } */

        .message-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .radio-input {
            width: 16px;
            height: 16px;
            accent-color: #0f2f4a;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e9ecef;
        }

        .user-info {
            flex: 1;
        }

        .chat-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .user-role {
            font-size: 12px;
            color: #6c757d;
            background: #e9ecef;
            padding: 2px 8px;
            /* border-radius: 12px; */
            display: inline-block;
        }

        .time {
            width: 120px;
            text-align: right;
            font-size: 12px;
            color: #6c757d;
            font-weight: 500;
        }

        .quick-chat {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .chat-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .chat-user:hover {
            background: #f8f9fa;
            border-color: #e9ecef;
        }

        .chat-user.active {
            background: #e3f2fd;
            border-color: #0f2f4a;
        }

        .status-indicator {
            position: relative;
        }

        .status-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #28a745;
            position: absolute;
            bottom: 0;
            right: 0;
            border: 2px solid white;
        }

        .details-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 20px;
        }

        .details-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 12px;
            display: block;
            border: 3px solid #0f2f4a;
        }

        .details-name {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .details-role {
            color: #6c757d;
            font-size: 14px;
        }

        .details-section {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 14px;
            color: #6c757d;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-primary {
            background: #0f2f4a;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        @media (max-width: 1024px) {
            .main {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto;
            }
            
            .sidebar {
                order: 1;
            }
            
            .content {
                order: 2;
            }
            
            .details-panel {
                order: 3;
            }
        }
    </style>

    <div class="user-container">
        {{-- <div class="header">
            <div class="settings-title">User Management</div>
            <ul class="tabs-list">
                <li><button class="tab-button active">All Users</button></li>
                <li><button class="tab-button">Active</button></li>
                <li><button class="tab-button">Inactive</button></li>
                <li><button class="tab-button">Pending</button></li>
            </ul>
        </div> --}}

        <div class="main">
            <!-- Recently Registered Sidebar -->
            <div class="sidebar">
                <div class="sidebar-title">Recently Registered</div>
                <div class="quick-chat">
                    @foreach($users->sortByDesc('created_at')->take(4) as $user)
                        <div class="chat-user{{ $loop->first ? ' active' : '' }}" 
                             onclick="selectRecentUser(this, {{ $user->id }})"
                             data-user='@json($user)'>
                            <div class="status-indicator">
                                {{-- <img class="avatar" src="{{ $user->avatar_url ?? '/placeholder.svg?height=40&width=40' }}" alt="Avatar"> --}}
                                <img class="avatar" id="avatarPreview" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.png') }}" alt="Avatar">
                                @if(optional($user->accessLevel)->name === 'Admin' || optional($user->accessLevel)->name === 'Moderator')
                                    <div class="status-dot"></div>
                                @endif
                            </div>
                            <div class="user-info">
                                <div class="chat-name">{{ $user->fname }} {{ $user->lname }}</div>
                                <div class="user-role">{{ optional($user->accessLevel)->name ?? 'User' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Main Content -->
            <div class="content">
                <table class="message-table">
                    <tbody>
                        @foreach($users as $user)
                        <tr class="message-row{{ $loop->first ? ' selected' : '' }}" 
                            onclick="selectUser(this, {{ $user->id }})"
                            data-user='@json($user)'>
                            <td>
                                <div class="message-info">
                                    <input type="radio" name="message" class="radio-input" {{ $loop->first ? 'checked' : '' }}>
                                    <img class="avatar" id="avatarPreview" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.png') }}" alt="Avatar">

                                    <div class="user-info">
                                        <div class="chat-name">{{ $user->fname }} {{ $user->lname }}</div>
                                        <div class="user-role">{{ optional($user->accessLevel)->name ?? 'User' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="time">{{ optional($user->accessLevel)->name ?? 'User' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- User Details Panel -->
            <div class="details-panel">
                <div id="userDetails">
                    @if($users->count())
                        @php $user = $users->first(); @endphp
                        <div class="details-header">
                        <img class="avatar" id="avatarPreview" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.png') }}" alt="Avatar">

                            <div class="details-name">{{ $user->fname }} {{ $user->lname }}</div>
                            <div class="details-role">{{ optional($user->accessLevel)->name ?? 'User' }}</div>
                        </div>
                        <div class="details-section">
                            <div class="section-title">Contact Information</div>
                            <div class="detail-item">
                                <span class="detail-label">Email</span>
                                <span class="detail-value">{{ $user->email }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Phone</span>
                                <span class="detail-value">{{ $user->contact ?? '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Location</span>
                                <span class="detail-value">{{ $user->location ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="details-section">
                            <div class="section-title">Account Details</div>
                            <div class="detail-item">
                                <span class="detail-label">Join Date</span>
                                <span class="detail-value">{{ $user->created_at ? $user->created_at->format('M d, Y') : '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Last Active</span>
                                <span class="detail-value">{{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Status</span>
                                <span class="detail-value">Online</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Department</span>
                                <span class="detail-value">{{ $user->department ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button class="btn btn-primary">Edit User</button>
                            <button class="btn btn-secondary">View Profile</button>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">👤</div>
                            <p>Select a user to view details</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectUser(row, userId) {
            document.querySelectorAll('.message-row').forEach(r => r.classList.remove('selected'));
            document.querySelectorAll('.chat-user').forEach(u => u.classList.remove('active'));
            row.classList.add('selected');
            row.querySelector('input[type="radio"]').checked = true;
            const user = JSON.parse(row.getAttribute('data-user'));
            showUserDetails(user);
        }
        function selectRecentUser(element, userId) {
            document.querySelectorAll('.chat-user').forEach(u => u.classList.remove('active'));
            document.querySelectorAll('.message-row').forEach(r => r.classList.remove('selected'));
            element.classList.add('active');
            const user = JSON.parse(element.getAttribute('data-user'));
            showUserDetails(user);
        }
        
        function showUserDetails(user) {
            const detailsHtml = `
                <div class="details-header">
                    
                    <img class="details-avatar" src="${user->avatar_url ? asset('storage/' . $user->avatar_url) : '/placeholder.svg?height=80&width=80'}" alt="Avatar">
                    <div class="details-name">${user.fname} ${user.lname}</div>
                    <div class="details-role">${user.access_level ? user.access_level.name : 'User'}</div>
                </div>
                <div class="details-section">
                    <div class="section-title">Contact Information</div>
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">${user.email}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Phone</span>
                        <span class="detail-value">${user.contact ? user.contact : '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Location</span>
                        <span class="detail-value">${user.location ? user.location : '-'}</span>
                    </div>
                </div>
                <div class="details-section">
                    <div class="section-title">Account Details</div>
                    <div class="detail-item">
                        <span class="detail-label">Join Date</span>
                        <span class="detail-value">${user.created_at ? new Date(user.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Last Active</span>
                        <span class="detail-value">${user.updated_at ? new Date(user.updated_at).toLocaleString() : '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">Online</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Department</span>
                        <span class="detail-value">${user.department ? user.department : '-'}</span>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary">Edit User</button>
                    <button class="btn btn-secondary">View Profile</button>
                </div>
            `;
            document.getElementById('userDetails').innerHTML = detailsHtml;
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Select the first user row by default
            const firstRow = document.querySelector('.message-row');
            if (firstRow) {
                const user = JSON.parse(firstRow.getAttribute('data-user'));
                showUserDetails(user);
            }
        });
    </script>
