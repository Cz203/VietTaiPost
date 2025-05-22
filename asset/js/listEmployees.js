function showImage(src) {
  document.getElementById("modalImage").src = src;
  new bootstrap.Modal(document.getElementById("imageModal")).show();
}

// Xử lý hiển thị modal chi tiết nhân viên
document.querySelectorAll(".view-details").forEach((button) => {
  button.addEventListener("click", function () {
    document.getElementById("modalHoTen").value = this.dataset.hoTen;
    document.getElementById("modalEmail").value = this.dataset.email;
    document.getElementById("modalSoDienThoai").value =
      this.dataset.soDienThoai;

    // Xử lý hiển thị ảnh
    const cccdTruoc = document.getElementById("modalCccdTruoc");
    const cccdSau = document.getElementById("modalCccdSau");
    const bangLaiXe = document.getElementById("modalBangLaiXe");
    const giayDkXe = document.getElementById("modalGiayDkXe");

    cccdTruoc.src = this.dataset.cccdTruoc || "";
    cccdSau.src = this.dataset.cccdSau || "";
    bangLaiXe.src = this.dataset.bangLaiXe || "";
    giayDkXe.src = this.dataset.giayDkXe || "";

    // Ẩn các ảnh không có dữ liệu
    cccdTruoc.style.display = this.dataset.cccdTruoc ? "block" : "none";
    cccdSau.style.display = this.dataset.cccdSau ? "block" : "none";
    bangLaiXe.style.display = this.dataset.bangLaiXe ? "block" : "none";
    giayDkXe.style.display = this.dataset.giayDkXe ? "block" : "none";

    // Lưu id_nhanvien vào nút xác nhận khóa
    document.getElementById("confirmLockBtn").dataset.idNhanvien =
      this.dataset.idNhanvien;
  });
});

// Xử lý khóa tài khoản
document
  .getElementById("confirmLockBtn")
  .addEventListener("click", function () {
    const id_nhanvien = this.dataset.idNhanvien;

    // Gửi request khóa tài khoản
    fetch("../../models/admin/listEmployees.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `action=lock_account&id_nhanvien=${id_nhanvien}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(data.message);
          // Đóng modal và tải lại trang
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("confirmLockModal")
          );
          modal.hide();
          window.location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Có lỗi xảy ra khi khóa tài khoản");
      });
  });

// Xử lý xóa tài khoản
document.querySelectorAll(".delete-account").forEach((button) => {
  button.addEventListener("click", function () {
    document.getElementById("deleteEmployeeName").textContent =
      this.dataset.hoTen;
    document.getElementById("confirmDeleteBtn").dataset.idNhanvien =
      this.dataset.idNhanvien;
  });
});

document
  .getElementById("confirmDeleteBtn")
  .addEventListener("click", function () {
    const id_nhanvien = this.dataset.idNhanvien;

    // Gửi request xóa tài khoản
    fetch("../../models/admin/listEmployees.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `action=delete_account&id_nhanvien=${id_nhanvien}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(data.message);
          // Đóng modal và tải lại trang
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("confirmDeleteModal")
          );
          modal.hide();
          window.location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Có lỗi xảy ra khi xóa tài khoản");
      });
  });

function updateStatus() {
  fetch("../../models/admin/listEmployees.php?action=get_status")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        data.employees.forEach((employee) => {
          // Cập nhật trạng thái
          const statusElement = document.getElementById(
            `status-${employee.id_nhanvien}`
          );
          if (statusElement) {
            let statusClass = "";
            switch (employee.trang_thai) {
              case "Đang hoạt động":
                statusClass = "text-success";
                break;
              case "Không hoạt động":
                statusClass = "text-secondary";
                break;
              case "Đã nghỉ":
                statusClass = "text-warning";
                break;
              case "Khóa tài khoản":
                statusClass = "text-danger";
                break;
              default:
                statusClass = "text-secondary";
            }
            statusElement.innerHTML = `<span class="${statusClass}">${employee.trang_thai}</span>`;
          }

          // Cập nhật thời gian đăng nhập
          const lastLoginElement = document.getElementById(
            `last-login-${employee.id_nhanvien}`
          );
          if (lastLoginElement) {
            lastLoginElement.textContent = employee.last_login
              ? new Date(employee.last_login).toLocaleString("vi-VN", {
                  year: "numeric",
                  month: "2-digit",
                  day: "2-digit",
                  hour: "2-digit",
                  minute: "2-digit",
                  second: "2-digit",
                })
              : "Chưa đăng nhập";
          }
        });
      }
    })
    .catch((error) => console.error("Error:", error));
}

// Cập nhật mỗi 5 giây
setInterval(updateStatus, 5000);
// Cập nhật ngay khi trang được tải
document.addEventListener("DOMContentLoaded", updateStatus);
