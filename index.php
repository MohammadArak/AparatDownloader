<?php
	if(isset($_GET['url']))
	{
		include 'aparat.class.php';
		$aparat = new aparatDownloader();
		$result = $aparat->getVideo($_GET['url']);
		echo json_encode($result);
	}
	else
		echo "No aparat url found!";
?>
