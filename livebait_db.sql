-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2018 at 09:35 AM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.1.20-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livebait_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(512) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `status`, `created`, `modified`) VALUES
(1, 'Admin', 'admin@mailinator.com', '$2y$10$0Kns6yDIkZU.TNUPXBW1f.ZAoPTL8afEbYWtGzwSWv/BqDut7N2pK', 1, '2017-11-13 11:19:31', '2018-07-27 07:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `type`, `heading`, `content`, `created`, `modified`) VALUES
(1, 1, 'About Us', 'Live Bait is an iOS and Android based application which provides a platform to the users to have one on one video chat with the people around them. This application come up with state of the art UI and UX practices which makes this application really fun to use.\r\n                                \r\nVersion 1.0', '2017-12-19 11:06:28', '2018-01-19 06:57:51'),
(2, 3, 'Terms & Condition', 'Acceptance of Terms\r\n\r\n \r\n\r\nThe services that Soroki provides to you are subject to the following Terms of Use (\"TOU\"). Soroki reserves the right to update the TOU at any time without notice to you. The most current version of the TOU can be reviewed by clicking on the \"Terms of Use\" hypertext link located at the bottom of our Web pages.\r\n\r\n \r\n\r\nDescription of Services\r\n\r\n \r\n\r\nThrough its network of Web properties, Soroki provides you with access to a variety of resources, including developer tools, download areas, communication forums and product information (collectively \"Services\"). The Services, including any updates, enhancements, new features, and/or the addition of any new Web properties, are subject to the TOU.\r\n\r\n \r\n\r\nPersonal and Non-Commercial Use Limitation\r\n\r\n \r\n\r\nUnless otherwise specified, the Services are for your personal and non-commercial use. You may not modify, copy, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer, or sell any information, software, products or services obtained from the Services.\r\n\r\n \r\n\r\nPrivacy and Protection of Personal Information\r\n\r\n \r\n\r\nSee the Privacy Statement disclosures relating to the collection and use of your information.\r\n\r\n \r\n\r\nNotice Specific to Software Available on this Website\r\n\r\n \r\n\r\nAny software that is made available to download from the Services (\"Software\") is the copyrighted work of Soroki and/or its suppliers. Use of the Software is governed by the terms of the end user license agreement, if any, which accompanies or is included with the Software (\"License Agreement\"). An end user will be unable to install any Software that is accompanied by or includes a License Agreement, unless he or she first agrees to the License Agreement terms. Third party scripts or code, linked to or referenced from this website, are licensed to you by the third parties that own such code, not by Soroki.\r\n\r\nThe Software is made available for download solely for use by end users according to the License Agreement. Any reproduction or redistribution of the Software not in accordance with the License Agreement is expressly prohibited by law, and may result in severe civil and criminal penalties. Violators will be prosecuted to the maximum extent possible.\r\n\r\nWITHOUT LIMITING THE FOREGOING, COPYING OR REPRODUCTION OF THE SOFTWARE TO ANY OTHER SERVER OR LOCATION FOR FURTHER REPRODUCTION OR REDISTRIBUTION IS EXPRESSLY PROHIBITED, UNLESS SUCH REPRODUCTION OR REDISTRIBUTION IS EXPRESSLY PERMITTED BY THE LICENSE AGREEMENT ACCOMPANYING SUCH SOFTWARE.\r\n\r\nTHE SOFTWARE IS WARRANTED, IF AT ALL, ONLY ACCORDING TO THE TERMS OF THE LICENSE AGREEMENT. EXCEPT AS WARRANTED IN THE LICENSE AGREEMENT, Soroki CORPORATION HEREBY DISCLAIMS ALL WARRANTIES AND CONDITIONS WITH REGARD TO THE SOFTWARE, INCLUDING ALL WARRANTIES AND CONDITIONS OF MERCHANTABILITY, WHETHER EXPRESS, IMPLIED OR STATUTORY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. FOR YOUR CONVENIENCE, Soroki MAY MAKE AVAILABLE AS PART OF THE SERVICES OR IN ITS SOFTWARE PRODUCTS, TOOLS AND UTILITIES FOR USE AND/OR DOWNLOAD. Soroki DOES NOT MAKE ANY ASSURANCES WITH REGARD TO THE ACCURACY OF THE RESULTS OR OUTPUT THAT DERIVES FROM SUCH USE OF ANY SUCH TOOLS AND UTILITIES. PLEASE RESPECT THE INTELLECTUAL PROPERTY RIGHTS OF OTHERS WHEN USING THE TOOLS AND UTILITIES MADE AVAILABLE ON THE SERVICES OR IN Soroki SOFTWARE PRODUCTS.\r\n\r\nRESTRICTED RIGHTS LEGEND. Any Software which is downloaded from the Services for or on behalf of the United States of America, its agencies and/or instrumentalities (\"U.S. Government\"), is provided with Restricted Rights. Use, duplication, or disclosure by the U.S. Government is subject to restrictions as set forth in subparagraph (c)(1)(ii) of the Rights in Technical Data and Computer Software clause at DFARS 252.227-7013 or subparagraphs (c)(1) and (2) of the Commercial Computer Software - Restricted Rights at 48 CFR 52.227-19, as applicable. Manufacturer is Soroki Corporation, One Soroki Way, Redmond, WA 98052-6399.\r\n\r\nTop of Page\r\n\r\nNotice Specific to Documents Available on this Website\r\n\r\n \r\n\r\nPermission to use Documents (such as white papers, press releases, datasheets and FAQs) from the Services is granted, provided that (1) the below copyright notice appears in all copies and that both the copyright notice and this permission notice appear, (2) use of such Documents from the Services is for informational and non-commercial or personal use only and will not be copied or posted on any network computer or broadcast in any media, and (3) no modifications of any Documents are made. Accredited educational institutions, such as K-12, universities, private/public colleges, and state community colleges, may download and reproduce the Documents for distribution in the classroom. Distribution outside the classroom requires express written permission. Use for any other purpose is expressly prohibited by law, and may result in severe civil and criminal penalties. Violators will be prosecuted to the maximum extent possible.\r\n\r\nDocuments specified above do not include the design or layout of the Soroki.com website or any other Soroki owned, operated, licensed or controlled site. Elements of Soroki websites are protected by trade dress, trademark, unfair competition, and other laws and may not be copied or imitated in whole or in part. No logo, graphic, sound or image from any Soroki website may be copied or retransmitted unless expressly permitted by Soroki.\r\n\r\nSoroki AND/OR ITS RESPECTIVE SUPPLIERS MAKE NO REPRESENTATIONS ABOUT THE SUITABILITY OF THE INFORMATION CONTAINED IN THE DOCUMENTS AND RELATED GRAPHICS PUBLISHED AS PART OF THE SERVICES FOR ANY PURPOSE. ALL SUCH DOCUMENTS AND RELATED GRAPHICS ARE PROVIDED \"AS IS\" WITHOUT WARRANTY OF ANY KIND. Soroki AND/OR ITS RESPECTIVE SUPPLIERS HEREBY DISCLAIM ALL WARRANTIES AND CONDITIONS WITH REGARD TO THIS INFORMATION, INCLUDING ALL WARRANTIES AND CONDITIONS OF MERCHANTABILITY, WHETHER EXPRESS, IMPLIED OR STATUTORY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. IN NO EVENT SHALL Soroki AND/OR ITS RESPECTIVE SUPPLIERS BE LIABLE FOR ANY SPECIAL, INDIRECT OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF INFORMATION AVAILABLE FROM THE SERVICES.\r\n\r\nTHE DOCUMENTS AND RELATED GRAPHICS PUBLISHED ON THE SERVICES COULD INCLUDE TECHNICAL INACCURACIES OR TYPOGRAPHICAL ERRORS. CHANGES ARE PERIODICALLY ADDED TO THE INFORMATION HEREIN. Soroki AND/OR ITS RESPECTIVE SUPPLIERS MAY MAKE IMPROVEMENTS AND/OR CHANGES IN THE PRODUCT(S) AND/OR THE PROGRAM(S) DESCRIBED HEREIN AT ANY TIME.\r\n\r\nTop of Page\r\n\r\nNotices Regarding Software, Documents, and Services Available\r\n\r\non this Website\r\n\r\n \r\n\r\nIN NO EVENT SHALL Soroki AND/OR ITS RESPECTIVE SUPPLIERS BE LIABLE FOR ANY SPECIAL, INDIRECT OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF SOFTWARE, DOCUMENTS, PROVISION OF OR FAILURE TO PROVIDE SERVICES, OR INFORMATION AVAILABLE FROM THE SERVICES.\r\n\r\nTop of Page\r\n\r\nMember Account, Password, and Security\r\n\r\n \r\n\r\nIf any of the Services requires you to open an account, you must complete the registration process by providing us with current, complete and accurate information as prompted by the applicable registration form. You also will choose a password and a user name. You are entirely responsible for maintaining the confidentiality of your password and account. Furthermore, you are entirely responsible for any and all activities that occur under your account. You agree to notify Soroki immediately of any unauthorized use of your account or any other breach of security. Soroki will not be liable for any loss that you may incur as a result of someone else using your password or account, either with or without your knowledge. However, you could be held liable for losses incurred by Soroki or another party due to someone else using your account or password. You may not use anyone else\'s account at any time, without the permission of the account holder.\r\n\r\nTop of Page\r\n\r\nNo Unlawful or Prohibited Use\r\n\r\n \r\n\r\nAs a condition of your use of the Services, you will not use the Services for any purpose that is unlawful or prohibited by these terms, conditions, and notices. You may not use the Services in any manner that could damage, disable, overburden, or impair any Soroki server, or the network(s) connected to any Soroki server, or interfere with any other party\'s use and enjoyment of any Services. You may not attempt to gain unauthorized access to any Services, other accounts, computer systems or networks connected to any Soroki server or to any of the Services, through hacking, password mining or any other means. You may not obtain or attempt to obtain any materials or information through any means not intentionally made available through the Services.\r\n\r\nTop of Page\r\n\r\nUse of Services\r\n\r\n \r\n\r\nThe Services may contain e-mail services, bulletin board services, chat areas, news groups, forums, communities, personal web pages, calendars, photo albums, file cabinets and/or other message or communication facilities designed to enable you to communicate with others (each a \"Communication Service\" and collectively \"Communication Services\"). You agree to use the Communication Services only to post, send and receive messages and material that are proper and, when applicable, related to the particular Communication Service. By way of example, and not as a limitation, you agree that when using the Communication Services, you will not:\r\n\r\nUse the Communication Services in connection with surveys, contests, pyramid schemes, chain letters, junk email, spamming or any duplicative or unsolicited messages (commercial or otherwise).\r\n\r\nDefame, abuse, harass, stalk, threaten or otherwise violate the legal rights (such as rights of privacy and publicity) of others.\r\n\r\nPublish, post, upload, distribute or disseminate any inappropriate, profane, defamatory, obscene, indecent or unlawful topic, name, material or information.\r\n\r\nUpload, or otherwise make available, files that contain images, photographs, software or other material protected by intellectual property laws, including, by way of example, and not as limitation, copyright or trademark laws (or by rights of privacy or publicity) unless you own or control the rights thereto or have received all necessary consent to do the same.\r\n\r\nUse any material or information, including images or photographs, which are made available through the Services in any manner that infringes any copyright, trademark, patent, trade secret, or other proprietary right of any party.\r\n\r\nUpload files that contain viruses, Trojan horses, worms, time bombs, cancelbots, corrupted files, or any other similar software or programs that may damage the operation of another\'s computer or property of another.\r\n\r\nAdvertise or offer to sell or buy any goods or services for any business purpose, unless such Communication Services specifically allows such messages.\r\n\r\nDownload any file posted by another user of a Communication Service that you know, or reasonably should know, cannot be legally reproduced, displayed, performed, and/or distributed in such manner.\r\n\r\nFalsify or delete any copyright management information, such as author attributions, legal or other proper notices or proprietary designations or labels of the origin or source of software or other material contained in a file that is uploaded.\r\n\r\nRestrict or inhibit any other user from using and enjoying the Communication Services.\r\n\r\nViolate any code of conduct or other guidelines which may be applicable for any particular Communication Service.\r\n\r\nHarvest or otherwise collect information about others, including e-mail addresses.\r\n\r\nViolate any applicable laws or regulations.\r\n\r\nCreate a false identity for the purpose of misleading others.\r\n\r\nUse, download or otherwise copy, or provide (whether or not for a fee) to a person or entity any directory of users of the Services or other user or usage information or any portion thereof.\r\n\r\nSoroki has no obligation to monitor the Communication Services. However, Soroki reserves the right to review materials posted to the Communication Services and to remove any materials in its sole discretion. Soroki reserves the right to terminate your access to any or all of the Communication Services at any time, without notice, for any reason whatsoever.\r\n\r\nSoroki reserves the right at all times to disclose any information as Soroki deems necessary to satisfy any applicable law, regulation, legal process or governmental request, or to edit, refuse to post or to remove any information or materials, in whole or in part, in Soroki\'s sole discretion.\r\n\r\nAlways use caution when giving out any personally identifiable information about yourself or your children in any Communication Services. Soroki does not control or endorse the content, messages or information found in any Communication Services and, therefore, Soroki specifically disclaims any liability with regard to the Communication Services and any actions resulting from your participation in any Communication Services. Managers and hosts are not authorized Soroki spokespersons, and their views do not necessarily reflect those of Soroki.\r\n\r\nMaterials uploaded to the Communication Services may be subject to posted limitations on usage, reproduction and/or dissemination; you are responsible for adhering to such limitations if you download the materials.\r\n\r\nTop of Page\r\n\r\nMaterials Provided to Soroki or Posted at Any Soroki Website\r\n\r\n \r\n\r\nSoroki does not claim ownership of the materials you provide to Soroki (including feedback and suggestions) or post, upload, input or submit to any Services or its associated services for review by the general public, or by the members of any public or private community, (each a \"Submission\" and collectively \"Submissions\"). However, by posting, uploading, inputting, providing or submitting (\"Posting\") your Submission you are granting Soroki, its affiliated companies and necessary sublicensees permission to use your Submission in connection with the operation of their Internet businesses (including, without limitation, all Soroki Services), including, without limitation, the license rights to: copy, distribute, transmit, publicly display, publicly perform, reproduce, edit, translate and reformat your Submission; to publish your name in connection with your Submission; and the right to sublicense such rights to any supplier of the Services.\r\n\r\nNo compensation will be paid with respect to the use of your Submission, as provided herein. Soroki is under no obligation to post or use any Submission you may provide and Soroki may remove any Submission at any time in its sole discretion.\r\n\r\nBy Posting a Submission you warrant and represent that you own or otherwise control all of the rights to your Submission as described in these Terms of Use including, without limitation, all the rights necessary for you to provide, post, upload, input or submit the Submissions.\r\n\r\nIn addition to the warranty and representation set forth above, by Posting a Submission that contain images, photographs, pictures or that are otherwise graphical in whole or in part (\"Images\"), you warrant and represent that (a) you are the copyright owner of such Images, or that the copyright owner of such Images has granted you permission to use such Images or any content and/or images contained in such Images consistent with the manner and purpose of your use and as otherwise permitted by these Terms of Use and the Services, (b) you have the rights necessary to grant the licenses and sublicenses described in these Terms of Use, and (c) that each person depicted in such Images, if any, has provided consent to the use of the Images as set forth in these Terms of Use, including, by way of example, and not as a limitation, the distribution, public display and reproduction of such Images. By Posting Images, you are granting (a) to all members of your private community (for each such Images available to members of such private community), and/or (b) to the general public (for each such Images available anywhere on the Services, other than a private community), permission to use your Images in connection with the use, as permitted by these Terms of Use, of any of the Services, (including, by way of example, and not as a limitation, making prints and gift items which include such Images), and including, without limitation, a non-exclusive, world-wide, royalty-free license to: copy, distribute, transmit, publicly display, publicly perform, reproduce, edit, translate and reformat your Images without having your name attached to such Images, and the right to sublicense such rights to any supplier of the Services. The licenses granted in the preceding sentences for a Images will terminate at the time you completely remove such Images from the Services, provided that, such termination shall not affect any licenses granted in connection with such Images prior to the time you completely remove such Images. No compensation will be paid with respect to the use of your Images.\r\n\r\nTop of Page\r\n\r\nNotices and Procedure for Making Claims of Copyright Infringement\r\n\r\n \r\n\r\nPursuant to Title 17, United States Code, Section 512(c)(2), notifications of claimed copyright infringement should be sent to Service Provider\'s Designated Agent. ALL INQUIRIES NOT RELEVANT TO THE FOLLOWING PROCEDURE WILL NOT RECEIVE A RESPONSE.\r\n\r\nSee Notice and Procedure for Making Claims of Copyright Infringement.\r\n\r\nTop of Page\r\n\r\nLinks to Third Party Sites\r\n\r\n \r\n\r\nTHE LINKS IN THIS AREA WILL LET YOU LEAVE Soroki\'S SITE. THE LINKED SITES ARE NOT UNDER THE CONTROL OF Soroki AND Soroki IS NOT RESPONSIBLE FOR THE CONTENTS OF ANY LINKED SITE OR ANY LINK CONTAINED IN A LINKED SITE, OR ANY CHANGES OR UPDATES TO SUCH SITES. Soroki IS NOT RESPONSIBLE FOR WEBCASTING OR ANY OTHER FORM OF TRANSMISSION RECEIVED FROM ANY LINKED SITE. Soroki IS PROVIDING THESE LINKS TO YOU ONLY AS A CONVENIENCE, AND THE INCLUSION OF ANY LINK DOES NOT IMPLY ENDORSEMENT BY Soroki OF THE SITE.\r\n\r\nTop of Page\r\n\r\nUnsolicited Idea Submission Policy\r\n\r\n \r\n\r\nSoroki OR ANY OF ITS EMPLOYEES DO NOT ACCEPT OR CONSIDER UNSOLICITED IDEAS, INCLUDING IDEAS FOR NEW ADVERTISING CAMPAIGNS, NEW PROMOTIONS, NEW PRODUCTS OR TECHNOLOGIES, PROCESSES, MATERIALS, MARKETING PLANS OR NEW PRODUCT NAMES. PLEASE DO NOT SEND ANY ORIGINAL CREATIVE ARTWORK, SAMPLES, DEMOS, OR OTHER WORKS. THE SOLE PURPOSE OF THIS POLICY IS TO AVOID POTENTIAL MISUNDERSTANDINGS OR DISPUTES WHEN Soroki\'S PRODUCTS OR MARKETING STRATEGIES MIGHT SEEM SIMILAR TO IDEAS SUBMITTED TO Soroki. SO, PLEASE DO NOT SEND YOUR UNSOLICITED IDEAS TO Soroki OR ANYONE AT Soroki. IF, DESPITE OUR REQUEST THAT YOU NOT SEND US YOUR IDEAS AND MATERIALS, YOU STILL SEND THEM, PLEASE UNDERSTAND THAT Soroki MAKES NO ASSURANCES THAT YOUR IDEAS AND MATERIALS WILL BE TREATED AS CONFIDENTIAL OR PROPRIETARY.', '2018-01-19 07:01:26', '2018-01-19 07:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `plan_id` int(11) NOT NULL,
  `payment_data` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = failed , 1 =  success',
  `user_id` int(11) NOT NULL,
  `device` enum('A','I') NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `created`, `modified`, `plan_id`, `payment_data`, `status`, `user_id`, `device`, `amount`) VALUES
(1, '2018-09-28 05:52:48', '2018-09-28 05:52:48', 1, '{}', 1, 4, 'A', 0.99),
(2, '2018-09-28 06:14:14', '2018-09-28 06:14:14', 4, '{}', 1, 4, 'A', 5.99);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `no_of_chats` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `price` float NOT NULL,
  `subsc` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 = monthly , 2 = yearly ,  3 = weekly'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `created`, `name`, `no_of_chats`, `modified`, `price`, `subsc`, `type`) VALUES
(1, '2018-09-28 00:00:00', '$0.99 for 1 chat  ', 1, '2018-09-28 00:00:00', 0.99, 0, 0),
(2, '2018-09-28 00:00:00', '$1.99 for 3 chats', 3, '2018-09-28 00:00:00', 1.99, 0, 0),
(3, '2018-09-28 00:00:00', '$4.99 for 20 chats', 20, '2018-09-28 00:00:00', 4.99, 0, 0),
(4, '2018-09-28 00:00:00', '$5.99/Mo for unlimited chats', -1, '2018-09-28 00:00:00', 5.99, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `report_spams`
--

CREATE TABLE `report_spams` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `screenshot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `duration` varchar(8) DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=> pending, 1=> accept, 2=> reject, 3=> not_intrested',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `touser` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `type` int(20) NOT NULL COMMENT '(1=> contact sharing, 2=> address sharing)',
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `txn_id` text NOT NULL,
  `device` enum('I','A') NOT NULL,
  `appdata` text NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0 = suspended , 1 = active',
  `app_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `created`, `modified`, `user_id`, `txn_id`, `device`, `appdata`, `status`, `app_status`) VALUES
(1, '2018-01-19 13:14:43', '2018-01-19 13:14:43', 40, '32323', 'A', '{\"json\":\"data\"}', '1', ''),
(2, '2018-09-28 05:52:48', '2018-09-28 05:52:48', 2, '33333333333333', 'A', '{}', '1', ''),
(3, '2018-09-28 06:14:14', '2018-09-28 06:14:14', 2, '33333333333333', 'A', '{}', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL DEFAULT '',
  `username` varchar(128) NOT NULL DEFAULT '',
  `fb_id` varchar(128) NOT NULL DEFAULT '',
  `quickblox_id` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(256) NOT NULL DEFAULT '',
  `profile_image` varchar(255) NOT NULL DEFAULT '',
  `phone_number` varchar(64) NOT NULL DEFAULT '',
  `age` int(11) NOT NULL,
  `sex` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=>male, 2=>female, 3=>gender diverse',
  `occupation` varchar(64) NOT NULL DEFAULT '',
  `drink` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=>yes, 2=>socially, 3=>never',
  `smoke` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=>yes, 2=>socially, 3=>never',
  `nature` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=>friendly, 2=>never',
  `kids` smallint(6) NOT NULL DEFAULT '0' COMMENT '0=>no, 1=>yes',
  `received_video_chat` smallint(6) NOT NULL DEFAULT '1' COMMENT '0=>no, 1=>yes',
  `account_status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=>free, 2=>premium',
  `heading` text NOT NULL,
  `country_code` varchar(8) NOT NULL DEFAULT '',
  `lat` varchar(64) DEFAULT '',
  `lon` varchar(64) DEFAULT '',
  `loginToken` varchar(128) NOT NULL DEFAULT '',
  `deviceToken` varchar(255) NOT NULL DEFAULT '',
  `deviceType` varchar(2) NOT NULL DEFAULT '' COMMENT 'A => android, I => ios',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '0=>suspended, 1=>active',
  `isMobileVerified` int(11) NOT NULL DEFAULT '0' COMMENT '0=>no, 1=>yes',
  `paid_calls` int(11) NOT NULL DEFAULT '0',
  `unpaid_calls` int(11) NOT NULL DEFAULT '3',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subscribed` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = not subscribed  , 1 = subscribed',
  `unlimited_till` date NOT NULL,
  `profile_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fb_id`, `quickblox_id`, `name`, `profile_image`, `phone_number`, `age`, `sex`, `occupation`, `drink`, `smoke`, `nature`, `kids`, `received_video_chat`, `account_status`, `heading`, `country_code`, `lat`, `lon`, `loginToken`, `deviceToken`, `deviceType`, `status`, `isMobileVerified`, `paid_calls`, `unpaid_calls`, `created`, `modified`, `subscribed`, `unlimited_till`, `profile_url`) VALUES
(13, 'xicomtest11@gmail.com', 'marsh', '1891077677651160', '62235317', 'Marshal Erickk', '', '', 21, 1, 'doc', 1, 1, 1, 0, 1, 1, 'Haj', '', '28.62098', '77.08201', 'fc115e643ccd06ed9ac4f56173639f93e148ab7f', '0d57d8c9d82868e47120309cd78d51ff6dbf7fabe36c3083bd4cc59279c9bcf1', 'I', 1, 0, 0, 3, '2018-10-03 13:20:38', '2018-10-08 12:52:39', '0', '0000-00-00', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEZAtVVhGbEM2ZAlBJdm4tSFh2Y0FQcGY4cEFvS3RINnpWMVgtUDFWZAUVuc25aaUVmQWtGUWRmVEpDOVNEMW9CMVlGcjcyQlhadXduOElDUHJGeFpRTUlLd2ZAEMXJ6YWFKZA1lfSllzVDF2aHk5ZAWhXSlEZD/'),
(14, 'xicomtest12@gmail.com', 'Sam', '1831914713565539', '62235845', 'Samuels Mike', '', '', 22, 1, 'law', 1, 1, 1, 0, 1, 1, 'Hiiii', '', '30.71300', '76.84129', '82fb4c37386f381816689953c0fbe41b284c86b2', 'simulator', 'I', 1, 0, 0, 3, '2018-10-03 13:29:59', '2018-10-08 12:58:17', '0', '0000-00-00', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEZAwY2NMTUpBblpqcGhsLTgzdWFrdVByYW4wNlFsNDVnVTlUWWkwSVpyOEJ2eHNZAWnNISEhTYWlEZAGo1Q2M0SUNEM3FLa296N0J2Y3QyVkR2elhYRkpDOHVqZADFwckt2YnZAWVmxWcng1TVI3UWxpencZD/'),
(15, 'jlewis@agentmailbox.net', 'john', '2357843740909009', '62299624', 'John Lewis', '', '', 20, 1, 'doc', 1, 1, 1, 0, 1, 1, 'Hello', '', '30.71300', '76.84129', '', 'simulator', 'I', 1, 0, 0, 3, '2018-10-04 04:59:27', '2018-10-08 06:31:02', '0', '0000-00-00', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEhvUFE4WWpZAWE5kanFObFZAMQWQtNGM3M1k0SWwtYXNydnJ6SFZATZAXVJemJUSXlJb1A2MUREVDJ4TUh0bEFQOXBjTkNiZA1FBOHhrU1h1SGh4emxHaE9RNHN5UngyeFJOTXF0T21hLV9PWkxmNF9Rb3cZD/');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_not_interesteds`
--

CREATE TABLE `user_not_interesteds` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_not_interesteds`
--

INSERT INTO `user_not_interesteds` (`id`, `user_from`, `user_to`, `created`) VALUES
(1, 6, 1, '2018-09-20 12:05:02'),
(2, 1, 6, '2018-09-20 12:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `start_time`, `end_time`) VALUES
(1, 1, '2018-08-23 12:30:32', '2018-08-23 12:38:15'),
(2, 1, '2018-08-24 12:19:02', '0000-00-00 00:00:00'),
(3, 2, '2018-08-24 12:26:51', '2018-10-03 09:35:47'),
(4, 3, '2018-08-24 13:06:43', '2018-08-27 10:20:11'),
(5, 4, '2018-08-24 13:11:09', '0000-00-00 00:00:00'),
(6, 5, '2018-08-27 05:58:08', '0000-00-00 00:00:00'),
(7, 6, '2018-08-27 09:53:24', '2018-10-01 12:21:57'),
(8, 7, '2018-09-12 21:28:37', '0000-00-00 00:00:00'),
(9, 8, '2018-09-28 10:55:29', '2018-10-01 12:32:08'),
(10, 6, '2018-10-01 12:24:05', '2018-10-01 12:37:08'),
(11, 8, '2018-10-01 12:32:35', '2018-10-01 12:45:02'),
(12, 6, '2018-10-01 12:37:47', '2018-10-01 12:39:15'),
(13, 6, '2018-10-01 12:40:14', '2018-10-01 12:41:12'),
(14, 6, '2018-10-01 12:41:51', '2018-10-01 12:44:55'),
(15, 8, '2018-10-01 12:45:05', '2018-10-03 12:25:26'),
(16, 6, '2018-10-01 12:45:16', '2018-10-01 12:48:21'),
(17, 6, '2018-10-01 12:49:44', '2018-10-01 12:49:57'),
(18, 6, '2018-10-01 12:51:44', '2018-10-01 12:51:49'),
(19, 6, '2018-10-01 12:56:26', '0000-00-00 00:00:00'),
(20, 2, '2018-10-03 09:54:08', '2018-10-03 10:09:21'),
(21, 2, '2018-10-03 10:31:08', '2018-10-03 10:45:03'),
(22, 9, '2018-10-03 10:41:25', '2018-10-03 10:44:51'),
(23, 2, '2018-10-03 10:48:00', '0000-00-00 00:00:00'),
(24, 9, '2018-10-03 10:49:12', '2018-10-03 10:58:56'),
(25, 9, '2018-10-03 11:02:20', '2018-10-03 11:12:17'),
(26, 9, '2018-10-03 11:12:35', '2018-10-03 11:16:45'),
(27, 9, '2018-10-03 11:16:59', '2018-10-03 11:17:27'),
(28, 9, '2018-10-03 11:17:48', '2018-10-03 11:21:19'),
(29, 8, '2018-10-03 12:25:54', '2018-10-03 12:41:44'),
(30, 8, '2018-10-03 12:48:05', '0000-00-00 00:00:00'),
(31, 10, '2018-10-03 12:55:37', '0000-00-00 00:00:00'),
(32, 11, '2018-10-03 13:04:16', '0000-00-00 00:00:00'),
(33, 12, '2018-10-03 13:16:54', '0000-00-00 00:00:00'),
(34, 13, '2018-10-03 13:20:38', '2018-10-04 04:57:26'),
(35, 14, '2018-10-03 13:29:59', '2018-10-04 04:45:06'),
(36, 14, '2018-10-04 04:45:25', '2018-10-04 04:45:29'),
(37, 14, '2018-10-04 04:46:38', '2018-10-08 12:21:29'),
(38, 15, '2018-10-04 04:59:27', '2018-10-04 05:07:43'),
(39, 13, '2018-10-04 05:00:12', '2018-10-04 05:38:09'),
(40, 13, '2018-10-04 05:39:11', '2018-10-08 12:21:39'),
(41, 14, '2018-10-08 12:22:31', '2018-10-08 12:22:58'),
(42, 14, '2018-10-08 12:24:08', '2018-10-08 12:24:30'),
(43, 14, '2018-10-08 12:24:51', '2018-10-08 12:25:19'),
(44, 14, '2018-10-08 12:35:20', '2018-10-08 12:35:52'),
(45, 14, '2018-10-08 12:36:49', '0000-00-00 00:00:00'),
(46, 13, '2018-10-08 12:41:53', '2018-10-08 12:48:47'),
(47, 13, '2018-10-08 12:49:05', '2018-10-08 12:51:51'),
(48, 13, '2018-10-08 12:52:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dating` varchar(8) NOT NULL DEFAULT '' COMMENT '1=>male, 2=>female, 3=>gender diverse',
  `distance` smallint(6) NOT NULL,
  `age_from` smallint(6) NOT NULL,
  `age_to` smallint(6) NOT NULL,
  `app_sound_vibration` smallint(6) NOT NULL DEFAULT '1' COMMENT '0=>no, 1=>yes',
  `push_notifications` smallint(6) NOT NULL DEFAULT '1' COMMENT '0=>no, 1=>yes',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `dating`, `distance`, `age_from`, `age_to`, `app_sound_vibration`, `push_notifications`, `created`, `modified`) VALUES
(1, 1, '2,1,3', 100, 18, 100, 1, 1, '2018-08-22 10:38:03', '2018-08-22 10:39:06'),
(2, 2, '1,2,3', 100, 18, 100, 1, 1, '2018-08-22 10:39:47', '2018-10-03 10:56:17'),
(3, 1, '1', 10, 0, 0, 1, 1, '2018-08-23 12:30:32', '2018-08-23 12:30:32'),
(4, 2, '1', 10, 0, 0, 1, 1, '2018-08-24 12:26:51', '2018-08-24 12:26:51'),
(5, 3, '1,2,3', 100, 0, 100, 1, 1, '2018-08-24 13:06:43', '2018-08-27 10:13:03'),
(6, 4, '1', 10, 0, 0, 1, 1, '2018-08-24 13:11:10', '2018-08-24 13:11:10'),
(7, 5, '1', 100, 18, 100, 1, 1, '2018-08-27 05:58:09', '2018-08-27 05:58:38'),
(8, 6, '1,2,3', 100, 18, 100, 1, 1, '2018-08-27 09:53:28', '2018-08-27 10:13:01'),
(9, 7, '1', 10, 0, 0, 1, 1, '2018-09-12 21:28:37', '2018-09-12 21:28:37'),
(10, 8, '1', 100, 18, 100, 1, 1, '2018-09-28 10:55:29', '2018-09-28 10:56:09'),
(11, 9, '1,2,3', 100, 18, 100, 1, 1, '2018-10-03 10:41:25', '2018-10-03 10:56:23'),
(12, 10, '1', 10, 0, 0, 1, 1, '2018-10-03 12:55:37', '2018-10-03 12:55:37'),
(13, 11, '1', 10, 0, 0, 1, 1, '2018-10-03 13:04:16', '2018-10-03 13:04:16'),
(14, 12, '1', 10, 0, 0, 1, 1, '2018-10-03 13:16:54', '2018-10-03 13:16:54'),
(15, 13, '1', 100, 18, 100, 1, 1, '2018-10-03 13:20:38', '2018-10-03 13:21:48'),
(16, 14, '1', 100, 18, 100, 1, 1, '2018-10-03 13:29:59', '2018-10-03 13:30:32'),
(17, 15, '1', 100, 18, 100, 1, 1, '2018-10-04 04:59:27', '2018-10-04 04:59:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_spams`
--
ALTER TABLE `report_spams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_not_interesteds`
--
ALTER TABLE `user_not_interesteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report_spams`
--
ALTER TABLE `report_spams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_not_interesteds`
--
ALTER TABLE `user_not_interesteds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
