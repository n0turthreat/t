<?php
require '/var/www/esb-loop-lite/api/assets_b/aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$s3 = new S3Client([
    'region' => 'sgp1',
    'version' => 'latest',
    'endpoint' => 'https://oss-ap-southeast-5.aliyuncs.com',
    'credentials' => [
        'key'    => "LTAI5tQjXJCUe19wcx6zNkhM",
        'secret' => "NWkSljHtRLEO07vIZU9Y4sEa8v30KN"
    ],
]);

// $buckets = $s3->listBuckets();
// foreach ($buckets['Buckets'] as $bucket) {
//     echo $bucket['Name'] . "\n";
// }

$bucket = 'esb-loop-lite';


try {
    $results = $s3->getPaginator('ListObjects', [
        'Bucket' => $bucket
    ]);

    foreach ($results as $result) {
        foreach ($result['Contents'] as $object) {
            echo $object['Key'] . PHP_EOL;
            break;
        }
    }
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
