<form action="{{ route('store.education') }}" method="POST" enctype="multipart/form-data" class="discussion-form">
    @csrf

    <div id="educationModalOverlay" class="modal-overlay hidden">
        <div id="educationModalContent"
            style="padding: 2rem; border-radius: 10px; width: 90%; max-width: 1200px; margin:0;">
            <div class="modal" style="position:relative; margin-top:0;">
                <button type="button" onclick="closeEducationModal()"
                    style="position:absolute; top:18px; right:18px; background:none; border:none; font-size:2rem; color:#888; cursor:pointer;">&times;</button>
                <h2>ADD EDUCATION</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>DEGREE</label>
                        <input type="text" placeholder="Bachelor's" name="degree">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>SCHOOL</label>
                        <input type="text" name="school" id="school" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>FIELD OF STUDY</label>
                        <input type="text" name="field_of_study" placeholder="e.g., Information Technology">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="startDate">START DATE</label>
                        <input type="month" name="start_date" id="startDate">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>END DATE</label>
                        <input type="month" name="end_date" id="endDate">
                        <small>Leave blank if currently studying</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>GRADE</label>
                        <input type="text" name="grade" placeholder="e.g., 3.8 GPA">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>DESCRIPTION</label>
                        <textarea name="description" placeholder="Courses, activities, honors, etc." rows="4"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn">Post Education</button>
            </div>
        </div>
    </div>
</form>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalOverlay = document.getElementById('educationModalOverlay');
        const form = document.querySelector('.discussion-form');

        const addEducationBtn = document.getElementById('addEducationBtn');
        const editEducationBtn = document.getElementById('editEducationBtn');

        if (addEducationBtn) {
            addEducationBtn.addEventListener('click', () => {
                form.reset();
                modalOverlay.classList.remove('hidden');
            });
        }

        if (editEducationBtn) {
            editEducationBtn.addEventListener('click', () => {
                form.degree.value = 'Bachelor of Science';
                form.school.value = 'University of XYZ';
                form.start_date.value = '2020-08';
                form.end_date.value = '';
                modalOverlay.classList.remove('hidden');
            });
        }

        window.closeEducationModal = function () {
            modalOverlay.classList.add('hidden');
        };

        modalOverlay.addEventListener('click', function (e) {
            if (e.target === modalOverlay) {
                modalOverlay.classList.add('hidden');
            }
        });
    });
</script>
