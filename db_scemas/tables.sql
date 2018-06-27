CREATE TABLE IF NOT EXISTS tbl_company_master ( /**/
comp_id int AUTO_INCREMENT PRIMARY KEY,
comp_name varchar(128),
comp_reg_no varchar(32),
comp_address TEXT
);

CREATE TABLE IF NOT EXISTS tbl_hotel_master ( /**/
    hotel_id INT AUTO_INCREMENT PRIMARY KEY,
    comp_id int, 
    hotel_name VARCHAR(64),
    hotel_type VARCHAR(16),
    hotel_address VARCHAR(255),
    hotel_reg_number VARCHAR(32) UNIQUE KEY,
    hotel_gst_number VARCHAR(32) UNIQUE KEY,
    hotel_check_in_time VARCHAR(16),
    hotel_check_out_time VARCHAR(16),
    hotel_has_restaurant ENUM("Y","N"),
    hotel_has_bar ENUM("Y","N"),
    hotel_reg_date datetime
);
CREATE TABLE IF NOT EXISTS tbl_room_master (  /**/
    room_master_id INT AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(32),
    room_type_Desc TEXT,
    room_type_status ENUM ("Y","N")
);
CREATE TABLE IF NOT EXISTS tbl_amenities_master (  /**/
    amenity_id int AUTO_INCREMENT PRIMARY KEY,
    amenity_name VARCHAR(32),
    amenity_desc TEXT
);

CREATE TABLE IF NOT EXISTS tbl_hotel_room_detail ( /**/
    hotel_room_master_id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    hotel_room_type INT,
    hotel_room_rent INT,
    hotel_room_desc TEXT,
    hotel_room_amenities VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS hotel_item_master ( /**/
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT 4,
    item_cat VARCHAR(128),
    item_subcat VARCHAR(128),
    item_img VARCHAR(128),
    item_name VARCHAR (128),
    item_attr VARCHAR (128),
    item_desc TEXT
);

CREATE TABLE IF NOT EXISTS hotel_room_item (  /**/
    hotel_room_item_id int AUTO_INCREMENT PRIMARY KEY,
    hotel_room_item_brand VARCHAR(64),
    hotel_room_item_size VARCHAR(32),
    hotel_room_item_weight VARCHAR(32),
    is_item_reuseable   ENUM ("Y","N"),
    is_item_available   ENUM ("Y","N") 
);

CREATE TABLE IF NOT EXISTS website_operator (
    operator_id int AUTO_INCREMENT PRIMARY KEY,
    operator_username VARCHAR(32),
    operator_password VARCHAR(32),
    operator_display_name varchar(128),
    operator_status ENUM ("Y","N")
);


CREATE TABLE IF NOT EXISTS tbl_super_admin (
    admin_id int AUTO_INCREMENT PRIMARY KEY,
    admin_username VARCHAR(32),
    admin_password VARCHAR(32),
    admin_display_name varchar(128),
    admin_status ENUM ("Y","N")
);

CREATE TABLE IF NOT EXISTS hotel_restaurant_master( /**/
    menu_id  INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    menu_session ENUM ("Lunch","Dinner","Breakfast"),
    menu_type ENUM ("Veg","Non-Veg"),
    item_name VARCHAR(128),
    item_img VARCHAR(128),
    item_desc TEXT,
    item_price DECIMAL(6,2),
    item_available ENUM ("Y","N") 
);

CREATE TABLE IF NOT EXISTS hotel_bar_master(
    menu_id  INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    menu_cat VARCHAR(128),
    item_name VARCHAR(128), 
    menu_type ENUM ("veg","non_veg"),
   /* item_img VARCHAR(128),*/
    item_desc TEXT,
    item_price DECIMAL(6,2),
    item_available ENUM ("Yes","No")
);

CREATE TABLE IF NOT EXISTS hotel_bar_served(
    bar_service_id int,
    hotel_id INT,
    customer_id INT,
    served_place ENUM("Room","DinningHall","Poolside"),
    served_place_detail VARCHAR(64),
    served_on varchar(16),
    served_item TEXT,
    isPaid ENUM("Yes","No")
);

CREATE TABLE IF NOT EXISTS hotel_resturant_served(
resturant_service_id int,
    hotel_id INT,
    customer_id INT,
    served_place ENUM("Room","DinningHall","Poolside"),
    served_place_detail VARCHAR(64),
    served_on varchar(16),
    served_item TEXT,
    isPaid ENUM("Yes","No")
);

CREATE TABLE IF NOT EXISTS customer_master( /**/
    cust_id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id int,
    cust_name VARCHAR(128),
    cust_phone varchar(11),
    cust_email VARCHAR(128),
    cust_address TEXT,
    cust_status ENUM("Member","Guest"),
    membership_type int,
    membership_num VARCHAR(32),
    membership_issue_date varchar(64)
);

CREATE TABLE IF NOT EXISTS customer_doc_master(
    cust_doc_id INT AUTO_INCREMENT PRIMARY KEY,
    cust_id int,
    doc_type ENUM("Aadhar","Voter","Pan","Passport","Driving"),
    doc_number VARCHAR(32)
);

CREATE TABLE IF NOT EXISTS hotel_membership_master( /**/
    membership_id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id int,
    membership_card VARCHAR(32),
    membership_card_value DECIMAL(8,2),
    membership_validity tinyint(2),
    membership_amenity VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS hotel_admin_master(
    hotel_admin_id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id int,
    hotel_userid VARCHAR(32),
    hotel_passwd VARCHAR(32),
    hotel_module_permission TEXT,/*{2:{all},3:{add,del}} */
    hotel_access_activation varchar(16),
    hotel_access_duration SMALLINT(2),
    hotel_access_rent DECIMAL(8,2),
    is_rent_paid ENUM ("Y","N"),
    hotel_admin_status ENUM ("Active","Inactive")
);

CREATE TABLE IF NOT EXISTS tbl_module_master(
    module_id INT AUTO_INCREMENT PRIMARY KEY,
    module_status ENUM ("Active", "Inactive")
    module_name VARCHAR(32),
    module_desc  TEXT
   
);