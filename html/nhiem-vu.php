<?php
include_once 'set.php';
include_once 'connect.php';
include('head.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ngọc Rồng BANDO</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="/">
    <meta name="description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="keywords"
        content="Chú Bé Rồng Online,ngoc rong mobile, game ngoc rong, game 7 vien ngoc rong, game bay vien ngoc rong">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:image" content="/image/logo.png">
    <meta name="twitter:image:width" content="200">
    <meta name="twitter:image:height" content="200">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/notify/notify.js"></script>
    <link rel="icon" href="/image/icon.png?v=99">
    <link href="assets/main.css" rel="stylesheet">
</head>

<body>
    <style>
        th,
        td {
            white-space: nowrap;
            padding: 2px 4px !important;
            font-size: 11px;
        }
    </style>
    <div class="container color-forum pt-1 pb-1">
        <div class="row">
            <div class="col"> <a href="dien-dan" style="color: white">Quay lại diễn đàn</a> </div>
        </div>
    </div>
    <div class="container color-forum pt-2">
        <div class="row">
            <div class="col">
                <h6 class="text-center">BXH ĐUA TOP Nhiệm Vụ</h6>
                <table class="table table-borderless text-center">
                    <tbody>
                        <tr>
                            <th scope="col">#</th>
							<th scope="col">Nhân vật</th>
                    <th scope="col">Nv chính</th>
                  <th scope="col">Nv phụ 1</th>
                  <th scope="col">Nv phụ 2</th>
				  <th scope="col">Nv hàng ngày</th>
                  </tr>
                  <?php
						$stt = 1;
						$data = mysqli_query($config,"SELECT name, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_task, ',', 1), '[', -1) AS UNSIGNED) AS task1, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_task, ',', 2), ',', -1) AS UNSIGNED) AS task2, CAST(SUBSTRING_INDEX(data_task, ',', -1) AS UNSIGNED) AS task3, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_side_task, ',', 3), ',', -1) AS UNSIGNED) AS task4, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_point, ',', 2), ',', -1) AS UNSIGNED) AS task5
						FROM player
						ORDER BY task1 DESC,task2 DESC,task3 DESC,task4 DESC,task5 DESC
						LIMIT 10;
						");
						while ($row = mysqli_fetch_array($data)) {
                       echo '<tr>
                              <td><b>'.$stt.'</b></td>
                              <td>'.$row['name'].'</td>
                              <td>'.number_format($row['task1']).'</td>
							  <td>'.number_format($row['task2']).'</td>
							  <td>'.number_format($row['task3']).'</td>
							  <td>'.number_format($row['task4']).'</td>
                            </tr>';
                        $stt++;}

                        // Đóng kết nối
                        $conn->close();
                        ?>
                    </tbody>
                </table>
                <div class="text-right">
                    <small>Cập nhật lúc:
                        <?php echo date('H:i d/m/Y'); ?>
                    </small>
                </div>
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
    </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/main.js"></script>
</body><!-- Bootstrap core JavaScript -->

</html>