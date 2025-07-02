<form action="{{ route('store.resources') }}" method="POST">
    @csrf
    <div id="eventModalOverlay"
        style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.32); z-index: 10000; overflow: auto; justify-content: center; align-items: center;">

        <div class="modal" style="position:relative; margin-top:40px;">
            <button type="button" onclick="closeEventModal()"
                style="position:absolute; top:18px; right:18px; background:none; border:none; font-size:2rem; color:#888; cursor:pointer;">
                &times;
            </button>

            <h2>UPLOAD RESOURCES</h2>

            <div class="form-row">
                <div class="form-group">
                    <label>TITLE</label>
                    <input type="text" name="title" placeholder="Introduction to ArtMedium">
                </div>

                <div class="form-group right-col">
                    <label>TYPE</label>
                    <input type="text" name="type" placeholder="Research, Article, Tutorial">

                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>AUTHOR</label>
                    <input type="text" name="author" placeholder="Name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>DESCRIPTION</label>
                    <textarea name="description" placeholder="Description here"></textarea>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group">
                    <label>UPLOAD FILE</label>
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
            </div>

            <div class="form-row">
                <div class="form-group right-col">
                    <button type="button" class="btn" style="margin-top: 1.3rem;">UPLOAD</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
{{-- 
<script>

    // ADD SPONSORS CHIP
    const sponsorInput = document.querySelector('input[placeholder="Search people"]');
    const sponsorChips = sponsorInput.nextElementSibling;

    sponsorInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim() !== '') {
            e.preventDefault();
            const chip = createChip(this.value.trim());
            sponsorChips.appendChild(chip);
            this.value = '';
        }
    });

    // REMOVE CHIP
    sponsorChips.addEventListener('click', function(e) {
        if (e.target.classList.contains('fa-times')) {
            e.target.closest('.chip').remove();
        }
    });

    // CREATE CHIP ELEMENT
    function createChip(label) {
        const div = document.createElement('div');
        div.className = 'chip';
        div.innerHTML = `${label} <i class="fas fa-times"></i>`;
        return div;
    }

    // REMOVE IMAGE
    document.querySelectorAll('.chip span').forEach(span => {
        span.addEventListener('click', function() {
            this.closest('.chip').remove();
        });
    });

    window.closeResourcesModal = function() {
        document.getElementById('eventModalOverlay').style.display = 'none';
    };
</script>


<script>
    function triggerFileInput() {
        document.getElementById('file_path').click();
    }

    document.getElementById('file_path').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const chipsContainer = document.querySelector('.chips');

        // Clear previous chip
        chipsContainer.innerHTML = '';

        if (file) {
            const chip = document.createElement('div');
            chip.classList.add('chip');
            chip.innerHTML = `
                <i class="fas fa-file-alt"></i> ${file.name} 
                <span style="color: red; margin-left: 5px; cursor: pointer;" onclick="removeFile()">Remove</span>
            `;
            chipsContainer.appendChild(chip);
        }
    });

    function removeFile() {
        const fileInput = document.getElementById('file_path');
        fileInput.value = ''; // Clear the file input
        document.querySelector('.chips').innerHTML = ''; // Remove the chip
    }
</script> --}}

