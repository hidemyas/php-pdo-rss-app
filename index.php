<?php
header('Content-Type: text/xmlns');
try {
    $db_connect = new PDO('mysql:dbname=egtim;host=localhost;charset=utf8', 'root', '');
} catch (PDOException $exception) {
    echo "MYSQL Bağlantı Hatası <br/>";
    echo "Hata Açıklaması : " . $exception->getMessage();
    die();
}

echo "<?xml version='1.0' encoding='UTF-8' ?>
<rss xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' version='2.0' >";
echo "<channel>
       <title>XML Başlığı </title>
       <description>İleri Seviye Eğtim </description>
       <link>http://www.hidemyas.org</link>
       <language>tr</language>
";
$query  =   $db_connect->prepare('SELECT * FROM urunler');
$query->execute();
$row_count  =   $query->rowCount();
$products   =   $query->fetchAll(PDO::FETCH_ASSOC);

if ($row_count>0){
    foreach ($products as $product){
        echo "<item>
        <title>".$product['urunadi']."</title>
        <price>".$product['ufunfiyati']."<item>
        </item>";
    }
}
echo "</channel>
</rss>";
$db_connect = null;