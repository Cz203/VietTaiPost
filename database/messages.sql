-- Tạo bảng messages
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    sender_type ENUM('khachhang', 'shipper') NOT NULL,
    receiver_id INT NOT NULL,
    receiver_type ENUM('khachhang', 'shipper') NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tạo index để tối ưu truy vấn
CREATE INDEX idx_sender ON messages(sender_id, sender_type);
CREATE INDEX idx_receiver ON messages(receiver_id, receiver_type);
CREATE INDEX idx_created_at ON messages(created_at); 