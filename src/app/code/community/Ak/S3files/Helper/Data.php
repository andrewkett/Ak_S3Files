<?php

class Ak_S3files_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATH_AWS_MEDIABUCKET = "ak_s3files_aws/s3/media_bucket";

    public function pathIsS3($path)
    {
        return true; //@todo if path contains s3:// return true else return false
    }

    /**
     * Get the path to the s3 media directory
     * e.g s3://mybucketname/media
     *
     * @return string
     */
    public function getMediaDir()
    {
        $path = 's3://'.Mage::getStoreConfig(self::XML_PATH_AWS_MEDIABUCKET);

        //@todo append a subdirectory if it exists in config, e.g s3://mybucketname/{subdirectory}

        return $path;
    }


}