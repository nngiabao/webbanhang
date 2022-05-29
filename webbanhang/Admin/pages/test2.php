<link href="../assets/css/admin_style.css" rel="stylesheet" />
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "web";
$con = mysqli_connect($host, $user, $password, $database);
//$sql ="select * from user";
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
//----------------------------
$act = "qlsanpham";
$item_per_page = !empty($_GET['item_perpage'])?$_GET['per_page']:10;//so san pham hiển thị trên 1 trang(nếu khong có gì thì auto 10 sản phẩm 1 trang)
$current_page = !empty($_GET['page'])?$_GET['page']:1;//trang hiện tại(không có gì thì auto ve trang 1)
$offset = ($current_page - 1)  * $item_per_page;//sản phẩm bắt đầu
$sql = "SELECT * FROM  `sanpham` inner join menucon on menucon.id_con =
sanpham.id_con LIMIT ".$item_per_page." OFFSET ".$offset;//lay san phẩm theo limit
//------------------------------------------------------
$sql2 = "SELECT * FROM  `sanpham`";//lay toan bo san phảm 
$tong = mysqli_query($con, $sql2);
$tong = $tong -> num_rows;//lấy tổng số sản phẩm
//var_dump($tong);
//------------------------------------------------------
$tongTrang = ceil($tong / $item_per_page);//tính tổng số trang
//var_dump($tongTrang);

$rs = mysqli_query($con, $sql);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Danh sách sản phẩm</h4>
                  <p class="card-category">Tất cả sản phẩm đang bày bán</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Ảnh</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Đơn giá</th>
                        <th>Ngày đăng bán</th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                      	<?php
                            while ($row = mysqli_fetch_array($rs))
							              {	
                            ?>
                        <tr>
                          <td>
                            <div><img style="width: 80px; height:80px;" src="<?= $row['anhsp'] ?>"></div>
                          </td>
                          <td>
                            <?= $row['masp'] ?>
                          </td>
                          <td>
                            <?= $row['tensp'] ?>
                          </td>
                          <td>
                            <?= $row['tenMenucon'] ?>
                          </td>
                          <td>
                            <?=number_format($row['gia'],0,",",".") ?> Đ
                          </td>
                          <td>
                            <?= $row['ngaydang'] ?>
                          </td>
                      	<td>
                      		<a style="color:blue;" href="">Sửa</a>
                      	</td>
                        <td>
                          <a style="color:blue;" href="">Xóa</a>
                        </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    
                  </div>
                  <?php include 'test4.php'?>
                </div>
              </div>
            </div>
   		</div>
               