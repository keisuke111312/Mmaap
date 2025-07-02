<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

<style>
    #eventModalOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.32);
        z-index: 10000;
        display: none;
        justify-content: center;
        align-items: center;
    }

    #eventModalOverlay.active {
        display: flex;
    }

    #eventModalContent {
        background: #fff;
        padding: 2rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 1200px;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        border-radius: 8px;
        margin: 2rem auto;
    }

    .modal {
        width: 100%;
        position: relative;
    }

    .modal h2 {
        font-weight: 600;
        margin-bottom: 2rem;
        color: #333;
    }

    .form-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.2rem;
    }

    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 0.4rem;
        font-weight: 500;
        color: #333;
    }

    input,
    select,
    textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-family: inherit;
        width: 100%;
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }

    .note {
        font-size: 13px;
        color: #888;
        margin-top: -8px;
    }

    .error {
        font-size: 13px;
        color: #e74c3c;
    }

    .chips {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 0.5rem;
    }

    .chip {
        background: #eee;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 13px;
    }

    .chip i {
        margin-left: 5px;
        cursor: pointer;
    }

    .upload-box {
        border: 2px dashed #ccc;
        padding: 1.5rem;
        text-align: center;
        color: #888;
        border-radius: 6px;
        margin-top: 1rem;
    }

    .btn {
        background: #032639;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        font-size: 14px;
        margin-top: 1.3rem;
    }

    .btn i {
        margin-left: 5px;
    }

    .right-col {
        flex: 1;
    }

    .close-btn {
        position: absolute;
        top: 18px;
        right: 18px;
        background: none;
        border: none;
        font-size: 2rem;
        color: #888;
        cursor: pointer;
        z-index: 10001;
    }

    .remove-text {
        color: red;
        margin-left: 5px;
        cursor: pointer;
    }
</style>

<form action="{{ route('store.event') }}" method="POST" style="width: 100%;">
    @csrf
    <div id="eventModalOverlay">
        <div id="eventModalContent">
            <button type="button" onclick="closeEventModal()" class="close-btn">&times;</button>
            <h2>CREATE EVENT</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="title">TITLE</label>
                    <input type="text" name="title" id="title" placeholder="Art Exhibitions" required />
                </div>
                <div class="form-group right-col">
                    <label for="type">CATEGORY</label>
                    <select name="type" id="type" required >
                        <option value="">-- Select Category --</option>
                        <option value="Workshops">Workshops</option>
                        <option value="Exhibitions">Exhibitions</option>
                        <option value="Conventions">Conventions</option>
                        <option value="Performances">Performances</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="description">DESCRIPTION</label>
                    <textarea name="description" id="description" placeholder="Description here" required ></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">DAY</label>
                    <input type="date" id="start_display">
                </div>
                <div class="form-group">
                    <label for="start_time">START TIME</label>
                    <select name="start_time" id="start_time" >
                        <option value="10:00:00">10:00</option>
                        <option value="11:00:00">11:00</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">1:00</option>
                        <option value="14:00:00">2:00</option>
                        <option value="15:00:00">3:00</option>
                        <option value="16:00:00">4:00</option>
                        <option value="17:00:00">5:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_ampm">AM/PM</label>
                    <select name="start_ampm" id="start_ampm">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>DURATION (Hours)</label>
                    <select id="duration_hours">
                        <option value="0">0 hr</option>
                        <option value="1">1 hr</option>
                        <option value="2">2 hr</option>
                        <option value="3">3 hr</option>
                        <option value="4">4 hr</option>
                        <option value="5">5 hr</option>
                        <option value="6">6 hr</option>
                        <option value="7">7 hr</option>
                        <option value="8">8 hr</option>
                        <option value="9">9 hr</option>
                        <option value="10">10 hr</option>
                        <option value="11">11 hr</option>
                        <option value="12">12 hr</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>DURATION (Minutes)</label>
                    <select id="duration_minutes_extra">
                        <option value="0">0 min</option>
                        <option value="15">15 min</option>
                        <option value="30">30 min</option>
                        <option value="45">45 min</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="duration" id="duration_minutes_final">
            <input type="hidden" name="start" id="start_hidden">
            <input type="hidden" name="end" id="end_hidden">

            <div class="form-row">
                <div class="form-group">
                    <label for="location">LOCATION</label>
                    <input type="text" name="location" id="location" value="New York City" />
                </div>
                <div class="form-group right-col">
                    <label for="reminder">SET REMINDER</label>
                    <select name="reminder" id="reminder">
                        <option value="2 hours before event">2 hour before event</option>
                    </select>
                    <button class="btn" type="submit">CREATE EVENT</button>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>UPLOAD IMAGE</label>
                    <div class="chips">
                        <div class="chip">
                            <i class="fas fa-file-alt"></i> Image_File
                            <span style="color: red; margin-left: 5px; cursor: pointer;">Remove</span>
                        </div>
                    </div>
                    <div class="upload-box" id="uploadBox" onclick="triggerFileInput()">
                        <i class="fas fa-cloud-upload-alt"></i><br>
                        You can also upload file here
                        <input type="file" name="image_path" id="file_path" style="display:none;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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
</script>

<script>
    if (!window.hasInitializedDurationScript) {
        const hoursSelect = document.getElementById('duration_hours');
        const minutesSelect = document.getElementById('duration_minutes_extra');
        const durationFinal = document.getElementById('duration_minutes_final');

        function updateDuration() {
            const hours = parseInt(hoursSelect.value) || 0;
            const minutes = parseInt(minutesSelect.value) || 0;
            durationFinal.value = (hours * 60) + minutes;
        }

        hoursSelect.addEventListener('change', updateDuration);
        minutesSelect.addEventListener('change', updateDuration);

        updateDuration();

        window.hasInitializedDurationScript = true;
    }
</script>
