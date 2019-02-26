/*  FOR THE REQUEST FOR CHANGE #1
	~ NEED TO ADD:
		1 a table for connecting multiple sponsors to a single driver  (use driver_list)
		2 [unneeded] CONSIDER: a foreign key constraint for driver_list in drivers so taht drivers can access their driver_list more simply
		3 [unneeded] CONSIDER: a foreign key constraint for driver_list in sponsors so that sponsors can access their driver_list more simply
		4 a total_points entry to driver_list: total_points int DEFAULT 0
		5 a current_points entry to driver_list: current_points int DEFAULT 0
		6 a dollar-to-ratio entry in sponsors 
		
	~ NEED TO REMOVE:
		7 drivers.total_points
            ALTER TABLE drivers DROP COLUMN total_points;
		8 drivers.current_points
            ALTER TABLE drivers DROP COLUMN current_points;
		9 INDEX ix_driver_totalpoints
            ALTER TABLE drivers DROP INDEX ix_driver_totalpoints;
		10 INDEX ix_driver_currentpoints
            ALTER TABLE drivers DROP INDEX ix_driver_currentpoints;
		11 foreign key constraint in driver_list for total_points
            ALTER TABLE driver_list DROP FOREIGN KEY 'fk_dl_totalpoints_drivers_totalpoints';
		12 foreign key constraint in driver_list for current_points
		13 points_history total_points foreign key constraint, move from drivers to driver_list
		14 points_history current_points foreign key constraint, move from drivers to driver_list

*/
/*NEED TO ADD: */


/*NEED TO REMOVE: 7-14*/
ALTER TABLE drivers DROP COLUMN total_points;
ALTER TABLE drivers DROP COLUMN current_points;
ALTER TABLE drivers DROP INDEX ix_driver_totalpoints;
ALTER TABLE drivers DROP INDEX ix_driver_currentpoints;
ALTER TABLE drivers MODIFY sponsor_id int(11);

ALTER TABLE driver_list DROP FOREIGN KEY 'fk_dl_totalpoints_drivers_totalpoints';
ALTER TABLE driver_list DROP FOREIGN KEY 'fk_dl_currentpoints_drivers_currentpoints';
ALTER TABLE driver_list MODIFY total_points int NOT NULL DEFAULT 0;
ALTER TABLE driver_list MODIFY current_points int NOT NULL DEFAULT 0;
CREATE INDEX ix_driver_totalpoints ON driver_list(total_points);
CREATE INDEX ix_driver_currentpoints ON driver_list(current_points);
