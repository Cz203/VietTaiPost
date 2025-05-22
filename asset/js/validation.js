document.addEventListener("DOMContentLoaded", function () {
  let inputs = document.querySelectorAll(".rangbuoc");

  inputs.forEach(function (input) {
    input.addEventListener("blur", function () {
      validateInput(this);
    });
  });
});

// Hàm kiểm tra từng input
function validateInput(input) {
  let value = input.value.trim();
  let errorMessage = input.nextElementSibling;

  if (!errorMessage || !errorMessage.classList.contains("error_message")) {
    return;
  }

  // Kiểm tra nếu bỏ trống
  if (value === "") {
    errorMessage.textContent = "Vui lòng nhập thông tin!";
    input.style.borderColor = "red";
    return false;
  }

  // Kiểm tra họ tên
  if (input.id.includes("ten")) {
    let namePattern = /^[A-Za-zÀ-ỹ]+(?:\s+[A-Za-zÀ-ỹ]+)*$/;

    if (!namePattern.test(value)) {
      errorMessage.textContent =
        "Họ tên phải có ít nhất 1 từ và không được dùng số!";
      input.style.borderColor = "red";
      return false;
    }
  }

  // Kiểm tra số điện thoại
  if (input.id.includes("sdt")) {
    let phonePattern = /^0\d{9,10}$/;
    if (!phonePattern.test(value)) {
      errorMessage.innerHTML =
        "📱 Số điện thoại phải có <b>10-11 số</b> và bắt đầu bằng <b>0</b>!";
      input.style.borderColor = "red";
      return false;
    }
  }

  // Kiểm tra địa chỉ (phải có số nhà + tên đường)
  if (input.id.includes("diachi")) {
    let addressPattern = /\d+\s+\D+/;
    if (!addressPattern.test(value)) {
      errorMessage.textContent = "Địa chỉ phải gồm số nhà và tên đường!";
      input.style.borderColor = "red";
      return false;
    }
  }

  // Nếu hợp lệ
  errorMessage.textContent = "";
  input.style.borderColor = "green";
  return true;
}

// Kiểm tra toàn bộ form trước khi gửi
function validateForm() {
  let isValid = true;
  let inputs = document.querySelectorAll(".rangbuoc");

  inputs.forEach(function (input) {
    if (!validateInput(input)) {
      isValid = false;
    }
  });

  // Kiểm tra không trùng tên
  let tenGui = document
    .getElementById("ten_nguoigui")
    .value.trim()
    .toLowerCase();
  let tenNhan = document
    .getElementById("ten_nguoinhan")
    .value.trim()
    .toLowerCase();
  if (tenGui === tenNhan) {
    document.getElementById("ten_nguoinhan").nextElementSibling.textContent =
      "Tên người gửi và người nhận không được trùng!";
    document.getElementById("ten_nguoinhan").style.borderColor = "red";
    isValid = false;
  }

  // Kiểm tra không trùng số điện thoại
  let sdtGui = document.getElementById("sdt_nguoigui").value.trim();
  let sdtNhan = document.getElementById("sdt_nguoinhan").value.trim();
  if (sdtGui === sdtNhan) {
    document.getElementById("sdt_nguoinhan").nextElementSibling.textContent =
      "Số điện thoại người gửi và người nhận không được trùng!";
    document.getElementById("sdt_nguoinhan").style.borderColor = "red";
    isValid = false;
  }

  let diachiGui = document
    .getElementById("diachi_nguoigui")
    .value.trim()
    .toLowerCase();
  let diachiNhan = document
    .getElementById("diachi_nguoinhan")
    .value.trim()
    .toLowerCase();
  if (diachiGui === diachiNhan) {
    document.getElementById("diachi_nguoinhan").nextElementSibling.textContent =
      "Địa chỉ người gửi và nhận không được trùng!";
    document.getElementById("diachi_nguoinhan").style.borderColor = "red";
    isValid = false;
  }

  return isValid; // Nếu có lỗi, form không gửi đi
}
