//toast thông báo tạo đơn thành công
document.addEventListener("DOMContentLoaded", function () {
  // Xử lý toast thành công
  var successToastEl = document.getElementById("successToast");
  if (successToastEl) {
    var toastSuccess = new bootstrap.Toast(successToastEl, {
      autohide: false,
    });
    toastSuccess.show();
    if (window.location.search.includes("success=1")) {
      var newUrl = window.location.origin + window.location.pathname;
      window.history.replaceState({}, document.title, newUrl);
    }
    // Cập nhật thanh progress
    var progressBar = successToastEl.querySelector(".progress-bar");
    var totalDuration = 3000; // 2 giây
    var interval = 20; // cập nhật mỗi 20ms
    var width = 100;
    var decrement = 100 / (totalDuration / interval); // Giảm dần chính xác theo thời gian

    var timer = setInterval(function () {
      width -= decrement;
      if (width <= 0) {
        width = 0;
        clearInterval(timer);
        toastSuccess.hide(); // Ẩn toast khi progress về 0%
      }
      progressBar.style.width = width + "%";
    }, interval);
  }
});

//toast thông báo lỗi điền đầy đủ form
document.addEventListener("DOMContentLoaded", function () {
  var form = document.querySelector("form"); // Lấy form
  var errorToastEl = document.getElementById("errorToast"); // Lấy phần tử Toast

  if (!errorToastEl) return; // Nếu không có Toast, dừng script

  var errorToast = new bootstrap.Toast(errorToastEl, {
    autohide: false, // Không tự động ẩn
  });

  form.addEventListener("submit", function (event) {
    var isValid = true;

    // Danh sách các trường bắt buộc
    var requiredFields = [
      "ten_donhang",
      "ten_nguoigui",
      "sdt_nguoigui",
      "diachi_nguoigui",
      "ten_nguoinhan",
      "sdt_nguoinhan",
      "diachi_nguoinhan",
      "khoiluong",
      "wards_sender",
      "districts_sender",
      "provinces_sender",
      "wards_receiver",
      "districts_receiver",
      "provinces_receiver",
      "chieudai",
      "chieurong",
      "chieucao",
    ];

    // Kiểm tra radio button (Loại đơn hàng)
    var radioChecked = document.querySelector(
      'input[name="loai_donhang"]:checked'
    );
    if (!radioChecked) {
      isValid = false;
    }

    // Kiểm tra từng trường nhập
    requiredFields.forEach(function (field) {
      var input = document.getElementById(field);
      if (!input || !input.value.trim()) {
        isValid = false;
        if (input) input.classList.add("is-invalid"); // Viền đỏ nếu thiếu
      } else {
        if (input) input.classList.remove("is-invalid"); // Xóa viền đỏ nếu nhập lại
      }
    });

    // Nếu có lỗi, hiển thị Toast và ngăn form gửi đi
    if (!isValid) {
      event.preventDefault(); // Ngăn form gửi đi
      errorToast.show(); // Hiển thị Toast lỗi

      // Ẩn Toast sau 3 giây
      setTimeout(() => {
        errorToast.hide();
      }, 3000);
    }
  });
});
