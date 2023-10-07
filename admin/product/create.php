<?php
include '../inc/header1.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<div class="grid_10">
    <div class="box round first grid">
        <?php
        require_once "../../modules/db_module.php";
        $link = null;
        taoKetNoi($link);
        $sql = "SELECT * FROM tbl_product_category";
        $result = chayTruyVanTraVeDL($link, $sql);
        if (isset($_POST['submit'])) {
            $error = [];

            if ($_POST['product_price'] < 0) {
                $error['product_price'] = "Nhập >0";
            }

            if (empty($_POST['product_name'])) {
                $error['product_name'] = "Không được để trống!";
            }
            if (empty($_POST['product_price'])) {
                $error['product_price'] = "Không được để trống!";
            }
            if (empty($_POST['product_maintenance'])) {
                $error['product_maintenance'] = "Không được để trống!";
            }
            if (empty($_POST['product_producer'])) {
                $error['product_producer'] = "Không được để trống!";
            }
            if ($_FILES['product_thumnail']['error'] > 0) {
                $error['product_thumnail'] = "Không được để trống!";
            } else {
                $fileName = $_FILES['product_thumnail']['name'];
                $file_tmp = $_FILES['product_thumnail']['tmp_name'];
                $fileext = pathinfo($fileName, PATHINFO_EXTENSION);
                
                    $path = "../../img/" . $fileName;
                    move_uploaded_file($file_tmp, $path);
                
            }
            if (empty($error)) {
                $product_name = $_POST['product_name'];
                $product_price = $_POST['product_price'];
                $product_maintenance = $_POST['product_maintenance'];
                $product_producer = $_POST['product_producer'];
                $category_id = $_POST['category_id'];
                $sqlInsert = "INSERT INTO tbl_product (product_name, 
                product_price,product_thumnail, product_maintenance, product_producer, 
                category_id) VALUES ('$product_name', '$product_price','$fileName', 
                '$product_maintenance', '$product_producer', '$category_id')";
                $check = chayTruyVanKhongTraVeDL($link, $sqlInsert);
                if ($check) {
                    $_SESSION['status'] = "Thêm phòng thành công";
                    header("refresh:3,url='index.php'");
                } else {
                    $_SESSION['status'] = "Thêm phòng thất bại";
                    header("refresh:3,url='index.php'");
                }
            }
        }
        ?>
        <div class="container">
            <div class="col-md-12">
                <?php if (isset($_SESSION['status'])) : ?>
                    <?php if ($_SESSION['status'] == "Thêm phòng thành công") : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['status']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($_SESSION['status'] == "Thêm phòng thất bại") : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['status']; ?>
                        </div>
                    <?php endif; ?>
                    <?php unset($_SESSION['status']); ?>
                <?php endif ?>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group" class="col-md-12 col-sm-12">
                    <label for="1">Tên phòng</label>
                    <input type="text" class="form-control" name="product_name" id="1" placeholder="Nhập tên phòng">
                    <?php if (isset($error['product_name'])) : ?>
                        <span style="color: red;"><?= $error['product_name'] ?></span>
                    <?php endif; ?><br>

                    <label for="2">Giá phòng</label>
                    <input type="number" class="form-control" name="product_price" id="2" placeholder="Nhập giá phòng">
                    <?php if (isset($error['product_price'])) : ?>
                        <span style="color: red;"><?= $error['product_price'] ?></span>
                    <?php endif; ?><br>

                    <label for="">Ảnh phòng</label>
                    <input type="file" name="product_thumnail" class="form-control">
                    <?php if (isset($error['product_thumnail'])) : ?>
                        <span style="color: red;"><?= $error['product_thumnail'] ?></span>
                    <?php endif; ?><br>

                    <label for="3">Thời gian bắt đầu ở được</label>
                    <input type="text" class="form-control" name="product_maintenance" id="3" placeholder="Nhập thời gian bắt đầu ở được">
                    <?php if (isset($error['product_maintenance'])) : ?>
                        <span style="color: red;"><?= $error['product_maintenance'] ?></span>
                    <?php endif; ?><br>

                    <label for="4">Địa chỉ cụ thể</label>
                    <input type="text" class="form-control" name="product_producer" id="4" placeholder="Nhập địa chỉ cụ thể">
                    <?php if (isset($error['product_producer'])) : ?>
                        <span style="color: red;"><?= $error['product_producer'] ?></span>
                    <?php endif; ?><br>

                    <label for="5">Khu vực</label>
                    <div class="form-group">
                        <select name="category_id" id="5" class="form-control">
                            <?php while ($rows = mysqli_fetch_assoc($result)) : ?>
                                <option value="<?= $rows['category_id'] ?>"><?= $rows['category_ename'] . " " . $rows['category_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Thêm Phòng</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

<?php include '../inc/footer.php'; ?>