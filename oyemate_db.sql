-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2017 at 04:51 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oyemate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL auto_increment,
  `adminUname` varchar(256) default NULL,
  `adminEmail` varchar(256) default NULL,
  `adminPassword` varchar(256) default NULL,
  `adminPhoto` varchar(256) default NULL,
  `privileges` varchar(256) default NULL,
  `signupDate` varchar(256) default NULL,
  PRIMARY KEY  (`adminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminUname`, `adminEmail`, `adminPassword`, `adminPhoto`, `privileges`, `signupDate`) VALUES
(1, 'abhiburk', 'abhiburk@gmail.com', '9881123144', 'IMG_20150914_205546.jpg', 'Full', '1489498441');

-- --------------------------------------------------------

--
-- Table structure for table `admin_visit`
--

CREATE TABLE `admin_visit` (
  `avID` int(12) NOT NULL auto_increment,
  `adminID` int(12) NOT NULL,
  `session` varchar(256) NOT NULL,
  `time` varchar(256) NOT NULL,
  PRIMARY KEY  (`avID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `admin_visit`
--


-- --------------------------------------------------------

--
-- Table structure for table `attend_records`
--

CREATE TABLE `attend_records` (
  `recordID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `subjectID` int(12) NOT NULL,
  `attend_StudID` int(12) default NULL,
  `attendStatus` varchar(256) default NULL,
  `attendDate` varchar(256) default NULL,
  `attendTime` varchar(256) default NULL,
  PRIMARY KEY  (`recordID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `attend_records`
--


-- --------------------------------------------------------

--
-- Table structure for table `attend_sheets`
--

CREATE TABLE `attend_sheets` (
  `sheetID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `sheetName` varchar(256) default NULL,
  `createTime` varchar(256) default NULL,
  PRIMARY KEY  (`sheetID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attend_sheets`
--

INSERT INTO `attend_sheets` (`sheetID`, `userID`, `sheetName`, `createTime`) VALUES
(1, 33, 'ABC', '1495967921'),
(2, 1, 'ABC', '1496835321');

-- --------------------------------------------------------

--
-- Table structure for table `attend_students`
--

CREATE TABLE `attend_students` (
  `attend_StudID` int(12) NOT NULL auto_increment,
  `sheetID` int(12) NOT NULL,
  `studentName` varchar(256) default NULL,
  `rollNo` int(12) default NULL,
  `addTime` varchar(256) default NULL,
  PRIMARY KEY  (`attend_StudID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attend_students`
--

INSERT INTO `attend_students` (`attend_StudID`, `sheetID`, `studentName`, `rollNo`, `addTime`) VALUES
(1, 1, 'Abhi', 12, '1495967947'),
(2, 2, 'Abhishek', 5, '1496835370');

-- --------------------------------------------------------

--
-- Table structure for table `attend_subjects`
--

CREATE TABLE `attend_subjects` (
  `subjectID` int(12) NOT NULL auto_increment,
  `sheetID` int(12) NOT NULL,
  `subjectName` varchar(256) default NULL,
  `attendPrivacy` varchar(256) NOT NULL default 'onlyme',
  `addTime` varchar(256) default NULL,
  PRIMARY KEY  (`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attend_subjects`
--

INSERT INTO `attend_subjects` (`subjectID`, `sheetID`, `subjectName`, `attendPrivacy`, `addTime`) VALUES
(1, 1, 'PCD', 'onlyme', '1495967998'),
(2, 2, 'PCD', 'onlyme', '1496835331');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchID` int(11) NOT NULL auto_increment,
  `courseID` int(11) NOT NULL,
  `branchName` varchar(256) default NULL,
  PRIMARY KEY  (`branchID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchID`, `courseID`, `branchName`) VALUES
(1, 1, 'Civil Engineering'),
(2, 1, 'Computer Sci & Technology'),
(3, 1, 'Electrical Engineering'),
(4, 1, 'E&TC'),
(5, 1, 'Mechanical Engineering'),
(6, 1, 'Mechanical Engineering (Part Time)'),
(7, 1, 'Production Engineering'),
(8, 2, 'Architecture'),
(9, 3, 'Agriculture Engineering '),
(10, 3, 'Civil Engineering'),
(11, 3, 'Civil Engineering(2nd Shift)'),
(12, 3, 'Computer Sci & Technology'),
(13, 3, 'Electrical Engineering'),
(14, 3, 'E&TC'),
(15, 3, 'Mechanical Engineering'),
(16, 3, 'Mechanical Engineering (2nd Shift)'),
(17, 3, 'Plastic & Polymer Engineering'),
(18, 4, 'Agriculture Engineering '),
(19, 4, 'Civil Engineering'),
(20, 4, 'Civil Engineering(2nd Shift)'),
(21, 4, 'Computer Sci & Technology'),
(22, 4, 'Electrical Engineering'),
(23, 4, 'E&TC '),
(24, 4, 'Mechanical Engineering'),
(25, 4, 'Mechanical Engineering (2nd Shift)'),
(26, 4, 'Plastic & Polymer Engineering'),
(27, 5, 'Architecture'),
(28, 6, 'MBA'),
(29, 7, 'MCA'),
(30, 8, 'Automation'),
(31, 8, 'Communication Engineering'),
(32, 8, 'Computer Science'),
(33, 8, 'Electrical Drives & Control'),
(34, 8, 'Embedded System'),
(35, 8, 'Heat Power'),
(36, 8, 'Manufacturing Engineering'),
(37, 8, 'Software Engineering'),
(38, 8, 'Structural Engineering'),
(39, 9, 'Computer Sci & Engineering'),
(40, 9, 'E&TC'),
(41, 9, 'Food Processing Technology'),
(42, 9, 'Mechanical Engineering'),
(43, 10, 'Interior Design'),
(44, 11, 'Diploma in Architecture & Design'),
(45, 12, 'Architecture');

-- --------------------------------------------------------

--
-- Table structure for table `coaching_fee`
--

CREATE TABLE `coaching_fee` (
  `cf_ID` int(12) NOT NULL auto_increment,
  `ci_ID` int(12) NOT NULL,
  `courseName` varchar(256) default NULL,
  `courseFee` varchar(256) default NULL,
  `userID` int(12) NOT NULL,
  `cf_time` varchar(256) default NULL,
  PRIMARY KEY  (`cf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `coaching_fee`
--


-- --------------------------------------------------------

--
-- Table structure for table `coaching_institute`
--

CREATE TABLE `coaching_institute` (
  `ci_ID` int(12) NOT NULL auto_increment,
  `instituteName` varchar(256) default NULL,
  `userID` int(12) NOT NULL,
  `ci_photo` varchar(256) default NULL,
  `ci_Address` text,
  `ci_Contact` varchar(12) default NULL,
  `ci_Website` varchar(256) default NULL,
  `startHour` varchar(256) default NULL,
  `closeHour` varchar(256) default NULL,
  `ci_ratingCount` int(12) default NULL,
  `ci_views` int(12) default NULL,
  `ci_updateTime` varchar(256) default NULL,
  PRIMARY KEY  (`ci_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `coaching_institute`
--


-- --------------------------------------------------------

--
-- Table structure for table `coaching_institute_rating`
--

CREATE TABLE `coaching_institute_rating` (
  `ci_ratingID` int(12) NOT NULL auto_increment,
  `ci_ID` int(12) NOT NULL,
  `ci_rating` varchar(256) default NULL,
  `userID` int(12) NOT NULL,
  `ci_ratingTime` varchar(256) default NULL,
  PRIMARY KEY  (`ci_ratingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `coaching_institute_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `coaching_institute_students`
--

CREATE TABLE `coaching_institute_students` (
  `cis_ID` int(12) NOT NULL auto_increment,
  `ci_ID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `cis_addTime` varchar(256) default NULL,
  PRIMARY KEY  (`cis_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `coaching_institute_students`
--


-- --------------------------------------------------------

--
-- Table structure for table `coaching_institute_views`
--

CREATE TABLE `coaching_institute_views` (
  `ci_views_ID` int(12) NOT NULL auto_increment,
  `ci_ID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `ci_viewTime` varchar(256) default NULL,
  PRIMARY KEY  (`ci_views_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `coaching_institute_views`
--


-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `collegeID` int(11) NOT NULL auto_increment,
  `instituteName` varchar(512) default NULL,
  `userID` int(11) NOT NULL,
  `adminID` int(12) NOT NULL,
  `collegePhoto` varchar(256) default NULL,
  `collegeCode` varchar(256) default NULL,
  `collegeAddress` text,
  `collegeContact` varchar(256) default NULL,
  `collegeWebsite` varchar(256) default NULL,
  `collegeDirector` varchar(256) default NULL,
  `ratingCount` int(11) default NULL,
  `views` int(11) default NULL,
  `collegeUpdateTime` varchar(256) default NULL,
  PRIMARY KEY  (`collegeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`collegeID`, `instituteName`, `userID`, `adminID`, `collegePhoto`, `collegeCode`, `collegeAddress`, `collegeContact`, `collegeWebsite`, `collegeDirector`, `ratingCount`, `views`, `collegeUpdateTime`) VALUES
(1, 'Government College of Engineering, Aurangabad', 0, 1, 'GECA_Abad.JPG', '2008', 'Station Road, Osmanpura,Aurangabad', '(0240)2366111', 'www.geca.ac.in', '', NULL, 1, '1488907115'),
(2, ' University Department of Chemical Technology, Aurangabad', 0, 1, 'Cemical_Department_University_Abad.jpg', '2021', 'Dr. Babasaheb Ambedkar Marathwada University Campus, Aurangabad', '(0240)2403308', ' www.bamu.net', '', NULL, 0, '1488907379'),
(3, 'Everest Education Society, Group of Institutions, Aurangabad', 0, 1, 'Everst_Society_Abad.png', '2111', 'Gut No. 187 & 189Ohar, Jatwada Road', '(0240)6450827', 'www.eescoet.org', '', NULL, 0, '1488908406'),
(4, 'Shree Yash Pratishthan, Shreeyash College of Engineering And Technology, Aurangabad', 0, 1, 'Shreyesh_Abad.jpg', '2112', 'Gut No.258 (P), Satara Tanda,Tal Aurangabad', '(0240)6608701', 'www.syp.ac.in', '', NULL, 0, '1488908530'),
(5, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 0, 1, 'MIT_BTech_Abad.jpg', '2113', 'Beed Bypass Road, Satara Village Road, Aurangabad, Maharashtra 431028', '(0240)2375222', 'www.mit.asia', 'Dr.S.P.Bhosle', NULL, 10, '1488908915'),
(6, 'Deogiri Institute of Engineering And Management Studies, Aurangabad', 0, 1, 'Deogiri_Abad.jpg', '2114', 'Deogiri College Campus, Railway Station Road, Aurangabad.', '(0240)2367575 ', 'www.dietms.org', '', NULL, 1, '1488909084'),
(7, 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 0, 1, 'MIT_BE_Abad.jpg', '2126', 'P.B.-327, Satara Village Rd.,off Beed Bypass Highway, Aurangabad.', '(0240)2375375', ' www.mit.asia ', '', NULL, 6, '1488909214'),
(8, 'M.G.M.''s Jawaharlal Nehru Engineering College, Aurangabad', 0, 1, 'MGM_JNEC_Abad.jpg', '2132', 'M.G.M.''s Jawaharlal Nehru Engg. College Campus, N-6, CIDCO.', '(0240)2482893', ' www.jnec.ac.in', '', NULL, 0, '1488909390'),
(9, 'Peoples Education Society''s College of Engineering, Aurangabad', 0, 1, 'PES_Abad.jpg', '2134', 'Nagasen Vana, Near Panchakki, University Rd., Aurangabad', '(0240)2400031 ', 'www.pescoe.ac.in', '', NULL, 0, '1488909483'),
(10, 'Hi-Tech Institute of Technology, Aurangabad', 0, 1, 'Hitech_Waluj.jpg', '2135', 'P-119, Bajaj Nagar, MIDC, Waluj, Aurangabad.', '(0240)2553495/96', 'www.hitechengg.edu.in', '', NULL, 0, '1488909558'),
(11, 'Lokvikas Educational and Charitable Trust Savitaribai Phule Women''s Engg. College, Aurangabad', 0, 1, 'Lokvikas_Abad.jpg', '2139', ' Gut No. 80, Paddari Village, Near Beed Bypass, via Deolai, Near Sai Mandir, Tal. ', ' (0240)6453732', 'www.saiengineeringcollege.in', '', NULL, 0, '1488909659'),
(12, 'Aurangabad College of Engineering, Aurangabad', 0, 1, NULL, '2250', 'Gut No.52, Tuljapur Shivar, Naygaon Savangi, Aurangabad.', '(0240)2485686', 'www.aurangabadengg.com', '', NULL, 0, '1488910187'),
(13, 'Sai Institute of Engineering, Aurangabad', 0, 1, 'Sai_Institute_Abad.jpg', '2515', 'Survey No.170, Sai Nagar, Aurangabad Ajanta Road, Jalgaon Highway,Village Bilda, Tal. Phulambri, Dist. Aurangabad.', '(0240)2020555', 'www.sietaurangabad.com', '', NULL, 0, '1488910396'),
(14, 'International Centre of Excellence in Engineering, Aurangabad', 0, 1, 'Internation_Center_of_Ex_Abad.jpg', '2516', 'Gut No.4, Opp. Bajaj Auto ltd. Infront of MIDC filtration plant,Aurangabad-Pune Highway, Aurangabad.', '(0240)2558120', 'www.iceemabad.com', '', NULL, 0, '1488910493');

-- --------------------------------------------------------

--
-- Table structure for table `college_rating`
--

CREATE TABLE `college_rating` (
  `crID` int(11) NOT NULL auto_increment,
  `collegeID` int(11) NOT NULL,
  `rating` varchar(256) default NULL,
  `userID` int(11) NOT NULL,
  `ratingTime` varchar(256) default NULL,
  PRIMARY KEY  (`crID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `college_rating`
--

INSERT INTO `college_rating` (`crID`, `collegeID`, `rating`, `userID`, `ratingTime`) VALUES
(1, 7, '5', 3, '1489546328'),
(2, 7, '3', 21, '1489592601');

-- --------------------------------------------------------

--
-- Table structure for table `college_request`
--

CREATE TABLE `college_request` (
  `colg_reqID` int(11) NOT NULL auto_increment,
  `instituteName` varchar(512) default NULL,
  `userID` int(11) NOT NULL,
  `collegeCode` varchar(256) default NULL,
  `collegeAddress` text,
  `collegeContact` varchar(256) default NULL,
  `collegeWebsite` varchar(256) default NULL,
  `collegeDirector` varchar(256) default NULL,
  `readStatus` varchar(256) NOT NULL default 'unread',
  `acceptStatus` varchar(256) default NULL,
  `requestTime` varchar(256) default NULL,
  PRIMARY KEY  (`colg_reqID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `college_request`
--

INSERT INTO `college_request` (`colg_reqID`, `instituteName`, `userID`, `collegeCode`, `collegeAddress`, `collegeContact`, `collegeWebsite`, `collegeDirector`, `readStatus`, `acceptStatus`, `requestTime`) VALUES
(1, 'S.D.M.V.M''s Dr.Vedprakash Patil Pharmacy College, Aurangabad', 30, '2154', 'Paithan Road, Abad', '', '', '', 'read', 'pending', '1489951507');

-- --------------------------------------------------------

--
-- Table structure for table `college_views`
--

CREATE TABLE `college_views` (
  `cvID` int(11) NOT NULL auto_increment,
  `collegeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `viewTime` varchar(256) default NULL,
  PRIMARY KEY  (`cvID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `college_views`
--

INSERT INTO `college_views` (`cvID`, `collegeID`, `userID`, `viewTime`) VALUES
(1, 5, 5, '1489509501'),
(2, 5, 4, '1489509519'),
(3, 7, 6, '1489509849'),
(4, 7, 7, '1489510149'),
(5, 5, 3, '1489511810'),
(6, 7, 3, '1489511815'),
(7, 1, 3, '1489511835'),
(8, 5, 16, '1489514387'),
(9, 7, 17, '1489516392'),
(10, 5, 1, '1489519256'),
(11, 5, 18, '1489521004'),
(12, 5, 19, '1489537103'),
(13, 7, 21, '1489592587'),
(14, 5, 22, '1489593499'),
(15, 5, 23, '1489596271'),
(16, 7, 26, '1489760548'),
(17, 5, 27, '1489773820'),
(18, 6, 33, '1495967914');

-- --------------------------------------------------------

--
-- Table structure for table `comp_fee`
--

CREATE TABLE `comp_fee` (
  `compEID` int(12) NOT NULL auto_increment,
  `eventID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `compName` varchar(256) default NULL,
  `compFee` varchar(256) default NULL,
  `compAddTime` varchar(256) default NULL,
  PRIMARY KEY  (`compEID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comp_fee`
--


-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `contactusID` int(12) NOT NULL auto_increment,
  `userID` int(12) default NULL,
  `contactusName` varchar(256) default NULL,
  `contactusEmail` varchar(256) default NULL,
  `contactMessage` text,
  `contactStatus` varchar(256) NOT NULL default 'pending',
  `contactTime` varchar(256) default NULL,
  PRIMARY KEY  (`contactusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contactus`
--


-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL auto_increment,
  `courseName` varchar(256) default NULL,
  PRIMARY KEY  (`courseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `courseName`) VALUES
(1, 'Diploma-Polytechnic'),
(2, 'UG-Bachelor of Architecture (B.Arch)'),
(3, 'UG-Bachelor of Engineering (B.E)'),
(4, 'UG-Bachelor of Technology (B.Tech)'),
(5, 'PG-Master of Architecture (M.Arch)'),
(6, 'PG-Master of Business Admin..(MBA)'),
(7, 'PG-Master of Computer Application (MCA)'),
(8, 'PG-Master of Engineering (M.E)'),
(9, 'PG-Master of Technology (M.Tech)'),
(10, 'UG-Bachelore of Design(Interior Design)'),
(11, 'Diploma-Foundation Diploma in Architecture & Design'),
(12, 'UG-Bachelor of Architecture (B.Arch-YCMOU)');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `downloadID` int(11) NOT NULL auto_increment,
  `userID` int(11) NOT NULL,
  `uploadID` int(11) NOT NULL,
  `downTime` varchar(256) default NULL,
  PRIMARY KEY  (`downloadID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`downloadID`, `userID`, `uploadID`, `downTime`) VALUES
(1, 3, 1, '1489511993'),
(2, 17, 1, '1489515752'),
(3, 26, 1, '1489900754'),
(4, 3, 1, '1489921325');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `eventName` varchar(256) default NULL,
  `eventPhoto` varchar(256) default NULL,
  `eventContact` varchar(12) default NULL,
  `webName` varchar(256) default NULL,
  `textMessage` text,
  `eventViews` int(12) default NULL,
  `evenUpdateTime` varchar(256) default NULL,
  `createTime` varchar(256) default NULL,
  PRIMARY KEY  (`eventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `userID`, `eventName`, `eventPhoto`, `eventContact`, `webName`, `textMessage`, `eventViews`, `evenUpdateTime`, `createTime`) VALUES
(1, 1, 'TEST', NULL, NULL, NULL, NULL, NULL, NULL, '1493054409');

-- --------------------------------------------------------

--
-- Table structure for table `event_co`
--

CREATE TABLE `event_co` (
  `coID` int(12) NOT NULL auto_increment,
  `addBy` int(12) NOT NULL,
  `addedTo` int(12) NOT NULL,
  `eventID` int(12) NOT NULL,
  `coAddTime` varchar(256) default NULL,
  PRIMARY KEY  (`coID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `event_co`
--


-- --------------------------------------------------------

--
-- Table structure for table `event_posts`
--

CREATE TABLE `event_posts` (
  `epID` int(12) NOT NULL auto_increment,
  `eventID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `eventTextPost` text,
  `eventPostPhoto` varchar(256) default NULL,
  `eventPostTime` varchar(256) default NULL,
  PRIMARY KEY  (`epID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `event_posts`
--

INSERT INTO `event_posts` (`epID`, `eventID`, `userID`, `eventTextPost`, `eventPostPhoto`, `eventPostTime`) VALUES
(1, 1, 1, 'ye', NULL, '1493054421');

-- --------------------------------------------------------

--
-- Table structure for table `event_register_user`
--

CREATE TABLE `event_register_user` (
  `eruID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `eventID` int(12) NOT NULL,
  `compEID` int(12) NOT NULL,
  `participantContact` varchar(12) default NULL,
  `partner1` varchar(256) default NULL,
  `partner2` varchar(256) default NULL,
  `partner3` varchar(256) default NULL,
  `partner4` varchar(256) default NULL,
  `partner5` varchar(256) default NULL,
  `eventRegisterTime` varchar(256) default NULL,
  PRIMARY KEY  (`eruID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `event_register_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `event_view`
--

CREATE TABLE `event_view` (
  `eventViewID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `eventID` int(12) NOT NULL,
  `eventViewTime` varchar(256) default NULL,
  PRIMARY KEY  (`eventViewID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `event_view`
--

INSERT INTO `event_view` (`eventViewID`, `userID`, `eventID`, `eventViewTime`) VALUES
(1, 1, 1, '1493054413'),
(2, 1, 0, '1493054426');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faqID` int(11) NOT NULL auto_increment,
  `question` text,
  `answer` text,
  `faqEmail` varchar(256) default NULL,
  `faqName` varchar(256) default NULL,
  `readStatus` varchar(256) NOT NULL default 'unread',
  `faqTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`faqID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faqID`, `question`, `answer`, `faqEmail`, `faqName`, `readStatus`, `faqTime`) VALUES
(1, 'Why I cant find my college in the list for registration ?', 'Not every college is included into the list, if you want your college in the list just select other option and then register with it and then request for your college with correct details about your college and send that to us.', 'abhiburk@gmail.com', 'Abhishek Burkule', 'unread', '1489499140');

-- --------------------------------------------------------

--
-- Table structure for table `hifi_user`
--

CREATE TABLE `hifi_user` (
  `hifiID` int(12) NOT NULL auto_increment,
  `hifiBy` int(12) NOT NULL,
  `hifiTo` int(12) NOT NULL,
  `hifiWith` int(12) NOT NULL,
  `hifiTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`hifiID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hifi_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `hostelID` int(12) NOT NULL auto_increment,
  `hostelName` varchar(256) NOT NULL,
  `hostelContact` varchar(256) NOT NULL,
  `hostelEmail` varchar(256) NOT NULL,
  `nearCollege` varchar(256) NOT NULL,
  `hostelFor` varchar(256) NOT NULL,
  `hostelType` varchar(256) NOT NULL,
  `hostelAddress` text NOT NULL,
  `ratingCount` int(12) NOT NULL,
  `hostelAddTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`hostelID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hostel`
--


-- --------------------------------------------------------

--
-- Table structure for table `hostel_rating`
--

CREATE TABLE `hostel_rating` (
  `hrID` int(12) NOT NULL auto_increment,
  `hostelID` int(12) NOT NULL,
  `rating` varchar(256) NOT NULL,
  `non_userID` int(12) NOT NULL,
  `ratingTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`hrID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hostel_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `improve_us`
--

CREATE TABLE `improve_us` (
  `improveID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `improveMessage` text,
  `replyMessage` text,
  `readStatus` varchar(12) NOT NULL default 'unread',
  `replyTime` varchar(256) default NULL,
  `improveTime` varchar(256) default NULL,
  PRIMARY KEY  (`improveID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `improve_us`
--

INSERT INTO `improve_us` (`improveID`, `userID`, `improveMessage`, `replyMessage`, `readStatus`, `replyTime`, `improveTime`) VALUES
(1, 6, 'What''s the Moto behind this ?\r\nReply:Talha.shaikh5@gmail.com', NULL, 'unread', '1489517889', '1489509838'),
(2, 1, 'Hiiiii', 'Yes, We will be including other colleges too.If you want your college to the list just request us your college by going to My College Option in your account.', 'read', '1489517889', '1489514866'),
(3, 13, 'If u r passing oye mate to all over student then u must be include in your institute option.. other institute and course... for ex....b.pharm..food tech....agriculture..bsc...so.....plz... include it', 'Yes, We will be including other colleges too.If you want your college to the list just request us your college by going to My College Option in your account.', 'unread', '1489517889', '1489514973'),
(4, 1, 'Hey this is ABhishek Burkule', 'Welcome Abhishek', 'read', '1489519326', '1489519300'),
(5, 27, 'how to delete acc..? \r\nby mistake i have chosen wrong clg ðŸ˜”', NULL, 'unread', NULL, '1489774270'),
(6, 28, 'nice workkkkkkkkkkkkkkkkkkkkkkkkkkk\r\n', NULL, 'unread', NULL, '1489839346'),
(7, 30, 'LOL', NULL, 'unread', NULL, '1489950506'),
(8, 28, 'i uploded som stufffff ', NULL, 'unread', NULL, '1490197930');

-- --------------------------------------------------------

--
-- Table structure for table `matchmate`
--

CREATE TABLE `matchmate` (
  `mmID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `hifi` int(12) NOT NULL,
  `mmTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`mmID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `matchmate`
--


-- --------------------------------------------------------

--
-- Table structure for table `send_records`
--

CREATE TABLE `send_records` (
  `srID` int(12) NOT NULL auto_increment,
  `sendTo` int(12) NOT NULL,
  `sendBy` int(12) NOT NULL,
  `subjectID` int(12) NOT NULL,
  `dateFrom` varchar(256) default NULL,
  `dateTo` varchar(256) default NULL,
  `readStatus` varchar(256) NOT NULL default 'unread',
  `sendTime` varchar(256) default NULL,
  PRIMARY KEY  (`srID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `send_records`
--


-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `subID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `subTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`subID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`subID`, `userID`, `subTime`) VALUES
(1, 6, '1489509892'),
(3, 19, '1489537063'),
(4, 11, '1489547706'),
(5, 17, '1489584484'),
(6, 21, '1489592574'),
(7, 22, '1489593581'),
(8, 3, '1489862495'),
(10, 1, '1493048843');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `uploadID` int(11) NOT NULL auto_increment,
  `userID` int(11) NOT NULL,
  `uploadDoc` varchar(256) default NULL,
  `downloadCount` int(11) default NULL,
  `detail` text,
  `uploadTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`uploadID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`uploadID`, `userID`, `uploadDoc`, `downloadCount`, `detail`, `uploadTime`) VALUES
(1, 6, 'Screenshot_2017-03-13-13-13-44-827_com.instagram.android.png', 4, 'Test 1', '1489510295'),
(26, 28, NULL, 0, 'PECS 2 DATA', '1490197483'),
(27, 28, 'Pecs.pdf', 0, 'PECS DATA \r\n', '1490197532'),
(28, 28, 'DATA WREHOUSING.rar', 0, 'DATA WAREHOUSING PPTs', '1490197810');

-- --------------------------------------------------------

--
-- Table structure for table `upload_catagory`
--

CREATE TABLE `upload_catagory` (
  `ucID` int(11) NOT NULL auto_increment,
  `uploadTag` varchar(256) default NULL,
  PRIMARY KEY  (`ucID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `upload_catagory`
--

INSERT INTO `upload_catagory` (`ucID`, `uploadTag`) VALUES
(1, 'Classbook Notes'),
(2, 'Hardcopy'),
(3, 'Softcopy'),
(4, 'Other'),
(5, 'Question Paper (Softcopy)'),
(6, 'Question Paper (Hardcopy)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL auto_increment,
  `userName` varchar(256) default NULL,
  `userEmail` varchar(256) default NULL,
  `emailPrivacy` varchar(256) NOT NULL default 'onlyMe',
  `userImg` varchar(256) default NULL,
  `company` varchar(256) NOT NULL default 'Student',
  `day` varchar(256) default NULL,
  `month` varchar(256) default NULL,
  `year` varchar(256) default NULL,
  `instituteName` varchar(512) default NULL,
  `courseName` varchar(256) default NULL,
  `branchName` varchar(256) default NULL,
  `eduYear` varchar(256) default NULL,
  `userPass` varchar(256) default NULL,
  `userRealPass` int(1) NOT NULL default '1',
  `signupDate` varchar(256) default NULL,
  PRIMARY KEY  (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userEmail`, `emailPrivacy`, `userImg`, `company`, `day`, `month`, `year`, `instituteName`, `courseName`, `branchName`, `eduYear`, `userPass`, `userRealPass`, `signupDate`) VALUES
(1, 'Abhishek Burkule', 'abhiburk@gmail.com', 'onlyMe', NULL, 'College Staff', '5', '05', '1995', 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', '548cca73919d8e33acf6803cf43012e8', 1, '1489500332'),
(2, 'Kingrk ', 'Ranvirkar.kiran@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', '3768113192a5f29364d609b0ec11e363', 1, '1489508900'),
(3, 'Aditya Rawas', 'adirawas2828@gmail.com', 'onlyMe', 'IMG_20170306_121754.jpg', 'Student', '28', '05', '1996', 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', '9e977820d7ef221359758e586587f45b', 1, '1489509034'),
(4, 'Bawale Ritesh Ramesh', 'bawaleritesh@gmail.com', 'onlyMe', 'PicsArt_03-06-11.01.39.jpg', 'Student', '5', '02', '1998', 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Agriculture Engineering', '2nd Year', 'c857464494bd6934f1d1f44ef2ebea14', 1, '1489509365'),
(5, 'Abhishek', 'abhishekw57@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', '9ee78e1db92332b2227781b31dde3c9c', 1, '1489509448'),
(6, 'Mohammad Talha', 'talha.shaikh5@gmail.com', 'onlyMe', 'IMG_20170306_071943.jpg', 'Student', '5', '11', '1996', 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', '9010d4d6e56f1700355c70d58f9c1b6d', 1, '1489509586'),
(7, 'Rahul sinha', 'rahul@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', 'a6cc44dc19de4b90614fb531f1d306af', 1, '1489509787'),
(8, 'Janhavi Deshmukh', 'janhavi.deshmukh27@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', '83dbb9553eefdce5153274d1b8380a3d', 1, '1489510064'),
(9, 'Anuja Kulkarni ', 'annykuls.ak@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', 'ee8bc42948c0a6af9eac92ca6af1a09f', 1, '1489510385'),
(10, 'Shubham Nimbhore', 'shubhamnimbhore33@gmail.com', 'onlyMe', NULL, 'Student', '20', '01', '1997', 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', 'b6ce9ac12d7c50a797ac7580ed00acf7', 1, '1489510457'),
(11, 'Vishakha Prabhakar Sonawane', 'vishakha466@gmail.com', 'onlyMe', 'IMG-20170311-WA0043.jpg', 'Student', '16', '01', '1996', 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', '654440cd576b222417d873766f295f69', 1, '1489511338'),
(12, 'Shaikh Muktder', 'mjsm188@gmail.com', 'onlyMe', NULL, 'Student', '24', '02', '1997', 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', '325cfc5190de609c6b9b16c00417eaf8', 1, '1489511445'),
(13, 'Payal deore', 'r.deorepayal.1954@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Other', 'Other', 'Other', '4th Year', 'ad5992c5687320d844c71c49e44f1a3d', 1, '1489512384'),
(14, 'Aditya Patil', 'patiladi3110@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', '26313ba87e94e4d3531e6f744982efb5', 1, '1489512739'),
(15, 'pooja abhishek sonawane', 'Sjdyb@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Deogiri Institute of Engineering And Management Studies, Aurangabad', 'PG-Master of Architecture (M.Arch)', 'Architecture', '5th Year', '6eea9b7ef19179a06954edd0f6c05ceb', 1, '1489513541'),
(16, 'Abhijeet Tedle', 't.abhijeet97@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '2nd Year', '85064efb60a9601805dcea56ec5402f7', 1, '1489514297'),
(17, 'apeksha nagesh jadhav', 'apekshajadhav082@gmail.com', 'onlyMe', 'P_20170312_144154_BF.jpg', 'Student', '9', '01', '1997', 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', '51504789c8494efc0c873914ef47687f', 1, '1489515564'),
(18, 'Swapnil Pardikar', 'Swapnilpardikar4@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Mechanical Engineering', '3rd Year', '8b8bb2bfec6859317d5e29ed2f3def58', 1, '1489520951'),
(19, 'Shreyash Pattewar', 'shreyashp47@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '2nd Year', '1e2aa3e84a97c31347b832c320377f74', 1, '1489536932'),
(20, 'Prasad nikam ', 'nikamprasad711@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Other', 'UG-Bachelor of Engineering (B.E)', 'Mechanical Engineering', '3rd Year', 'fdeaa8aae8410e76d1cf2da5f217970a', 1, '1489582642'),
(21, 'prachi kothari', 'kothariprachi2014@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', 'c6e9f8a857f7165b53b830ecfe9ce1ba', 1, '1489592261'),
(22, 'Pooja Dattarao Bhagat', 'Pdbhagat1713@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', '19ae465f1650f9f8c2b358d018c10b8c', 1, '1489593430'),
(23, ' rahul jadhav', 'rahulrj98@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'E&TC', '1st Year', '994a10e125d9301a9bc4bcba1224bb1b', 1, '1489596137'),
(24, 'Rutuja Kale', 'rutukale037@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'E&TC', '3rd Year', '502eb4f63e3525a7a409244ee6913399', 1, '1489636258'),
(25, 'Shivani Ganesh Dahake', 'dahakeshivani@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'E&TC', '3rd Year', '1afb9c415a99e915ab0a6ebfff25039a', 1, '1489751719'),
(26, 'Shamal somani', 'shamalsomani20@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', '1d5bb3e03168e6bcbf4c506bca658955', 1, '1489760403'),
(27, 'Niraja Karwande', 'neerjakarwande123@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Gramodyogik Shikshan Mandal''s Marathwada Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Computer Sci & Technology', '3rd Year', 'c8af47b0421cd952dcd6b5db564b629d', 0, '1489773736'),
(28, 'Abhishek Mandve', 'mandveabhishek@gmail.com', 'onlyMe', 'IMG_20170311_115628.jpg', 'Student', '23', '05', '1996', 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', '82958a3abddf2916d62b5601882f5be7', 1, '1489838832'),
(29, 'mohd nauman', 'coolnauman1994@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, '', 'UG-Bachelor of Engineering (B.E)', 'Civil Engineering', '2nd Year', '16c9966ab9a51d8d73cd811c904cccf3', 1, '1489932328'),
(30, 'Nilesh Nomulwar', 'nileshnomulwar29@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'Other', 'Other', 'Other', '2nd Year', '5971572ccd5e3cc4841b5171e315cae2', 1, '1489949908'),
(31, 'Pawan_Gavti', 'pvngt123@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Technology (B.Tech)', 'Computer Sci & Technology', '3rd Year', 'abdc8706dd444ecfbfe913177022a77b', 1, '1489985924'),
(32, 'mayuri mhaske', 'mhaskemayuri12@gmail.com', 'onlyMe', NULL, 'Student', NULL, NULL, NULL, 'G. S. Mandal''s Maharashtra Institute of Technology, Aurangabad', 'UG-Bachelor of Engineering (B.E)', 'Civil Engineering', '3rd Year', '9c487c2b20c84261230ee35fa20c876e', 1, '1489994784'),
(33, 'Mahesh Suri', 'suri@gmail.com', 'onlyMe', NULL, 'College Staff', NULL, NULL, NULL, 'Deogiri Institute of Engineering And Management Studies, Aurangabad', 'Diploma-Polytechnic', 'Electrical Engineering', '', 'e9e330cc787c54e1a6ce645adaf85305', 1, '1495967899');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `sessionID` int(11) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `session` varchar(256) NOT NULL,
  `sessionTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`sessionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`sessionID`, `userID`, `session`, `sessionTime`) VALUES
(2, 2, '1104188b4da033807f9e190e03c7adb1', '1489508926'),
(4, 4, 'f18544f6236cdde33aae5b1df4e00d8c', '1489509401'),
(5, 5, '4f52fab78eb4c733a4b2953c38eb0696', '1489509458'),
(6, 6, 'eaa4b914ef026d52ef027efcaed1be66', '1489509600'),
(7, 7, '26317986fe86eb4e2a636982842c1b41', '1489509839'),
(9, 8, 'cac970856d50bf12b9b80468392313a0', '1489510077'),
(10, 9, '5130afcc8ae8b35393b4d671fdede0f8', '1489510398'),
(14, 12, '412b6aa15749d88b519cf18b5adeabc6', '1489511521'),
(16, 14, '9e4d441b0fffaa8168ec4282410a686a', '1489512772'),
(17, 15, 'd198dd3c44ce04f3ececa9a45c4ce9cb', '1489513575'),
(23, 19, '5805a83e7503d4747d12cc57fae96e6a', '1489536937'),
(25, 21, '13d761c8f6ba4bf533a878a03b268252', '1489592285'),
(26, 22, 'ab30cd22c2f25a249c9d2350bc5bd2b2', '1489593445'),
(31, 25, 'dfb519914527441347957fe302a3a5ef', '1489751733'),
(32, 26, '9247a9a34417f5522d99235e851d0a8f', '1489760431'),
(34, 27, '5859c1a52ffc9aec1b1ffa3a86a1727a', '1489774114'),
(37, 3, '7eebd8e30e7579e2691445bb479ee954', '1489863665'),
(39, 11, '1990ac62cbce4fe0e7e6279491968abf', '1489929028'),
(42, 31, 'f8f0f7ad6f68ebd806a8d66abc5f6a50', '1489985973'),
(43, 32, 'c8509ac1becfb61b1846921871a10e65', '1489994820'),
(44, 28, 'd4328cac26f8753eea0de8288a6d9061', '1490197405'),
(46, 33, 'pjovvqbu9amlshv5sqtinnei57', '1495967911'),
(48, 1, 'vsgpmep040h5m84mrv6ksh45d0', '1496835316');

-- --------------------------------------------------------

--
-- Table structure for table `user_visit`
--

CREATE TABLE `user_visit` (
  `u_visitID` int(12) NOT NULL auto_increment,
  `userID` int(12) NOT NULL,
  `visitTime` varchar(256) NOT NULL,
  PRIMARY KEY  (`u_visitID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `user_visit`
--

INSERT INTO `user_visit` (`u_visitID`, `userID`, `visitTime`) VALUES
(1, 1, '1489500339'),
(2, 2, '1489508926'),
(3, 3, '1489509048'),
(4, 4, '1489509401'),
(5, 5, '1489509458'),
(6, 6, '1489509600'),
(7, 7, '1489509839'),
(8, 3, '1489509847'),
(9, 3, '1489509916'),
(10, 1, '1489509999'),
(11, 8, '1489510077'),
(12, 9, '1489510398'),
(13, 10, '1489510467'),
(14, 10, '1489510785'),
(15, 11, '1489511355'),
(16, 12, '1489511521'),
(17, 3, '1489511549'),
(18, 13, '1489512399'),
(19, 14, '1489512772'),
(20, 15, '1489513575'),
(21, 16, '1489514322'),
(22, 13, '1489514604'),
(23, 1, '1489514796'),
(24, 13, '1489514843'),
(25, 17, '1489515720'),
(26, 1, '1489519148'),
(27, 1, '1489520388'),
(28, 18, '1489520967'),
(29, 19, '1489536937'),
(30, 3, '1489543233'),
(31, 3, '1489546289'),
(32, 11, '1489547141'),
(33, 17, '1489584384'),
(34, 17, '1489584436'),
(35, 21, '1489592285'),
(36, 21, '1489592438'),
(37, 22, '1489593445'),
(38, 22, '1489593722'),
(39, 23, '1489596180'),
(40, 5, '1489635512'),
(41, 24, '1489636276'),
(42, 3, '1489672973'),
(43, 3, '1489673115'),
(44, 3, '1489673459'),
(45, 3, '1489673504'),
(46, 25, '1489751733'),
(47, 26, '1489760431'),
(48, 27, '1489773753'),
(49, 27, '1489774114'),
(50, 28, '1489838899'),
(51, 3, '1489862327'),
(52, 3, '1489862972'),
(53, 3, '1489863665'),
(54, 3, '1489863696'),
(55, 3, '1489864878'),
(56, 3, '1489866336'),
(57, 3, '1489897034'),
(58, 3, '1489898661'),
(59, 3, '1489898866'),
(60, 26, '1489899883'),
(61, 17, '1489909415'),
(62, 17, '1489909475'),
(63, 3, '1489920355'),
(64, 3, '1489920636'),
(65, 11, '1489920859'),
(66, 3, '1489921266'),
(67, 3, '1489923089'),
(68, 3, '1489928604'),
(69, 11, '1489929028'),
(70, 3, '1489929492'),
(71, 29, '1489932344'),
(72, 30, '1489949942'),
(73, 30, '1489950769'),
(74, 30, '1489951179'),
(75, 30, '1489951442'),
(76, 31, '1489985973'),
(77, 32, '1489994820'),
(78, 3, '1490074749'),
(79, 3, '1490106662'),
(80, 26, '1490107638'),
(81, 3, '1490108525'),
(82, 3, '1490111854'),
(83, 28, '1490197405'),
(84, 10, '1490685230'),
(85, 1, '1490723218'),
(86, 1, '1491143616'),
(87, 1, '1493048805'),
(88, 1, '1493050473'),
(89, 1, '1495967810'),
(90, 33, '1495967911'),
(91, 1, '1496834406'),
(92, 1, '1496835231'),
(93, 1, '1496835316');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `yearID` int(11) NOT NULL auto_increment,
  `year` varchar(256) default NULL,
  PRIMARY KEY  (`yearID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`yearID`, `year`) VALUES
(1, '1st Year'),
(2, '2nd Year'),
(3, '3rd Year'),
(4, '4th Year'),
(5, '5th Year');
