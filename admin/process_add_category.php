<?php
        $tentloai = $_POST ['tentheloai'];
        require_once 'DB_con.php';
        $sql = "INSERT INTO theloai (ten_tloai) VALUES ('$tentloai')";
        if (mysqli_query($conn, $sql))
        {
                echo"<h5>Thêm thành công" ;

        }
        header("Location: category.php")
        ?>