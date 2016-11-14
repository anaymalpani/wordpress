<?php
//-- Get all Comparebars from Database ----------------------------------
//-----------------------------------------------------------------------------
function get_cpbars()
{  
    global $wpdb;$num=1;
	$table_name = $wpdb->prefix . "comparebar"; 
    $cbar_data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
    foreach ($cbar_data as $data) { 
        
        if($data->active == '1')
        { $active='<a href="?page=comparebar&cbar_deactivate='.$data->id.'" class="button">Deactivate</a>';
		  $disabled='';
        }
        else{
			if($data->active == '0'){
				$active='<a href="?page=comparebar&cbar_activate='.$data->id.'" class="button">Activate</a>';
				$disabled='disabled="disabled"';
				}
            }
        
		echo '<tr class="cbar_tr1">
		<td style="width: 60px;text-align:center;padding: 10px;" >'.$data->id.'</td>
		<td style="width: 100px;text-align:center;padding: 10px;" valign="middle"> '.$data->option_name.' </td>
		<td style="width: 250px;text-align:center;padding: 10px;" valign="middle">[comparebar name=\''.$data->option_name.'\']</td>		
		<td style="width: 100px;text-align:center;padding: 10px;" ><a href="?page=cbar_edit&edit='.$data->option_name.'" class="button" '.$disabled.'>Edit</a></td>
		<td style="width: 100px;text-align:center;padding: 10px;"> '.$active.' </td>
		<td style="width: 100px;text-align:center;padding: 10px;" ><a href="?page=comparebar&cbar_delete='.$data->option_name.'" onclick="return cbar_delconfirm(\''.$data->option_name.'\');" class="button cbar_del">Delete</a> </td>
		</tr>';
        $num++;
	}
    ?>
       <form method="post" action="?page=comparebar&add=1">
		   <tr class="cbar_tr2"> 
			   <td><?php echo ($data->id+1); ?> </td>
			   <td><input type="text" id="cbar_option_name" name="cbar_option_name" size="23" />
			   <td><font style="font-size:10px;color:#A40B0B">&nbsp;&nbsp;<?php _e("* Do not use spaces or special characters.",'cbar'); ?></font></td>    
			   </td>
			   <td colspan="3"><input type="submit" class="button-primary cbar_addbutton" value="<?php _e("Add new comparebar"); ?>" /></td>
		   </tr>
       </form>
    <?php
}

//-- Add Comparebar (Function) ------------------------------------------
//-----------------------------------------------------------------------------
function add_comparebar()
{
?>
<div id="cbar_addwrap" class="wrap cbar_wrap"><div class="icon32 cbar_icon"><br /></div>
    <h2><?php _e('Comparebar '.cbar_get_version().' Setting\'s','cbar'); ?></h2>
	<?php
	//comparebar Functions
	if(isset($_GET['add']) && $_GET['add'])
	{
		$option=$_POST['cbar_option_name'];
		if(!get_option($_POST['cbar_option_name']))
		{
		 if($option){
				$option = preg_replace('/[^a-z0-9\s]/i', '', $option);  
				$option = str_replace(" ", "_", $option);
				global $wpdb;
				$table_name = $wpdb->prefix . "comparebar"; 
				 $options = get_option($option);
				if($options)
				{
					$cbar_message= 'Unable to Add Comparebar, please try another name';
				}else{
					$sql = "INSERT INTO " . $table_name . " values ('','".$option."','1');";
					if ($wpdb->query( $sql )){
							add_option($option, cbar_defaults());
							$cbar_message= 'Comparebar successfully added';
						}
					else{
							$cbar_message= 'Unable to Add Comparebar, can not insert Comparebar';
						}
					};
				}else{
						$cbar_message= 'Unable to Add Comparebar';
					}
		}else{
			$cbar_message= 'Unable to Add Comparebar, please try another name';
		}
		?>
	<div class="cbar_updated cbar_add" id="cbar_message"><?php _e($cbar_message,'cbar'); ?></div>
	<?php
	}

	if(isset($_GET['cbar_delete']))
	{
		$option=$_GET['cbar_delete'];
		delete_option($option);
		global $wpdb;
		$table_name = $wpdb->prefix . "comparebar"; 
		$sql = "DELETE FROM " . $table_name . " WHERE option_name='".$option."';";
		$wpdb->query( $sql );
	?>
	<div class="cbar_updated cbar_add" id="cbar_message"><?php _e('Comparebar Deleted','cbar'); ?></div>
	<?php
	}

	if(isset($_GET['cbar_deactivate'])){
		$id=$_GET['cbar_deactivate'];
		global $wpdb;
		$table_name = $wpdb->prefix . "comparebar"; 
		$sql = "UPDATE " . $table_name . " SET active='0' WHERE id='".$id."';";
		$wpdb->query( $sql );
	?>
	<div class="cbar_updated cbar_add" id="cbar_message"><?php _e('Comparebar Deactivated','cbar'); ?></div>
	<?php
	}

	if(isset($_GET['cbar_activate'])){
		$id=$_GET['cbar_activate'];
		global $wpdb;
		$table_name = $wpdb->prefix . "comparebar"; 
		$sql = "UPDATE " . $table_name . " SET active='1' WHERE id='".$id."';";
		$wpdb->query( $sql );
	?>
	<div class="cbar_updated cbar_add" id="cbar_message"><?php _e('Comparebar Activated','cbar'); ?></div>
	<?php
	}
	?>
	<table cellspacing="0" class="cbar_struct">
		<thead>
			<tr>
				<th colspan="6"><?php _e("Table Of Comparebars",'cbar'); ?></th>
			</tr>
			<tr class="cbar_tr">
				<td><?php _e("ID",'cbar'); ?></td>
				<td><?php _e("Compare Bar Name",'cbar'); ?></td>
				<td><?php _e("Shortcode",'cbar'); ?></td>
				<td><?php _e("Edit",'cbar'); ?></td>
				<td><?php _e("Active",'cbar'); ?></td>
				<td><?php _e("Delete",'cbar'); ?></td>
			</tr>
		</thead>
		<tbody>
			<?php
				get_cpbars();
			?>
		</tbody>
	</table>
	
</div>
<iframe class="cbar_iframe" src="http://www.sketchthemes.com/sketch-updates/plugin-updates/cbar-lite/cbar-lite.php" width="250px" height="370px" scrolling="no" ></iframe> 
<?php
}
?>