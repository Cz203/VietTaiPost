<?php

function showToast()
{
    if (!isset($_SESSION['toast'])) return;

    $type = $_SESSION['toast']['type'];  // 'success', 'error', 'warning', 'info'
    $message = $_SESSION['toast']['message'];
    $timeout = $_SESSION['toast']['timeout'] ?? 3000; // Mặc định 3 giây
    $extraMessage = $_SESSION['toast']['extra'] ?? '';

    // Xác định icon và màu nền theo loại thông báo
    $iconClass = match ($type) {
        'success' => 'fa-check-circle text-white',   // ✅ Thành công (Màu trắng để hiển thị rõ trên nền xanh)
        'error'   => 'fa-times-circle text-white',   // ❌ Lỗi
        'warning' => 'fa-exclamation-triangle text-dark', // ⚠ Cảnh báo (Màu đen để nổi trên nền vàng)
        'info'    => 'fa-info-circle text-white',    // ℹ Thông tin
        default   => 'fa-bell text-white'            // 🔔 Mặc định
    };

    $bgColor = match ($type) {
        'success' => 'bg-success',  // Xanh lá ✅
        'error'   => 'bg-danger',   // Đỏ ❌
        'warning' => 'bg-warning',  // Vàng ⚠
        'info'    => 'bg-info',     // Xanh dương ℹ
        default   => 'bg-secondary' // Xám
    };

    unset($_SESSION['toast']); // Xóa sau khi hiển thị

    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Thêm CSS cho animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            .toast {
                animation: slideIn 0.3s ease-out;
            }
            .toast.hiding {
                animation: slideOut 0.3s ease-in forwards !important;
            }
        `;
        document.head.appendChild(style);

        let toastDiv = document.createElement('div');
        toastDiv.className = 'toast-container position-fixed top-0 end-0 p-3';
        toastDiv.innerHTML = `
            <div class='toast align-items-center text-light $bgColor border-0 show' role='alert' aria-live='assertive' aria-atomic='true' style='max-width: 400px; margin-top: 40px;'>
                <div class='d-flex align-items-center justify-content-between p-2'>
                    <div class='toast-body d-flex align-items-center' style='flex-grow: 1; white-space: normal; word-wrap: break-word; overflow-wrap: break-word;'>
                        <i class='fa $iconClass' style='font-size: 18px; margin-right: 10px;'></i> 
                        <span>$message <strong style='color: orange;'>$extraMessage</strong></span>
                    </div>
                    <button type='button' class='btn-close btn-close-white' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
            </div>
        `;
        document.body.appendChild(toastDiv);
        
        let toast = new bootstrap.Toast(toastDiv.querySelector('.toast'), {
            animation: true,
            autohide: true,
            delay: $timeout
        });
        
        // Thêm event listener cho sự kiện hiding
        toastDiv.querySelector('.toast').addEventListener('hide.bs.toast', function () {
            this.classList.add('hiding');
        });
        
        toast.show();
        
        // Xóa toast khỏi DOM sau khi animation kết thúc
        toastDiv.querySelector('.toast').addEventListener('hidden.bs.toast', function () {
            toastDiv.remove();
        });
    });
</script>";
}
