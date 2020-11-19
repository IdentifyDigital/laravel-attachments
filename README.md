# identifydigital\laravel-attachments

A laravel plugin that allows you to quickly add and work with addresses throughout your laravel application.

## Installation

Install the package through composer:
> composer require identifydigital/laravel-attachments

Run Database Migrations:
> php artisan migrate

## Service Provider

> IdentifyDigital\Attachments\AttachmentsServiceProvider

## Models

### Attachment

> IdentifyDigital\AddressBook\Models\Attachment


## Traits

### HasAttachments

```php
use IdentifyDigital\Attachments\Traits\HasAttachments;

class MyModel extends Model {
   
   use HasAttachments;
   
   ...
   
}
```



## Database Tables

### Attachments (attachments)

column | type | description | nullable
--- | --- | --- | ---
id | char(35) | Laravel UUID String | No
created_at | timestamp | Time the address was crated | No
updated_at | timestamp | Time the address was last touched | Yes
deleted_at | timestamp | Time the address was deleted from Laravel | Yes
name | 	varchar(255) | Name of the attachment file | No
path | 	text | The path of the file within the driver | No
driver | varchar(10) | The driver the file is stored using eg local, s3, ftp | No
size | 	decimal(10,2) | Number of bytes the file is | No
relation_type | text | The system entity that this address is hooked up to (E.G. \Auth\User) | No
relation_id | unsigned_ int | The ID of the entiry this is address is hooked up to | No


