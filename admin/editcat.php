<?PHP include 'inc/header.php';?>
<?PHP include 'inc/sidebar.php';?>
<?php
if(!isset($_GET['catid'])||$_GET['catid']==NULL){
	echo "<script>window.location='catlist.php';</script>";
	//header("Location:catlist.php")
}else{
	$id=$_GET['catid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update New Category</h2>
               <div class="block copyblock">
<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
	$name=$_POST['name'];
	$name=mysqli_real_escape_string($db->link,$name);
	if(empty($name)){
	echo "<span class='error'>Field must not empty!</span>";
	}else{
		$query="update tbl_category set name='$name' where id='$id'";
		$update_row=$db->update($query);
		if($update_row){
		echo "<span class='success'>Category updated successfully</span>";
		echo "<script>window.location='catlist.php';</script>";//direct to back	
		}else{
		echo "<span class='error'>Category not updateed!</span>";		
			
		}
	}
	}
?>	
<?php
$query="select * from tbl_category where id='$id' order by id desc";
$category=$db->select($query);
while($result=$category->fetch_assoc()){

?>
		   
 <form action="" method="post">
	<table class="form">					
		<tr>
			<td>
				<input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
				
			</td>
		</tr>
		<tr> 
			<td>
				<input type="submit" name="submit" Value="Save" />
			</td>
		</tr>
	</table>
	</form>
<?php }?>
                </div>
            </div>
        </div>
<?PHP include 'inc/footer.php';?>