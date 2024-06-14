<?php
include_once '../../set.php';
include_once '../../connect.php';


?>
<!DOCTYPE html>
<html>
<body>
                    <?php
                    $_alert = ''; // Khởi tạo biến $_alert với giá trị rỗng
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $_username = $_POST['username'];
                        $_tinhtrang = $_POST['tinhtrang'];

                        // Truy vấn cơ sở dữ liệu để kiểm tra tài khoản
                        $sql = "SELECT * FROM account WHERE username = '$_username'";
                        $result = $conn->query($sql);

                        if ($result->num_rows == 0) {
                            // Thông báo lỗi nếu tài khoản không tồn tại
                            $_alert = 'Tên tài khoản không tồn tại!';
                        } else {
                            $row = $result->fetch_assoc();
                            $is_banned = $row['active'];

                            if ($_tinhtrang == 'MoKhoa') {
                                // Mở khóa tài khoản
                                if ($is_banned === '1') {
                                    $sql2 = "UPDATE account SET active = '0' WHERE username = '$_username'";
                                    if ($conn->query($sql2) === TRUE) {
                                        $_alert = 'huỷ kích hoạt tài khoản thành công!';
                                    } else {
                                        $_alert = 'Lỗi: Kết nối đến máy chủ';
                                    }
                                } else {
                                    // Nếu tài khoản không bị khóa, hiển thị thông báo
                                    $_alert = 'Tài khoản chưa kích hoạt!';
                                }
                            } elseif ($_tinhtrang == 'Khoa') {
                                // Khóa tài khoản
                                if ($is_banned === '0') {
                                    // Nếu tài khoản chưa bị khóa, tiến hành khóa tài khoản
                                    $sql2 = "UPDATE account SET active = '1' WHERE username = '$_username'";
                                    if ($conn->query($sql2) === TRUE) {
                                        // Thông báo thành công khi khóa tài khoản thành công
                                        $_alert = 'kích hoạt tài khoản thành công!';
                                    } else {
                                        $_alert = 'Lỗi: Kết nối đến máy chủ';
                                    }
                                } else {
                                    // Nếu tài khoản đã bị khóa, hiển thị thông báo
                                    $_alert = 'Tài khoản đã kích hoạt!';
                                }
                            }
                        }
                        $conn->close();
                    }
                    ?>
                    <!-- Hiển thị biến $_alert -->
                    <?php echo $_alert; ?>
                    <br>
                    <br>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="font-weight-bold">Tên Tài Khoản</label>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Nhập tên tài khoản" required autocomplete="off">

                            <label class="font-weight-bold">Tình Trạng</label>
                            <select class="form-control" name="tinhtrang" id="tinhtrang" required>
                                <option value="MoKhoa">Huỷ Thành Viên</option>
                                <option value="Khoa">Mở Thành Viên</option>
                            </select>
                        </div>
                        <button class="btn btn-main form-control" type="submit">Kích Hoạt</button>
                    </form>
            </div>
        </div>
    </div>
    
</body><!-- Bootstrap core JavaScript -->

</html>