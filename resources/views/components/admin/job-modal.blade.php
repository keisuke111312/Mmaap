<style>
    /* Admin Container */
    .admin-container {
        max-height: 80vh;
        display: flex;
        flex-direction: column;
    }

    /* Form Styles */
    .job-form {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 3rem;
        box-shadow:
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
    }

    .job-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background-size: 300% 100%;
        animation: gradient 3s ease infinite;
    }



    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.2rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.75rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #e2e8f0, transparent);
    }

    .form-input,
    .form-select,
    .form-textarea {
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        font-weight: 500;
        position: relative;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow:
            0 0 0 4px rgba(102, 126, 234, 0.1),
            0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }

    .form-textarea {
        resize: vertical;
        min-height: 140px;
        font-family: inherit;
    }

    .form-select {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 3rem;
        appearance: none;
    }

    /* Salary Fieldset */
    .salary-fieldset {
        border: 2px solid #e2e8f0;
        padding: 2rem;
        margin: 0;
        background: rgba(248, 250, 252, 0.5);
        position: relative;
        overflow: hidden;
    }

    .salary-fieldset::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        opacity: 0.6;
    }

    .salary-fieldset legend {
        padding: 0 1rem;
        font-weight: 700;
        color: #2d3748;
        background: white;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .salary-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    /* Radio Buttons */
    .radio-group {
        display: flex;
        gap: 1.5rem;
        margin-top: 0.75rem;
    }

    .radio-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 600;
        color: #4a5568;
        transition: color 0.2s;
    }



    .radio-label input[type="radio"] {
        display: none;
    }

    .radio-custom {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid #cbd5e0;
        border-radius: 50%;
        margin-right: 0.75rem;
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
    }

    .radio-label input[type="radio"]:checked+.radio-custom {
        background: #032639;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        transform: scale(1.1);
    }

    .radio-label input[type="radio"]:checked+.radio-custom::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 0.375rem;
        height: 0.375rem;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Checkbox */
    .checkbox-group {
        margin-top: 1rem;
        padding: 1.5rem;
        background: rgba(102, 126, 234, 0.05);
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .checkbox-label {
        display: flex;
        align-items: flex-start;
        cursor: pointer;
        gap: 1rem;
    }

    .checkbox-label input[type="checkbox"] {
        display: none;
    }

    .checkbox-custom {
        width: 1.5rem;
        height: 1.5rem;
        border: 2px solid #cbd5e0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
        margin-top: 0.125rem;
        background: white;
    }

    .checkbox-label input[type="checkbox"]:checked+.checkbox-custom {
        background: #032639;
        transform: scale(1.05);
    }

    .checkbox-label input[type="checkbox"]:checked+.checkbox-custom::after {
        content: '✓';
        color: white;
        font-size: 1rem;
        font-weight: bold;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .checkbox-text {
        display: flex;
        flex-direction: column;
    }

    .checkbox-text strong {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .checkbox-text small {
        color: #718096;
        font-size: 0.8125rem;
        line-height: 1.4;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-top: 2.5rem;
        border-top: 2px solid #f7fafc;
        position: relative;
    }

    .form-actions::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 2px;
    }

    .btn {
        padding: 1rem 2rem;
        font-weight: 700;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        position: relative;
        overflow: hidden;
        min-width: 140px;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: #032639;
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-secondary {
        background: rgba(248, 250, 252, 0.8);
        backdrop-filter: blur(10px);
    }

    .btn-secondary:hover {
        background: white;
        color: #2d3748;
        border-color: #cbd5e0;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .admin-main {
            padding: 2rem 1rem;
        }

        .header-content {
            padding: 1rem;
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .admin-nav {
            justify-content: center;
        }

        .page-header h2 {
            font-size: 2rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .salary-grid {
            grid-template-columns: 1fr;
        }

        .radio-group {
            flex-direction: column;
            gap: 1rem;
        }

        .job-form {
            padding: 2rem 1.5rem;
        }

        .form-actions {
            flex-direction: column-reverse;
            gap: 1rem;
        }

        .btn {
            width: 100%;
        }
    }

    /* Enhanced Form Validation States */
    .form-input:invalid:not(:focus),
    .form-select:invalid:not(:focus),
    .form-textarea:invalid:not(:focus) {
        border-color: #f56565;
        background-color: rgba(254, 242, 242, 0.5);
    }

    .form-input:valid:not(:focus),
    .form-select:valid:not(:focus),
    .form-textarea:valid:not(:focus) {
        border-color: #48bb78;
        background-color: rgba(240, 253, 244, 0.5);
    }

    /* Loading State */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    .btn:disabled::before {
        display: none;
    }

    /* Success/Error Messages */
    .message {
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
        border-left: 4px solid;
        backdrop-filter: blur(10px);
    }

    .message.success {
        background: rgba(240, 253, 244, 0.9);
        color: #22543d;
        border-left-color: #48bb78;
        box-shadow: 0 4px 12px rgba(72, 187, 120, 0.2);
    }

    .message.error {
        background: rgba(254, 242, 242, 0.9);
        color: #742a2a;
        border-left-color: #f56565;
        box-shadow: 0 4px 12px rgba(245, 101, 101, 0.2);
    }

    /* Smooth Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .job-form {
        animation: fadeInUp 0.6s ease-out;
    }

    .form-group {
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .form-group:nth-child(1) {
        animation-delay: 0.1s;
    }

    .form-group:nth-child(2) {
        animation-delay: 0.2s;
    }

    .form-group:nth-child(3) {
        animation-delay: 0.3s;
    }

    .form-group:nth-child(4) {
        animation-delay: 0.4s;
    }

    .form-group:nth-child(5) {
        animation-delay: 0.5s;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(248, 250, 252, 0.5);
    }

    ::-webkit-scrollbar-thumb {
        background: #032639;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a67d8, #6b46c1);
    }
</style>

<div id="add-job" class="modal-overlay hidden">
    <form class="job-form" id="jobForm" method="POST" action="{{ route('jobs.store') }}">
        @csrf
        <div class="form-grid">
            <!-- Job Title -->
            <div class="form-group full-width">
                <label for="title" class="form-label">Job Title *</label>
                <input type="text" id="title" name="title" class="form-input"
                    placeholder="e.g. Senior Frontend Developer" required>
            </div>

            <!-- Company Name -->
            <div class="form-group">
                <label for="company_name" class="form-label">Company Name *</label>
                <input type="text" id="company_name" name="company_name" class="form-input"
                    placeholder="e.g. Tech Corp Inc." required>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location" class="form-label">Location *</label>
                <input type="text" id="location" name="location" class="form-input"
                    placeholder="e.g. New York, NY or Remote" required>
            </div>

            <!-- Job Type -->
            <div class="form-group">
                <label for="type" class="form-label">Job Type *</label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Select job type</option>
                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="contract">Contract</option>
                    <option value="freelance">Freelance</option>
                </select>
            </div>

            <!-- Posted Date -->
            <div class="form-group">
                <label for="posted_at" class="form-label">Posted Date</label>
                <input type="date" id="posted_at" name="posted_at" class="form-input">
            </div>

            <!-- Job Description -->
            <div class="form-group full-width">
                <label for="description" class="form-label">Job Description *</label>
                <textarea id="description" name="description" class="form-textarea" rows="6"
                    placeholder="Provide a detailed description of the job role, responsibilities, and requirements..." required></textarea>
            </div>

            <!-- Salary Section -->
            <div class="form-group full-width">
                <fieldset class="salary-fieldset">
                    <legend class="form-label">Salary Information</legend>

                    <div class="salary-grid">
                        <div class="form-group">
                            <label for="salary_min" class="form-label">Minimum Salary</label>
                            <input type="number" id="salary_min" name="salary_min" class="form-input"
                                placeholder="50000" min="0">
                        </div>

                        <div class="form-group">
                            <label for="salary_max" class="form-label">Maximum Salary</label>
                            <input type="number" id="salary_max" name="salary_max" class="form-input"
                                placeholder="80000" min="0">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Salary Unit</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="salary_unit" value="annual" checked>
                                    <span class="radio-custom"></span>
                                    Annual
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="salary_unit" value="hourly">
                                    <span class="radio-custom"></span>
                                    Hourly
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <!-- Featured Job -->
            <div class="form-group full-width">
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1">
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-text">
                            <strong>Featured Job</strong>
                            <small>This job will be highlighted and appear at the top of listings</small>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="button" onclick="closeModal('add-job')" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary">Create Job Listing</button>
        </div>
    </form>
</div>
