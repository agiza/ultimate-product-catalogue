<?php 
		$Color = get_option("UPCP_Color_Scheme");
		$Links = get_option("UPCP_Product_Links");
		$Tags = get_option("UPCP_Tag_Logic");
		$Filter = get_option("UPCP_Filter_Type");
		$ReadMore = get_option("UPCP_Read_More");
		$Detail_Desc_Chars = get_option("UPCP_Desc_Chars");
		$Single_Page_Price = get_option("UPCP_Single_Page_Price");
		$PrettyLinks = get_option("UPCP_Pretty_Links");
		$Detail_Image = get_option("UPCP_Details_Image");
		$MobileStyle = get_option("UPCP_Mobile_SS");
		$CaseInsensitiveSearch = get_option("UPCP_Case_Insensitive_Search");
		$InstallVersion = get_option("UPCP_First_Install_Version");
		$Custom_Product_Page = get_option("UPCP_Custom_Product_Page");
		$Product_Search = get_option("UPCP_Product_Search");
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div><h2>Settings</h2>

<form method="post" action="admin.php?page=UPCP-options&DisplayPage=Options&Action=UPCP_UpdateOptions">
<table class="form-table">
<tr>
<th scope="row">Catalogue Color</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Catalogue Color</span></legend>
	<label title='Blue'><input type='radio' name='color_scheme' value='Blue' <?php if($Color == "Blue") {echo "checked='checked'";} ?> /> <span>Blue</span></label><br />
	<label title='Black'><input type='radio' name='color_scheme' value='Black' <?php if($Color == "Black") {echo "checked='checked'";} ?> /> <span>Black</span></label><br />
	<label title='Grey'><input type='radio' name='color_scheme' value='Grey' <?php if($Color == "Grey") {echo "checked='checked'";} ?> /> <span>Grey</span></label><br />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Product Links</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Product Links</span></legend>
	<label title='Same'><input type='radio' name='product_links' value='Same' <?php if($Links == "Same") {echo "checked='checked'";} ?> /> <span>Open in Same Window</span></label><br />
	<label title='New'><input type='radio' name='product_links' value='New' <?php if($Links == "New") {echo "checked='checked'";} ?> /> <span>Open in New Window</span></label><br />
	<!--<label title='External'><input type='radio' name='product_links' value='External' <?php if($Links == "External") {echo "checked='checked'";} ?> /> <span>Open External Links Only in New Window</span></label><br />-->
	</fieldset>
</td>
</tr>
<?php if ($InstallVersion <= 2.0) { ?>
<tr>
<th scope="row">Pretty Permalinks</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Use Pretty Permalinks for Product Pages</span></legend>
	<label title='Yes'><input type='radio' name='pretty_links' value='Yes' <?php if($PrettyLinks == "Yes") {echo "checked='checked'";} ?> /> <span>Yes</span></label><br />
	<label title='No'><input type='radio' name='pretty_links' value='No' <?php if($PrettyLinks == "No") {echo "checked='checked'";} ?> /> <span>No</span></label><br />
	</fieldset>
</td>
</tr>
<?php } ?>
<tr>
<th scope="row">Read More</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>"Read More" for Details view</span></legend>
	<label title='Yes'><input type='radio' name='read_more' value='Yes' <?php if($ReadMore == "Yes") {echo "checked='checked'";} ?> /> <span>Yes</span></label><br />
	<label title='No'><input type='radio' name='read_more' value='No' <?php if($ReadMore == "No") {echo "checked='checked'";} ?> /> <span>No</span></label><br />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Product Page Price</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Put Prices on the Single Product Pages</span></legend>
	<label title='Yes'><input type='radio' name='single_page_price' value='Yes' <?php if($Single_Page_Price == "Yes") {echo "checked='checked'";} ?> /> <span>Yes</span></label><br />
	<label title='No'><input type='radio' name='single_page_price' value='No' <?php if($Single_Page_Price == "No") {echo "checked='checked'";} ?> /> <span>No</span></label><br />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Characters in Details Description</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Characters in "Details" Description</span></legend>
	<input type='text' name='desc_count' value='<?php echo $Detail_Desc_Chars; ?>'/>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Custom "Details" icon</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Image to use instead of "Details" (Optional)</span></legend>
	<input id="Details_Image" type="text" size="36" name="Details_Image" value='<?php if ($Detail_Image == "") {echo "http://";} else {echo $Detail_Image;} ?>' /> 
  <input id="Details_Image_button" class="button" type="button" value="Upload Image" />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Filtering Type</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Filtering Type</span></legend>
	<label title='Javascript'><input type='radio' name='filter_type' value='Javascript' <?php if($Filter == "Javascript") {echo "checked='checked'";} ?> /> <span>Javascript Filtering</span></label><br />
	<label title='AJAX'><input type='radio' name='filter_type' value='AJAX' <?php if($Filter == "AJAX") {echo "checked='checked'";} ?> /> <span>AJAX Filtering</span></label><br />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Case Insensitive Search (AJAX Only)</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Compare only the letters and not their case in AJAX search</span></legend>
	<label title='Javascript'><input type='radio' name='case_insensitive_search' value='Yes' <?php if($CaseInsensitiveSearch == "Yes") {echo "checked='checked'";} ?> /> <span>Yes</span></label><br />
	<label title='AJAX'><input type='radio' name='case_insensitive_search' value='No' <?php if($CaseInsensitiveSearch == "No") {echo "checked='checked'";} ?> /> <span>No</span></label><br />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Tag Logic (for javascript filtering)</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Tag LogicTag Logic (for javascript filtering)</span></legend>
	<label title='AND'><input type='radio' name='tag_logic' value='AND' <?php if($Tags == "AND") {echo "checked='checked'";} ?> /> <span>Selected Tags use 'AND'</span></label><br />
	<label title='OR'><input type='radio' name='tag_logic' value='OR' <?php if($Tags == "OR") {echo "checked='checked'";} ?> /> <span>Selected Tags use 'OR'</span></label><br />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Product Search</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Product Search</span></legend>
	<label title='Name'><input type='radio' name='product_search' value='name' <?php if($Product_Search == "name") {echo "checked='checked'";} ?> /> <span>Name Only</span></label><br />
	<label title='Name-and-Desc'><input type='radio' name='product_search' value='namedesc' <?php if($Product_Search == "namedesc") {echo "checked='checked'";} ?> /> <span>Name and Description</span></label><br />
	<label title='Name-Desc-and-Cust'><input type='radio' name='product_search' value='namedesccust' <?php if($Product_Search == "namedesccust") {echo "checked='checked'";} ?> /> <span>Name, Description and Custom Fields</span></label><br />
	</fieldset>
</td>
</tr>
</table>
<h3>Premium Options</h3>
<?php if ($InstallVersion >= 2.1) { ?>
<table class="form-table">
<tr>
<th scope="row">Pretty Permalinks</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Use Pretty Permalinks for Product Pages</span></legend>
	<label title='Yes'><input type='radio' name='pretty_links' value='Yes' <?php if($PrettyLinks == "Yes") {echo "checked='checked'";} ?> <?php if ($Full_Version != "Yes") {echo "disabled";} ?>/> <span>Yes</span></label><br />
	<label title='No'><input type='radio' name='pretty_links' value='No' <?php if($PrettyLinks == "No") {echo "checked='checked'";} ?> <?php if ($Full_Version != "Yes") {echo "disabled";} ?>/> <span>No</span></label><br />
	</fieldset>
</td>
</tr>
<?php } ?>
<tr>
<th scope="row">Custom Product Pages</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Use your custom designed page (Product Page tab) instead of the default?</span></legend>
	<label title='Yes'><input type='radio' name='custom_product_page' value='Yes' <?php if($Custom_Product_Page == "Yes") {echo "checked='checked'";} ?> /> <span>Yes</span></label><br />
	<label title='No'><input type='radio' name='custom_product_page' value='No' <?php if($Custom_Product_Page == "No") {echo "checked='checked'";} ?> /> <span>No</span></label><br />
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Mobile Stylesheet</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Use Mobile Stylesheet (for screens under 480 pixels)</span></legend>
	<label title='Yes'><input type='radio' name='mobile_styles' value='Yes' <?php if($MobileStyle == "Yes") {echo "checked='checked'";} ?> <?php if ($Full_Version != "Yes") {echo "disabled";} ?>/> <span>Yes</span></label><br />
	<label title='No'><input type='radio' name='mobile_styles' value='No' <?php if($MobileStyle == "No") {echo "checked='checked'";} ?> <?php if ($Full_Version != "Yes") {echo "disabled";} ?>/> <span>No</span></label><br />
	</fieldset>
</td>
</tr>

</table>


<p class="submit"><input type="submit" name="Options_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</div>