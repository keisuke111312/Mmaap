<link rel="stylesheet" href="{{ asset('css/admin/resource-modal.css') }}">
<form action="{{ route('store.resources') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="add-resources" class="modal-overlay hidden">
        <div id="add-form" class="add-form-card">

            <div class="form-header">
                <h3 class="form-title">Add New Resource</h3>
            </div>
            <div class="form-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" id="new-title" class="form-input"
                            placeholder="Enter resource title">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category *</label>
                        <select id="new-category" name="category" class="form-input">
                            <option value="">Select category</option>
                            <option value="Article">Article</option>
                            <option value="Tutorial">Tutorial</option>
                            <option value="Research">Research</option>
                            <option value="Guide">Guide</option>
                            <option value="Case Study">Case Study</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Author *</label>
                        <input type="text" name="author" id="new-author" class="form-input"
                            placeholder="Enter author name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tags</label>
                        <input type="text" name="tags" id="new-tags" class="form-input"
                            placeholder="Enter tags (comma separated)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select id="new-status" class="form-input" style="width: 200px;">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea id="new-description" name="description" class="form-textarea" placeholder="Enter resource description"
                        rows="3"></textarea>
                </div>



                <div class="form-group">
                    <label class="form-label">File URL</label>
                    <div class="chips">
                        <div class="chip">
                            <i class="fas fa-file-alt"></i> Uploaded_File.pdf
                            <span style="color: red; margin-left: 5px; cursor: pointer;">Remove</span>
                        </div>
                    </div>
                    <div class="upload-box" id="uploadBox" onclick="triggerFileInput()">
                        <i class="fas fa-cloud-upload-alt"></i><br>
                        You can also upload file here
                        <input type="file" name="file_path" id="file_path" style="display:none;">
                    </div>
                </div>



                <div class="form-actions">
                    <button type="submit" class="btn-primary">Add Resource</button>
                    <button type="button" class="btn-secondary" onclick="closeModal('add-resources')">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</form>
