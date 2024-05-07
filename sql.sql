create database services;
use services;
create table service(
service_id integer primary key auto_increment,
service_name varchar(100),
image varchar(255),
small_desc varchar(255),
large_desc text,
price decimal
);
alter table service add column is_delete boolean default false; 
select customer.customer_name,service.service_id, service.service_name from customer INNER JOIN service ON customer.service_id=service.service_id;
drop table service;
SELECT * FROM service;
update service set price ='5000' where service_name='Chemical Peels';
insert into service (service_name,image,small_desc,large_desc) values
('Chemical Peels','./images/chemical peels.jpeg','These involve the application of a chemical solution to remove the damaged outer layers of the skin, improving texture and tone.',
'A chemical peel is a procedure in which a chemical solution is applied to the skin to remove the top layers.The skin that grows back is smoother. 
With a light or medium peel, you may need to undergo the procedure more than once to get the desired results.
Chemical peels are used to treat wrinkles, discolored skin and scars — usually on the face. 
They can be done alone or combined with other cosmetic procedures. And they can be done at different depths, from light to deep.
 Deeper chemical peels offer more-dramatic results but also take longer to recover from.'),

('Laser Hair Removal','./images/laser-hair-removal.webp','A procedure that uses a concentrated beam of light to remove unwanted hair.',
'Laser hair removal is a medical procedure that uses a concentrated beam of light (laser) to remove unwanted hair.
During laser hair removal, a laser emits a light that is absorbed by the pigment (melanin) in the hair.
 The light energy is converted to heat, which damages the tube-shaped sacs within the skin (hair follicles) that produce hairs.
 This damage inhibits or delays future hair growth. Although laser hair removal effectively delays hair growth for long periods,
 it usually does not result in permanent hair removal. Multiple laser hair removal treatments are needed for initial hair removal, 
 and maintenance treatments might be needed as well. Laser hair removal is most effective for people who have light skin and dark hair, 
 but it can be successfully used on all skin types.'),
 
('Thread Lifts','./images/thread lift.jpeg','A relatively new form of non-surgical facelift where temporary sutures are used to produce a subtle but visible "lift" in the skin.',
'A thread lift is a nonsurgical procedure that lifts sagging, aging skin and stimulates collagen production to give your face or neck a more youthful appearance. 
Plastic surgeons place medical-grade thread under the skin to pull the skin into position. 
These threads activate the body’s natural healing response, triggering the increase of collagen. Threads come in several different materials and lengths.
Unlike a facelift, a thread lift is a nonsurgical procedure that creates subtle changes. It’s often called a “lunchtime facelift” 
because it’s such a quick procedure with minimal downtime.'),

('Microneedling','./images/Microneedling.jpeg','A procedure that uses small needles to prick the skin, generating new collagen and skin tissue for smoother, firmer, more toned skin.',
'Microneedling a relatively new procedural therapy used in clinical and aesthetic dermatology. 
This activity summarizes the role of microneedling in dermatologic practice and includes discussion on the physiology, indications, contraindications, 
various tools, technique, and complications of the procedure.
 This activity will prepare healthcare teams to care for patients who undergo microneedling for any of a wide variety of indications.'),
 
('Botox and Fillers','./images/botox and fillers.jpeg',' Used to reduce the appearance of wrinkles and to plump up areas of the face, such as lips and cheeks.',
'It is universally accepted that as we age, we lose volume from the fat pockets of our face. skin becomes laxed and wrinkled. 
The hollowing or depressions are mostly evident under the eye, mid-cheek, temples and in the areas where folds are formed such as nasolabial folds,
 marionette lines and prejowl areas. Restoration of volume in these areas has a rejuvenating effect on the face. Skin laxity can also be caused by several
 heritable connective tissue disorders. In the ageing skin, acquired skin laxity seems to be a result of the combination of intrinsic and extrinsic processes. 
 A major extrinsic factor is an ultraviolet radiation (UVR), which can be potentiated by smoking. No one likes to see a black half moon (dark circle) under the eyes. 
 Everyone suffers from the problem of dark circles at some point in time. However, some people suffer from it every now and then. 
 There are many misconceptions about dark circles; one of it is that dark circles appear due to stress and disappear after stress reduces.
 Dark circles actually appear due to leak in capillaries. More and more people are turning to cosmetic doctors for rejuvenation techniques, 
 to help their face reflect the way they feel inside. 
 BOTOX® (Botulinum) treatment, fillers, skin tightening and lifting and dark circle reduction, are some of the rejuvenation techniques.');
select * from service;

create table customer(
customer_id integer primary key auto_increment,
customer_name varchar(50),
email varchar(100),
phone_number varchar(20),
message  text,
service_id integer,
FOREIGN KEY (service_id) REFERENCES service(service_id)
);
alter table customer change service_id  service_id integer default null;
drop table customer;
select * from customer;
select * from customer where service_id=2;
update  customer set is_delete=true WHERE customer_id=1;
desc customer;
alter table customer add column photo varchar(255);
alter table customer add column is_delete boolean default false;

alter table customer add column date date DEFAULT(CURRENT_DATE);
select count(customer_id) from customer 
    where customer_name LIKE '%d%';
truncate table customer;
select * from customer;
select count(customer_id) from customer;

create table malik(
id integer primary key auto_increment,
malik_phone_number varchar(50),
password varchar(50),
malik_name varchar(500),
image varchar(300),
role_id integer,
FOREIGN KEY (role_id) REFERENCES role(role_id)
);
drop table malik;
select * from malik;
insert into malik (malik_phone_number,password,malik_name,role_id) values ('8168544589', 'Kunjan','KUNJAN',1);
insert into malik (malik_phone_number,password,malik_name,role_id) values ('9466439652', 'Lakshit','Lakshit',2);

create table role (
role_id integer primary key auto_increment,
role_name varchar(50),
permission json);
drop table role;
select * from role;
insert into role (role_id, role_name, permission) values(1,'Super-Admin',JSON_ARRAY('1','2','3','4','6')),
(2,'Admin',JSON_ARRAY('1','2','4','6')),(3,'Publisher',JSON_ARRAY('2','4','6'));

create table navigation (
nav_id integer primary key auto_increment,
title varchar(50),
link varchar(50)
);
drop table navigation;
truncate table navigation;
select * from navigation;
insert into navigation (title,link) values('Messages','dashboard.php'),('Services','service_list.php'),
('Create User','sign_up.php'),('Create Service','create_service.php'),('Edit Service','edit_service.php'),('Edit Profile','edit_user.php');




create table xportsoft(
id integer primary key auto_increment,
fullname varchar(50),
email varchar(50),
phone_number varchar(20),
comment text
);
drop table xportsoft;
select * from xportsoft;