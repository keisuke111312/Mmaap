<div id="contactModal" class="modal-overlay hidden">
    <div class="modal-content">
        <button class="close-btn" id="closeContactModal">&times;</button>
        <h2>{{$user->fname}} {{$user->lname}}</h2>

        <div class="contact-section">
            <h3>Email</h3>
            <p><a href="mailto:johndoe@example.com">{{$user->email}}</a></p>
        </div>

        <div class="contact-section">
            <h3>Portfolio</h3>
            <p><a href="tel:+1234567890">+1 (234) 567-890</a></p>
        </div>

        <div class="contact-section">
            <h3>Location</h3>
            <p>San Francisco Bay Area</p>
        </div>

        <div class="contact-section">
            <h3>Social Profiles</h3>
            <p>
                <a href="https://linkedin.com/in/johndoe" target="_blank" rel="noopener"
                    style="color:#0a66c2;">LinkedIn</a> &nbsp;|&nbsp;
                <a href="https://twitter.com/johndoe" target="_blank" rel="noopener"
                    style="color:#1DA1F2;">Twitter</a> &nbsp;|&nbsp;
                <a href="https://github.com/johndoe" target="_blank" rel="noopener" style="color:#333;">GitHub</a>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeContactModal');
        const modal = document.getElementById('contactModal');

        openModalBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // Close modal on clicking outside modal content
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }

        });
    });
</script>
<style>
    .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        /* Hidden by default */
        .hidden {
            display: none;
        }

        /* Modal Box */
        .modal-content {
            background: #fff;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            padding: 1.5rem 2rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #202124;
        }

        /* Close Button */
        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #666;
            cursor: pointer;
        }

        /* Headings */
        h2 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-weight: 700;
            font-size: 1.5rem;
        }

        h3 {
            margin-bottom: 0.3rem;
            font-weight: 600;
            font-size: 1rem;
            color: #444;
        }

        /* Contact sections */
        .contact-section {
            margin-bottom: 1rem;
        }

        /* Links style */
        a {
            text-decoration: none;
        }

        /* a:hover {
            text-decoration: underline;
        } */
</style>