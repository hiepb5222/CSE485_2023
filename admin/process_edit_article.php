<?php
    require_once 'DB_con.php';
    $ma_bviet=$_POST['txtBaiviet'];
    $tieude=$_POST['txtTieude'];
    $baihat=$_POST['txtBaihat'];
    $theloai=$_POST['txtTheloai'];
    $tomtat=$_POST['txtTomtat'];
    $noidung=$_POST['txtNoidung'];
    $tacgia=$_POST['txtTacgia'];
    $ngayviet=$_POST['txtNgayviet'];
    $hinhanh=$_POST['txtHinhanh'];
    
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
        die("Không tìm thấy thể loại có tên '$tacgia'");
      }
    $updateBaivietsql="UPDATE baiviet SET tieude='$tieude',ten_bhat='$baihat',ma_tloai='$category_id',tomtat='$tomtat',noidung='$noidung'
    ,ma_tgia='$author_id',ngayviet='$ngayviet',hinhanh='$hinhanh' WHERE ma_bviet='$ma_bviet'";
    mysqli_query($conn, $updateBaivietsql);
    ?>
    