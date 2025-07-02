@extends('layouts.admin.master')

@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">USER MANAGEMENT</h1>
                <div>
                <a href="{{route('admin.official')}}" class="dashboard-btn">GO TO OFFICIALS</a>
                <a href="{{route('admin.partner')}}" class="dashboard-btn">GO TO INDUSTRY</a>
                
                </div>

            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <div class="filters-section">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select class="filter-control" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Membership Level</label>
                        <select class="filter-control" id="membershipFilter">
                            <option value="">All Levels</option>
                            <option value="basic">Student</option>
                            <option value="premium">Professional</option>
                            <option value="enterprise">Enterprise</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Date From</label>
                        <input type="date" class="filter-control" id="dateFromFilter">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Date To</label>
                        <input type="date" class="filter-control" id="dateToFilter">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" class="filter-control" id="searchFilter"
                            placeholder="User name, email, reference...">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">&nbsp;</label>
                        <button class="btn btn-secondary" onclick="applyFilters()">
                            <i class="fas fa-search"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/payment.css') }}">


    <div class="payment-container">
        <!-- Dashboard Statistics -->
        <div class="dashboard-stats">
            <div class="stat-card stat-pending">
                <div class="stat-number" id="pendingCount">12</div>
                <div class="stat-label">Pending Requests</div>
            </div>
            <div class="stat-card stat-approved">
                <div class="stat-number" id="approvedCount">45</div>
                <div class="stat-label">Approved Today</div>
            </div>
            <div class="stat-card stat-rejected">
                <div class="stat-number" id="rejectedCount">3</div>
                <div class="stat-label">Rejected Today</div>
            </div>
            <div class="stat-card stat-total">
                <div class="stat-number" id="totalCount">156</div>
                <div class="stat-label">Total Requests</div>
            </div>
        </div>

        <!-- Filters Section -->


        <!-- Payments Table -->
        <div class="payments-table">
            <div class="table-header">
                <h3 class="table-title">Payment Requests</h3>
                <div class="bulk-actions">
                    <button class="btn btn-approve btn-sm" onclick="bulkAction('approve')" id="bulkApprove" disabled>
                        <i class="fas fa-check"></i> Approve Selected
                    </button>
                    <button class="btn btn-reject btn-sm" onclick="bulkAction('reject')" id="bulkReject" disabled>
                        <i class="fas fa-times"></i> Reject Selected
                    </button>
                </div>
            </div>



            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="checkbox-cell">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                            </th>
                            <th>User</th>
                            <th>Membership</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="paymentsTableBody">
                        @foreach ($payments as $payment)
                            @php
                                $paymentData = [
                                    'user' => [
                                        'name' => $payment->user->fname,
                                        'email' => $payment->user->email,
                                        'id' => $payment->user->id,
                                    ],
                                    'membership' => $payment->accessLevel->name,
                                    'amount' => $payment->amount,
                                    'reference' => $payment->reference_number,
                                    'date' => $payment->created_at->toDateString(),
                                    'status' => $payment->status,
                                    'screenshot_path' => $payment->screenshot_path
                                        ? asset('storage/' . $payment->screenshot_path)
                                        : null,
                                ];
                            @endphp
                            <tr data-payment='@json($paymentData)'>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="payment-checkbox" value="{{ $payment->id }}">
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($payment->user->fname, 0, 1)) }}{{ strtoupper(substr($payment->user->lname, 0, 1)) }}
                                        </div>
                                        <div class="user-details">
                                            <h6>{{ $payment->user->fname }} {{ $payment->user->lname }}</h6>
                                            <small>{{ $payment->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="membership-badge membership-{{ strtolower($payment->accessLevel->name) }}">
                                        {{ $payment->accessLevel->name }}
                                    </span>
                                </td>
                                <td><strong>₱{{ number_format($payment->accessLevel->price, 2) }}</strong></td>
                                <td><code>{{ $payment->reference_number }}</code></td>
                                <td>{{ $payment->created_at->format('M d, Y') }}<br><small>{{ $payment->created_at->format('g:i A') }}</small>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $payment->status }}">
                                        @if ($payment->status == 'pending')
                                            <i class="fas fa-clock"></i> Pending
                                        @elseif($payment->status == 'approved')
                                            <i class="fas fa-check"></i> Approved
                                        @else
                                            <i class="fas fa-times"></i> Rejected
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-view btn-sm" onclick="viewPayment({{ $payment->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if ($payment->status == 'pending')
                                            <form action="{{ route('approve.request', $payment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-approve"
                                                    >
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            {{-- <button class="btn btn-approve btn-sm"
                                                onclick="approvePayment({{ $payment->id }})">
                                                <i class="fas fa-check"></i>
                                            </button> --}}
                                            <button class="btn btn-reject btn-sm"
                                                onclick="rejectPayment({{ $payment->id }})">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Pagination -->
        <div class="pagination">
            <script src="https://cdn.tailwindcss.com"></script>
            {{ $payments->links('pagination::tailwind') }}

        </div>
    </div>

    <!-- Payment Details Modal -->
    <div class="payment-modal" id="paymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Payment Request Details</h3>
                <button type="button" class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="payment-details-grid">
                    <div class="detail-section">
                        <h6><i class="fas fa-user"></i> User Information</h6>
                        <div class="detail-row">
                            <span class="detail-label">Name:</span>
                            <span class="detail-value" id="modalUserName">John Doe</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value" id="modalUserEmail">john.doe@email.com</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">User ID:</span>
                            <span class="detail-value" id="modalUserId">#12345</span>
                        </div>

                        <h6 style="margin-top: 25px;"><i class="fas fa-credit-card"></i> Payment Information</h6>
                        <div class="detail-row">
                            <span class="detail-label">Membership:</span>
                            <span class="detail-value" id="modalMembership">Premium</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Amount:</span>
                            <span class="detail-value" id="modalAmount">$59.00</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Reference:</span>
                            <span class="detail-value" id="modalReference">TXN123456</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Submitted:</span>
                            <span class="detail-value" id="modalDate">Dec 15, 2024 at 2:30 PM</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Status:</span>
                            <span class="detail-value" id="modalStatus">
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="detail-section">
                        <h6><i class="fas fa-image"></i> Payment Screenshot</h6>
                        <div class="screenshot-container">
                            <img id="modalScreenshot" src="/placeholder.svg?height=300&width=400"
                                alt="Payment Screenshot">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-approve" onclick="approveFromModal()">
                    <i class="fas fa-check"></i> Approve Payment
                </button>

                <button type="button" class="btn btn-reject" onclick="rejectFromModal()">
                    <i class="fas fa-times"></i> Reject Payment
                </button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        let currentPaymentId = null;
        let currentPage = 1;
        let totalPages = 5;

        function viewPayment(paymentId) {
            currentPaymentId = paymentId;
            // Find the row with the matching paymentId
            const row = document.querySelector(`#paymentsTableBody tr input[value='${paymentId}']`).closest('tr');
            const payment = JSON.parse(row.getAttribute('data-payment'));

            document.getElementById('modalUserName').textContent = payment.user.name;
            document.getElementById('modalUserEmail').textContent = payment.user.email;
            document.getElementById('modalUserId').textContent = '#' + payment.user.id;
            document.getElementById('modalMembership').textContent = payment.membership;
            document.getElementById('modalAmount').textContent = '₱' + payment.accessLevel.price;
            document.getElementById('modalReference').textContent = payment.reference;
            document.getElementById('modalDate').textContent = payment.date;

            // Update status badge
            const statusElement = document.getElementById('modalStatus');
            let statusClass = `status-${payment.status}`;
            let statusIcon = payment.status === 'pending' ? 'clock' : payment.status === 'approved' ? 'check' : 'times';
            let statusText = payment.status.charAt(0).toUpperCase() + payment.status.slice(1);
            statusElement.innerHTML = `
                <span class="status-badge ${statusClass}">
                    <i class="fas fa-${statusIcon}"></i> ${statusText}
                </span>
            `;

            // Update screenshot
            const screenshot = document.getElementById('modalScreenshot');
            if (payment.screenshot_path) {
                screenshot.src = payment.screenshot_path;
                screenshot.alt = 'Payment Screenshot';
            } else {
                screenshot.src = '/placeholder.svg?height=300&width=400';
                screenshot.alt = 'No Screenshot';
            }


            document.getElementById('paymentModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('paymentModal').classList.remove('show');
            currentPaymentId = null;
        }

        function approvePayment(paymentId) {
            if (confirm('Are you sure you want to approve this payment?')) {
                // Show loading state
                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<span class="spinner"></span>';
                btn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Update the status in the table
                    updatePaymentStatus(paymentId, 'approved');

                    // Reset button
                    btn.innerHTML = originalText;
                    btn.disabled = false;

                    // Show success message
                    showNotification('Payment approved successfully!', 'success');
                }, 1000);
            }
        }

        function rejectPayment(paymentId) {
            if (confirm('Are you sure you want to reject this payment?')) {
                // Show loading state
                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<span class="spinner"></span>';
                btn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Update the status in the table
                    updatePaymentStatus(paymentId, 'rejected');

                    // Reset button
                    btn.innerHTML = originalText;
                    btn.disabled = false;

                    // Show success message
                    showNotification('Payment rejected successfully!', 'success');
                }, 1000);
            }
        }

        function approveFromModal() {
            if (currentPaymentId) {
                approvePayment(currentPaymentId);
                closeModal();
            }
        }

        function rejectFromModal() {
            if (currentPaymentId) {
                rejectPayment(currentPaymentId);
                closeModal();
            }
        }

        function updatePaymentStatus(paymentId, newStatus) {
            // Find the row and update the status
            const rows = document.querySelectorAll('#paymentsTableBody tr');
            rows.forEach(row => {
                const checkbox = row.querySelector('.payment-checkbox');
                if (checkbox && checkbox.value == paymentId) {
                    const statusCell = row.querySelector('.status-badge');
                    const actionCell = row.querySelector('.action-buttons');

                    // Update status badge
                    const statusClass = `status-${newStatus}`;
                    const statusIcon = newStatus === 'approved' ? 'check' : 'times';
                    const statusText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);

                    statusCell.className = `status-badge ${statusClass}`;
                    statusCell.innerHTML = `<i class="fas fa-${statusIcon}"></i> ${statusText}`;

                    // Update action buttons (remove approve/reject for processed payments)
                    if (newStatus !== 'pending') {
                        actionCell.innerHTML = `
                            <button class="btn btn-view btn-sm" onclick="viewPayment(${paymentId})">
                                <i class="fas fa-eye"></i>
                            </button>
                        `;
                    }
                }
            });

            // Update statistics
            updateStatistics();
        }

        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.payment-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });

            updateBulkActions();
        }

        function updateBulkActions() {
            const checkedBoxes = document.querySelectorAll('.payment-checkbox:checked');
            const bulkApprove = document.getElementById('bulkApprove');
            const bulkReject = document.getElementById('bulkReject');

            if (checkedBoxes.length > 0) {
                bulkApprove.disabled = false;
                bulkReject.disabled = false;
            } else {
                bulkApprove.disabled = true;
                bulkReject.disabled = true;
            }
        }

        function bulkAction(action) {
            const checkedBoxes = document.querySelectorAll('.payment-checkbox:checked');
            const paymentIds = Array.from(checkedBoxes).map(cb => cb.value);

            if (paymentIds.length === 0) return;

            const actionText = action === 'approve' ? 'approve' : 'reject';
            if (confirm(`Are you sure you want to ${actionText} ${paymentIds.length} payment(s)?`)) {
                // Simulate bulk action
                paymentIds.forEach(id => {
                    updatePaymentStatus(parseInt(id), action === 'approve' ? 'approved' : 'rejected');
                });

                // Clear selections
                document.getElementById('selectAll').checked = false;
                checkedBoxes.forEach(cb => cb.checked = false);
                updateBulkActions();

                showNotification(`${paymentIds.length} payment(s) ${actionText}d successfully!`, 'success');
            }
        }

        function applyFilters() {
            // Get filter values
            const status = document.getElementById('statusFilter').value;
            const membership = document.getElementById('membershipFilter').value;
            const dateFrom = document.getElementById('dateFromFilter').value;
            const dateTo = document.getElementById('dateToFilter').value;
            const search = document.getElementById('searchFilter').value;

            // In a real application, you would send these filters to your backend
            console.log('Applying filters:', {
                status,
                membership,
                dateFrom,
                dateTo,
                search
            });

            // Show loading state
            document.getElementById('paymentsTableBody').classList.add('loading');

            // Simulate API call
            setTimeout(() => {
                document.getElementById('paymentsTableBody').classList.remove('loading');
                showNotification('Filters applied successfully!', 'success');
            }, 1000);
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
                loadPage(currentPage);
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                currentPage++;
                updatePagination();
                loadPage(currentPage);
            }
        }

        function updatePagination() {
            document.getElementById('currentPage').textContent = currentPage;
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages;
        }

        function loadPage(page) {
            // Simulate loading new page data
            console.log('Loading page:', page);
        }

        function updateStatistics() {
            // In a real application, you would fetch these from your backend
            const pending = document.querySelectorAll('.status-pending').length;
            const approved = document.querySelectorAll('.status-approved').length;
            const rejected = document.querySelectorAll('.status-rejected').length;
            const total = pending + approved + rejected;

            document.getElementById('pendingCount').textContent = pending;
            document.getElementById('approvedCount').textContent = approved;
            document.getElementById('rejectedCount').textContent = rejected;
            document.getElementById('totalCount').textContent = total;
        }

        function showNotification(message, type) {
            // Create a simple notification
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                background: ${type === 'success' ? '#28a745' : '#dc3545'};
                color: white;
                border-radius: 4px;
                z-index: 9999;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Add event listeners for checkboxes
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('payment-checkbox')) {
                updateBulkActions();
            }
        });

        // Close modal when clicking outside
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            updatePagination();
            updateStatistics();
        });
    </script>
@endsection
