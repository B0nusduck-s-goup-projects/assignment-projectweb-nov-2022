create database ComputerShop;
use ComputerShop;

create table Customers
(
customerID int not null primary key,
customerUsername varchar(30) not null,
customerPassword varchar(30) not null,
customerMail varchar(40)
);
