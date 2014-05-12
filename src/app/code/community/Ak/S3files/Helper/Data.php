<?php

class Ak_S3files_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function pathIsS3($path)
    {
        return true; //@todo if path contains s3:// return true else return false
    }


}