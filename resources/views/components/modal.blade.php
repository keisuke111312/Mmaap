<style>
    /* Modal background */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    /* Modal box */
    .modal {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .modal h2 {
        margin-top: 0;
    }

    .modal label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
    }

    .modal input,
    .modal textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .modal button {
        margin-top: 20px;
        padding: 10px 16px;
        border: none;
        background-color: #3498db;
        color: white;
        font-weight: bold;
        border-radius: 4px;
        cursor: pointer;
    }

    .modal .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .modal .close-btn:hover {
        color: red;
    }

    /* Show modal when active */
    .modal-overlay.active {
        display: flex;
    }
</style>

<!-- Trigger Button -->
<button onclick="document.getElementById('eventModal').classList.add('active')">
    Create Event
</button>


<div class="modal-overlay" id="eventModal">
    <div class="modal">
        <button class="close-btn"
            onclick="document.getElementById('eventModal').classList.remove('active')">&times;</button>
        <h2>Create Event</h2>
        <form>
            <label for="title">Event Title</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</div>
