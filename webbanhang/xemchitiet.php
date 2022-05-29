      <?php
      require("ConnectDB.php");
      $masp = $_POST["masp"];
      $sql = "select * from sanpham where trangthai = '1' and masp='$masp'";
      $rs = mysqli_query($con, $sql);
      ?>
      <div class="modal-content d-flex justify-content-center h-100">
        <div class="modal-header d-flex justify-content-center">
          <h3 class="modal-title text-center text-primary" id="signuplbl">Chi tiết sản phẩm</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>  
        <div class="modal-body d-flex justify-content-center" id="details">
        <?php while ($data = mysqli_fetch_array($rs)) {
        ?>
        <div style="clear: both;"></div>
          <div id="chitiet_sanpham">
              <div id="img-sp" style="max-width: 170px;">
                  <img src="Admin/pages/<?=$data['anhsp']?>">
              </div>

              <div id="thongtin-sanpham">
                  <h1 style="color: red; font-size: 22px;"><?=$data['tensp']?></h1>
                  <label style="font-size: 15px;">Giá: </label><span class="gia-sanpham" style="font-size: 15px; font-weight: bold;color: red; margin-left: 7px;"><?=number_format($data['gia'],0,",",".") ?> đ</span>
                  <br>
                  <div style="clear: both;"></div>
                  <span class="nd" style="font-size: 15px;line-height: 20px;"><?php echo $data['mota']?></span>
                      
              </div>
          </div>
          <?php } ?>
    </div>  
    </div>