Yii 2.0 data additions by CSA
=================================

These database additions for Yii 2.0 add certain features  
for development purposes by CSA and can perhaps be of use to others.

This repository is available via <https://github.com/csa12/yii2-data>.
For license information check the [LICENSE](LICENSE.md)-file.

Installation
------------

The preferred way to install is through [composer](http://getcomposer.org/download/).

Either run

```
composer require csa12/yii2-data
```

or add

```json
"csa12/yii2-data": "dev-master",
```

to the require section of your composer.json.

Usage
-----
To use this extension, simply add the following code at the beginning of views/layouts/main.php or any other view file where you would like to check your database connection or table existence.
```
use csa\data\Database;

<?php 
	$tableName = 'name_of_database_table';//or NULL
	$db = Database::checkDb($tableName);
	$this->beginPage() ?>
...

```

And if so desired you can disbale your content by adding  the following code around the <?= $content ?> within views/layouts/main.php
```
...
        <?php if ($db) { ?>
        <?= $content ?>
        <? } ?>
...
```

Note
----
This version is still under development and not intended for use in any production evironments.

