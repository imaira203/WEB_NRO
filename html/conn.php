
	 <?php
        $username = "root"; // Khai báo username
        $password = "imaira2003";      // Khai báo password
        $server   = "localhost";   // Khai báo server
        $dbname   = "blue";      // Khai báo database


        $connect = new mysqli($server, $username, $password, $dbname);
        if ($connect->connect_error) {
            die("Không kết nối :" . $connect->connect_error);
        }
        ?>
