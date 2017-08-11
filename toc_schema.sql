CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int primary key AUTO_INCREMENT,
   order_no varchar(100),
   delivery_form date DEFAULT NULL,
   delivery_to date DEFAULT NULL,
   state_code int,
   place varchar(100),
   gst_no varchar(20),
  `order_status` enum('pending','generated','cancel') DEFAULT NULL,
  `is_po_supplied` int(11) DEFAULT '0'
) ENGINE=InnoDB

CREATE TABLE IF NOT EXISTS `purchase_order_items` (
  `id` int primary key AUTO_INCREMENT,
  `purchase_order_id` int,
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `qty_req` decimal(10,3),
  `qty_scale` varchar(25) DEFAULT NULL,
   rate decimal(10,3),
   amount decimal(20,3),
  `req_date` date DEFAULT NULL,
   foreign key(purchase_order_id) references purchase_order(id) 
) ENGINE=InnoDB

ALTER TABLE `purchase_invoice` ADD `land_owner` VARCHAR(255) NULL DEFAULT NULL AFTER `vendor_name`;
ALTER TABLE `purchase_invoice` ADD `village` VARCHAR(255) NULL DEFAULT NULL AFTER `land_owner`;
ALTER TABLE `purchase_invoice` ADD `district` VARCHAR(255) NULL DEFAULT NULL AFTER `village`;
ALTER TABLE `purchase_invoice` ADD `state` VARCHAR(100) NULL DEFAULT NULL AFTER `district`;
ALTER TABLE `purchase_invoice` ADD `validity_of_pass_from` DATE NULL DEFAULT NULL AFTER `state`;
ALTER TABLE `purchase_invoice` ADD `validity_of_pass_to` DATE NULL DEFAULT NULL AFTER `validity_of_pass_from`;
ALTER TABLE `purchase_invoice` ADD `pass_provider` VARCHAR(100) NULL DEFAULT NULL AFTER `validity_of_pass_to`;

CREATE TABLE IF NOT EXISTS `challan` (
  `id` int primary key AUTO_INCREMENT,
   customer_id int,
   purchase_invoice_id int,
   challan_no int,
   challan_date date,
  `purchase_order_id` int,
  `purchase_order_item` varchar(255), 
   ex_station varchar(150),
   truck_wagon_no varchar(255), 
   is_cancel int default 0,
   foreign key(customer_id) references customer(id), 
   foreign key(purchase_order_id) references purchase_order(id), 
   foreign key(purchase_invoice_id) references purchase_invoice(id) 
) ENGINE=InnoDB

CREATE TABLE IF NOT EXISTS `challan_items` (
  `id` int primary key AUTO_INCREMENT,
  `challan_id` int,
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `weight` decimal(10,3),
   rate decimal(10,3),
   amount decimal(20,3),
  `added_date` date DEFAULT NULL,
   foreign key(item_id) references purchase_item(id),   
   foreign key(challan_id) references challan(id) 
) ENGINE=InnoDB

CREATE TABLE IF NOT EXISTS `kata_parchy` (
  `id` int primary key AUTO_INCREMENT,
   grn_no varchar(100), 
   purchase_invoice_id int,
   challan_id int,
   order_no varchar(100), 
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
   gst_code_type enum('HSN', 'SAC'),
   gst_code varchar(12),
   gst_percent int,
   `load_weight` decimal(10,3),
   `net_weight` decimal(10,3),
   vendor_name varchar(255), 
   foreign key(challan_id) references challan(id), 
   foreign key(purchase_invoice_id) references purchase_invoice(id) 
) ENGINE=InnoDB

create table calculate_payout(
 id int AUTO_INCREMENT primary key,
 kata_parchy_id int, /* added by pankaj */
 customer_id int,
 load_wgt decimal(12,3),
 rate decimal(12,3),
 amount decimal(20,3), 
 remark varchar(255),
 dated date,
 is_paid int default 0,
 foreign key(kata_parchy_id) references kata_parchy(id) on delete cascade on update cascade,
 foreign key(customer_id) references customer(id) on delete cascade on update cascade
)Engine=INNODB;

ALTER TABLE `voucher` ADD `calculate_payout_id` INT NULL DEFAULT NULL AFTER `receiver_id`;
ALTER TABLE `voucher` ADD `item_tax_type` ENUM('CGST/SGST', 'IGST') NULL DEFAULT NULL AFTER `calculate_payout_id`;  
ALTER TABLE `voucher` ADD `tax_percent_rate` DECIMAL(12,3) NULL DEFAULT NULL AFTER `item_tax_type`;
ALTER TABLE `voucher` ADD `tax_amt` DECIMAL(12,3) NULL DEFAULT NULL AFTER `tax_percent_rate`;
ALTER TABLE `voucher` ADD `reverse_percent_rate` DECIMAL(12,3) NULL DEFAULT NULL AFTER `tax_amt`;
ALTER TABLE `voucher` ADD `reverse_amt` DECIMAL(12,3) NULL DEFAULT NULL AFTER `reverse_percent_rate`;
ALTER TABLE `challan` ADD `is_cancel` INT NOT NULL DEFAULT '0' AFTER `customer_id`;

CREATE TABLE IF NOT EXISTS `bill` (
  `id` int primary key AUTO_INCREMENT,
   bill_no varchar(20),
   bill_date date,
   bill_from_date date,
   bill_to_date date,
   customer_id int, 
   purchase_order_id int,
  `item_id` int(11) DEFAULT NULL,
   bill_type enum('cost_bill','incremental_bill'),
   print_type enum('kanta_parchi_wise','bill_on_total'),
   added_on date,
   particulars varchar(255), 
   foreign key(customer_id) references customer(id), 
   foreign key(purchase_order_id) references purchase_order(id),
   foreign key(item_id) references purchase_item(id)  
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `bill_items` (
  `id` int primary key AUTO_INCREMENT,
  `bill_id` int,
   kata_parchi_id int,
  `weight` decimal(10,3),
   rate decimal(10,3),
   tax numeric(5,2),
   amount decimal(20,3),
  `created_date` date DEFAULT NULL,  
   foreign key(kata_parchi_id) references kata_parchy(id),
   foreign key(bill_id) references bill(id) on delete cascade on update cascade
) ENGINE=InnoDB;


ALTER TABLE `purchase_order` ADD `is_active` INT NULL DEFAULT '1' AFTER `is_po_supplied`;
ALTER TABLE `kata_parchy` ADD `kata_parchi_date` DATE NULL AFTER `vendor_name`;
ALTER TABLE `bill` ADD `txn_type` VARCHAR(50) NULL AFTER `id`;



-- select 
-- c.id,c.challan_date,c.purchase_order_id,
-- ci.item_id,ci.item_name,ci.item_code,ci.weight,ci.rate,ci.amount,ci.added_date
-- from challan_items ci 
-- left JOIN challan c ON c.id=ci.challan_id
-- where c.purchase_order_id=1