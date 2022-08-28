<?php 
include('top.php');
$msg="";
$category="";

$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=$_GET['id'];
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from category where id='$id'"));
	$category=$row['category'];
	$order_number=$row['Serial'];
}

if(isset($_POST['submit'])){
	$category=$_POST['category'];
	
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$sql="select * from category where category='$category'";
	}else{
		$sql="select * from category where category='$category' and id!='$id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Category already added";
	}else{
		if($id==''){
			mysqli_query($con,"insert into category(category,status,added_on) values('$category',1,'$added_on')");
		}else{
			mysqli_query($con,"update category set category='$category' where id='$id'");
		}
		
		redirect('category.php');
	}
}
function redirect($link){
	?>
	<script>
	window.location.href='<?php echo $link?>';
	</script>
	<?php
	die();
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <input type="text" class="form-control" placeholder="Category" name="category" required value="<?php echo $category?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                 <?php /*  <div class="form-group">
                      <label for="exampleInputEmail3" required>Order Number</label>
                      <input type="textbox" class="form-control" placeholder="Order Number" name="Serial"  value="<?php echo $order_number?>">
                    </div>*/?>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>