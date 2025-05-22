document.getElementById("ho_ten").addEventListener("blur", function () {
  var value = this.value.trim(); // Loại bỏ khoảng trắng thừa
  var errorMessage = document.getElementById("user_error");

  // Kiểm tra không được bỏ trống
  if (value === "") {
    errorMessage.textContent = "Vui lòng nhập họ tên!";
    this.style.borderColor = "red";
    return;
  }

  // Hàm xử lý viết hoa chữ cái đầu mỗi từ
  function capitalizeWords(input) {
    return input.replace(
      /\b([a-zàáạảãăắằẳẵặâấầẩẫậb-z])(\S*)/gi,
      function (match, firstLetter, rest) {
        return firstLetter.toUpperCase() + rest.toLowerCase();
      }
    );
  }

  var capitalizedValue = capitalizeWords(value);
  const namePattern =
    /^[A-ZÀÁẠẢÃĂẮẰẲẴẶÂẤẦẨẪẬB-CDEFGHIJKLMNOPQRSTUVWXYZ][a-zàáạảãăắằẳẵặâấầẩẫậb-ỹ]+\s+[A-ZÀÁẠẢÃĂẮẰẲẴẶÂẤẦẨẪẬB-CDEFGHIJKLMNOPQRSTUVWXYZ][a-zàáạảãăắằẳẵặâấầẩẫậb-ỹ]+(\s*[A-ZÀÁẠẢÃĂẮẰẲẴẶÂẤẦẨẪẬB-CDEFGHIJKLMNOPQRSTUVWXYZ][a-zàáạảãăắằẳẵặâấầẩẫậb-ỹ]*)*$/;

  if (!namePattern.test(capitalizedValue)) {
    errorMessage.textContent =
      "Họ tên phải có ít nhất 2 từ và không chứa ký tự lạ!";
    this.style.borderColor = "red";
    this.value = "";
  } else {
    errorMessage.textContent = "";
    this.value = capitalizedValue;
    this.style.borderColor = "green";
  }
});

// Kiểm tra Email hoặc Số điện thoại
function validateLoginInput() {
  let input = document.getElementById("emailorsdt").value.trim();
  let errorField = document.getElementById("login_error");

  let emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
  let phonePattern = /^0\d{9,10}$/;

  if (input === "") {
    errorField.textContent = "Vui lòng nhập email hoặc số điện thoại!";
    return false;
  }

  if (!emailPattern.test(input) && !phonePattern.test(input)) {
    errorField.innerHTML =
      "📧 Email phải có <b>@gmail.com</b><br>📱 Số điện thoại phải có <b>10-11 số</b> và bắt đầu bằng <b>0</b>!";
    return false;
  }

  errorField.textContent = "";
  return true;
}

// Kiểm tra Mật khẩu
function validatePassword() {
  let password = document.getElementById("mat_khau").value;
  let errorField = document.getElementById("password_error");
  let errors = [];

  if (password.length < 8) {
    errors.push("Mật khẩu phải có ít nhất 8 ký tự.");
  }
  if (!/[A-Z]/.test(password)) {
    errors.push("Mật khẩu phải chứa ít nhất một chữ in hoa.");
  }
  if (!/[!"£$%^&*]/.test(password)) {
    errors.push('Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!"£$%^&*).');
  }

  if (errors.length > 0) {
    errorField.innerHTML = errors.join("<br>");
    return false;
  }

  errorField.textContent = "";
  return true;
}

// Kiểm tra Form trước khi Submit
function validateForm(event) {
  let isValid = true;

  let hoTen = document.getElementById("ho_ten").value.trim();
  let hoTenError = document.getElementById("user_error");
  if (hoTen === "") {
    hoTenError.textContent = "Vui lòng nhập họ tên!";
    isValid = false;
  } else {
    hoTenError.textContent = "";
  }

  if (!validateLoginInput()) isValid = false;
  if (!validatePassword()) isValid = false;

  let password = document.getElementById("mat_khau").value;
  let confirmPassword = document.getElementById("password_confirm").value;
  let confirmPasswordError = document.getElementById("confirm_password_error");
  if (confirmPassword === "") {
    confirmPasswordError.textContent = "Vui lòng nhập lại mật khẩu!";
    isValid = false;
  } else if (confirmPassword !== password) {
    confirmPasswordError.textContent = "Mật khẩu xác nhận không khớp!";
    isValid = false;
  } else {
    confirmPasswordError.textContent = "";
  }

  if (!isValid) event.preventDefault();
}

// Gán sự kiện cho form
document
  .getElementById("registerForm")
  .addEventListener("submit", validateForm);

document
  .getElementById("registerForm")
  .addEventListener("submit", validateForm);
