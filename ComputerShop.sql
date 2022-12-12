create database computershop;
use computershop;

create table customers
(
customerID int not null auto_increment primary key,
customerUsername varchar(30) not null,
customerPassword varchar(30) not null,
customerMail varchar(40)
);
create table staffs
(
staffID smallint not null primary key,
staffUsername varchar(30) not null,
staffPassword varchar(500) not null,
staffName varchar(40) not null,
staffPhone int(10),
staffEmail varchar(40)
);
create table categories
(
categoryID smallint not null primary key,
categoryName varchar(40)
);
create table products
(
productID mediumint not null primary key,
categoryID smallint not null,
productName varchar(100),
productPrice double(15,3),
productImage varchar(30),
constraint FK_Cat_Pro foreign key (categoryID) references Categories(categoryID)
);
create table comments
(
productID mediumint not null,
customerID int not null,
commentStars smallint (5),
commentContent varchar (500),
constraint PK_Comments primary key (productID, customerID),
constraint FK_Cus_Com foreign key (customerID) references Customers(customerID),
constraint FK_Pro_Com foreign key (productID) references Products(productID)
);
create table carts
(
cartID int not null,
productID mediumint not null,
customerID int not null,
productAmmount smallint,
totalPrice double(15,4),
constraint PK_Carts primary key (cartID, productID),
constraint FK_Pro_Carts foreign key (productID) references Products(productID),
constraint FK_Cus_Carts foreign key (customerID) references Customers(customerID)
);
