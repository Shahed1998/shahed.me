<div class="modals-bg">
    <div class="modals">
        <button class="modals-close-button" onclick="closeModal()">X </button>
        <div class="modals-message">
            <p>Please fill up all the input fields 😀</p>
        </div>
    </div>
</div>
<script>
    function closeModal() {
        const modalBg = document.querySelector(".modals-bg");
        modalBg.classList.remove("bg-active");
    }

    function modalMessage(msg) {
        document.querySelector(".modals-message").innerHTML = "<p>" + msg + "</p>";
        document.querySelector(".modals-bg").classList.add("bg-active");
    }
</script>
