<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tính Khoảng Cách Di Chuyển</title>
  <script>
    // Hàm tính khoảng cách di chuyển sử dụng OSRM API
    function getDrivingDistance(lat1, lon1, lat2, lon2) {
      const osrmUrl = `http://router.project-osrm.org/route/v1/driving/${lon1},${lat1};${lon2},${lat2}?overview=false&alternatives=false&steps=false`;

      fetch(osrmUrl)
        .then(response => response.json())
        .then(data => {
          // Khoảng cách trả về tính bằng mét, chuyển thành km
          const distance = data.routes[0].legs[0].distance / 1000;
          document.getElementById('result').innerText = `Khoảng cách di chuyển: ${distance.toFixed(2)} km`;
        })
        .catch(error => {
          console.error('Có lỗi xảy ra:', error);
          document.getElementById('result').innerText = 'Không thể tính khoảng cách. Vui lòng thử lại.';
        });
    }

    // Hàm tính toán khi nhấn nút
    function calculateDistance() {
      const lat1 = parseFloat(document.getElementById('lat1').value);
      const lon1 = parseFloat(document.getElementById('lon1').value);
      const lat2 = parseFloat(document.getElementById('lat2').value);
      const lon2 = parseFloat(document.getElementById('lon2').value);

      getDrivingDistance(lat1, lon1, lat2, lon2);
    }
  </script>
</head>
<body>
  <h1>Tính Khoảng Cách Di Chuyển Giữa Hai Tọa Độ</h1>
  
  <div>
    <label for="lat1">Tọa độ Lat1:</label>
    <input type="text" id="lat1" value="21.0285">
  </div>
  <div>
    <label for="lon1">Tọa độ Lon1:</label>
    <input type="text" id="lon1" value="105.8542">
  </div>
  <div>
    <label for="lat2">Tọa độ Lat2:</label>
    <input type="text" id="lat2" value="19.0760">
  </div>
  <div>
    <label for="lon2">Tọa độ Lon2:</label>
    <input type="text" id="lon2" value="106.6959">
  </div>
  <div>
    <button onclick="calculateDistance()">Tính Khoảng Cách</button>
  </div>
  <div>
    <p>Khoảng cách: <span id="result"></span></p>
  </div>
</body>
</html>
