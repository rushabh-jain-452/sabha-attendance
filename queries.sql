CREATE TABLE `attendancedb`.`member`
(
    `memberid` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `gender` CHAR(1) NOT NULL,
    `dob` DATE NOT NULL,
    `mobileno` VARCHAR(15) NOT NULL,
    `address` VARCHAR(500) NOT NULL,
    `addtimestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`memberid`), UNIQUE `name_unique_index` (`name`(100))
);

CREATE TABLE `attendancedb`.`attendance` 
(
    `attendanceid` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `memberid` INT UNSIGNED NOT NULL,
    `date` DATE NOT NULL,
    `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`attendanceid`),
    CONSTRAINT attendance_memberid_fk FOREIGN KEY (memberid) REFERENCES member(memberid),
    CONSTRAINT unique_memberid_date UNIQUE(memberid, date)
);