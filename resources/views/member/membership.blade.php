@extends('layouts.member.master')
@section('ribbon')
        <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">Membership</h1>
                <button class="dashboard-btn">GO TO DASHBOARD</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <ul class="tab-items">
                <li class="tab-item">
                    <a href="#" class="tab-link active" id="profileTab">
                        <span class="tab-indicator"></span>
                        PAYMENT
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#" class="tab-link" id="paymentTab">
                        <span class="tab-indicator"></span>
                        STATUS
                    </a>
                </li>
            </ul>
        </div>
    </nav>
@endsection
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/member/membership.css') }}">
    <div class="container">
        <div class="main-grid">
            <!-- Main Content -->
            <div>
                <!-- Profile Section (default visible) -->
                <div id="profileSection">
                    <div class="card">
                        <div class="card-header">
                            <h4>Your Profile</h4>
                        </div>
                        <div class="card-body">
                                                <!-- Payment Form Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Avail Membership</h4>
                        </div>

                        <div class="card-body">
                            <!-- Success Alert -->
                            <div class="alert alert-success" style="display: none;" id="successAlert">
                                <i class="fas fa-check-circle"></i>
                                <span>Payment submitted successfully! We'll review it within 24-48 hours.</span>
                            </div>

                            <!-- Error Alert -->
                            <div class="alert alert-danger" style="display: none;" id="errorAlert">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>There was an error processing your request. Please try again.</span>
                            </div>

                            <!-- Instructions -->
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Payment Instructions</h5>
                                <p>Please follow these steps to complete your membership payment:</p>
                                <ol>
                                    <li>Select your desired membership level</li>
                                    <li>Make a payment to our account: <strong>Bank Name - Account #12345678</strong></li>
                                    <li>Take a screenshot of your payment confirmation</li>
                                    <li>Upload the screenshot and provide the reference number (if available)</li>
                                    <li>Submit your payment for verification</li>
                                </ol>
                                <p>Your membership will be activated once our team verifies your payment.</p>
                            </div>

                            <!-- Payment Form -->
                            <form id="paymentForm" class="mt-4" action="{{ route('manual-payments.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="access_level_id" class="form-label">
                                        Select Membership Level <span class="required">*</span>
                                    </label>
                                    <select id="access_level_id" name="access_level_id" class="form-control" required>
                                        {{-- <option value="">-- Select Membership Level --</option> --}}
                                        @foreach ($accessLevels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }} -
                                                ₱{{ number_format($level->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="access_level_error"></div>
                                </div>

                                <div class="form-group">
                                    <label for="reference_number" class="form-label">Reference/Transaction Number</label>
                                    <input type="text" class="form-control" id="reference_number" name="reference_number"
                                        placeholder="Enter payment reference or transaction number">
                                    <div class="invalid-feedback" id="reference_error"></div>
                                    <div class="form-text">If available, provide the reference number from your payment
                                        transaction</div>
                                </div>

                                <div class="form-group">
                                    <label for="screenshot" class="form-label">
                                        Payment Screenshot <span class="required">*</span>
                                    </label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="file-upload-input" id="screenshot" name="screenshot"
                                            accept="image/*" required>
                                        <label for="screenshot" class="file-upload-label">
                                            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                            <div class="file-upload-text">
                                                <strong>Click to upload</strong> or drag and drop<br>
                                                <small>PNG, JPG, GIF up to 10MB</small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="invalid-feedback" id="screenshot_error"></div>
                                    <div class="form-text">Please upload a clear screenshot of your payment confirmation
                                    </div>
                                </div>

                                <div class="image-preview" id="imagePreview" style="display: none;">
                                    <img id="screenshotPreview" alt="Screenshot Preview">
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-paper-plane"></i>
                                    Submit Payment for Verification
                                </button>
                            </form>
                        </div>

                        <div class="card-footer">
                            <span class="text-muted">
                                <i class="fas fa-clock"></i>
                                Your payment will be reviewed within 24-48 hours
                            </span>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <!-- Payment Section (hidden by default) -->
                <div id="paymentSection" style="display:none;">


                    <!-- Payment History Card -->
                    <div class="card" style="margin-top: 30px;">
                        <div class="card-header">
                            <h4><i class="fas fa-history"></i> Your Payment History</h4>
                        </div>
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Membership</th>
                                        <th>Reference</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="paymentHistory">
                                    @forelse($userPayments as $payment)
                                        <tr>
                                            <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                            <td>{{ $payment->accessLevel->name ?? '-' }}</td>
                                            <td>{{ $payment->reference_number ?? '-' }}</td>
                                            <td>
                                                @if ($payment->status === 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($payment->status === 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary view-payment"
                                                    data-payment-id="{{ $payment->id }}"
                                                    data-payment='@json($payment)'>
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No payment history found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <div class="card sidebar-card">
                    <div class="card-header">
                        <h5><i class="fas fa-star"></i> Membership Benefits</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $benefits = [
                                'Student' => [
                                'Access to educational resources',
                                'Student-focused workshops',
                                'Mentorship programs',
                                'Internship opportunities',
                                'Portfolio development support',
                                'Career guidance sessions'
                                ],
                                'Professional' => [
                                    'Full access to all events',
                                    'Professional certification',
                                    'Networking opportunities',
                                    'Industry recognition',
                                    'Research collaboration',
                                    'Speaking opportunities',
                                ],

                            ];
                        @endphp
                        @foreach ($accessLevels as $level)
                            <div class="membership-level">
                                <h5>
                                    {{ $level->name }}
                                    <span
                                        class="price-badge">₱{{ number_format($level->price, 2) }}/{{ $level->duration_days >= 30 ? 'month' : $level->duration_days . ' days' }}</span>
                                </h5>
                                <ul class="benefits-list">
                                    @foreach ($benefits[$level->name] ?? [] as $benefit)
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            <span>{{ $benefit }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i>
                            Need help with your payment? Contact our support team at
                            <a href="mailto:support@example.com"
                                style="color: white; text-decoration: underline;">support@example.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Details Modal -->
    <div class="modal" id="paymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i class="fas fa-receipt"></i> Payment Details</h5>
                <button type="button" class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <div>
                        <h6 style="margin-bottom: 16px; color: #374151; font-weight: 600;">Payment Information</h6>
                        <table style="width: 100%; font-size: 0.9rem;">
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <th style="padding: 8px 0; text-align: left; color: #6b7280;">Membership:</th>
                                <td style="padding: 8px 0;" id="modal-membership"></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <th style="padding: 8px 0; text-align: left; color: #6b7280;">Reference:</th>
                                <td style="padding: 8px 0;" id="modal-reference"></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <th style="padding: 8px 0; text-align: left; color: #6b7280;">Date:</th>
                                <td style="padding: 8px 0;" id="modal-date"></td>
                            </tr>
                            <tr>
                                <th style="padding: 8px 0; text-align: left; color: #6b7280;">Status:</th>
                                <td style="padding: 8px 0;" id="modal-status"></td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <h6 style="margin-bottom: 16px; color: #374151; font-weight: 600;">Payment Screenshot</h6>
                        <img id="modal-screenshot" src="/placeholder.svg?height=200&width=300"
                            style="width: 100%; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);"
                            alt="Payment Screenshot">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        // File upload preview
        document.getElementById('screenshot').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                const preview = document.getElementById('screenshotPreview');
                const previewContainer = document.getElementById('imagePreview');

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }

                reader.readAsDataURL(file);

                // Update file upload label
                const label = document.querySelector('.file-upload-label');
                label.innerHTML = `
                    <i class="fas fa-check-circle file-upload-icon" style="color: #10b981;"></i>
                    <div class="file-upload-text">
                        <strong>${file.name}</strong><br>
                        <small>File uploaded successfully</small>
                    </div>
                `;
            }
        });

        // Form submission
        // document.getElementById('paymentForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     const submitBtn = document.getElementById('submitBtn');
        //     const originalText = submitBtn.innerHTML;

        //     // Show loading state
        //     submitBtn.innerHTML = '<span class="spinner"></span> Processing...';
        //     submitBtn.disabled = true;

        //     // Simulate form submission
        //     setTimeout(() => {
        //         // Show success message
        //         document.getElementById('successAlert').style.display = 'block';

        //         // Reset form
        //         this.reset();
        //         document.getElementById('imagePreview').style.display = 'none';

        //         // Reset file upload label
        //         const label = document.querySelector('.file-upload-label');
        //         label.innerHTML = `
        //             <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
        //             <div class="file-upload-text">
        //                 <strong>Click to upload</strong> or drag and drop<br>
        //                 <small>PNG, JPG, GIF up to 10MB</small>
        //             </div>
        //         `;

        //         // Reset button
        //         submitBtn.innerHTML = originalText;
        //         submitBtn.disabled = false;

        //         // Scroll to top
        //         window.scrollTo({
        //             top: 0,
        //             behavior: 'smooth'
        //         });
        //     }, 2000);
        // });

        // Modal functionality
        document.querySelectorAll('.view-payment').forEach(button => {
            button.addEventListener('click', function() {
                const payment = JSON.parse(this.getAttribute('data-payment'));
                document.getElementById('modal-membership').textContent = payment.access_level ? payment
                    .access_level.name : '-';
                document.getElementById('modal-reference').textContent = payment.reference_number || '-';
                document.getElementById('modal-date').textContent = new Date(payment.created_at)
                    .toLocaleDateString();
                let statusHtml = '';
                if (payment.status === 'pending') statusHtml =
                    '<span class="badge badge-warning">Pending</span>';
                else if (payment.status === 'approved') statusHtml =
                    '<span class="badge badge-success">Approved</span>';
                else statusHtml = '<span class="badge badge-danger">Rejected</span>';
                document.getElementById('modal-status').innerHTML = statusHtml;
                document.getElementById('modal-screenshot').src = payment.screenshot_path ? '/storage/' +
                    payment.screenshot_path : '/placeholder.svg?height=200&width=300';
                document.getElementById('paymentModal').classList.add('show');
            });
        });

        function closeModal() {
            document.getElementById('paymentModal').classList.remove('show');
        }

        // Close modal when clicking outside
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Drag and drop functionality
        const fileUploadLabel = document.querySelector('.file-upload-label');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            fileUploadLabel.style.borderColor = '#ed1c24';
            fileUploadLabel.style.background = '#fff0f0';
        }

        function unhighlight(e) {
            fileUploadLabel.style.borderColor = '#e0e0e0';
            fileUploadLabel.style.background = '#fafbfc';
        }

        fileUploadLabel.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            document.getElementById('screenshot').files = files;

            // Trigger change event
            const event = new Event('change', {
                bubbles: true
            });
            document.getElementById('screenshot').dispatchEvent(event);
        }

        // Tab switching logic
        document.getElementById('profileTab').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('profileSection').style.display = '';
            document.getElementById('paymentSection').style.display = 'none';
            this.classList.add('active');
            document.getElementById('paymentTab').classList.remove('active');
        });
        document.getElementById('paymentTab').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('profileSection').style.display = 'none';
            document.getElementById('paymentSection').style.display = '';
            this.classList.add('active');
            document.getElementById('profileTab').classList.remove('active');
        });
    </script>
@endsection
