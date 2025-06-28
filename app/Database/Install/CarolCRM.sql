PRAGMA foreign_keys = false;
DROP TABLE IF EXISTS "tblactivity_log";
CREATE TABLE "tblactivity_log" (
  "id" integer NOT NULL,
  "description" text NOT NULL,
  "date" text NOT NULL,
  "staffid" text(100),
  PRIMARY KEY ("id")
);
INSERT INTO "tblactivity_log" VALUES (1, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: ::1]', '2025-06-25 11:47:50', 'LUIZ MARIN');
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
DROP TABLE IF EXISTS "tblconsent_purposes";
CREATE TABLE "tblconsent_purposes" (
  "id" integer NOT NULL,
  "name" text(100) NOT NULL,
  "description" text,
  "date_created" text NOT NULL,
  "last_updated" text,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblcontact_permissions";
CREATE TABLE "tblcontact_permissions" (
  "id" integer NOT NULL,
  "permission_id" integer NOT NULL,
  "userid" integer NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblcontract_comments";
CREATE TABLE "tblcontract_comments" (
  "id" integer NOT NULL,
  "content" text,
  "contract_id" integer NOT NULL,
  "staffid" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblcontracts_types";
CREATE TABLE "tblcontracts_types" (
  "id" integer NOT NULL,
  "name" text NOT NULL,
  PRIMARY KEY ("id")
);
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
INSERT INTO "tblcountries" VALUES (1, 'AF', 'Afeganistão', 'República Islâmica do Afeganistão', 'AFG', '004', 'yes', '93', '.af');
INSERT INTO "tblcountries" VALUES (2, 'AX', 'Ilhas Aland', 'Ilhas Aland', 'ALA', '248', 'no', '358', '.ax');
INSERT INTO "tblcountries" VALUES (3, 'AL', 'Albânia', 'República da Albânia', 'ALB', '008', 'yes', '355', '.al');
INSERT INTO "tblcountries" VALUES (4, 'DZ', 'Argélia', 'República Democrática Popular da Argélia', 'DZA', '012', 'yes', '213', '.dz');
INSERT INTO "tblcountries" VALUES (5, 'AS', 'Samoa Americana', 'Samoa Americana', 'ASM', '016', 'no', '1+684', '.as');
INSERT INTO "tblcountries" VALUES (6, 'AD', 'Andorra', 'Principado de Andorra', 'AND', '020', 'yes', '376', '.ad');
INSERT INTO "tblcountries" VALUES (7, 'AO', 'Angola', 'República de Angola', 'AGO', '024', 'yes', '244', '.ao');
INSERT INTO "tblcountries" VALUES (8, 'AI', 'Anguila', 'Anguila', 'AIA', '660', 'no', '1+264', '.ai');
INSERT INTO "tblcountries" VALUES (9, 'AQ', 'Antártida', 'Antártida', 'ATA', '010', 'no', '672', '.aq');
INSERT INTO "tblcountries" VALUES (10, 'AG', 'Antígua e Barbuda', 'Antígua e Barbuda', 'ATG', '028', 'yes', '1+268', '.ag');
INSERT INTO "tblcountries" VALUES (11, 'AR', 'Argentina', 'República Argentina', 'ARG', '032', 'yes', '54', '.ar');
INSERT INTO "tblcountries" VALUES (12, 'AM', 'Armênia', 'República da Armênia', 'ARM', '051', 'yes', '374', '.am');
INSERT INTO "tblcountries" VALUES (13, 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw');
INSERT INTO "tblcountries" VALUES (14, 'AU', 'Austrália', 'Comunidade da Austrália', 'AUS', '036', 'yes', '61', '.au');
INSERT INTO "tblcountries" VALUES (15, 'AT', 'Áustria', 'República da Áustria', 'AUT', '040', 'yes', '43', '.at');
INSERT INTO "tblcountries" VALUES (16, 'AZ', 'Azerbaijão', 'República do Azerbaijão', 'AZE', '031', 'yes', '994', '.az');
INSERT INTO "tblcountries" VALUES (17, 'BS', 'Bahamas', 'Comunidade das Bahamas', 'BHS', '044', 'yes', '1+242', '.bs');
INSERT INTO "tblcountries" VALUES (18, 'BH', 'Bahrein', 'Reino do Bahrein', 'BHR', '048', 'yes', '973', '.bh');
INSERT INTO "tblcountries" VALUES (19, 'BD', 'Bangladesh', 'República Popular de Bangladesh', 'BGD', '050', 'yes', '880', '.bd');
INSERT INTO "tblcountries" VALUES (20, 'BB', 'Barbados', 'Barbados', 'BRB', '052', 'yes', '1+246', '.bb');
INSERT INTO "tblcountries" VALUES (21, 'BY', 'Belarus', 'República de Belarus', 'BLR', '112', 'yes', '375', '.by');
INSERT INTO "tblcountries" VALUES (22, 'BE', 'Bélgica', 'Reino da Bélgica', 'BEL', '056', 'yes', '32', '.be');
INSERT INTO "tblcountries" VALUES (23, 'BZ', 'Belize', 'Belize', 'BLZ', '084', 'yes', '501', '.bz');
INSERT INTO "tblcountries" VALUES (24, 'BJ', 'Benin', 'República do Benin', 'BEN', '204', 'yes', '229', '.bj');
INSERT INTO "tblcountries" VALUES (25, 'BM', 'Bermudas', 'Ilhas Bermudas', 'BMU', '060', 'no', '1+441', '.bm');
INSERT INTO "tblcountries" VALUES (26, 'BT', 'Butão', 'Reino do Butão', 'BTN', '064', 'yes', '975', '.bt');
INSERT INTO "tblcountries" VALUES (27, 'BO', 'Bolívia', 'Estado Plurinacional da Bolívia', 'BOL', '068', 'yes', '591', '.bo');
INSERT INTO "tblcountries" VALUES (28, 'BQ', 'Bonaire, Santo Eustáquio e Saba', 'Bonaire, Santo Eustáquio e Saba', 'BES', '535', 'no', '599', '.bq');
INSERT INTO "tblcountries" VALUES (29, 'BA', 'Bósnia e Herzegovina', 'Bósnia e Herzegovina', 'BIH', '070', 'yes', '387', '.ba');
INSERT INTO "tblcountries" VALUES (30, 'BW', 'Botsuana', 'República de Botsuana', 'BWA', '072', 'yes', '267', '.bw');
INSERT INTO "tblcountries" VALUES (31, 'BV', 'Ilha Bouvet', 'Ilha Bouvet', 'BVT', '074', 'no', 'NONE', '.bv');
INSERT INTO "tblcountries" VALUES (32, 'BR', 'Brasil', 'República Federativa do Brasil', 'BRA', '076', 'yes', '55', '.br');
INSERT INTO "tblcountries" VALUES (33, 'IO', 'Território Britânico do Oceano Índico', 'Território Britânico do Oceano Índico', 'IOT', '086', 'no', '246', '.io');
INSERT INTO "tblcountries" VALUES (34, 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '096', 'yes', '673', '.bn');
INSERT INTO "tblcountries" VALUES (35, 'BG', 'Bulgária', 'República da Bulgária', 'BGR', '100', 'yes', '359', '.bg');
INSERT INTO "tblcountries" VALUES (36, 'BF', 'Burquina Faso', 'Burquina Faso', 'BFA', '854', 'yes', '226', '.bf');
INSERT INTO "tblcountries" VALUES (37, 'BI', 'Burundi', 'República do Burundi', 'BDI', '108', 'yes', '257', '.bi');
INSERT INTO "tblcountries" VALUES (38, 'KH', 'Camboja', 'Reino do Camboja', 'KHM', '116', 'yes', '855', '.kh');
INSERT INTO "tblcountries" VALUES (39, 'CM', 'Camarões', 'República dos Camarões', 'CMR', '120', 'yes', '237', '.cm');
INSERT INTO "tblcountries" VALUES (40, 'CA', 'Canadá', 'Canadá', 'CAN', '124', 'yes', '1', '.ca');
INSERT INTO "tblcountries" VALUES (41, 'CV', 'Cabo Verde', 'República de Cabo Verde', 'CPV', '132', 'yes', '238', '.cv');
INSERT INTO "tblcountries" VALUES (42, 'KY', 'Ilhas Cayman', 'As Ilhas Cayman', 'CYM', '136', 'no', '1+345', '.ky');
INSERT INTO "tblcountries" VALUES (43, 'CF', 'República Centro-Africana', 'República Centro-Africana', 'CAF', '140', 'yes', '236', '.cf');
INSERT INTO "tblcountries" VALUES (44, 'TD', 'Chade', 'República do Chade', 'TCD', '148', 'yes', '235', '.td');
INSERT INTO "tblcountries" VALUES (45, 'CL', 'Chile', 'República do Chile', 'CHL', '152', 'yes', '56', '.cl');
INSERT INTO "tblcountries" VALUES (46, 'CN', 'China', 'República Popular da China', 'CHN', '156', 'yes', '86', '.cn');
INSERT INTO "tblcountries" VALUES (47, 'CX', 'Ilha Christmas', 'Ilha Christmas', 'CXR', '162', 'no', '61', '.cx');
INSERT INTO "tblcountries" VALUES (48, 'CC', 'Ilhas Cocos (Keeling)', 'Ilhas Cocos (Keeling)', 'CCK', '166', 'no', '61', '.cc');
INSERT INTO "tblcountries" VALUES (49, 'CO', 'Colômbia', 'República da Colômbia', 'COL', '170', 'yes', '57', '.co');
INSERT INTO "tblcountries" VALUES (50, 'KM', 'Comores', 'União das Comores', 'COM', '174', 'yes', '269', '.km');
INSERT INTO "tblcountries" VALUES (51, 'CG', 'Congo', 'República do Congo', 'COG', '178', 'yes', '242', '.cg');
INSERT INTO "tblcountries" VALUES (52, 'CK', 'Ilhas Cook', 'Ilhas Cook', 'COK', '184', 'some', '682', '.ck');
INSERT INTO "tblcountries" VALUES (53, 'CR', 'Costa Rica', 'República da Costa Rica', 'CRI', '188', 'yes', '506', '.cr');
INSERT INTO "tblcountries" VALUES (54, 'CI', 'Costa do Marfim', 'República da Costa do Marfim', 'CIV', '384', 'yes', '225', '.ci');
INSERT INTO "tblcountries" VALUES (55, 'HR', 'Croácia', 'República da Croácia', 'HRV', '191', 'yes', '385', '.hr');
INSERT INTO "tblcountries" VALUES (56, 'CU', 'Cuba', 'República de Cuba', 'CUB', '192', 'yes', '53', '.cu');
INSERT INTO "tblcountries" VALUES (57, 'CW', 'Curaçao', 'Curaçao', 'CUW', '531', 'no', '599', '.cw');
INSERT INTO "tblcountries" VALUES (58, 'CY', 'Chipre', 'República de Chipre', 'CYP', '196', 'yes', '357', '.cy');
INSERT INTO "tblcountries" VALUES (59, 'CZ', 'República Tcheca', 'República Tcheca', 'CZE', '203', 'yes', '420', '.cz');
INSERT INTO "tblcountries" VALUES (60, 'CD', 'República Democrática do Congo', 'República Democrática do Congo', 'COD', '180', 'yes', '243', '.cd');
INSERT INTO "tblcountries" VALUES (61, 'DK', 'Dinamarca', 'Reino da Dinamarca', 'DNK', '208', 'yes', '45', '.dk');
INSERT INTO "tblcountries" VALUES (62, 'DJ', 'Djibuti', 'República do Djibuti', 'DJI', '262', 'yes', '253', '.dj');
INSERT INTO "tblcountries" VALUES (63, 'DM', 'Dominica', 'Comunidade da Dominica', 'DMA', '212', 'yes', '1+767', '.dm');
INSERT INTO "tblcountries" VALUES (64, 'DO', 'República Dominicana', 'República Dominicana', 'DOM', '214', 'yes', '1+809, 8', '.do');
INSERT INTO "tblcountries" VALUES (65, 'EC', 'Equador', 'República do Equador', 'ECU', '218', 'yes', '593', '.ec');
INSERT INTO "tblcountries" VALUES (66, 'EG', 'Egito', 'República Árabe do Egito', 'EGY', '818', 'yes', '20', '.eg');
INSERT INTO "tblcountries" VALUES (67, 'SV', 'El Salvador', 'República de El Salvador', 'SLV', '222', 'yes', '503', '.sv');
INSERT INTO "tblcountries" VALUES (68, 'GQ', 'Guiné Equatorial', 'República da Guiné Equatorial', 'GNQ', '226', 'yes', '240', '.gq');
INSERT INTO "tblcountries" VALUES (69, 'ER', 'Eritreia', 'Estado da Eritreia', 'ERI', '232', 'yes', '291', '.er');
INSERT INTO "tblcountries" VALUES (70, 'EE', 'Estônia', 'República da Estônia', 'EST', '233', 'yes', '372', '.ee');
INSERT INTO "tblcountries" VALUES (71, 'ET', 'Etiópia', 'República Democrática Federal da Etiópia', 'ETH', '231', 'yes', '251', '.et');
INSERT INTO "tblcountries" VALUES (72, 'FK', 'Ilhas Malvinas (Falkland)', 'As Ilhas Malvinas (Falkland)', 'FLK', '238', 'no', '500', '.fk');
INSERT INTO "tblcountries" VALUES (73, 'FO', 'Ilhas Faroé', 'As Ilhas Faroé', 'FRO', '234', 'no', '298', '.fo');
INSERT INTO "tblcountries" VALUES (74, 'FJ', 'Fiji', 'República de Fiji', 'FJI', '242', 'yes', '679', '.fj');
INSERT INTO "tblcountries" VALUES (75, 'FI', 'Finlândia', 'República da Finlândia', 'FIN', '246', 'yes', '358', '.fi');
INSERT INTO "tblcountries" VALUES (76, 'FR', 'França', 'República Francesa', 'FRA', '250', 'yes', '33', '.fr');
INSERT INTO "tblcountries" VALUES (77, 'GF', 'Guiana Francesa', 'Guiana Francesa', 'GUF', '254', 'no', '594', '.gf');
INSERT INTO "tblcountries" VALUES (78, 'PF', 'Polinésia Francesa', 'Polinésia Francesa', 'PYF', '258', 'no', '689', '.pf');
INSERT INTO "tblcountries" VALUES (79, 'TF', 'Territórios Franceses do Sul', 'Territórios Franceses do Sul', 'ATF', '260', 'no', NULL, '.tf');
INSERT INTO "tblcountries" VALUES (80, 'GA', 'Gabão', 'República Gabonesa', 'GAB', '266', 'yes', '241', '.ga');
INSERT INTO "tblcountries" VALUES (81, 'GM', 'Gâmbia', 'República da Gâmbia', 'GMB', '270', 'yes', '220', '.gm');
INSERT INTO "tblcountries" VALUES (82, 'GE', 'Geórgia', 'Geórgia', 'GEO', '268', 'yes', '995', '.ge');
INSERT INTO "tblcountries" VALUES (83, 'DE', 'Alemanha', 'República Federal da Alemanha', 'DEU', '276', 'yes', '49', '.de');
INSERT INTO "tblcountries" VALUES (84, 'GH', 'Gana', 'República de Gana', 'GHA', '288', 'yes', '233', '.gh');
INSERT INTO "tblcountries" VALUES (85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi');
INSERT INTO "tblcountries" VALUES (86, 'GR', 'Grécia', 'República Helênica', 'GRC', '300', 'yes', '30', '.gr');
INSERT INTO "tblcountries" VALUES (87, 'GL', 'Groenlândia', 'Groenlândia', 'GRL', '304', 'no', '299', '.gl');
INSERT INTO "tblcountries" VALUES (88, 'GD', 'Granada', 'Granada', 'GRD', '308', 'yes', '1+473', '.gd');
INSERT INTO "tblcountries" VALUES (89, 'GP', 'Guadalupe', 'Guadalupe', 'GLP', '312', 'no', '590', '.gp');
INSERT INTO "tblcountries" VALUES (90, 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu');
INSERT INTO "tblcountries" VALUES (91, 'GT', 'Guatemala', 'República da Guatemala', 'GTM', '320', 'yes', '502', '.gt');
INSERT INTO "tblcountries" VALUES (92, 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg');
INSERT INTO "tblcountries" VALUES (93, 'GN', 'Guiné', 'República da Guiné', 'GIN', '324', 'yes', '224', '.gn');
INSERT INTO "tblcountries" VALUES (94, 'GW', 'Guiné-Bissau', 'República da Guiné-Bissau', 'GNB', '624', 'yes', '245', '.gw');
INSERT INTO "tblcountries" VALUES (95, 'GY', 'Guiana', 'República Cooperativista da Guiana', 'GUY', '328', 'yes', '592', '.gy');
INSERT INTO "tblcountries" VALUES (96, 'HT', 'Haiti', 'República do Haiti', 'HTI', '332', 'yes', '509', '.ht');
INSERT INTO "tblcountries" VALUES (97, 'HM', 'Ilha Heard e Ilhas McDonald', 'Ilha Heard e Ilhas McDonald', 'HMD', '334', 'no', 'NONE', '.hm');
INSERT INTO "tblcountries" VALUES (98, 'HN', 'Honduras', 'República de Honduras', 'HND', '340', 'yes', '504', '.hn');
INSERT INTO "tblcountries" VALUES (99, 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk');
INSERT INTO "tblcountries" VALUES (100, 'HU', 'Hungria', 'Hungria', 'HUN', '348', 'yes', '36', '.hu');
INSERT INTO "tblcountries" VALUES (101, 'IS', 'Islândia', 'República da Islândia', 'ISL', '352', 'yes', '354', '.is');
INSERT INTO "tblcountries" VALUES (102, 'IN', 'Índia', 'República da Índia', 'IND', '356', 'yes', '91', '.in');
INSERT INTO "tblcountries" VALUES (103, 'ID', 'Indonésia', 'República da Indonésia', 'IDN', '360', 'yes', '62', '.id');
INSERT INTO "tblcountries" VALUES (104, 'IR', 'Irã', 'República Islâmica do Irã', 'IRN', '364', 'yes', '98', '.ir');
INSERT INTO "tblcountries" VALUES (105, 'IQ', 'Iraque', 'República do Iraque', 'IRQ', '368', 'yes', '964', '.iq');
INSERT INTO "tblcountries" VALUES (106, 'IE', 'Irlanda', 'Irlanda', 'IRL', '372', 'yes', '353', '.ie');
INSERT INTO "tblcountries" VALUES (107, 'IM', 'Ilha de Man', 'Ilha de Man', 'IMN', '833', 'no', '44', '.im');
INSERT INTO "tblcountries" VALUES (108, 'IL', 'Israel', 'Estado de Israel', 'ISR', '376', 'yes', '972', '.il');
INSERT INTO "tblcountries" VALUES (109, 'IT', 'Itália', 'República Italiana', 'ITA', '380', 'yes', '39', '.jm');
INSERT INTO "tblcountries" VALUES (110, 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm');
INSERT INTO "tblcountries" VALUES (111, 'JP', 'Japão', 'Japão', 'JPN', '392', 'yes', '81', '.jp');
INSERT INTO "tblcountries" VALUES (112, 'JE', 'Jersey', 'Bailiado de Jersey', 'JEY', '832', 'no', '44', '.je');
INSERT INTO "tblcountries" VALUES (113, 'JO', 'Jordânia', 'Reino Hachemita da Jordânia', 'JOR', '400', 'yes', '962', '.jo');
INSERT INTO "tblcountries" VALUES (114, 'KZ', 'Cazaquistão', 'República do Cazaquistão', 'KAZ', '398', 'yes', '7', '.kz');
INSERT INTO "tblcountries" VALUES (115, 'KE', 'Quênia', 'República do Quênia', 'KEN', '404', 'yes', '254', '.ke');
INSERT INTO "tblcountries" VALUES (116, 'KI', 'Kiribati', 'República de Kiribati', 'KIR', '296', 'yes', '686', '.ki');
INSERT INTO "tblcountries" VALUES (117, 'XK', 'Kosovo', 'República do Kosovo', '---', '---', 'some', '381', '');
INSERT INTO "tblcountries" VALUES (118, 'KW', 'Kuwait', 'Estado do Kuwait', 'KWT', '414', 'yes', '965', '.kw');
INSERT INTO "tblcountries" VALUES (119, 'KG', 'Quirguistão', 'República Quirguiz', 'KGZ', '417', 'yes', '996', '.kg');
INSERT INTO "tblcountries" VALUES (120, 'LA', 'Laos', 'República Democrática Popular do Laos', 'LAO', '418', 'yes', '856', '.la');
INSERT INTO "tblcountries" VALUES (121, 'LV', 'Letônia', 'República da Letônia', 'LVA', '428', 'yes', '371', '.lv');
INSERT INTO "tblcountries" VALUES (122, 'LB', 'Líbano', 'República do Líbano', 'LBN', '422', 'yes', '961', '.lb');
INSERT INTO "tblcountries" VALUES (123, 'LS', 'Lesoto', 'Reino do Lesoto', 'LSO', '426', 'yes', '266', '.ls');
INSERT INTO "tblcountries" VALUES (124, 'LR', 'Libéria', 'República da Libéria', 'LBR', '430', 'yes', '231', '.lr');
INSERT INTO "tblcountries" VALUES (125, 'LY', 'Líbia', 'Líbia', 'LBY', '434', 'yes', '218', '.ly');
INSERT INTO "tblcountries" VALUES (126, 'LI', 'Liechtenstein', 'Principado de Liechtenstein', 'LIE', '438', 'yes', '423', '.li');
INSERT INTO "tblcountries" VALUES (127, 'LT', 'Lituânia', 'República da Lituânia', 'LTU', '440', 'yes', '370', '.lt');
INSERT INTO "tblcountries" VALUES (128, 'LU', 'Luxemburgo', 'Grão-Ducado de Luxemburgo', 'LUX', '442', 'yes', '352', '.lu');
INSERT INTO "tblcountries" VALUES (129, 'MO', 'Macau', 'Região Administrativa Especial de Macau', 'MAC', '446', 'no', '853', '.mo');
INSERT INTO "tblcountries" VALUES (130, 'MK', 'Macedônia do Norte', 'República da Macedônia do Norte', 'MKD', '807', 'yes', '389', '.mk');
INSERT INTO "tblcountries" VALUES (131, 'MG', 'Madagáscar', 'República de Madagáscar', 'MDG', '450', 'yes', '261', '.mg');
INSERT INTO "tblcountries" VALUES (132, 'MW', 'Malawi', 'República do Malawi', 'MWI', '454', 'yes', '265', '.mw');
INSERT INTO "tblcountries" VALUES (133, 'MY', 'Malásia', 'Malásia', 'MYS', '458', 'yes', '60', '.my');
INSERT INTO "tblcountries" VALUES (134, 'MV', 'Maldivas', 'República das Maldivas', 'MDV', '462', 'yes', '960', '.mv');
INSERT INTO "tblcountries" VALUES (135, 'ML', 'Mali', 'República do Mali', 'MLI', '466', 'yes', '223', '.ml');
INSERT INTO "tblcountries" VALUES (136, 'MT', 'Malta', 'República de Malta', 'MLT', '470', 'yes', '356', '.mt');
INSERT INTO "tblcountries" VALUES (137, 'MH', 'Ilhas Marshall', 'República das Ilhas Marshall', 'MHL', '584', 'yes', '692', '.mh');
INSERT INTO "tblcountries" VALUES (138, 'MQ', 'Martinica', 'Martinica', 'MTQ', '474', 'no', '596', '.mq');
INSERT INTO "tblcountries" VALUES (139, 'MR', 'Mauritânia', 'República Islâmica da Mauritânia', 'MRT', '478', 'yes', '222', '.mr');
INSERT INTO "tblcountries" VALUES (140, 'MU', 'Maurício', 'República de Maurício', 'MUS', '480', 'yes', '230', '.mu');
INSERT INTO "tblcountries" VALUES (141, 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt');
INSERT INTO "tblcountries" VALUES (142, 'MX', 'México', 'Estados Unidos Mexicanos', 'MEX', '484', 'yes', '52', '.mx');
INSERT INTO "tblcountries" VALUES (143, 'FM', 'Micronésia', 'Estados Federados da Micronésia', 'FSM', '583', 'yes', '691', '.fm');
INSERT INTO "tblcountries" VALUES (144, 'MD', 'Moldávia', 'República da Moldávia', 'MDA', '498', 'yes', '373', '.md');
INSERT INTO "tblcountries" VALUES (145, 'MC', 'Mônaco', 'Principado de Mônaco', 'MCO', '492', 'yes', '377', '.mc');
INSERT INTO "tblcountries" VALUES (146, 'MN', 'Mongólia', 'Mongólia', 'MNG', '496', 'yes', '976', '.mn');
INSERT INTO "tblcountries" VALUES (147, 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me');
INSERT INTO "tblcountries" VALUES (148, 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms');
INSERT INTO "tblcountries" VALUES (149, 'MA', 'Marrocos', 'Reino de Marrocos', 'MAR', '504', 'yes', '212', '.ma');
INSERT INTO "tblcountries" VALUES (150, 'MZ', 'Moçambique', 'República de Moçambique', 'MOZ', '508', 'yes', '258', '.mz');
INSERT INTO "tblcountries" VALUES (151, 'MM', 'Mianmar (Birmânia)', 'República da União de Mianmar', 'MMR', '104', 'yes', '95', '.mm');
INSERT INTO "tblcountries" VALUES (152, 'NA', 'Namíbia', 'República da Namíbia', 'NAM', '516', 'yes', '264', '.na');
INSERT INTO "tblcountries" VALUES (153, 'NR', 'Nauru', 'República de Nauru', 'NRU', '520', 'yes', '674', '.nr');
INSERT INTO "tblcountries" VALUES (154, 'NP', 'Nepal', 'República Democrática Federal do Nepal', 'NPL', '524', 'yes', '977', '.np');
INSERT INTO "tblcountries" VALUES (155, 'NL', 'Países Baixos', 'Reino dos Países Baixos', 'NLD', '528', 'yes', '31', '.nl');
INSERT INTO "tblcountries" VALUES (156, 'NC', 'Nova Caledônia', 'Nova Caledônia', 'NCL', '540', 'no', '687', '.nc');
INSERT INTO "tblcountries" VALUES (157, 'NZ', 'Nova Zelândia', 'Nova Zelândia', 'NZL', '554', 'yes', '64', '.nz');
INSERT INTO "tblcountries" VALUES (158, 'NI', 'Nicarágua', 'República da Nicarágua', 'NIC', '558', 'yes', '505', '.ni');
INSERT INTO "tblcountries" VALUES (159, 'NE', 'Níger', 'República do Níger', 'NER', '562', 'yes', '227', '.ne');
INSERT INTO "tblcountries" VALUES (160, 'NG', 'Nigéria', 'República Federal da Nigéria', 'NGA', '566', 'yes', '234', '.ng');
INSERT INTO "tblcountries" VALUES (161, 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu');
INSERT INTO "tblcountries" VALUES (162, 'NF', 'Ilha Norfolk', 'Ilha Norfolk', 'NFK', '574', 'no', '672', '.nf');
INSERT INTO "tblcountries" VALUES (163, 'KP', 'Coreia do Norte', 'República Popular Democrática da Coreia', 'PRK', '408', 'yes', '850', '.kp');
INSERT INTO "tblcountries" VALUES (164, 'MP', 'Ilhas Marianas do Norte', 'Ilhas Marianas do Norte', 'MNP', '580', 'no', '1+670', '.mp');
INSERT INTO "tblcountries" VALUES (165, 'NO', 'Noruega', 'Reino da Noruega', 'NOR', '578', 'yes', '47', '.no');
INSERT INTO "tblcountries" VALUES (166, 'OM', 'Omã', 'Sultanato de Omã', 'OMN', '512', 'yes', '968', '.om');
INSERT INTO "tblcountries" VALUES (167, 'PK', 'Paquistão', 'República Islâmica do Paquistão', 'PAK', '586', 'yes', '92', '.pk');
INSERT INTO "tblcountries" VALUES (168, 'PW', 'Palau', 'República de Palau', 'PLW', '585', 'yes', '680', '.pw');
INSERT INTO "tblcountries" VALUES (169, 'PS', 'Palestina', 'Estado da Palestina (ou Território Palestino Ocupado)', 'PSE', '275', 'some', '970', '.ps');
INSERT INTO "tblcountries" VALUES (170, 'PA', 'Panamá', 'República do Panamá', 'PAN', '591', 'yes', '507', '.pa');
INSERT INTO "tblcountries" VALUES (171, 'PG', 'Papua-Nova Guiné', 'Estado Independente de Papua-Nova Guiné', 'PNG', '598', 'yes', '675', '.pg');
INSERT INTO "tblcountries" VALUES (172, 'PY', 'Paraguai', 'República do Paraguai', 'PRY', '600', 'yes', '595', '.py');
INSERT INTO "tblcountries" VALUES (173, 'PE', 'Peru', 'República do Peru', 'PER', '604', 'yes', '51', '.pe');
INSERT INTO "tblcountries" VALUES (174, 'PH', 'Filipinas', 'República das Filipinas', 'PHL', '608', 'yes', '63', '.ph');
INSERT INTO "tblcountries" VALUES (175, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn');
INSERT INTO "tblcountries" VALUES (176, 'PL', 'Polônia', 'República da Polônia', 'POL', '616', 'yes', '48', '.pl');
INSERT INTO "tblcountries" VALUES (177, 'PT', 'Portugal', 'República Portuguesa', 'PRT', '620', 'yes', '351', '.pt');
INSERT INTO "tblcountries" VALUES (178, 'PR', 'Porto Rico', 'Comunidade de Porto Rico', 'PRI', '630', 'no', '1+939', '.pr');
INSERT INTO "tblcountries" VALUES (179, 'QA', 'Catar', 'Estado do Catar', 'QAT', '634', 'yes', '974', '.qa');
INSERT INTO "tblcountries" VALUES (180, 'RE', 'Reunião', 'Reunião', 'REU', '638', 'no', '262', '.re');
INSERT INTO "tblcountries" VALUES (181, 'RO', 'Romênia', 'Romênia', 'ROU', '642', 'yes', '40', '.ro');
INSERT INTO "tblcountries" VALUES (182, 'RU', 'Rússia', 'Federação Russa', 'RUS', '643', 'yes', '7', '.ru');
INSERT INTO "tblcountries" VALUES (183, 'RW', 'Ruanda', 'República de Ruanda', 'RWA', '646', 'yes', '250', '.rw');
INSERT INTO "tblcountries" VALUES (184, 'BL', 'São Bartolomeu', 'São Bartolomeu', 'BLM', '652', 'no', '590', '.bl');
INSERT INTO "tblcountries" VALUES (185, 'SH', 'Santa Helena', 'Santa Helena, Ascensão e Tristão da Cunha', 'SHN', '654', 'no', '290', '.sh');
INSERT INTO "tblcountries" VALUES (186, 'KN', 'São Cristóvão e Nevis', 'Federação de São Cristóvão e Nevis', 'KNA', '659', 'yes', '1+869', '.kn');
INSERT INTO "tblcountries" VALUES (187, 'LC', 'Santa Lúcia', 'Santa Lúcia', 'LCA', '662', 'yes', '1+758', '.lc');
INSERT INTO "tblcountries" VALUES (188, 'MF', 'São Martinho (lado francês)', 'São Martinho', 'MAF', '663', 'no', '590', '.mf');
INSERT INTO "tblcountries" VALUES (189, 'PM', 'São Pedro e Miquelão', 'São Pedro e Miquelão', 'SPM', '666', 'no', '508', '.pm');
INSERT INTO "tblcountries" VALUES (190, 'VC', 'São Vicente e Granadinas', 'São Vicente e Granadinas', 'VCT', '670', 'yes', '1+784', '.vc');
INSERT INTO "tblcountries" VALUES (191, 'WS', 'Samoa', 'Estado Independente de Samoa', 'WSM', '882', 'yes', '685', '.ws');
INSERT INTO "tblcountries" VALUES (192, 'SM', 'San Marino', 'República de San Marino', 'SMR', '674', 'yes', '378', '.sm');
INSERT INTO "tblcountries" VALUES (193, 'ST', 'São Tomé e Príncipe', 'República Democrática de São Tomé e Príncipe', 'STP', '678', 'yes', '239', '.st');
INSERT INTO "tblcountries" VALUES (194, 'SA', 'Arábia Saudita', 'Reino da Arábia Saudita', 'SAU', '682', 'yes', '966', '.sa');
INSERT INTO "tblcountries" VALUES (195, 'SN', 'Senegal', 'República do Senegal', 'SEN', '686', 'yes', '221', '.sn');
INSERT INTO "tblcountries" VALUES (196, 'RS', 'Sérvia', 'República da Sérvia', 'SRB', '688', 'yes', '381', '.rs');
INSERT INTO "tblcountries" VALUES (197, 'SC', 'Seicheles', 'República das Seicheles', 'SYC', '690', 'yes', '248', '.sc');
INSERT INTO "tblcountries" VALUES (198, 'SL', 'Serra Leoa', 'República da Serra Leoa', 'SLE', '694', 'yes', '232', '.sl');
INSERT INTO "tblcountries" VALUES (199, 'SG', 'Singapura', 'República de Singapura', 'SGP', '702', 'yes', '65', '.sg');
INSERT INTO "tblcountries" VALUES (200, 'SX', 'Sint Maarten (lado holandês)', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx');
INSERT INTO "tblcountries" VALUES (201, 'SK', 'Eslováquia', 'República Eslovaca', 'SVK', '703', 'yes', '421', '.sk');
INSERT INTO "tblcountries" VALUES (202, 'SI', 'Eslovênia', 'República da Eslovênia', 'SVN', '705', 'yes', '386', '.si');
INSERT INTO "tblcountries" VALUES (203, 'SB', 'Ilhas Salomão', 'Ilhas Salomão', 'SLB', '090', 'yes', '677', '.sb');
INSERT INTO "tblcountries" VALUES (204, 'SO', 'Somália', 'República Somali', 'SOM', '706', 'yes', '252', '.so');
INSERT INTO "tblcountries" VALUES (205, 'ZA', 'África do Sul', 'República da África do Sul', 'ZAF', '710', 'yes', '27', '.za');
INSERT INTO "tblcountries" VALUES (206, 'GS', 'Ilhas Geórgia do Sul e Sandwich do Sul', 'Ilhas Geórgia do Sul e Sandwich do Sul', 'SGS', '239', 'no', '500', '.gs');
INSERT INTO "tblcountries" VALUES (207, 'KR', 'Coreia do Sul', 'República da Coreia', 'KOR', '410', 'yes', '82', '.kr');
INSERT INTO "tblcountries" VALUES (208, 'SS', 'Sudão do Sul', 'República do Sudão do Sul', 'SSD', '728', 'yes', '211', '.ss');
INSERT INTO "tblcountries" VALUES (209, 'ES', 'Espanha', 'Reino da Espanha', 'ESP', '724', 'yes', '34', '.es');
INSERT INTO "tblcountries" VALUES (210, 'LK', 'Sri Lanka', 'República Democrática Socialista do Sri Lanka', 'LKA', '144', 'yes', '94', '.lk');
INSERT INTO "tblcountries" VALUES (211, 'SD', 'Sudão', 'República do Sudão', 'SDN', '729', 'yes', '249', '.sd');
INSERT INTO "tblcountries" VALUES (212, 'SR', 'Suriname', 'República do Suriname', 'SUR', '740', 'yes', '597', '.sr');
INSERT INTO "tblcountries" VALUES (213, 'SJ', 'Svalbard e Jan Mayen', 'Svalbard e Jan Mayen', 'SJM', '744', 'no', '47', '.sj');
INSERT INTO "tblcountries" VALUES (214, 'SZ', 'Suazilândia', 'Reino da Suazilândia', 'SWZ', '748', 'yes', '268', '.sz');
INSERT INTO "tblcountries" VALUES (215, 'SE', 'Suécia', 'Reino da Suécia', 'SWE', '752', 'yes', '46', '.se');
INSERT INTO "tblcountries" VALUES (216, 'CH', 'Suíça', 'Confederação Suíça', 'CHE', '756', 'yes', '41', '.ch');
INSERT INTO "tblcountries" VALUES (217, 'SY', 'Síria', 'República Árabe Síria', 'SYR', '760', 'yes', '963', '.sy');
INSERT INTO "tblcountries" VALUES (218, 'TW', 'Taiwan', 'República da China (Taiwan)', 'TWN', '158', 'former', '886', '.tw');
INSERT INTO "tblcountries" VALUES (219, 'TJ', 'Tajiquistão', 'República do Tajiquistão', 'TJK', '762', 'yes', '992', '.tj');
INSERT INTO "tblcountries" VALUES (220, 'TZ', 'Tanzânia', 'República Unida da Tanzânia', 'TZA', '834', 'yes', '255', '.tz');
INSERT INTO "tblcountries" VALUES (221, 'TH', 'Tailândia', 'Reino da Tailândia', 'THA', '764', 'yes', '66', '.th');
INSERT INTO "tblcountries" VALUES (222, 'TL', 'Timor-Leste', 'República Democrática de Timor-Leste', 'TLS', '626', 'yes', '670', '.tl');
INSERT INTO "tblcountries" VALUES (223, 'TG', 'Togo', 'República Togolesa', 'TGO', '768', 'yes', '228', '.tg');
INSERT INTO "tblcountries" VALUES (224, 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk');
INSERT INTO "tblcountries" VALUES (225, 'TO', 'Tonga', 'Reino de Tonga', 'TON', '776', 'yes', '676', '.to');
INSERT INTO "tblcountries" VALUES (226, 'TT', 'Trinidad e Tobago', 'República de Trinidad e Tobago', 'TTO', '780', 'yes', '1+868', '.tt');
INSERT INTO "tblcountries" VALUES (227, 'TN', 'Tunísia', 'República da Tunísia', 'TUN', '788', 'yes', '216', '.tn');
INSERT INTO "tblcountries" VALUES (228, 'TR', 'Turquia', 'República da Turquia', 'TUR', '792', 'yes', '90', '.tr');
INSERT INTO "tblcountries" VALUES (229, 'TM', 'Turcomenistão', 'Turcomenistão', 'TKM', '795', 'yes', '993', '.tm');
INSERT INTO "tblcountries" VALUES (230, 'TC', 'Ilhas Turks e Caicos', 'Ilhas Turks e Caicos', 'TCA', '796', 'no', '1+649', '.tc');
INSERT INTO "tblcountries" VALUES (231, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv');
INSERT INTO "tblcountries" VALUES (232, 'UG', 'Uganda', 'República de Uganda', 'UGA', '800', 'yes', '256', '.ug');
INSERT INTO "tblcountries" VALUES (233, 'UA', 'Ucrânia', 'Ucrânia', 'UKR', '804', 'yes', '380', '.ua');
INSERT INTO "tblcountries" VALUES (234, 'AE', 'Emirados Árabes Unidos', 'Emirados Árabes Unidos', 'ARE', '784', 'yes', '971', '.ae');
INSERT INTO "tblcountries" VALUES (235, 'GB', 'Reino Unido', 'Reino Unido da Grã-Bretanha e Irlanda do Norte', 'GBR', '826', 'yes', '44', '.uk');
INSERT INTO "tblcountries" VALUES (236, 'US', 'Estados Unidos', 'Estados Unidos da América', 'USA', '840', 'yes', '1', '.us');
INSERT INTO "tblcountries" VALUES (237, 'UM', 'Ilhas Menores Distantes dos Estados Unidos', 'Ilhas Menores Distantes dos Estados Unidos', 'UMI', '581', 'no', 'NONE', 'NONE');
INSERT INTO "tblcountries" VALUES (238, 'UY', 'Uruguai', 'República Oriental do Uruguai', 'URY', '858', 'yes', '598', '.uy');
INSERT INTO "tblcountries" VALUES (239, 'UZ', 'Uzbequistão', 'República do Uzbequistão', 'UZB', '860', 'yes', '998', '.uz');
INSERT INTO "tblcountries" VALUES (240, 'VU', 'Vanuatu', 'República de Vanuatu', 'VUT', '548', 'yes', '678', '.vu');
INSERT INTO "tblcountries" VALUES (241, 'VA', 'Cidade do Vaticano', 'Estado da Cidade do Vaticano', 'VAT', '336', 'no', '39', '.va');
INSERT INTO "tblcountries" VALUES (242, 'VE', 'Venezuela', 'República Bolivariana da Venezuela', 'VEN', '862', 'yes', '58', '.ve');
INSERT INTO "tblcountries" VALUES (243, 'VN', 'Vietnã', 'República Socialista do Vietnã', 'VNM', '704', 'yes', '84', '.vn');
INSERT INTO "tblcountries" VALUES (244, 'VG', 'Ilhas Virgens Britânicas', 'Ilhas Virgens Britânicas', 'VGB', '092', 'no', '1+284', '.vg');
INSERT INTO "tblcountries" VALUES (245, 'VI', 'Ilhas Virgens Americanas', 'Ilhas Virgens dos Estados Unidos', 'VIR', '850', 'no', '1+340', '.vi');
INSERT INTO "tblcountries" VALUES (246, 'WF', 'Wallis e Futuna', 'Wallis e Futuna', 'WLF', '876', 'no', '681', '.wf');
INSERT INTO "tblcountries" VALUES (247, 'EH', 'Saara Ocidental', 'Saara Ocidental', 'ESH', '732', 'no', '212', '.eh');
INSERT INTO "tblcountries" VALUES (248, 'YE', 'Iêmen', 'República do Iêmen', 'YEM', '887', 'yes', '967', '.ye');
INSERT INTO "tblcountries" VALUES (249, 'ZM', 'Zâmbia', 'República da Zâmbia', 'ZMB', '894', 'yes', '260', '.zm');
INSERT INTO "tblcountries" VALUES (250, 'ZW', 'Zimbábue', 'República do Zimbábue', 'ZWE', '716', 'yes', '263', '.zw');
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
INSERT INTO "tblcurrencies" VALUES (1, 'R$', 'Real', '.', ',', 'before', 1);
INSERT INTO "tblcurrencies" VALUES (2, '$', 'USD', '.', ',', 'before', 0);
INSERT INTO "tblcurrencies" VALUES (3, '€', 'EUR', ',', '.', 'before', 0);
DROP TABLE IF EXISTS "tblcustomer_admins";
CREATE TABLE "tblcustomer_admins" (
  "staff_id" integer NOT NULL,
  "customer_id" integer NOT NULL,
  "date_assigned" text NOT NULL
);
DROP TABLE IF EXISTS "tblcustomer_groups";
CREATE TABLE "tblcustomer_groups" (
  "id" integer NOT NULL,
  "groupid" integer NOT NULL,
  "customer_id" integer NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tblcustomers_groups";
CREATE TABLE "tblcustomers_groups" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblcustomfieldsvalues";
CREATE TABLE "tblcustomfieldsvalues" (
  "id" integer NOT NULL,
  "relid" integer NOT NULL,
  "fieldid" integer NOT NULL,
  "fieldto" text(15) NOT NULL,
  "value" text NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tbldismissed_announcements";
CREATE TABLE "tbldismissed_announcements" (
  "dismissedannouncementid" integer NOT NULL,
  "announcementid" integer NOT NULL,
  "staff" integer NOT NULL,
  "userid" integer NOT NULL,
  PRIMARY KEY ("dismissedannouncementid")
);
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
INSERT INTO "tblemailtemplates" VALUES (1, 'client', 'new-client-created', 'portuguese', 'Novo Contato Adicionado/Registrado (Email de Boas-Vindas)', 'Bem-vindo(a) a bordo', 'Prezado(a) {contact_firstname} {contact_lastname}<br /><br />Obrigado(a) por se registrar no Sistema CRM da <strong>{companyname}</strong>.<br /><br />Gostaríamos de dar as boas-vindas.<br /><br />Por favor, entre em contato se precisar de ajuda.<br /><br />Clique aqui para ver seu perfil: <a href="{crm_url}">{crm_url}</a><br /><br />Atenciosamente, <br />{email_signature}<br /><br />(Este é um e-mail automático, por favor, não responda a este endereço de e-mail)', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (2, 'invoice', 'invoice-send-to-client', 'portuguese', 'Enviar Fatura ao Cliente', 'Fatura número {invoice_number} criada', '<span style="font-size: 12pt;">Prezado(a) {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Preparamos a seguinte fatura para você: <strong># {invoice_number}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Status da Fatura</strong>: {invoice_status}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar a fatura no seguinte link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Entre em contato conosco para mais informações.</span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (3, 'ticket', 'new-ticket-opened-admin', 'portuguese', 'Novo Ticket Aberto (Aberto pela Equipe, Enviado ao Cliente)', 'Novo Ticket de Suporte Aberto', '<p><span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br><br><span style="font-size: 12pt;">Um novo ticket de suporte foi aberto.</span><br><br><span style="font-size: 12pt;"><strong>Assunto:</strong> {ticket_subject}</span><br><span style="font-size: 12pt;"><strong>Departamento:</strong> {ticket_department}</span><br><span style="font-size: 12pt;"><strong>Prioridade:</strong> {ticket_priority}<br></span><br><span style="font-size: 12pt;"><strong>Mensagem do Ticket:</strong></span><br><span style="font-size: 12pt;">{ticket_message}</span><br><br><span style="font-size: 12pt;">Você pode visualizar o ticket no seguinte link: <a href="{ticket_public_url}">#{ticket_id}</a><br><br>Atenciosamente,</span><br><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (4, 'ticket', 'ticket-reply', 'portuguese', 'Resposta de Ticket (Enviado ao Cliente)', 'Nova Resposta de Ticket', '<span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Você tem uma nova resposta para o ticket <a href="{ticket_public_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;"><strong>Assunto do Ticket:</strong> {ticket_subject}<br /></span><br /><span style="font-size: 12pt;"><strong>Mensagem do Ticket:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar o ticket no seguinte link: <a href="{ticket_public_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (5, 'ticket', 'ticket-autoresponse', 'portuguese', 'Novo Ticket Aberto - Resposta Automática', 'Novo Ticket de Suporte Aberto', '<span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Agradecemos por contatar nossa equipe de suporte. Um ticket de suporte foi aberto para sua solicitação. Você será notificado por e-mail quando uma resposta for feita.</span><br /><br /><span style="font-size: 12pt;"><strong>Assunto:</strong> {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Departamento</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Prioridade:</strong> {ticket_priority}</span><br /><br /><span style="font-size: 12pt;"><strong>Mensagem do Ticket:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar o ticket no seguinte link: <a href="{ticket_public_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (6, 'invoice', 'invoice-payment-recorded', 'portuguese', 'Pagamento de Fatura Registrado (Enviado ao Cliente)', 'Pagamento de Fatura Registrado', '<span style="font-size: 12pt;">Olá {contact_firstname}&nbsp;{contact_lastname}<br /><br /></span>Obrigado(a) pelo pagamento. Encontre os detalhes do pagamento abaixo:<br /><br />-------------------------------------------------<br /><br />Valor:&nbsp;<strong>{payment_total}<br /></strong>Data:&nbsp;<strong>{payment_date}</strong><br />Número da Fatura:&nbsp;<span style="font-size: 12pt;"><strong># {invoice_number}<br /><br /></strong></span>-------------------------------------------------<br /><br />Você pode sempre visualizar a fatura para este pagamento no seguinte link:&nbsp;<a href="{invoice_link}"><span style="font-size: 12pt;">{invoice_number}</span></a><br /><br />Esperamos trabalhar com você.<br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (7, 'invoice', 'invoice-overdue-notice', 'portuguese', 'Aviso de Fatura Vencida', 'Aviso de Fatura Vencida - {invoice_number}', '<span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Este é um aviso de vencimento para a fatura <strong># {invoice_number}</strong></span><br /><br /><span style="font-size: 12pt;">Esta fatura venceu em: {invoice_duedate}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar a fatura no seguinte link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (8, 'invoice', 'invoice-already-send', 'portuguese', 'Fatura Já Enviada ao Cliente', 'Fatura # {invoice_number} ', '<span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">A seu pedido, aqui está a fatura número <strong># {invoice_number}</strong></span><br /><br /><span style="font-size: 12pt;">Você pode visualizar a fatura no seguinte link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Entre em contato conosco para mais informações.</span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (9, 'ticket', 'new-ticket-created-staff', 'portuguese', 'Novo Ticket Criado (Aberto pelo Cliente, Enviado aos Membros da Equipe)', 'Novo Ticket Criado', '<p><span style="font-size: 12pt;">Um novo ticket de suporte foi aberto.</span><br /><br /><span style="font-size: 12pt;"><strong>Assunto</strong>: {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Departamento</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Prioridade</strong>: {ticket_priority}<br /></span><br /><span style="font-size: 12pt;"><strong>Mensagem do Ticket:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar o ticket no seguinte link: <a href="{ticket_url}">#{ticket_id}</a></span><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (10, 'estimate', 'estimate-send-to-client', 'portuguese', 'Enviar Orçamento ao Cliente', 'Orçamento # {estimate_number} criado', '<span style="font-size: 12pt;">Prezado(a) {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Por favor, encontre o orçamento anexado <strong># {estimate_number}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Status do Orçamento:</strong> {estimate_status}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar o orçamento no seguinte link: <a href="{estimate_link}">{estimate_number}</a></span><br /><br /><span style="font-size: 12pt;">Aguardamos sua comunicação.</span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}<br /></span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (11, 'ticket', 'ticket-reply-to-admin', 'portuguese', 'Resposta de Ticket (Enviado à Equipe)', 'Nova Resposta de Ticket de Suporte', '<span style="font-size: 12pt;">Uma nova resposta de ticket de suporte de {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;"><strong>Assunto</strong>: {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Departamento</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Prioridade</strong>: {ticket_priority}</span><br /><br /><span style="font-size: 12pt;"><strong>Mensagem do Ticket:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar o ticket no seguinte link: <a href="{ticket_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (12, 'estimate', 'estimate-already-send', 'portuguese', 'Orçamento Já Enviado ao Cliente', 'Orçamento # {estimate_number} ', '<span style="font-size: 12pt;">Prezado(a) {contact_firstname} {contact_lastname}</span><br /> <br /><span style="font-size: 12pt;">Obrigado(a) pela sua solicitação de orçamento.</span><br /> <br /><span style="font-size: 12pt;">Você pode visualizar o orçamento no seguinte link: <a href="{estimate_link}">{estimate_number}</a></span><br /> <br /><span style="font-size: 12pt;">Entre em contato conosco para mais informações.</span><br /> <br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (13, 'contract', 'contract-expiration', 'portuguese', 'Lembrete de Vencimento de Contrato (Enviado aos Contatos do Cliente)', 'Lembrete de Vencimento de Contrato', '<span style="font-size: 12pt;">Prezada {client_company}</span><br /><br /><span style="font-size: 12pt;">Este é um lembrete de que o seguinte contrato expirará em breve:</span><br /><br /><span style="font-size: 12pt;"><strong>Assunto:</strong> {contract_subject}</span><br /><span style="font-size: 12pt;"><strong>Descrição:</strong> {contract_description}</span><br /><span style="font-size: 12pt;"><strong>Data de Início:</strong> {contract_datestart}</span><br /><span style="font-size: 12pt;"><strong>Data de Término:</strong> {contract_dateend}</span><br /><br /><span style="font-size: 12pt;">Entre em contato conosco para mais informações.</span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (14, 'tasks', 'task-assigned', 'portuguese', 'Nova Tarefa Atribuída (Enviado à Equipe)', 'Nova Tarefa Atribuída a Você - {task_name}', '<span style="font-size: 12pt;">Prezado(a) {staff_firstname}</span><br /><br /><span style="font-size: 12pt;">Você foi atribuído(a) a uma nova tarefa:</span><br /><br /><span style="font-size: 12pt;"><strong>Nome:</strong> {task_name}<br /></span><strong>Data de Início:</strong> {task_startdate}<br /><span style="font-size: 12pt;"><strong>Data de Vencimento:</strong> {task_duedate}</span><br /><span style="font-size: 12pt;"><strong>Prioridade:</strong> {task_priority}<br /><br /></span><span style="font-size: 12pt;"><span>Você pode visualizar a tarefa no seguinte link</span>: <a href="{task_link}">{task_name}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (15, 'tasks', 'task-added-as-follower', 'portuguese', 'Membro da Equipe Adicionado como Seguidor na Tarefa (Enviado à Equipe)', 'Você foi adicionado(a) como seguidor na tarefa - {task_name}', '<span style="font-size: 12pt;">Olá {staff_firstname}<br /></span><br /><span style="font-size: 12pt;">Você foi adicionado(a) como seguidor na seguinte tarefa:</span><br /><br /><span style="font-size: 12pt;"><strong>Nome:</strong> {task_name}</span><br /><span style="font-size: 12pt;"><strong>Data de Início:</strong> {task_startdate}</span><br /><br /><span>Você pode visualizar a tarefa no seguinte link</span><span>: </span><a href="{task_link}">{task_name}</a><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (16, 'tasks', 'task-commented', 'portuguese', 'Novo Comentário na Tarefa (Enviado à Equipe)', 'Novo Comentário na Tarefa - {task_name}', 'Prezado(a) {staff_firstname}<br /><br />Um comentário foi feito na seguinte tarefa:<br /><br /><strong>Nome:</strong> {task_name}<br /><strong>Comentário:</strong> {task_comment}<br /><br />Você pode visualizar a tarefa no seguinte link: <a href="{task_link}">{task_name}</a><br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (17, 'tasks', 'task-added-attachment', 'portuguese', 'Novo(s) Anexo(s) na Tarefa (Enviado à Equipe)', 'Novo Anexo na Tarefa - {task_name}', 'Olá {staff_firstname}<br /><br /><strong>{task_user_take_action}</strong> adicionou um anexo na seguinte tarefa:<br /><br /><strong>Nome:</strong> {task_name}<br /><br />Você pode visualizar a tarefa no seguinte link: <a href="{task_link}">{task_name}</a><br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (18, 'estimate', 'estimate-declined-to-staff', 'portuguese', 'Orçamento Recusado (Enviado à Equipe)', 'Cliente Recusou Orçamento', '<span style="font-size: 12pt;">Olá</span><br /> <br /><span style="font-size: 12pt;">O Cliente ({client_company}) recusou o orçamento número <strong># {estimate_number}</strong></span><br /> <br /><span style="font-size: 12pt;">Você pode visualizar o orçamento no seguinte link: <a href="{estimate_link}">{estimate_number}</a></span><br /> <br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (19, 'estimate', 'estimate-accepted-to-staff', 'portuguese', 'Orçamento Aceito (Enviado à Equipe)', 'Cliente Aceitou Orçamento', '<span style="font-size: 12pt;">Olá</span><br /> <br /><span style="font-size: 12pt;">O Cliente ({client_company}) aceitou o orçamento número <strong># {estimate_number}</strong></span><br /> <br /><span style="font-size: 12pt;">Você pode visualizar o orçamento no seguinte link: <a href="{estimate_link}">{estimate_number}</a></span><br /> <br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (20, 'proposals', 'proposal-client-accepted', 'portuguese', 'Ação do Cliente - Aceita (Enviado à Equipe)', 'Cliente Aceitou Proposta', '<div>Olá<br /> <br />O cliente <strong>{proposal_proposal_to}</strong> aceitou a seguinte proposta:<br /> <br /><strong>Número:</strong> {proposal_number}<br /><strong>Assunto</strong>: {proposal_subject}<br /><strong>Total</strong>: {proposal_total}<br /> <br />Visualize a proposta no seguinte link: <a href="{proposal_link}">{proposal_number}</a><br /> <br />Atenciosamente,<br />{email_signature}</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (21, 'proposals', 'proposal-send-to-customer', 'portuguese', 'Enviar Proposta ao Cliente', 'Proposta Com Número {proposal_number} Criada', 'Prezado(a) {proposal_proposal_to}<br /><br />Por favor, encontre nossa proposta anexada.<br /><br />Esta proposta é válida até: {proposal_open_till}<br />Você pode visualizar a proposta no seguinte link: <a href="{proposal_link}">{proposal_number}</a><br /><br />Por favor, não hesite em comentar online se tiver alguma dúvida.<br /><br />Aguardamos sua comunicação.<br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (22, 'proposals', 'proposal-client-declined', 'portuguese', 'Ação do Cliente - Recusada (Enviado à Equipe)', 'Cliente Recusou Proposta', 'Olá<br /> <br />O cliente <strong>{proposal_proposal_to}</strong> recusou a proposta <strong>{proposal_subject}</strong><br /> <br />Visualize a proposta no seguinte link <a href="{proposal_link}">{proposal_number}</a>&nbsp;ou na área de administração.<br /> <br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (23, 'proposals', 'proposal-client-thank-you', 'portuguese', 'E-mail de Agradecimento (Enviado ao Cliente Após Aceite)', 'Obrigado por aceitar a proposta', 'Prezado(a) {proposal_proposal_to}<br /> <br />Obrigado(a) por aceitar a proposta.<br /> <br />Esperamos fazer negócios com você.<br /> <br />Entraremos em contato o mais breve possível.<br /> <br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (24, 'proposals', 'proposal-comment-to-client', 'portuguese', 'Novo Comentário (Enviado ao Cliente/Lead)', 'Novo Comentário na Proposta', 'Prezado(a) {proposal_proposal_to}<br /> <br />Um novo comentário foi feito na seguinte proposta: <strong>{proposal_number}</strong><br /> <br />Você pode visualizar e responder ao comentário no seguinte link: <a href="{proposal_link}">{proposal_number}</a><br /> <br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (25, 'proposals', 'proposal-comment-to-admin', 'portuguese', 'Novo Comentário (Enviado à Equipe) ', 'Novo Comentário na Proposta', 'Olá<br /> <br />Um novo comentário foi feito na proposta <strong>{proposal_subject}</strong><br /> <br />Você pode visualizar e responder ao comentário no seguinte link: <a href="{proposal_link}">{proposal_number}</a>&nbsp;ou na área de administração.<br /> <br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (26, 'estimate', 'estimate-thank-you-to-customer', 'portuguese', 'E-mail de Agradecimento (Enviado ao Cliente Após Aceite)', 'Obrigado por aceitar o orçamento', '<span style="font-size: 12pt;">Prezado(a) {contact_firstname} {contact_lastname}</span><br /> <br /><span style="font-size: 12pt;">Obrigado(a) por aceitar o orçamento.</span><br /> <br /><span style="font-size: 12pt;">Esperamos fazer negócios com você.</span><br /> <br /><span style="font-size: 12pt;">Entraremos em contato o mais breve possível.</span><br /> <br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (27, 'tasks', 'task-deadline-notification', 'portuguese', 'Lembrete de Prazo de Tarefa - Enviado aos Membros Atribuídos', 'Lembrete de Prazo de Tarefa', 'Olá {staff_firstname}&nbsp;{staff_lastname}<br /><br />Este é um e-mail automático de {companyname}.<br /><br />O prazo da tarefa <strong>{task_name}</strong> é em <strong>{task_duedate}</strong>. <br />Esta tarefa ainda não foi finalizada.<br /><br />Você pode visualizar a tarefa no seguinte link: <a href="{task_link}">{task_name}</a><br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (28, 'contract', 'send-contract', 'portuguese', 'Enviar Contrato ao Cliente', 'Contrato - {contract_subject}', '<p><span style="font-size: 12pt;">Olá&nbsp;{contact_firstname}&nbsp;{contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Por favor, encontre o <a href="{contract_link}">{contract_subject}</a> anexado.<br /><br />Descrição: {contract_description}<br /><br /></span><span style="font-size: 12pt;">Aguardamos seu contato.</span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (29, 'invoice', 'invoice-payment-recorded-to-staff', 'portuguese', 'Pagamento de Fatura Registrado (Enviado à Equipe)', 'Novo Pagamento de Fatura', '<span style="font-size: 12pt;">Olá</span><br /><br /><span style="font-size: 12pt;">O cliente registrou o pagamento da fatura <strong># {invoice_number}</strong></span><br /> <br /><span style="font-size: 12pt;">Você pode visualizar a fatura no seguinte link: <a href="{invoice_link}">{invoice_number}</a></span><br /> <br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (30, 'ticket', 'auto-close-ticket', 'portuguese', 'Ticket Fechado Automaticamente', 'Ticket Fechado Automaticamente', '<p><span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">O ticket {ticket_subject} foi fechado automaticamente devido à inatividade.</span><br /><br /><span style="font-size: 12pt;"><strong>Ticket #</strong>: <a href="{ticket_public_url}">{ticket_id}</a></span><br /><span style="font-size: 12pt;"><strong>Departamento</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Prioridade:</strong> {ticket_priority}</span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (31, 'project', 'new-project-discussion-created-to-staff', 'portuguese', 'Nova Discussão de Projeto (Enviado aos Membros do Projeto)', 'Nova Discussão de Projeto Criada - {project_name}', '<p>Olá {staff_firstname}<br /><br />Nova discussão de projeto criada por <strong>{discussion_creator}</strong><br /><br /><strong>Assunto:</strong> {discussion_subject}<br /><strong>Descrição:</strong> {discussion_description}<br /><br />Você pode visualizar a discussão no seguinte link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (32, 'project', 'new-project-discussion-created-to-customer', 'portuguese', 'Nova Discussão de Projeto (Enviado aos Contatos do Cliente)', 'Nova Discussão de Projeto Criada - {project_name}', '<p>Olá {contact_firstname} {contact_lastname}<br /><br />Nova discussão de projeto criada por <strong>{discussion_creator}</strong><br /><br /><strong>Assunto:</strong> {discussion_subject}<br /><strong>Descrição:</strong> {discussion_description}<br /><br />Você pode visualizar a discussão no seguinte link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (33, 'project', 'new-project-file-uploaded-to-customer', 'portuguese', 'Novo(s) Arquivo(s) de Projeto Carregado(s) (Enviado aos Contatos do Cliente)', 'Novo(s) Arquivo(s) de Projeto Carregado(s) - {project_name}', '<p>Olá {contact_firstname} {contact_lastname}<br /><br />Um novo arquivo de projeto foi carregado em <strong>{project_name}</strong> por <strong>{file_creator}</strong><br /><br />Você pode visualizar o projeto no seguinte link: <a href="{project_link}">{project_name}</a><br /><br />Para visualizar o arquivo em nosso CRM, você pode clicar no seguinte link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (34, 'project', 'new-project-file-uploaded-to-staff', 'portuguese', 'Novo(s) Arquivo(s) de Projeto Carregado(s) (Enviado aos Membros do Projeto)', 'Novo(s) Arquivo(s) de Projeto Carregado(s) - {project_name}', '<p>Olá&nbsp;{staff_firstname}</p>
<p>Um novo arquivo de projeto foi carregado em&nbsp;<strong>{project_name}</strong> por&nbsp;<strong>{file_creator}</strong></p>
<p>Você pode visualizar o projeto no seguinte link: <a href="{project_link}">{project_name}<br /></a><br />Para visualizar&nbsp;o arquivo, você pode clicar no seguinte link: <a href="{discussion_link}">{discussion_subject}</a></p>
<p>Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (35, 'project', 'new-project-discussion-comment-to-customer', 'portuguese', 'Novo Comentário de Discussão (Enviado aos Contatos do Cliente)', 'Novo Comentário de Discussão', '<p><span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">Um novo comentário de discussão foi feito em <strong>{discussion_subject}</strong> por <strong>{comment_creator}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Assunto da Discussão:</strong> {discussion_subject}</span><br /><span style="font-size: 12pt;"><strong>Comentário</strong>: {discussion_comment}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar a discussão no seguinte link: <a href="{discussion_link}">{discussion_subject}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (36, 'project', 'new-project-discussion-comment-to-staff', 'portuguese', 'Novo Comentário de Discussão (Enviado aos Membros do Projeto)', 'Novo Comentário de Discussão', '<p>Olá {staff_firstname}<br /><br />Um novo comentário de discussão foi feito em <strong>{discussion_subject}</strong> por <strong>{comment_creator}</strong><br /><br /><strong>Assunto da Discussão:</strong> {discussion_subject}<br /><strong>Comentário:</strong> {discussion_comment}<br /><br />Você pode visualizar a discussão no seguinte link: <a href="{discussion_link}">{discussion_subject}</a><br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (37, 'project', 'staff-added-as-project-member', 'portuguese', 'Equipe Adicionada como Membro do Projeto', 'Novo projeto atribuído a você', '<p>Olá {staff_firstname}<br /><br />Um novo projeto foi atribuído a você.<br /><br />Você pode visualizar o projeto no seguinte link <a href="{project_link}">{project_name}</a><br /><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (38, 'estimate', 'estimate-expiry-reminder', 'portuguese', 'Lembrete de Vencimento de Orçamento', 'Lembrete de Vencimento de Orçamento', '<p><span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;">O orçamento número <strong># {estimate_number}</strong> vencerá em <strong>{estimate_expirydate}</strong></span><br /><br /><span style="font-size: 12pt;">Você pode visualizar o orçamento no seguinte link: <a href="{estimate_link}">{estimate_number}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (39, 'proposals', 'proposal-expiry-reminder', 'portuguese', 'Lembrete de Vencimento de Proposta', 'Lembrete de Vencimento de Proposta', '<p>Olá {proposal_proposal_to}<br /><br />A proposta {proposal_number}&nbsp;vencerá em <strong>{proposal_open_till}</strong><br /><br />Você pode visualizar a proposta no seguinte link: <a href="{proposal_link}">{proposal_number}</a><br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (40, 'staff', 'new-staff-created', 'portuguese', 'Novo Membro da Equipe Criado (Email de Boas-Vindas)', 'Você foi adicionado(a) como membro da equipe', 'Olá {staff_firstname}<br /><br />Você foi adicionado(a) como membro em nosso CRM.<br /><br />Por favor, use as seguintes credenciais de login:<br /><br /><strong>Email:</strong> {staff_email}<br /><strong>Senha:</strong> {password}<br /><br />Clique <a href="{admin_url}">aqui </a>para fazer login no painel.<br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (41, 'client', 'contact-forgot-password', 'portuguese', 'Esqueceu a Senha', 'Criar Nova Senha', '<h2>Criar uma nova senha</h2>
Esqueceu sua senha?<br /> Para criar uma nova senha, basta seguir este link:<br /> <br /><a href="{reset_password_url}">Redefinir Senha</a><br /> <br /> Você recebeu este e-mail porque foi solicitado por um usuário de <strong>{companyname}</strong>. Isso faz parte do procedimento para criar uma nova senha no sistema. Se você NÃO solicitou uma nova senha, por favor, ignore este e-mail e sua senha permanecerá a mesma. <br /><br /> {email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (42, 'client', 'contact-password-reseted', 'portuguese', 'Redefinição de Senha - Confirmação', 'Sua senha foi alterada', '<strong><span style="font-size: 14pt;">Sua senha foi alterada.</span><br /></strong><br /> Por favor, guarde-a em seus registros para não esquecê-la.<br /> <br /> Seu endereço de e-mail para login é: {contact_email}<br /><br />Se esta não foi uma ação sua, por favor, entre em contato conosco.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (43, 'client', 'contact-set-password', 'portuguese', 'Definir Nova Senha', 'Definir nova senha em {companyname} ', '<h2><span style="font-size: 14pt;">Configure sua nova senha em {companyname}</span></h2>
Por favor, use o link a seguir para configurar sua nova senha:<br /><br /><a href="{set_password_url}">Definir nova senha</a><br /><br />Guarde-a em seus registros para não esquecê-la.<br /><br />Por favor, defina sua nova senha em <strong>48 horas</strong>. Depois disso, você não poderá definir sua senha porque este link expirará.<br /><br />Você pode fazer login em: <a href="{crm_url}">{crm_url}</a><br />Seu endereço de e-mail para login: {contact_email}<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (44, 'staff', 'staff-forgot-password', 'portuguese', 'Esqueceu a Senha', 'Criar Nova Senha', '<h2><span style="font-size: 14pt;">Criar uma nova senha</span></h2>
Esqueceu sua senha?<br /> Para criar uma nova senha, basta seguir este link:<br /> <br /><a href="{reset_password_url}">Redefinir Senha</a><br /> <br /> Você recebeu este e-mail porque foi solicitado por um usuário de <strong>{companyname}</strong>. Isso faz parte do procedimento para criar uma nova senha no sistema. Se você NÃO solicitou uma nova senha, por favor, ignore este e-mail e sua senha permanecerá a mesma. <br /><br /> {email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (45, 'staff', 'staff-password-reseted', 'portuguese', 'Redefinição de Senha - Confirmação', 'Sua senha foi alterada', '<span style="font-size: 14pt;"><strong>Sua senha foi alterada.<br /></strong></span><br /> Por favor, guarde-a em seus registros para não esquecê-la.<br /> <br /> Seu endereço de e-mail para login é: {staff_email}<br /><br /> Se esta não foi uma ação sua, por favor, entre em contato conosco.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (46, 'project', 'assigned-to-project', 'portuguese', 'Novo Projeto Criado (Enviado aos Contatos do Cliente)', 'Novo Projeto Criado', '<p>Olá&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>
<p>Um novo projeto foi atribuído à sua empresa.<br /><br /><strong>Nome do Projeto:</strong>&nbsp;{project_name}<br /><strong>Data de Início do Projeto:</strong>&nbsp;{project_start_date}</p>
<p>Você pode visualizar o projeto no seguinte link:&nbsp;<a href="{project_link}">{project_name}</a></p>
<p>Aguardamos seu contato.<br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (47, 'tasks', 'task-added-attachment-to-contacts', 'portuguese', 'Novo(s) Anexo(s) na Tarefa (Enviado aos Contatos do Cliente)', 'Novo Anexo na Tarefa - {task_name}', '<span>Olá {contact_firstname} {contact_lastname}</span><br /><br /><strong>{task_user_take_action}</strong><span> adicionou um anexo na seguinte tarefa:</span><br /><br /><strong>Nome:</strong><span> {task_name}</span><br /><br /><span>Você pode visualizar a tarefa no seguinte link: </span><a href="{task_link}">{task_name}</a><br /><br /><span>Atenciosamente,</span><br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (48, 'tasks', 'task-commented-to-contacts', 'portuguese', 'Novo Comentário na Tarefa (Enviado aos Contatos do Cliente)', 'Novo Comentário na Tarefa - {task_name}', '<span>Prezado(a) {contact_firstname} {contact_lastname}</span><br /><br /><span>Um comentário foi feito na seguinte tarefa:</span><br /><br /><strong>Nome:</strong><span> {task_name}</span><br /><strong>Comentário:</strong><span> {task_comment}</span><br /><br /><span>Você pode visualizar a tarefa no seguinte link: </span><a href="{task_link}">{task_name}</a><br /><br /><span>Atenciosamente,</span><br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (49, 'leads', 'new-lead-assigned', 'portuguese', 'Novo Lead Atribuído ao Membro da Equipe', 'Novo lead atribuído a você', '<p>Olá {lead_assigned}<br /><br />Um novo lead foi atribuído a você.<br /><br /><strong>Nome do Lead:</strong>&nbsp;{lead_name}<br /><strong>E-mail do Lead:</strong>&nbsp;{lead_email}<br /><br />Você pode visualizar o lead no seguinte link: <a href="{lead_link}">{lead_name}</a><br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (50, 'client', 'client-statement', 'portuguese', 'Extrato - Resumo da Conta', 'Extrato da Conta de {statement_from} a {statement_to}', 'Prezado(a) {contact_firstname} {contact_lastname}, <br /><br />Tem sido uma ótima experiência trabalhar com você.<br /><br />Anexado a este e-mail está uma lista de todas as transações para o período entre {statement_from} e {statement_to}<br /><br />Para sua informação, o saldo devedor da sua conta é total:&nbsp;{statement_balance_due}<br /><br />Entre em contato conosco se precisar de mais informações.<br /> <br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (51, 'ticket', 'ticket-assigned-to-admin', 'portuguese', 'Novo Ticket Atribuído (Enviado à Equipe)', 'Um novo ticket de suporte foi atribuído a você', '<p><span style="font-size: 12pt;">Olá</span></p>
<p><span style="font-size: 12pt;">Um novo ticket de suporte foi atribuído a você.</span><br /><br /><span style="font-size: 12pt;"><strong>Assunto</strong>: {ticket_subject}</span><br /><span style="font-size: 12pt;"><strong>Departamento</strong>: {ticket_department}</span><br /><span style="font-size: 12pt;"><strong>Prioridade</strong>: {ticket_priority}</span><br /><br /><span style="font-size: 12pt;"><strong>Mensagem do Ticket:</strong></span><br /><span style="font-size: 12pt;">{ticket_message}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar o ticket no seguinte link: <a href="{ticket_url}">#{ticket_id}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (52, 'client', 'new-client-registered-to-admin', 'portuguese', 'Novo Registro de Cliente (Enviado aos administradores)', 'Novo Registro de Cliente', 'Olá.<br /><br />Novo registro de cliente em seu portal do cliente:<br /><br /><strong>Primeiro Nome:</strong>&nbsp;{contact_firstname}<br /><strong>Sobrenome:</strong>&nbsp;{contact_lastname}<br /><strong>Empresa:</strong>&nbsp;{client_company}<br /><strong>E-mail:</strong>&nbsp;{contact_email}<br /><br />Atenciosamente', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (53, 'leads', 'new-web-to-lead-form-submitted', 'portuguese', 'Formulário Web para Lead Enviado - Enviado ao lead', '{lead_name} - Recebemos Sua Solicitação', 'Olá {lead_name}.<br /><br /><strong>Sua solicitação foi recebida.</strong><br /><br />Este e-mail é para informar que recebemos sua solicitação e entraremos em contato o mais breve possível com mais informações.<br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 0, 0);
INSERT INTO "tblemailtemplates" VALUES (54, 'staff', 'two-factor-authentication', 'portuguese', 'Autenticação de Dois Fatores', 'Confirme Seu Login', '<p>Olá {staff_firstname}</p>
<p style="text-align: left;">Você recebeu este e-mail porque ativou a autenticação de dois fatores em sua conta.<br />Use o seguinte código para confirmar seu login:</p>
<p style="text-align: left;"><span style="font-size: 18pt;"><strong>{two_factor_auth_code}<br /><br /></strong><span style="font-size: 12pt;">{email_signature}</span><strong><br /><br /><br /><br /></strong></span></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (55, 'project', 'project-finished-to-customer', 'portuguese', 'Projeto Marcado como Concluído (Enviado aos Contatos do Cliente)', 'Projeto Marcado como Concluído', '<p>Olá&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>
<p>Você está recebendo este e-mail porque o projeto&nbsp;<strong>{project_name}</strong> foi marcado como concluído. Este projeto está atribuído à sua empresa e gostaríamos apenas de mantê-lo(a) atualizado(a).<br /><br />Você pode visualizar o projeto no seguinte link:&nbsp;<a href="{project_link}">{project_name}</a></p>
<p>Se tiver alguma dúvida, não hesite em nos contatar.<br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (56, 'credit_note', 'credit-note-send-to-client', 'portuguese', 'Enviar Nota de Crédito Por E-mail', 'Nota de Crédito Com Número #{credit_note_number} Criada', 'Prezado(a)&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />Anexamos a nota de crédito com o número <strong>#{credit_note_number} </strong>para sua referência.<br /><br /><strong>Data:</strong>&nbsp;{credit_note_date}<br /><strong>Valor Total:</strong>&nbsp;{credit_note_total}<br /><br /><span style="font-size: 12pt;">Entre em contato conosco para mais informações.</span><br /> <br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (57, 'tasks', 'task-status-change-to-staff', 'portuguese', 'Status da Tarefa Alterado (Enviado à Equipe)', 'Status da Tarefa Alterado', '<span style="font-size: 12pt;">Olá {staff_firstname}</span><br /><br /><span style="font-size: 12pt;"><strong>{task_user_take_action}</strong> marcou a tarefa como <strong>{task_status}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Nome:</strong> {task_name}</span><br /><span style="font-size: 12pt;"><strong>Data de vencimento:</strong> {task_duedate}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar a tarefa no seguinte link: <a href="{task_link}">{task_name}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (58, 'tasks', 'task-status-change-to-contacts', 'portuguese', 'Status da Tarefa Alterado (Enviado aos Contatos do Cliente)', 'Status da Tarefa Alterado', '<span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}</span><br /><br /><span style="font-size: 12pt;"><strong>{task_user_take_action}</strong> marcou a tarefa como <strong>{task_status}</strong></span><br /><br /><span style="font-size: 12pt;"><strong>Nome:</strong> {task_name}</span><br /><span style="font-size: 12pt;"><strong>Data de vencimento:</strong> {task_duedate}</span><br /><br /><span style="font-size: 12pt;">Você pode visualizar a tarefa no seguinte link: <a href="{task_link}">{task_name}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (59, 'staff', 'reminder-email-staff', 'portuguese', 'E-mail de Lembrete para a Equipe', 'Você Tem um Novo Lembrete!', '<p>Olá&nbsp;{staff_firstname}<br /><br /><strong>Você tem um novo lembrete&nbsp;vinculado a&nbsp;{staff_reminder_relation_name}!.<br /><br />Descrição do lembrete:</strong><br />{staff_reminder_description}<br /><br />Clique <a href="{staff_reminder_relation_link}">aqui</a> para visualizar&nbsp;<a href="{staff_reminder_relation_link}">{staff_reminder_relation_name}</a><br /><br />Atenciosamente<br /><br /></p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (60, 'contract', 'contract-comment-to-client', 'portuguese', 'Novo Comentário (Enviado aos Contatos do Cliente)', 'Novo Comentário de Contrato', 'Prezado(a) {contact_firstname} {contact_lastname}<br /> <br />Um novo comentário foi feito no seguinte contrato: <strong>{contract_subject}</strong><br /> <br />Você pode visualizar e responder ao comentário no seguinte link: <a href="{contract_link}">{contract_subject}</a><br /> <br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (61, 'contract', 'contract-comment-to-admin', 'portuguese', 'Novo Comentário (Enviado à Equipe) ', 'Novo Comentário de Contrato', 'Olá {staff_firstname}<br /><br />Um novo comentário foi feito no contrato&nbsp;<strong>{contract_subject}</strong><br /><br />Você pode visualizar e responder ao comentário no seguinte link: <a href="{contract_link}">{contract_subject}</a>&nbsp;ou na área de administração.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (62, 'subscriptions', 'send-subscription', 'portuguese', 'Enviar Assinatura ao Cliente', 'Assinatura Criada', 'Olá&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />Preparamos a assinatura&nbsp;<strong>{subscription_name}</strong> para sua empresa.<br /><br />Clique <a href="{subscription_link}">aqui</a> para revisar a assinatura e assinar.<br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (63, 'subscriptions', 'subscription-payment-failed', 'portuguese', 'Pagamento da Assinatura Falhou', 'Seu pagamento de fatura mais recente falhou', 'Olá&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br br="" />Infelizmente, seu pagamento de fatura mais recente para&nbsp;<strong>{subscription_name}</strong> foi recusado.<br /><br />Isso pode ser devido a uma alteração no número do seu cartão, seu cartão expirando,<br />cancelamento do seu cartão de crédito, ou a emissora do cartão não reconhecendo o<br />pagamento e, portanto, tomando medidas para impedi-lo.<br /><br />Por favor, atualize suas informações de pagamento o mais rápido possível fazendo login aqui:<br /><a href="{crm_url}/login">{crm_url}/login</a><br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (64, 'subscriptions', 'subscription-canceled', 'portuguese', 'Assinatura Cancelada (Enviado ao contato principal do cliente)', 'Sua assinatura foi cancelada', 'Olá&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />Sua assinatura&nbsp;<strong>{subscription_name} </strong>foi cancelada, se você tiver alguma dúvida, não hesite em nos contatar.<br /><br />Foi um prazer fazer negócios com você.<br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (65, 'subscriptions', 'subscription-payment-succeeded', 'portuguese', 'Pagamento da Assinatura Realizado com Sucesso (Enviado ao contato principal do cliente)', 'Recibo de Pagamento de Assinatura - {subscription_name}', 'Olá&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />Este e-mail é para informar que recebemos seu pagamento pela assinatura&nbsp;<strong>{subscription_name}&nbsp;</strong>de&nbsp;<strong><span>{payment_total}<br /><br /></span></strong>A fatura associada agora está com o status&nbsp;<strong>{invoice_status}<br /></strong><br />Obrigado(a) pela sua confiança.<br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (66, 'contract', 'contract-expiration-to-staff', 'portuguese', 'Lembrete de Vencimento de Contrato (Enviado à Equipe)', 'Lembrete de Vencimento de Contrato', 'Olá {staff_firstname}<br /><br /><span style="font-size: 12pt;">Este é um lembrete de que o seguinte contrato expirará em breve:</span><br /><br /><span style="font-size: 12pt;"><strong>Assunto:</strong> {contract_subject}</span><br /><span style="font-size: 12pt;"><strong>Descrição:</strong> {contract_description}</span><br /><span style="font-size: 12pt;"><strong>Data de Início:</strong> {contract_datestart}</span><br /><span style="font-size: 12pt;"><strong>Data de Término:</strong> {contract_dateend}</span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (67, 'gdpr', 'gdpr-removal-request', 'portuguese', 'Solicitação de Remoção de Contato (Enviado aos administradores)', 'Solicitação de Remoção de Dados Recebida', 'Olá&nbsp;{staff_firstname}&nbsp;{staff_lastname}<br /><br />Uma solicitação de remoção de dados foi feita por&nbsp;{contact_firstname} {contact_lastname}<br /><br />Você pode revisar esta solicitação e tomar as medidas adequadas diretamente na área de administração.', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (68, 'gdpr', 'gdpr-removal-request-lead', 'portuguese', 'Solicitação de Remoção de Lead (Enviado aos administradores)', 'Solicitação de Remoção de Dados Recebida', 'Olá&nbsp;{staff_firstname}&nbsp;{staff_lastname}<br /><br />Uma solicitação de remoção de dados foi feita por {lead_name}<br /><br />Você pode revisar esta solicitação e tomar as medidas adequadas diretamente na área de administração.<br /><br />Para visualizar o lead na área de administração, clique aqui:&nbsp;<a href="{lead_link}">{lead_link}</a>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (69, 'client', 'client-registration-confirmed', 'portuguese', 'Registro de Cliente Confirmado', 'Seu registro foi confirmado', '<p>Prezado(a) {contact_firstname} {contact_lastname}<br /><br />Gostaríamos de informar que seu registro em&nbsp;{companyname} foi confirmado com sucesso e sua conta agora está ativa.<br /><br />Você pode fazer login em&nbsp;<a href="{crm_url}">{crm_url}</a> com o e-mail e a senha que você forneceu durante o registro.<br /><br />Por favor, entre em contato se precisar de ajuda.<br /><br />Atenciosamente, <br />{email_signature}</p>
<p><br />(Este é um e-mail automático, por favor, não responda a este endereço de e-mail)</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (70, 'contract', 'contract-signed-to-staff', 'portuguese', 'Contrato Assinado (Enviado à Equipe)', 'Cliente Assinou um Contrato', 'Olá {staff_firstname}<br /><br />Um contrato com o assunto&nbsp;<strong>{contract_subject} </strong>foi assinado com sucesso pelo cliente.<br /><br />Você pode visualizar o contrato no seguinte link: <a href="{contract_link}">{contract_subject}</a>&nbsp;ou na área de administração.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (71, 'subscriptions', 'customer-subscribed-to-staff', 'portuguese', 'Cliente Assinou uma Assinatura (Enviado aos administradores e criador da assinatura)', 'Cliente Assinou uma Assinatura', 'O cliente <strong>{client_company}</strong> assinou uma assinatura com o nome&nbsp;<strong>{subscription_name}</strong><br /><br /><strong>ID</strong>:&nbsp;{subscription_id}<br /><strong>Nome da assinatura</strong>:&nbsp;{subscription_name}<br /><strong>Descrição da assinatura</strong>:&nbsp;{subscription_description}<br /><br />Você pode visualizar a assinatura clicando <a href="{subscription_link}">aqui</a><br />
<div style="text-align: center;"><span style="font-size: 10pt;">&nbsp;</span></div>
Atenciosamente,<br />{email_signature}<br /><br /><span style="font-size: 10pt;"><span style="color: #999999;">Você está recebendo este e-mail porque é administrador ou criador da assinatura.</span></span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (72, 'client', 'contact-verification-email', 'portuguese', 'Verificação de E-mail (Enviado ao Contato Após o Registro)', 'Verificar Endereço de E-mail', '<p>Olá&nbsp;{contact_firstname}<br /><br />Por favor, clique no botão abaixo para verificar seu endereço de e-mail.<br /><br /><a href="{email_verification_url}">Verificar Endereço de E-mail</a><br /><br />Se você não criou uma conta, nenhuma ação adicional é necessária</p>
<p><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (73, 'client', 'new-customer-profile-file-uploaded-to-staff', 'portuguese', 'Novo(s) Arquivo(s) de Perfil de Cliente Carregado(s) (Enviado à Equipe)', 'Cliente Carregou Novo(s) Arquivo(s) no Perfil', 'Olá!<br /><br />Novo(s) arquivo(s) foi(ram) carregado(s) no perfil do cliente ({client_company}) por&nbsp;{contact_firstname}<br /><br />Você pode verificar os arquivos carregados na área de administração clicando <a href="{customer_profile_files_admin_link}">aqui</a> ou no seguinte link:&nbsp;{customer_profile_files_admin_link}<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (74, 'staff', 'event-notification-to-staff', 'portuguese', 'Notificação de Evento (Calendário)', 'Próximo Evento - {event_title}', 'Olá {staff_firstname}! <br /><br />Este é um lembrete para o evento <a href=\"{event_link}\">{event_title}</a> agendado para {event_start_date}. <br /><br />Atenciosamente.', '', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (75, 'subscriptions', 'subscription-payment-requires-action', 'portuguese', 'Autorização de Cartão de Crédito Necessária - SCA', 'Importante: Confirme o pagamento da sua assinatura {subscription_name}', '<p>Olá {contact_firstname}</p>
<p><strong>Seu banco às vezes exige uma etapa adicional para garantir que uma transação online foi autorizada.</strong><br /><br />Devido à regulamentação europeia para proteger os consumidores, muitos pagamentos online agora exigem autenticação de dois fatores. Seu banco decide, em última instância, quando a autenticação é necessária para confirmar um pagamento, mas você pode notar esta etapa ao começar a pagar por um serviço ou quando o custo muda.<br /><br />Para pagar a assinatura <strong>{subscription_name}</strong>, você precisará confirmar seu pagamento clicando no seguinte link: <strong><a href="{subscription_authorize_payment_link}">{subscription_authorize_payment_link}</a></strong><br /><br />Para visualizar a assinatura, por favor, clique no seguinte link: <a href="{subscription_link}"><span>{subscription_link}</span></a><br />ou você pode fazer login em nossa área dedicada aqui: <a href="{crm_url}/login">{crm_url}/login</a> caso queira atualizar seu cartão de crédito ou visualizar as assinaturas às quais você está inscrito(a).<br /><br />Atenciosamente,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (76, 'invoice', 'invoice-due-notice', 'portuguese', 'Aviso de Vencimento de Fatura', 'Sua fatura {invoice_number} vencerá em breve', '<span style="font-size: 12pt;">Olá {contact_firstname} {contact_lastname}<br /><br /></span>Sua fatura <span style="font-size: 12pt;"><strong># {invoice_number} </strong>vencerá em <strong>{invoice_duedate}</strong></span><br /><br /><span style="font-size: 12pt;">Você pode visualizar a fatura no seguinte link: <a href="{invoice_link}">{invoice_number}</a></span><br /><br /><span style="font-size: 12pt;">Atenciosamente,</span><br /><span style="font-size: 12pt;">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (77, 'estimate_request', 'estimate-request-submitted-to-staff', 'portuguese', 'Solicitação de Orçamento Enviada (Enviado à Equipe)', 'Nova Solicitação de Orçamento Enviada', '<span> Olá,&nbsp;</span><br /><br />{estimate_request_email} enviou uma solicitação de orçamento através do formulário {estimate_request_form_name}.<br /><br />Você pode visualizar a solicitação no seguinte link: <a href="{estimate_request_link}">{estimate_request_link}</a><br /><br />==<br /><br />{estimate_request_submitted_data}<br /><br />Atenciosamente,<br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (78, 'estimate_request', 'estimate-request-assigned', 'portuguese', 'Solicitação de Orçamento Atribuída (Enviado à Equipe)', 'Nova Solicitação de Orçamento Atribuída', '<span> Olá {estimate_request_assigned},&nbsp;</span><br /><br />A solicitação de orçamento #{estimate_request_id} foi atribuída a você.<br /><br />Você pode visualizar a solicitação no seguinte link: <a href="{estimate_request_link}">{estimate_request_link}</a><br /><br />Atenciosamente,<br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (79, 'estimate_request', 'estimate-request-received-to-user', 'portuguese', 'Solicitação de Orçamento Recebida (Enviado ao Usuário)', 'Solicitação de Orçamento Recebida', 'Olá,<br /><br /><strong>Sua solicitação foi recebida.</strong><br /><br />Este e-mail é para informar que recebemos sua solicitação e entraremos em contato o mais breve possível com mais informações.<br /><br />Atenciosamente,<br />{email_signature}', '{companyname} | CRM', '', 0, 0, 0);
INSERT INTO "tblemailtemplates" VALUES (80, 'notifications', 'non-billed-tasks-reminder', 'portuguese', 'Lembrete de Tarefas Não Faturadas (enviado aos membros da equipe selecionados)', 'Ação necessária: Tarefas concluídas não faturadas', 'Olá {staff_firstname}<br><br>As seguintes tarefas estão marcadas como concluídas, mas ainda não foram faturadas:<br><br>{unbilled_tasks_list}<br><br>Atenciosamente,<br><br>{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (81, 'invoice', 'invoices-batch-payments', 'portuguese', 'Pagamentos de Faturas Registrados em Lote (Enviado ao Cliente)', 'Recebemos seus pagamentos', 'Olá {contact_firstname} {contact_lastname}<br><br>Obrigado(a) pelos pagamentos. Por favor, encontre os detalhes dos pagamentos abaixo:<br><br>{batch_payments_list}<br><br>Esperamos trabalhar com você.<br><br>Atenciosamente,<br><br>{email_signature}', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO "tblemailtemplates" VALUES (82, 'contract', 'contract-sign-reminder', 'portuguese', 'Lembrete de Assinatura de Contrato (Enviado ao Cliente)', 'Lembrete de Assinatura de Contrato', '<p>Olá {contact_firstname} {contact_lastname}<br /><br />Este é um lembrete para revisar e assinar o contrato:<a href="{contract_link}">{contract_subject}</a></p><p>Você pode visualizar e assinar visitando: <a href="{contract_link}">{contract_subject}</a></p><p><br />Esperamos trabalhar com você.<br /><br />Atenciosamente,<br /><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
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
DROP TABLE IF EXISTS "tblestimate_request_status";
CREATE TABLE "tblestimate_request_status" (
  "id" integer NOT NULL,
  "name" text(50) NOT NULL,
  "statusorder" integer,
  "color" text(10),
  "flag" text(30),
  PRIMARY KEY ("id")
);
INSERT INTO "tblestimate_request_status" VALUES (1, 'Cancelled', 1, '#808080', 'cancelled');
INSERT INTO "tblestimate_request_status" VALUES (2, 'Processing', 2, '#007bff', 'processing');
INSERT INTO "tblestimate_request_status" VALUES (3, 'Completed', 3, '#28a745', 'completed');
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
DROP TABLE IF EXISTS "tblexpenses_categories";
CREATE TABLE "tblexpenses_categories" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "description" text,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblfilter_defaults";
CREATE TABLE "tblfilter_defaults" (
  "filter_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  "identifier" text(191) NOT NULL,
  "view" text(191) NOT NULL,
  CONSTRAINT "tblfilter_defaults_ibfk_1" FOREIGN KEY ("filter_id") REFERENCES "tblfilters" ("id") ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT "tblfilter_defaults_ibfk_2" FOREIGN KEY ("staff_id") REFERENCES "tblstaff" ("staffid") ON DELETE CASCADE ON UPDATE RESTRICT
);
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
DROP TABLE IF EXISTS "tblform_question_box";
CREATE TABLE "tblform_question_box" (
  "boxid" integer NOT NULL,
  "boxtype" text(10) NOT NULL,
  "questionid" integer NOT NULL,
  PRIMARY KEY ("boxid")
);
DROP TABLE IF EXISTS "tblform_question_box_description";
CREATE TABLE "tblform_question_box_description" (
  "questionboxdescriptionid" integer NOT NULL,
  "description" text NOT NULL,
  "boxid" text NOT NULL,
  "questionid" integer NOT NULL,
  PRIMARY KEY ("questionboxdescriptionid")
);
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
DROP TABLE IF EXISTS "tblitems_groups";
CREATE TABLE "tblitems_groups" (
  "id" integer NOT NULL,
  "name" text(50) NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tblknowedge_base_article_feedback";
CREATE TABLE "tblknowedge_base_article_feedback" (
  "articleanswerid" integer NOT NULL,
  "articleid" integer NOT NULL,
  "answer" integer NOT NULL,
  "ip" text(40) NOT NULL,
  "date" text NOT NULL,
  PRIMARY KEY ("articleanswerid")
);
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
INSERT INTO "tblleads_email_integration" VALUES (1, 0, '', '', '', 10, 0, 0, 0, 'tls', 'INBOX', '', 1, 1, 'assigned', '', 0, 1, 0, 1);
DROP TABLE IF EXISTS "tblleads_sources";
CREATE TABLE "tblleads_sources" (
  "id" integer NOT NULL,
  "name" text(150) NOT NULL,
  PRIMARY KEY ("id")
);
INSERT INTO "tblleads_sources" VALUES (1, 'Google');
INSERT INTO "tblleads_sources" VALUES (2, 'Facebook');
DROP TABLE IF EXISTS "tblleads_status";
CREATE TABLE "tblleads_status" (
  "id" integer NOT NULL,
  "name" text(50) NOT NULL,
  "statusorder" integer,
  "color" text(10),
  "isdefault" integer NOT NULL,
  PRIMARY KEY ("id")
);
INSERT INTO "tblleads_status" VALUES (1, 'Customer', 1000, '#7cb342', 1);
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
DROP TABLE IF EXISTS "tblmigrations";
CREATE TABLE "tblmigrations" (
  "version" integer NOT NULL
);
INSERT INTO "tblmigrations" VALUES (330);
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
DROP TABLE IF EXISTS "tblmodules";
CREATE TABLE "tblmodules" (
  "id" integer NOT NULL,
  "module_name" text(55) NOT NULL,
  "installed_version" text(11) NOT NULL,
  "active" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tblnewsfeed_comment_likes";
CREATE TABLE "tblnewsfeed_comment_likes" (
  "id" integer NOT NULL,
  "postid" integer NOT NULL,
  "commentid" integer NOT NULL,
  "userid" integer NOT NULL,
  "dateliked" text NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tblnewsfeed_post_comments";
CREATE TABLE "tblnewsfeed_post_comments" (
  "id" integer NOT NULL,
  "content" text,
  "userid" integer NOT NULL,
  "postid" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tblnewsfeed_post_likes";
CREATE TABLE "tblnewsfeed_post_likes" (
  "id" integer NOT NULL,
  "postid" integer NOT NULL,
  "userid" integer NOT NULL,
  "dateliked" text NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tbloptions";
CREATE TABLE "tbloptions" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "value" text NOT NULL,
  "autoload" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);
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
INSERT INTO "tblpayment_modes" VALUES (1, 'Bank', NULL, 0, 0, 0, 1, 1);
DROP TABLE IF EXISTS "tblpinned_projects";
CREATE TABLE "tblpinned_projects" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblproject_members";
CREATE TABLE "tblproject_members" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "staff_id" integer NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tblproject_notes";
CREATE TABLE "tblproject_notes" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "content" text NOT NULL,
  "staff_id" integer NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tblproject_settings";
CREATE TABLE "tblproject_settings" (
  "id" integer NOT NULL,
  "project_id" integer NOT NULL,
  "name" text(100) NOT NULL,
  "value" text,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblproposal_comments";
CREATE TABLE "tblproposal_comments" (
  "id" integer NOT NULL,
  "content" text,
  "proposalid" integer NOT NULL,
  "staffid" integer NOT NULL,
  "dateadded" text NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblrelated_items";
CREATE TABLE "tblrelated_items" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(30) NOT NULL,
  "item_id" integer NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblroles";
CREATE TABLE "tblroles" (
  "roleid" integer NOT NULL,
  "name" text(150) NOT NULL,
  "permissions" text,
  PRIMARY KEY ("roleid")
);
INSERT INTO "tblroles" VALUES (1, 'Employee', NULL);
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
DROP TABLE IF EXISTS "tblservices";
CREATE TABLE "tblservices" (
  "serviceid" integer NOT NULL,
  "name" text(50) NOT NULL,
  PRIMARY KEY ("serviceid")
);
DROP TABLE IF EXISTS "tblsessions";
CREATE TABLE "tblsessions" (
  "id" text(128) NOT NULL,
  "ip_address" text(45) NOT NULL,
  "timestamp" integer NOT NULL,
  "data" blob NOT NULL,
  PRIMARY KEY ("id")
);
INSERT INTO "tblsessions" VALUES ('83712d5431ece64e817f70ff619ba888', '127.0.0.1', 1745309668, '__ci_last_regenerate|i:1745309664;_prev_url|s:38:"http://perfexcrm.test/production/index";staff_user_id|s:1:"1";staff_logged_in|b:1;setup-menu-open|s:0:"";red_url|s:22:"http://perfexcrm.test/";');
INSERT INTO "tblsessions" VALUES ('c68e7dab84d3f97b97727a8e872b9299', '::1', 1750862885, '__ci_last_regenerate|i:1750862826;_prev_url|s:27:"http://localhost:8765/admin";staff_user_id|s:1:"1";staff_logged_in|b:1;setup-menu-open|s:0:"";');
DROP TABLE IF EXISTS "tblshared_customer_files";
CREATE TABLE "tblshared_customer_files" (
  "file_id" integer NOT NULL,
  "contact_id" integer NOT NULL
);
DROP TABLE IF EXISTS "tblspam_filters";
CREATE TABLE "tblspam_filters" (
  "id" integer NOT NULL,
  "type" text(40) NOT NULL,
  "rel_type" text(10) NOT NULL,
  "value" text NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tblstaff_departments";
CREATE TABLE "tblstaff_departments" (
  "staffdepartmentid" integer NOT NULL,
  "staffid" integer NOT NULL,
  "departmentid" integer NOT NULL,
  PRIMARY KEY ("staffdepartmentid")
);
DROP TABLE IF EXISTS "tblstaff_permissions";
CREATE TABLE "tblstaff_permissions" (
  "staff_id" integer NOT NULL,
  "feature" text(40) NOT NULL,
  "capability" text(100) NOT NULL
);
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
DROP TABLE IF EXISTS "tbltaggables";
CREATE TABLE "tbltaggables" (
  "rel_id" integer NOT NULL,
  "rel_type" text(20) NOT NULL,
  "tag_id" integer NOT NULL,
  "tag_order" integer NOT NULL
);
DROP TABLE IF EXISTS "tbltags";
CREATE TABLE "tbltags" (
  "id" integer NOT NULL,
  "name" text(100) NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tbltask_assigned";
CREATE TABLE "tbltask_assigned" (
  "id" integer NOT NULL,
  "staffid" integer NOT NULL,
  "taskid" integer NOT NULL,
  "assigned_from" integer NOT NULL,
  "is_assigned_from_contact" integer(1) NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tbltask_followers";
CREATE TABLE "tbltask_followers" (
  "id" integer NOT NULL,
  "staffid" integer NOT NULL,
  "taskid" integer NOT NULL,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tbltasks_checklist_templates";
CREATE TABLE "tbltasks_checklist_templates" (
  "id" integer NOT NULL,
  "description" text,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tbltaxes";
CREATE TABLE "tbltaxes" (
  "id" integer NOT NULL,
  "name" text(100) NOT NULL,
  "taxrate" real(15,2) NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tbltemplates";
CREATE TABLE "tbltemplates" (
  "id" integer NOT NULL,
  "name" text(255) NOT NULL,
  "type" text(100) NOT NULL,
  "addedfrom" integer NOT NULL,
  "content" text,
  PRIMARY KEY ("id")
);
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
DROP TABLE IF EXISTS "tbltickets_predefined_replies";
CREATE TABLE "tbltickets_predefined_replies" (
  "id" integer NOT NULL,
  "name" text(191) NOT NULL,
  "message" text NOT NULL,
  PRIMARY KEY ("id")
);
DROP TABLE IF EXISTS "tbltickets_priorities";
CREATE TABLE "tbltickets_priorities" (
  "priorityid" integer NOT NULL,
  "name" text(50) NOT NULL,
  PRIMARY KEY ("priorityid")
);
INSERT INTO "tbltickets_priorities" VALUES (1, 'Baixo');
INSERT INTO "tbltickets_priorities" VALUES (2, 'Médio');
INSERT INTO "tbltickets_priorities" VALUES (3, 'Alto');
DROP TABLE IF EXISTS "tbltickets_status";
CREATE TABLE "tbltickets_status" (
  "ticketstatusid" integer NOT NULL,
  "name" text(50) NOT NULL,
  "isdefault" integer NOT NULL,
  "statuscolor" text(7),
  "statusorder" integer,
  PRIMARY KEY ("ticketstatusid")
);
INSERT INTO "tbltickets_status" VALUES (1, 'Aberto', 1, '#ff2d42', 1);
INSERT INTO "tbltickets_status" VALUES (2, 'Em progresso', 1, '#22c55e', 2);
INSERT INTO "tbltickets_status" VALUES (3, 'Respondido', 1, '#2563eb', 3);
INSERT INTO "tbltickets_status" VALUES (4, 'Pendente', 1, '#64748b', 4);
INSERT INTO "tbltickets_status" VALUES (5, 'Fechado', 1, '#03a9f4', 5);
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
DROP TABLE IF EXISTS "tbluser_auto_login";
CREATE TABLE "tbluser_auto_login" (
  "key_id" text(32) NOT NULL,
  "user_id" integer NOT NULL,
  "user_agent" text(150) NOT NULL,
  "last_ip" text(40) NOT NULL,
  "last_login" text NOT NULL,
  "staff" integer NOT NULL
);
INSERT INTO "tbluser_auto_login" VALUES ('988fbda842b1bb3c2662174e192489a6', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '::1', '2025-06-25 11:47:50', 1);
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
DROP TABLE IF EXISTS "tblviews_tracking";
CREATE TABLE "tblviews_tracking" (
  "id" integer NOT NULL,
  "rel_id" integer NOT NULL,
  "rel_type" text(40) NOT NULL,
  "date" text NOT NULL,
  "view_ip" text(40) NOT NULL,
  PRIMARY KEY ("id")
);
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
CREATE INDEX "staffid"
ON "tblactivity_log" (
  "staffid" ASC
);
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
CREATE INDEX "client"
ON "tblcontracts" (
  "client" ASC
);
CREATE INDEX "contract_type"
ON "tblcontracts" (
  "contract_type" ASC
);
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
CREATE INDEX "customer_id"
ON "tblcustomer_admins" (
  "customer_id" ASC
);
CREATE INDEX "staff_id"
ON "tblcustomer_admins" (
  "staff_id" ASC
);
CREATE INDEX "groupid"
ON "tblcustomer_groups" (
  "groupid" ASC
);
CREATE INDEX "name"
ON "tblcustomers_groups" (
  "name" ASC
);
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
CREATE INDEX "announcementid"
ON "tbldismissed_announcements" (
  "announcementid" ASC
);
CREATE INDEX "staff"
ON "tbldismissed_announcements" (
  "staff" ASC
);
CREATE INDEX "sale_agent"
ON "tblestimates" (
  "sale_agent" ASC
);
CREATE INDEX "status"
ON "tblestimates" (
  "status" ASC
);
CREATE INDEX "category"
ON "tblexpenses" (
  "category" ASC
);
CREATE INDEX "rel_id"
ON "tblfiles" (
  "rel_id" ASC
);
CREATE INDEX "rel_type"
ON "tblfiles" (
  "rel_type" ASC
);
CREATE INDEX "filter_id"
ON "tblfilter_defaults" (
  "filter_id" ASC
);
CREATE INDEX "invoiceid"
ON "tblinvoicepaymentrecords" (
  "invoiceid" ASC
);
CREATE INDEX "paymentmethod"
ON "tblinvoicepaymentrecords" (
  "paymentmethod" ASC
);
CREATE INDEX "total"
ON "tblinvoices" (
  "total" ASC
);
CREATE INDEX "itemid"
ON "tblitem_tax" (
  "itemid" ASC
);
CREATE INDEX "qty"
ON "tblitemable" (
  "qty" ASC
);
CREATE INDEX "rate"
ON "tblitemable" (
  "rate" ASC
);
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
CREATE INDEX "ci_sessions_timestamp"
ON "tblsessions" (
  "timestamp" ASC
);
CREATE INDEX "tax_id"
ON "tblsubscriptions" (
  "tax_id" ASC
);
CREATE INDEX "tag_id"
ON "tbltaggables" (
  "tag_id" ASC
);
CREATE INDEX "taskid"
ON "tbltask_assigned" (
  "taskid" ASC
);
CREATE INDEX "file_id"
ON "tbltask_comments" (
  "file_id" ASC
);
CREATE INDEX "kanban_order"
ON "tbltasks" (
  "kanban_order" ASC
);
CREATE INDEX "milestone"
ON "tbltasks" (
  "milestone" ASC
);
CREATE INDEX "task_id"
ON "tbltaskstimers" (
  "task_id" ASC
);
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
CREATE INDEX "invoice_id"
ON "tbltwocheckout_log" (
  "invoice_id" ASC
);
PRAGMA foreign_keys = true;