<?php

class Ak_S3files_Helper_Catalog_Image extends Mage_Catalog_Helper_Image
{


    /**
     * Initialize Helper to work with Image
     *
     * @param Mage_Catalog_Model_Product $product
     * @param string $attributeName
     * @param mixed $imageFile
     * @return Mage_Catalog_Helper_Image
     */
    public function init(Mage_Catalog_Model_Product $product, $attributeName, $imageFile = null)
    {

        $this->log('image file is '.$imageFile);

        $this->_reset();
        $this->_setModel(Mage::getModel('catalog/product_image'));
        $this->_getModel()->setDestinationSubdir($attributeName);
        $this->setProduct($product);

        $this->setWatermark(
            Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_image")
        );
        $this->setWatermarkImageOpacity(
            Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_imageOpacity")
        );
        $this->setWatermarkPosition(
            Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_position")
        );
        $this->setWatermarkSize(
            Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_size")
        );

        if ($imageFile) {
            $this->setImageFile($imageFile);
        } else {
            // add for work original size

            //@todo setBaseFile causes an s3 file_exists lookup which is slow when looking up files externally.
            //
            $this->_getModel()->setBaseFile($this->getProduct()->getData($this->_getModel()->getDestinationSubdir()));
        }
        return $this;
    }



    /**
     * Return Image URL
     *
     * @return string
     */
    public function __toString()
    {
        $this->log('-------');
        if (Mage::helper('ak_s3files')->scheduledImageCacheEnabled()) {
            return $this->scheduledImageCacheToString();
        } else {
            return $this->lazyloadImageCacheToString();
        }
    }



    public function lazyloadImageCacheToString() {
        return parent::__toString();

        //        $this->log('-------');
//        try {
//            $model = $this->_getModel();
//
//            if ($this->getImageFile()) {
//                $this->log($this->getImageFile());
//                $model->setBaseFile($this->getImageFile());
//            } else {
//                $this->log($this->getProduct()->getData($model->getDestinationSubdir()));
//                $model->setBaseFile($this->getProduct()->getData($model->getDestinationSubdir()));
//            }
//
//
//            // @todo queue check and thumbnail generation
//            //return $model->getUrl();
//
////            // @problem....
//            if ($model->isCached()) {
//                $this->log('cached');
//                return $model->getUrl();
//            } else {
//                $this->log('not cached');
//
//                // @todo could queue image gen here instead...
//                //return $model->getUrl();
//
//                if ($this->_scheduleRotate) {
//                    $model->rotate($this->getAngle());
//                }
//                $this->log('here1');
//
//                if ($this->_scheduleResize) {
//                    $model->resize();
//                }
//                $this->log('here2');
//                if ($this->getWatermark()) {
//                    $model->setWatermark($this->getWatermark());
//                }
//                $this->log('here3');
//
//                $url = $model->saveFile()->getUrl();
//
//                $this->log('new url is '.$url);
//
//            }
//        } catch (Exception $e) {
//            $this->log('error: '.$e->getMessage());
//            $this->log('falling back to default');
//            $url = Mage::getDesign()->getSkinUrl($this->getPlaceholder());
//        }
//        return $url;
    }

    public function  scheduledImageCacheToString() {
        try {
            $model = $this->_getModel();

            if ($this->getImageFile()) {
                $this->log($this->getImageFile());
                $model->setBaseFile($this->getImageFile());
            } else {
                $this->log($this->getProduct()->getData($model->getDestinationSubdir()));
                $model->setBaseFile($this->getProduct()->getData($model->getDestinationSubdir()));
            }

            return $model->getUrl();

        } catch (Exception $e) {
            $this->log('error: '.$e->getMessage());
            $this->log('falling back to default');
            $url = Mage::getDesign()->getSkinUrl($this->getPlaceholder());
        }
        return $url;
    }

    public function log($msg)
    {
        Mage::helper('ak_s3files')->logImageEdit('Mage_Catalog_Helper_Image: '.$msg);
    }
}