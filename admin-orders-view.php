<?php
include_once('admin-header.php');
include_once('classes/admin.php');
 $AdminClass = new AdminClass();
$courier_info_id = $AdminClass->CompanyView();

?>
  <section class="main-content">
   
    <div class="container">
      <div class="row">
         <div class="col-xs-10 col-xs-offset-2">
          <?php
          if(isset($loginmsg)){
          echo $loginmsg;
          }else{
            Session::set('loginmsg', Null);
          }
          
          ?> 
            <content class="right-content">
              <h1>Welcome To Dashboard</h1>
            </content> 
            <div class="row registrationForm complete-orders">
            	<div class="col-sm-12">
<?php
if(isset($_POST['senddate'])){
$ParcentRead = $AdminClass->ParcentageAdd($_POST);	
$read 	 = $AdminClass->ParcentageDataView($_POST);

$data = $AdminClass->total_profit($_POST);
}
?>

						<form class="company-search-options" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
 							<div class="col-sm-3" style="margin-bottom: 10px;">
								<label>Order Date<sup>*</sup></label>	
								<div class="input-group date" data-provide="datepicker">
							    <input type="text" name="date" class="form-control" placeholder="Enter Date">
							    <div class="input-group-addon">
							        <i class="fa fa-calendar" aria-hidden="true"></i>
							    </div>
							</div>															
							</div>
							<div class="col-sm-3" style="margin-bottom: 10px;">
								<div class="form-group">
								<label for="sel1">Order Date<sup>*</sup></label>
								<div class="input-group" style="display: block;">
									<select class="form-control" id="sel1" name="courier_id">
										<option>Select Courier</option>
										<?php
											if(!empty($courier_info_id)):
												while($row = $courier_info_id->fetch_assoc()):
										?>
									<option value="<?php echo $row['courier_id'];?>"><?php echo $row['company_name'];?></option>
									<?php endwhile;endif;?>
									</select>
								</div>
							</div>
							</div>
 							<div class="col-sm-2" style="margin-bottom: 10px; padding-right: 0px;">
								<label>Parcentage<sup>*</sup></label>	
								<div class="input-group">
							    <input type="text" name="parcentage" class="form-control" placeholder="Enter Parcentage">
							</div>															
							</div>
							<div class="col-sm-1 parcentage-admin" style="padding-left: 0px">
								<h3>%</h3>
							</div>						
							<div class="col-sm-3">
								<div class="search-button">
									<input type="submit" name="senddate" value="Search">
								</div>								
							</div>							
						</form>            		
            	</div>
            </div>

			 <table class="table table-striped">
			    <thead>
			      <tr style="text-align: left;">
			        <th>Serial Number</th>
			        <th>Cost</th>
			        <th>Parcentage</th>
			        <th>Parcentage Cost</th>
			      </tr>
			    </thead>
			    <tbody>
<?php
$i = 1;
$sum = 0;
if(!empty($read)):
	while ($row = $read->fetch_assoc()):
$a = array($i);
$a = array_sum($a);	
$sum += ($row['cost'] * $row['parcentage'])/100;
?>			    	
			      <tr>
			        <td style="text-align: left;"><?php echo $i;?></td>
			        <td style="text-align: left;"><?php echo $row['cost'].' Tk';?></td>
			        <td style="text-align: left;">
			        	<?php 
			        	if(!empty($row['parcentage'])){
			        		echo $row['parcentage'].' %';
			        	}else{
			        		echo '0 %';
			        	}

			        	?>
			        		
			        	</td>
			        	<td style="text-align: left;">
			        		<?php
			        			if(!empty($row['parcentage'])){
			        				//var_dump($sum);	
			        				echo (($row['cost'] * $row['parcentage'])/100).' Tk';

			        			}else{
			        				echo $row['cost'].' Tk';
			        			}
			        		?>
			        	</td>
			      </tr>
<?php $i++;endwhile;endif;?>			      
			    </tbody>
			  </table>

<div class="view-cost-users">
<?php
if(!empty($data)):
	while ($row = $data->fetch_assoc()):	
?>
<div class="inner-view-cost">	
	<div class="row">
		<div class="col-sm-3">
			<h6>Total Orders</h6>
			<h6>
				<?php             
				if(!empty($a)){
	              echo $a;
	            }else{
	              echo 0;
	            }?>
            </h6>
		</div>
		<div class="col-sm-3">
			<div class="total-cost">
				<h6>Total Cost without parcent</h6>
				<h6>
					<?php 
					if(empty($row["sum(cost)"])){
						echo 0;
					}else{
						echo $row["sum(cost)"]. ' Tk';
					}
				?></h6>				
			</div>
		</div>
		<div class="col-sm-4">
			<div class="total-cost-2">
				<h6>Total Parcent</h6>
				<h6>
				<?php
					if(!empty($sum)){
						echo $sum. ' Tk';
					}else{
						echo '0';
					}
				?>
				</h6>
			</div>
		</div>

		<div class="col-sm-2">
			<div class="total-return">
				<h6>Total Return</h6>
				<h6>
				<?php
					if(!empty($row["sum(cost)"])){
						echo $row["sum(cost)"]-$sum. ' Tk';
					}else{
						echo '0';
					}
				?>
				</h6>
			</div>
		</div>

	</div>
</div>	
<?php $i++;endwhile;endif;?>	  
</div>			             
         </div> 
      </div>
    </div>

  </section><!-- end of .main-content -->

<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/semantic.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script src="js/ie10-viewport-bug-workaround.js"></script>
<script src="owl.carousel/owl.carousel.min.js"></script>
<script src="nivo.slider/nivo.slider.js"></script>
<script src="js/wow.min.js"></script>

<script src="js/main.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.datepicker').datepicker({
  format: 'mm/dd/yyyy',
  startDate: '-3d'
})
}); 

</script>
</body>
</html>