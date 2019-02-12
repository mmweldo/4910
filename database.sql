use website;
create table _user( #user_ instead of user because one is a system reserved name
    id int NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT null,
    email varchar(30) NOT NULL,
    date_created datetime DEFAULT CURRENT_TIMESTAMP,
    #access_level int not null,
    PRIMARY KEY(id)
);
# When inserting into user, use DEFAULT for date_created entry, example:
# insert into user (username, email, date_created) values ("asd","asd", DEFAULT); 
create INDEX ix_user_id ON _user(id);
CREATE INDEX ix_username ON _user(username);

create table sponsor(
    user_id int NOT NULL,
    company_name varchar(30) not null,
    #password
    #profile_img
    PRIMARY KEY(user_id),
    CONSTRAINT fk_sp_userid_user_id FOREIGN KEY(user_id) REFERENCES _user(id) ON UPDATE CASCADE ON DELETE CASCADE
);
create INDEX ix_user_id ON sponsor(user_id);

CREATE TABLE driver(
    user_id int NOT NULL,
    firstname varchar(30) NOT NULl,
    lastname varchar(30) not null,
    username varchar(30) not null, 
    #street_address
    #country
    #postal code
    sponsor_id int not null,
    #password
    total_points int DEFAULT 0,
    current_points int DEFAULT 0,
    total_spent int DEFAULT 0,
    #profile_img
    PRIMARY KEY(user_id),
    CONSTRAINT fk_driver_userid_user_id FOREIGN KEY (user_id) REFERENCES _user(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_driver_username_user_username FOREIGN KEY (username) REFERENCES _user(username) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_driver_sponsorid_sponsor_id FOREIGN KEY (sponsor_id) REFERENCES sponsor(user_id) ON UPDATE CASCADE ON DELETE CASCADE
);
create INDEX ix_user_id ON driver(user_id);
create index ix_driver_username ON driver(username);
create index ix_driver_totalpoints ON driver(total_points);
create index ix_driver_currentpoints ON driver(current_points);


CREATE TABLE points_history(
    sponsor_id int not null,
    driver_id int not null,
    date_created datetime DEFAULT CURRENT_TIMESTAMP,
    point_amount int not null,
    CONSTRAINT fk_ph_sponsorid_sponsor_id   FOREIGN KEY (sponsor_id)    REFERENCES sponsor(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_ph_driverid_driver_id     FOREIGN KEY (driver_id)     REFERENCES driver(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(sponsor_id, driver_id)
);

CREATE TABLE driver_list(
    sponsor_id int not null,
    driver_id int not null,
    driver_username varchar(30) not null,
    total_points int not null,
    current_points int not null,
    CONSTRAINT fk_dl_sponsorid_sponsor_id   FOREIGN KEY (sponsor_id)    REFERENCES sponsor(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_driverid_driver_id     FOREIGN KEY (driver_id)     REFERENCES driver(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_drivername_driver_username     FOREIGN KEY (driver_username)     REFERENCES driver(username) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_totalpoints_driver_totalpoints         FOREIGN KEY (total_points)      REFERENCES driver(total_points) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_dl_currentpoints_driver_currentpoints     FOREIGN KEY (current_points)    REFERENCES driver(current_points) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(sponsor_id, driver_id)
);

# insert into _user (username, email, date_created) values ("mmweldo", "mmweldo@clemson.edu", DEFAULT);
# insert into driver (user_id, firstname, lastname) values (1, "mitchell", "weldon");
# select * from _user join driver on _user.id = driver.user_id; #will output:...
#   id      username        email       date_created    user_id     firstname   lastname
#   0       mmweldo         mmweldo@c.  2019-02-12 09.. 1           mitchell    weldon