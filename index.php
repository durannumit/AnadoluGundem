<?php
require_once __DIR__.'/bootstap.php';

//session_destroy();

if (isset($_POST))
    header("location:main.php");

$mattur = $_POST["mt"];
$aciklama = $_POST["aciklama"];
$talep = $_POST["talep"];




$client = new Google_Client();
$client->setAuthConfig('client_secret.json');
$client->addScope(Google_Service_Drive::SHEETS);
$guzzleClient = new
				\GuzzleHttp
				\Client(
				array(	'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));

$client->setHttpClient($guzzleClient);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

	$client->setAccessToken($_SESSION['access_token']);

// Google Drive Üstünde İşlem Yapmak İstersen
	$drive_service = new Google_Service_Drive($client);

	// Drive'daki dosyları listeleme
	$files_list = $drive_service->files->listFiles(array())->getFiles();
	foreach ($files_list as $file) { }

// Sheets API Kullanmak için
	$service = new Google_Service_Sheets($client);

	// Prints the names and majors of students in a sample spreadsheet:
	// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit

	$spreadsheetId 	= '15tFpejInZHg6zWSNK5D_7RTL-H2ILiMWe-jn32gJk_4';
    



//	Veri Güncelleme	------------------------------------------------------------------------
	$requests[] = new Google_Service_Sheets_Request(array(
		'findReplace' => array(
			'find' 			=> 'Aranacak Kelime',
			'replacement' 	=> 'Bulunca Yerine yazılacak kelime ',
			'allSheets' 	=> TRUE
		)
	));

	$batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array( 'requests' => $requests ));
	$response 			= $service->spreadsheets->batchUpdate($spreadsheetId,	$batchUpdateRequest);


//	Veri Ekleme	------------------------------------------------------------------------

    if ($mattur=="Yardım Masası"){
        $range 			= 'YardimMasasi!A1:B';
        $sheetid="YardimMasasi";
    }
    else if ($mattur=="E-kampüs Teknik"){
        $range 			= 'E-kampusTeknik!A1:B';
        $sheetid="E-kampusTeknik";
    }
    else if ($mattur=="Sor-İzle-Öğren"){
        $range 			= 'Sor-Izle-Ogren!A1:B';
        $sheetid="Sor-Izle-Ogren";
    }
    else if ($mattur=="Merkez Büro"){
        $range 			= 'MerkezBuro!A1:B';
        $sheetid="MerkezBuro";
    }
    else if ($mattur=="Sosyal Medya"){
        $range 			= 'SosyalMedya!A1:B';
        $sheetid="SosyalMedya";
    }
    else if ($mattur=="Aof Bilgi"){
        $range 			= 'AofBilgi!A1:B';
        $sheetid="AofBilgi";
    }
    else if ($mattur=="Çağrı Merkezi"){
        $range 			= 'CagriMerkezi!A1:B';
        $sheetid="CagriMerkezi";
    }
    else {
        $range 			= 'Veriler!A1:B';
        $sheetid="Veriler";

    }
	$add_row 		= count($service->spreadsheets_values->get($spreadsheetId, $range)->getValues()) + 1;
    $add_range 		=  $sheetid.'!A'.$add_row;



    $values = array(
		array(
            $mattur,
            $aciklama,
            $talep
		)
	);
	$body 	= new Google_Service_Sheets_ValueRange(array( 'values' => $values ));
	$params = array( 'valueInputOption' => "RAW" );
	$result = $service->spreadsheets_values->update($spreadsheetId, $add_range,	$body, $params);

    $add_row 		= count($service->spreadsheets_values->get($spreadsheetId, 'Veriler!A1:B')->getValues()) + 1;
    $add_range 		=  'Veriler!A'.$add_row;
    $result = $service->spreadsheets_values->update($spreadsheetId, $add_range,	$body, $params);


//// Verileri Listeleme ------------------------------------------------------------------------
//	$respoanse 	= $service->spreadsheets_values->get($spreadsheetId, $range);
//	$values 	= $response->getValues();
//
//	if (count($values) == 0) {
//		print "Veri bulunmadı. <br>";
//	} else {
//		echo '<table border="1" width="500">';
//
//			echo '<tr>';
//				echo '<th>Ad</th>';
//				echo '<th>Sınıf</th>';
//				echo '<th>Branş</th>';
//			echo '</tr>';
//
//			foreach ($values as $row) {
//				echo '<tr>';
//					echo '<td>'.$row[0].'</td> <td>'.$row[2].'</td> <td>'.$row[3].'</td>';
//				echo '</tr>';
//			}
//
//		echo '</table>';
//	}

} else {
	$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'].'/callback.php';
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}