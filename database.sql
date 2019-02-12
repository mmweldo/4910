create table users( #user_ instead of user because one is a system reserved name
    id int NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT null,
    email varchar(30) NOT NULL,
    date_created datetime DEFAULT CURRENT_TIMESTAMP,
    #access_level int not null,
    PRIMARY KEY(id)
);
# When inserting into user, use DEFAULT for date_created entry, example:
# insert into user (username, email, date_created) values ("asd","asd", DEFAULT); 
create INDEX ix_user_id ON users(id);
CREATE INDEX ix_username ON users(username);

create table sponsors(
    user_id int NOT NULL,
    company_name varchar(30) not null,
    #password
    #profile_img
    PRIMARY KEY(user_id),
    CONSTRAINT fk_sp_userid_user_id FOREIGN KEY(user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);
create INDEX ix_user_id ON sponsors(user_id);

CREATE TABLE drivers(
    user_id int NOT NULL,
    firstname varchar(30) NOT NULl,
    lastname varchar(30) not null,
    username varchar(30) not null, 
    street_address varchar(30) not null,
    country varchar(30), not null,
    postal code varchar(30) not null,
    sponsor_id int not null,
    password varchar(30) not null,
    total_points int DEFAULT 0,
    current_points int DEFAULT 0,
    total_spent int DEFAULT 0,
    profile_img varchar(30),
    PRIMARY KEY(user_id),
    CONSTRAINT fk_drivers_userid_users_id FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_drivers_username_users_username FOREIGN KEY (username) REFERENCES users(username) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_drivers_sponsorid_sponsors_id FOREIGN KEY (sponsor_id) REFERENCES sponsors(user_id) ON UPDATE CASCADE ON DELETE CASCADE
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
    PRIMARY KEY(sponsor_id, driver_id)
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

# insert into users (username, email, date_created) values ("mmweldo", "mmweldo@clemson.edu", DEFAULT);
# insert into drivers (user_id, firstname, lastname) values (1, "mitchell", "weldon");
# select * from users join drivers on users.id = drivers.user_id; #will output:...
#   id      username        email       date_created    user_id     firstname   lastname
#   0       mmweldo         mmweldo@c.  2019-02-12 09.. 1           mitchell    weldon
