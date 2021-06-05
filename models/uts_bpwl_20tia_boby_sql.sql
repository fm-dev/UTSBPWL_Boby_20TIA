create database uts_bpwl_20tia_boby;
use uts_bpwl_20tia_boby;

create table user(
idUser int(255) NOT NULL auto_increment,
username varchar(225),
email varchar(225),
registration_date datetime,
password varchar(255),
constraint pk_user PRIMARY KEY(idUser));

create table customerorder(
idOrder int(255) not null auto_increment,
customer_name varchar(225),
phone_number varchar(25),
amount int(255),
status varchar(15),
constraint pk_order PRIMARY KEY(idOrder));

create table admin(
idAdmin int(255) not null auto_increment,
admin_name varchar(225),
email varchar(225),
work_date datetime,
password varchar(255),
constraint pk_admin PRIMARY KEY(idAdmin));

insert into user(username,email,registration_date,password)
values
('Boby Hartanto','hartanto20ti@mahasiswa.pcr.ac.id',now(), 'bobyhartanto');

insert into admin(admin_name,email,work_date,password)
values
('Admin 0001','bobyhartanto@gmail.com',now(), 'bobyhartanto');

insert into customerorder(customer_name,phone_number,amount,status)
values
('Fortran','86773120',10000,'Pending');
