<?php
header('Content-Type: text/html; charset=utf-8'); // Khai báo mã hóa UTF-8
include_once 'set.php';
include_once 'connect.php';

$_alert = null;
include('head.php');
if ($_login === null) {
    // Chưa đăng nhập, chuyển hướng đến trang khác bằng JavaScript
    echo '<script>window.location.href = "../dang-nhap";</script>';
    exit(); // Đảm bảo dừng thực thi code sau khi chuyển hướng
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli($ip_sv, $user_sv, $pass_sv, $dbname_sv);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin tài khoản người dùng
$sql = "SELECT vnd, last_received FROM account WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Kiểm tra xem người dùng đã nhận tiền hôm nay chưa
$today = date("Y-m-d");
if ($user['last_received'] == $today) {
    $message = "Bạn đã nhận tiền hôm nay rồi. Vui lòng quay lại vào ngày mai.";
} else {
    // Cập nhật số dư và thời gian nhận tiền
    $new_balance = $user['vnd'] + 20000;
    $sql = "UPDATE account SET vnd = ?, last_received = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $new_balance, $today, $_username);
    if ($stmt->execute()) {
        $message = "Bạn đã nhận được 20,000 VND.";
    } else {
        $message = "Có lỗi xảy ra. Vui lòng thử lại.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Trang Chủ Chính Thức - Ngọc Rồng BANDO</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="keywords"
        content="Chú Bé Rồng Online,ngoc rong mobile, game ngoc rong, game 7 vien ngoc rong, game bay vien ngoc rong">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:image" content="image/logo.jpg">
    <meta name="twitter:image:width" content="200">
    <meta name="twitter:image:height" content="200">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/notify/notify.js"></script>
    <link rel="icon" href="image/icon.png?v=99">
    <link href="assets/main.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/daneden/animate.css/v3.1.0/animate.min.css">
    <script src='https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js'></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <div class="container color-forum pt-1 pb-1">
        <div class="row">
            <div class="col">
                <a href="index" style="color: white">Quay lại diễn đàn</a>
            </div>
        </div>
    </div>
    <div class="container pt-3 pb-5">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="text-center pb-3">
                    <a href="history" class="text-dark">
                        <i class="fas fa-hand-point-right"></i>
                        Xem tình trạng nạp thẻ
                        <i class="fas fa-hand-point-left"></i>
                    </a>
                </div>
                <h4>NHẬN 20,000 VND MỖI NGÀY</h4>
                <?php if ($_login === null) { ?>
                    <p>Bạn chưa đăng nhập? hãy đăng nhập để sử dụng chức năng này</p>
                <?php } else { ?>
                    <p><?php echo $message; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="border-secondary border-top"></div>
    <div class="container pt-4 pb-4 text-white">
        <div class="row">
            <div class="col">
                <div class="text-center">
                    <div style="font-size: 13px" class="text-dark">
                        <?php
                        echo $_group;
                        echo $_fanpage;
                        echo $_copyright;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="status"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/main.js"></script>
</body>
</html>

