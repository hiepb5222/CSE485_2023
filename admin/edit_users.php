<?php
function html_escape($text): string
{

    $text = $text ?? ''; 

    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false); // Return escaped string
}
    $id= html_escape( $_GET['sid']);
    require_once 'DB_con.php';
    $edit_sql="select * from users where id=$id";
    $kq= (mysqli_query($conn,$edit_sql));
    $row = mysqli_fetch_assoc($kq);    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="article.php">Bài viết</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="users.php">Người dùng</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin người dùng</h3>
                <form action="process_edit_users.php" method="post">
                            <input type="hidden" name="sid" value="<?php echo $row['id']?>">
                            <div class="input-group mb-2">
                                <span class="input-group-text" ><i class="bi bi-list-ol"></i></span>
                                <input readonly type="text" name="txtID" class="form-control" value="<?php echo $row['id']?>" >
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text" ><i class="fas fa-user"></i></span>
                                <input type="text" name="txtName" class="form-control" required value="<?php echo $row['name']?>" >
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text" ><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" name="txtEmail" class="form-control" required value="<?php echo $row['email']?>" >
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text" ><i class="fas fa-user"></i></span>
                                <input type="text" name="txtUser" class="form-control"  required value="<?php echo $row['username']?>" >
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text" ><i class="fas fa-key"></i></span>
                                <input type="password" name="txtPass" class="form-control" required value="<?php echo $row['password']?>" >
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text" ><i class="fas fa-key"></i></span>
                                <input type="password" name="txtResetPass" class="form-control" required value="<?php echo $row['password']?>" >
                            </div>
                            
                            <div class="form-group  float-end ">
                                <input type="submit" id ="signbtn" name="signbtn"value="Lưu lại" class="btn btn-success">
                                <a href="users.php" class="btn btn-warning ">Quay lại</a>
                            </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer fixed-bottom bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>