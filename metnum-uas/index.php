<!DOCTYPE html>
<html>
<head>
	<title>Metode Numerik | Iterasi Jacobi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style type="text/css">
		body {
			margin: 0;
			background-image: linear-gradient( 109.6deg,  rgba(24,138,141,1) 11.2%, rgba(96,221,142,1) 91.1% );
		}
        h4, label, h5, tr, td {
            font-family: sans-serif;
        }
		.center {
		display: block;
		margin-left: auto;
		margin-right: auto;
		margin-top: 30px;
		}
        .btn-submit{
            color: white;
            background: #ffc066;            
            font-size: 18px;
            font-weight: bold;
        }
        .btn-submit:hover, .btn-submit:active{            
            background: #ffb54c;
            color: white;
        }
        .inputNumber input {
        	width: 100px !important;
        }			
        .inputNumber{
        	display: flex;
        	margin-right: 14px;
        }
        .row{
        	margin:0;        	
        }
        .persamaan{
        	margin-bottom: calc(1rem + 14px);
        }
        .form-group {
        	margin-bottom: 0;
        }        
        .inputNumber {
        	align-items: center;
        }
	</style>
</head>
<body>
	<?php 
		if(!empty($form_error)){
			echo "<script>alert('".$form_error."')</script>";
		}
	?>	

		<img src="udb.png" width="90" height="120" class="center"><br>
		<h5 style="color:black; text-align:center;">Created by : </h5>
		<p style="text-align:center;">Amilia Ayu Lala K. | Christopher Jody W. | Daffa Vignaditya P.</p>
		<p style="text-align:center;font-weight: bold;font-style: italic;margin-top: 30px;">*Note : Harap menggunakan koneksi internet saat menggunakan program.*</p>
        <div class="container" style="margin-bottom:80px;background: rgba(255,255,255,0.3);border-radius: 8px;">     
        <div style="padding: 20px;">
        	<div class="row">
        		<div class="col col-md-7">
        			<form id="formInput" method="POST" action="#" onsubmit="return submitData();">
        		<?php
        		for($i=1;$i<=3;$i++){ ?>
        			<div class="persamaan">
        		<div>
        		<h4 style="color:#2f3e46;">Persamaan <?=$i?></h4>
        	</div>
        	<div class="row">
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="a[]" required>			    
			  </div>
			  <div>
			  	<h5 style="color: #2f3e46;">x<sub>1</sub></h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="b[]" required>			    
			  </div>
			  <div>
			  	<h5 style="color: #2f3e46;">x<sub>2</sub></h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="c[]" required>			    
			  </div>
			  <div>
			  	<h5 style="color: #2f3e46;">x<sub>3</sub></h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">        			
			  <div>
			  	<h5 style="color: #2f3e46;"> = </h5>
			  </div>			  
        		</div>
        		<div class="inputNumber">
        			<div class="form-group" style="margin-right: 5px;">			    
			    <input type="number" class="form-control" name="o[]" required>			    
			  </div>			  
        		</div>        					  
        	</div>
        	</div>
        		<?php }
        		?>  
        		<div class="persamaan">        		
        	<div class="row">
        		<div class="inputNumber" style="margin-top: 10px;margin-bottom: 5px;">
        			<div style="margin-right: 10px;">
			  	<h5 style="color: #2f3e46;">Jumlah Iterasi : </h5>
			  </div>			  
        			<div class="form-group" style="margin-right: 15px;">			    
			    <input type="number" class="form-control" id="ulangan" name="ulangan">			    
			  </div>
			  			  
        		</div>
        	</div>
        	</div>      		 
        	<div>
        		<div class="form-group">
      <input type="submit" class="btn btn-md btn-primary" value="Hitung">
  </div>
        	</div>
        	</form>	
        		</div>
        		<div id="div_hasil" class="col col-md-5" style="border-left: 2px solid #2f3e46;display: none;">
        			<div style="margin-bottom: 28px;">
        		<h4 style="color: #2f3e46;">Hasil</h4>
        	</div>
        	<div id="hasil" style="margin-bottom: 14px;"></div>
        	<div style="margin-bottom: 20px">
        		<h5 style="color: #2f3e46;">Setelah dilakukan pengulangan atau iterasi sebanyak <span id="total_ulangan"></span> kali menggunakan Algoritma Jacobi, maka didapatkan hasil sebagai berikut :</h5>
        	</div>
        	<div id="list_iterasi" class="table-responsive" style="margin-bottom: 14px;"></div>
        	<div>
        		<h5 style="color: #2f3e46;">x<sub>1</sub> : <span id="hasil_x1"></span></h5>
        		<h5 style="color: #2f3e46;">x<sub>2</sub> : <span id="hasil_x2"></span></h5>
        		<h5 style="color: #2f3e46;">x<sub>3</sub> : <span id="hasil_x3"></span></h5>
        	</div>
        		</div>
        	</div>
        </div>                       	
	</div>	
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var formUp = document.getElementById('formInput');	
	function submitData(){  			
  	$.ajax({                
                type: 'POST',
                url: "itung.php",
                data: new FormData(formUp),
                contentType: false,
                cache: false,
                processData:false,
                dataType:'json',                
 
                success: function(json){        
                	$('#total_ulangan').text($('#ulangan').val());        	
                    $('#formInput').trigger("reset");
                    $('#div_hasil').show();
                    $('#hasil').html(json.data);     
                    $('#list_iterasi').html(json.list_iterasi);
                    $('#hasil_x1').text(json.x1);        	               
                    $('#hasil_x2').text(json.x2);        	               
                    $('#hasil_x3').text(json.x3);        	               
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                }
            });                

            return false;
  }
</script>
</html>