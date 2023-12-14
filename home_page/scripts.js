window.document.getElementById("dropdownNavBar").addEventListener("click", function () {
    document.getElementById("top-nav").style.display = "flex";
    const modal = document.getElementById('top-nav');
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
})
