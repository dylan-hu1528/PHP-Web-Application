create table patient (
Name varchar(20) null,
patientid int not null auto_increment,
PhoneNumber varchar(20) null,
Age int null,
EarliestDate date null,
Priority int null,
Primary key (PatientID),
Unique (PatientID)) 
engine=innodb;

create table vaccinebatch (
Manufacturer varchar(20) null,
ExpirationDate date null,
Quantity int null,
batchid int not null auto_increment,
Primary key (BatchID),
Unique (BatchID)) 
engine=innodb;

create table dose (
TrackingNumber int not null,
Status varchar(20) null,
BatchID int not null,
Primary key (TrackingNumber),
Unique (TrackingNumber),
Foreign key (BatchID) references vaccinebatch (BatchID)) 
engine=innodb;

create table waitlist(
ID int not null auto_increment,
Dates date null,
patientID int not null,
trackingnumber int null,
Primary key (ID),
Unique (ID),
Unique(patientID),
Unique(trackingnumber),
Foreign key (patientID) references patient (patientID), 
Foreign key (trackingnumber) references dose (trackingnumber))
engine=innodb;




