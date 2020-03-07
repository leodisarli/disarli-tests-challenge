<?php

namespace App\Helpers;

use Aws\S3\S3Client;

class AwsBucketHelper
{
    /**
     * constructor
     * @param S3Client $s3Client
     */
    public function __construct(
        S3Client $s3Client
    ) {
        $this->s3Client = $s3Client;
    }

    /**
     * putFile into AwsBucketHelper
     * @param string $filePatch patch of the file
     * @param string $extension file extension
     * @return string
     */
    public function putFile(
        string $filePatch,
        string $extension
    ) {
        $fileName = md5(basename($filePatch). '-' . rand(1, 9999)) . '.' . $extension;
        $s3Config = config('amazon.s3');

        $result = $this->s3Client->putObject([
            'Bucket' => $s3Config['bucket'],
            'Key' => $fileName,
            'SourceFile' => $filePatch,
            'ContentType' => 'text/csv',
            'ACL' => 'public-read',
        ])->toArray();
        unlink($filePatch);
        return $result['ObjectURL'];
    }

    /**
     * list all file of AwsBucketHelper
     * @return array
     */
    public function listFiles()
    {
        $s3Config = config('amazon.s3');
        $objects = $this->s3Client->listObjects([
            'Bucket' => $s3Config['bucket'],
        ])->toArray();

        return $objects;
    }

    /**
     * delete files of AwsBucketHelper
     * @param string $fileName key of the file
     * @return string
     */
    public function deleteFile(
        string $fileName
    ) {
        $s3Config = config('amazon.s3');
        $deleteFile = $this->s3Client->deleteObject([
            'Bucket' => $s3Config['bucket'],
            'Key' => $fileName,
        ])->toArray();
        
        return $deleteFile;
    }
}
