BÀI TẬP CÔNG NGHỆ VÀ LẬP TRÌNH WEB - CHƯƠNG 12
================================================

Gồm 2 bài:

1. 12-1_Shopping_Cart
   Exercise 12-1 - Modify the Shopping Cart application

   Nội dung đã làm:
   - Dùng PHP Session.
   - Cookie của session tồn tại 3 năm.
   - Hiển thị Session ID.
   - Add sản phẩm vào giỏ.
   - Remove sản phẩm.
   - Empty Cart: xóa sản phẩm nhưng không hủy session.
   - End Session and Delete Cookie:
     + xóa dữ liệu session
     + hủy session
     + xóa cookie session
   - Có file cookie_session_version.php để tham khảo bước 4
     (session cookie lifetime = 0).

2. 12-2_Task_List_Manager
   Exercise 12-2 - Improve the Task List Manager application

   Nội dung đã làm:
   - Session tồn tại 1 năm.
   - Mảng tasks được lưu trong $_SESSION['tasks'].
   - Không lưu toàn bộ danh sách task bằng hidden fields.
   - Thêm task.
   - Xóa task.
   - Xóa toàn bộ task.
   - Khi đóng/mở trình duyệt lại, danh sách vẫn còn
     nếu cookie session vẫn còn hiệu lực.

CÁCH CHẠY TRÊN XAMPP
====================

Bước 1:
Giải nén file ZIP.

Bước 2:
Copy thư mục:
    Bai_tap_PHP_Chuong12

vào:
    C:\xampp\htdocs\

Bước 3:
Bật Apache trong XAMPP.

Theo ảnh XAMPP của bạn, Apache đang dùng port 8080.

Bước 4:
Mở trình duyệt và chạy:

Bài 12-1:
    http://localhost:8080/Bai_tap_PHP_Chuong12/12-1_Shopping_Cart/

Bài 12-2:
    http://localhost:8080/Bai_tap_PHP_Chuong12/12-2_Task_List_Manager/

LƯU Ý:
- Hai bài này không cần MySQL.
- Nếu Apache sau này đổi lại port 80 thì bỏ :8080.
