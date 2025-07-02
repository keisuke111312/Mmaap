<link rel="stylesheet" href="{{ asset('css/ribbon.css') }}">

<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: row;
        background: #f9f9f9;
        min-height: 100vh;
    }
    .dashboard-sidebar {
        width: 320px;
        background: #fff;
        padding: 2rem 1rem 1rem 1rem;
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
    .user-card {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
    }
    .user-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }
    .user-card h3 {
        margin-bottom: 5px;
    }
    .badge {
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 4px;
        color: white;
        margin-left: 10px;
    }
    .badge.active { background-color: green; }
    .badge.expiring { background-color: orange; }
    .badge.suspended { background-color: red; }
    .role-switcher { margin-left: auto; }
    .role-switcher select { padding: 5px; font-size: 14px; }
    .sidebar-section-title { font-weight: bold; margin-bottom: 10px; }
    .quick-chat .chat-user {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0;
    }
    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: green;
        display: inline-block;
    }
    .dashboard-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 2rem;
    }
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .tabs {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .tabs input { margin-right: 0.5rem; }
    .filters { display: flex; gap: 0.5rem; }
    .message-list {
        flex: 1;
        overflow-y: auto;
        margin-bottom: 2rem;
    }
    .message-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        background: #fff;
        border: 1px solid rgba(109, 109, 109, 0.15);
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 1rem;
    }
    .message-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .chat-name { font-weight: bold; }
    .chat-snippet { font-size: 0.9rem; color: #888; }
    .time { font-size: 0.75rem; color: #666; }
    .btn {
        background: #f44336;
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .section {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(0,0,0,0.04);
        margin-bottom: 1.5rem;
        padding: 1rem;
    }
    .section-title {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    .timeline {
        list-style: none;
        padding-left: 0;
    }
    .timeline li {
        margin-bottom: 10px;
        padding-left: 20px;
        position: relative;
    }
    .timeline li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 6px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #007bff;
    }
</style>

<div class="dashboard-container">
    <!-- Sidebar: User Profile & Quick Chat -->
    <div class="dashboard-sidebar">
        <div>
            <div class="sidebar-section-title">User Profile</div>
            <div class="user-card">
                <img src="https://via.placeholder.com/50" alt="User" />
                <div>
                    <h3>John Doe <span class="badge active">🟢 Active</span></h3>
                    <small>john@example.com</small>
                </div>
                <div class="role-switcher">
                    <select>
                        <option>Free</option>
                        <option selected>Member</option>
                        <option>Premium</option>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <div class="sidebar-section-title">Recently Registered</div>
            <div class="quick-chat">
                <div class="chat-user">
                    <img class="avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                    <div>
                        <div>John Doe</div>
                        <span class="status-dot"></span> Online
                    </div>
                </div>
                <!-- Repeat for more users -->
            </div>
        </div>
    </div>
    <!-- Main Content: Messaging & History -->
    <div class="dashboard-main">
        <div class="dashboard-header">
            <div class="tabs">
                <strong>MESSAGES</strong>
                <button class="btn">NEW</button>
                <label><input type="radio" name="tab" checked> INBOX</label>
                <label><input type="radio" name="tab"> OUTBOX</label>
                <label><input type="radio" name="tab"> ARCHIVE</label>
                <label><input type="radio" name="tab"> GROUP</label>
            </div>
            <div class="filters">
                <span>FILTERS -</span>
                <button class="btn">ALL</button>
                <button>WORK</button>
                <button>FAMILY</button>
                <button>PARTNER</button>
                <button>SPONSORS</button>
            </div>
        </div>
        <div class="message-list">
            <div class="message-row">
                <div class="message-info">
                    <input type="radio" name="message">
                    <img class="avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                    <div>
                        <div class="chat-name">John Doe</div>
                        <div class="chat-snippet">Hey, how are you!</div>
                    </div>
                </div>
                <div class="time">07.50 PM</div>
            </div>
            <div class="message-row">
                <div class="message-info">
                    <input type="radio" name="message">
                    <img class="avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                    <div>
                        <div class="chat-name">John Doe</div>
                        <div class="chat-snippet">Hey, how are you!</div>
                    </div>
                </div>
                <div class="time">07.50 PM</div>
            </div>
            <!-- Repeat for more messages -->
        </div>
        <div class="section">
            <div class="section-title">Payment History</div>
            <table class="table">
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Gateway</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>2025-05-01</td>
                    <td>$9.99</td>
                    <td>Stripe</td>
                    <td>Success</td>
                </tr>
                <tr>
                    <td>2025-04-01</td>
                    <td>$9.99</td>
                    <td>Stripe</td>
                    <td>Success</td>
                </tr>
                <tr>
                    <td>2025-03-01</td>
                    <td>$9.99</td>
                    <td>Stripe</td>
                    <td>Failed</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <div class="section-title">Membership Change History</div>
            <ul class="timeline">
                <li>2025-06-01 – Upgraded to Premium</li>
                <li>2025-04-01 – Downgraded to Member</li>
                <li>2025-01-01 – Registered as Free</li>
            </ul>
        </div>
    </div>
</div> 