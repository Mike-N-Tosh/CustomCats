# Custom Categories

This is the one must have module for 68 Classifieds. The custom category module allows you to create new template files for different categories. This is 
perfect if you have categories that are not really related and should have there own layout. For example horses and cars.

## Installation

Upload the folder customcats to your modules directory. 

 * Visit administration -> settings -> modules and activate it. 

## Requirements 

 * Min 68 Classifieds v4.1.0 

## Errors 

Q. I have installed the module but I know get an error like this: "Notice: Query failed: Unknown column 'ccTemplate' in 'field list' SQL: SELECT ccTemplate, ccnoprice FROM"

A. You may want to manually alter the table by running these two queries: 
<pre>
	ALTER TABLE class_categories` ADD `ccTemplate` VARCHAR( 255 ) NOT NULL;
	ALTER TABLE class_categories ADD `ccnoprice` CHAR( 1 ) NOT NULL;
</pre>