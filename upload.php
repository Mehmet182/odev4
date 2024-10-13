<?php
// AWS SDK for PHP için gerekli kütüphaneleri yükleyin
require 'vendor/autoload.php';

use Aws\S3\S3Client;

$bucket = 'YOUR_BUCKET_NAME';
$imageName = $_FILES['image']['name'];
$tmpName = $_FILES['image']['tmp_name'];

// S3'e dosya yükleme
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'YOUR_REGION',
    'credentials' => [
        'key'    => 'YOUR_AWS_ACCESS_KEY',
        'secret' => 'YOUR_AWS_SECRET_KEY',
    ],
]);

$s3->putObject([
    'Bucket' => $bucket,
    'Key'    => $imageName,
    'SourceFile' => $tmpName,
]);

// Veritabanına yazıyı ekleyin
$conn = new mysqli('DB_ENDPOINT', 'DB_USER', 'DB_PASSWORD', 'DB_NAME');
$sql = "INSERT INTO posts (title, content, image) VALUES ('" . $_POST['title'] . "', '" . $_POST['content'] . "', '$imageName')";
$conn->query($sql);
$conn->close();
?>
