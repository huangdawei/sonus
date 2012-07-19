<?php 
/**
 * Main Sidebar Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
$url = home_url();
?>

	<div id="logo">
		<a href="<?php echo $url; ?>">
			<img src="<?php echo $url; ?>/wp-content/themes/sonus/library/images/logo.png" alt="SONUS" />
	    </a>
	</div>
	<div class="custom-cat" id="about-link">
		<a href="about">关于 About</a>
	</div>
<?php
    // action hook for placing content above the main asides
    thematic_abovemainasides();

    // action hook creating the primary aside
    thematic_widget_area_primary_aside();	

    // action hook for placing content between primary and secondary aside
    thematic_betweenmainasides();

    // action hook creating the secondary aside
    thematic_widget_area_secondary_aside();		
	
    // action hook for placing content below the main asides
    thematic_belowmainasides(); 
?>