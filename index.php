<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 29.10.15
 * Time: 22:41
 */

require_once 'vendor/autoload.php';
//use Entities;
//use Entities;
//use Entities\Client;
use Entities\ManagerWorkWithDB;
use Layer\Manager;

Twig_Autoloader::register();

$loader=new Twig_Loader_Filesystem('templates');
$twig=new Twig_Environment($loader);

$template=$twig->loadTemplate('index.html');
echo $template->render(array());

try {
    //?Doesn't work
    //$db = new PDO("mysql:host=$servername;dbname=$dbname","charset=UTF8", $username, $password);
    $db = new PDO('mysql:host=localhost;dbname=' . 'PawnShop' . ';charset=UTF8', 'root', '7Rtz0mj4h');
    //var_dump($db);

    //$dbh->exec("CREATE DATABASE 'PawnShop1')");

    $rows = $db->exec("CREATE TABLE `Clients1`(
	idClient INT PRIMARY KEY AUTO_INCREMENT,
	familyName VARCHAR(20) NOT NULL,
	firstName VARCHAR(20) NOT NULL,
	dateOfBirth DATE NOT NULL )");

    $rows1 = $db->exec("CREATE TABLE `MortgagesSubjects1`(
	idSubject INT PRIMARY KEY AUTO_INCREMENT,
	idClient INT,
	subjectType VARCHAR(20) NOT NULL,
	weight FLOAT NOT NULL,
	assessedValue INT(5) NOT NULL,
	fineness INT(3) NOT NULL,
	FOREIGN KEY (idClient) REFERENCES Clients1(idClient))");

   $rows2 = $db->exec("CREATE TABLE `Contracts1`(
	idContract INT PRIMARY KEY AUTO_INCREMENT,
	numberOfContract INT(4) NOT NULL,
	dateOfContract DATE NOT NULL )");

    $rows3 = $db->exec("CREATE TABLE `Checks1`(
	idCheck INT PRIMARY KEY AUTO_INCREMENT,
	numberOfCheck INT(4) NOT NULL,
	summOfCheck INT(6) NOT NULL,
	dateOfCheck DATE NOT NULL )");

    $rows4 = $db->exec("CREATE TABLE `Contracts1ToChecks1`(
	idCheck INT PRIMARY KEY AUTO_INCREMENT,
	numberOfCheck INT(4) NOT NULL,
	summOfCheck INT(6) NOT NULL,
	dateOfCheck DATE NOT NULL )");

    //Iserting data to DB
    $rows = $db->exec("INSERT INTO `Clients1` VALUES
            ('1',    'Ivanov',    'Ivan', '1990-03-20'),
            ('2',    'Petrov',    'Petr', '1981-06-10'),
            ('3',    'Sidorov',   'Sidor', '1980-04-21'),
            ('4',    'Vovanov',    'Vova', '1980-03-10'),
            ('5',    'Mishin',    'Misha', '1980-02-20'),
            ('6',    'Kolin',    'Kolia', '1979-06-15'),
            ('7',    'Dimov',    'Dima', '1975-04-24'),
            ('8',    'Sergeyev', 'Sergey', '1973-07-11'),
            ('9', 'Vasiliyev', 'Vasiliy', '1970-01-01')");

    $rows1 = $db->exec("INSERT INTO `MortgagesSubjects1` VALUES
            ('1', '2', 'Golden Ring', '4.35', '2500', '585'),
            ('2', '2', 'Mobile Phone',     '',  '400',    ''),
            ('3', '9', 'Golden Ring', '6.35', '3500', '585'),
            ('4', '9', 'Mobile Phone',     '',  '600',    ''),
            ('5', '9', 'Mobile Phone',     '',  '400',    ''),
            ('6', '7', 'Golden Ring', '6.35', '3500', '585'),
            ('7', '3', 'Mobile Phone',     '',  '600',    ''),
            ('8', '1', 'Silver Ring',  '10.8',   '120', '925'),
            ('9', '6', 'Silver Ring',  '16.3',   '180', '916')");

    $rows2 = $db->exec("INSERT INTO `Contracts1` VALUES
             ('1', '1562', '2015-09-20'),
             ('2', '1498', '2015-08-10'),
             ('3', '1462', '2015-07-20'),
             ('4', '1438', '2015-07-10'),
             ('5', '1352', '2015-03-02'),
             ('6', '1310', '2015-09-20'),
             ('7', '1260', '2015-08-10'),
             ('8', '1116', '2015-07-20'),
             ('9', '981', '2015-03-01')");

    $rows3 = $db->exec("INSERT INTO `Checks1` VALUES
            ('1', '2134', '1250', '2015-09-20'),
            ('2', '2005',  '250', '2015-08-10'),
            ('3', '2004', '1250', '2015-07-20'),
            ('4', '1934', '1250', '2015-07-10'),
            ('5', '1905',  '250', '2015-03-02'),
            ('6', '1874', '1250', '2015-09-20'),
            ('7', '1755',  '250', '2015-08-10'),
            ('8', '1730',   '60', '2015-07-20'),
            ('9', '1720',   '60','2015-03-01')");

}
//It catches mistakes in connection
catch(Exception $e) {
   echo $e->getMessage();
}

$Client1 = new Entities\Client('17', 'Smoke', 'John', '1954-03-15', '3', 'Contracts1');
$Client2 = new Entities\Client('19', 'Smoge', 'Jane', '1941-01-11', '1', 'Clients1');
