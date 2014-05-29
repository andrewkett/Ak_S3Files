<?php

class Ak_S3files_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATH_S3_MEDIABUCKET = "ak_s3files_aws/s3/media_bucket";
    const XML_PATH_S3_ENABLED = "ak_s3files_aws/s3/enabled";


    /**
     * Check if a file path looks like an s3 path, e.g s3://{bucketname}
     *
     * @param $path
     * @return bool
     */
    public function pathIsS3($path)
    {
        return strpos($path, 's3://') === 0;
    }

    /**
     * Get the path to the s3 media directory
     * e.g s3://mybucketname/media
     *
     * @return string
     */
    public function getMediaDir()
    {
        return 's3://'.Mage::getStoreConfig(self::XML_PATH_S3_MEDIABUCKET).'/media';
    }


    /**
     * Is s3 storage enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) Mage::getStoreConfig(self::XML_PATH_S3_ENABLED);
    }
}
