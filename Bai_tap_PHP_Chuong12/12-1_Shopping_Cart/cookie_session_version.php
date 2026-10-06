\
<?php
// Phiên bản cho bước 4:
// Session cookie chỉ tồn tại cho đến khi đóng trình duyệt.

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();
