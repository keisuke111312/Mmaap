<form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data" class="discussion-form">
    @csrf

    <div id="skillModalOverlay" class="modal-overlay hidden">
        <div id="skillModalContent"
            style="padding: 2rem; border-radius: 10px; width: 90%; max-width: 600px; margin:0 auto;">
            <div class="modal" style="position:relative; margin-top:0;">
                <button type="button" onclick="closeSkillModal()"
                    style="position:absolute; top:18px; right:18px; background:none; border:none; font-size:2rem; color:#888; cursor:pointer;">&times;</button>
                <h2>ADD SKILL</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>SKILL NAME</label>
                        <input type="text" name="name" placeholder="e.g. JavaScript" required>
                    </div>
                </div>

                <button type="submit" class="btn">Add Skill</button>
            </div>
        </div>
    </div>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalOverlay = document.getElementById('skillModalOverlay');
        const form = document.querySelector('.discussion-form');

        const addSkillBtn = document.getElementById('addSkillBtn');
        const editSkillBtn = document.getElementById('editSkillBtn');

        if (addSkillBtn) {
            addSkillBtn.addEventListener('click', () => {
                form.reset();
                modalOverlay.classList.remove('hidden');
            });
        }

        if (editSkillBtn) {
            editSkillBtn.addEventListener('click', () => {
                form.name.value = 'Laravel';
                form.level.value = 'Expert';
                modalOverlay.classList.remove('hidden');
            });
        }

        window.closeSkillModal = function () {
            modalOverlay.classList.add('hidden');
        };

        modalOverlay.addEventListener('click', function (e) {
            if (e.target === modalOverlay) {
                modalOverlay.classList.add('hidden');
            }
        });
    });
</script>
