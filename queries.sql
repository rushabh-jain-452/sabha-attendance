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

CREATE TABLE `attendancedb`.`admin` (
  `adminid` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `mandal` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `addtimestamp` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE `qr_code_links` (
  `linkid` int(11) NOT NULL,
  `mandal` varchar(50) NOT NULL,
  `qr_link` varchar(200) NOT NULL,
  `qr_pdf_link` varchar(200) NOT NULL
);
