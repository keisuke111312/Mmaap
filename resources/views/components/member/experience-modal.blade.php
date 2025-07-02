<form action="{{ route('store.experience') }}" method="POST" enctype="multipart/form-data" class="discussion-form">
    @csrf

    <div id="eventModalOverlay" class="modal-overlay hidden">
        <div id="eventModalContent"
            style="padding: 2rem; border-radius: 10px; width: 90%; max-width: 1200px; margin:0;">
            <div class="modal" style="position:relative; margin-top:0;">
                <button type="button" onclick="closeEventModal()"
                    style="position:absolute; top:18px; right:18px; background:none; border:none; font-size:2rem; color:#888; cursor:pointer;">&times;</button>
                <h2>ADD EXPERIENCE</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>JOB TITLE</label>
                        <input type="text" placeholder="Web Developer" name="title">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>COMPANY</label>
                        <input type="text" name="company" id="company" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="startDate">START DATE</label>
                        <input type="month" name="start_date" id="startDate" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>END DATE</label>
                        <input type="month" name="end_date" id="endDate">
                        <small>Leave blank if currently working</small>
                    </div>
                </div>


                <button type="submit" class="btn">Post Discussion</button>       
            </div>       
        </div>
    </div>
</form>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalOverlay = document.getElementById('eventModalOverlay');
        const modalContent = document.getElementById('eventModalContent');
        const form = document.querySelector('.discussion-form');

        // Assuming you have buttons with these IDs elsewhere on the page
        const addExperienceBtn = document.getElementById('addExperienceBtn');
        const editExperienceBtn = document.getElementById('editExperienceBtn');

        // Open Add Experience Modal
        if (addExperienceBtn) {
            addExperienceBtn.addEventListener('click', () => {
                form.reset();
                modalOverlay.classList.remove('hidden');
            });
        }

        // Open Edit Experience Modal
        if (editExperienceBtn) {
            editExperienceBtn.addEventListener('click', () => {
                form.title.value = 'Senior UI/UX Designer';
                form.company.value = 'Tech Solutions';
                form.start_date.value = '2021-01';
                form.end_date.value = '';
                modalOverlay.classList.remove('hidden');
            });
        }

        // Close Modal when clicking the × button
        window.closeEventModal = function () {
            modalOverlay.classList.add('hidden');
        };

        // Optional: close modal when clicking outside the content
        modalOverlay.addEventListener('click', function (e) {
            if (e.target === modalOverlay) {
                modalOverlay.classList.add('hidden');
            }
        });
    });
</script>