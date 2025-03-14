document.addEventListener("DOMContentLoaded", function () {
    let menuItems = document.querySelectorAll(".menu-item > a");

    menuItems.forEach(menu => {
        menu.addEventListener("click", function (e) {
            let submenu = this.nextElementSibling;
            let arrowIcon = this.querySelector(".arrow-icon");

            // Kiểm tra nếu có submenu thì mới chặn click mặc định
            if (submenu && submenu.classList.contains("submenu")) {
                e.preventDefault();

                if (submenu.style.display === "none" || submenu.style.display === "") {
                    submenu.style.display = "block";
                    arrowIcon.classList.remove("fa-chevron-up");
                    arrowIcon.classList.add("fa-chevron-down");

                    // Lưu trạng thái mở vào localStorage
                    localStorage.setItem("menuOpen", this.dataset.menu);
                } else {
                    submenu.style.display = "none";
                    arrowIcon.classList.remove("fa-chevron-down");
                    arrowIcon.classList.add("fa-chevron-up");

                    // Xóa trạng thái khi đóng menu
                    localStorage.removeItem("menuOpen");
                }
            }
        });
    });

    // Kiểm tra nếu menu đã mở trước đó
    let savedMenu = localStorage.getItem("menuOpen");
    if (savedMenu) {
        let activeMenu = document.querySelector(`[data-menu="${savedMenu}"]`).nextElementSibling;
        let activeIcon = document.querySelector(`[data-menu="${savedMenu}"] .arrow-icon`);

        if (activeMenu) {
            activeMenu.style.display = "block";
            activeIcon.classList.remove("fa-chevron-up");
            activeIcon.classList.add("fa-chevron-down");
        }
    }
    window.addEventListener("beforeunload", function () {
        localStorage.removeItem("menuOpen");
    });
});
function openDeleteModal(action) {
    document.getElementById("delete-form").action = action;
    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    myModal.show();
}
