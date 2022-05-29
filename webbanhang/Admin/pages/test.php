<link href="../assets/css/admin_style.css" rel="stylesheet" />
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "web";
$con = mysqli_connect($host, $user, $password, $database);
if($con)
{
	echo "thanh cong";
}
else echo "Thât bai";
$sql ="select * from sanpham";
$rs = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($rs))
{
	echo ' '.$row['masp'];
}
var_dump($row);
$item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($con, "SELECT * FROM `sanpham`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $products = mysqli_query($con, "SELECT * FROM `sanpham` ORDER BY `masp` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    mysqli_close($con);
    ?>
    <div class="row">
            <div class="col-md-12 col-sm-8">
    <div class="main-content">
        <h1>Danh sách sản phẩm</h1>
        <div class="product-items">
            <div class="buttons">
                <a href="./product_editing.php">Thêm sản phẩm</a>
            </div>
            <ul>
                <li class="product-item-heading">
                    <div class="product-prop product-img">Ảnh</div>
                    <div class="product-prop product-img">Mã</div>
                    <div class="product-prop product-name" style="width: 200px">Tên sản phẩm</div>
                    <div class="product-prop product-name">Giá</div>
                    <div class="product-prop product-button">Xóa</div>
                    <div class="product-prop product-button">Sửa</div>
                    <div class="product-prop product-name">Ngày tạo</div>
                    
                    <div class="clear-both"></div>
                </li>
                <?php
                while ($row = mysqli_fetch_array($products)) {
                	?>
                   <li>
                        <div class="product-prop product-img"><img src="<?= $row['anhsp'] ?>"/></div>
                        <div class="product-prop product-img"><?= $row['masp'] ?></div>
                        <div class="product-prop product-name" style="width: 200px">san pham 1</div>
                        <div class="product-prop product-name"><?= $row['gia'] ?></div>
                        <div class="product-prop product-name"><?= $row['ngaydang'] ?></div>
                        <div class="product-prop product-button">
                            <a href="./product_delete.php?id=<?= $row['masp'] ?>">Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_editing.php?id=<?= $row['masp'] ?>">Sửa</a>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <?php
            include 'pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
</div>
</div>