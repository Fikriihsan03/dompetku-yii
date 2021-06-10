<p align="center">
    <h1 align="center">Yii 2 Dompetku Project Template( basic template from yii2 )</h1>
    <br>
</p>

## INSTALLATION

## Clone this repository

```
 git clone https://github.com/Fikriihsan03/dompetku-yii.git
```

## Run Composer update

```
 composer update
```

## Configure your database in /config/db.php

## Run this SQL command on your database

```
CREATE TABLE `dompetku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `total_item` int(11) DEFAULT NULL,
  `money` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)
```

## Run yii serve

```
PHP yii serve 8080 localhost:80801
```

## Visit the page

```
http://localhost:8081
```

### HAPPY CODING
