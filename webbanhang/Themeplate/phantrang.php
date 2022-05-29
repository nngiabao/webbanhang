<?php
    for($num = 1; $num <= $tongsotrang; $num++)//duyet qua tong so trang r luu so trang can hien thi la num
    { ?>
        <?php if ($tranghientai != $num)
            { ?>
        <a class="page-item" href="#" anlong="<?=$num?>" id="<?=$num?>"><?=$num?></a>
    <?php } else {?>
        <strong class="current-page page-item"><?= $num ?></strong>
    <?php }?>
    <?php } ?>
    
    <script>
        $(document).ready(function(){
        $(".page-item").click(function(){
            var page = $(this).attr("anlong");
            var idcon = $("#layidcon").attr("anlong");
            var timkiem = document.getElementById("idtxtTimKiem").value;
            //var timkiem = document.getElementById("idtxtTimkiem").value;
            $.post("content.php", {trang: page, idcon: idcon, timkiem: timkiem}, function(data){
                $("#noidung").html(data);
                //gán lại ô tìm kiếm
                //document.getElementById("idtxtTimkiem").value = timkiem;
                //alert(page);
        });
      });
        });
    </script>