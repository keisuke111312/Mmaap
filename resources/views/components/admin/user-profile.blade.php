<style>


    .sidebar {
        width: 300px;
        background-color: #fff;
        padding: 20px;
        border-right: 1px solid #eee;
    }

    .content {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
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

    .badge.active {
        background-color: green;
    }

    .badge.expiring {
        background-color: orange;
    }

    .badge.suspended {
        background-color: red;
    }

    .role-switcher {
        margin-left: auto;
    }

    .role-switcher select {
        padding: 5px;
        font-size: 14px;
    }

    .section-title {
        margin-top: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
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



<button style="padding: 10px 20px; background-color: red; color: white; border: none; border-radius: 5px;">New
    Member</button>

<div class="main">
    <div class="sidebar">
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
        <!-- Repeat .user-card for more users -->
    </div>
    <div class="content">
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
