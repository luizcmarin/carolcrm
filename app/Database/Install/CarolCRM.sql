PRAGMA foreign_keys = false;
 
-- ----------------------------
-- Table structure for tblactivity_log
-- ----------------------------
DROP TABLE IF EXISTS "tblactivity_log";
CREATE TABLE "tblactivity_log" (
  "id" integer NOT NULL,
  "description" text NOT NULL,
  "date" text NOT NULL,
  "staffid" text(100),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblactivity_log
-- ----------------------------
INSERT INTO "tblactivity_log" VALUES (1, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: ::1]', '2025-06-25 11:47:50', 'LUIZ MARIN');

-- ----------------------------
-- Table structure for tblannouncements
-- ----------------------------
DROP TABLE IF EXISTS "tblannouncements";
CREATE TABLE "tblannouncements" (
  "announcementid" integer NOT NULL,
  "name" text(191) NOT NULL,
  "message" text,
  "showtousers" integer NOT NULL,
  "showtostaff" integer NOT NULL,
  "showname" integer NOT NULL,
  "dateadded" text NOT NULL,
  "userid" text(100) NOT NULL,
  PRIMARY KEY ("announcementid")
);

-- ----------------------------
-- Records of tblannouncements
-- ----------------------------

-- ----------------------------
-- Table structure for tblclients
-- ----------------------------
DROP TABLE IF EXISTS "tblclients";
CREATE TABLE "tblclients" (
  "userid" integer NOT NULL,
  "company" text(191),
  "vat" text(50),
  "phonenumber" text(30),
  "country" integer NOT NULL,
  "city" text(100),
  "zip" text(15),
  "state" text(50),
  "address" text(191),
  "website" text(150),
  "datecreated" text NOT NULL,
  "active" integer NOT NULL,
  "leadid" integer,
  "billing_street" text(200),
  "billing_city" text(100),
  "billing_state" text(100),
  "billing_zip" text(100),
  "billing_country" integer,
  "shipping_street" text(200),
  "shipping_city" text(100),
  "shipping_state" text(100),
  "shipping_zip" text(100),
  "shipping_country" integer,
  "longitude" text(191),
  "latitude" text(191),
  "default_language" text(40),
  "default_currency" integer NOT NULL,
  "show_primary_contact" integer NOT NULL,
  "stripe_id" text(40),
  "registration_confirmed" integer NOT NULL,
  "addedfrom" integer NOT NULL,
  PRIMARY KEY ("userid")
);

-- ----------------------------
-- Records of tblclients
-- ----------------------------

-- ----------------------------
-- Table structure for tblconsent_purposes
-- ----------------------------
DROP TABLE IF EXISTS "tblconsent_purposes";
CREATE TABLE "tblconsent_purposes" (
  "id" integer NOT NULL,
  "name" text(100) NOT NULL,
  "description" text,
  "date_created" text NOT NULL,
  "last_updated" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblconsent_purposes
-- ----------------------------

-- ----------------------------
-- Table structure for tblconsents
-- ----------------------------
DROP TABLE IF EXISTS "tblconsents";
CREATE TABLE "tblconsents" (
  "id" integer NOT NULL,
  "action" text(10) NOT NULL,
  "date" text NOT NULL,
  "ip" text(40) NOT NULL,
  "contact_id" integer NOT NULL,
  "lead_id" integer NOT NULL,
  "description" text,
  "opt_in_purpose_description" text,
  "purpose_id" integer NOT NULL,
  "staff_name" text(100),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblconsents
-- ----------------------------

-- ----------------------------
-- Table structure for tblcontact_permissions
-- ----------------------------
DROP TABLE IF EXISTS "tblcontact_permissions";
CREATE TABLE "tblcontact_permissions" (
  "id" integer NOT NULL,
  "permission_id" integer NOT NULL,
  "userid" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcontact_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for tblcontacts
-- ----------------------------
DROP TABLE IF EXISTS "tblcontacts";
CREATE TABLE "tblcontacts" (
  "id" integer NOT NULL,
  "userid" integer NOT NULL,
  "is_primary" integer NOT NULL,
  "firstname" text(191) NOT NULL,
  "lastname" text(191) NOT NULL,
  "email" text(100) NOT NULL,
  "phonenumber" text(100) NOT NULL,
  "title" text(100),
  "datecreated" text NOT NULL,
  "password" text(255),
  "new_pass_key" text(32),
  "new_pass_key_requested" text,
  "email_verified_at" text,
  "email_verification_key" text(32),
  "email_verification_sent_at" text,
  "last_ip" text(40),
  "last_login" text,
  "last_password_change" text,
  "active" integer(1) NOT NULL,
  "profile_image" text(191),
  "direction" text(3),
  "invoice_emails" integer(1) NOT NULL,
  "estimate_emails" integer(1) NOT NULL,
  "credit_note_emails" integer(1) NOT NULL,
  "contract_emails" integer(1) NOT NULL,
  "task_emails" integer(1) NOT NULL,
  "project_emails" integer(1) NOT NULL,
  "ticket_emails" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcontacts
-- ----------------------------

-- ----------------------------
-- Table structure for tblcontract_comments
-- ----------------------------
DROP TABLE IF EXISTS "tblcontract_comments";
CREATE TABLE "tblcontract_comments" (
  "id" integer NOT NULL,
  "content" text,
  "contract_id" integer NOT NULL,
  "staffid" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcontract_comments
-- ----------------------------

-- ----------------------------
-- Table structure for tblcontract_renewals
-- ----------------------------
DROP TABLE IF EXISTS "tblcontract_renewals";
CREATE TABLE "tblcontract_renewals" (
  "id" integer NOT NULL,
  "contractid" integer NOT NULL,
  "old_start_date" text NOT NULL,
  "new_start_date" text NOT NULL,
  "old_end_date" text,
  "new_end_date" text,
  "old_value" real(15,2),
  "new_value" real(15,2),
  "date_renewed" text NOT NULL,
  "renewed_by" text(100) NOT NULL,
  "renewed_by_staff_id" integer NOT NULL,
  "is_on_old_expiry_notified" integer,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcontract_renewals
-- ----------------------------

-- ----------------------------
-- Table structure for tblcontracts
-- ----------------------------
DROP TABLE IF EXISTS "tblcontracts";
CREATE TABLE "tblcontracts" (
  "id" integer NOT NULL,
  "content" text,
  "description" text,
  "subject" text(191),
  "client" integer NOT NULL,
  "datestart" text,
  "dateend" text,
  "contract_type" integer,
  "project_id" integer,
  "addedfrom" integer NOT NULL,
  "dateadded" text NOT NULL,
  "isexpirynotified" integer NOT NULL,
  "contract_value" real(15,2),
  "trash" integer(1),
  "not_visible_to_client" integer(1) NOT NULL,
  "hash" text(32),
  "signed" integer(1) NOT NULL,
  "signature" text(40),
  "marked_as_signed" integer(1) NOT NULL,
  "acceptance_firstname" text(50),
  "acceptance_lastname" text(50),
  "acceptance_email" text(100),
  "acceptance_date" text,
  "acceptance_ip" text(40),
  "short_link" text(100),
  "last_sent_at" text,
  "contacts_sent_to" text,
  "last_sign_reminder_at" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcontracts
-- ----------------------------

-- ----------------------------
-- Table structure for tblcontracts_types
-- ----------------------------
DROP TABLE IF EXISTS "tblcontracts_types";
CREATE TABLE "tblcontracts_types" (
  "id" integer NOT NULL,
  "name" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcontracts_types
-- ----------------------------

-- ----------------------------
-- Table structure for tblcountries
-- ----------------------------
DROP TABLE IF EXISTS "tblcountries";
CREATE TABLE "tblcountries" (
  "country_id" integer NOT NULL,
  "iso2" text(2),
  "short_name" text(80) NOT NULL,
  "long_name" text(80) NOT NULL,
  "iso3" text(3),
  "numcode" text(6),
  "un_member" text(12),
  "calling_code" text(8),
  "cctld" text(5),
  PRIMARY KEY ("country_id")
);

-- ----------------------------
-- Records of tblcountries
-- ----------------------------
INSERT INTO "tblcountries" VALUES (1, 'AF', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', '004', 'yes', '93', '.af');
INSERT INTO "tblcountries" VALUES (2, 'AX', 'Aland Islands', '&Aring;land Islands', 'ALA', '248', 'no', '358', '.ax');
INSERT INTO "tblcountries" VALUES (3, 'AL', 'Albania', 'Republic of Albania', 'ALB', '008', 'yes', '355', '.al');
INSERT INTO "tblcountries" VALUES (4, 'DZ', 'Algeria', 'People''s Democratic Republic of Algeria', 'DZA', '012', 'yes', '213', '.dz');
INSERT INTO "tblcountries" VALUES (5, 'AS', 'American Samoa', 'American Samoa', 'ASM', '016', 'no', '1+684', '.as');
INSERT INTO "tblcountries" VALUES (6, 'AD', 'Andorra', 'Principality of Andorra', 'AND', '020', 'yes', '376', '.ad');
INSERT INTO "tblcountries" VALUES (7, 'AO', 'Angola', 'Republic of Angola', 'AGO', '024', 'yes', '244', '.ao');
INSERT INTO "tblcountries" VALUES (8, 'AI', 'Anguilla', 'Anguilla', 'AIA', '660', 'no', '1+264', '.ai');
INSERT INTO "tblcountries" VALUES (9, 'AQ', 'Antarctica', 'Antarctica', 'ATA', '010', 'no', '672', '.aq');
INSERT INTO "tblcountries" VALUES (10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', '028', 'yes', '1+268', '.ag');
INSERT INTO "tblcountries" VALUES (11, 'AR', 'Argentina', 'Argentine Republic', 'ARG', '032', 'yes', '54', '.ar');
INSERT INTO "tblcountries" VALUES (12, 'AM', 'Armenia', 'Republic of Armenia', 'ARM', '051', 'yes', '374', '.am');
INSERT INTO "tblcountries" VALUES (13, 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw');
INSERT INTO "tblcountries" VALUES (14, 'AU', 'Australia', 'Commonwealth of Australia', 'AUS', '036', 'yes', '61', '.au');
INSERT INTO "tblcountries" VALUES (15, 'AT', 'Austria', 'Republic of Austria', 'AUT', '040', 'yes', '43', '.at');
INSERT INTO "tblcountries" VALUES (16, 'AZ', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', '031', 'yes', '994', '.az');
INSERT INTO "tblcountries" VALUES (17, 'BS', 'Bahamas', 'Commonwealth of The Bahamas', 'BHS', '044', 'yes', '1+242', '.bs');
INSERT INTO "tblcountries" VALUES (18, 'BH', 'Bahrain', 'Kingdom of Bahrain', 'BHR', '048', 'yes', '973', '.bh');
INSERT INTO "tblcountries" VALUES (19, 'BD', 'Bangladesh', 'People''s Republic of Bangladesh', 'BGD', '050', 'yes', '880', '.bd');
INSERT INTO "tblcountries" VALUES (20, 'BB', 'Barbados', 'Barbados', 'BRB', '052', 'yes', '1+246', '.bb');
INSERT INTO "tblcountries" VALUES (21, 'BY', 'Belarus', 'Republic of Belarus', 'BLR', '112', 'yes', '375', '.by');
INSERT INTO "tblcountries" VALUES (22, 'BE', 'Belgium', 'Kingdom of Belgium', 'BEL', '056', 'yes', '32', '.be');
INSERT INTO "tblcountries" VALUES (23, 'BZ', 'Belize', 'Belize', 'BLZ', '084', 'yes', '501', '.bz');
INSERT INTO "tblcountries" VALUES (24, 'BJ', 'Benin', 'Republic of Benin', 'BEN', '204', 'yes', '229', '.bj');
INSERT INTO "tblcountries" VALUES (25, 'BM', 'Bermuda', 'Bermuda Islands', 'BMU', '060', 'no', '1+441', '.bm');
INSERT INTO "tblcountries" VALUES (26, 'BT', 'Bhutan', 'Kingdom of Bhutan', 'BTN', '064', 'yes', '975', '.bt');
INSERT INTO "tblcountries" VALUES (27, 'BO', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', '068', 'yes', '591', '.bo');
INSERT INTO "tblcountries" VALUES (28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'no', '599', '.bq');
INSERT INTO "tblcountries" VALUES (29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', '070', 'yes', '387', '.ba');
INSERT INTO "tblcountries" VALUES (30, 'BW', 'Botswana', 'Republic of Botswana', 'BWA', '072', 'yes', '267', '.bw');
INSERT INTO "tblcountries" VALUES (31, 'BV', 'Bouvet Island', 'Bouvet Island', 'BVT', '074', 'no', 'NONE', '.bv');
INSERT INTO "tblcountries" VALUES (32, 'BR', 'Brazil', 'Federative Republic of Brazil', 'BRA', '076', 'yes', '55', '.br');
INSERT INTO "tblcountries" VALUES (33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', '086', 'no', '246', '.io');
INSERT INTO "tblcountries" VALUES (34, 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '096', 'yes', '673', '.bn');
INSERT INTO "tblcountries" VALUES (35, 'BG', 'Bulgaria', 'Republic of Bulgaria', 'BGR', '100', 'yes', '359', '.bg');
INSERT INTO "tblcountries" VALUES (36, 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', '854', 'yes', '226', '.bf');
INSERT INTO "tblcountries" VALUES (37, 'BI', 'Burundi', 'Republic of Burundi', 'BDI', '108', 'yes', '257', '.bi');
INSERT INTO "tblcountries" VALUES (38, 'KH', 'Cambodia', 'Kingdom of Cambodia', 'KHM', '116', 'yes', '855', '.kh');
INSERT INTO "tblcountries" VALUES (39, 'CM', 'Cameroon', 'Republic of Cameroon', 'CMR', '120', 'yes', '237', '.cm');
INSERT INTO "tblcountries" VALUES (40, 'CA', 'Canada', 'Canada', 'CAN', '124', 'yes', '1', '.ca');
INSERT INTO "tblcountries" VALUES (41, 'CV', 'Cape Verde', 'Republic of Cape Verde', 'CPV', '132', 'yes', '238', '.cv');
INSERT INTO "tblcountries" VALUES (42, 'KY', 'Cayman Islands', 'The Cayman Islands', 'CYM', '136', 'no', '1+345', '.ky');
INSERT INTO "tblcountries" VALUES (43, 'CF', 'Central African Republic', 'Central African Republic', 'CAF', '140', 'yes', '236', '.cf');
INSERT INTO "tblcountries" VALUES (44, 'TD', 'Chad', 'Republic of Chad', 'TCD', '148', 'yes', '235', '.td');
INSERT INTO "tblcountries" VALUES (45, 'CL', 'Chile', 'Republic of Chile', 'CHL', '152', 'yes', '56', '.cl');
INSERT INTO "tblcountries" VALUES (46, 'CN', 'China', 'People''s Republic of China', 'CHN', '156', 'yes', '86', '.cn');
INSERT INTO "tblcountries" VALUES (47, 'CX', 'Christmas Island', 'Christmas Island', 'CXR', '162', 'no', '61', '.cx');
INSERT INTO "tblcountries" VALUES (48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', '166', 'no', '61', '.cc');
INSERT INTO "tblcountries" VALUES (49, 'CO', 'Colombia', 'Republic of Colombia', 'COL', '170', 'yes', '57', '.co');
INSERT INTO "tblcountries" VALUES (50, 'KM', 'Comoros', 'Union of the Comoros', 'COM', '174', 'yes', '269', '.km');
INSERT INTO "tblcountries" VALUES (51, 'CG', 'Congo', 'Republic of the Congo', 'COG', '178', 'yes', '242', '.cg');
INSERT INTO "tblcountries" VALUES (52, 'CK', 'Cook Islands', 'Cook Islands', 'COK', '184', 'some', '682', '.ck');
INSERT INTO "tblcountries" VALUES (53, 'CR', 'Costa Rica', 'Republic of Costa Rica', 'CRI', '188', 'yes', '506', '.cr');
INSERT INTO "tblcountries" VALUES (54, 'CI', 'Cote d''ivoire (Ivory Coast)', 'Republic of C&ocirc;te D''Ivoire (Ivory Coast)', 'CIV', '384', 'yes', '225', '.ci');
INSERT INTO "tblcountries" VALUES (55, 'HR', 'Croatia', 'Republic of Croatia', 'HRV', '191', 'yes', '385', '.hr');
INSERT INTO "tblcountries" VALUES (56, 'CU', 'Cuba', 'Republic of Cuba', 'CUB', '192', 'yes', '53', '.cu');
INSERT INTO "tblcountries" VALUES (57, 'CW', 'Curacao', 'Cura&ccedil;ao', 'CUW', '531', 'no', '599', '.cw');
INSERT INTO "tblcountries" VALUES (58, 'CY', 'Cyprus', 'Republic of Cyprus', 'CYP', '196', 'yes', '357', '.cy');
INSERT INTO "tblcountries" VALUES (59, 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', '203', 'yes', '420', '.cz');
INSERT INTO "tblcountries" VALUES (60, 'CD', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', 'COD', '180', 'yes', '243', '.cd');
INSERT INTO "tblcountries" VALUES (61, 'DK', 'Denmark', 'Kingdom of Denmark', 'DNK', '208', 'yes', '45', '.dk');
INSERT INTO "tblcountries" VALUES (62, 'DJ', 'Djibouti', 'Republic of Djibouti', 'DJI', '262', 'yes', '253', '.dj');
INSERT INTO "tblcountries" VALUES (63, 'DM', 'Dominica', 'Commonwealth of Dominica', 'DMA', '212', 'yes', '1+767', '.dm');
INSERT INTO "tblcountries" VALUES (64, 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', '214', 'yes', '1+809, 8', '.do');
INSERT INTO "tblcountries" VALUES (65, 'EC', 'Ecuador', 'Republic of Ecuador', 'ECU', '218', 'yes', '593', '.ec');
INSERT INTO "tblcountries" VALUES (66, 'EG', 'Egypt', 'Arab Republic of Egypt', 'EGY', '818', 'yes', '20', '.eg');
INSERT INTO "tblcountries" VALUES (67, 'SV', 'El Salvador', 'Republic of El Salvador', 'SLV', '222', 'yes', '503', '.sv');
INSERT INTO "tblcountries" VALUES (68, 'GQ', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', '226', 'yes', '240', '.gq');
INSERT INTO "tblcountries" VALUES (69, 'ER', 'Eritrea', 'State of Eritrea', 'ERI', '232', 'yes', '291', '.er');
INSERT INTO "tblcountries" VALUES (70, 'EE', 'Estonia', 'Republic of Estonia', 'EST', '233', 'yes', '372', '.ee');
INSERT INTO "tblcountries" VALUES (71, 'ET', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', '231', 'yes', '251', '.et');
INSERT INTO "tblcountries" VALUES (72, 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', 'FLK', '238', 'no', '500', '.fk');
INSERT INTO "tblcountries" VALUES (73, 'FO', 'Faroe Islands', 'The Faroe Islands', 'FRO', '234', 'no', '298', '.fo');
INSERT INTO "tblcountries" VALUES (74, 'FJ', 'Fiji', 'Republic of Fiji', 'FJI', '242', 'yes', '679', '.fj');
INSERT INTO "tblcountries" VALUES (75, 'FI', 'Finland', 'Republic of Finland', 'FIN', '246', 'yes', '358', '.fi');
INSERT INTO "tblcountries" VALUES (76, 'FR', 'France', 'French Republic', 'FRA', '250', 'yes', '33', '.fr');
INSERT INTO "tblcountries" VALUES (77, 'GF', 'French Guiana', 'French Guiana', 'GUF', '254', 'no', '594', '.gf');
INSERT INTO "tblcountries" VALUES (78, 'PF', 'French Polynesia', 'French Polynesia', 'PYF', '258', 'no', '689', '.pf');
INSERT INTO "tblcountries" VALUES (79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', NULL, '.tf');
INSERT INTO "tblcountries" VALUES (80, 'GA', 'Gabon', 'Gabonese Republic', 'GAB', '266', 'yes', '241', '.ga');
INSERT INTO "tblcountries" VALUES (81, 'GM', 'Gambia', 'Republic of The Gambia', 'GMB', '270', 'yes', '220', '.gm');
INSERT INTO "tblcountries" VALUES (82, 'GE', 'Georgia', 'Georgia', 'GEO', '268', 'yes', '995', '.ge');
INSERT INTO "tblcountries" VALUES (83, 'DE', 'Germany', 'Federal Republic of Germany', 'DEU', '276', 'yes', '49', '.de');
INSERT INTO "tblcountries" VALUES (84, 'GH', 'Ghana', 'Republic of Ghana', 'GHA', '288', 'yes', '233', '.gh');
INSERT INTO "tblcountries" VALUES (85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi');
INSERT INTO "tblcountries" VALUES (86, 'GR', 'Greece', 'Hellenic Republic', 'GRC', '300', 'yes', '30', '.gr');
INSERT INTO "tblcountries" VALUES (87, 'GL', 'Greenland', 'Greenland', 'GRL', '304', 'no', '299', '.gl');
INSERT INTO "tblcountries" VALUES (88, 'GD', 'Grenada', 'Grenada', 'GRD', '308', 'yes', '1+473', '.gd');
INSERT INTO "tblcountries" VALUES (89, 'GP', 'Guadaloupe', 'Guadeloupe', 'GLP', '312', 'no', '590', '.gp');
INSERT INTO "tblcountries" VALUES (90, 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu');
INSERT INTO "tblcountries" VALUES (91, 'GT', 'Guatemala', 'Republic of Guatemala', 'GTM', '320', 'yes', '502', '.gt');
INSERT INTO "tblcountries" VALUES (92, 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg');
INSERT INTO "tblcountries" VALUES (93, 'GN', 'Guinea', 'Republic of Guinea', 'GIN', '324', 'yes', '224', '.gn');
INSERT INTO "tblcountries" VALUES (94, 'GW', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', '624', 'yes', '245', '.gw');
INSERT INTO "tblcountries" VALUES (95, 'GY', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', '328', 'yes', '592', '.gy');
INSERT INTO "tblcountries" VALUES (96, 'HT', 'Haiti', 'Republic of Haiti', 'HTI', '332', 'yes', '509', '.ht');
INSERT INTO "tblcountries" VALUES (97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', '334', 'no', 'NONE', '.hm');
INSERT INTO "tblcountries" VALUES (98, 'HN', 'Honduras', 'Republic of Honduras', 'HND', '340', 'yes', '504', '.hn');
INSERT INTO "tblcountries" VALUES (99, 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk');
INSERT INTO "tblcountries" VALUES (100, 'HU', 'Hungary', 'Hungary', 'HUN', '348', 'yes', '36', '.hu');
INSERT INTO "tblcountries" VALUES (101, 'IS', 'Iceland', 'Republic of Iceland', 'ISL', '352', 'yes', '354', '.is');
INSERT INTO "tblcountries" VALUES (102, 'IN', 'India', 'Republic of India', 'IND', '356', 'yes', '91', '.in');
INSERT INTO "tblcountries" VALUES (103, 'ID', 'Indonesia', 'Republic of Indonesia', 'IDN', '360', 'yes', '62', '.id');
INSERT INTO "tblcountries" VALUES (104, 'IR', 'Iran', 'Islamic Republic of Iran', 'IRN', '364', 'yes', '98', '.ir');
INSERT INTO "tblcountries" VALUES (105, 'IQ', 'Iraq', 'Republic of Iraq', 'IRQ', '368', 'yes', '964', '.iq');
INSERT INTO "tblcountries" VALUES (106, 'IE', 'Ireland', 'Ireland', 'IRL', '372', 'yes', '353', '.ie');
INSERT INTO "tblcountries" VALUES (107, 'IM', 'Isle of Man', 'Isle of Man', 'IMN', '833', 'no', '44', '.im');
INSERT INTO "tblcountries" VALUES (108, 'IL', 'Israel', 'State of Israel', 'ISR', '376', 'yes', '972', '.il');
INSERT INTO "tblcountries" VALUES (109, 'IT', 'Italy', 'Italian Republic', 'ITA', '380', 'yes', '39', '.jm');
INSERT INTO "tblcountries" VALUES (110, 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm');
INSERT INTO "tblcountries" VALUES (111, 'JP', 'Japan', 'Japan', 'JPN', '392', 'yes', '81', '.jp');
INSERT INTO "tblcountries" VALUES (112, 'JE', 'Jersey', 'The Bailiwick of Jersey', 'JEY', '832', 'no', '44', '.je');
INSERT INTO "tblcountries" VALUES (113, 'JO', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', '400', 'yes', '962', '.jo');
INSERT INTO "tblcountries" VALUES (114, 'KZ', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', '398', 'yes', '7', '.kz');
INSERT INTO "tblcountries" VALUES (115, 'KE', 'Kenya', 'Republic of Kenya', 'KEN', '404', 'yes', '254', '.ke');
INSERT INTO "tblcountries" VALUES (116, 'KI', 'Kiribati', 'Republic of Kiribati', 'KIR', '296', 'yes', '686', '.ki');
INSERT INTO "tblcountries" VALUES (117, 'XK', 'Kosovo', 'Republic of Kosovo', '---', '---', 'some', '381', '');
INSERT INTO "tblcountries" VALUES (118, 'KW', 'Kuwait', 'State of Kuwait', 'KWT', '414', 'yes', '965', '.kw');
INSERT INTO "tblcountries" VALUES (119, 'KG', 'Kyrgyzstan', 'Kyrgyz Republic', 'KGZ', '417', 'yes', '996', '.kg');
INSERT INTO "tblcountries" VALUES (120, 'LA', 'Laos', 'Lao People''s Democratic Republic', 'LAO', '418', 'yes', '856', '.la');
INSERT INTO "tblcountries" VALUES (121, 'LV', 'Latvia', 'Republic of Latvia', 'LVA', '428', 'yes', '371', '.lv');
INSERT INTO "tblcountries" VALUES (122, 'LB', 'Lebanon', 'Republic of Lebanon', 'LBN', '422', 'yes', '961', '.lb');
INSERT INTO "tblcountries" VALUES (123, 'LS', 'Lesotho', 'Kingdom of Lesotho', 'LSO', '426', 'yes', '266', '.ls');
INSERT INTO "tblcountries" VALUES (124, 'LR', 'Liberia', 'Republic of Liberia', 'LBR', '430', 'yes', '231', '.lr');
INSERT INTO "tblcountries" VALUES (125, 'LY', 'Libya', 'Libya', 'LBY', '434', 'yes', '218', '.ly');
INSERT INTO "tblcountries" VALUES (126, 'LI', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', '438', 'yes', '423', '.li');
INSERT INTO "tblcountries" VALUES (127, 'LT', 'Lithuania', 'Republic of Lithuania', 'LTU', '440', 'yes', '370', '.lt');
INSERT INTO "tblcountries" VALUES (128, 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', '442', 'yes', '352', '.lu');
INSERT INTO "tblcountries" VALUES (129, 'MO', 'Macao', 'The Macao Special Administrative Region', 'MAC', '446', 'no', '853', '.mo');
INSERT INTO "tblcountries" VALUES (130, 'MK', 'North Macedonia', 'Republic of North Macedonia', 'MKD', '807', 'yes', '389', '.mk');
INSERT INTO "tblcountries" VALUES (131, 'MG', 'Madagascar', 'Republic of Madagascar', 'MDG', '450', 'yes', '261', '.mg');
INSERT INTO "tblcountries" VALUES (132, 'MW', 'Malawi', 'Republic of Malawi', 'MWI', '454', 'yes', '265', '.mw');
INSERT INTO "tblcountries" VALUES (133, 'MY', 'Malaysia', 'Malaysia', 'MYS', '458', 'yes', '60', '.my');
INSERT INTO "tblcountries" VALUES (134, 'MV', 'Maldives', 'Republic of Maldives', 'MDV', '462', 'yes', '960', '.mv');
INSERT INTO "tblcountries" VALUES (135, 'ML', 'Mali', 'Republic of Mali', 'MLI', '466', 'yes', '223', '.ml');
INSERT INTO "tblcountries" VALUES (136, 'MT', 'Malta', 'Republic of Malta', 'MLT', '470', 'yes', '356', '.mt');
INSERT INTO "tblcountries" VALUES (137, 'MH', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', '584', 'yes', '692', '.mh');
INSERT INTO "tblcountries" VALUES (138, 'MQ', 'Martinique', 'Martinique', 'MTQ', '474', 'no', '596', '.mq');
INSERT INTO "tblcountries" VALUES (139, 'MR', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', '478', 'yes', '222', '.mr');
INSERT INTO "tblcountries" VALUES (140, 'MU', 'Mauritius', 'Republic of Mauritius', 'MUS', '480', 'yes', '230', '.mu');
INSERT INTO "tblcountries" VALUES (141, 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt');
INSERT INTO "tblcountries" VALUES (142, 'MX', 'Mexico', 'United Mexican States', 'MEX', '484', 'yes', '52', '.mx');
INSERT INTO "tblcountries" VALUES (143, 'FM', 'Micronesia', 'Federated States of Micronesia', 'FSM', '583', 'yes', '691', '.fm');
INSERT INTO "tblcountries" VALUES (144, 'MD', 'Moldava', 'Republic of Moldova', 'MDA', '498', 'yes', '373', '.md');
INSERT INTO "tblcountries" VALUES (145, 'MC', 'Monaco', 'Principality of Monaco', 'MCO', '492', 'yes', '377', '.mc');
INSERT INTO "tblcountries" VALUES (146, 'MN', 'Mongolia', 'Mongolia', 'MNG', '496', 'yes', '976', '.mn');
INSERT INTO "tblcountries" VALUES (147, 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me');
INSERT INTO "tblcountries" VALUES (148, 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms');
INSERT INTO "tblcountries" VALUES (149, 'MA', 'Morocco', 'Kingdom of Morocco', 'MAR', '504', 'yes', '212', '.ma');
INSERT INTO "tblcountries" VALUES (150, 'MZ', 'Mozambique', 'Republic of Mozambique', 'MOZ', '508', 'yes', '258', '.mz');
INSERT INTO "tblcountries" VALUES (151, 'MM', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', 'MMR', '104', 'yes', '95', '.mm');
INSERT INTO "tblcountries" VALUES (152, 'NA', 'Namibia', 'Republic of Namibia', 'NAM', '516', 'yes', '264', '.na');
INSERT INTO "tblcountries" VALUES (153, 'NR', 'Nauru', 'Republic of Nauru', 'NRU', '520', 'yes', '674', '.nr');
INSERT INTO "tblcountries" VALUES (154, 'NP', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', '524', 'yes', '977', '.np');
INSERT INTO "tblcountries" VALUES (155, 'NL', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', '528', 'yes', '31', '.nl');
INSERT INTO "tblcountries" VALUES (156, 'NC', 'New Caledonia', 'New Caledonia', 'NCL', '540', 'no', '687', '.nc');
INSERT INTO "tblcountries" VALUES (157, 'NZ', 'New Zealand', 'New Zealand', 'NZL', '554', 'yes', '64', '.nz');
INSERT INTO "tblcountries" VALUES (158, 'NI', 'Nicaragua', 'Republic of Nicaragua', 'NIC', '558', 'yes', '505', '.ni');
INSERT INTO "tblcountries" VALUES (159, 'NE', 'Niger', 'Republic of Niger', 'NER', '562', 'yes', '227', '.ne');
INSERT INTO "tblcountries" VALUES (160, 'NG', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', '566', 'yes', '234', '.ng');
INSERT INTO "tblcountries" VALUES (161, 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu');
INSERT INTO "tblcountries" VALUES (162, 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', '574', 'no', '672', '.nf');
INSERT INTO "tblcountries" VALUES (163, 'KP', 'North Korea', 'Democratic People''s Republic of Korea', 'PRK', '408', 'yes', '850', '.kp');
INSERT INTO "tblcountries" VALUES (164, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', '580', 'no', '1+670', '.mp');
INSERT INTO "tblcountries" VALUES (165, 'NO', 'Norway', 'Kingdom of Norway', 'NOR', '578', 'yes', '47', '.no');
INSERT INTO "tblcountries" VALUES (166, 'OM', 'Oman', 'Sultanate of Oman', 'OMN', '512', 'yes', '968', '.om');
INSERT INTO "tblcountries" VALUES (167, 'PK', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', '586', 'yes', '92', '.pk');
INSERT INTO "tblcountries" VALUES (168, 'PW', 'Palau', 'Republic of Palau', 'PLW', '585', 'yes', '680', '.pw');
INSERT INTO "tblcountries" VALUES (169, 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', 'PSE', '275', 'some', '970', '.ps');
INSERT INTO "tblcountries" VALUES (170, 'PA', 'Panama', 'Republic of Panama', 'PAN', '591', 'yes', '507', '.pa');
INSERT INTO "tblcountries" VALUES (171, 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', '598', 'yes', '675', '.pg');
INSERT INTO "tblcountries" VALUES (172, 'PY', 'Paraguay', 'Republic of Paraguay', 'PRY', '600', 'yes', '595', '.py');
INSERT INTO "tblcountries" VALUES (173, 'PE', 'Peru', 'Republic of Peru', 'PER', '604', 'yes', '51', '.pe');
INSERT INTO "tblcountries" VALUES (174, 'PH', 'Philippines', 'Republic of the Philippines', 'PHL', '608', 'yes', '63', '.ph');
INSERT INTO "tblcountries" VALUES (175, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn');
INSERT INTO "tblcountries" VALUES (176, 'PL', 'Poland', 'Republic of Poland', 'POL', '616', 'yes', '48', '.pl');
INSERT INTO "tblcountries" VALUES (177, 'PT', 'Portugal', 'Portuguese Republic', 'PRT', '620', 'yes', '351', '.pt');
INSERT INTO "tblcountries" VALUES (178, 'PR', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', '630', 'no', '1+939', '.pr');
INSERT INTO "tblcountries" VALUES (179, 'QA', 'Qatar', 'State of Qatar', 'QAT', '634', 'yes', '974', '.qa');
INSERT INTO "tblcountries" VALUES (180, 'RE', 'Reunion', 'R&eacute;union', 'REU', '638', 'no', '262', '.re');
INSERT INTO "tblcountries" VALUES (181, 'RO', 'Romania', 'Romania', 'ROU', '642', 'yes', '40', '.ro');
INSERT INTO "tblcountries" VALUES (182, 'RU', 'Russia', 'Russian Federation', 'RUS', '643', 'yes', '7', '.ru');
INSERT INTO "tblcountries" VALUES (183, 'RW', 'Rwanda', 'Republic of Rwanda', 'RWA', '646', 'yes', '250', '.rw');
INSERT INTO "tblcountries" VALUES (184, 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', 'BLM', '652', 'no', '590', '.bl');
INSERT INTO "tblcountries" VALUES (185, 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', '654', 'no', '290', '.sh');
INSERT INTO "tblcountries" VALUES (186, 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', 'KNA', '659', 'yes', '1+869', '.kn');
INSERT INTO "tblcountries" VALUES (187, 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', '662', 'yes', '1+758', '.lc');
INSERT INTO "tblcountries" VALUES (188, 'MF', 'Saint Martin', 'Saint Martin', 'MAF', '663', 'no', '590', '.mf');
INSERT INTO "tblcountries" VALUES (189, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', '666', 'no', '508', '.pm');
INSERT INTO "tblcountries" VALUES (190, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', '670', 'yes', '1+784', '.vc');
INSERT INTO "tblcountries" VALUES (191, 'WS', 'Samoa', 'Independent State of Samoa', 'WSM', '882', 'yes', '685', '.ws');
INSERT INTO "tblcountries" VALUES (192, 'SM', 'San Marino', 'Republic of San Marino', 'SMR', '674', 'yes', '378', '.sm');
INSERT INTO "tblcountries" VALUES (193, 'ST', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'STP', '678', 'yes', '239', '.st');
INSERT INTO "tblcountries" VALUES (194, 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', '682', 'yes', '966', '.sa');
INSERT INTO "tblcountries" VALUES (195, 'SN', 'Senegal', 'Republic of Senegal', 'SEN', '686', 'yes', '221', '.sn');
INSERT INTO "tblcountries" VALUES (196, 'RS', 'Serbia', 'Republic of Serbia', 'SRB', '688', 'yes', '381', '.rs');
INSERT INTO "tblcountries" VALUES (197, 'SC', 'Seychelles', 'Republic of Seychelles', 'SYC', '690', 'yes', '248', '.sc');
INSERT INTO "tblcountries" VALUES (198, 'SL', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', '694', 'yes', '232', '.sl');
INSERT INTO "tblcountries" VALUES (199, 'SG', 'Singapore', 'Republic of Singapore', 'SGP', '702', 'yes', '65', '.sg');
INSERT INTO "tblcountries" VALUES (200, 'SX', 'Sint Maarten', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx');
INSERT INTO "tblcountries" VALUES (201, 'SK', 'Slovakia', 'Slovak Republic', 'SVK', '703', 'yes', '421', '.sk');
INSERT INTO "tblcountries" VALUES (202, 'SI', 'Slovenia', 'Republic of Slovenia', 'SVN', '705', 'yes', '386', '.si');
INSERT INTO "tblcountries" VALUES (203, 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', '090', 'yes', '677', '.sb');
INSERT INTO "tblcountries" VALUES (204, 'SO', 'Somalia', 'Somali Republic', 'SOM', '706', 'yes', '252', '.so');
INSERT INTO "tblcountries" VALUES (205, 'ZA', 'South Africa', 'Republic of South Africa', 'ZAF', '710', 'yes', '27', '.za');
INSERT INTO "tblcountries" VALUES (206, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', '239', 'no', '500', '.gs');
INSERT INTO "tblcountries" VALUES (207, 'KR', 'South Korea', 'Republic of Korea', 'KOR', '410', 'yes', '82', '.kr');
INSERT INTO "tblcountries" VALUES (208, 'SS', 'South Sudan', 'Republic of South Sudan', 'SSD', '728', 'yes', '211', '.ss');
INSERT INTO "tblcountries" VALUES (209, 'ES', 'Spain', 'Kingdom of Spain', 'ESP', '724', 'yes', '34', '.es');
INSERT INTO "tblcountries" VALUES (210, 'LK', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', '144', 'yes', '94', '.lk');
INSERT INTO "tblcountries" VALUES (211, 'SD', 'Sudan', 'Republic of the Sudan', 'SDN', '729', 'yes', '249', '.sd');
INSERT INTO "tblcountries" VALUES (212, 'SR', 'Suriname', 'Republic of Suriname', 'SUR', '740', 'yes', '597', '.sr');
INSERT INTO "tblcountries" VALUES (213, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', '744', 'no', '47', '.sj');
INSERT INTO "tblcountries" VALUES (214, 'SZ', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', '748', 'yes', '268', '.sz');
INSERT INTO "tblcountries" VALUES (215, 'SE', 'Sweden', 'Kingdom of Sweden', 'SWE', '752', 'yes', '46', '.se');
INSERT INTO "tblcountries" VALUES (216, 'CH', 'Switzerland', 'Swiss Confederation', 'CHE', '756', 'yes', '41', '.ch');
INSERT INTO "tblcountries" VALUES (217, 'SY', 'Syria', 'Syrian Arab Republic', 'SYR', '760', 'yes', '963', '.sy');
INSERT INTO "tblcountries" VALUES (218, 'TW', 'Taiwan', 'Republic of China (Taiwan)', 'TWN', '158', 'former', '886', '.tw');
INSERT INTO "tblcountries" VALUES (219, 'TJ', 'Tajikistan', 'Republic of Tajikistan', 'TJK', '762', 'yes', '992', '.tj');
INSERT INTO "tblcountries" VALUES (220, 'TZ', 'Tanzania', 'United Republic of Tanzania', 'TZA', '834', 'yes', '255', '.tz');
INSERT INTO "tblcountries" VALUES (221, 'TH', 'Thailand', 'Kingdom of Thailand', 'THA', '764', 'yes', '66', '.th');
INSERT INTO "tblcountries" VALUES (222, 'TL', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'TLS', '626', 'yes', '670', '.tl');
INSERT INTO "tblcountries" VALUES (223, 'TG', 'Togo', 'Togolese Republic', 'TGO', '768', 'yes', '228', '.tg');
INSERT INTO "tblcountries" VALUES (224, 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk');
INSERT INTO "tblcountries" VALUES (225, 'TO', 'Tonga', 'Kingdom of Tonga', 'TON', '776', 'yes', '676', '.to');
INSERT INTO "tblcountries" VALUES (226, 'TT', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', '780', 'yes', '1+868', '.tt');
INSERT INTO "tblcountries" VALUES (227, 'TN', 'Tunisia', 'Republic of Tunisia', 'TUN', '788', 'yes', '216', '.tn');
INSERT INTO "tblcountries" VALUES (228, 'TR', 'Turkey', 'Republic of Turkey', 'TUR', '792', 'yes', '90', '.tr');
INSERT INTO "tblcountries" VALUES (229, 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', '795', 'yes', '993', '.tm');
INSERT INTO "tblcountries" VALUES (230, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', '796', 'no', '1+649', '.tc');
INSERT INTO "tblcountries" VALUES (231, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv');
INSERT INTO "tblcountries" VALUES (232, 'UG', 'Uganda', 'Republic of Uganda', 'UGA', '800', 'yes', '256', '.ug');
INSERT INTO "tblcountries" VALUES (233, 'UA', 'Ukraine', 'Ukraine', 'UKR', '804', 'yes', '380', '.ua');
INSERT INTO "tblcountries" VALUES (234, 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', '784', 'yes', '971', '.ae');
INSERT INTO "tblcountries" VALUES (235, 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', 'GBR', '826', 'yes', '44', '.uk');
INSERT INTO "tblcountries" VALUES (236, 'US', 'United States', 'United States of America', 'USA', '840', 'yes', '1', '.us');
INSERT INTO "tblcountries" VALUES (237, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', '581', 'no', 'NONE', 'NONE');
INSERT INTO "tblcountries" VALUES (238, 'UY', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', '858', 'yes', '598', '.uy');
INSERT INTO "tblcountries" VALUES (239, 'UZ', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', '860', 'yes', '998', '.uz');
INSERT INTO "tblcountries" VALUES (240, 'VU', 'Vanuatu', 'Republic of Vanuatu', 'VUT', '548', 'yes', '678', '.vu');
INSERT INTO "tblcountries" VALUES (241, 'VA', 'Vatican City', 'State of the Vatican City', 'VAT', '336', 'no', '39', '.va');
INSERT INTO "tblcountries" VALUES (242, 'VE', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', '862', 'yes', '58', '.ve');
INSERT INTO "tblcountries" VALUES (243, 'VN', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', '704', 'yes', '84', '.vn');
INSERT INTO "tblcountries" VALUES (244, 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', '092', 'no', '1+284', '.vg');
INSERT INTO "tblcountries" VALUES (245, 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States', 'VIR', '850', 'no', '1+340', '.vi');
INSERT INTO "tblcountries" VALUES (246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', '876', 'no', '681', '.wf');
INSERT INTO "tblcountries" VALUES (247, 'EH', 'Western Sahara', 'Western Sahara', 'ESH', '732', 'no', '212', '.eh');
INSERT INTO "tblcountries" VALUES (248, 'YE', 'Yemen', 'Republic of Yemen', 'YEM', '887', 'yes', '967', '.ye');
INSERT INTO "tblcountries" VALUES (249, 'ZM', 'Zambia', 'Republic of Zambia', 'ZMB', '894', 'yes', '260', '.zm');
INSERT INTO "tblcountries" VALUES (250, 'ZW', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', '716', 'yes', '263', '.zw');

-- ----------------------------
-- Table structure for tblcreditnote_refunds
-- ----------------------------
DROP TABLE IF EXISTS "tblcreditnote_refunds";
CREATE TABLE "tblcreditnote_refunds" (
  "id" integer NOT NULL,
  "credit_note_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  "refunded_on" text NOT NULL,
  "payment_mode" text(40) NOT NULL,
  "note" text,
  "amount" real(15,2) NOT NULL,
  "created_at" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcreditnote_refunds
-- ----------------------------

-- ----------------------------
-- Table structure for tblcreditnotes
-- ----------------------------
DROP TABLE IF EXISTS "tblcreditnotes";
CREATE TABLE "tblcreditnotes" (
  "id" integer NOT NULL,
  "clientid" integer NOT NULL,
  "deleted_customer_name" text(100),
  "number" integer NOT NULL,
  "prefix" text(50),
  "number_format" integer NOT NULL,
  "formatted_number" text(100),
  "datecreated" text NOT NULL,
  "date" text NOT NULL,
  "adminnote" text,
  "terms" text,
  "clientnote" text,
  "currency" integer NOT NULL,
  "subtotal" real(15,2) NOT NULL,
  "total_tax" real(15,2) NOT NULL,
  "total" real(15,2) NOT NULL,
  "adjustment" real(15,2),
  "addedfrom" integer,
  "status" integer,
  "project_id" integer NOT NULL,
  "discount_percent" real(15,2),
  "discount_total" real(15,2),
  "discount_type" text(30) NOT NULL,
  "billing_street" text(200),
  "billing_city" text(100),
  "billing_state" text(100),
  "billing_zip" text(100),
  "billing_country" integer,
  "shipping_street" text(200),
  "shipping_city" text(100),
  "shipping_state" text(100),
  "shipping_zip" text(100),
  "shipping_country" integer,
  "include_shipping" integer(1) NOT NULL,
  "show_shipping_on_credit_note" integer(1) NOT NULL,
  "show_quantity_as" integer NOT NULL,
  "reference_no" text(100),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcreditnotes
-- ----------------------------

-- ----------------------------
-- Table structure for tblcredits
-- ----------------------------
DROP TABLE IF EXISTS "tblcredits";
CREATE TABLE "tblcredits" (
  "id" integer NOT NULL,
  "invoice_id" integer NOT NULL,
  "credit_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  "date" text NOT NULL,
  "date_applied" text NOT NULL,
  "amount" real(15,2) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcredits
-- ----------------------------

-- ----------------------------
-- Table structure for tblcurrencies
-- ----------------------------
DROP TABLE IF EXISTS "tblcurrencies";
CREATE TABLE "tblcurrencies" (
  "id" integer NOT NULL,
  "symbol" text(10) NOT NULL,
  "name" text(100) NOT NULL,
  "decimal_separator" text(5),
  "thousand_separator" text(5),
  "placement" text(10),
  "isdefault" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcurrencies
-- ----------------------------
INSERT INTO "tblcurrencies" VALUES (1, '$', 'USD', '.', ',', 'before', 1);
INSERT INTO "tblcurrencies" VALUES (2, '€', 'EUR', ',', '.', 'before', 0);

-- ----------------------------
-- Table structure for tblcustomer_admins
-- ----------------------------
DROP TABLE IF EXISTS "tblcustomer_admins";
CREATE TABLE "tblcustomer_admins" (
  "staff_id" integer NOT NULL,
  "customer_id" integer NOT NULL,
  "date_assigned" text NOT NULL
);

-- ----------------------------
-- Records of tblcustomer_admins
-- ----------------------------

-- ----------------------------
-- Table structure for tblcustomer_groups
-- ----------------------------
DROP TABLE IF EXISTS "tblcustomer_groups";
CREATE TABLE "tblcustomer_groups" (
  "id" integer NOT NULL,
  "groupid" integer NOT NULL,
  "customer_id" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcustomer_groups
-- ----------------------------

-- ----------------------------
-- Table structure for tblcustomers_groups
-- ----------------------------
DROP TABLE IF EXISTS "tblcustomers_groups";
CREATE TABLE "tblcustomers_groups" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcustomers_groups
-- ----------------------------

-- ----------------------------
-- Table structure for tblcustomfields
-- ----------------------------
DROP TABLE IF EXISTS "tblcustomfields";
CREATE TABLE "tblcustomfields" (
  "id" integer NOT NULL,
  "fieldto" text(30),
  "name" text(150) NOT NULL,
  "slug" text(150) NOT NULL,
  "required" integer(1) NOT NULL,
  "type" text(20) NOT NULL,
  "options" text,
  "display_inline" integer(1) NOT NULL,
  "field_order" integer,
  "active" integer NOT NULL,
  "show_on_pdf" integer NOT NULL,
  "show_on_ticket_form" integer(1) NOT NULL,
  "only_admin" integer(1) NOT NULL,
  "show_on_table" integer(1) NOT NULL,
  "show_on_client_portal" integer NOT NULL,
  "disalow_client_to_edit" integer NOT NULL,
  "bs_column" integer NOT NULL,
  "default_value" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcustomfields
-- ----------------------------

-- ----------------------------
-- Table structure for tblcustomfieldsvalues
-- ----------------------------
DROP TABLE IF EXISTS "tblcustomfieldsvalues";
CREATE TABLE "tblcustomfieldsvalues" (
  "id" integer NOT NULL,
  "relid" integer NOT NULL,
  "fieldid" integer NOT NULL,
  "fieldto" text(15) NOT NULL,
  "value" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblcustomfieldsvalues
-- ----------------------------

-- ----------------------------
-- Table structure for tbldepartments
-- ----------------------------
DROP TABLE IF EXISTS "tbldepartments";
CREATE TABLE "tbldepartments" (
  "departmentid" integer NOT NULL,
  "name" text(100) NOT NULL,
  "imap_username" text(191),
  "email" text(100),
  "email_from_header" integer(1) NOT NULL,
  "host" text(150),
  "password" text,
  "encryption" text(3),
  "folder" text(191) NOT NULL,
  "delete_after_import" integer NOT NULL,
  "calendar_id" text,
  "hidefromclient" integer(1) NOT NULL,
  PRIMARY KEY ("departmentid")
);

-- ----------------------------
-- Records of tbldepartments
-- ----------------------------

-- ----------------------------
-- Table structure for tbldismissed_announcements
-- ----------------------------
DROP TABLE IF EXISTS "tbldismissed_announcements";
CREATE TABLE "tbldismissed_announcements" (
  "dismissedannouncementid" integer NOT NULL,
  "announcementid" integer NOT NULL,
  "staff" integer NOT NULL,
  "userid" integer NOT NULL,
  PRIMARY KEY ("dismissedannouncementid")
);

-- ----------------------------
-- Records of tbldismissed_announcements
-- ----------------------------

-- ----------------------------
-- Table structure for tblemailtemplates
-- ----------------------------
DROP TABLE IF EXISTS "tblemailtemplates";
CREATE TABLE "tblemailtemplates" (
  "emailtemplateid" integer NOT NULL,
  "type" text NOT NULL,
  "slug" text(100) NOT NULL,
  "language" text(40),
  "name" text NOT NULL,
  "subject" text NOT NULL,
  "message" text NOT NULL,
  "fromname" text NOT NULL,
  "fromemail" text(100),
  "plaintext" integer NOT NULL,
  "active" integer NOT NULL,
  "order" integer NOT NULL,
  PRIMARY KEY ("emailtemplateid")
);

-- ----------------------------
-- Records of tblemailtemplates
-- ----------------------------
INSERT INTO "tblemailtemplates" VALUES (1, 'client', 'new-client-created', 'english', 'New Contact Added/Registered (Welcome Email)', 'Welcome aboard', 'Dear {contact_firstname} {contact_lastname}<br /><br />Thank you for registering on the <strong>{companyname}</strong> CRM System.<br /><br />We just wanted to say welcome.<br /><br />Please contact us if you need any help.<br /><br />Click here to view your profile: <a href="{crm_url}">{crm_url}</a><br /><br />Kind Regards, <br />{email_signature}<br /><br />(This is an automated email, so please don''t reply to this email address)', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (2, 'invoice', 'invoice-send-to-client', 'english', 'Send Invoice to Customer', 'Invoice with number {invoice_number} created', '<span style="font-size: 12pt;">Dear {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">We have prepared the following invoice for you: <strong># {invoice_number}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Invoice status</strong>: {invoice_status}</span><br /><br /><span style="font-size: 12pt;">You can view the invoice on the following link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Please contact us for more information.</span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (3, 'ticket', 'new-ticket-opened-admin', 'english', 'New Ticket Opened (Opened by Staff, Sent to Customer)', 'New Support Ticket Opened', '<p><span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span><br><br><span style="font-size: 12pt;">New support ticket has been opened.</span><br><br><span style="font-size: 12pt;"><strong>Subject:</strong> {ticket_subject}</span><br><span style="font-size: 12pt;"><strong>Department:</strong> {ticket_department}</span><br><span style="font-size: 12pt;"><strong>Priority:</strong> {ticket_priority}<br></span><br><span style="font-size: 12pt;"><strong>Ticket message:</strong></span><br><span style="font-size: 12pt;">{ticket_message}</span><br><br><span style="font-size: 12pt;">You can view the ticket on the following link: <a href="{ticket_public_url}">#{ticket_id}</a><br><br>Kind Regards,</span><br><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (4, 'ticket', 'ticket-reply', 'english', 'Ticket Reply (Sent to Customer)', 'New Ticket Reply', '<span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">You have a new ticket reply to ticket <a href="{ticket_public_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;"><strong>Ticket Subject:</strong> {ticket_subject}<br /></span><br /><span style="font-size: 12pt;"><strong>Ticket message:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">You can view the ticket on the following link: <a href="{ticket_public_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (5, 'ticket', 'ticket-autoresponse', 'english', 'New Ticket Opened - Autoresponse', 'New Support Ticket Opened', '<span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Thank you for contacting our support team. A support ticket has now been opened for your request. You will be notified when a response is made by email.</span><br /><br /><span style="font-size: 12pt;"><strong>Subject:</strong> {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Department</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Priority:</strong> {ticket_priority}</span><br /><br /><span style="font-size: 12pt;"><strong>Ticket message:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">You can view the ticket on the following link: <a href="{ticket_public_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (6, 'invoice', 'invoice-payment-recorded', 'english', 'Invoice Payment Recorded (Sent to Customer)', 'Invoice Payment Recorded', '<span style="font-size: 12pt;">Hello {contact_firstname}&nbsp;{contact_lastname}<br /><br /></span>Thank you for the payment. Find the payment details below:<br /><br />-------------------------------------------------<br /><br />Amount:&nbsp;<strong>{payment_total}<br /></strong>Date:&nbsp;<strong>{payment_date}</strong><br />Invoice number:&nbsp;<span style="font-size: 12pt;"><strong># {invoice_number}<br /><br /></strong></span>-------------------------------------------------<br /><br />You can always view the invoice for this payment at the following link:&nbsp;<a href="{invoice_link}"><span style="font-size: 12pt;">{invoice_number}</span></a><br /><br />We are looking forward working with you.<br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (7, 'invoice', 'invoice-overdue-notice', 'english', 'Invoice Overdue Notice', 'Invoice Overdue Notice - {invoice_number}', '<span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">This is an overdue notice for invoice <strong># {invoice_number}</strong></span><br /><br /><span style="font-size: 12pt;">This invoice was due: {invoice_duedate}</span><br /><br /><span style="font-size: 12pt;">You can view the invoice on the following link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (8, 'invoice', 'invoice-already-send', 'english', 'Invoice Already Sent to Customer', 'Invoice # {invoice_number} ', '<span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">At your request, here is the invoice with number <strong># {invoice_number}</strong></span><br /><br /><span style="font-size: 12pt;">You can view the invoice on the following link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Please contact us for more information.</span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (9, 'ticket', 'new-ticket-created-staff', 'english', 'New Ticket Created (Opened by Customer, Sent to Staff Members)', 'New Ticket Created', '<p><span style="font-size: 12pt;">A new support ticket has been opened.</span><br /><br /><span style="font-size: 12pt;"><strong>Subject</strong>: {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Department</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Priority</strong>: {ticket_priority}<br /></span><br /><span style="font-size: 12pt;"><strong>Ticket message:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">You can view the ticket on the following link: <a href="{ticket_url}">#{ticket_id}</a></span><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (10, 'estimate', 'estimate-send-to-client', 'english', 'Send Estimate to Customer', 'Estimate # {estimate_number} created', '<span style="font-size: 12pt;">Dear {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Please find the attached estimate <strong># {estimate_number}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Estimate status:</strong> {estimate_status}</span><br /><br /><span style="font-size: 12pt;">You can view the estimate on the following link: <a href="{estimate_link}">{estimate_number}</a></span><br /><br /><span style="font-size: 12pt;">We look forward to your communication.</span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}<br /></span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (11, 'ticket', 'ticket-reply-to-admin', 'english', 'Ticket Reply (Sent to Staff)', 'New Support Ticket Reply', '<span style="font-size: 12pt;">A new support ticket reply from {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;"><strong>Subject</strong>: {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Department</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Priority</strong>: {ticket_priority}</span><br /><br /><span style="font-size: 12pt;"><strong>Ticket message:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">You can view the ticket on the following link: <a href="{ticket_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (12, 'estimate', 'estimate-already-send', 'english', 'Estimate Already Sent to Customer', 'Estimate # {estimate_number} ', '<span style="font-size: 12pt;">Dear {contact_firstname} {contact_lastname}</span><br /> <br /><span style="font-size: 12pt;">Thank you for your estimate request.</span><br /> <br /><span style="font-size: 12pt;">You can view the estimate on the following link: <a href="{estimate_link}">{estimate_number}</a></span><br /> <br /><span style="font-size: 12pt;">Please contact us for more information.</span><br /> <br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (13, 'contract', 'contract-expiration', 'english', 'Contract Expiration Reminder (Sent to Customer Contacts)', 'Contract Expiration Reminder', '<span style="font-size: 12pt;">Dear {client_company}</span><br /><br /><span style="font-size: 12pt;">This is a reminder that the following contract will expire soon:</span><br /><br /><span style="font-size: 12pt;"><strong>Subject:</strong> {contract_subject}</span><br /><span style="font-size: 12pt;"><strong>Description:</strong> {contract_description}</span><br /><span style="font-size: 12pt;"><strong>Date Start:</strong> {contract_datestart}</span><br /><span style="font-size: 12pt;"><strong>Date End:</strong> {contract_dateend}</span><br /><br /><span style="font-size: 12pt;">Please contact us for more information.</span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (14, 'tasks', 'task-assigned', 'english', 'New Task Assigned (Sent to Staff)', 'New Task Assigned to You - {task_name}', '<span style="font-size: 12pt;">Dear {staff_firstname}</span><br /><br /><span style="font-size: 12pt;">You have been assigned to a new task:</span><br /><br /><span style="font-size: 12pt;"><strong>Name:</strong> {task_name}<br /></span><strong>Start Date:</strong> {task_startdate}<br /><span style="font-size: 12pt;"><strong>Due date:</strong> {task_duedate}</span><br /><span style="font-size: 12pt;"><strong>Priority:</strong> {task_priority}<br /><br /></span><span style="font-size: 12pt;"><span>You can view the task on the following link</span>: <a href="{task_link}">{task_name}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (15, 'tasks', 'task-added-as-follower', 'english', 'Staff Member Added as Follower on Task (Sent to Staff)', 'You are added as follower on task - {task_name}', '<span style="font-size: 12pt;">Hi {staff_firstname}<br /></span><br /><span style="font-size: 12pt;">You have been added as follower on the following task:</span><br /><br /><span style="font-size: 12pt;"><strong>Name:</strong> {task_name}</span><br /><span style="font-size: 12pt;"><strong>Start date:</strong> {task_startdate}</span><br /><br /><span>You can view the task on the following link</span><span>: </span><a href="{task_link}">{task_name}</a><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (16, 'tasks', 'task-commented', 'english', 'New Comment on Task (Sent to Staff)', 'New Comment on Task - {task_name}', 'Dear {staff_firstname}<br /><br />A comment has been made on the following task:<br /><br /><strong>Name:</strong> {task_name}<br /><strong>Comment:</strong> {task_comment}<br /><br />You can view the task on the following link: <a href="{task_link}">{task_name}</a><br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (17, 'tasks', 'task-added-attachment', 'english', 'New Attachment(s) on Task (Sent to Staff)', 'New Attachment on Task - {task_name}', 'Hi {staff_firstname}<br /><br /><strong>{task_user_take_action}</strong> added an attachment on the following task:<br /><br /><strong>Name:</strong> {task_name}<br /><br />You can view the task on the following link: <a href="{task_link}">{task_name}</a><br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (18, 'estimate', 'estimate-declined-to-staff', 'english', 'Estimate Declined (Sent to Staff)', 'Customer Declined Estimate', '<span style="font-size: 12pt;">Hi</span><br /> <br /><span style="font-size: 12pt;">Customer ({client_company}) declined estimate with number <strong># {estimate_number}</strong></span><br /> <br /><span style="font-size: 12pt;">You can view the estimate on the following link: <a href="{estimate_link}">{estimate_number}</a></span><br /> <br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (19, 'estimate', 'estimate-accepted-to-staff', 'english', 'Estimate Accepted (Sent to Staff)', 'Customer Accepted Estimate', '<span style="font-size: 12pt;">Hi</span><br /> <br /><span style="font-size: 12pt;">Customer ({client_company}) accepted estimate with number <strong># {estimate_number}</strong></span><br /> <br /><span style="font-size: 12pt;">You can view the estimate on the following link: <a href="{estimate_link}">{estimate_number}</a></span><br /> <br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (20, 'proposals', 'proposal-client-accepted', 'english', 'Customer Action - Accepted (Sent to Staff)', 'Customer Accepted Proposal', '<div>Hi<br /> <br />Client <strong>{proposal_proposal_to}</strong> accepted the following proposal:<br /> <br /><strong>Number:</strong> {proposal_number}<br /><strong>Subject</strong>: {proposal_subject}<br /><strong>Total</strong>: {proposal_total}<br /> <br />View the proposal on the following link: <a href="{proposal_link}">{proposal_number}</a><br /> <br />Kind Regards,<br />{email_signature}</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (21, 'proposals', 'proposal-send-to-customer', 'english', 'Send Proposal to Customer', 'Proposal With Number {proposal_number} Created', 'Dear {proposal_proposal_to}<br /><br />Please find our attached proposal.<br /><br />This proposal is valid until: {proposal_open_till}<br />You can view the proposal on the following link: <a href="{proposal_link}">{proposal_number}</a><br /><br />Please don''t hesitate to comment online if you have any questions.<br /><br />We look forward to your communication.<br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (22, 'proposals', 'proposal-client-declined', 'english', 'Customer Action - Declined (Sent to Staff)', 'Client Declined Proposal', 'Hi<br /> <br />Customer <strong>{proposal_proposal_to}</strong> declined the proposal <strong>{proposal_subject}</strong><br /> <br />View the proposal on the following link <a href="{proposal_link}">{proposal_number}</a>&nbsp;or from the admin area.<br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (23, 'proposals', 'proposal-client-thank-you', 'english', 'Thank You Email (Sent to Customer After Accept)', 'Thank for you accepting proposal', 'Dear {proposal_proposal_to}<br /> <br />Thank for for accepting the proposal.<br /> <br />We look forward to doing business with you.<br /> <br />We will contact you as soon as possible<br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (24, 'proposals', 'proposal-comment-to-client', 'english', 'New Comment  (Sent to Customer/Lead)', 'New Proposal Comment', 'Dear {proposal_proposal_to}<br /> <br />A new comment has been made on the following proposal: <strong>{proposal_number}</strong><br /> <br />You can view and reply to the comment on the following link: <a href="{proposal_link}">{proposal_number}</a><br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (25, 'proposals', 'proposal-comment-to-admin', 'english', 'New Comment (Sent to Staff) ', 'New Proposal Comment', 'Hi<br /> <br />A new comment has been made to the proposal <strong>{proposal_subject}</strong><br /> <br />You can view and reply to the comment on the following link: <a href="{proposal_link}">{proposal_number}</a>&nbsp;or from the admin area.<br /> <br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (26, 'estimate', 'estimate-thank-you-to-customer', 'english', 'Thank You Email (Sent to Customer After Accept)', 'Thank for you accepting estimate', '<span style="font-size: 12pt;">Dear {contact_firstname} {contact_lastname}</span><br /> <br /><span style="font-size: 12pt;">Thank for for accepting the estimate.</span><br /> <br /><span style="font-size: 12pt;">We look forward to doing business with you.</span><br /> <br /><span style="font-size: 12pt;">We will contact you as soon as possible.</span><br /> <br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (27, 'tasks', 'task-deadline-notification', 'english', 'Task Deadline Reminder - Sent to Assigned Members', 'Task Deadline Reminder', 'Hi {staff_firstname}&nbsp;{staff_lastname}<br /><br />This is an automated email from {companyname}.<br /><br />The task <strong>{task_name}</strong> deadline is on <strong>{task_duedate}</strong>. <br />This task is still not finished.<br /><br />You can view the task on the following link: <a href="{task_link}">{task_name}</a><br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (28, 'contract', 'send-contract', 'english', 'Send Contract to Customer', 'Contract - {contract_subject}', '<p><span style="font-size: 12pt;">Hi&nbsp;{contact_firstname}&nbsp;{contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Please find the <a href="{contract_link}">{contract_subject}</a> attached.<br /><br />Description: {contract_description}<br /><br /></span><span style="font-size: 12pt;">Looking forward to hear from you.</span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (29, 'invoice', 'invoice-payment-recorded-to-staff', 'english', 'Invoice Payment Recorded (Sent to Staff)', 'New Invoice Payment', '<span style="font-size: 12pt;">Hi</span><br /><br /><span style="font-size: 12pt;">Customer recorded payment for invoice <strong># {invoice_number}</strong></span><br /> <br /><span style="font-size: 12pt;">You can view the invoice on the following link: <a href="{invoice_link}">{invoice_number}</a></span><br /> <br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (30, 'ticket', 'auto-close-ticket', 'english', 'Auto Close Ticket', 'Ticket Auto Closed', '<p><span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Ticket {ticket_subject} has been auto close due to inactivity.</span><br /><br /><span style="font-size: 12pt;"><strong>Ticket #</strong>: <a href="{ticket_public_url}">{ticket_id}</a></span><br /><span style="font-size: 12pt;"><strong>Department</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Priority:</strong> {ticket_priority}</span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (31, 'project', 'new-project-discussion-created-to-staff', 'english', 'New Project Discussion (Sent to Project Members)', 'New Project Discussion Created - {project_name}', '<p>Hi {staff_firstname}<br /><br />New project discussion created from <strong>{discussion_creator}</strong><br /><br /><strong>Subject:</strong> {discussion_subject}<br /><strong>Description:</strong> {discussion_description}<br /><br />You can view the discussion on the following link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (32, 'project', 'new-project-discussion-created-to-customer', 'english', 'New Project Discussion (Sent to Customer Contacts)', 'New Project Discussion Created - {project_name}', '<p>Hello {contact_firstname} {contact_lastname}<br /><br />New project discussion created from <strong>{discussion_creator}</strong><br /><br /><strong>Subject:</strong> {discussion_subject}<br /><strong>Description:</strong> {discussion_description}<br /><br />You can view the discussion on the following link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (33, 'project', 'new-project-file-uploaded-to-customer', 'english', 'New Project File(s) Uploaded (Sent to Customer Contacts)', 'New Project File(s) Uploaded - {project_name}', '<p>Hello {contact_firstname} {contact_lastname}<br /><br />New project file is uploaded on <strong>{project_name}</strong> from <strong>{file_creator}</strong><br /><br />You can view the project on the following link: <a href="{project_link}">{project_name}</a><br /><br />To view the file in our CRM you can click on the following link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (34, 'project', 'new-project-file-uploaded-to-staff', 'english', 'New Project File(s) Uploaded (Sent to Project Members)', 'New Project File(s) Uploaded - {project_name}', '<p>Hello&nbsp;{staff_firstname}</p>
<p>New project&nbsp;file is uploaded on&nbsp;<strong>{project_name}</strong> from&nbsp;<strong>{file_creator}</strong></p>
<p>You can view the project on the following link: <a href="{project_link}">{project_name}<br /></a><br />To view&nbsp;the file you can click on the following link: <a href="{discussion_link}">{discussion_subject}</a></p>
<p>Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (35, 'project', 'new-project-discussion-comment-to-customer', 'english', 'New Discussion Comment  (Sent to Customer Contacts)', 'New Discussion Comment', '<p><span style="font-size: 12pt;">Hello {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">New discussion comment has been made on <strong>{discussion_subject}</strong> from <strong>{comment_creator}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Discussion subject:</strong> {discussion_subject}</span><br /><span style="font-size: 12pt;"><strong>Comment</strong>: {discussion_comment}</span><br /><br /><span style="font-size: 12pt;">You can view the discussion on the following link: <a href="{discussion_link}">{discussion_subject}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (36, 'project', 'new-project-discussion-comment-to-staff', 'english', 'New Discussion Comment (Sent to Project Members)', 'New Discussion Comment', '<p>Hi {staff_firstname}<br /><br />New discussion comment has been made on <strong>{discussion_subject}</strong> from <strong>{comment_creator}</strong><br /><br /><strong>Discussion subject:</strong> {discussion_subject}<br /><strong>Comment:</strong> {discussion_comment}<br /><br />You can view the discussion on the following link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (37, 'project', 'staff-added-as-project-member', 'english', 'Staff Added as Project Member', 'New project assigned to you', '<p>Hi {staff_firstname}<br /><br />New project has been assigned to you.<br /><br />You can view the project on the following link <a href="{project_link}">{project_name}</a><br /><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (38, 'estimate', 'estimate-expiry-reminder', 'english', 'Estimate Expiration Reminder', 'Estimate Expiration Reminder', '<p><span style="font-size: 12pt;">Hello {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">The estimate with <strong># {estimate_number}</strong> will expire on <strong>{estimate_expirydate}</strong></span><br /><br /><span style="font-size: 12pt;">You can view the estimate on the following link: <a href="{estimate_link}">{estimate_number}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (39, 'proposals', 'proposal-expiry-reminder', 'english', 'Proposal Expiration Reminder', 'Proposal Expiration Reminder', '<p>Hello {proposal_proposal_to}<br /><br />The proposal {proposal_number}&nbsp;will expire on <strong>{proposal_open_till}</strong><br /><br />You can view the proposal on the following link: <a href="{proposal_link}">{proposal_number}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (40, 'staff', 'new-staff-created', 'english', 'New Staff Created (Welcome Email)', 'You are added as staff member', 'Hi {staff_firstname}<br /><br />You are added as member on our CRM.<br /><br />Please use the following logic credentials:<br /><br /><strong>Email:</strong> {staff_email}<br /><strong>Password:</strong> {password}<br /><br />Click <a href="{admin_url}">here </a>to login in the dashboard.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (41, 'client', 'contact-forgot-password', 'english', 'Forgot Password', 'Create New Password', '<h2>Create a new password</h2>
Forgot your password?<br /> To create a new password, just follow this link:<br /> <br /><a href="{reset_password_url}">Reset Password</a><br /> <br /> You received this email, because it was requested by a {companyname}&nbsp;user. This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same. <br /><br /> {email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (42, 'client', 'contact-password-reseted', 'english', 'Password Reset - Confirmation', 'Your password has been changed', '<strong><span style="font-size: 14pt;">You have changed your password.</span><br /></strong><br /> Please, keep it in your records so you don''t forget it.<br /> <br /> Your email address for login is: {contact_email}<br /><br />If this wasnt you, please contact us.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (43, 'client', 'contact-set-password', 'english', 'Set New Password', 'Set new password on {companyname} ', '<h2><span style="font-size: 14pt;">Setup your new password on {companyname}</span></h2>
Please use the following link to set up your new password:<br /><br /><a href="{set_password_url}">Set new password</a><br /><br />Keep it in your records so you don''t forget it.<br /><br />Please set your new password in <strong>48 hours</strong>. After that, you won''t be able to set your password because this link will expire.<br /><br />You can login at: <a href="{crm_url}">{crm_url}</a><br />Your email address for login: {contact_email}<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (44, 'staff', 'staff-forgot-password', 'english', 'Forgot Password', 'Create New Password', '<h2><span style="font-size: 14pt;">Create a new password</span></h2>
Forgot your password?<br /> To create a new password, just follow this link:<br /> <br /><a href="{reset_password_url}">Reset Password</a><br /> <br /> You received this email, because it was requested by a <strong>{companyname}</strong>&nbsp;user. This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same. <br /><br /> {email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (45, 'staff', 'staff-password-reseted', 'english', 'Password Reset - Confirmation', 'Your password has been changed', '<span style="font-size: 14pt;"><strong>You have changed your password.<br /></strong></span><br /> Please, keep it in your records so you don''t forget it.<br /> <br /> Your email address for login is: {staff_email}<br /><br /> If this wasnt you, please contact us.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (46, 'project', 'assigned-to-project', 'english', 'New Project Created (Sent to Customer Contacts)', 'New Project Created', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>
<p>New project is assigned to your company.<br /><br /><strong>Project Name:</strong>&nbsp;{project_name}<br /><strong>Project Start Date:</strong>&nbsp;{project_start_date}</p>
<p>You can view the project on the following link:&nbsp;<a href="{project_link}">{project_name}</a></p>
<p>We are looking forward hearing from you.<br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (47, 'tasks', 'task-added-attachment-to-contacts', 'english', 'New Attachment(s) on Task (Sent to Customer Contacts)', 'New Attachment on Task - {task_name}', '<span>Hi {contact_firstname} {contact_lastname}</span><br /><br /><strong>{task_user_take_action}</strong><span> added an attachment on the following task:</span><br /><br /><strong>Name:</strong><span> {task_name}</span><br /><br /><span>You can view the task on the following link: </span><a href="{task_link}">{task_name}</a><br /><br /><span>Kind Regards,</span><br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (48, 'tasks', 'task-commented-to-contacts', 'english', 'New Comment on Task (Sent to Customer Contacts)', 'New Comment on Task - {task_name}', '<span>Dear {contact_firstname} {contact_lastname}</span><br /><br /><span>A comment has been made on the following task:</span><br /><br /><strong>Name:</strong><span> {task_name}</span><br /><strong>Comment:</strong><span> {task_comment}</span><br /><br /><span>You can view the task on the following link: </span><a href="{task_link}">{task_name}</a><br /><br /><span>Kind Regards,</span><br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (49, 'leads', 'new-lead-assigned', 'english', 'New Lead Assigned to Staff Member', 'New lead assigned to you', '<p>Hello {lead_assigned}<br /><br />New lead is assigned to you.<br /><br /><strong>Lead Name:</strong>&nbsp;{lead_name}<br /><strong>Lead Email:</strong>&nbsp;{lead_email}<br /><br />You can view the lead on the following link: <a href="{lead_link}">{lead_name}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (50, 'client', 'client-statement', 'english', 'Statement - Account Summary', 'Account Statement from {statement_from} to {statement_to}', 'Dear {contact_firstname} {contact_lastname}, <br /><br />Its been a great experience working with you.<br /><br />Attached with this email is a list of all transactions for the period between {statement_from} to {statement_to}<br /><br />For your information your account balance due is total:&nbsp;{statement_balance_due}<br /><br />Please contact us if you need more information.<br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (51, 'ticket', 'ticket-assigned-to-admin', 'english', 'New Ticket Assigned (Sent to Staff)', 'New support ticket has been assigned to you', '<p><span style="font-size: 12pt;">Hi</span></p>
<p><span style="font-size: 12pt;">A new support ticket&nbsp;has been assigned to you.</span><br /><br /><span style="font-size: 12pt;"><strong>Subject</strong>: {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Department</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Priority</strong>: {ticket_priority}</span><br /><br /><span style="font-size: 12pt;"><strong>Ticket message:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">You can view the ticket on the following link: <a href="{ticket_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (52, 'client', 'new-client-registered-to-admin', 'english', 'New Customer Registration (Sent to admins)', 'New Customer Registration', 'Hello.<br /><br />New customer registration on your customer portal:<br /><br /><strong>Firstname:</strong>&nbsp;{contact_firstname}<br /><strong>Lastname:</strong>&nbsp;{contact_lastname}<br /><strong>Company:</strong>&nbsp;{client_company}<br /><strong>Email:</strong>&nbsp;{contact_email}<br /><br />Best Regards', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (53, 'leads', 'new-web-to-lead-form-submitted', 'english', 'Web to lead form submitted - Sent to lead', '{lead_name} - We Received Your Request', 'Hello {lead_name}.<br /><br /><strong>Your request has been received.</strong><br /><br />This email is to let you know that we received your request and we will get back to you as soon as possible with more information.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 0, 0);
INSERT INTO "tblemailtemplates" VALUES (54, 'staff', 'two-factor-authentication', 'english', 'Two Factor Authentication', 'Confirm Your Login', '<p>Hi {staff_firstname}</p>
<p style="text-align: left;">You received this email because you have enabled two factor authentication in your account.<br />Use the following code to confirm your login:</p>
<p style="text-align: left;"><span style="font-size: 18pt;"><strong>{two_factor_auth_code}<br /><br /></strong><span style="font-size: 12pt;">{email_signature}</span><strong><br /><br /><br /><br /></strong></span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (55, 'project', 'project-finished-to-customer', 'english', 'Project Marked as Finished (Sent to Customer Contacts)', 'Project Marked as Finished', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>
<p>You are receiving this email because project&nbsp;<strong>{project_name}</strong> has been marked as finished. This project is assigned under your company and we just wanted to keep you up to date.<br /><br />You can view the project on the following link:&nbsp;<a href="{project_link}">{project_name}</a></p>
<p>If you have any questions don''t hesitate to contact us.<br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (56, 'credit_note', 'credit-note-send-to-client', 'english', 'Send Credit Note To Email', 'Credit Note With Number #{credit_note_number} Created', 'Dear&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />We have attached the credit note with number <strong>#{credit_note_number} </strong>for your reference.<br /><br /><strong>Date:</strong>&nbsp;{credit_note_date}<br /><strong>Total Amount:</strong>&nbsp;{credit_note_total}<br /><br /><span style="font-size: 12pt;">Please contact us for more information.</span><br /> <br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (57, 'tasks', 'task-status-change-to-staff', 'english', 'Task Status Changed (Sent to Staff)', 'Task Status Changed', '<span style="font-size: 12pt;">Hi {staff_firstname}</span><br /><br /><span style="font-size: 12pt;"><strong>{task_user_take_action}</strong> marked task as <strong>{task_status}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Name:</strong> {task_name}</span><br /><span style="font-size: 12pt;"><strong>Due date:</strong> {task_duedate}</span><br /><br /><span style="font-size: 12pt;">You can view the task on the following link: <a href="{task_link}">{task_name}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (58, 'tasks', 'task-status-change-to-contacts', 'english', 'Task Status Changed (Sent to Customer Contacts)', 'Task Status Changed', '<span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;"><strong>{task_user_take_action}</strong> marked task as <strong>{task_status}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Name:</strong> {task_name}</span><br /><span style="font-size: 12pt;"><strong>Due date:</strong> {task_duedate}</span><br /><br /><span style="font-size: 12pt;">You can view the task on the following link: <a href="{task_link}">{task_name}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (59, 'staff', 'reminder-email-staff', 'english', 'Staff Reminder Email', 'You Have a New Reminder!', '<p>Hello&nbsp;{staff_firstname}<br /><br /><strong>You have a new reminder&nbsp;linked to&nbsp;{staff_reminder_relation_name}!<br /><br />Reminder description:</strong><br />{staff_reminder_description}<br /><br />Click <a href="{staff_reminder_relation_link}">here</a> to view&nbsp;<a href="{staff_reminder_relation_link}">{staff_reminder_relation_name}</a><br /><br />Best Regards<br /><br /></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (60, 'contract', 'contract-comment-to-client', 'english', 'New Comment  (Sent to Customer Contacts)', 'New Contract Comment', 'Dear {contact_firstname} {contact_lastname}<br /> <br />A new comment has been made on the following contract: <strong>{contract_subject}</strong><br /> <br />You can view and reply to the comment on the following link: <a href="{contract_link}">{contract_subject}</a><br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (61, 'contract', 'contract-comment-to-admin', 'english', 'New Comment (Sent to Staff) ', 'New Contract Comment', 'Hi {staff_firstname}<br /><br />A new comment has been made to the contract&nbsp;<strong>{contract_subject}</strong><br /><br />You can view and reply to the comment on the following link: <a href="{contract_link}">{contract_subject}</a>&nbsp;or from the admin area.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (62, 'subscriptions', 'send-subscription', 'english', 'Send Subscription to Customer', 'Subscription Created', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />We have prepared the subscription&nbsp;<strong>{subscription_name}</strong> for your company.<br /><br />Click <a href="{subscription_link}">here</a> to review the subscription and subscribe.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (63, 'subscriptions', 'subscription-payment-failed', 'english', 'Subscription Payment Failed', 'Your most recent invoice payment failed', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br br="" />Unfortunately, your most recent invoice payment for&nbsp;<strong>{subscription_name}</strong> was declined.<br /><br />This could be due to a change in your card number, your card expiring,<br />cancellation of your credit card, or the card issuer not recognizing the<br />payment and therefore taking action to prevent it.<br /><br />Please update your payment information as soon as possible by logging in here:<br /><a href="{crm_url}/login">{crm_url}/login</a><br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (64, 'subscriptions', 'subscription-canceled', 'english', 'Subscription Canceled (Sent to customer primary contact)', 'Your subscription has been canceled', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />Your subscription&nbsp;<strong>{subscription_name} </strong>has been canceled, if you have any questions don''t hesitate to contact us.<br /><br />It was a pleasure doing business with you.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (65, 'subscriptions', 'subscription-payment-succeeded', 'english', 'Subscription Payment Succeeded (Sent to customer primary contact)', 'Subscription  Payment Receipt - {subscription_name}', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />This email is to let you know that we received your payment for subscription&nbsp;<strong>{subscription_name}&nbsp;</strong>of&nbsp;<strong><span>{payment_total}<br /><br /></span></strong>The invoice associated with it is now with status&nbsp;<strong>{invoice_status}<br /></strong><br />Thank you for your confidence.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (66, 'contract', 'contract-expiration-to-staff', 'english', 'Contract Expiration Reminder (Sent to Staff)', 'Contract Expiration Reminder', 'Hi {staff_firstname}<br /><br /><span style="font-size: 12pt;">This is a reminder that the following contract will expire soon:</span><br /><br /><span style="font-size: 12pt;"><strong>Subject:</strong> {contract_subject}</span><br /><span style="font-size: 12pt;"><strong>Description:</strong> {contract_description}</span><br /><span style="font-size: 12pt;"><strong>Date Start:</strong> {contract_datestart}</span><br /><span style="font-size: 12pt;"><strong>Date End:</strong> {contract_dateend}</span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (67, 'gdpr', 'gdpr-removal-request', 'english', 'Removal Request From Contact (Sent to administrators)', 'Data Removal Request Received', 'Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}<br /><br />Data removal has been requested by&nbsp;{contact_firstname} {contact_lastname}<br /><br />You can review this request and take proper actions directly from the admin area.', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (68, 'gdpr', 'gdpr-removal-request-lead', 'english', 'Removal Request From Lead (Sent to administrators)', 'Data Removal Request Received', 'Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}<br /><br />Data removal has been requested by {lead_name}<br /><br />You can review this request and take proper actions directly from the admin area.<br /><br />To view the lead inside the admin area click here:&nbsp;<a href="{lead_link}">{lead_link}</a>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (69, 'client', 'client-registration-confirmed', 'english', 'Customer Registration Confirmed', 'Your registration is confirmed', '<p>Dear {contact_firstname} {contact_lastname}<br /><br />We just wanted to let you know that your registration at&nbsp;{companyname} is successfully confirmed and your account is now active.<br /><br />You can login at&nbsp;<a href="{crm_url}">{crm_url}</a> with the email and password you provided during registration.<br /><br />Please contact us if you need any help.<br /><br />Kind Regards, <br />{email_signature}</p>
<p><br />(This is an automated email, so please don''t reply to this email address)</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (70, 'contract', 'contract-signed-to-staff', 'english', 'Contract Signed (Sent to Staff)', 'Customer Signed a Contract', 'Hi {staff_firstname}<br /><br />A contract with subject&nbsp;<strong>{contract_subject} </strong>has been successfully signed by the customer.<br /><br />You can view the contract at the following link: <a href="{contract_link}">{contract_subject}</a>&nbsp;or from the admin area.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (71, 'subscriptions', 'customer-subscribed-to-staff', 'english', 'Customer Subscribed to a Subscription (Sent to administrators and subscription creator)', 'Customer Subscribed to a Subscription', 'The customer <strong>{client_company}</strong> subscribed to a subscription with name&nbsp;<strong>{subscription_name}</strong><br /><br /><strong>ID</strong>:&nbsp;{subscription_id}<br /><strong>Subscription name</strong>:&nbsp;{subscription_name}<br /><strong>Subscription description</strong>:&nbsp;{subscription_description}<br /><br />You can view the subscription by clicking <a href="{subscription_link}">here</a><br />
<div style="text-align: center;"><span style="font-size: 10pt;">&nbsp;</span></div>
Best Regards,<br />{email_signature}<br /><br /><span style="font-size: 10pt;"><span style="color: #999999;">You are receiving this email because you are either administrator or you are creator of the subscription.</span></span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (72, 'client', 'contact-verification-email', 'english', 'Email Verification (Sent to Contact After Registration)', 'Verify Email Address', '<p>Hello&nbsp;{contact_firstname}<br /><br />Please click the button below to verify your email address.<br /><br /><a href="{email_verification_url}">Verify Email Address</a><br /><br />If you did not create an account, no further action is required</p>
<p><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (73, 'client', 'new-customer-profile-file-uploaded-to-staff', 'english', 'New Customer Profile File(s) Uploaded (Sent to Staff)', 'Customer Uploaded New File(s) in Profile', 'Hi!<br /><br />New file(s) is uploaded into the customer ({client_company}) profile by&nbsp;{contact_firstname}<br /><br />You can check the uploaded files into the admin area by clicking <a href="{customer_profile_files_admin_link}">here</a> or at the following link:&nbsp;{customer_profile_files_admin_link}<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (74, 'staff', 'event-notification-to-staff', 'english', 'Event Notification (Calendar)', 'Upcoming Event - {event_title}', 'Hi {staff_firstname}! <br /><br />This is a reminder for event <a href=\"{event_link}\">{event_title}</a> scheduled at {event_start_date}. <br /><br />Regards.', '', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (75, 'subscriptions', 'subscription-payment-requires-action', 'english', 'Credit Card Authorization Required - SCA', 'Important: Confirm your subscription {subscription_name} payment', '<p>Hello {contact_firstname}</p>
<p><strong>Your bank sometimes requires an additional step to make sure an online transaction was authorized.</strong><br /><br />Because of European regulation to protect consumers, many online payments now require two-factor authentication. Your bank ultimately decides when authentication is required to confirm a payment, but you may notice this step when you start paying for a service or when the cost changes.<br /><br />In order to pay the subscription <strong>{subscription_name}</strong>, you will need to&nbsp;confirm your payment by clicking on the follow link: <strong><a href="{subscription_authorize_payment_link}">{subscription_authorize_payment_link}</a></strong><br /><br />To view the subscription, please click at the following link: <a href="{subscription_link}"><span>{subscription_link}</span></a><br />or you can login in our dedicated area here: <a href="{crm_url}/login">{crm_url}/login</a> in case you want to update your credit card or view the subscriptions you are subscribed.<br /><br />Best Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (76, 'invoice', 'invoice-due-notice', 'english', 'Invoice Due Notice', 'Your {invoice_number} will be due soon', '<span style="font-size: 12pt;">Hi {contact_firstname} {contact_lastname}<br /><br /></span>You invoice <span style="font-size: 12pt;"><strong># {invoice_number} </strong>will be due on <strong>{invoice_duedate}</strong></span><br /><br /><span style="font-size: 12pt;">You can view the invoice on the following link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Kind Regards,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (77, 'estimate_request', 'estimate-request-submitted-to-staff', 'english', 'Estimate Request Submitted (Sent to Staff)', 'New Estimate Request Submitted', '<span> Hello,&nbsp;</span><br /><br />{estimate_request_email} submitted an estimate request via the {estimate_request_form_name} form.<br /><br />You can view the request at the following link: <a href="{estimate_request_link}">{estimate_request_link}</a><br /><br />==<br /><br />{estimate_request_submitted_data}<br /><br />Kind Regards,<br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (78, 'estimate_request', 'estimate-request-assigned', 'english', 'Estimate Request Assigned (Sent to Staff)', 'New Estimate Request Assigned', '<span> Hello {estimate_request_assigned},&nbsp;</span><br /><br />Estimate request #{estimate_request_id} has been assigned to you.<br /><br />You can view the request at the following link: <a href="{estimate_request_link}">{estimate_request_link}</a><br /><br />Kind Regards,<br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (79, 'estimate_request', 'estimate-request-received-to-user', 'english', 'Estimate Request Received (Sent to User)', 'Estimate Request Received', 'Hello,<br /><br /><strong>Your request has been received.</strong><br /><br />This email is to let you know that we received your request and we will get back to you as soon as possible with more information.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 0, 0);
INSERT INTO "tblemailtemplates" VALUES (80, 'notifications', 'non-billed-tasks-reminder', 'english', 'Non-billed tasks reminder (sent to selected staff members)', 'Action required: Completed tasks are not billed', 'Hello {staff_firstname}<br><br>The following tasks are marked as complete but not yet billed:<br><br>{unbilled_tasks_list}<br><br>Kind Regards,<br><br>{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (81, 'invoice', 'invoices-batch-payments', 'english', 'Invoices Payments Recorded in Batch (Sent to Customer)', 'We have received your payments', 'Hello {contact_firstname} {contact_lastname}<br><br>Thank you for the payments. Please find the payments details below:<br><br>{batch_payments_list}<br><br>We are looking forward working with you.<br><br>Kind Regards,<br><br>{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (82, 'contract', 'contract-sign-reminder', 'english', 'Contract Sign Reminder (Sent to Customer)', 'Contract Sign Reminder', '<p>Hello {contact_firstname} {contact_lastname}<br /><br />This is a reminder to review and sign the contract:<a href="{contract_link}">{contract_subject}</a></p><p>You can view and sign by visiting: <a href="{contract_link}">{contract_subject}</a></p><p><br />We are looking forward working with you.<br /><br />Kind Regards,<br /><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);

-- ----------------------------
-- Table structure for tblestimate_request_forms
-- ----------------------------
DROP TABLE IF EXISTS "tblestimate_request_forms";
CREATE TABLE "tblestimate_request_forms" (
  "id" integer NOT NULL,
  "form_key" text(32) NOT NULL,
  "type" text(100) NOT NULL,
  "name" text(191) NOT NULL,
  "form_data" text,
  "recaptcha" integer,
  "status" integer NOT NULL,
  "submit_btn_name" text(100),
  "submit_btn_bg_color" text(10),
  "submit_btn_text_color" text(10),
  "success_submit_msg" text,
  "submit_action" integer,
  "submit_redirect_url" text,
  "language" text(100),
  "dateadded" text,
  "notify_type" text(100),
  "notify_ids" text,
  "responsible" integer,
  "notify_request_submitted" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblestimate_request_forms
-- ----------------------------

-- ----------------------------
-- Table structure for tblestimate_request_status
-- ----------------------------
DROP TABLE IF EXISTS "tblestimate_request_status";
CREATE TABLE "tblestimate_request_status" (
  "id" integer NOT NULL,
  "name" text(50) NOT NULL,
  "statusorder" integer,
  "color" text(10),
  "flag" text(30),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblestimate_request_status
-- ----------------------------
INSERT INTO "tblestimate_request_status" VALUES (1, 'Cancelled', 1, '#808080', 'cancelled');
INSERT INTO "tblestimate_request_status" VALUES (2, 'Processing', 2, '#007bff', 'processing');
INSERT INTO "tblestimate_request_status" VALUES (3, 'Completed', 3, '#28a745', 'completed');

-- ----------------------------
-- Table structure for tblestimate_requests
-- ----------------------------
DROP TABLE IF EXISTS "tblestimate_requests";
CREATE TABLE "tblestimate_requests" (
  "id" integer NOT NULL,
  "email" text(100) NOT NULL,
  "submission" text NOT NULL,
  "last_status_change" text,
  "date_estimated" text,
  "from_form_id" integer,
  "assigned" integer,
  "status" integer,
  "default_language" integer NOT NULL,
  "date_added" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblestimate_requests
-- ----------------------------

-- ----------------------------
-- Table structure for tblestimates
-- ----------------------------
DROP TABLE IF EXISTS "tblestimates";
CREATE TABLE "tblestimates" (
  "id" integer NOT NULL,
  "sent" integer(1) NOT NULL,
  "datesend" text,
  "clientid" integer NOT NULL,
  "deleted_customer_name" text(100),
  "project_id" integer NOT NULL,
  "number" integer NOT NULL,
  "prefix" text(50),
  "number_format" integer NOT NULL,
  "formatted_number" text(100),
  "hash" text(32),
  "datecreated" text NOT NULL,
  "date" text NOT NULL,
  "expirydate" text,
  "currency" integer NOT NULL,
  "subtotal" real(15,2) NOT NULL,
  "total_tax" real(15,2) NOT NULL,
  "total" real(15,2) NOT NULL,
  "adjustment" real(15,2),
  "addedfrom" integer NOT NULL,
  "status" integer NOT NULL,
  "clientnote" text,
  "adminnote" text,
  "discount_percent" real(15,2),
  "discount_total" real(15,2),
  "discount_type" text(30),
  "invoiceid" integer,
  "invoiced_date" text,
  "terms" text,
  "reference_no" text(100),
  "sale_agent" integer NOT NULL,
  "billing_street" text(200),
  "billing_city" text(100),
  "billing_state" text(100),
  "billing_zip" text(100),
  "billing_country" integer,
  "shipping_street" text(200),
  "shipping_city" text(100),
  "shipping_state" text(100),
  "shipping_zip" text(100),
  "shipping_country" integer,
  "include_shipping" integer(1) NOT NULL,
  "show_shipping_on_estimate" integer(1) NOT NULL,
  "show_quantity_as" integer NOT NULL,
  "pipeline_order" integer,
  "is_expiry_notified" integer NOT NULL,
  "acceptance_firstname" text(50),
  "acceptance_lastname" text(50),
  "acceptance_email" text(100),
  "acceptance_date" text,
  "acceptance_ip" text(40),
  "signature" text(40),
  "short_link" text(100),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblestimates
-- ----------------------------

-- ----------------------------
-- Table structure for tblevents
-- ----------------------------
DROP TABLE IF EXISTS "tblevents";
CREATE TABLE "tblevents" (
  "eventid" integer NOT NULL,
  "title" text NOT NULL,
  "description" text,
  "userid" integer NOT NULL,
  "start" text NOT NULL,
  "end" text,
  "public" integer NOT NULL,
  "color" text(10),
  "isstartnotified" integer(1) NOT NULL,
  "reminder_before" integer NOT NULL,
  "reminder_before_type" text(10),
  PRIMARY KEY ("eventid")
);

-- ----------------------------
-- Records of tblevents
-- ----------------------------

-- ----------------------------
-- Table structure for tblexpenses
-- ----------------------------
DROP TABLE IF EXISTS "tblexpenses";
CREATE TABLE "tblexpenses" (
  "id" integer NOT NULL,
  "category" integer NOT NULL,
  "currency" integer NOT NULL,
  "amount" real(15,2) NOT NULL,
  "tax" integer,
  "tax2" integer NOT NULL,
  "reference_no" text(100),
  "note" text,
  "expense_name" text(191),
  "clientid" integer NOT NULL,
  "project_id" integer NOT NULL,
  "billable" integer,
  "invoiceid" integer,
  "paymentmode" text(50),
  "date" text NOT NULL,
  "recurring_type" text(10),
  "repeat_every" integer,
  "recurring" integer NOT NULL,
  "cycles" integer NOT NULL,
  "total_cycles" integer NOT NULL,
  "custom_recurring" integer NOT NULL,
  "last_recurring_date" text,
  "create_invoice_billable" integer(1),
  "send_invoice_to_customer" integer(1) NOT NULL,
  "recurring_from" integer,
  "dateadded" text NOT NULL,
  "addedfrom" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblexpenses
-- ----------------------------

-- ----------------------------
-- Table structure for tblexpenses_categories
-- ----------------------------
DROP TABLE IF EXISTS "tblexpenses_categories";
CREATE TABLE "tblexpenses_categories" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "description" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblexpenses_categories
-- ----------------------------

-- ----------------------------
-- Table structure for tblfiles
-- ----------------------------
DROP TABLE IF EXISTS "tblfiles";
CREATE TABLE "tblfiles" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(20) NOT NULL,
  "file_name" text(191) NOT NULL,
  "filetype" text(40),
  "visible_to_customer" integer NOT NULL,
  "attachment_key" text(32),
  "external" text(40),
  "external_link" text,
  "thumbnail_link" text,
  "staffid" integer NOT NULL,
  "contact_id" integer,
  "task_comment_id" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblfiles
-- ----------------------------

-- ----------------------------
-- Table structure for tblfilter_defaults
-- ----------------------------
DROP TABLE IF EXISTS "tblfilter_defaults";
CREATE TABLE "tblfilter_defaults" (
  "filter_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  "identifier" text(191) NOT NULL,
  "view" text(191) NOT NULL,
  CONSTRAINT "tblfilter_defaults_ibfk_1" FOREIGN KEY ("filter_id") REFERENCES "tblfilters" ("id") ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT "tblfilter_defaults_ibfk_2" FOREIGN KEY ("staff_id") REFERENCES "tblstaff" ("staffid") ON DELETE CASCADE ON UPDATE RESTRICT
);

-- ----------------------------
-- Records of tblfilter_defaults
-- ----------------------------

-- ----------------------------
-- Table structure for tblfilters
-- ----------------------------
DROP TABLE IF EXISTS "tblfilters";
CREATE TABLE "tblfilters" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "builder" text NOT NULL,
  "staff_id" integer NOT NULL,
  "identifier" text(191) NOT NULL,
  "is_shared" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblfilters
-- ----------------------------

-- ----------------------------
-- Table structure for tblform_question_box
-- ----------------------------
DROP TABLE IF EXISTS "tblform_question_box";
CREATE TABLE "tblform_question_box" (
  "boxid" integer NOT NULL,
  "boxtype" text(10) NOT NULL,
  "questionid" integer NOT NULL,
  PRIMARY KEY ("boxid")
);

-- ----------------------------
-- Records of tblform_question_box
-- ----------------------------

-- ----------------------------
-- Table structure for tblform_question_box_description
-- ----------------------------
DROP TABLE IF EXISTS "tblform_question_box_description";
CREATE TABLE "tblform_question_box_description" (
  "questionboxdescriptionid" integer NOT NULL,
  "description" text NOT NULL,
  "boxid" text NOT NULL,
  "questionid" integer NOT NULL,
  PRIMARY KEY ("questionboxdescriptionid")
);

-- ----------------------------
-- Records of tblform_question_box_description
-- ----------------------------

-- ----------------------------
-- Table structure for tblform_questions
-- ----------------------------
DROP TABLE IF EXISTS "tblform_questions";
CREATE TABLE "tblform_questions" (
  "questionid" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(20),
  "question" text NOT NULL,
  "required" integer(1) NOT NULL,
  "question_order" integer NOT NULL,
  PRIMARY KEY ("questionid")
);

-- ----------------------------
-- Records of tblform_questions
-- ----------------------------

-- ----------------------------
-- Table structure for tblform_results
-- ----------------------------
DROP TABLE IF EXISTS "tblform_results";
CREATE TABLE "tblform_results" (
  "resultid" integer NOT NULL,
  "boxid" integer NOT NULL,
  "boxdescriptionid" integer,
  "rel_id" integer NOT NULL,
  "rel_type" text(20),
  "questionid" integer NOT NULL,
  "answer" text,
  "resultsetid" integer NOT NULL,
  PRIMARY KEY ("resultid")
);

-- ----------------------------
-- Records of tblform_results
-- ----------------------------

-- ----------------------------
-- Table structure for tblgdpr_requests
-- ----------------------------
DROP TABLE IF EXISTS "tblgdpr_requests";
CREATE TABLE "tblgdpr_requests" (
  "id" integer NOT NULL,
  "clientid" integer NOT NULL,
  "contact_id" integer NOT NULL,
  "lead_id" integer NOT NULL,
  "request_type" text(191),
  "status" text(40),
  "request_date" text NOT NULL,
  "request_from" text(150),
  "description" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblgdpr_requests
-- ----------------------------

-- ----------------------------
-- Table structure for tblinvoicepaymentrecords
-- ----------------------------
DROP TABLE IF EXISTS "tblinvoicepaymentrecords";
CREATE TABLE "tblinvoicepaymentrecords" (
  "id" integer NOT NULL,
  "invoiceid" integer NOT NULL,
  "amount" real(15,2) NOT NULL,
  "paymentmode" text(40),
  "paymentmethod" text(191),
  "date" text NOT NULL,
  "daterecorded" text NOT NULL,
  "note" text,
  "transactionid" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblinvoicepaymentrecords
-- ----------------------------

-- ----------------------------
-- Table structure for tblinvoices
-- ----------------------------
DROP TABLE IF EXISTS "tblinvoices";
CREATE TABLE "tblinvoices" (
  "id" integer NOT NULL,
  "sent" integer(1) NOT NULL,
  "datesend" text,
  "clientid" integer NOT NULL,
  "deleted_customer_name" text(100),
  "number" integer NOT NULL,
  "prefix" text(50),
  "number_format" integer NOT NULL,
  "formatted_number" text(100),
  "datecreated" text NOT NULL,
  "date" text NOT NULL,
  "duedate" text,
  "currency" integer NOT NULL,
  "subtotal" real(15,2) NOT NULL,
  "total_tax" real(15,2) NOT NULL,
  "total" real(15,2) NOT NULL,
  "adjustment" real(15,2),
  "addedfrom" integer,
  "hash" text(32) NOT NULL,
  "status" integer,
  "clientnote" text,
  "adminnote" text,
  "last_overdue_reminder" text,
  "last_due_reminder" text,
  "cancel_overdue_reminders" integer NOT NULL,
  "allowed_payment_modes" text,
  "token" text,
  "discount_percent" real(15,2),
  "discount_total" real(15,2),
  "discount_type" text(30) NOT NULL,
  "recurring" integer NOT NULL,
  "recurring_type" text(10),
  "custom_recurring" integer(1) NOT NULL,
  "cycles" integer NOT NULL,
  "total_cycles" integer NOT NULL,
  "is_recurring_from" integer,
  "last_recurring_date" text,
  "terms" text,
  "sale_agent" integer NOT NULL,
  "billing_street" text(200),
  "billing_city" text(100),
  "billing_state" text(100),
  "billing_zip" text(100),
  "billing_country" integer,
  "shipping_street" text(200),
  "shipping_city" text(100),
  "shipping_state" text(100),
  "shipping_zip" text(100),
  "shipping_country" integer,
  "include_shipping" integer(1) NOT NULL,
  "show_shipping_on_invoice" integer(1) NOT NULL,
  "show_quantity_as" integer NOT NULL,
  "project_id" integer,
  "subscription_id" integer NOT NULL,
  "short_link" text(100),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblinvoices
-- ----------------------------

-- ----------------------------
-- Table structure for tblitem_tax
-- ----------------------------
DROP TABLE IF EXISTS "tblitem_tax";
CREATE TABLE "tblitem_tax" (
  "id" integer NOT NULL,
  "itemid" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(20) NOT NULL,
  "taxrate" real(15,2) NOT NULL,
  "taxname" text(100) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblitem_tax
-- ----------------------------

-- ----------------------------
-- Table structure for tblitemable
-- ----------------------------
DROP TABLE IF EXISTS "tblitemable";
CREATE TABLE "tblitemable" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(15) NOT NULL,
  "description" text NOT NULL,
  "long_description" text,
  "qty" real(15,2) NOT NULL,
  "rate" real(15,2) NOT NULL,
  "unit" text(40),
  "item_order" integer,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblitemable
-- ----------------------------

-- ----------------------------
-- Table structure for tblitems
-- ----------------------------
DROP TABLE IF EXISTS "tblitems";
CREATE TABLE "tblitems" (
  "id" integer NOT NULL,
  "description" text NOT NULL,
  "long_description" text,
  "rate" real(15,2) NOT NULL,
  "tax" integer,
  "tax2" integer,
  "unit" text(40),
  "group_id" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblitems
-- ----------------------------

-- ----------------------------
-- Table structure for tblitems_groups
-- ----------------------------
DROP TABLE IF EXISTS "tblitems_groups";
CREATE TABLE "tblitems_groups" (
  "id" integer NOT NULL,
  "name" text(50) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblitems_groups
-- ----------------------------

-- ----------------------------
-- Table structure for tblknowedge_base_article_feedback
-- ----------------------------
DROP TABLE IF EXISTS "tblknowedge_base_article_feedback";
CREATE TABLE "tblknowedge_base_article_feedback" (
  "articleanswerid" integer NOT NULL,
  "articleid" integer NOT NULL,
  "answer" integer NOT NULL,
  "ip" text(40) NOT NULL,
  "date" text NOT NULL,
  PRIMARY KEY ("articleanswerid")
);

-- ----------------------------
-- Records of tblknowedge_base_article_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for tblknowledge_base
-- ----------------------------
DROP TABLE IF EXISTS "tblknowledge_base";
CREATE TABLE "tblknowledge_base" (
  "articleid" integer NOT NULL,
  "articlegroup" integer NOT NULL,
  "subject" text NOT NULL,
  "description" text NOT NULL,
  "slug" text NOT NULL,
  "active" integer NOT NULL,
  "datecreated" text NOT NULL,
  "article_order" integer NOT NULL,
  "staff_article" integer NOT NULL,
  PRIMARY KEY ("articleid")
);

-- ----------------------------
-- Records of tblknowledge_base
-- ----------------------------

-- ----------------------------
-- Table structure for tblknowledge_base_groups
-- ----------------------------
DROP TABLE IF EXISTS "tblknowledge_base_groups";
CREATE TABLE "tblknowledge_base_groups" (
  "groupid" integer NOT NULL,
  "name" text(191) NOT NULL,
  "group_slug" text,
  "description" text,
  "active" integer NOT NULL,
  "color" text(10),
  "group_order" integer,
  PRIMARY KEY ("groupid")
);

-- ----------------------------
-- Records of tblknowledge_base_groups
-- ----------------------------

-- ----------------------------
-- Table structure for tbllead_activity_log
-- ----------------------------
DROP TABLE IF EXISTS "tbllead_activity_log";
CREATE TABLE "tbllead_activity_log" (
  "id" integer NOT NULL,
  "leadid" integer NOT NULL,
  "description" text NOT NULL,
  "additional_data" text,
  "date" text NOT NULL,
  "staffid" integer NOT NULL,
  "full_name" text(100),
  "custom_activity" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbllead_activity_log
-- ----------------------------

-- ----------------------------
-- Table structure for tbllead_integration_emails
-- ----------------------------
DROP TABLE IF EXISTS "tbllead_integration_emails";
CREATE TABLE "tbllead_integration_emails" (
  "id" integer NOT NULL,
  "subject" text,
  "body" text,
  "dateadded" text NOT NULL,
  "leadid" integer NOT NULL,
  "emailid" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbllead_integration_emails
-- ----------------------------

-- ----------------------------
-- Table structure for tblleads
-- ----------------------------
DROP TABLE IF EXISTS "tblleads";
CREATE TABLE "tblleads" (
  "id" integer NOT NULL,
  "hash" text(65),
  "name" text(191) NOT NULL,
  "title" text(100),
  "company" text(191),
  "description" text,
  "country" integer NOT NULL,
  "zip" text(15),
  "city" text(100),
  "state" text(50),
  "address" text(100),
  "assigned" integer NOT NULL,
  "dateadded" text NOT NULL,
  "from_form_id" integer NOT NULL,
  "status" integer NOT NULL,
  "source" integer NOT NULL,
  "lastcontact" text,
  "dateassigned" text,
  "last_status_change" text,
  "addedfrom" integer NOT NULL,
  "email" text(100),
  "website" text(150),
  "leadorder" integer,
  "phonenumber" text(50),
  "date_converted" text,
  "lost" integer(1) NOT NULL,
  "junk" integer NOT NULL,
  "last_lead_status" integer NOT NULL,
  "is_imported_from_email_integration" integer(1) NOT NULL,
  "email_integration_uid" text(30),
  "is_public" integer(1) NOT NULL,
  "default_language" text(40),
  "client_id" integer NOT NULL,
  "lead_value" real(15,2),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblleads
-- ----------------------------

-- ----------------------------
-- Table structure for tblleads_email_integration
-- ----------------------------
DROP TABLE IF EXISTS "tblleads_email_integration";
CREATE TABLE "tblleads_email_integration" (
  "id" integer NOT NULL,
  "active" integer NOT NULL,
  "email" text(100) NOT NULL,
  "imap_server" text(100) NOT NULL,
  "password" text NOT NULL,
  "check_every" integer NOT NULL,
  "responsible" integer NOT NULL,
  "lead_source" integer NOT NULL,
  "lead_status" integer NOT NULL,
  "encryption" text(3),
  "folder" text(100) NOT NULL,
  "last_run" text(50),
  "notify_lead_imported" integer(1) NOT NULL,
  "notify_lead_contact_more_times" integer(1) NOT NULL,
  "notify_type" text(20),
  "notify_ids" text,
  "mark_public" integer NOT NULL,
  "only_loop_on_unseen_emails" integer(1) NOT NULL,
  "delete_after_import" integer NOT NULL,
  "create_task_if_customer" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblleads_email_integration
-- ----------------------------
INSERT INTO "tblleads_email_integration" VALUES (1, 0, '', '', '', 10, 0, 0, 0, 'tls', 'INBOX', '', 1, 1, 'assigned', '', 0, 1, 0, 1);

-- ----------------------------
-- Table structure for tblleads_sources
-- ----------------------------
DROP TABLE IF EXISTS "tblleads_sources";
CREATE TABLE "tblleads_sources" (
  "id" integer NOT NULL,
  "name" text(150) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblleads_sources
-- ----------------------------
INSERT INTO "tblleads_sources" VALUES (1, 'Google');
INSERT INTO "tblleads_sources" VALUES (2, 'Facebook');

-- ----------------------------
-- Table structure for tblleads_status
-- ----------------------------
DROP TABLE IF EXISTS "tblleads_status";
CREATE TABLE "tblleads_status" (
  "id" integer NOT NULL,
  "name" text(50) NOT NULL,
  "statusorder" integer,
  "color" text(10),
  "isdefault" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblleads_status
-- ----------------------------
INSERT INTO "tblleads_status" VALUES (1, 'Customer', 1000, '#7cb342', 1);

-- ----------------------------
-- Table structure for tblmail_queue
-- ----------------------------
DROP TABLE IF EXISTS "tblmail_queue";
CREATE TABLE "tblmail_queue" (
  "id" integer NOT NULL,
  "engine" text(40),
  "email" text(191) NOT NULL,
  "cc" text,
  "bcc" text,
  "message" text NOT NULL,
  "alt_message" text,
  "status" text(255),
  "date" text,
  "headers" text,
  "attachments" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblmail_queue
-- ----------------------------

-- ----------------------------
-- Table structure for tblmigrations
-- ----------------------------
DROP TABLE IF EXISTS "tblmigrations";
CREATE TABLE "tblmigrations" (
  "version" integer NOT NULL
);

-- ----------------------------
-- Records of tblmigrations
-- ----------------------------
INSERT INTO "tblmigrations" VALUES (330);

-- ----------------------------
-- Table structure for tblmilestones
-- ----------------------------
DROP TABLE IF EXISTS "tblmilestones";
CREATE TABLE "tblmilestones" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "description" text,
  "description_visible_to_customer" integer(1),
  "start_date" text,
  "due_date" text NOT NULL,
  "project_id" integer NOT NULL,
  "color" text(10),
  "milestone_order" integer NOT NULL,
  "datecreated" text NOT NULL,
  "hide_from_customer" integer,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblmilestones
-- ----------------------------

-- ----------------------------
-- Table structure for tblmodules
-- ----------------------------
DROP TABLE IF EXISTS "tblmodules";
CREATE TABLE "tblmodules" (
  "id" integer NOT NULL,
  "module_name" text(55) NOT NULL,
  "installed_version" text(11) NOT NULL,
  "active" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblmodules
-- ----------------------------

-- ----------------------------
-- Table structure for tblnewsfeed_comment_likes
-- ----------------------------
DROP TABLE IF EXISTS "tblnewsfeed_comment_likes";
CREATE TABLE "tblnewsfeed_comment_likes" (
  "id" integer NOT NULL,
  "postid" integer NOT NULL,
  "commentid" integer NOT NULL,
  "userid" integer NOT NULL,
  "dateliked" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblnewsfeed_comment_likes
-- ----------------------------

-- ----------------------------
-- Table structure for tblnewsfeed_post_comments
-- ----------------------------
DROP TABLE IF EXISTS "tblnewsfeed_post_comments";
CREATE TABLE "tblnewsfeed_post_comments" (
  "id" integer NOT NULL,
  "content" text,
  "userid" integer NOT NULL,
  "postid" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblnewsfeed_post_comments
-- ----------------------------

-- ----------------------------
-- Table structure for tblnewsfeed_post_likes
-- ----------------------------
DROP TABLE IF EXISTS "tblnewsfeed_post_likes";
CREATE TABLE "tblnewsfeed_post_likes" (
  "id" integer NOT NULL,
  "postid" integer NOT NULL,
  "userid" integer NOT NULL,
  "dateliked" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblnewsfeed_post_likes
-- ----------------------------

-- ----------------------------
-- Table structure for tblnewsfeed_posts
-- ----------------------------
DROP TABLE IF EXISTS "tblnewsfeed_posts";
CREATE TABLE "tblnewsfeed_posts" (
  "postid" integer NOT NULL,
  "creator" integer NOT NULL,
  "datecreated" text NOT NULL,
  "visibility" text(100) NOT NULL,
  "content" text NOT NULL,
  "pinned" integer NOT NULL,
  "datepinned" text,
  PRIMARY KEY ("postid")
);

-- ----------------------------
-- Records of tblnewsfeed_posts
-- ----------------------------

-- ----------------------------
-- Table structure for tblnotes
-- ----------------------------
DROP TABLE IF EXISTS "tblnotes";
CREATE TABLE "tblnotes" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(20) NOT NULL,
  "description" text,
  "date_contacted" text,
  "addedfrom" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblnotes
-- ----------------------------

-- ----------------------------
-- Table structure for tblnotifications
-- ----------------------------
DROP TABLE IF EXISTS "tblnotifications";
CREATE TABLE "tblnotifications" (
  "id" integer NOT NULL,
  "isread" integer NOT NULL,
  "isread_inline" integer(1) NOT NULL,
  "date" text NOT NULL,
  "description" text NOT NULL,
  "fromuserid" integer NOT NULL,
  "fromclientid" integer NOT NULL,
  "from_fullname" text(100) NOT NULL,
  "touserid" integer NOT NULL,
  "fromcompany" integer,
  "link" text,
  "additional_data" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblnotifications
-- ----------------------------

-- ----------------------------
-- Table structure for tbloptions
-- ----------------------------
DROP TABLE IF EXISTS "tbloptions";
CREATE TABLE "tbloptions" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "value" text NOT NULL,
  "autoload" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbloptions
-- ----------------------------
INSERT INTO "tbloptions" VALUES (1, 'dateformat', 'Y-m-d|%Y-%m-%d', 1);
INSERT INTO "tbloptions" VALUES (2, 'companyname', '', 1);
INSERT INTO "tbloptions" VALUES (3, 'services', '1', 1);
INSERT INTO "tbloptions" VALUES (4, 'maximum_allowed_ticket_attachments', '4', 1);
INSERT INTO "tbloptions" VALUES (5, 'ticket_attachments_file_extensions', '.jpg,.jpeg,.png,.pdf,.doc,.zip,.rar', 1);
INSERT INTO "tbloptions" VALUES (6, 'staff_access_only_assigned_departments', '1', 1);
INSERT INTO "tbloptions" VALUES (7, 'use_knowledge_base', '1', 1);
INSERT INTO "tbloptions" VALUES (8, 'smtp_email', '', 1);
INSERT INTO "tbloptions" VALUES (9, 'smtp_password', '', 1);
INSERT INTO "tbloptions" VALUES (10, 'company_info_format', '{company_name}<br />
      {address}<br />
      {city} {state}<br />
      {country_code} {zip_code}<br />
      {vat_number_with_label}', 0);
INSERT INTO "tbloptions" VALUES (11, 'smtp_port', '', 1);
INSERT INTO "tbloptions" VALUES (12, 'smtp_host', '', 1);
INSERT INTO "tbloptions" VALUES (13, 'smtp_email_charset', 'utf-8', 1);
INSERT INTO "tbloptions" VALUES (14, 'default_timezone', 'America/Sao_Paulo', 1);
INSERT INTO "tbloptions" VALUES (15, 'clients_default_theme', 'perfex', 1);
INSERT INTO "tbloptions" VALUES (16, 'company_logo', '', 1);
INSERT INTO "tbloptions" VALUES (17, 'tables_pagination_limit', '25', 1);
INSERT INTO "tbloptions" VALUES (18, 'main_domain', '', 1);
INSERT INTO "tbloptions" VALUES (19, 'allow_registration', '0', 1);
INSERT INTO "tbloptions" VALUES (20, 'knowledge_base_without_registration', '1', 1);
INSERT INTO "tbloptions" VALUES (21, 'email_signature', '', 1);
INSERT INTO "tbloptions" VALUES (22, 'default_staff_role', '1', 1);
INSERT INTO "tbloptions" VALUES (23, 'newsfeed_maximum_files_upload', '10', 1);
INSERT INTO "tbloptions" VALUES (24, 'contract_expiration_before', '4', 1);
INSERT INTO "tbloptions" VALUES (25, 'invoice_prefix', 'INV-', 1);
INSERT INTO "tbloptions" VALUES (26, 'decimal_separator', '.', 1);
INSERT INTO "tbloptions" VALUES (27, 'thousand_separator', ',', 1);
INSERT INTO "tbloptions" VALUES (28, 'invoice_company_name', '', 1);
INSERT INTO "tbloptions" VALUES (29, 'invoice_company_address', '', 1);
INSERT INTO "tbloptions" VALUES (30, 'invoice_company_city', '', 1);
INSERT INTO "tbloptions" VALUES (31, 'invoice_company_country_code', '', 1);
INSERT INTO "tbloptions" VALUES (32, 'invoice_company_postal_code', '', 1);
INSERT INTO "tbloptions" VALUES (33, 'invoice_company_phonenumber', '', 1);
INSERT INTO "tbloptions" VALUES (34, 'view_invoice_only_logged_in', '0', 1);
INSERT INTO "tbloptions" VALUES (35, 'invoice_number_format', '1', 1);
INSERT INTO "tbloptions" VALUES (36, 'next_invoice_number', '1', 0);
INSERT INTO "tbloptions" VALUES (37, 'active_language', 'english', 1);
INSERT INTO "tbloptions" VALUES (38, 'invoice_number_decrement_on_delete', '1', 1);
INSERT INTO "tbloptions" VALUES (39, 'automatically_send_invoice_overdue_reminder_after', '1', 1);
INSERT INTO "tbloptions" VALUES (40, 'automatically_resend_invoice_overdue_reminder_after', '3', 1);
INSERT INTO "tbloptions" VALUES (41, 'expenses_auto_operations_hour', '9', 1);
INSERT INTO "tbloptions" VALUES (42, 'delete_only_on_last_invoice', '1', 1);
INSERT INTO "tbloptions" VALUES (43, 'delete_only_on_last_estimate', '1', 1);
INSERT INTO "tbloptions" VALUES (44, 'create_invoice_from_recurring_only_on_paid_invoices', '0', 1);
INSERT INTO "tbloptions" VALUES (45, 'allow_payment_amount_to_be_modified', '1', 1);
INSERT INTO "tbloptions" VALUES (46, 'rtl_support_client', '0', 1);
INSERT INTO "tbloptions" VALUES (47, 'limit_top_search_bar_results_to', '10', 1);
INSERT INTO "tbloptions" VALUES (48, 'estimate_prefix', 'EST-', 1);
INSERT INTO "tbloptions" VALUES (49, 'next_estimate_number', '1', 0);
INSERT INTO "tbloptions" VALUES (50, 'estimate_number_decrement_on_delete', '1', 1);
INSERT INTO "tbloptions" VALUES (51, 'estimate_number_format', '1', 1);
INSERT INTO "tbloptions" VALUES (52, 'estimate_auto_convert_to_invoice_on_client_accept', '1', 1);
INSERT INTO "tbloptions" VALUES (53, 'exclude_estimate_from_client_area_with_draft_status', '1', 1);
INSERT INTO "tbloptions" VALUES (54, 'rtl_support_admin', '0', 1);
INSERT INTO "tbloptions" VALUES (55, 'last_cron_run', '', 1);
INSERT INTO "tbloptions" VALUES (56, 'show_sale_agent_on_estimates', '1', 1);
INSERT INTO "tbloptions" VALUES (57, 'show_sale_agent_on_invoices', '1', 1);
INSERT INTO "tbloptions" VALUES (58, 'predefined_terms_invoice', '', 1);
INSERT INTO "tbloptions" VALUES (59, 'predefined_terms_estimate', '', 1);
INSERT INTO "tbloptions" VALUES (60, 'default_task_priority', '2', 1);
INSERT INTO "tbloptions" VALUES (61, 'dropbox_app_key', '', 1);
INSERT INTO "tbloptions" VALUES (62, 'show_expense_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (63, 'only_show_contact_tickets', '1', 1);
INSERT INTO "tbloptions" VALUES (64, 'predefined_clientnote_invoice', '', 1);
INSERT INTO "tbloptions" VALUES (65, 'predefined_clientnote_estimate', '', 1);
INSERT INTO "tbloptions" VALUES (66, 'custom_pdf_logo_image_url', '', 1);
INSERT INTO "tbloptions" VALUES (67, 'favicon', '', 1);
INSERT INTO "tbloptions" VALUES (68, 'invoice_due_after', '30', 1);
INSERT INTO "tbloptions" VALUES (69, 'google_api_key', '', 1);
INSERT INTO "tbloptions" VALUES (70, 'google_calendar_main_calendar', '', 1);
INSERT INTO "tbloptions" VALUES (71, 'default_tax', 'a:0:{}', 1);
INSERT INTO "tbloptions" VALUES (72, 'show_invoices_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (73, 'show_estimates_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (74, 'show_contracts_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (75, 'show_tasks_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (76, 'show_customer_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (77, 'output_client_pdfs_from_admin_area_in_client_language', '0', 1);
INSERT INTO "tbloptions" VALUES (78, 'show_lead_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (79, 'send_estimate_expiry_reminder_before', '4', 1);
INSERT INTO "tbloptions" VALUES (80, 'leads_default_source', '', 1);
INSERT INTO "tbloptions" VALUES (81, 'leads_default_status', '', 1);
INSERT INTO "tbloptions" VALUES (82, 'proposal_expiry_reminder_enabled', '1', 1);
INSERT INTO "tbloptions" VALUES (83, 'send_proposal_expiry_reminder_before', '4', 1);
INSERT INTO "tbloptions" VALUES (84, 'default_contact_permissions', 'a:6:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";}', 1);
INSERT INTO "tbloptions" VALUES (85, 'pdf_logo_width', '150', 1);
INSERT INTO "tbloptions" VALUES (86, 'access_tickets_to_none_staff_members', '0', 1);
INSERT INTO "tbloptions" VALUES (87, 'customer_default_country', '', 1);
INSERT INTO "tbloptions" VALUES (88, 'view_estimate_only_logged_in', '0', 1);
INSERT INTO "tbloptions" VALUES (89, 'show_status_on_pdf_ei', '1', 1);
INSERT INTO "tbloptions" VALUES (90, 'email_piping_only_replies', '0', 1);
INSERT INTO "tbloptions" VALUES (91, 'email_piping_only_registered', '0', 1);
INSERT INTO "tbloptions" VALUES (92, 'default_view_calendar', 'dayGridMonth', 1);
INSERT INTO "tbloptions" VALUES (93, 'email_piping_default_priority', '2', 1);
INSERT INTO "tbloptions" VALUES (94, 'total_to_words_lowercase', '0', 1);
INSERT INTO "tbloptions" VALUES (95, 'show_tax_per_item', '1', 1);
INSERT INTO "tbloptions" VALUES (96, 'total_to_words_enabled', '0', 1);
INSERT INTO "tbloptions" VALUES (97, 'receive_notification_on_new_ticket', '1', 0);
INSERT INTO "tbloptions" VALUES (98, 'autoclose_tickets_after', '0', 1);
INSERT INTO "tbloptions" VALUES (99, 'media_max_file_size_upload', '10', 1);
INSERT INTO "tbloptions" VALUES (100, 'client_staff_add_edit_delete_task_comments_first_hour', '0', 1);
INSERT INTO "tbloptions" VALUES (101, 'show_projects_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (102, 'leads_kanban_limit', '50', 1);
INSERT INTO "tbloptions" VALUES (103, 'tasks_reminder_notification_before', '2', 1);
INSERT INTO "tbloptions" VALUES (104, 'pdf_font', 'freesans', 1);
INSERT INTO "tbloptions" VALUES (105, 'pdf_table_heading_color', '#e5e7eb', 1);
INSERT INTO "tbloptions" VALUES (106, 'pdf_table_heading_text_color', '#030712', 1);
INSERT INTO "tbloptions" VALUES (107, 'pdf_font_size', '10', 1);
INSERT INTO "tbloptions" VALUES (108, 'default_leads_kanban_sort', 'leadorder', 1);
INSERT INTO "tbloptions" VALUES (109, 'default_leads_kanban_sort_type', 'asc', 1);
INSERT INTO "tbloptions" VALUES (110, 'allowed_files', '.png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.txt', 1);
INSERT INTO "tbloptions" VALUES (111, 'show_all_tasks_for_project_member', '1', 1);
INSERT INTO "tbloptions" VALUES (112, 'email_protocol', 'smtp', 1);
INSERT INTO "tbloptions" VALUES (113, 'calendar_first_day', '0', 1);
INSERT INTO "tbloptions" VALUES (114, 'recaptcha_secret_key', '', 1);
INSERT INTO "tbloptions" VALUES (115, 'show_help_on_setup_menu', '1', 1);
INSERT INTO "tbloptions" VALUES (116, 'show_proposals_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (117, 'smtp_encryption', '', 1);
INSERT INTO "tbloptions" VALUES (118, 'recaptcha_site_key', '', 1);
INSERT INTO "tbloptions" VALUES (119, 'smtp_username', '', 1);
INSERT INTO "tbloptions" VALUES (120, 'auto_stop_tasks_timers_on_new_timer', '1', 1);
INSERT INTO "tbloptions" VALUES (121, 'notification_when_customer_pay_invoice', '1', 1);
INSERT INTO "tbloptions" VALUES (122, 'calendar_invoice_color', '#FF6F00', 1);
INSERT INTO "tbloptions" VALUES (123, 'calendar_estimate_color', '#FF6F00', 1);
INSERT INTO "tbloptions" VALUES (124, 'calendar_proposal_color', '#84c529', 1);
INSERT INTO "tbloptions" VALUES (125, 'new_task_auto_assign_current_member', '1', 1);
INSERT INTO "tbloptions" VALUES (126, 'calendar_reminder_color', '#03A9F4', 1);
INSERT INTO "tbloptions" VALUES (127, 'calendar_contract_color', '#B72974', 1);
INSERT INTO "tbloptions" VALUES (128, 'calendar_project_color', '#B72974', 1);
INSERT INTO "tbloptions" VALUES (129, 'update_info_message', '', 1);
INSERT INTO "tbloptions" VALUES (130, 'show_estimate_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (131, 'show_invoice_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (132, 'show_proposal_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (133, 'proposal_due_after', '7', 1);
INSERT INTO "tbloptions" VALUES (134, 'allow_customer_to_change_ticket_status', '0', 1);
INSERT INTO "tbloptions" VALUES (135, 'lead_lock_after_convert_to_customer', '0', 1);
INSERT INTO "tbloptions" VALUES (136, 'default_proposals_pipeline_sort', 'pipeline_order', 1);
INSERT INTO "tbloptions" VALUES (137, 'default_proposals_pipeline_sort_type', 'asc', 1);
INSERT INTO "tbloptions" VALUES (138, 'default_estimates_pipeline_sort', 'pipeline_order', 1);
INSERT INTO "tbloptions" VALUES (139, 'default_estimates_pipeline_sort_type', 'asc', 1);
INSERT INTO "tbloptions" VALUES (140, 'use_recaptcha_customers_area', '0', 1);
INSERT INTO "tbloptions" VALUES (141, 'remove_decimals_on_zero', '0', 1);
INSERT INTO "tbloptions" VALUES (142, 'remove_tax_name_from_item_table', '0', 1);
INSERT INTO "tbloptions" VALUES (143, 'pdf_format_invoice', 'A4-PORTRAIT', 1);
INSERT INTO "tbloptions" VALUES (144, 'pdf_format_estimate', 'A4-PORTRAIT', 1);
INSERT INTO "tbloptions" VALUES (145, 'pdf_format_proposal', 'A4-PORTRAIT', 1);
INSERT INTO "tbloptions" VALUES (146, 'pdf_format_payment', 'A4-PORTRAIT', 1);
INSERT INTO "tbloptions" VALUES (147, 'pdf_format_contract', 'A4-PORTRAIT', 1);
INSERT INTO "tbloptions" VALUES (148, 'swap_pdf_info', '0', 1);
INSERT INTO "tbloptions" VALUES (149, 'exclude_invoice_from_client_area_with_draft_status', '1', 1);
INSERT INTO "tbloptions" VALUES (150, 'cron_has_run_from_cli', '0', 1);
INSERT INTO "tbloptions" VALUES (151, 'hide_cron_is_required_message', '0', 0);
INSERT INTO "tbloptions" VALUES (152, 'auto_assign_customer_admin_after_lead_convert', '1', 1);
INSERT INTO "tbloptions" VALUES (153, 'show_transactions_on_invoice_pdf', '1', 1);
INSERT INTO "tbloptions" VALUES (154, 'show_pay_link_to_invoice_pdf', '1', 1);
INSERT INTO "tbloptions" VALUES (155, 'tasks_kanban_limit', '50', 1);
INSERT INTO "tbloptions" VALUES (156, 'purchase_key', '', 1);
INSERT INTO "tbloptions" VALUES (157, 'estimates_pipeline_limit', '50', 1);
INSERT INTO "tbloptions" VALUES (158, 'proposals_pipeline_limit', '50', 1);
INSERT INTO "tbloptions" VALUES (159, 'proposal_number_prefix', 'PRO-', 1);
INSERT INTO "tbloptions" VALUES (160, 'number_padding_prefixes', '6', 1);
INSERT INTO "tbloptions" VALUES (161, 'show_page_number_on_pdf', '0', 1);
INSERT INTO "tbloptions" VALUES (162, 'calendar_events_limit', '4', 1);
INSERT INTO "tbloptions" VALUES (163, 'show_setup_menu_item_only_on_hover', '0', 1);
INSERT INTO "tbloptions" VALUES (164, 'company_requires_vat_number_field', '1', 1);
INSERT INTO "tbloptions" VALUES (165, 'company_is_required', '1', 1);
INSERT INTO "tbloptions" VALUES (166, 'allow_contact_to_delete_files', '0', 1);
INSERT INTO "tbloptions" VALUES (167, 'company_vat', '', 1);
INSERT INTO "tbloptions" VALUES (168, 'di', '1750862558', 1);
INSERT INTO "tbloptions" VALUES (169, 'invoice_auto_operations_hour', '21', 1);
INSERT INTO "tbloptions" VALUES (170, 'use_minified_files', '1', 1);
INSERT INTO "tbloptions" VALUES (171, 'only_own_files_contacts', '0', 1);
INSERT INTO "tbloptions" VALUES (172, 'allow_primary_contact_to_view_edit_billing_and_shipping', '0', 1);
INSERT INTO "tbloptions" VALUES (173, 'estimate_due_after', '7', 1);
INSERT INTO "tbloptions" VALUES (174, 'staff_members_open_tickets_to_all_contacts', '1', 1);
INSERT INTO "tbloptions" VALUES (175, 'time_format', '24', 1);
INSERT INTO "tbloptions" VALUES (176, 'delete_activity_log_older_then', '1', 1);
INSERT INTO "tbloptions" VALUES (177, 'disable_language', '0', 1);
INSERT INTO "tbloptions" VALUES (178, 'company_state', '', 1);
INSERT INTO "tbloptions" VALUES (179, 'email_header', '<!doctype html>
      <html>
      <head>
      <meta name="viewport" content="width=device-width" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <style>
      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }
      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%;
      }
      table td {
        font-family: sans-serif;
        font-size: 14px;
        vertical-align: top;
      }
      /* -------------------------------------
      BODY & CONTAINER
      ------------------------------------- */
      .body {
        background-color: #f6f6f6;
        width: 100%;
      }
      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      
      .container {
        display: block;
        margin: 0 auto !important;
        /* makes it centered */
        max-width: 680px;
        padding: 10px;
        width: 680px;
      }
      /* This should also be a block element, so that it will fill 100% of the .container */
      
      .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 680px;
        padding: 10px;
      }
      /* -------------------------------------
      HEADER, FOOTER, MAIN
      ------------------------------------- */
      
      .main {
        background: #fff;
        border-radius: 3px;
        width: 100%;
      }
      .wrapper {
        box-sizing: border-box;
        padding: 20px;
      }
      .footer {
        clear: both;
        padding-top: 10px;
        text-align: center;
        width: 100%;
      }
      .footer td,
      .footer p,
      .footer span,
      .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
      }
      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        margin: 20px 0;
      }
      /* -------------------------------------
      RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      
      @media only screen and (max-width: 620px) {
        table[class=body] .content {
          padding: 0 !important;
        }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important;
        }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important;
        }
      }
      </style>
      </head>
      <body class="">
      <table border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
      <td>&nbsp;</td>
      <td class="container">
      <div class="content">
      <!-- START CENTERED WHITE CONTAINER -->
      <table class="main">
      <!-- START MAIN CONTENT AREA -->
      <tr>
      <td class="wrapper">
      <table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td>', 1);
INSERT INTO "tbloptions" VALUES (180, 'show_pdf_signature_invoice', '1', 0);
INSERT INTO "tbloptions" VALUES (181, 'show_pdf_signature_estimate', '1', 0);
INSERT INTO "tbloptions" VALUES (182, 'signature_image', '', 0);
INSERT INTO "tbloptions" VALUES (183, 'email_footer', '</td>
      </tr>
      </table>
      </td>
      </tr>
      <!-- END MAIN CONTENT AREA -->
      </table>
      <!-- START FOOTER -->
      <div class="footer">
      <table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td class="content-block">
      <span>{companyname}</span>
      </td>
      </tr>
      </table>
      </div>
      <!-- END FOOTER -->
      <!-- END CENTERED WHITE CONTAINER -->
      </div>
      </td>
      <td>&nbsp;</td>
      </tr>
      </table>
      </body>
      </html>', 1);
INSERT INTO "tbloptions" VALUES (184, 'exclude_proposal_from_client_area_with_draft_status', '1', 1);
INSERT INTO "tbloptions" VALUES (185, 'pusher_app_key', '', 1);
INSERT INTO "tbloptions" VALUES (186, 'pusher_app_secret', '', 1);
INSERT INTO "tbloptions" VALUES (187, 'pusher_app_id', '', 1);
INSERT INTO "tbloptions" VALUES (188, 'pusher_realtime_notifications', '0', 1);
INSERT INTO "tbloptions" VALUES (189, 'pdf_format_statement', 'A4-PORTRAIT', 1);
INSERT INTO "tbloptions" VALUES (190, 'pusher_cluster', '', 1);
INSERT INTO "tbloptions" VALUES (191, 'show_table_export_button', 'to_all', 1);
INSERT INTO "tbloptions" VALUES (192, 'allow_staff_view_proposals_assigned', '1', 1);
INSERT INTO "tbloptions" VALUES (193, 'show_cloudflare_notice', '1', 0);
INSERT INTO "tbloptions" VALUES (194, 'task_modal_class', 'modal-lg', 1);
INSERT INTO "tbloptions" VALUES (195, 'lead_modal_class', 'modal-lg', 1);
INSERT INTO "tbloptions" VALUES (196, 'show_timesheets_overview_all_members_notice_admins', '0', 1);
INSERT INTO "tbloptions" VALUES (197, 'desktop_notifications', '0', 1);
INSERT INTO "tbloptions" VALUES (198, 'hide_notified_reminders_from_calendar', '1', 0);
INSERT INTO "tbloptions" VALUES (199, 'customer_info_format', '{company_name}<br />
      {street}<br />
      {city} {state}<br />
      {country_code} {zip_code}<br />
      {vat_number_with_label}', 0);
INSERT INTO "tbloptions" VALUES (200, 'timer_started_change_status_in_progress', '1', 0);
INSERT INTO "tbloptions" VALUES (201, 'default_ticket_reply_status', '3', 1);
INSERT INTO "tbloptions" VALUES (202, 'default_task_status', 'auto', 1);
INSERT INTO "tbloptions" VALUES (203, 'email_queue_skip_with_attachments', '1', 1);
INSERT INTO "tbloptions" VALUES (204, 'email_queue_enabled', '0', 1);
INSERT INTO "tbloptions" VALUES (205, 'last_email_queue_retry', '', 1);
INSERT INTO "tbloptions" VALUES (206, 'auto_dismiss_desktop_notifications_after', '0', 1);
INSERT INTO "tbloptions" VALUES (207, 'proposal_info_format', '{proposal_to}<br />
      {address}<br />
      {city} {state}<br />
      {country_code} {zip_code}<br />
      {phone}<br />
      {email}', 0);
INSERT INTO "tbloptions" VALUES (208, 'ticket_replies_order', 'desc', 1);
INSERT INTO "tbloptions" VALUES (209, 'new_recurring_invoice_action', 'generate_and_send', 0);
INSERT INTO "tbloptions" VALUES (210, 'bcc_emails', '', 0);
INSERT INTO "tbloptions" VALUES (211, 'email_templates_language_checks', '', 0);
INSERT INTO "tbloptions" VALUES (212, 'proposal_accept_identity_confirmation', '1', 0);
INSERT INTO "tbloptions" VALUES (213, 'estimate_accept_identity_confirmation', '1', 0);
INSERT INTO "tbloptions" VALUES (214, 'new_task_auto_follower_current_member', '0', 1);
INSERT INTO "tbloptions" VALUES (215, 'task_biillable_checked_on_creation', '1', 1);
INSERT INTO "tbloptions" VALUES (216, 'predefined_clientnote_credit_note', '', 1);
INSERT INTO "tbloptions" VALUES (217, 'predefined_terms_credit_note', '', 1);
INSERT INTO "tbloptions" VALUES (218, 'next_credit_note_number', '1', 1);
INSERT INTO "tbloptions" VALUES (219, 'credit_note_prefix', 'CN-', 1);
INSERT INTO "tbloptions" VALUES (220, 'credit_note_number_decrement_on_delete', '1', 1);
INSERT INTO "tbloptions" VALUES (221, 'pdf_format_credit_note', 'A4-PORTRAIT', 1);
INSERT INTO "tbloptions" VALUES (222, 'show_pdf_signature_credit_note', '1', 0);
INSERT INTO "tbloptions" VALUES (223, 'show_credit_note_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (224, 'show_amount_due_on_invoice', '1', 1);
INSERT INTO "tbloptions" VALUES (225, 'show_total_paid_on_invoice', '1', 1);
INSERT INTO "tbloptions" VALUES (226, 'show_credits_applied_on_invoice', '1', 1);
INSERT INTO "tbloptions" VALUES (227, 'staff_members_create_inline_lead_status', '1', 1);
INSERT INTO "tbloptions" VALUES (228, 'staff_members_create_inline_customer_groups', '1', 1);
INSERT INTO "tbloptions" VALUES (229, 'staff_members_create_inline_ticket_services', '1', 1);
INSERT INTO "tbloptions" VALUES (230, 'staff_members_save_tickets_predefined_replies', '1', 1);
INSERT INTO "tbloptions" VALUES (231, 'staff_members_create_inline_contract_types', '1', 1);
INSERT INTO "tbloptions" VALUES (232, 'staff_members_create_inline_expense_categories', '1', 1);
INSERT INTO "tbloptions" VALUES (233, 'show_project_on_credit_note', '1', 1);
INSERT INTO "tbloptions" VALUES (234, 'proposals_auto_operations_hour', '9', 1);
INSERT INTO "tbloptions" VALUES (235, 'estimates_auto_operations_hour', '9', 1);
INSERT INTO "tbloptions" VALUES (236, 'contracts_auto_operations_hour', '9', 1);
INSERT INTO "tbloptions" VALUES (237, 'credit_note_number_format', '1', 1);
INSERT INTO "tbloptions" VALUES (238, 'allow_non_admin_members_to_import_leads', '0', 1);
INSERT INTO "tbloptions" VALUES (239, 'e_sign_legal_text', 'By clicking on "Sign", I consent to be legally bound by this electronic representation of my signature.', 1);
INSERT INTO "tbloptions" VALUES (240, 'show_pdf_signature_contract', '1', 1);
INSERT INTO "tbloptions" VALUES (241, 'view_contract_only_logged_in', '0', 1);
INSERT INTO "tbloptions" VALUES (242, 'show_subscriptions_in_customers_area', '1', 1);
INSERT INTO "tbloptions" VALUES (243, 'calendar_only_assigned_tasks', '0', 1);
INSERT INTO "tbloptions" VALUES (244, 'after_subscription_payment_captured', 'send_invoice_and_receipt', 1);
INSERT INTO "tbloptions" VALUES (245, 'mail_engine', 'phpmailer', 1);
INSERT INTO "tbloptions" VALUES (246, 'gdpr_enable_terms_and_conditions', '0', 1);
INSERT INTO "tbloptions" VALUES (247, 'privacy_policy', '', 1);
INSERT INTO "tbloptions" VALUES (248, 'terms_and_conditions', '', 1);
INSERT INTO "tbloptions" VALUES (249, 'gdpr_enable_terms_and_conditions_lead_form', '0', 1);
INSERT INTO "tbloptions" VALUES (250, 'gdpr_enable_terms_and_conditions_ticket_form', '0', 1);
INSERT INTO "tbloptions" VALUES (251, 'gdpr_contact_enable_right_to_be_forgotten', '0', 1);
INSERT INTO "tbloptions" VALUES (252, 'show_gdpr_in_customers_menu', '1', 1);
INSERT INTO "tbloptions" VALUES (253, 'show_gdpr_link_in_footer', '1', 1);
INSERT INTO "tbloptions" VALUES (254, 'enable_gdpr', '0', 1);
INSERT INTO "tbloptions" VALUES (255, 'gdpr_on_forgotten_remove_invoices_credit_notes', '0', 1);
INSERT INTO "tbloptions" VALUES (256, 'gdpr_on_forgotten_remove_estimates', '0', 1);
INSERT INTO "tbloptions" VALUES (257, 'gdpr_enable_consent_for_contacts', '0', 1);
INSERT INTO "tbloptions" VALUES (258, 'gdpr_consent_public_page_top_block', '', 1);
INSERT INTO "tbloptions" VALUES (259, 'gdpr_page_top_information_block', '', 1);
INSERT INTO "tbloptions" VALUES (260, 'gdpr_enable_lead_public_form', '0', 1);
INSERT INTO "tbloptions" VALUES (261, 'gdpr_show_lead_custom_fields_on_public_form', '0', 1);
INSERT INTO "tbloptions" VALUES (262, 'gdpr_lead_attachments_on_public_form', '0', 1);
INSERT INTO "tbloptions" VALUES (263, 'gdpr_enable_consent_for_leads', '0', 1);
INSERT INTO "tbloptions" VALUES (264, 'gdpr_lead_enable_right_to_be_forgotten', '0', 1);
INSERT INTO "tbloptions" VALUES (265, 'allow_staff_view_invoices_assigned', '1', 1);
INSERT INTO "tbloptions" VALUES (266, 'gdpr_data_portability_leads', '0', 1);
INSERT INTO "tbloptions" VALUES (267, 'gdpr_lead_data_portability_allowed', '', 1);
INSERT INTO "tbloptions" VALUES (268, 'gdpr_contact_data_portability_allowed', '', 1);
INSERT INTO "tbloptions" VALUES (269, 'gdpr_data_portability_contacts', '0', 1);
INSERT INTO "tbloptions" VALUES (270, 'allow_staff_view_estimates_assigned', '1', 1);
INSERT INTO "tbloptions" VALUES (271, 'gdpr_after_lead_converted_delete', '0', 1);
INSERT INTO "tbloptions" VALUES (272, 'gdpr_show_terms_and_conditions_in_footer', '0', 1);
INSERT INTO "tbloptions" VALUES (273, 'save_last_order_for_tables', '0', 1);
INSERT INTO "tbloptions" VALUES (274, 'company_logo_dark', '', 1);
INSERT INTO "tbloptions" VALUES (275, 'customers_register_require_confirmation', '0', 1);
INSERT INTO "tbloptions" VALUES (276, 'allow_non_admin_staff_to_delete_ticket_attachments', '0', 1);
INSERT INTO "tbloptions" VALUES (277, 'receive_notification_on_new_ticket_replies', '1', 0);
INSERT INTO "tbloptions" VALUES (278, 'google_client_id', '', 1);
INSERT INTO "tbloptions" VALUES (279, 'enable_google_picker', '1', 1);
INSERT INTO "tbloptions" VALUES (280, 'show_ticket_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (281, 'ticket_import_reply_only', '0', 1);
INSERT INTO "tbloptions" VALUES (282, 'visible_customer_profile_tabs', 'all', 0);
INSERT INTO "tbloptions" VALUES (283, 'show_project_on_invoice', '1', 1);
INSERT INTO "tbloptions" VALUES (284, 'show_project_on_estimate', '1', 1);
INSERT INTO "tbloptions" VALUES (285, 'staff_members_create_inline_lead_source', '1', 1);
INSERT INTO "tbloptions" VALUES (286, 'lead_unique_validation', '["email"]', 1);
INSERT INTO "tbloptions" VALUES (287, 'last_upgrade_copy_data', '', 1);
INSERT INTO "tbloptions" VALUES (288, 'custom_js_admin_scripts', '', 1);
INSERT INTO "tbloptions" VALUES (289, 'custom_js_customer_scripts', '0', 1);
INSERT INTO "tbloptions" VALUES (290, 'stripe_webhook_id', '', 1);
INSERT INTO "tbloptions" VALUES (291, 'stripe_webhook_signing_secret', '', 1);
INSERT INTO "tbloptions" VALUES (292, 'stripe_ideal_webhook_id', '', 1);
INSERT INTO "tbloptions" VALUES (293, 'stripe_ideal_webhook_signing_secret', '', 1);
INSERT INTO "tbloptions" VALUES (294, 'show_php_version_notice', '1', 0);
INSERT INTO "tbloptions" VALUES (295, 'recaptcha_ignore_ips', '', 1);
INSERT INTO "tbloptions" VALUES (296, 'show_task_reminders_on_calendar', '1', 1);
INSERT INTO "tbloptions" VALUES (297, 'customer_settings', 'true', 1);
INSERT INTO "tbloptions" VALUES (298, 'tasks_reminder_notification_hour', '9', 1);
INSERT INTO "tbloptions" VALUES (299, 'allow_primary_contact_to_manage_other_contacts', '0', 1);
INSERT INTO "tbloptions" VALUES (300, 'items_table_amounts_exclude_currency_symbol', '1', 1);
INSERT INTO "tbloptions" VALUES (301, 'round_off_task_timer_option', '0', 1);
INSERT INTO "tbloptions" VALUES (302, 'round_off_task_timer_time', '5', 1);
INSERT INTO "tbloptions" VALUES (303, 'bitly_access_token', '', 1);
INSERT INTO "tbloptions" VALUES (304, 'enable_support_menu_badges', '0', 1);
INSERT INTO "tbloptions" VALUES (305, 'attach_invoice_to_payment_receipt_email', '0', 1);
INSERT INTO "tbloptions" VALUES (306, 'invoice_due_notice_before', '2', 1);
INSERT INTO "tbloptions" VALUES (307, 'invoice_due_notice_resend_after', '0', 1);
INSERT INTO "tbloptions" VALUES (308, '_leads_settings', 'true', 1);
INSERT INTO "tbloptions" VALUES (309, 'show_estimate_request_in_customers_area', '0', 1);
INSERT INTO "tbloptions" VALUES (310, 'gdpr_enable_terms_and_conditions_estimate_request_form', '0', 1);
INSERT INTO "tbloptions" VALUES (311, 'identification_key', '853454911750862871685c0c17ae24a', 1);
INSERT INTO "tbloptions" VALUES (312, 'automatically_stop_task_timer_after_hours', '8', 1);
INSERT INTO "tbloptions" VALUES (313, 'automatically_assign_ticket_to_first_staff_responding', '0', 1);
INSERT INTO "tbloptions" VALUES (314, 'reminder_for_completed_but_not_billed_tasks', '0', 1);
INSERT INTO "tbloptions" VALUES (315, 'staff_notify_completed_but_not_billed_tasks', '', 1);
INSERT INTO "tbloptions" VALUES (316, 'reminder_for_completed_but_not_billed_tasks_days', '', 1);
INSERT INTO "tbloptions" VALUES (317, 'tasks_reminder_notification_last_notified_day', '', 1);
INSERT INTO "tbloptions" VALUES (318, 'staff_related_ticket_notification_to_assignee_only', '0', 1);
INSERT INTO "tbloptions" VALUES (319, 'show_pdf_signature_proposal', '1', 1);
INSERT INTO "tbloptions" VALUES (320, 'enable_honeypot_spam_validation', '0', 1);
INSERT INTO "tbloptions" VALUES (321, 'microsoft_mail_client_id', '', 1);
INSERT INTO "tbloptions" VALUES (322, 'microsoft_mail_client_secret', '', 1);
INSERT INTO "tbloptions" VALUES (323, 'microsoft_mail_azure_tenant_id', '', 1);
INSERT INTO "tbloptions" VALUES (324, 'google_mail_client_id', '', 1);
INSERT INTO "tbloptions" VALUES (325, 'google_mail_client_secret', '', 1);
INSERT INTO "tbloptions" VALUES (326, 'google_mail_refresh_token', '', 1);
INSERT INTO "tbloptions" VALUES (327, 'automatically_set_logged_in_staff_sales_agent', '1', 1);
INSERT INTO "tbloptions" VALUES (328, 'contract_sign_reminder_every_days', '0', 1);
INSERT INTO "tbloptions" VALUES (329, 'last_updated_date', '', 1);
INSERT INTO "tbloptions" VALUES (330, 'v310_incompatible_tables', '[]', 1);
INSERT INTO "tbloptions" VALUES (331, 'microsoft_mail_refresh_token', '', 1);
INSERT INTO "tbloptions" VALUES (332, 'required_register_fields', '[]', 0);
INSERT INTO "tbloptions" VALUES (333, 'allow_non_admin_members_to_delete_tickets_and_replies', '1', 1);
INSERT INTO "tbloptions" VALUES (334, 'proposal_auto_convert_to_invoice_on_client_accept', '0', 1);
INSERT INTO "tbloptions" VALUES (335, 'show_project_on_proposal', '1', 1);
INSERT INTO "tbloptions" VALUES (336, 'disable_ticket_public_url', '0', 1);
INSERT INTO "tbloptions" VALUES (337, 'upgraded_from_version', '', 0);
INSERT INTO "tbloptions" VALUES (338, 'openai_max_token', '500', 1);
INSERT INTO "tbloptions" VALUES (339, 'ai_provider', '', 1);
INSERT INTO "tbloptions" VALUES (340, 'ai_enable_ticket_summarization', '0', 0);
INSERT INTO "tbloptions" VALUES (341, 'ai_enable_ticket_reply_suggestions', '0', 0);
INSERT INTO "tbloptions" VALUES (342, 'openai_use_fine_tuning', '0', 1);
INSERT INTO "tbloptions" VALUES (343, 'openai_fine_tuning_base_model', '', 1);
INSERT INTO "tbloptions" VALUES (344, 'openai_fine_tuning_last_job_id', '', 1);
INSERT INTO "tbloptions" VALUES (345, 'openai_fine_tuned_model', '', 1);
INSERT INTO "tbloptions" VALUES (346, 'openai_our_fine_tuned_model', '', 1);
INSERT INTO "tbloptions" VALUES (347, 'openai_last_fine_tuning_file_id', '', 1);
INSERT INTO "tbloptions" VALUES (348, 'sms_clickatell_api_key', '', 1);
INSERT INTO "tbloptions" VALUES (349, 'sms_clickatell_active', '0', 1);
INSERT INTO "tbloptions" VALUES (350, 'sms_clickatell_initialized', '1', 1);
INSERT INTO "tbloptions" VALUES (351, 'sms_msg91_sender_id', '', 1);
INSERT INTO "tbloptions" VALUES (352, 'sms_msg91_api_type', 'api', 1);
INSERT INTO "tbloptions" VALUES (353, 'sms_msg91_auth_key', '', 1);
INSERT INTO "tbloptions" VALUES (354, 'sms_msg91_active', '0', 1);
INSERT INTO "tbloptions" VALUES (355, 'sms_msg91_initialized', '1', 1);
INSERT INTO "tbloptions" VALUES (356, 'sms_twilio_account_sid', '', 1);
INSERT INTO "tbloptions" VALUES (357, 'sms_twilio_auth_token', '', 1);
INSERT INTO "tbloptions" VALUES (358, 'sms_twilio_phone_number', '', 1);
INSERT INTO "tbloptions" VALUES (359, 'sms_twilio_sender_id', '', 1);
INSERT INTO "tbloptions" VALUES (360, 'sms_twilio_active', '0', 1);
INSERT INTO "tbloptions" VALUES (361, 'sms_twilio_initialized', '1', 1);

-- ----------------------------
-- Table structure for tblpayment_attempts
-- ----------------------------
DROP TABLE IF EXISTS "tblpayment_attempts";
CREATE TABLE "tblpayment_attempts" (
  "id" integer NOT NULL,
  "reference" text(100) NOT NULL,
  "invoice_id" integer NOT NULL,
  "amount" integer NOT NULL,
  "fee" integer NOT NULL,
  "payment_gateway" text(100) NOT NULL,
  "created_at" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblpayment_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for tblpayment_modes
-- ----------------------------
DROP TABLE IF EXISTS "tblpayment_modes";
CREATE TABLE "tblpayment_modes" (
  "id" integer NOT NULL,
  "name" text(100) NOT NULL,
  "description" text,
  "show_on_pdf" integer NOT NULL,
  "invoices_only" integer NOT NULL,
  "expenses_only" integer NOT NULL,
  "selected_by_default" integer NOT NULL,
  "active" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblpayment_modes
-- ----------------------------
INSERT INTO "tblpayment_modes" VALUES (1, 'Bank', NULL, 0, 0, 0, 1, 1);

-- ----------------------------
-- Table structure for tblpinned_projects
-- ----------------------------
DROP TABLE IF EXISTS "tblpinned_projects";
CREATE TABLE "tblpinned_projects" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblpinned_projects
-- ----------------------------

-- ----------------------------
-- Table structure for tblproject_activity
-- ----------------------------
DROP TABLE IF EXISTS "tblproject_activity";
CREATE TABLE "tblproject_activity" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  "contact_id" integer NOT NULL,
  "fullname" text(100),
  "visible_to_customer" integer NOT NULL,
  "description_key" text(191) NOT NULL,
  "additional_data" text,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblproject_activity
-- ----------------------------

-- ----------------------------
-- Table structure for tblproject_files
-- ----------------------------
DROP TABLE IF EXISTS "tblproject_files";
CREATE TABLE "tblproject_files" (
  "id" integer NOT NULL,
  "file_name" text(191) NOT NULL,
  "original_file_name" text,
  "subject" text(191),
  "description" text,
  "filetype" text(50),
  "dateadded" text NOT NULL,
  "last_activity" text,
  "project_id" integer NOT NULL,
  "visible_to_customer" integer(1),
  "staffid" integer NOT NULL,
  "contact_id" integer NOT NULL,
  "external" text(40),
  "external_link" text,
  "thumbnail_link" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblproject_files
-- ----------------------------

-- ----------------------------
-- Table structure for tblproject_members
-- ----------------------------
DROP TABLE IF EXISTS "tblproject_members";
CREATE TABLE "tblproject_members" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblproject_members
-- ----------------------------

-- ----------------------------
-- Table structure for tblproject_notes
-- ----------------------------
DROP TABLE IF EXISTS "tblproject_notes";
CREATE TABLE "tblproject_notes" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "content" text NOT NULL,
  "staff_id" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblproject_notes
-- ----------------------------

-- ----------------------------
-- Table structure for tblproject_settings
-- ----------------------------
DROP TABLE IF EXISTS "tblproject_settings";
CREATE TABLE "tblproject_settings" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "name" text(100) NOT NULL,
  "value" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblproject_settings
-- ----------------------------

-- ----------------------------
-- Table structure for tblprojectdiscussioncomments
-- ----------------------------
DROP TABLE IF EXISTS "tblprojectdiscussioncomments";
CREATE TABLE "tblprojectdiscussioncomments" (
  "id" integer NOT NULL,
  "discussion_id" integer NOT NULL,
  "discussion_type" text(10) NOT NULL,
  "parent" integer,
  "created" text NOT NULL,
  "modified" text,
  "content" text NOT NULL,
  "staff_id" integer NOT NULL,
  "contact_id" integer,
  "fullname" text(191),
  "file_name" text(191),
  "file_mime_type" text(70),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblprojectdiscussioncomments
-- ----------------------------

-- ----------------------------
-- Table structure for tblprojectdiscussions
-- ----------------------------
DROP TABLE IF EXISTS "tblprojectdiscussions";
CREATE TABLE "tblprojectdiscussions" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "subject" text(191) NOT NULL,
  "description" text NOT NULL,
  "show_to_customer" integer(1) NOT NULL,
  "datecreated" text NOT NULL,
  "last_activity" text,
  "staff_id" integer NOT NULL,
  "contact_id" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblprojectdiscussions
-- ----------------------------

-- ----------------------------
-- Table structure for tblprojects
-- ----------------------------
DROP TABLE IF EXISTS "tblprojects";
CREATE TABLE "tblprojects" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "description" text,
  "status" integer NOT NULL,
  "clientid" integer NOT NULL,
  "billing_type" integer NOT NULL,
  "start_date" text NOT NULL,
  "deadline" text,
  "project_created" text NOT NULL,
  "date_finished" text,
  "progress" integer,
  "progress_from_tasks" integer NOT NULL,
  "project_cost" real(15,2),
  "project_rate_per_hour" real(15,2),
  "estimated_hours" real(15,2),
  "addedfrom" integer NOT NULL,
  "contact_notification" integer,
  "notify_contacts" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblprojects
-- ----------------------------

-- ----------------------------
-- Table structure for tblproposal_comments
-- ----------------------------
DROP TABLE IF EXISTS "tblproposal_comments";
CREATE TABLE "tblproposal_comments" (
  "id" integer NOT NULL,
  "content" text,
  "proposalid" integer NOT NULL,
  "staffid" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblproposal_comments
-- ----------------------------

-- ----------------------------
-- Table structure for tblproposals
-- ----------------------------
DROP TABLE IF EXISTS "tblproposals";
CREATE TABLE "tblproposals" (
  "id" integer NOT NULL,
  "subject" text(191),
  "content" text,
  "addedfrom" integer NOT NULL,
  "datecreated" text NOT NULL,
  "total" real(15,2),
  "subtotal" real(15,2) NOT NULL,
  "total_tax" real(15,2) NOT NULL,
  "adjustment" real(15,2),
  "discount_percent" real(15,2) NOT NULL,
  "discount_total" real(15,2) NOT NULL,
  "discount_type" text(30),
  "show_quantity_as" integer NOT NULL,
  "currency" integer NOT NULL,
  "open_till" text,
  "date" text NOT NULL,
  "rel_id" integer,
  "rel_type" text(40),
  "assigned" integer,
  "hash" text(32) NOT NULL,
  "proposal_to" text(191),
  "project_id" integer,
  "country" integer NOT NULL,
  "zip" text(50),
  "state" text(100),
  "city" text(100),
  "address" text(200),
  "email" text(150),
  "phone" text(50),
  "allow_comments" integer(1) NOT NULL,
  "status" integer NOT NULL,
  "estimate_id" integer,
  "invoice_id" integer,
  "date_converted" text,
  "pipeline_order" integer,
  "is_expiry_notified" integer NOT NULL,
  "acceptance_firstname" text(50),
  "acceptance_lastname" text(50),
  "acceptance_email" text(100),
  "acceptance_date" text,
  "acceptance_ip" text(40),
  "signature" text(40),
  "short_link" text(100),
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblproposals
-- ----------------------------

-- ----------------------------
-- Table structure for tblrelated_items
-- ----------------------------
DROP TABLE IF EXISTS "tblrelated_items";
CREATE TABLE "tblrelated_items" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(30) NOT NULL,
  "item_id" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblrelated_items
-- ----------------------------

-- ----------------------------
-- Table structure for tblreminders
-- ----------------------------
DROP TABLE IF EXISTS "tblreminders";
CREATE TABLE "tblreminders" (
  "id" integer NOT NULL,
  "description" text,
  "date" text NOT NULL,
  "isnotified" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "staff" integer NOT NULL,
  "rel_type" text(40) NOT NULL,
  "notify_by_email" integer NOT NULL,
  "creator" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblreminders
-- ----------------------------

-- ----------------------------
-- Table structure for tblroles
-- ----------------------------
DROP TABLE IF EXISTS "tblroles";
CREATE TABLE "tblroles" (
  "roleid" integer NOT NULL,
  "name" text(150) NOT NULL,
  "permissions" text,
  PRIMARY KEY ("roleid")
);

-- ----------------------------
-- Records of tblroles
-- ----------------------------
INSERT INTO "tblroles" VALUES (1, 'Employee', NULL);

-- ----------------------------
-- Table structure for tblsales_activity
-- ----------------------------
DROP TABLE IF EXISTS "tblsales_activity";
CREATE TABLE "tblsales_activity" (
  "id" integer NOT NULL,
  "rel_type" text(20),
  "rel_id" integer NOT NULL,
  "description" text NOT NULL,
  "additional_data" text,
  "staffid" text(11),
  "full_name" text(100),
  "date" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblsales_activity
-- ----------------------------

-- ----------------------------
-- Table structure for tblscheduled_emails
-- ----------------------------
DROP TABLE IF EXISTS "tblscheduled_emails";
CREATE TABLE "tblscheduled_emails" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(15) NOT NULL,
  "scheduled_at" text NOT NULL,
  "contacts" text(197) NOT NULL,
  "cc" text,
  "attach_pdf" integer(1) NOT NULL,
  "template" text(197) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblscheduled_emails
-- ----------------------------

-- ----------------------------
-- Table structure for tblservices
-- ----------------------------
DROP TABLE IF EXISTS "tblservices";
CREATE TABLE "tblservices" (
  "serviceid" integer NOT NULL,
  "name" text(50) NOT NULL,
  PRIMARY KEY ("serviceid")
);

-- ----------------------------
-- Records of tblservices
-- ----------------------------

-- ----------------------------
-- Table structure for tblsessions
-- ----------------------------
DROP TABLE IF EXISTS "tblsessions";
CREATE TABLE "tblsessions" (
  "id" text(128) NOT NULL,
  "ip_address" text(45) NOT NULL,
  "timestamp" integer NOT NULL,
  "data" blob NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblsessions
-- ----------------------------
INSERT INTO "tblsessions" VALUES ('83712d5431ece64e817f70ff619ba888', '127.0.0.1', 1745309668, '__ci_last_regenerate|i:1745309664;_prev_url|s:38:"http://perfexcrm.test/production/index";staff_user_id|s:1:"1";staff_logged_in|b:1;setup-menu-open|s:0:"";red_url|s:22:"http://perfexcrm.test/";');
INSERT INTO "tblsessions" VALUES ('c68e7dab84d3f97b97727a8e872b9299', '::1', 1750862885, '__ci_last_regenerate|i:1750862826;_prev_url|s:27:"http://localhost:8765/admin";staff_user_id|s:1:"1";staff_logged_in|b:1;setup-menu-open|s:0:"";');

-- ----------------------------
-- Table structure for tblshared_customer_files
-- ----------------------------
DROP TABLE IF EXISTS "tblshared_customer_files";
CREATE TABLE "tblshared_customer_files" (
  "file_id" integer NOT NULL,
  "contact_id" integer NOT NULL
);

-- ----------------------------
-- Records of tblshared_customer_files
-- ----------------------------

-- ----------------------------
-- Table structure for tblspam_filters
-- ----------------------------
DROP TABLE IF EXISTS "tblspam_filters";
CREATE TABLE "tblspam_filters" (
  "id" integer NOT NULL,
  "type" text(40) NOT NULL,
  "rel_type" text(10) NOT NULL,
  "value" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblspam_filters
-- ----------------------------

-- ----------------------------
-- Table structure for tblstaff
-- ----------------------------
DROP TABLE IF EXISTS "tblstaff";
CREATE TABLE "tblstaff" (
  "staffid" integer NOT NULL,
  "email" text(100) NOT NULL,
  "firstname" text(50) NOT NULL,
  "lastname" text(50) NOT NULL,
  "facebook" text,
  "linkedin" text,
  "phonenumber" text(30),
  "skype" text(50),
  "password" text(250) NOT NULL,
  "datecreated" text NOT NULL,
  "profile_image" text(191),
  "last_ip" text(40),
  "last_login" text,
  "last_activity" text,
  "last_password_change" text,
  "new_pass_key" text(32),
  "new_pass_key_requested" text,
  "admin" integer NOT NULL,
  "role" integer,
  "active" integer NOT NULL,
  "default_language" text(40),
  "direction" text(3),
  "media_path_slug" text(191),
  "is_not_staff" integer NOT NULL,
  "hourly_rate" real(15,2) NOT NULL,
  "two_factor_auth_enabled" integer(1),
  "two_factor_auth_code" text(100),
  "two_factor_auth_code_requested" text,
  "email_signature" text,
  "google_auth_secret" text,
  PRIMARY KEY ("staffid")
);

-- ----------------------------
-- Table structure for tblstaff_departments
-- ----------------------------
DROP TABLE IF EXISTS "tblstaff_departments";
CREATE TABLE "tblstaff_departments" (
  "staffdepartmentid" integer NOT NULL,
  "staffid" integer NOT NULL,
  "departmentid" integer NOT NULL,
  PRIMARY KEY ("staffdepartmentid")
);

-- ----------------------------
-- Records of tblstaff_departments
-- ----------------------------

-- ----------------------------
-- Table structure for tblstaff_permissions
-- ----------------------------
DROP TABLE IF EXISTS "tblstaff_permissions";
CREATE TABLE "tblstaff_permissions" (
  "staff_id" integer NOT NULL,
  "feature" text(40) NOT NULL,
  "capability" text(100) NOT NULL
);

-- ----------------------------
-- Records of tblstaff_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for tblsubscriptions
-- ----------------------------
DROP TABLE IF EXISTS "tblsubscriptions";
CREATE TABLE "tblsubscriptions" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "description" text,
  "description_in_item" integer(1) NOT NULL,
  "clientid" integer NOT NULL,
  "date" text,
  "terms" text,
  "currency" integer NOT NULL,
  "tax_id" integer NOT NULL,
  "stripe_tax_id" text(50),
  "tax_id_2" integer NOT NULL,
  "stripe_tax_id_2" text(50),
  "stripe_plan_id" text,
  "stripe_subscription_id" text NOT NULL,
  "next_billing_cycle" integer,
  "ends_at" integer,
  "status" text(50),
  "quantity" integer NOT NULL,
  "project_id" integer NOT NULL,
  "hash" text(32) NOT NULL,
  "created" text NOT NULL,
  "created_from" integer NOT NULL,
  "date_subscribed" text,
  "in_test_environment" integer,
  "last_sent_at" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblsubscriptions
-- ----------------------------

-- ----------------------------
-- Table structure for tbltaggables
-- ----------------------------
DROP TABLE IF EXISTS "tbltaggables";
CREATE TABLE "tbltaggables" (
  "rel_id" integer NOT NULL,
  "rel_type" text(20) NOT NULL,
  "tag_id" integer NOT NULL,
  "tag_order" integer NOT NULL
);

-- ----------------------------
-- Records of tbltaggables
-- ----------------------------

-- ----------------------------
-- Table structure for tbltags
-- ----------------------------
DROP TABLE IF EXISTS "tbltags";
CREATE TABLE "tbltags" (
  "id" integer NOT NULL,
  "name" text(100) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltags
-- ----------------------------

-- ----------------------------
-- Table structure for tbltask_assigned
-- ----------------------------
DROP TABLE IF EXISTS "tbltask_assigned";
CREATE TABLE "tbltask_assigned" (
  "id" integer NOT NULL,
  "staffid" integer NOT NULL,
  "taskid" integer NOT NULL,
  "assigned_from" integer NOT NULL,
  "is_assigned_from_contact" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltask_assigned
-- ----------------------------

-- ----------------------------
-- Table structure for tbltask_checklist_items
-- ----------------------------
DROP TABLE IF EXISTS "tbltask_checklist_items";
CREATE TABLE "tbltask_checklist_items" (
  "id" integer NOT NULL,
  "taskid" integer NOT NULL,
  "description" text NOT NULL,
  "finished" integer NOT NULL,
  "dateadded" text NOT NULL,
  "addedfrom" integer NOT NULL,
  "finished_from" integer,
  "list_order" integer NOT NULL,
  "assigned" integer,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltask_checklist_items
-- ----------------------------

-- ----------------------------
-- Table structure for tbltask_comments
-- ----------------------------
DROP TABLE IF EXISTS "tbltask_comments";
CREATE TABLE "tbltask_comments" (
  "id" integer NOT NULL,
  "content" text NOT NULL,
  "taskid" integer NOT NULL,
  "staffid" integer NOT NULL,
  "contact_id" integer NOT NULL,
  "file_id" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltask_comments
-- ----------------------------

-- ----------------------------
-- Table structure for tbltask_followers
-- ----------------------------
DROP TABLE IF EXISTS "tbltask_followers";
CREATE TABLE "tbltask_followers" (
  "id" integer NOT NULL,
  "staffid" integer NOT NULL,
  "taskid" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltask_followers
-- ----------------------------

-- ----------------------------
-- Table structure for tbltasks
-- ----------------------------
DROP TABLE IF EXISTS "tbltasks";
CREATE TABLE "tbltasks" (
  "id" integer NOT NULL,
  "name" text,
  "description" text,
  "priority" integer,
  "dateadded" text NOT NULL,
  "startdate" text NOT NULL,
  "duedate" text,
  "datefinished" text,
  "addedfrom" integer NOT NULL,
  "is_added_from_contact" integer(1) NOT NULL,
  "status" integer NOT NULL,
  "recurring_type" text(10),
  "repeat_every" integer,
  "recurring" integer NOT NULL,
  "is_recurring_from" integer,
  "cycles" integer NOT NULL,
  "total_cycles" integer NOT NULL,
  "custom_recurring" integer(1) NOT NULL,
  "last_recurring_date" text,
  "rel_id" integer,
  "rel_type" text(30),
  "is_public" integer(1) NOT NULL,
  "billable" integer(1) NOT NULL,
  "billed" integer(1) NOT NULL,
  "invoice_id" integer NOT NULL,
  "hourly_rate" real(15,2) NOT NULL,
  "milestone" integer,
  "kanban_order" integer,
  "milestone_order" integer NOT NULL,
  "visible_to_client" integer(1) NOT NULL,
  "deadline_notified" integer NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltasks
-- ----------------------------

-- ----------------------------
-- Table structure for tbltasks_checklist_templates
-- ----------------------------
DROP TABLE IF EXISTS "tbltasks_checklist_templates";
CREATE TABLE "tbltasks_checklist_templates" (
  "id" integer NOT NULL,
  "description" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltasks_checklist_templates
-- ----------------------------

-- ----------------------------
-- Table structure for tbltaskstimers
-- ----------------------------
DROP TABLE IF EXISTS "tbltaskstimers";
CREATE TABLE "tbltaskstimers" (
  "id" integer NOT NULL,
  "task_id" integer NOT NULL,
  "start_time" text(64) NOT NULL,
  "end_time" text(64),
  "staff_id" integer NOT NULL,
  "hourly_rate" real(15,2) NOT NULL,
  "note" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltaskstimers
-- ----------------------------

-- ----------------------------
-- Table structure for tbltaxes
-- ----------------------------
DROP TABLE IF EXISTS "tbltaxes";
CREATE TABLE "tbltaxes" (
  "id" integer NOT NULL,
  "name" text(100) NOT NULL,
  "taxrate" real(15,2) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltaxes
-- ----------------------------

-- ----------------------------
-- Table structure for tbltemplates
-- ----------------------------
DROP TABLE IF EXISTS "tbltemplates";
CREATE TABLE "tbltemplates" (
  "id" integer NOT NULL,
  "name" text(255) NOT NULL,
  "type" text(100) NOT NULL,
  "addedfrom" integer NOT NULL,
  "content" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltemplates
-- ----------------------------

-- ----------------------------
-- Table structure for tblticket_attachments
-- ----------------------------
DROP TABLE IF EXISTS "tblticket_attachments";
CREATE TABLE "tblticket_attachments" (
  "id" integer NOT NULL,
  "ticketid" integer NOT NULL,
  "replyid" integer,
  "file_name" text(191) NOT NULL,
  "filetype" text(50),
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblticket_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for tblticket_replies
-- ----------------------------
DROP TABLE IF EXISTS "tblticket_replies";
CREATE TABLE "tblticket_replies" (
  "id" integer NOT NULL,
  "ticketid" integer NOT NULL,
  "userid" integer,
  "contactid" integer NOT NULL,
  "name" text,
  "email" text,
  "date" text NOT NULL,
  "message" text,
  "attachment" integer,
  "admin" integer,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblticket_replies
-- ----------------------------

-- ----------------------------
-- Table structure for tbltickets
-- ----------------------------
DROP TABLE IF EXISTS "tbltickets";
CREATE TABLE "tbltickets" (
  "ticketid" integer NOT NULL,
  "adminreplying" integer NOT NULL,
  "userid" integer NOT NULL,
  "contactid" integer NOT NULL,
  "merged_ticket_id" integer,
  "email" text,
  "name" text,
  "department" integer NOT NULL,
  "priority" integer NOT NULL,
  "status" integer NOT NULL,
  "service" integer,
  "ticketkey" text(32) NOT NULL,
  "subject" text(191) NOT NULL,
  "message" text,
  "admin" integer,
  "date" text NOT NULL,
  "project_id" integer NOT NULL,
  "lastreply" text,
  "clientread" integer NOT NULL,
  "adminread" integer NOT NULL,
  "assigned" integer NOT NULL,
  "staff_id_replying" integer,
  "cc" text(191),
  PRIMARY KEY ("ticketid")
);

-- ----------------------------
-- Records of tbltickets
-- ----------------------------

-- ----------------------------
-- Table structure for tbltickets_pipe_log
-- ----------------------------
DROP TABLE IF EXISTS "tbltickets_pipe_log";
CREATE TABLE "tbltickets_pipe_log" (
  "id" integer NOT NULL,
  "date" text NOT NULL,
  "email_to" text(100) NOT NULL,
  "name" text(191) NOT NULL,
  "subject" text(191) NOT NULL,
  "message" text NOT NULL,
  "email" text(100) NOT NULL,
  "status" text(100) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltickets_pipe_log
-- ----------------------------

-- ----------------------------
-- Table structure for tbltickets_predefined_replies
-- ----------------------------
DROP TABLE IF EXISTS "tbltickets_predefined_replies";
CREATE TABLE "tbltickets_predefined_replies" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "message" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltickets_predefined_replies
-- ----------------------------

-- ----------------------------
-- Table structure for tbltickets_priorities
-- ----------------------------
DROP TABLE IF EXISTS "tbltickets_priorities";
CREATE TABLE "tbltickets_priorities" (
  "priorityid" integer NOT NULL,
  "name" text(50) NOT NULL,
  PRIMARY KEY ("priorityid")
);

-- ----------------------------
-- Records of tbltickets_priorities
-- ----------------------------
INSERT INTO "tbltickets_priorities" VALUES (1, 'Low');
INSERT INTO "tbltickets_priorities" VALUES (2, 'Medium');
INSERT INTO "tbltickets_priorities" VALUES (3, 'High');

-- ----------------------------
-- Table structure for tbltickets_status
-- ----------------------------
DROP TABLE IF EXISTS "tbltickets_status";
CREATE TABLE "tbltickets_status" (
  "ticketstatusid" integer NOT NULL,
  "name" text(50) NOT NULL,
  "isdefault" integer NOT NULL,
  "statuscolor" text(7),
  "statusorder" integer,
  PRIMARY KEY ("ticketstatusid")
);

-- ----------------------------
-- Records of tbltickets_status
-- ----------------------------
INSERT INTO "tbltickets_status" VALUES (1, 'Open', 1, '#ff2d42', 1);
INSERT INTO "tbltickets_status" VALUES (2, 'In progress', 1, '#22c55e', 2);
INSERT INTO "tbltickets_status" VALUES (3, 'Answered', 1, '#2563eb', 3);
INSERT INTO "tbltickets_status" VALUES (4, 'On Hold', 1, '#64748b', 4);
INSERT INTO "tbltickets_status" VALUES (5, 'Closed', 1, '#03a9f4', 5);

-- ----------------------------
-- Table structure for tbltodos
-- ----------------------------
DROP TABLE IF EXISTS "tbltodos";
CREATE TABLE "tbltodos" (
  "todoid" integer NOT NULL,
  "description" text NOT NULL,
  "staffid" integer NOT NULL,
  "dateadded" text NOT NULL,
  "finished" integer(1) NOT NULL,
  "datefinished" text,
  "item_order" integer,
  PRIMARY KEY ("todoid")
);

-- ----------------------------
-- Records of tbltodos
-- ----------------------------

-- ----------------------------
-- Table structure for tbltracked_mails
-- ----------------------------
DROP TABLE IF EXISTS "tbltracked_mails";
CREATE TABLE "tbltracked_mails" (
  "id" integer NOT NULL,
  "uid" text(32) NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(40) NOT NULL,
  "date" text NOT NULL,
  "email" text(100) NOT NULL,
  "opened" integer(1) NOT NULL,
  "date_opened" text,
  "subject" text,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tbltracked_mails
-- ----------------------------

-- ----------------------------
-- Table structure for tbltwocheckout_log
-- ----------------------------
DROP TABLE IF EXISTS "tbltwocheckout_log";
CREATE TABLE "tbltwocheckout_log" (
  "id" integer NOT NULL,
  "reference" text(64) NOT NULL,
  "invoice_id" integer NOT NULL,
  "amount" text(25) NOT NULL,
  "created_at" text NOT NULL,
  "attempt_reference" text(100),
  PRIMARY KEY ("id"),
  CONSTRAINT "tbltwocheckout_log_ibfk_1" FOREIGN KEY ("invoice_id") REFERENCES "tblinvoices" ("id") ON DELETE CASCADE ON UPDATE RESTRICT
);

-- ----------------------------
-- Records of tbltwocheckout_log
-- ----------------------------

-- ----------------------------
-- Table structure for tbluser_auto_login
-- ----------------------------
DROP TABLE IF EXISTS "tbluser_auto_login";
CREATE TABLE "tbluser_auto_login" (
  "key_id" text(32) NOT NULL,
  "user_id" integer NOT NULL,
  "user_agent" text(150) NOT NULL,
  "last_ip" text(40) NOT NULL,
  "last_login" text NOT NULL,
  "staff" integer NOT NULL
);

-- ----------------------------
-- Records of tbluser_auto_login
-- ----------------------------
INSERT INTO "tbluser_auto_login" VALUES ('988fbda842b1bb3c2662174e192489a6', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '::1', '2025-06-25 11:47:50', 1);

-- ----------------------------
-- Table structure for tbluser_meta
-- ----------------------------
DROP TABLE IF EXISTS "tbluser_meta";
CREATE TABLE "tbluser_meta" (
  "umeta_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  "client_id" integer NOT NULL,
  "contact_id" integer NOT NULL,
  "meta_key" text(191),
  "meta_value" text,
  PRIMARY KEY ("umeta_id")
);

-- ----------------------------
-- Records of tbluser_meta
-- ----------------------------

-- ----------------------------
-- Table structure for tblvault
-- ----------------------------
DROP TABLE IF EXISTS "tblvault";
CREATE TABLE "tblvault" (
  "id" integer NOT NULL,
  "customer_id" integer NOT NULL,
  "server_address" text(191) NOT NULL,
  "port" integer,
  "username" text(191) NOT NULL,
  "password" text NOT NULL,
  "description" text,
  "creator" integer NOT NULL,
  "creator_name" text(100),
  "visibility" integer(1) NOT NULL,
  "share_in_projects" integer(1) NOT NULL,
  "last_updated" text,
  "last_updated_from" text(100),
  "date_created" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblvault
-- ----------------------------

-- ----------------------------
-- Table structure for tblviews_tracking
-- ----------------------------
DROP TABLE IF EXISTS "tblviews_tracking";
CREATE TABLE "tblviews_tracking" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(40) NOT NULL,
  "date" text NOT NULL,
  "view_ip" text(40) NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblviews_tracking
-- ----------------------------

-- ----------------------------
-- Table structure for tblweb_to_lead
-- ----------------------------
DROP TABLE IF EXISTS "tblweb_to_lead";
CREATE TABLE "tblweb_to_lead" (
  "id" integer NOT NULL,
  "form_key" text(32) NOT NULL,
  "lead_source" integer NOT NULL,
  "lead_status" integer NOT NULL,
  "notify_lead_imported" integer NOT NULL,
  "notify_type" text(20),
  "notify_ids" text,
  "responsible" integer NOT NULL,
  "name" text(191) NOT NULL,
  "form_data" text,
  "recaptcha" integer NOT NULL,
  "submit_btn_name" text(40),
  "submit_btn_text_color" text(10),
  "submit_btn_bg_color" text(10),
  "success_submit_msg" text,
  "submit_action" integer,
  "lead_name_prefix" text(255),
  "submit_redirect_url" text,
  "language" text(40),
  "allow_duplicate" integer NOT NULL,
  "mark_public" integer NOT NULL,
  "track_duplicate_field" text(20),
  "track_duplicate_field_and" text(20),
  "create_task_on_duplicate" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);

-- ----------------------------
-- Records of tblweb_to_lead
-- ----------------------------

-- ----------------------------
-- Indexes structure for table tblactivity_log
-- ----------------------------
CREATE INDEX "staffid"
ON "tblactivity_log" (
  "staffid" ASC
);

-- ----------------------------
-- Indexes structure for table tblclients
-- ----------------------------
CREATE INDEX "active"
ON "tblclients" (
  "active" ASC
);
CREATE INDEX "company"
ON "tblclients" (
  "company" ASC
);
CREATE INDEX "country"
ON "tblclients" (
  "country" ASC
);
CREATE INDEX "leadid"
ON "tblclients" (
  "leadid" ASC
);

-- ----------------------------
-- Indexes structure for table tblconsents
-- ----------------------------
CREATE INDEX "contact_id"
ON "tblconsents" (
  "contact_id" ASC
);
CREATE INDEX "lead_id"
ON "tblconsents" (
  "lead_id" ASC
);
CREATE INDEX "purpose_id"
ON "tblconsents" (
  "purpose_id" ASC
);

-- ----------------------------
-- Indexes structure for table tblcontacts
-- ----------------------------
CREATE INDEX "email"
ON "tblcontacts" (
  "email" ASC
);
CREATE INDEX "firstname"
ON "tblcontacts" (
  "firstname" ASC
);
CREATE INDEX "is_primary"
ON "tblcontacts" (
  "is_primary" ASC
);
CREATE INDEX "lastname"
ON "tblcontacts" (
  "lastname" ASC
);
CREATE INDEX "userid"
ON "tblcontacts" (
  "userid" ASC
);

-- ----------------------------
-- Indexes structure for table tblcontracts
-- ----------------------------
CREATE INDEX "client"
ON "tblcontracts" (
  "client" ASC
);
CREATE INDEX "contract_type"
ON "tblcontracts" (
  "contract_type" ASC
);

-- ----------------------------
-- Indexes structure for table tblcreditnotes
-- ----------------------------
CREATE INDEX "clientid"
ON "tblcreditnotes" (
  "clientid" ASC
);
CREATE INDEX "currency"
ON "tblcreditnotes" (
  "currency" ASC
);
CREATE INDEX "formatted_number"
ON "tblcreditnotes" (
  "formatted_number" ASC
);
CREATE INDEX "project_id"
ON "tblcreditnotes" (
  "project_id" ASC
);

-- ----------------------------
-- Indexes structure for table tblcustomer_admins
-- ----------------------------
CREATE INDEX "customer_id"
ON "tblcustomer_admins" (
  "customer_id" ASC
);
CREATE INDEX "staff_id"
ON "tblcustomer_admins" (
  "staff_id" ASC
);

-- ----------------------------
-- Indexes structure for table tblcustomer_groups
-- ----------------------------
CREATE INDEX "groupid"
ON "tblcustomer_groups" (
  "groupid" ASC
);

-- ----------------------------
-- Indexes structure for table tblcustomers_groups
-- ----------------------------
CREATE INDEX "name"
ON "tblcustomers_groups" (
  "name" ASC
);

-- ----------------------------
-- Indexes structure for table tblcustomfieldsvalues
-- ----------------------------
CREATE INDEX "fieldid"
ON "tblcustomfieldsvalues" (
  "fieldid" ASC
);
CREATE INDEX "fieldto"
ON "tblcustomfieldsvalues" (
  "fieldto" ASC
);
CREATE INDEX "relid"
ON "tblcustomfieldsvalues" (
  "relid" ASC
);

-- ----------------------------
-- Indexes structure for table tbldismissed_announcements
-- ----------------------------
CREATE INDEX "announcementid"
ON "tbldismissed_announcements" (
  "announcementid" ASC
);
CREATE INDEX "staff"
ON "tbldismissed_announcements" (
  "staff" ASC
);

-- ----------------------------
-- Indexes structure for table tblestimates
-- ----------------------------
CREATE INDEX "sale_agent"
ON "tblestimates" (
  "sale_agent" ASC
);
CREATE INDEX "status"
ON "tblestimates" (
  "status" ASC
);

-- ----------------------------
-- Indexes structure for table tblexpenses
-- ----------------------------
CREATE INDEX "category"
ON "tblexpenses" (
  "category" ASC
);

-- ----------------------------
-- Indexes structure for table tblfiles
-- ----------------------------
CREATE INDEX "rel_id"
ON "tblfiles" (
  "rel_id" ASC
);
CREATE INDEX "rel_type"
ON "tblfiles" (
  "rel_type" ASC
);

-- ----------------------------
-- Indexes structure for table tblfilter_defaults
-- ----------------------------
CREATE INDEX "filter_id"
ON "tblfilter_defaults" (
  "filter_id" ASC
);

-- ----------------------------
-- Indexes structure for table tblinvoicepaymentrecords
-- ----------------------------
CREATE INDEX "invoiceid"
ON "tblinvoicepaymentrecords" (
  "invoiceid" ASC
);
CREATE INDEX "paymentmethod"
ON "tblinvoicepaymentrecords" (
  "paymentmethod" ASC
);

-- ----------------------------
-- Indexes structure for table tblinvoices
-- ----------------------------
CREATE INDEX "total"
ON "tblinvoices" (
  "total" ASC
);

-- ----------------------------
-- Indexes structure for table tblitem_tax
-- ----------------------------
CREATE INDEX "itemid"
ON "tblitem_tax" (
  "itemid" ASC
);

-- ----------------------------
-- Indexes structure for table tblitemable
-- ----------------------------
CREATE INDEX "qty"
ON "tblitemable" (
  "qty" ASC
);
CREATE INDEX "rate"
ON "tblitemable" (
  "rate" ASC
);

-- ----------------------------
-- Indexes structure for table tblitems
-- ----------------------------
CREATE INDEX "group_id"
ON "tblitems" (
  "group_id" ASC
);
CREATE INDEX "tax"
ON "tblitems" (
  "tax" ASC
);
CREATE INDEX "tax2"
ON "tblitems" (
  "tax2" ASC
);

-- ----------------------------
-- Indexes structure for table tblleads
-- ----------------------------
CREATE INDEX "assigned"
ON "tblleads" (
  "assigned" ASC
);
CREATE INDEX "dateadded"
ON "tblleads" (
  "dateadded" ASC
);
CREATE INDEX "from_form_id"
ON "tblleads" (
  "from_form_id" ASC
);
CREATE INDEX "lastcontact"
ON "tblleads" (
  "lastcontact" ASC
);
CREATE INDEX "leadorder"
ON "tblleads" (
  "leadorder" ASC
);
CREATE INDEX "source"
ON "tblleads" (
  "source" ASC
);

-- ----------------------------
-- Indexes structure for table tblsessions
-- ----------------------------
CREATE INDEX "ci_sessions_timestamp"
ON "tblsessions" (
  "timestamp" ASC
);

-- ----------------------------
-- Indexes structure for table tblsubscriptions
-- ----------------------------
CREATE INDEX "tax_id"
ON "tblsubscriptions" (
  "tax_id" ASC
);

-- ----------------------------
-- Indexes structure for table tbltaggables
-- ----------------------------
CREATE INDEX "tag_id"
ON "tbltaggables" (
  "tag_id" ASC
);

-- ----------------------------
-- Indexes structure for table tbltask_assigned
-- ----------------------------
CREATE INDEX "taskid"
ON "tbltask_assigned" (
  "taskid" ASC
);

-- ----------------------------
-- Indexes structure for table tbltask_comments
-- ----------------------------
CREATE INDEX "file_id"
ON "tbltask_comments" (
  "file_id" ASC
);

-- ----------------------------
-- Indexes structure for table tbltasks
-- ----------------------------
CREATE INDEX "kanban_order"
ON "tbltasks" (
  "kanban_order" ASC
);
CREATE INDEX "milestone"
ON "tbltasks" (
  "milestone" ASC
);

-- ----------------------------
-- Indexes structure for table tbltaskstimers
-- ----------------------------
CREATE INDEX "task_id"
ON "tbltaskstimers" (
  "task_id" ASC
);

-- ----------------------------
-- Indexes structure for table tbltickets
-- ----------------------------
CREATE INDEX "contactid"
ON "tbltickets" (
  "contactid" ASC
);
CREATE INDEX "department"
ON "tbltickets" (
  "department" ASC
);
CREATE INDEX "priority"
ON "tbltickets" (
  "priority" ASC
);
CREATE INDEX "service"
ON "tbltickets" (
  "service" ASC
);

-- ----------------------------
-- Indexes structure for table tbltwocheckout_log
-- ----------------------------
CREATE INDEX "invoice_id"
ON "tbltwocheckout_log" (
  "invoice_id" ASC
);

PRAGMA foreign_keys = true;
