create database computershop;
use computershop;

create table customers
(
customerID int not null primary key,
customerUsername varchar(30) not null,
customerPassword varchar(30) not null,
customerMail varchar(40)
);
create table staff
(
staffID smallint not null primary key,
staffUsername varchar(30) not null,
staffPassword varchar(30) not null,
stafName varchar(40) not null,
staffPhone int(10),
staffEmail varchar(40)
);
