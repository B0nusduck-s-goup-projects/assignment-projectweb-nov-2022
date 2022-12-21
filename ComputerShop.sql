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
commentStars int(5),
commentContent varchar(500),
constraint PK_Comm primary key (productID,customerID),
constraint FK_Pro_Comm foreign key (productID) references products(productID),
constraint FK_Cus_Comm foreign key (customerID) references customers(customerID)
);
create table carts
(
cartID int not null,
productID mediumint not null,
customerID int not null,
productAmmount int,
totalprice float(15,3),
constraint PK_Comm primary key (cartID,productID),
constraint FK_Pro_Carts foreign key (productID) references products(productID),
constraint FK_Cus_Carts foreign key (customerID) references customers(customerID)
);

--insert data

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Laptop'),
(2, 'Graphic card'),
(3, 'Gaming Mouse');

INSERT INTO `customers` (`customerID`, `customerUsername`, `customerPassword`, `customerMail`) VALUES
(2, 'Test02', '$2y$10$ZGA/zwB3nRmXPyAAfk3zNO7XTGyXikZn.3uVStoGk.SYs3cFl72CO', '4567@gmail'),
(3, 'Test', '$2y$10$/j96u4V8G5qoF4Ihzqz50eSmcIBVmUBzX8JRI4XiSTcum4h90csDO', '1234@gmail');

INSERT INTO `products` (`productID`, `categoryID`, `productName`, `productPrice`, `productImage`) VALUES
(1, 1, 'Laptop Acer Aspire 7 Gaming A715 42G R4ST R5 5500U/8GB/256GB/4GB GTX1650/Win10', 19990000.000, 'Product1.png'),
(2, 1, 'Laptop Gaming Acer Nitro 5 Tiger AN515 58 52SP', 24990000.000, 'Product2.png'),
(3, 2, 'VGA ASUS TUF Gaming GeForce GTX 1650 4GB GDDR6 TUF-GTX1650-4GD6-GAMING', 7000000.000, 'Product3.png'),
(4, 2, 'MSI Geforce RTX™ 3080 GAMING Z TRIO - 10GB GDDR6X V2', 18900000.000, 'Product4.png'),
(5, 3, 'RAT+PRO+X3+Wired Gaming Mouse', 6900000.000, 'Product5.png'),
(6, 3, 'Wired Mouse Logitech G502 X Corded Gaming', 1550000.000, 'Product6.png'),
(7, 2, 'VGA ASUS TUF Gaming GeForce RTX 4080 16GB GDDR6X', 42990000.000, 'Product7.png'),
(8, 3, 'EVGA X15 MMO Gaming Mouse, 8k, Wired, Black, Ergonomic 904-W1-15BK-KR', 7500000.000, 'Product8.png'),
(9, 1, 'Laptop Asus TUF Gaming FX506LHB i5 10300H/8GB/512GB/4GB GTX1650/144Hz/Win11 (HN188W)', 20990000.000, 'Product9.png'),
(10, 2, 'ROG Strix GeForce® RTX 2080 SUPER 8GB GAMING GDDR6', 30000000.000, 'Product10.png');

INSERT INTO `staff` (`staffID`, `staffUsername`, `staffPassword`, `staffName`, `staffPhone`, `staffEmail`) VALUES
(1, 'Jay', '$2y$10$pmqZWjKs5oBeucVP0Ze2H.1F1lzP58TgnHmzZLAvVbki1blP4wawC', 'Jay Maccal', 554674569, 'JayMac@gmail.com');
