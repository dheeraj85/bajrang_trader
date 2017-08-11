create table users(
id int AUTO_INCREMENT primary key,
name varchar(100),
mobile varchar(10)unique,
email varchar(100),
password_hash varchar(100),
password varchar(100),
role enum('sa','admin','accountant','purchase','disberse','outlet_cashier','outlet_mgr','outlet_chef'),
logged_in timestamp,
logged_out timestamp,
is_active int default 0
)Engine=INNODB;

create table users_logins(
id int AUTO_INCREMENT primary key,
user_id int,
log_type enum('login','logout'),
in_out timestamp,
foreign key(user_id) references users(id) on delete cascade on update cascade
)Engine=INNODB;

create table purchase_category(
id int AUTO_INCREMENT primary key,
name varchar(100),
type enum('Purchase','Processed','Resale'),
description varchar(200),
is_active int default 0,
unique(type,name)
)Engine=INNODB;

create table purchase_sub_category(
id int AUTO_INCREMENT primary key,
category_id int,
name varchar(100),
type enum('Purchase','Processed','Resale'),
description varchar(200),
foreign key(category_id) references purchase_category(id),
is_active int default 0,
unique(type,name)
)Engine=INNODB;


create table item_scale(
id int AUTO_INCREMENT primary key,
scale_type enum('Raw','Finished'),
type_name varchar(20),
description varchar(200),
)Engine=INNODB;

create table purchase_item(
id int AUTO_INCREMENT primary key,
p_category_id int,
p_sub_category_id int,
brand varchar(100)unique,
item_scale varchar(20),
specification varchar(100),
created_by int,
is_active int default 0,
is_schedule int default 0,
low_qty int,
foreign key(created_by) references users(id) on delete cascade on update cascade,
foreign key(p_category_id) references purchase_category(id) on delete cascade on update cascade,
foreign key(p_sub_category_id) references purchase_sub_category(id) on delete cascade on update cascade
)Engine=INNODB;

create table hr_designation(
id int AUTO_INCREMENT primary key,
name varchar(100),
description varchar(200)
)Engine=INNODB;

create table ticket_type(
id int AUTO_INCREMENT primary key,
name varchar(100),
code varchar(50)
)Engine=INNODB;

create table vendor(
id int AUTO_INCREMENT primary key,
name varchar(50),
firm_name varchar(50),
mobile varchar(10),
contact_no varchar(12),
email varchar(100),
tin_no varchar(20),
pan_no varchar(10),
address  varchar(100),
created_by int,
created_date date,
is_active int default 0,
foreign key(created_by) references users(id) on delete cascade on update cascade
)Engine=INNODB;

create table vendor_item_supply(
id int AUTO_INCREMENT primary key,
vendor_id int,
purchase_item_id int,
is_active int default 0,
foreign key(purchase_item_id) references purchase_item(id) on delete cascade on update cascade,
foreign key(vendor_id) references vendor(id) on delete cascade on update cascade
)Engine=INNODB;

create table vendor_bank_details(
id int AUTO_INCREMENT primary key,
account_name varchar(100),
account_no varchar(100),
bank_name varchar(100),
branch varchar(50),
ifsc varchar(20),
vendor_id int,
created_by int,
created_date date,
foreign key(created_by) references users(id) on delete cascade on update cascade,
foreign key(vendor_id) references vendor(id) on delete cascade on update cascade
)Engine=INNODB;

create table hr_employee(
id int AUTO_INCREMENT primary key,
empname varchar(100),
fname varchar(100),
identification_no varchar(50)unique,
dob date,
contact varchar(50),
mobile varchar(50),
description varchar(200),
designation_id int,
is_active int default 0,
created_by int,
created_date date,
foreign key(designation_id) references hr_designation(id),
)Engine=INNODB;

create table invoice_settings(
id int AUTO_INCREMENT primary key,
type enum('tax_in_items','bill_cost'),
label varchar(20),
value numeric(5,2)
)Engine=INNODB

create table purchase_invoice(
id int AUTO_INCREMENT primary key,
invoice_type enum('cash','vendor'),
invoice_format enum('F1','F2'),
invoice_no varchar(50)unique,
invoice_date date,
vendor_name varchar(50),
vendor_id int,
received_by int,
discount_type enum('item_discount','bill_discount'),
total_amount numeric(14,2),
total_discount numeric(12,2),
is_added_to_stock int default 0, /* after review show add to stock*/
is_reviewed int default 0,     /* before review show edit*/
review_point int,
review_desc varchar(200),
created_by int,
updated_by int,
created_date date,
foreign key(created_by) references users(id) on delete cascade on update cascade,
foreign key(vendor_id) references vendor(id) on delete cascade on update cascade,
foreign key(received_by) references hr_employee(id) on delete cascade on update cascade
)Engine=INNODB;

create table purchase_invoice_items(
id int AUTO_INCREMENT primary key,
invoice_id int,
p_category_id int,
p_sub_category_id int,
item_id int, /*get items from vendor_item_supply*/
particulars varchar(200),
v_qty int,
v_scale int,
input_type enum('Convert','Direct'),
c_unit_value int,
stock_qty int,
stock_taking_scale varchar(10),
rate numeric(12,2),
amount numeric(12,2),
discount numeric(12,2),
is_mrd int default 0,
mrd_no int unique,
make_date date,
ready_date date,
discard_date date,
schedule_date date,
remarks varchar(100),
is_active int default 1,
foreign key(invoice_id) references purchase_invoice(id) on delete cascade on update cascade,
foreign key(p_category_id) references purchase_category(id) on delete cascade on update cascade,
foreign key(p_sub_category_id) references purchase_sub_category(id) on delete cascade on update cascade,
foreign key(item_id) references purchase_item(id) on delete cascade on update cascade
)Engine=INNODB;

create table invoice_item_tax(
id int AUTO_INCREMENT primary key,
invoice_item_id int, /*get items from purchase_invoice_items */
invoice_settings_id int,
tax_percent numeric(5,2),
tax_amount numeric(10,2),
foreign key(invoice_item_id) references purchase_invoice_items(id) on delete cascade on update cascade,
foreign key(invoice_settings_id) references invoice_settings(id) on delete cascade on update cascade
)Engine=INNODB;

create table invoice_bill_tax(
id int AUTO_INCREMENT primary key,
invoice_id int, /*get items from purchase_invoice */
invoice_settings_id int,
tax_percent numeric(5,2),
foreign key(invoice_id) references purchase_invoice(id) on delete cascade on update cascade,
foreign key(invoice_settings_id) references invoice_settings(id) on delete cascade on update cascade
)Engine=INNODB;

create table item_stock(
id int AUTO_INCREMENT primary key,
invoice_id int,
p_category_id int,
p_sub_category_id int,
item_id int, /*get items from vendor_item_supply*/
particulars varchar(200),
stock_qty int,
stock_taking_scale varchar(10),
rate numeric(12,2),
amount numeric(12,2),
is_mrd int default 0,
mrd_no int unique,
make_date date,
ready_date date,
discard_date date,
schedule_date date,
remarks varchar(100),
is_active int default 1,
foreign key(invoice_id) references purchase_invoice(id) on delete cascade on update cascade,
foreign key(p_category_id) references purchase_category(id) on delete cascade on update cascade,
foreign key(p_sub_category_id) references purchase_sub_category(id) on delete cascade on update cascade,
foreign key(item_id) references purchase_item(id) on delete cascade on update cascade
)Engine=INNODB;

create table purchase_indent_master(
id int AUTO_INCREMENT primary key,
indend_date date,
is_done int default 0,
created_by int,
foreign key(created_by) references users(id) on delete cascade on update cascade
);
  
create table purchase_indent(
id int AUTO_INCREMENT primary key,
indent_id int references purchase_indent_master(id),
item_id int,
item_name varchar(100),
item_brand varchar(50),
qty_req int,
qty_scale varchar(25),
req_date date,
is_added_to_order int default 0,  /* new column*/
order_no int,  /* new column*/
foreign key(item_id) references purchase_item(id) on delete cascade on update cascade
)Engine=INNODB;


 /* new tables added 25-5-2016 */
create table purchase_order(
id int AUTO_INCREMENT primary key,
supplier_id int,
order_status enum('pending','generated','cancel'),
created_by int,
order_date date,
po_type enum('supplier','openmarket'),
is_po_supplied int default 0, 
foreign key(created_by) references users(id) on delete cascade on update cascade
)Engine=INNODB;
  
create table purchase_order_items(
id int AUTO_INCREMENT primary key,
purchase_order_id int references purchase_order(id),
item_id int,
item_name varchar(100),
item_brand varchar(50),
qty_req int,
qty_scale varchar(25),
req_date date,
supplier_invoice_no varchar(25),
is_item_supplied int default 0, 
foreign key(item_id) references purchase_item(id) on delete cascade on update cascade
)Engine=INNODB;