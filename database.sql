# CONVENTIONS  
    # If you add/remove points to driver make sure to update drivers AND point history
    # If you create a driver/sponsor/admin make sure to create their user entry as well
            # If you added a driver, make sure to tie them to their sponsor in both their drivers.sponsor_id and in driver_list.driver_id x driver_list.sponsor_id




create table users( #user_ instead of user because one is a system reserved name
    id int NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT null,
    password varchar(30) not null,
    email varchar(30) NOT NULL,
    date_created datetime DEFAULT CURRENT_TIMESTAMP,
    #access_level int not null,
    PRIMARY KEY(id)
);
# When inserting into user, use DEFAULT for date_created entry, example:
# insert into user (username, email, date_created) values ("asd","asd", DEFAULT); 
create INDEX ix_user_id ON users(id);
CREATE INDEX ix_username ON users(username);
CREATE INDEX ix_password ON users(password);

create table sponsors(
    user_id int NOT NULL,
    company_name varchar(30) not null,
    password varchar(30) not null,
    profile_img varchar(30),
    PRIMARY KEY(user_id),
    CONSTRAINT fk_sp_userid_user_id FOREIGN KEY(user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_sp_password_user_password FOREIGN KEY (password) REFERENCES users(password) ON UPDATE CASCADE ON DELETE CASCADE
);
create INDEX ix_user_id ON sponsors(user_id);

CREATE TABLE drivers(
    user_id int NOT NULL,
    firstname varchar(30) NOT NULl,
    lastname varchar(30) not null,
    username varchar(30) not null, 
    street_address varchar(30) not null,
    country varchar(30) not null,
    postal_code varchar(30) not null,
    sponsor_id int not null,
    password varchar(30) not null,
    total_points int DEFAULT 0,
    current_points int DEFAULT 0,
    total_spent int DEFAULT 0,
    profile_img varchar(30),
    PRIMARY KEY(user_id),
    CONSTRAINT fk_drivers_userid_users_id FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_drivers_username_users_username FOREIGN KEY (username) REFERENCES users(username) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_drivers_sponsorid_sponsors_id FOREIGN KEY (sponsor_id) REFERENCES sponsors(user_id) ON UPDATE CASCADE ON DELETE CASCADE, 
    CONSTRAINT fk_drivers_password_users_password FOREIGN KEY (password) REFERENCES users(password) ON UPDATE CASCADE ON DELETE CASCADE
);
create INDEX ix_user_id ON drivers(user_id);
create index ix_driver_username ON drivers(username);
create index ix_driver_totalpoints ON drivers(total_points);
create index ix_driver_currentpoints ON drivers(current_points);


CREATE TABLE points_history(
    sponsor_id int not null,
    driver_id int not null,
    date_created datetime DEFAULT CURRENT_TIMESTAMP,
    point_amount int not null,
    CONSTRAINT fk_ph_sponsorid_sponsors_id   FOREIGN KEY (sponsor_id)    REFERENCES sponsors(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_ph_driverid_drivers_id     FOREIGN KEY (driver_id)     REFERENCES drivers(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(sponsor_id, driver_id, date_created)
);

CREATE TABLE driver_list(
    sponsor_id int not null,
    driver_id int not null,
    driver_username varchar(30) not null,
    total_points int not null,
    current_points int not null,
    CONSTRAINT fk_dl_sponsorid_sponsors_id   FOREIGN KEY (sponsor_id)    REFERENCES sponsors(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_driverid_drivers_id     FOREIGN KEY (driver_id)     REFERENCES drivers(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_drivername_drivers_username     FOREIGN KEY (driver_username)     REFERENCES drivers(username) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_totalpoints_drivers_totalpoints         FOREIGN KEY (total_points)      REFERENCES drivers(total_points) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_currentpoints_drivers_currentpoints     FOREIGN KEY (current_points)    REFERENCES drivers(current_points) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(sponsor_id, driver_id)
);

# SAMPLE INSERT STATEMENT: MAKE SURE TO INSERT INTO BOTH PARENT AND CHILD TABLES WHEN NEEDED (EX. USERS->DRIVERS)
    # DEFAULT as an input only works if defined. Check above, notice how datetime values use current_timestamp

# insert into users (username, email, date_created) values ("dave_is_cool", "dave_best_name@gmail.com", DEFAULT);
# insert into drivers (user_id, firstname, lastname) values (1, "dave", "thecooliest");

# select * from users join drivers on users.id = drivers.user_id; #will output:...
    #   id      username        email       date_created    user_id     firstname   lastname        ...
    #   1       dave_is_cool    dave_be..   2019-02-12 09.. 1           dave        thecooliest     ...

CREATE TABLE admins(
    user_id int not null,
    username varchar(30) not null,
    password varchar(30) not null,
    firstname varchar(30) not null,
    lastname varchar(30) not null,
    profile_img varchar(30),
    CONSTRAINT fk_admins_userid_user_id FOREIGN KEY (user_id)   REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_admins_username_user_username FOREIGN KEY (username)  REFERENCES users(username) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_admins_password_users_password FOREIGN KEY (password) REFERENCES users(password) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(user_id)
);
CREATE INDEX ix_user_id ON admins(user_id);
CREATE INDEX ix_sponsor_username ON admins(username);


/*
	~ NEED TO ADD:
		- a table for total and current points connecting drivers and sponsors and allowing drivers to have multiple sponsors.
			IDEA: we could just use driver_list as the new points main
			
			[ignore this.. driver_list as new main is a better idea] DRAFT
			.	CREATE TABLE points( #POINTS sums the individual entries POINTS_HISTORY and connects this tallied total to drivers and sponsors. 
			.		driver_id int not null,
			.		sponsor_id int not null,
			.		total_points int DEFAULT 0,
			.		current_points int DEFAULT 0,
			.		CONSTRAINT fk_points_driverid_drivers_userid FOREIGN KEY (driver_id) REFERENCES drivers(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
			.		CONSTRAINT fk_points_sponsorid_sponsors_userid FOREIGN KEY (sponsor_id) REFERENCES sponsors(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
			.		PRIMARY KEY(driver_id, sponsor_id)	
			. . . . );

		- a foreign key constraint for points_list in drivers to driver_list
		- a foreign key constraint for driver_list in sponsors so that sponsors can access their driver_list more simply
		- a total_points entry to driver_list: total_points int DEFAULT 0
		- a current_points entry to driver_list: current_points int DEFAULT 0
		- a dollar-to-ratio entry in sponsors 
		
	~ NEED TO REMOVE:
		- drivers.total_points
		- drivers.current_points
		- INDEX ix_driver_totalpoints
		- INDEX ix_driver_currentpoints
		- foreign key constraint in driver_list for total_points
		- foreign key constraint in driver_list for current_points

	~ NEED TO ALTER:
		- points_history total_points foreign key constraint, move from drivers to driver_list
		- points_hustory current_points foreign key constraint, move from drivers to driver_list

*/
