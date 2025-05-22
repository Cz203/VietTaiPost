// Đợi cho đến khi toàn bộ trang tải xong mới thực thi code
document.addEventListener("DOMContentLoaded", function () {
  // Lấy các tham số từ URL
  const params = new URLSearchParams(window.location.search);

  // Xác định tab đang được chọn, ưu tiên theo thứ tự:
  // 1. Lấy từ URL (?tab=xxx)
  // 2. Lấy từ localStorage (lưu lại lần chọn trước)
  // 3. Nếu không có thì mặc định là "userInfo"
  const activeTab =
    params.get("tab") || localStorage.getItem("activeTab") || "userInfo";

  // Đối tượng chứa các phần nội dung (các tab) trong giao diện
  const sections = {
    senderInfo: document.getElementById("senderInfoSettings"), // Thông tin người gửi
    userInfo: document.getElementById("userInfoSection"), // Thông tin tài khoản
    transactionHistory: document.getElementById("transactionHistory"), // Lịch sử giao dịch
  };

  // Đối tượng chứa các nút bấm điều hướng giữa các tab
  const buttons = {
    senderInfo: document.getElementById("toggleSenderInfo"), // Nút "Cài đặt thông tin người gửi"
    userInfo: document.getElementById("toggleUserInfo"), // Nút "Thông tin tài khoản"
    transactionHistory: document.getElementById("toggleTransactionHistory"), // Nút "Đổi mật khẩu"
  };

  // Hàm hiển thị tab được chọn và ẩn tất cả tab khác
  function showActiveTab(tab) {
    // Ẩn tất cả nội dung của các tab
    Object.values(sections).forEach(
      (section) => (section.style.display = "none")
    );

    // Xóa class "active-tab" khỏi tất cả các nút bấm
    Object.values(buttons).forEach((btn) => btn.classList.remove("active-tab"));

    // Nếu tab hợp lệ (tồn tại trong sections và buttons)
    if (sections[tab] && buttons[tab]) {
      sections[tab].style.display = "block"; // Hiển thị tab đang chọn
      buttons[tab].classList.add("active-tab"); // Đánh dấu tab đang chọn là "active"
      localStorage.setItem("activeTab", tab); // Lưu tab đang chọn vào localStorage
    }
  }

  // Thêm sự kiện "click" cho từng nút bấm để thay đổi tab khi nhấn vào
  Object.keys(buttons).forEach((tab) => {
    if (buttons[tab]) {
      buttons[tab].addEventListener("click", function (event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
        showActiveTab(tab); // Hiển thị tab được chọn
      });
    }
  });

  // Nếu có phần tử "manageSenderInfo", thêm sự kiện click để lưu tab "senderInfo" vào localStorage
  if (document.getElementById("manageSenderInfo")) {
    document
      .getElementById("manageSenderInfo")
      .addEventListener("click", function () {
        localStorage.setItem("activeTab", "senderInfo");
      });
  }

  // Hiển thị tab đã lưu hoặc tab mặc định khi trang tải lên
  showActiveTab(activeTab);

  // Nếu URL chứa tham số "?tab=xxx", xóa nó đi để giữ URL sạch hơn
  if (params.has("tab")) {
    window.history.replaceState({}, document.title, window.location.pathname);
  }
});

// duyệt mở tất cả modal
document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".btnAction"); // Lấy tất cả nút có class .btnAction
  const editModal = new bootstrap.Modal(
    document.getElementById("editWarehouse")
  ); // Modal cần mở

  editButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      editModal.show();
    });
  });
});

//ẩn hiện password
function togglePassword(inputId) {
  var input = document.getElementById(inputId);
  var icon = event.currentTarget; // Lấy chính button được click

  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash"); // Đổi icon thành "ẩn"
  } else {
    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye"); // Đổi icon thành "hiện"
  }
}

//mở modal nhập lại mk cho email
document.getElementById("openModalBtn").addEventListener("click", function () {
  var myModal = new bootstrap.Modal(
    document.getElementById("confirmOtpEmailOrPhone")
  );
  myModal.show();
});
//mở modal nhập lại mk cho sdt
document
  .getElementById("openModalBtnSDT")
  .addEventListener("click", function () {
    var myModal = new bootstrap.Modal(document.getElementById("confirmPhone"));
    myModal.show();
  });

// ràng buộc mk mới
function validatePassword() {
  let passwordInput = document.getElementById("newPassword"); // ✅ Thêm dòng này
  let password = passwordInput.value;
  let errorField = document.getElementById("password_error");
  let errors = [];

  if (password.length < 8) {
    errors.push("Mật khẩu phải có ít nhất 8 ký tự.");
  }
  if (!/[A-Z]/.test(password)) {
    errors.push("Mật khẩu phải chứa ít nhất một chữ in hoa.");
  }
  if (!/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]/.test(password)) {
    errors.push("Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!@#$%^&*).");
  }

  if (errors.length > 0) {
    errorField.innerHTML = errors.join("<br>");
    setTimeout(() => passwordInput.focus(), 0); // ✅ Dùng setTimeout để đảm bảo focus hoạt động
    return false;
  }

  errorField.textContent = "";
  return true;
}

function validatePhoneNumber() {
  let phoneInput = document.getElementById("so_dien_thoai");
  let errorSpan = document.getElementById("phoneError");
  let saveButton = document.getElementById("saveSDTBtn");
  let phonePattern = /^0\d{9,10}$/; // Số điện thoại phải có 10-11 số, bắt đầu bằng 0

  if (!phonePattern.test(phoneInput.value.trim())) {
    errorSpan.innerHTML =
      "📱 Số điện thoại phải có <b>10-11 số</b> và bắt đầu bằng <b>0</b>!";
    saveButton.disabled = true; // Vô hiệu hóa nút nếu email không hợp lệ
    return false;
  } else {
    errorSpan.innerHTML = "";
    saveButton.disabled = false;
    return true;
  }
}

function validateGmail() {
  let emailInput = document.getElementById("email");
  let errorSpan = document.getElementById("emailError");
  let saveButton = document.getElementById("saveEmailBtn");
  let emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

  if (!emailPattern.test(emailInput.value.trim())) {
    errorSpan.innerHTML = "📧 Email phải có định dạng <b>@gmail.com</b>!";
    saveButton.disabled = true; // Vô hiệu hóa nút nếu email không hợp lệ
    return false;
  } else {
    errorSpan.innerHTML = "";
    saveButton.disabled = false; // Kích hoạt nút nếu email hợp lệ
    return true;
  }
}
