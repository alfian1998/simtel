<div class="container" style="margin-bottom: -15px;">
<?php 
$no=1;
foreach ($kategori as $data): 
//
	$kategori_id = $data['kategori_id'];
//
if($kategori_id == '01') $nama_kategori = "Menara";
elseif($kategori_id == '02') $nama_kategori = "Warnet";
elseif($kategori_id == '03') $nama_kategori = "Warsel";
elseif($kategori_id == '04') $nama_kategori = "Penyiaran";
elseif($kategori_id == '05') $nama_kategori = "Extension";
elseif($kategori_id == '06') $nama_kategori = "Telepon/RIG";
elseif($kategori_id == '07') $nama_kategori = "Sinyal Seluler";
?>
<div class="box-panel"> 
    <div class="span6 span3" style="width: 124px;">     
    	<a href="<?=site_url('web/location/'.$data['kategori_url'])?>" style="text-decoration: none;">
        <div class="panel status panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title text-center"><?=$count[$kategori_id]?></h1>
            </div>
            <div class="panel-body text-center">                        
                <strong><?=$nama_kategori?></strong>
            </div>
        </div>
    	</a>
    </div>
</div>     
<?php 
$no++;
endforeach; 
?>
</div>
	