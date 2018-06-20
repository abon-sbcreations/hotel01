CREATE TABLE IF NOT EXISTS tbl_company_master (
comp_id int AUTO_INCREMENT PRIMARY KEY,
comp_name varchar(128),
comp_reg_no varchar(32),
comp_address TEXT
);
CREATE TABLE IF NOT EXISTS tbl_hotel_master (
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
CREATE TABLE IF NOT EXISTS tbl_room_master (
    room_master_id INT AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(32),
    room_type_Desc TEXT,
    room_type_status ENUM ("Y","N")
);
CREATE TABLE IF NOT EXISTS tbl_amenities_master (
    amenity_id int AUTO_INCREMENT PRIMARY KEY,
    amenity_name VARCHAR(32),
    amenity_desc TEXT
);

CREATE TABLE IF NOT EXISTS tbl_hotel_room_detail (
    hotel_room_master_id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    hotel_room_type INT,
    hotel_room_rent INT,
    hotel_room_desc TEXT,
    hotel_room_amenities VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS room_item_master (
    room_item_id int AUTO_INCREMENT PRIMARY KEY,
    room_item_cat VARCHAR(128),
    room_item_subcat VARCHAR(128),
    room_item_name VARCHAR(128)
);

CREATE TABLE IF NOT EXISTS hotel_room_item (
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

CREATE TABLE IF NOT EXISTS hotel_restaurant_master(
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
    menu_type ENUM ("Veg","Non-Veg"),
    item_img VARCHAR(128),
    item_desc TEXT,
    item_price DECIMAL(6,2),
    item_available ENUM ("Yes","No")
);