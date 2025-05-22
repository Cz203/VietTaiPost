// Kiểm tra khi submit form
function validateLoginForm(event) {
  let isValid = true;

  // Kiểm tra Email/Số điện thoại
  let emailOrPhone = document.getElementById("emailorsdt").value.trim();
  let emailOrPhoneError = document.getElementById("emailorsdt_error");
  if (emailOrPhone === "") {
    emailOrPhoneError.textContent = "Vui lòng nhập Email hoặc Số điện thoại!";
    isValid = false;
  } else {
    emailOrPhoneError.textContent = "";
  }

  // Kiểm tra Mật khẩu
  let password = document.getElementById("mat_khau").value.trim();
  let passwordError = document.getElementById("mat_khau_error");
  if (password === "") {
    passwordError.textContent = "Vui lòng nhập Mật khẩu!";
    isValid = false;
  } else {
    passwordError.textContent = "";
  }

  // Nếu có lỗi, chặn form submit
  if (!isValid) {
    event.preventDefault();
  }
}

// Xóa lỗi khi nhập lại
document.getElementById("emailorsdt").addEventListener("input", function () {
  document.getElementById("emailorsdt_error").textContent = "";
});

document.getElementById("mat_khau").addEventListener("input", function () {
  document.getElementById("mat_khau_error").textContent = "";
});

// Gán sự kiện khi nhấn nút submit
document
  .getElementById("loginForm")
  .addEventListener("submit", validateLoginForm);
