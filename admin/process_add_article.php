<?php
    require_once 'DB_con.php';
if(isset($_POST['submit'])) {
    $tieude=$_POST['txtTieude'];
    $baihat=$_POST['txtBaihat'];
    $theloai=$_POST['txtTheloai'];
    $tomtat=$_POST['txtTomtat'];
    $noidung=$_POST['txtNoidung'];
    $tacgia=$_POST['txtTacgia'];
    // $ngayviet=$_POST['txtNgayviet'];
    $current_time = date("Y-m-d");
    $hinhanh=$_FILES['txtHinhanh']['name'];
    $hinhanh_tmp=$_FILES['txtHinhanh']['tmp_name'];

      
    $sql_checkId_tloai = "SELECT ma_tloai FROM theloai WHERE ten_tloai = '$theloai'";
    $resultIdtheloai = mysqli_query($conn, $sql_checkId_tloai);
    if (mysqli_num_rows($resultIdtheloai) > 0) {
          // Nếu tìm thấy thể loại có tên trùng với tên được nhập, lấy id của thể loại đó
          $rowIdtheloai = mysqli_fetch_assoc($resultIdtheloai);
          $category_id = $rowIdtheloai['ma_tloai'];
    } else {
            // Nếu không tìm thấy thể loại, hiển thị thông báo lỗi
            die("Không tìm thấy thể loại có tên '$theloai'");
    }

        $sql_checkId_tgia = "SELECT ma_tgia FROM tacgia WHERE ten_tgia = '$tacgia'";
        $resultIdtacgia = mysqli_query($conn, $sql_checkId_tgia);
    if (mysqli_num_rows($resultIdtacgia) > 0) {
        // Nếu tìm thấy thể loại có tên trùng với tên được nhập, lấy id của thể loại đó
        $rowIdtacgia = mysqli_fetch_assoc($resultIdtacgia);
        $author_id = $rowIdtacgia['ma_tgia'];
    } else {
            // Nếu không tìm thấy thể loại, hiển thị thông báo lỗi
            die("Không tìm thấy tác giả có tên '$tacgia'");
    }
    
        $addBaivietsql="INSERT INTO baiviet(tieude,ten_bhat,ma_tloai,tomtat,noidung,ma_tgia,ngayviet,hinhanh) VALUES('$tieude','$baihat'
      ,'$category_id','$tomtat','$noidung','$author_id','$current_time','$hinhanh')";
        $result=mysqli_query($conn, $addBaivietsql);
        $target='C:/xampp/htdocs/CSE485_2023/images/songs/'.basename($_FILES['txtHinhanh']['name']);
        move_uploaded_file($hinhanh_tmp, $target);
        header('Location:article.php');
}
?>
