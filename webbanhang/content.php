<?php
        include 'Themeplate/connectDB.php';
        $timkiem = (!empty($_POST['timkiem'])) ? $_POST['timkiem'] : "";
        $item_per_page = !empty($_POST['per_page'])?$_POST['per_page']:4;
        $tranghientai = !empty($_POST['trang'])?$_POST['trang']:1;
        $offset = ($tranghientai - 1) * $item_per_page;
        $idcon = $_POST['idcon'];
        if(!isset($timkiem))
        {
        $sanpham = mysqli_query($con, "SELECT * FROM sanpham where id_con = '$idcon' and trangthai='1'  LIMIT " . $item_per_page . " OFFSET " . $offset);

        $tongso  = mysqli_query($con, "SELECT * FROM sanpham where id_con = '$idcon' and trangthai ='1'");
        } else
        {
            $sanpham = mysqli_query($con, "SELECT * FROM sanpham where id_con = '$idcon' and trangthai='1' and sanpham.tensp like '%$timkiem%'  LIMIT " . $item_per_page . " OFFSET " . $offset);

            $tongso  = mysqli_query($con, "SELECT * FROM sanpham where id_con = '$idcon' and trangthai ='1' and sanpham.tensp like '%$timkiem%'");
        }
        $tongso = $tongso->num_rows;
        $tongsotrang = ceil($tongso / $item_per_page);
      ?>
            <div class="product-items">
                <?php
                while ($row = mysqli_fetch_array($sanpham)) {
                  
                ?>
                    <div class="product-item">
                        <div class="img_sp">
                            <img src="Admin/pages/<?= $row['anhsp'] ?>"/>
                        </div>
                        <strong style="position: absolute; top: 215px;width: fit-content; line-height: 19px"><?= $row['tensp'] ?></strong><br/>
                        <label style="font-weight: bold;position: absolute;top: 242px;">Giá: </label><span class="gia_sanpham"><?= number_format($row['gia'], 0, ",", ".") ?> đ</span><br/>
                        <p><?= $row['mota'] ?></p>

                        <div style="clear: both;"></div>
                        <div class="chitiet_sanpham" >
                          <input type="button" anlong = "<?= $row['masp'] ?>" value="Chi tiết" data-target="#modal-xemchitiet" data-toggle="modal" class="bamoday">


                          <div class="modal fade" id="modal-xemchitiet">
                                  <div class="modal-dialog  modal-dialog-centered">
                                      <div class="modal-content">
                                        <div id="modalcontent"></div>
                                      </div>
                                  </div>
                                </div>

                                
                        </div>
                        <div class="clear-both" anlong="<?= $row['id_con'] ?>" id="layidcon"></div>
                        <input type="hidden" id="tensp<?php echo $row["masp"]?>" value="<?php echo $row["tensp"]?>" />
                  <input type="hidden" id="giasp<?php echo $row["masp"]?>" value="<?php echo $row['gia']?>" />
            <input type="hidden" id="hinhsp<?php echo $row["masp"]?>" value="<?php echo $row['anhsp']?>" />
                        <div class="buy-button" id="<?php echo $row["masp"] ?>">
                            <a style="background-color: yellow;" href="#">Mua sản phẩm</a>
                        </div>
                    </div>
                <?php }?>
                <div class="clear-both"></div>
                <?php
                include 'Themeplate/phantrang.php';
                ?>
                <div class="clear-both"></div>
          

<br>
<div class="clear-both"></div>
<script type="text/javascript">
    $(document).ready(function()
        {
            $(".bamoday").click(function()
                {
                    var masp = $(this).attr("anlong");
                    $.post("xemchitiet.php",{masp: masp},function(data)
                    {
                        $("#modalcontent").html(data);
                    });
                });
        });
</script>