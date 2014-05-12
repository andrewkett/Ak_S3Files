# Magento Amazon S3 Files
Save Magento assets to an Amazon S3 bucket

*NOTE:* This extension is in its very early stages and it is not recommended for production sites.

## Installation.

### Using composer


This extension is designed to be installed with composer. It is not yet in a composer repository so you will have to add the git repository to your composer.json file.

    {
        "repositories": [
            {
              "type":"git",
              "url":"https://github.com/andrewkett/Ak_S3Files.git"
            }
        ],
        "require": {
            "andrewkett/s3files" : "dev-master"
        }
    }

then

    composer install


### Download and install manually.

[https://github.com/andrewkett/Ak_S3Files/archive/master.zip](https://github.com/andrewkett/Ak_S3Files/archive/master.zip)

Installing this way is not recommended. You will also need to add the Amazon AWS SDK and load the appropriate files


## Licence
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

## Copyright
(c) 2014 Andrew Kett