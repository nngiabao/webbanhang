<?php
	for($num = 1; $num <= $tongTrang; $num++)//duyet qua tong so trang r luu so trang can hien thi la num
	{ ?>
		<?php if ($current_page != $num)
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
        	var timkiem = document.getElementById("idtxtTimkiem").value;
            $.get("qlsanpham.php", {trang: page, timkiem: timkiem}, function(data){
            	
              	$("#noidung").html(data);
              	//gán lại ô tìm kiếm
              	document.getElementById("idtxtTimkiem").value = timkiem;
              	//alert(page);
        });
      });
        });
	</script>