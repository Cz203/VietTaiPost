const host = "https://provinces.open-api.vn/api/";

// Hàm renderData: nhận mảng dữ liệu và id của dropdown để hiển thị các option
const renderData = (array, selectId) => {
  let placeholder;
  if (selectId.indexOf("provinces") !== -1) {
    placeholder = "Chọn Tỉnh";
  } else if (selectId.indexOf("districts") !== -1) {
    placeholder = "Chọn Huyện";
  } else if (selectId.indexOf("wards") !== -1) {
    placeholder = "Chọn xã/phường";
  } else {
    placeholder = "Chọn";
  }
  let row = `<option value="">${placeholder}</option>`;
  array.forEach((element) => {
    row += `<option value="${element.code}">${element.name}</option>`;
  });
  document.querySelector("#" + selectId).innerHTML = row;
};

// Load danh sách Tỉnh cho cả 2 bộ: người gửi và người nhận
axios
  .get(host + "?depth=1")
  .then((response) => {
    renderData(response.data, "provinces_sender");
    renderData(response.data, "provinces_receiver");
  })
  .catch((error) => console.error("Error loading provinces:", error));

// --- Xử lý cho người gửi ---
$("#provinces_sender").change(() => {
  let provinceVal = $("#provinces_sender").val();
  $("#districts_sender").html('<option value="">Chọn Huyện</option>');
  $("#wards_sender").html('<option value="">Chọn xã/phường</option>');
  if (provinceVal) {
    axios
      .get(host + "p/" + provinceVal + "?depth=2")
      .then((response) => {
        renderData(response.data.districts, "districts_sender");
      })
      .catch((error) => console.error("Error loading districts:", error));
  }
  printResultSender();
});

$("#districts_sender").change(() => {
  let districtVal = $("#districts_sender").val();
  $("#wards_sender").html('<option value="">Chọn xã/phường</option>');
  if (districtVal) {
    axios
      .get(host + "d/" + districtVal + "?depth=2")
      .then((response) => {
        renderData(response.data.wards, "wards_sender");
      })
      .catch((error) => console.error("Error loading wards:", error));
  }
  printResultSender();
});

$("#wards_sender").change(() => {
  printResultSender();
});

const printResultSender = () => {
  if (
    $("#provinces_sender").val() !== "" &&
    $("#districts_sender").val() !== "" &&
    $("#wards_sender").val() !== ""
  ) {
    let result =
      $("#provinces_sender option:selected").text() +
      " | " +
      $("#districts_sender option:selected").text() +
      " | " +
      $("#wards_sender option:selected").text();
    $("#result_sender").text("Người gửi: " + result);
  } else {
    $("#result_sender").empty();
  }
};

// --- Xử lý cho người nhận ---
$("#provinces_receiver").change(() => {
  let provinceVal = $("#provinces_receiver").val();
  $("#districts_receiver").html('<option value="">Chọn Huyện</option>');
  $("#wards_receiver").html('<option value="">Chọn xã/phường</option>');
  if (provinceVal) {
    axios
      .get(host + "p/" + provinceVal + "?depth=2")
      .then((response) => {
        renderData(response.data.districts, "districts_receiver");
      })
      .catch((error) => console.error("Error loading districts:", error));
  }
  printResultReceiver();
});

$("#districts_receiver").change(() => {
  let districtVal = $("#districts_receiver").val();
  $("#wards_receiver").html('<option value="">Chọn xã/phường</option>');
  if (districtVal) {
    axios
      .get(host + "d/" + districtVal + "?depth=2")
      .then((response) => {
        renderData(response.data.wards, "wards_receiver");
      })
      .catch((error) => console.error("Error loading wards:", error));
  }
  printResultReceiver();
});

$("#wards_receiver").change(() => {
  printResultReceiver();
});

const printResultReceiver = () => {
  if (
    $("#provinces_receiver").val() !== "" &&
    $("#districts_receiver").val() !== "" &&
    $("#wards_receiver").val() !== ""
  ) {
    let result =
      $("#provinces_receiver option:selected").text() +
      " | " +
      $("#districts_receiver option:selected").text() +
      " | " +
      $("#wards_receiver option:selected").text();
    $("#result_receiver").text("Người nhận: " + result);
  } else {
    $("#result_receiver").empty();
  }
};

//mở ô tìm kiếm trong select
$(document).ready(function () {
  // Người gửi
  $("#provinces_sender")
    .select2({
      placeholder: "Chọn Tỉnh",
      allowClear: true,
      minimumResultsForSearch: 0,
    })
    .on("select2:open", function () {
      $(".select2-search__field").attr("placeholder", "Tìm kiếm Tỉnh");
    });

  $("#districts_sender")
    .select2({
      placeholder: "Chọn Huyện",
      allowClear: true,
      minimumResultsForSearch: 0,
    })
    .on("select2:open", function () {
      $(".select2-search__field").attr("placeholder", "Tìm kiếm Huyện");
    });

  $("#wards_sender")
    .select2({
      placeholder: "Chọn xã/phường",
      allowClear: true,
      minimumResultsForSearch: 0,
    })
    .on("select2:open", function () {
      $(".select2-search__field").attr("placeholder", "Tìm kiếm Xã/Phường");
    });

  // Người nhận
  $("#provinces_receiver")
    .select2({
      placeholder: "Chọn Tỉnh",
      allowClear: true,
      minimumResultsForSearch: 0,
    })
    .on("select2:open", function () {
      $(".select2-search__field").attr("placeholder", "Tìm kiếm Tỉnh");
    });

  $("#districts_receiver")
    .select2({
      placeholder: "Chọn Huyện",
      allowClear: true,
      minimumResultsForSearch: 0,
    })
    .on("select2:open", function () {
      $(".select2-search__field").attr("placeholder", "Tìm kiếm Huyện");
    });

  $("#wards_receiver")
    .select2({
      placeholder: "Chọn xã/phường",
      allowClear: true,
      minimumResultsForSearch: 0,
    })
    .on("select2:open", function () {
      $(".select2-search__field").attr("placeholder", "Tìm kiếm Xã/Phường");
    });
});

//chuyển id mã tỉnh huyện phường sang text
$(document).ready(function () {
  // Cập nhật hidden input cho người gửi
  $("#provinces_sender").change(function () {
    var text = $("#provinces_sender option:selected").text();
    $("#provinces_sender_text").val(text);
  });

  $("#districts_sender").change(function () {
    var text = $("#districts_sender option:selected").text();
    $("#districts_sender_text").val(text);
  });

  $("#wards_sender").change(function () {
    var text = $("#wards_sender option:selected").text();
    $("#wards_sender_text").val(text);
  });

  // Cập nhật hidden input cho người nhận
  $("#provinces_receiver").change(function () {
    var text = $("#provinces_receiver option:selected").text();
    $("#provinces_receiver_text").val(text);
  });

  $("#districts_receiver").change(function () {
    var text = $("#districts_receiver option:selected").text();
    $("#districts_receiver_text").val(text);
  });

  $("#wards_receiver").change(function () {
    var text = $("#wards_receiver option:selected").text();
    $("#wards_receiver_text").val(text);
  });
});
