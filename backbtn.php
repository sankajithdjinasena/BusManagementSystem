<button class="back-button" id="settingsBtn">Back to Dashboard</button>
<style>
    .back-button {
        position: fixed;
        top: 25px;
        right: 25px;
        background-color: black;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s;
        z-index: 9999;
        display: block;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    document.getElementById("settingsBtn").addEventListener("click", function() {
        window.location.href = "admin_dashboard.php";
    });

    window.addEventListener("scroll", function() {
        const btn = document.getElementById("settingsBtn");
        if (window.scrollY > 100) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    });
</script>