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


##Configuration

Configuration requires a few steps

* Set up an amazon S3 bucket as an endpoint for your media.
* Create an IAM user for the magento site and generate a key.
* Add bucket policy to allow the magento site all access and allow anybody to read your media. e.g something like this:
```
{
	"Version": "2008-10-17",
	"Id": "Policy12345689",
	"Statement": [
		{
			"Sid": "Stmt123457870845754",
			"Effect": "Allow",
			"Principal": {
				"AWS": "arn:aws:iam::123456789:user/s3mediauser"
			},
			"Action": "s3:*",
			"Resource": "arn:aws:s3:::mymagentomediadirectoy/media/*"
		},
		{
			"Sid": "Stmt123457870845754",
			"Effect": "Allow",
			"Principal": {
				"AWS": "*"
			},
			"Action": "s3:GetObject",
			"Resource": "arn:aws:s3:::mymagentomediadirectoy/media/*"
		}
	]
}
``` 
* You then need to add the bucket name and s3 user key to the s3files settings in magento
* The final step is to update magentos media directory to that of the s3 bucket. It will be something like this, http://s3-ap-southeast-2.amazonaws.com/mymagentomediadirectoy/media/



## Licence
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

## Copyright
(c) 2014 Andrew Kett