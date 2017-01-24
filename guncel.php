<!-- <html lang="en">
<head>
    <title>Anadolu Gündem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-success">
    <div class="alert alert-success" role="alert">
        <h2>Ders Materyal Bilgileri</h2>
    </div>
    <?php
    $lesson = $_POST["lesson"];
//    $lesson=substr($lesson,0,7);

    function strtouppertr($str)
    {
        return mb_convert_case(str_replace('i', 'İ', $str), MB_CASE_UPPER, "UTF-8");
    }

    $a = file_get_contents("https://docs.google.com/spreadsheets/d/15tFpejInZHg6zWSNK5D_7RTL-H2ILiMWe-jn32gJk_4/edit#gid=2077995075");
    $a = str_replace("\n", "", $a);
    $a = str_replace("/*O_o*/google.visualization.Query.setResponse(", "", $a);
    $a = substr($a, 0, -2);
    $a = json_decode($a, true);

    $ref = [
        ["name" => "Dersin Kodu", "id" => 0],
        ["name" => "Dersin Dönemi", "id" => 2],
        ["name" => "Öğrenci Sayısı", "id" => 3],
        ["name" => "Dersin Adı", "id" => 4],
        ["name" => "Ünite Sayısı", "id" => 5],
        ["name" => "Ders Kitabı", "id" => 6],
        ["name" => "Sesli kitap", "id" => 7],
        ["name" => "Etkileşimli E-kitap", "id" => 8],
        ["name" => "1S1C Sayısı", "id" => 9],
        ["name" => "Ünite Özet Videosu", "id" => 10],
        ["name" => "Ünite Özeti(pdf)", "id" => 11],
        ["name" => "Sesli Özet", "id" => 12],
        ["name" => "Sorularla Öğrenelim", "id" => 13],
        ["name" => "ETV", "id" => 14],
        ["name" => "Deneme sınavı (pdf)", "id" => 15],
        ["name" => "Deneme Sınavları (online)", "id" => 16],
        ["name" => "Alıştırmalar", "id" => 17],
        ["name" => "E Seminer", "id" => 18],
        ["name" => "Ders Tanıtım Videoları", "id" => 19],
        ["name" => "Yaprak Test", "id" => 20],
        ["name" => "Toplam İçerik Sayısı", "id" => 21],
    ];
    echo "<h3>";

    ?>
    <table class="table">

        <?php
        foreach ($a["table"]["rows"] as $dizi) {
            if (strpos($dizi["c"][4]["v"], strtouppertr($lesson)) !== false || strpos($dizi["c"][0]["v"], strtouppertr($lesson)) !== false) {
                echo "<thead> <th>Materyal Adı</th><th>İçerik</th></thead><tbody>";
                foreach ($ref  as $rf)
                { ?>
                    <tr>
                        <td><?=$rf["name"]?></td>
                        <td><?=$dizi["c"][$rf["id"]]["v"]?></td>
                    </tr>
        <?php  }

            }
        } ?>
        </tbody>
    </table>
    <?php
    echo $lesson;

    echo "</h3>";
    ?>
</div>
</body>
</html>
 -->