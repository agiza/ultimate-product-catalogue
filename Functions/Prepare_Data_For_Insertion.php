<?php
/* Prepare the data to add or edit a single product */
function Add_Edit_Product() {
		/* Test if there is an error with the uploaded image and return that error if there is */
		if (!empty($_FILES['Item_Image']['error']))
		{
				switch($_FILES['Item_Image']['error'])
				{

				case '1':
						$error = __('The uploaded file exceeds the upload_max_filesize directive in php.ini', 'UPCP');
						break;
				case '2':
						$error = __('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form', 'UPCP');
						break;
				case '3':
						$error = __('The uploaded file was only partially uploaded', 'UPCP');
						break;
				case '4':
						$error = __('No file was uploaded.', 'UPCP');
						break;

				case '6':
						$error = __('Missing a temporary folder', 'UPCP');
						break;
				case '7':
						$error = __('Failed to write file to disk', 'UPCP');
						break;
				case '8':
						$error = __('File upload stopped by extension', 'UPCP');
						break;
				case '999':
						default:
						$error = __('No error code avaiable', 'UPCP');
				}
		}
		/* Make sure that the file exists */ 	
		elseif (empty($_FILES['Item_Image']['tmp_name']) || $_FILES['Item_Image']['tmp_name'] == 'none') {
				$error = __("no file was uploaded...", 'UPCP');
		}
		/* Make sure that the file is the correct type, then move it and store the URL */ 	
		else {
				if (($_FILES["Item_Image"]["type"] == "image/gif")
				|| ($_FILES["Item_Image"]["type"] == "image/jpeg")
				|| ($_FILES["Item_Image"]["type"] == "image/pjpeg")
				|| ($_FILES["Item_Image"]["type"] == "image/png")) {
				 
				 	  $msg .= $_FILES['Item_Image']['name'];
						//for security reason, we force to remove all uploaded file
						$target_path = ABSPATH . 'wp-content/plugins/ultimate-product-catalogue/images/';

						$target_path = $target_path . basename( $_FILES['Item_Image']['name']); 

						if (!move_uploaded_file($_FILES['Item_Image']['tmp_name'], $target_path)) {
						//if (!$upload = wp_upload_bits($_FILES["Item_Image"]["name"], null, file_get_contents($_FILES["Item_Image"]["tmp_name"]))) {
				 			  $error .= __("There was an error uploading the file, please try again!", 'UPCP');
						}
						else {
				 				$ImageURL = get_bloginfo('url') . '/wp-content/plugins/ultimate-product-catalogue/images/' . basename( $_FILES['Item_Image']['name']);
						}
				}			
		}
		/* Keep the current photo if none was uploaded */
		if ($ImageURL == "") {$ImageURL = $_POST['Current_Image_URL'];}
		
		/* Process the $_POST data where neccessary before storage */
		$Item_ID = $_POST['Item_ID'];
		$Item_Name = stripslashes_deep($_POST['Item_Name']);
		$Item_Photo_URL = $ImageURL;
		$Item_Description = stripslashes_deep($_POST['Item_Description']);
		$Item_Price = $_POST['Item_Price'];
		$Category_ID = $_POST['Category_ID'];
		$Global_Item_ID = $_POST['Global_Item_ID'];
		$Item_Special_Attr = $_POST['Item_Special_Attr'];
		$Tags = $_POST['Tags'];
		if ($Tags == "") {$Tags = array();}
		$SubCategory_ID = $_POST['SubCategory_ID'];

		if (!isset($error) or $error == __('No file was uploaded.', 'UPCP')) {
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the product */
				if ($_POST['action'] == "Add_Product") {
					  $user_update = Add_UPCP_Product($Item_Name, $Item_Photo_URL, $Item_Description, $Item_Price, $Category_ID, $Global_Item_ID, $Item_Special_Attr, $SubCategory_ID, $Tags);
				}
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to edit the product */
				else {
						$user_update = Edit_UPCP_Product($Item_ID, $Item_Name, $Item_Photo_URL, $Item_Description, $Item_Price, $Category_ID, $Global_Item_ID, $Item_Special_Attr, $SubCategory_ID, $Tags);
				}
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		/* Return any error that might have occurred */
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}
/* Prepare the data to add multiple products from a spreadsheet */
function Add_Products_From_Spreadsheet() {
		
		/* Test if there is an error with the uploaded spreadsheet and return that error if there is */
		if (!empty($_FILES['Products_Spreadsheet']['error']))
		{
				switch($_FILES['Products_Spreadsheet']['error'])
				{

				case '1':
						$error = __('The uploaded file exceeds the upload_max_filesize directive in php.ini', 'UPCP');
						break;
				case '2':
						$error = __('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form', 'UPCP');
						break;
				case '3':
						$error = __('The uploaded file was only partially uploaded', 'UPCP');
						break;
				case '4':
						$error = __('No file was uploaded.', 'UPCP');
						break;

				case '6':
						$error = __('Missing a temporary folder', 'UPCP');
						break;
				case '7':
						$error = __('Failed to write file to disk', 'UPCP');
						break;
				case '8':
						$error = __('File upload stopped by extension', 'UPCP');
						break;
				case '999':
						default:
						$error = __('No error code avaiable', 'UPCP');
				}
		}
		/* Make sure that the file exists */ 	 	
		elseif (empty($_FILES['Products_Spreadsheet']['tmp_name']) || $_FILES['Products_Spreadsheet']['tmp_name'] == 'none') {
				$error = __('No file was uploaded here..', 'UPCP');
		}
		/* Move the file and store the URL to pass it onwards*/ 	 	
		else {				 
				 	  $msg .= $_FILES['Products_Spreadsheet']['name'];
						//for security reason, we force to remove all uploaded file
						$target_path = ABSPATH . 'wp-content/plugins/ultimate-product-catalogue/product-sheets/';

						$target_path = $target_path . basename( $_FILES['Products_Spreadsheet']['name']); 

						if (!move_uploaded_file($_FILES['Products_Spreadsheet']['tmp_name'], $target_path)) {
						//if (!$upload = wp_upload_bits($_FILES["Item_Image"]["name"], null, file_get_contents($_FILES["Item_Image"]["tmp_name"]))) {
				 			  $error .= "There was an error uploading the file, please try again!";
						}
						else {
				 				$Excel_File_Name = basename( $_FILES['Products_Spreadsheet']['name']);
						}	
		}

		/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the products */
		if (!isset($error)) {
				$user_update = Add_UPCP_Products_From_Spreadsheet($Excel_File_Name);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

function Mass_Delete_Products() {
		$Products = $_POST['Products_Bulk'];
		
		if (is_array($Products)) {
				foreach ($Products as $Product) {
						if ($Product != "") {
								Delete_UPCP_Product($Product);
						}
				}
		}
		
		$update = __("Products have been successfully deleted.", 'UPCP');
		$user_update = array("Message_Type" => "Update", "Message" => $update);
		return $user_update;
}

/* Prepare the data to add a new image for a product */
function Prepare_Add_Product_Image() {
		
		/* Test if there is an error with the uploaded image and return that error if there is */
		if (!empty($_FILES['Item_Image']['error']))
		{
				switch($_FILES['Item_Image']['error'])
				{

				case '1':
						$error = __('The uploaded file exceeds the upload_max_filesize directive in php.ini', 'UPCP');
						break;
				case '2':
						$error = __('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form', 'UPCP');
						break;
				case '3':
						$error = __('The uploaded file was only partially uploaded', 'UPCP');
						break;
				case '4':
						$error = __('No file was uploaded.', 'UPCP');
						break;

				case '6':
						$error = __('Missing a temporary folder', 'UPCP');
						break;
				case '7':
						$error = __('Failed to write file to disk', 'UPCP');
						break;
				case '8':
						$error = __('File upload stopped by extension', 'UPCP');
						break;
				case '999':
						default:
						$error = __('No error code avaiable', 'UPCP');
				}
		}
		/* Make sure that the file exists */ 	  	
		elseif (empty($_FILES['Item_Image']['tmp_name']) || $_FILES['Item_Image']['tmp_name'] == 'none') {
				$error = __("no file was uploaded...", 'UPCP');
		}
		/* Make sure that the file is the correct type, then move it and store the URL */ 	 	
		else {
				if (($_FILES["Item_Image"]["type"] == "image/gif")
				|| ($_FILES["Item_Image"]["type"] == "image/jpeg")
				|| ($_FILES["Item_Image"]["type"] == "image/pjpeg")
				|| ($_FILES["Item_Image"]["type"] == "image/png")) {
				 
				 	  $msg .= $_FILES['Item_Image']['name'];
						//for security reason, we force to remove all uploaded file
						$target_path = ABSPATH . 'wp-content/plugins/ultimate-product-catalogue/images/';

						$target_path = $target_path . basename( $_FILES['Item_Image']['name']); 

						if (!move_uploaded_file($_FILES['Item_Image']['tmp_name'], $target_path)) {
						//if (!$upload = wp_upload_bits($_FILES["Item_Image"]["name"], null, file_get_contents($_FILES["Item_Image"]["tmp_name"]))) {
				 			  $error .= "There was an error uploading the file, please try again!";
						}
						else {
				 				$ImageURL = get_bloginfo('url') . '/wp-content/plugins/ultimate-product-catalogue/images/' . basename( $_FILES['Item_Image']['name']);
						}
				}			
		}
		/* Double check that everything worked correctly in moving the file */
		if ($ImageURL == "") {
			  $user_update = "Picture failed to load."; 
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		} 
		
		/* Process the $_POST data where neccessary before storage */
		$Item_ID = $_POST['Item_ID'];
		$Item_Image_Description = $_POST['Item_Image_Description'];
		
		/* Pass the data to the appropriate function in Update_Admin_Databases.php to add the link to the image */
		if (!isset($error) or $error == 'No file was uploaded.') {
				$user_update = Add_Product_Image($Item_ID, $ImageURL, $Item_Image_Description);
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

/* Prepare the data to add a new category */
function Add_Edit_Category() {
		/* Process the $_POST data where neccessary before storage */
		$Category_Name = stripslashes_deep($_POST['Category_Name']);
		$Category_Description = stripslashes_deep($_POST['Category_Description']);
		$Category_ID = $_POST['Category_ID'];

		if (!isset($error)) {
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the category */
				if ($_POST['action'] == "Add_Category") {
					  $user_update = Add_UPCP_Category($Category_Name, $Category_Description);
				}
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to edit the category */
				else {
						$user_update = Edit_UPCP_Category($Category_ID, $Category_Name, $Category_Description);
				}
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

function Mass_Delete_Categories() {
		$Cats = $_POST['Cats_Bulk'];
		
		if (is_array($Cats)) {
				foreach ($Cats as $Cat) {
						if ($Cat != "") {
								Delete_UPCP_Category($Cat);
						}
				}
		}
		
		$update = __("Categories have been successfully deleted.", 'UPCP');
		$user_update = array("Message_Type" => "Update", "Message" => $update);
		return $user_update;
}

/* Prepare the data to add a new sub-category */
function Add_Edit_SubCategory() {
		/* Process the $_POST data where neccessary before storage */
		$SubCategory_Name = stripslashes_deep($_POST['SubCategory_Name']);
		$Category_ID = $_POST['Category_ID'];
		$SubCategory_Description = stripslashes_deep($_POST['SubCategory_Description']);
		$SubCategory_ID = $_POST['SubCategory_ID'];

		if (!isset($error)) {
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the sub-category */
				if ($_POST['action'] == "Add_SubCategory") {
					  $user_update = Add_UPCP_SubCategory($SubCategory_Name, $Category_ID, $SubCategory_Description);
				}
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to edit the sub-category */
				else {
						$user_update = Edit_UPCP_SubCategory($SubCategory_ID, $SubCategory_Name, $Category_ID, $SubCategory_Description);
				}
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

function Mass_Delete_SubCategories() {
		$Subs = $_POST['Subs_Bulk'];
		
		if (is_array($Subs)) {
				foreach ($Subs as $Sub) {
						if ($Sub != "") {
								Delete_UPCP_SubCategory($Sub);
						}
				}
		}
		
		$update = __("Sub-Categories have been successfully deleted.", 'UPCP');
		$user_update = array("Message_Type" => "Update", "Message" => $update);
		return $user_update;
}

/* Prepare the data to add a new tag */
function Add_Edit_Tag() {
		/* Process the $_POST data where neccessary before storage */
		$Tag_Name = stripslashes_deep($_POST['Tag_Name']);
		$Tag_Description = stripslashes_deep($_POST['Tag_Description']);
		$Tag_ID = $_POST['Tag_ID'];

		if (!isset($error)) {
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the tag */
				if ($_POST['action'] == "Add_Tag") {
					  $user_update = Add_UPCP_Tag($Tag_Name, $Tag_Description);
				}
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to edit the tag */
				else {
						$user_update = Edit_UPCP_Tag($Tag_ID, $Tag_Name, $Tag_Description);
				}
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

function Mass_Delete_UPCP_Tags() {
		$Tags = $_POST['Tags_Bulk'];
		
		if (is_array($Tags)) {
				foreach ($Tags as $Tag) {
						if ($Tag != "") {
								Delete_UPCP_Tag($Tag);
						}
				}
		}
		
		$update = __("Tag(s) have been successfully deleted.", 'UPCP');
		$user_update = array("Message_Type" => "Update", "Message" => $update);
		return $user_update;
}

/* Prepare the data to add a new catalogue */
function Add_Edit_Catalogue() {
		/* Process the $_POST data where neccessary before storage */
		$Catalogue_Name = stripslashes_deep($_POST['Catalogue_Name']);
		$Catalogue_Description = stripslashes_deep($_POST['Catalogue_Description']);
		$Catalogue_Layout_Format = stripslashes_deep($_POST['Catalogue_Layout_Format']);
		$Catalogue_Custom_CSS = stripslashes_deep($_POST['Catalogue_Custom_CSS']);
		$Catalogue_ID = $_POST['Catalogue_ID'];

		if (!isset($error)) {
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the catalogue */
				if ($_POST['action'] == "Add_Catalogue") {
					  $user_update = Add_UPCP_Catalogue($Catalogue_Name, $Catalogue_Description);
				}
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to edit the catalogue */
				else {
						$user_update = Edit_UPCP_Catalogue($Catalogue_ID, $Catalogue_Name, $Catalogue_Description, $Catalogue_Layout_Format, $Catalogue_Custom_CSS);
				}
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

function Mass_Delete_Catalogues() {
		$Catalogues = $_POST['Catalogues_Bulk'];
		
		if (is_array($Catalogues)) {
				foreach ($Catalogues as $Catalogue) {
						if ($Catalogue != "") {
								Delete_UPCP_Catalogue($Catalogue);
						}
				}
		}
		
		$update = __("Catalogues have been successfully deleted.", 'UPCP');
		$user_update = array("Message_Type" => "Update", "Message" => $update);
		return $user_update;
}
?>
