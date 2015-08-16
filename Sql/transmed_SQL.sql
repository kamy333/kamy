DROP VIEW IF EXISTS modele_pivot;
DROP VIEW IF EXISTS modele;
DROP VIEW IF EXISTS modele_pivot_visible_no;
DROP VIEW IF EXISTS modele_visible_no;
DROP VIEW IF EXISTS modele_pivot_visible_yes;
DROP VIEW IF EXISTS modele_visible_yes;
DROP VIEW IF EXISTS summary_by_course_date_program;
DROP TABLE IF EXISTS programmed_courses_modele;
DROP TABLE IF EXISTS programmed_courses;
DROP TABLE IF EXISTS courses;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS chauffeurs;
DROP TABLE IF EXISTS user_type;
DROP TABLE IF EXISTS clients;


DROP TABLE IF EXISTS clients;
CREATE TABLE clients (
  id int(11) NOT NULL AUTO_INCREMENT ,
  pseudo varchar(50) NOT NULL UNIQUE,
  liste_restrictive tinyint(1) NOT NULL DEFAULT 0 ,
  web_view varchar(50) DEFAULT NULL ,
  last_name varchar(50) ,
  first_name varchar(50) ,
  address varchar(50) DEFAULT NULL,
  cp varchar(50) DEFAULT NULL ,
  city varchar(50) DEFAULT NULL ,
  country varchar(50) DEFAULT NULL ,
  default_price decimal(10,2) DEFAULT '0.00',
  default_aller VARCHAR(70)DEFAULT NULL ,
  default_arrivee VARCHAR(70)DEFAULT NULL,
  liste_rank int(11),
  PRIMARY KEY (`id`),
  INDEX (pseudo)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (4, 'COLLINE', 1, 'COLLINE', 'COLLINE', '', null, null, 'Genève', 'Suisse', null, null, null, 1);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (5, 'AUTRES', 1, 'AUTRES', 'AUTRES', '', null, null, 'Genève', 'Suisse', null, null, null, 1);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (6, 'Tour_Patient', 1, 'Tour Patient', 'comptabilité', 'Service', 'Avenue J.-D. Maillard 3', '1217', 'Meyrin', 'Suisse', null, null, null, 2);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (7, 'Tour_Sang', 0, 'Tour Sang', 'comptabilité', 'Service', 'Avenue J.-D. Maillard 3', '1217', 'Meyrin', 'Suisse', null, null, null, 3);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (8, 'Carouge_Sang', 0, 'Carouge Sang', 'comptabilité', 'Service', 'Avenue J.-D. Maillard 3', '1217', 'Meyrin', 'Suisse', null, null, null, 4);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (9, 'AURELIE', 0, 'Aurélie AI', 'ASSEO', 'Aurélie', 'Route de Pressinge, 20', '1214', 'Puplinge', 'Suisse', 60, null, null, 50);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (10, 'AURELIE_Med', 0, 'Aurélie Medecin', 'ASSEO', 'Aurélie', 'Route de Pressinge, 20', '1214', 'Puplinge', 'Suisse', 60, null, null, 50);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (11, 'ELZIZOUNE', 1, 'ELZIZOUNE Bouchaib', 'ELZIZOUNE', 'Bouchaib', 'Rue de Berne 60', '1202', 'Genève', 'Suisse', 45, 'Domicile', 'HUG Dialyse', 50);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (12, 'NAF_Kamy', 0, 'NAFISSPOUR Privee', 'NAFISSPOUR', 'Kamran', 'Rue des Vollandes 68', '1207', 'Genève', 'Suisse', null, null, null, 50);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (13, 'NAFISSPOUR', 1, 'NAFISSPOUR Travail', 'NAFISSPOUR', 'Kamran', 'Rue des Vollandes 68', '1207', 'Genève', 'Suisse', 40, 'Travail', 'Domicile', 50);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (14, 'AUDE', 0, ' Aude', '', 'Aude', 'Route de Saint-Julien 297', '1258', 'Perly', 'Suisse', null, null, null, 100);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (15, 'TAG', 0, ' Isaac', '', 'Isaac', 'Case postale 575', '1211', 'Genève 13', 'Suisse', null, null, null, 100);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (16, 'ALOHA', 0, 'ALOHA', 'HUBER', 'Rolf', 'Rue de la Fontaine 13', '1204', 'Genève', 'Suisse', null, null, null, 100);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (17, 'PARTNERS', 0, 'BOUDINA James', 'BOUDINA', 'James', 'Route de Saint-Georges 83', '1213', 'Petit-Lancy', 'Suisse', null, null, null, 100);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (18, 'Mines_ICBL', 0, 'BRASSIER Audrey', 'BRASSIER', 'Audrey', 'Rue de Cornavin 9', '1201', 'Genève', 'Suisse', null, null, null, 100);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (19, 'ALBER', 0, 'ALBER Clotilde', 'ALBER', 'Clotilde', 'Avenue de Champel 64', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (20, 'AMEZ_DROZ', 0, 'AMEZ-DROZ Edouard', 'AMEZ-DROZ', 'Edouard', 'Chemin de la Vieille-Ferme 8', '1255', 'Veyrier', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (21, 'AMREIN', 0, 'AMREIN Suzanne', 'AMREIN', 'Suzanne', 'Cité Vieussieux 8', '1203', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (22, 'ANDEREGG', 0, 'ANDEREGG Paul', 'ANDEREGG', 'Paul', 'Rue du Vieux Moulin 9', '1213', 'OnexLE', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (23, 'ANDREY', 0, 'ANDREY Christophe', 'ANDREY', 'Christophe', 'Rue Gardiol 5', '1218', 'Le Grand-Saconnex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (24, 'ANKER_M', 0, 'ANKER Marc', 'ANKER', 'Marc', 'Promenade de l''Europe 59', '1203', 'Genève', 'Suisse', 40, 'Domicile', 'Physio, 26 rue Guiseppe Motta', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (25, 'ANKER', 0, 'ANKER Yvonne', 'ANKER', 'Yvonne', 'Promenade de l''Europe 59', '1203', 'Genève', 'Suisse', 40, 'Domicile', 'Physio, 26 rue Guiseppe Motta', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (26, 'ARIAS', 0, 'ARIAS José-Miguel', 'ARIAS', 'José-Miguel', 'Chemin Bournoud 13-15', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (27, 'ARMAND', 0, 'ARMAND Henry', 'ARMAND', 'Henry', 'Chemin de la Caroline 24', '1213', 'Petit - Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (28, 'AUBERT', 0, 'AUBERT Roselyne', 'AUBERT', 'Roselyne', 'Rue de Bourgogne 2', '1203', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (29, 'AVONDO', 0, 'AVONDO Marie', 'AVONDO', 'Marie', 'Avenue de la Pruley 44', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (30, 'BALBWIN', 0, 'BALDWIN Théo', 'BALDWIN', 'Théo', 'Grand-Montfleury 50', '1290', 'Versoix', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (31, 'BAZZACCHI', 0, 'BAZZACCHI Lucienne', 'BAZZACCHI', 'Lucienne', 'Grand-Pré 37', '1202', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (32, 'BEGER', 0, 'BEGER Iris', 'BEGER', 'Iris', 'Chemin Perrault-de-Jotemps 9
', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (33, 'BENOIST_FILLE', 0, 'BENOIST Stéphanie', 'BENOIST', 'Stéphanie', 'C§hemin du Velours 20', '1231', 'Conches', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (34, 'BERNASCONI', 0, 'BERNASCONI Alexandre', 'BERNASCONI', 'Alexandre', 'Chemin des Crêts-de-Pregny 7A', '1218', 'le Grand-Saconnex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (35, 'BIBES', 0, 'BIBES Jeanne', 'BIBES', 'Jeanne', 'Rue de la Poterie 20', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (36, 'BLANDIN', 0, 'BLANDIN Jean-François', 'BLANDIN', 'Jean-François', 'Chemin Crétoillet 30', '1256', 'Troinex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (37, 'BLOEDHORN', 0, 'BLOEDHORN Alexandre', 'BLOEDHORN', 'Alexandre', 'Rue de la Tambourine 38', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (38, 'BOLOMEY', 0, 'BOLOMEY Ignace', 'BOLOMEY', 'Ignace', 'Chemin de la Citadelle 71', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (39, 'BONZON', 0, 'BONZON Edith', 'BONZON', 'Edith', 'Rue Soubeyran 8', '1203', 'Genève', 'Suisse', 40, 'Domicile', 'Physio, 10 rue Galatin', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (40, 'BONZON_Mich', 0, 'BONZON Michèle', 'BONZON', 'Michèle', 'Chemin de Blonay 4', '1234', 'Vessy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (41, 'BORNOZ', 0, 'BORNOZ Marcel', 'BORNOZ', 'Marcel', 'Avenue des Morgines 37', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (42, 'BOSSENS', 0, 'BOSSENS Hélène', 'BOSSENS', 'Hélène', 'Chemin Briquet 26', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (43, 'BOSTEELS', 0, 'BOSTEELS Michel', 'BOSTEELS', 'Michel', 'Chemin de Gaillard 276', ' 01160', 'Challex', 'France', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (44, 'BOUCHET', 0, 'BOUCHET Raymond', 'BOUCHET', 'Raymond', 'Rue Fort-Barreau 19', '1201', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (45, 'BROILLET', 0, 'BROILLET Bernard', 'BROILLET', 'Bernard', 'Avenue du Pont-Butin 70', '1213', 'Petit-Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (46, 'BUDEYRI', 0, 'BUDEYRI Wijdan', 'BUDEYRI', 'Wijdan', 'Rue du Nant 34', '1207', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (47, 'BURGENER', 0, 'BURGENER André', 'BURGENER', 'André', 'Rue de Moillebeau 57', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (48, 'BURNAT', 0, 'BURNAT Janine', 'BURNAT', 'Janine', 'Place Sigsimond 2', '1227', 'Carouge', 'Suisse', 35, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (49, 'CARNAL_Mme', 0, 'CARNAL Liliane', 'CARNAL', 'Liliane', 'Rue de la Calle 19', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (50, 'CARNAL_R', 0, 'CARNAL Raymond', 'CARNAL', 'Raymond', 'Rue de la Calle 19', '1213', 'Onex', 'Suisse', 45, 'Domicile', 'HUG Dialyse', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (51, 'CARUANA', 0, 'CARUANA Paul', 'CARUANA', 'Paul', 'Maison familiale du Genevois', '74160', 'Collonge s/Salève', 'France', 60, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (52, 'CERROTI', 0, 'CERROTI Georges', 'CERROTI', 'Georges', 'Avenue du Lignon 21', '1219', 'Le Lignon', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (53, 'CHARLET', 0, 'CHARLET Sylvette', 'CHARLET', 'Sylvette', 'Avenue de Crozet 4', '1219', 'Châtelaine', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (54, 'CHERVAZ', 0, 'CHERVAZ Gérard', 'CHERVAZ', 'Gérard', 'Chemin De-La-Montagne 106', '1224', 'Chêne-Bougeries', 'Suisse', 50, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (55, 'CHERVET', 0, 'CHERVET Alfred', 'CHERVET', 'Alfred', 'Rue des Bossons 19', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (56, 'CHEVALLIER', 0, 'CHEVALLIER Françoise', 'CHEVALLIER', 'Françoise', 'Rue des Délices 1', '1204', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (57, 'CHTIOUI', 0, 'CHTIOUI Sanaa', 'CHTIOUI', 'Sanaa', 'Quai du Seujet 32', '1201', 'Genève', 'Suisse', 40, 'Domicile', 'Service Industriel de Genève', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (58, 'CLERC', 0, 'CLERC', 'CLERC', 'Jean-daniel', 'Rue des Bossons 15', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (59, 'COLOMB', 0, 'COLOMB Gilles', 'COLOMB', 'Gilles', 'Chemin du Villaret 1', '1224', 'Chêne-Bougeries', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (60, 'COSTA', 0, 'COSTA Tania', 'COSTA', 'Tania', 'Avenue de Feuillasse 1', '1217', 'Meyrin', 'Suisse', 45, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (61, 'COURT', 0, 'COURT Elisa', 'COURT', 'Elisa', 'Quai du Seulet 34', '1201', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (62, 'DAUDIN', 0, 'DAUDIN Jean', 'DAUDIN', 'Jean', 'Rue de Lyon 65bis', '1203', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (63, 'DE_MONFALCON', 0, 'DE MONFALCON Juliette', 'DE MONFALCON', 'Juliette', 'Rue des Vollandes 1', '1207', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (64, 'DE_MORAWITZ', 0, 'DE MORAWITZ Karl', 'DE MORAWITZ', 'Karl', 'Place du Marché 15', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (65, 'DE_REMY', 0, 'DE REMY Jean', 'DE REMY', 'Jean', 'Plateau de Champel 18', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (66, 'DECONYNK', 0, 'DECONYNK Yvon', 'DECONYNK', 'Yvon', 'Chemin de la Prulay 72', '1217', 'Meyrin', 'Suisse', 45, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (67, 'DERBIGNY', 0, 'DERBIGNY Jeanne', 'DERBIGNY', 'Jeanne', 'Route d''Aire-la-Ville 226', '1242', 'Satigny', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (68, 'DESAUTEZ', 0, 'DESAUTEZ Pauline', 'DESAUTEZ', 'Pauline', 'Rue de Livron 29', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (69, 'DESCOMBES', 0, 'DESCOMBES Michel', 'DESCOMBES', 'Michel', 'Rue des Bossons 24', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (70, 'DI_BENEDETTO_Cal', 0, 'DI BENEDETTO Calogero', 'DI BENEDETTO', 'Calogero', 'Chemin Longe-l''Aire 18', '1212', 'Grand-Lancy', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (71, 'DI_BENEDETTO', 0, 'DI BENEDETTO Margueritte', 'DI BENEDETTO', 'Margueritte', 'Chemin Longe-l''Aire 18', '1212', 'Grand-Lancy', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (72, 'DOCTOR', 0, 'DOCTOR Narad', 'DOCTOR', 'Narad', 'Chemin de Pont-Céard 42', '1290', 'Versoix', 'Suisse', 45, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (73, 'DORSAZ', 0, 'DORSAZ Agnès', 'DORSAZ', 'Agnès', 'Avenue Bois-de-la-Chapelle 9', '1213', 'Petit-Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (74, 'DUBOIS', 0, 'DUBOIS Marie-Jeanne', 'DUBOIS', 'Marie-Jeanne', 'Chemin Moïse-Duboule 17', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (75, 'DUFRENE', 0, 'DUFRÊNE Chantal', 'DUFRÊNE', 'Chantal', 'Rue Curé-Descloud 17', '1226', 'Thônex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (76, 'DUMONT', 0, 'DUMONT Benoît', 'DUMONT', 'Benoît', 'Avenue Eugène-Pittard 11', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (77, 'DUPERREX', 0, 'DUPERREX Aloys', 'DUPERREX', 'Aloys', 'Rue de Monbrillant 61', '1202', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (78, 'EHRAT', 0, 'EHRAT Danièle', 'EHRAT', 'Danièle', 'Avenue Peschier 16', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (79, 'ELOUARET', 0, 'ELOUARET Soraya', 'ELOUARET', 'Soraya', 'Rue de Bandol 12', '1213', 'Onex', 'Suisse', 30, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (80, 'FARTACH_Mme', 0, 'FARTACH  Bernadette', 'FARTACH', ' Bernadette', 'Chemin de la Tourelle 16', '1209', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (81, 'FARTACH_Suz', 0, 'FARTACH Suzanne', 'FARTACH', 'Suzanne', 'Ecole de Médecine 16', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (82, 'FAUQUEX', 0, 'FAUQUEX Jean-Paul  ', 'FAUQUEX', 'Jean-Paul  ', 'Rue des Minoteries 7', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (83, 'FAVRE_Puplinge', 0, 'FAVRE Christianne', 'FAVRE', 'Christianne', 'Chemin de Pré-Marquis 7b', '1241', 'Puplinge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (84, 'FAVRE_Onex', 0, 'FAVRE Ruth', 'FAVRE', 'Ruth', 'Chemin de la Calle 38', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (85, 'FAVRE_ANNE', 0, 'FAVRE-LUISIER  Anne Marie', 'FAVRE-LUISIER ', 'Anne Marie', 'Route de la Capite 157', '1222', 'Vésenaz', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (86, 'FELL', 0, 'FELL Christine', 'FELL', 'Christine', 'Chemin Colladon 22', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (87, 'FIRME', 0, 'FIRME José Manuel', 'FIRME', 'José Manuel', 'rue des peupliers 6', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (88, 'FLAHAULT', 0, 'FLAHAULT Françoise', 'FLAHAULT', 'Françoise', 'Rue de Genève 94', '1226', 'Thônex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (89, 'FORAY_Herve', 0, 'FORAY Hervé', 'FORAY', 'Hervé', 'Avenue de Mategnin 59', '1217', 'Meyrin', 'Suisse', 35, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (90, 'FORAY_Mme', 0, 'FORAY Roberte', 'FORAY', 'Roberte', 'Avenue de Mategnin 49', '1217', 'Meyrin', 'Suisse', 35, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (91, 'FOURNIER', 0, 'FOURNIER Charles', 'FOURNIER', 'Charles', 'Rue Charles-Bonnet 10', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (92, 'FRACHET', 0, 'FRACHET Margueritte', 'FRACHET', 'Margueritte', 'Avenue de Joli-Mont 3', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (93, 'GARBANI', 0, 'GARBANI Roger', 'GARBANI', 'Roger', 'Rue des Allobroges 13', '1227', 'Les Acacias', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (94, 'GAY_BALMAT', 0, 'GAY-BALMAT Jeannine', 'GAY-BALMAT', 'Jeannine', 'Boulevard du Pont-d''Arve 44', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (95, 'GIANOLI', 0, 'GIANOLI Carlo', 'GIANOLI', 'Carlo', 'Avenue du Lignon 20', '1219', 'Le Lignon', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (96, 'GIAUQUE', 0, 'GIAUQUE Rémy', 'GIAUQUE', 'Rémy', 'Rue des Bossons 17', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (97, 'GIGON', 0, 'GIGON Jean-Pierre', 'GIGON', 'Jean-Pierre', 'Rue Pestalozzi 1', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (98, 'GIGON_Mme', 0, 'GIGON Radmila', 'GIGON', 'Radmila', 'Rue Pestalozzi 1', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (99, 'VM_Gilabert', 0, 'GILABERT ', 'GILABERT', '', 'Ch. Etienne-Chennaz 14', '1226', 'Thônex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (100, 'GIRAUD', 0, 'GIRAUD Christian', 'GIRAUD', 'Christian', 'Chemin de Maisonneuve 12c', '1219', 'Châtelaine', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (101, 'GONZALEZ', 0, 'GONZALEZ Antonio', 'GONZALEZ', 'Antonio', 'Route de Meyrin 17', '1202', 'Genève', 'Suisse', 40, 'Domicile', 'Cressy Santé, Physio', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (102, 'GORGE', 0, 'GORGE Pierre', 'GORGE', 'Pierre', 'Chemin de l´Ancien-Péage 2', '1290', 'Versoix', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (103, 'GRANFAR', 0, 'GRANFAR Ebrahim', 'GRANFAR', 'Ebrahim', 'Plateau de Frontenex 9C', '1223', 'Cologny', 'Suisse', 45, 'Domicile', 'Relais Dumas, Grand-Saconnex', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (104, 'GRANFAR_Mme', 0, 'GRANFAR Vida', 'GRANFAR', 'Vida', 'Plateau de Frontenex 9C', '1223', 'Cologny', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (105, 'GRIN', 0, 'GRIN Denis', 'GRIN', 'Denis', 'Avenue Wendt 38', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (106, 'GROSSE', 0, 'GROSSE Christel', 'GROSSE', 'Christel', 'Rue du Loup 3', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (107, 'GUILLERMIN', 0, 'GUILLERMIN Jean', 'GUILLERMIN', 'Jean', 'Route de Bernex 392', '1233', 'Bernex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (108, 'CHRISTINE', 0, 'GUTKNECHT Christine', 'GUTKNECHT', 'Christine', 'Nant de Crève-Cœur 8', '1290', 'Versoix', 'Suisse', 45, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (109, 'GUTKNECHT', 0, 'GUTKNECHT Christine', 'GUTKNECHT', 'Christine', 'Nant de Crève-Cœur 8', '1290', 'Versoix', 'Suisse', 45, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (110, 'HAAS', 0, 'HAAS Karoline', 'HAAS', 'Karoline', 'Chemin de Saule 94', '1233', 'Bernex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (111, 'HALPERIN', 0, 'HALPÉRIN Noemi', 'HALPÉRIN', 'Noemi', 'Avenue Alfred-Bertrand 13', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (112, 'HAUSSER', 0, 'HAUSSER Josianne', 'HAUSSER', 'Josianne', 'Chemin des Rayes 33', '1222', 'Vésenaz', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (113, 'HERZI', 0, 'HERZI Taoufik', 'HERZI', 'Taoufik', 'Route d''Hermance 296', '1229', 'Anières', 'Suisse', 45, 'Domicile', 'Hôpital de Beau-Séjour', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (114, 'HEURTEUX', 0, 'HEURTEUX Philippe', 'HEURTEUX', 'Philippe', 'Route d''Hermance 401', '1229', 'Anières', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (115, 'HORVATH', 0, 'HORVATH Giovanna', 'HORVATH', 'Giovanna', 'Rue de Bourgogne 2', '1203', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (116, 'HUISSOUD', 0, 'HUISSOUD Maurice', 'HUISSOUD', 'Maurice', 'Chemin Etienne-Chennaz 10', '1226', 'Thônex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (117, 'ILG', 0, 'ILG Colette', 'ILG', 'Colette', 'Chemin des Tulipiers 23', '1208', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (118, 'CHO_IMERETINSKY', 0, 'IMERETINSKY Nadeja', 'IMERETINSKY', 'Nadeja', 'Route des Jurets 12', '1244', 'Choulex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (119, 'IMHOF', 0, 'IMHOF Edouard', 'IMHOF', 'Edouard', 'Rue Vautier 26', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (120, 'INEICHEN', 0, 'INEICHEN Marie-Elisabeth', 'INEICHEN', 'Marie-Elisabeth', 'Avenue Calas 20', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (121, 'ROBERTA', 0, 'ISABELLA-VALENZI Roberta', 'ISABELLA-VALENZI', 'Roberta', 'Rue de la Croix-du-Levant 7', '1220', 'Les Avanchets', 'Suisse', 50, 'Domicile', 'Centre de jour Solaris, Collonge-Bellerive', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (122, 'JANNER', 0, 'JANNER Claude', 'JANNER', 'Claude', 'Avenue Wendt 23', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (123, 'JEANNET', 0, 'JEANNET Madeleine Pierrette', 'JEANNET', 'Madeleine Pierrette', 'Chemin des Coquelicots 29', '1214', 'Vernier', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (124, 'KHAN_Mme', 0, 'KHAN Shamim', 'KHAN', 'Shamim', 'Chemin des Bugnons 10', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (125, 'KOCHER', 0, 'KOCHER ZELLER Gaby', 'KOCHER ZELLER', 'Gaby', 'Chemin Rieu 10', '1208', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (126, 'KRASNOPOLSKY', 0, 'KRASNOPOLSKY Lucie', 'KRASNOPOLSKY', 'Lucie', 'Route de Frontenex 51', '1207', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (127, 'KREBS', 0, 'KREBS André', 'KREBS', 'André', 'Avenue d''Aïre 89', '1203', 'Genève', 'Suisse', 35, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (128, 'LALIVE', 0, 'LALIVE D''EPINAY Pierre', 'LALIVE D''EPINAY', 'Pierre', 'Rue des Sources 13', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (129, 'LEHR', 0, 'LEHR-BYRDE Paule', 'LEHR-BYRDE', 'Paule', 'Chemin de Grange-Falquet 51', '1224', 'Chêne-Bougeries', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (130, 'LEQUINT', 0, 'LEQUINT Claudine', 'LEQUINT', 'Claudine', 'Chemin de Chapelly 22', '1226', 'Thônex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (131, 'LEVY', 0, 'LEVY Melita', 'LEVY', 'Melita', 'Rue Robert-De-Traz 2', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (132, 'LIARDON', 0, 'LIARDON Lydie', 'LIARDON', 'Lydie', 'Quai Charles-Page 45', '1205', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (133, 'LIFTON', 0, 'LIFTON Danielle', 'LIFTON', 'Danielle', 'Lotissement Trélatoun 77', '01170', 'Cessy', 'France', 60, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (134, 'LINDER', 0, 'LINDER Willi', 'LINDER', 'Willi', 'Rue Carteret 38', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (135, 'LUCINI', 0, 'LUCINI Lily', 'LUCINI', 'Lily', 'Route des Jurets 12', '1244', 'Choulex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (136, 'LUGASSY', 0, 'LUGASSY Raphaël', 'LUGASSY', 'Raphaël', 'Route de Chêne 70', '1208', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (137, 'MAGNIN', 0, 'MAGNIN Mario', 'MAGNIN', 'Mario', 'Chemin Briquet 18', '1218', 'Le Grand-Saconnex', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (138, 'MAIO', 0, 'MAIO Sabatino', 'MAIO', 'Sabatino', 'Avenue de Thônex 8', '1225', 'Chêne-Bourg', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (139, 'MALEH', 0, 'MALEH Suha', 'MALEH', 'Suha', 'Route de Florissant 70', '1206', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (140, 'MANSON', 0, 'MANSON-CAEN Joëlle', 'MANSON-CAEN', 'Joëlle', 'Avenue d''Aïre 73B', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (141, 'MARCHAND', 0, 'MARCHAND Chantal', 'MARCHAND', 'Chantal', 'Rue François Besson 14', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (142, 'MARES', 0, 'MARES Eketharrina', 'MARES', 'Eketharrina', 'Avenue Ernest-Pictet 16', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (143, 'MARESCA', 0, 'MARESCA Gisela', 'MARESCA', 'Gisela', 'Rue de la Dôle 2', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (144, 'MARTIN_MA', 0, 'MARTIN Marie-Augusta', 'MARTIN', 'Marie-Augusta', 'Cours Saint-Pierre 1', '1204', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (145, 'MATHIEU', 0, 'MATHIEU ', 'MATHIEU', '', 'Chemin du Pré-du-Couvent 1', '1224', 'Chêne-Bougeries', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (146, 'MATHYS', 0, 'MATHYS Jean', 'MATHYS', 'Jean', 'Chemin Briquet 20', '1209', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (147, 'MATHYS_Simone', 0, 'MATHYS Simone', 'MATHYS', 'Simone', 'Chemin Briquet 20', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (148, 'MAURON', 0, 'MAURON Francine', 'MAURON', 'Francine', 'Rue du Grand Pré 30', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (149, 'MECCA', 0, 'MECCA Vincenzo', 'MECCA', 'Vincenzo', 'Rue Caroline 53', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (150, 'MESIN', 0, 'MESIN Mehmet', 'MESIN', 'Mehmet', 'Chemin du Fief-de-Chapitre 9', '1213', 'Petit-Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (151, 'MESOT', 0, 'MESOT André', 'MESOT', 'André', 'Chemin de la Mère Voie 78', '1228', 'Plan-les-Ouates', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (152, 'MEYLAN', 0, 'MEYLAN xxx', 'MEYLAN', 'xxx', 'Chemin de Saule 10', '1233', 'Bernex', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (153, 'MONNAY_Mariette', 0, 'MONNAY Mariette', 'MONNAY', 'Mariette', 'Route d''Aïre 141', '1219', 'Aïre', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (154, 'MOTTET_Pat', 0, 'MOTTET Patricia', 'MOTTET', 'Patricia', 'Route de Frontenex 37', '1207', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (155, 'MULLER', 0, 'MULLER Elisabeth', 'MULLER', 'Elisabeth', 'Rue Henri-Mussard 14', '1208', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (156, 'MUNSPERGER', 0, 'MUNSPERGER Johann', 'MUNSPERGER', 'Johann', 'Avenue François-Besson 20', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (157, 'MURATOVIC', 0, 'MURATOVIC Enver', 'MURATOVIC', 'Enver', 'Avenue Louis-Casaï 39', '1220', 'Les Avanchets', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (158, 'MURISIER', 0, 'MURISIER Etienne', 'MURISIER', 'Etienne', 'Chemin du Stade 7A', '1252', 'Meinier', 'Suisse', 45, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (159, 'MUSINA', 0, 'MUSINA Jean', 'MUSINA', 'Jean', 'Rue Adhémar-Fabri 4', '1201', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (160, 'MUTZENBERG', 0, 'MUTZENBERG Andrée', 'MUTZENBERG', 'Andrée', 'Avenue du Mail 24', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (161, 'MUXUDIIN', 0, 'MUXUDIIN KHAALI Abuukar', 'MUXUDIIN KHAALI', 'Abuukar', 'Rue des Lilas 11', '1202', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (162, 'Neuenschwander', 0, 'NEUENSCHWANDER Irène', 'NEUENSCHWANDER', 'Irène', 'Route de Chancy 154', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (163, 'NICOLA', 0, 'NICOLA Jacques-Bernard', 'NICOLA', 'Jacques-Bernard', 'Chemin Fief-de-Chapitre 10', '1213', 'Petit-Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (164, 'NIEMINEN', 0, 'NIEMINEN Leena', 'NIEMINEN', 'Leena', 'Rue Marius Cadoz 204', '01170', 'Gex', 'France', 60, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (165, 'NORTE', 0, 'NORTE Diane', 'NORTE', 'Diane', 'Communes Réunies 72', '1212', 'Gand-Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (166, 'ODEMS_', 0, 'ODEMS  Mary-Ann', 'ODEMS ', 'Mary-Ann', 'Rue de la Servette 71', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (167, 'OHANA', 0, 'OHANA Olivier Paul', 'OHANA', 'Olivier Paul', 'Chemin des Crêts 10', '01610', 'Saint Genis ', 'France', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (168, 'MOMO', 0, 'OMAIS Mohamed', 'OMAIS', 'Mohamed', 'Rue Daniel Gervil, 17', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (169, 'ORTEGA', 0, 'ORTEGA Carmen', 'ORTEGA', 'Carmen', 'Avenue du Gros-Chêne 37', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (170, 'PACHON', 0, 'PACHON Roger', 'PACHON', 'Roger', 'Chemin des Vidolets 25', '1214', 'Vernier', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (171, 'PANT', 0, 'PANT Sudhir', 'PANT', 'Sudhir', 'Rue Cherbuliez 7', '1207', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (172, 'PAUX', 0, 'PAUX Marcelle', 'PAUX', 'Marcelle', 'Rue Vermont 31', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (173, 'PERRNOUD', 0, 'PERRNOUD Jean-Pierre', 'PERRNOUD', 'Jean-Pierre', 'Chemin de Saule 98', '1233', 'Bernex', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (174, 'PFAUTI', 0, 'PFAUTI Marc', 'PFAUTI', 'Marc', 'Chemin des Mouilles 3', '1213', 'Petit-Lancy', 'Suisse', 35, 'Domicile', 'Dialyse GMO, Onex', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (175, 'PFAUTI1', 0, 'PFAUTI Marc', 'PFAUTI', 'Marc', 'Chemin des Mouilles 3', '1213', 'Petit-Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (176, 'PIGUET_Adèle', 0, 'PIGUET Adda Marcel', 'PIGUET', 'Adda Marcel', 'Avenue Vibert 17', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (177, 'PIGUET', 0, 'PIGUET Martiale', 'PIGUET', 'Martiale', 'Chemin De-Vincy 3', '1202', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (178, 'PILLET_France', 0, 'PILLET Annamma', 'PILLET', 'Annamma', 'Rue du Château 10', '01170', 'Cessy', 'France', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (179, 'PILLOUD', 0, 'PILLOUD Nicolas', 'PILLOUD', 'Nicolas', 'ManqueManque', null, 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (180, 'PISONI', 0, 'PISONI Vladimir', 'PISONI', 'Vladimir', 'Boid-dde-la-Chapelle 67', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (181, 'PLOJOUX', 0, 'PLOJOUX Marie-Noëlle', 'PLOJOUX', 'Marie-Noëlle', 'Route d''Aire-la-Ville 219', '1242', 'Satigny', 'Suisse', 60, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (182, 'POSS', 0, 'POSS Marie-Louise', 'POSS', 'Marie-Louise', 'Route de Bernex 359', '1233', 'Bernex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (183, 'PROBST_Mme', 0, 'PROBST Liliane', 'PROBST', 'Liliane', 'Rue du Comte-Géraud 19', '1213', 'Onex', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (184, 'PROBST_Walter', 0, 'PROBST Walter', 'PROBST', 'Walter', 'Rue du Comte-Géraud 19', '1213', 'Onex', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (185, 'PROUZET', 0, 'PROUZET René', 'PROUZET', 'René', 'Avenue Wendt 1', '1203', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (186, 'PYTHON', 0, 'PYTHON Georges', 'PYTHON', 'Georges', 'Chemin Taverney 12', '1218', 'Le Grand-Saconnex', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (187, 'VM_RAEMY', 0, 'RAEMY Margit', 'RAEMY', 'Margit', 'Ch. Etienne-Chennaz 14', '1226', 'Thônex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (188, 'RANIERI', 0, 'RANIERI Sabine', 'RANIERI', 'Sabine', 'Rue de la Fontenette 28', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (189, 'RANIERIE', 0, 'RANIERIE Sabine', 'RANIERIE', 'Sabine', 'Rue de la Fontenette 28', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (190, 'RAY', 0, 'RAY Clelia', 'RAY', 'Clelia', 'Quai du Seujet 32', '1201', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (191, 'RAYMONDON', 0, 'RAYMONDON Jacques', 'RAYMONDON', 'Jacques', 'Route d''Avully 107', '1237', 'Avully', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (192, 'REBMANN', 0, 'REBMANN Véréna', 'REBMANN', 'Véréna', 'Rue de Vermont 16', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (193, 'RENCHET', 0, 'RENCHET Georges', 'RENCHET', 'Georges', 'Chemin de la Bâtie 7', '1213', 'Petit-Lancy', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (194, 'RENFER', 0, 'RENFER Marcel', 'RENFER', 'Marcel', 'Rue de la Dôle 18', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (195, 'RICCARDELLI', 0, 'RICCARDELLI Maria', 'RICCARDELLI', 'Maria', 'Avenue du Ligon 50-53', '1219', 'Le Lignon', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (196, 'RITSCHARD', 0, 'RITSCHARD ', 'RITSCHARD', '', 'Rue Cavour 3', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (197, 'RITSCHARD_Rudolf', 0, 'RITSCHARD Jure Rudolf', 'RITSCHARD', 'Jure Rudolf', 'Route de Chancy 98', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (198, 'RKIZA', 0, 'RKIZA Silvia', 'RKIZA', 'Silvia', 'Avenue d''Aire 91A', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (199, 'ROCHANAKORN', 0, 'ROCHANAKORN Kasidis', 'ROCHANAKORN', 'Kasidis', 'Chemin Sansonnets 4', '1291', 'Commugny', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (200, 'ROCHAT', 0, 'ROCHAT Philippe', 'ROCHAT', 'Philippe', 'Rue Emile-Nicolet 13', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (201, 'RODAK', 0, 'RODAK Irène', 'RODAK', 'Irène', 'Chemin de la Charrue 11', '1218', 'Le Grand-Saconnex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (202, 'ROLLIER', 0, 'ROLLIER Jean-Pierre', 'ROLLIER', 'Jean-Pierre', 'Avenue du Lignon 53', '1219', 'Le Lignon', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (203, 'CHO_Rosset', 0, 'ROSSET Jacqueline', 'ROSSET', 'Jacqueline', 'Route des Jurets 12', '1244', 'Choulex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (204, 'ROSSET', 0, 'ROSSET René', 'ROSSET', 'René', 'Rue Dancet 3', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (205, 'RUSCITO', 0, 'RUSCITO Bruno', 'RUSCITO', 'Bruno', 'Route des Vainges 282', '74380', 'Nangy', 'France', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (206, 'SALLIN', 0, 'SALLIN Marc', 'SALLIN', 'Marc', 'Parc Dinu-Lipatti 5', '1225', 'Chêne-Bourg', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (207, 'SALZ', 0, 'SALZMANN Angèle', 'SALZMANN', 'Angèle', 'Route de Malagnou 16', '1208', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (208, 'SALZMANN', 0, 'SALZMANN Johana', 'SALZMANN', 'Johana', 'Avenue des Cavaliers Avenue des Cavaliers 5', '1224', 'Chêne-Bougeries', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (209, 'SANT', 0, 'SANT Mira', 'SANT', 'Mira', 'Croix-du-Levant 14', '1220', 'Les Avanchets', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (210, 'SANTINES', 0, 'SANTINES Joseph', 'SANTINES', 'Joseph', 'Grand-Monfleury 2', '1290', 'Versoix', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (211, 'SAUVAIN_CHARLY', 0, 'SAUVAIN Charly', 'SAUVAIN', 'Charly', 'Rue du Village 3', '1214', 'Vernier', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (212, 'SAUVAIN_Mme', 0, 'SAUVAIN Christiane', 'SAUVAIN', 'Christiane', 'Rue du Village 3', '1214', 'Vernier', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (213, 'SAUVET', 0, 'SAUVET Olivier', 'SAUVET', 'Olivier', 'Rue de l''Aubépine 13', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (214, 'SCHALTEGGER', 0, 'SCHALTEGGER Marguerite', 'SCHALTEGGER', 'Marguerite', 'Chemin de Saule  71', '1233', 'Bernex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (215, 'SCHNEiDER', 0, 'SCHNEiDER André', 'SCHNEiDER', 'André', 'Chemin du Champs-d''Anier 8', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (216, 'SCHROETER', 0, 'SCHROETER Sonia', 'SCHROETER', 'Sonia', 'Avenue du Mail 20', '1205', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (217, 'SCHURMANN', 0, 'SCHURMANN Agnès', 'SCHURMANN', 'Agnès', 'Promenade de Champs-Fréchets 14', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (218, 'SCHWERI', 0, 'SCHWERI Ernest', 'SCHWERI', 'Ernest', 'Avenue de France 31', '1202', 'Genève', 'Suisse', 35, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (219, 'SCHWERZMANN', 0, 'SCHWERZMANN Simone', 'SCHWERZMANN', 'Simone', 'Rue des evaux 7', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (220, 'SEN', 0, 'SEN Omer', 'SEN', 'Omer', 'Avenue Frédéric-Soret 24', '1203', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (221, 'SHAHADAT', 0, 'SHAHADAT Naseerha', 'SHAHADAT', 'Naseerha', 'Cité Vieusseux  7', '1203', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (222, 'SICOVIER', 0, 'SICOVIER Ivan', 'SICOVIER', 'Ivan', 'Rue Chabrey 9', '1202', 'Genève', 'Suisse', 40, 'Domicile', 'Hôpital de La Tour, Hemodialyse', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (223, 'SICURANZA', 0, 'SICURANZA Norma', 'SICURANZA', 'Norma', 'Route de Colovray 4', '1218', 'Le Grand-Saconnex', 'Suisse', 40, 'Domicile', 'Dr Ilic, 4 rue Gourgas', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (224, 'SIEBERT', 0, 'SIEBERT Margit', 'SIEBERT', 'Margit', 'Avenue Soret 4', '1203', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (225, 'SOMMERHALDER', 0, 'SOMMERHALDER Anita', 'SOMMERHALDER', 'Anita', 'Avenue de Vaudagne 35', '1217', 'Meyrin', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (226, 'SORDAT', 0, 'SORDAT Olivier', 'SORDAT', 'Olivier', 'Chemin de la Traille 30', '1213', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (227, 'STOPFER', 0, 'STOPFER Hans', 'STOPFER', 'Hans', 'Rue louis-Favre 37', '1201', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (228, 'TALLEUX', 0, 'TALLEUX Denise', 'TALLEUX', 'Denise', 'Chemin De-La-Montagne 112', '1224', 'Chêne-Bougeries', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (229, 'THEVOZ', 0, 'THEVOZ Geneviève', 'THEVOZ', 'Geneviève', 'Rue Jean-Robert-Chouet 17', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (230, 'VM_Torello', 0, 'TORELLO Jacqueline', 'TORELLO', 'Jacqueline', 'Ch. Etienne-Chennaz 14', '1226', 'Thônex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (231, 'TOSCANO', 0, 'TOSCANO Sandro', 'TOSCANO', 'Sandro', 'Rue Moïse Duboule 31', '1209', 'Genève', 'Suisse', 40, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (232, 'TRENTAZ', 0, 'TRENTAZ Georgette', 'TRENTAZ', 'Georgette', 'Rue du Grand-Pré 55', '1202', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (233, 'TZORTIS', 0, 'TZORTIS-WIEDMER Christiane Aline', 'TZORTIS-WIEDMER', 'Christiane Aline', 'Route de Chancy 42', '1213', 'Petit-Lancy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (234, 'VALLAT', 0, 'VALLAT Brigitte', 'VALLAT', 'Brigitte', 'Boulevard des Promenades 20', '1227', 'Carouge', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (235, 'VALLEPIN', 0, 'VALLEPIN Daniel', 'VALLEPIN', 'Daniel', 'Rue des Mésanges 6', '74160', 'Saint-Julien', 'France', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (236, 'VALLET', 0, 'VALLET Patricia', 'VALLET', 'Patricia', 'Avenue du Lignon 67', '1219', 'Le Lignon', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (237, 'VINCI', 0, 'VINCI Maria', 'VINCI', 'Maria', 'Chemin de Vi-Longe13', '1213', 'Onex', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (238, 'VUSICKI', 0, 'VUSICKI Nevenka', 'VUSICKI', 'Nevenka', 'Rroute Antoine-Martin 31A', '1234', 'Vessy', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (239, 'WASMER', 0, 'WASMER Rose-Marie', 'WASMER', 'Rose-Marie', 'Rue Le-Corbusier 21a', '1208', 'Genève', 'Suisse', 40, 'Domicile', 'Physio, 25 rue Jacques-Grosselin', 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (240, 'WEBER_F', 0, 'WEBER Francine', 'WEBER', 'Francine', 'Rue de Moillebeau 3A', '1209', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (241, 'WOOD', 0, 'WOOD Jonathan', 'WOOD', 'Jonathan', 'Quai Wilson 41', '1201', 'Genève', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (242, 'YERSIN', 0, 'YERSIN Pierre', 'YERSIN', 'Pierre', 'Chemin de Tré-la-Villa 40', '1236', 'Cartigny', 'Suisse', null, null, null, 200);
INSERT INTO ikamych.clients (id, pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES (243, 'ZAKAR', 0, 'ZAKAR Thérèse', 'ZAKAR', 'Thérèse', 'Rue Du Bois-Melly 2', '1205', 'Genève', 'Suisse', null, null, null, 200);


--
-- Table structure for table `courses`
--


DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  id int(11) NOT NULL AUTO_INCREMENT,
  validated tinyint(1) NOT NULL DEFAULT 0 ,
  programed tinyint(1) NOT NULL DEFAULT 0 ,
  invoiced tinyint(1) NOT NULL DEFAULT 0 ,
  invoice_id int(11)  DEFAULT NULL ,
  course_date date NOT NULL,
  client_id INT(11),
  pseudo varchar(50) NOT NULL,
  pseudo_autres varchar(50) ,
  heure varchar(5) NOT NULL,
  aller_retour VARCHAR(20) NOT NULL DEFAULT 'AllerSimple', -- to check with course form
  aller_retour1 tinyint(1) NOT NULL DEFAULT 0, -- to check with course form
  retour_booked tinyint(1) NOT NULL DEFAULT 0,
  heure_retour varchar(5) ,
  chauffeur varchar(50) ,  -- id
  depart varchar(70) NOT NULL,
  arrivee varchar(70) NOT NULL,
  type_transport varchar(50) NOT NULL,
  autres_prestations varchar(50) ,
  prix_course DECIMAL(10,2) DEFAULT 0,
  nom_patient varchar(60) ,
  bon_no varchar(60),
  remarque text,
  input_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
--  year YEAR,
--  month VARCHAR(11),
  username VARCHAR(50),
  user_id INT (11),
  user_fullname VARCHAR (70),
  username_validation VARCHAR(50)DEFAULT NULL ,
  date_validation DATETIME DEFAULT NULL,
  Annulation_course TINYINT(1)DEFAULT 0,
  export_course TINYINT(1)DEFAULT 0,
  PRIMARY KEY (`id`),
 FOREIGN KEY (`client_id`) REFERENCES clients(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS chauffeurs;
CREATE TABLE chauffeurs (
  id int(11) NOT NULL AUTO_INCREMENT,
  chauffeur_name VARCHAR(70) UNIQUE DEFAULT NULL ,
  initial VARCHAR(3) UNIQUE DEFAULT NULL ,
  company VARCHAR(70),
  PRIMARY KEY (`id`),
  INDEX (chauffeur_name)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


INSERT INTO chauffeurs (id, chauffeur_name,initial,company) VALUES
  (1,'Pablo ARZA','PAB','Transmed'),
  (2,'Luan HAZIRI','LUA','Transmed'),
  (3,'Djamila AMRANI','DJA','Transmed'),
  (4,'Pierre-Alain BONFILS','PIA','Transmed'),
  (5,'Vincent DUBOULOZ','VCT', 'Transmed'),
  (6,'Autres','AUT','Transmed'),
  (7,'Kamran NAFISSPOUR','KNA','Transmed');



--  program course
DROP TABLE IF EXISTS programmed_courses_modele;
CREATE TABLE programmed_courses_modele (
  id int(11) NOT NULL AUTO_INCREMENT,
  visible TINYINT(1) NOT NULL DEFAULT 1,
  week_day_rank TINYINT(1)NOT NULL ,
  client_habituel TINYINT(1)DEFAULT 1,
  client_id INT(11)NOT NULL ,
  heure varchar(5) NOT NULL,
  inverse_addresse TINYINT(1)NOT NULL DEFAULT 0,
  depart varchar(70)  DEFAULT NULL,
  arrivee varchar(70)  DEFAULT NULL ,
  prix_course decimal(10,2) DEFAULT '0.00',
  chauffeur VARCHAR(50)DEFAULT NULL,
  remarque text DEFAULT NULL,
  type_transport varchar(50) DEFAULT NULL ,
  input_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  username VARCHAR(70) ,
  PRIMARY KEY (`id`),
  INDEX (week_day_rank,client_id),
  FOREIGN KEY (`client_id`) REFERENCES clients(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS programmed_courses;
CREATE TABLE programmed_courses (
  id int(11) NOT NULL AUTO_INCREMENT,
 /* week_day_rank tinyint(1) NOT NULL ,*/
  validated_chauffeur tinyint(1) NOT NULL DEFAULT 0,
  validated_mgr tinyint(1) NOT NULL DEFAULT 0,
  validated_final tinyint(1) NOT NULL DEFAULT 0,
  course_date date  DEFAULT NULL ,
  modele_id int(11)  ,
  client_id int(11),
  pseudo varchar(50) DEFAULT NULL,
  pseudo_autres varchar(50) DEFAULT NULL,
  heure varchar(5) NOT NULL,
  aller_retour VARCHAR(20) NOT NULL DEFAULT 'AllerSimple', -- to check with course form
  chauffeur varchar(50) DEFAULT NULL,  -- id or no
  depart varchar(70) DEFAULT NULL,
  arrivee varchar(70) DEFAULT NULL,
  type_transport varchar(50) DEFAULT NULL ,
  nom_patient varchar(60) DEFAULT NULL ,
  bon_no varchar(60) DEFAULT NULL,
  prix_course decimal(10,2) DEFAULT '0.00',
  remarque text DEFAULT NULL,
  input_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  username VARCHAR(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (pseudo,course_date),
  FOREIGN KEY (`client_id`) REFERENCES clients(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



DROP VIEW IF EXISTS modele_pivot;
DROP VIEW IF EXISTS modele;

DROP VIEW IF EXISTS modele_pivot_visible_no;
DROP VIEW IF EXISTS modele_visible_no;

DROP VIEW IF EXISTS modele_pivot_visible_yes;
DROP VIEW IF EXISTS modele_visible_yes;


CREATE VIEW  modele AS
  SELECT CONCAT_WS('-',p.heure,c.pseudo,c.id) AS PrimaryKey,p.heure,p.week_day_rank AS jour , p.client_id, c.pseudo ,c.liste_restrictive,c.liste_rank AS client_sort, c.web_view, p.id AS modele_id, p.inverse_addresse, p.depart, p.arrivee ,p.prix_course, c.default_aller ,c.default_arrivee,c.default_price,p.remarque,p.chauffeur,p.client_habituel,

         case when week_day_rank = 1 then p.id  end as Lundi,
         case when week_day_rank = 2 then p.id  end as Mardi,
         case when week_day_rank = 3 then p.id  end as Mercredi,
         case when week_day_rank = 4 then p.id  end as Jeudi,
         case when week_day_rank = 5 then p.id  end as Vendredi,
         case when week_day_rank = 6 then p.id  end as Samedi,
         case when week_day_rank = 7 then p.id  end as Dimanche

  FROM clients AS c
    INNER JOIN
    programmed_courses_modele AS p
      ON c.id = p.client_id
  ORDER BY p.heure, jour, client_sort  ;



CREATE VIEW  modele_visible_yes AS
  SELECT CONCAT_WS('-',p.heure,c.pseudo,c.id) AS PrimaryKey,p.heure,p.week_day_rank AS jour , p.client_id, c.pseudo ,c.liste_restrictive,c.liste_rank AS client_sort, c.web_view, p.id AS modele_id, p.inverse_addresse, p.depart, p.arrivee ,p.prix_course, c.default_aller ,c.default_arrivee,c.default_price,p.remarque,p.chauffeur,p.client_habituel,

         case when week_day_rank = 1 then p.id  end as Lundi,
         case when week_day_rank = 2 then p.id  end as Mardi,
         case when week_day_rank = 3 then p.id  end as Mercredi,
         case when week_day_rank = 4 then p.id  end as Jeudi,
         case when week_day_rank = 5 then p.id  end as Vendredi,
         case when week_day_rank = 6 then p.id  end as Samedi,
         case when week_day_rank = 7 then p.id  end as Dimanche

  FROM clients AS c
    INNER JOIN
    programmed_courses_modele AS p
      ON c.id = p.client_id
    WHERE p.visible=1
  ORDER BY p.heure, jour, client_sort  ;


CREATE VIEW  modele_visible_no AS
  SELECT CONCAT_WS('-',p.heure,c.pseudo,c.id) AS PrimaryKey,p.heure,p.week_day_rank AS jour , p.client_id, c.pseudo ,c.liste_restrictive,c.liste_rank AS client_sort, c.web_view, p.id AS modele_id, p.inverse_addresse, p.depart, p.arrivee ,p.prix_course, c.default_aller ,c.default_arrivee,c.default_price,p.remarque,p.chauffeur,p.client_habituel,

         case when week_day_rank = 1 then p.id  end as Lundi,
         case when week_day_rank = 2 then p.id  end as Mardi,
         case when week_day_rank = 3 then p.id  end as Mercredi,
         case when week_day_rank = 4 then p.id  end as Jeudi,
         case when week_day_rank = 5 then p.id  end as Vendredi,
         case when week_day_rank = 6 then p.id  end as Samedi,
         case when week_day_rank = 7 then p.id  end as Dimanche

  FROM clients AS c
    INNER JOIN
    programmed_courses_modele AS p
      ON c.id = p.client_id
  WHERE visible=0
  ORDER BY p.heure, jour, client_sort;



CREATE VIEW modele_pivot AS (
  SELECT
    heure,pseudo,web_view,client_id,
    max(Lundi) as Lundi,
    max(Mardi) as Mardi,
    max(Mercredi) as Mercredi,
    max(Jeudi) as Jeudi,
    max(Vendredi) as Vendredi,
    max(Samedi) as Samedi,
    max(Dimanche) as Dimanche
  FROM modele
  GROUP BY  heure,pseudo,web_view,client_id
);


CREATE VIEW modele_pivot_visible_yes AS (
  SELECT
    heure,pseudo,web_view,client_id,
    max(Lundi) as Lundi,
    max(Mardi) as Mardi,
    max(Mercredi) as Mercredi,
    max(Jeudi) as Jeudi,
    max(Vendredi) as Vendredi,
    max(Samedi) as Samedi,
    max(Dimanche) as Dimanche
  FROM modele_visible_yes
  GROUP BY  heure,pseudo,web_view,client_id
);


CREATE VIEW modele_pivot_visible_no AS (
  SELECT
    heure,pseudo,web_view,client_id,
    max(Lundi) as Lundi,
    max(Mardi) as Mardi,
    max(Mercredi) as Mercredi,
    max(Jeudi) as Jeudi,
    max(Vendredi) as Vendredi,
    max(Samedi) as Samedi,
    max(Dimanche) as Dimanche
  FROM modele_visible_no
  GROUP BY  heure,pseudo,web_view,client_id
);







DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL UNIQUE,
  comment VARCHAR(50),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


INSERT INTO user_type(id, user_type) VALUES
  (1,'admin'),
  (2,'manager'),
  (3,'secretary'),
  (4,'employee');

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `user_type` varchar(60) DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `cp` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `mobile` varchar(60) DEFAULT NULL,
  `img` longblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
--
-- Dumping data for table `admins`
--

INSERT INTO ikamych.admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (1, 'admin', '$2y$10$YzYyN2U3MjBkNGQ4MTliOOYg0RfXSbg5pFOVsO1vOeEFamBhPdnYS', 'admin', 'webmaster@ikamy.ch', 'admin', 1, null, null, null, null, null, null, null, null, null);
INSERT INTO ikamych.admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (2, 'kamy', '$2y$10$MmY3YTUwNTA4MzZjYWZiOORpVvLvjpsyBJ1a0p/vVfQLUNGu1e76W', 'Kamran NAFISSPOUR', 'nafisspour@bluewin.ch', 'admin', 1, 'Kamran', 'Nafisspour', '68 rue des Vollandes', '1207', 'Genève', 'Suisse', '+41 (22) 7350120', '+41 (79) 350 21 32', null);
INSERT INTO ikamych.admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (4, 'pablo', '$2y$10$OGEwYmRkMjc5NTNhMTVhNeS9iamczbZH3ag9qt2EXM8EliS2UwUTO', 'Pablo Arza', 'transmed@bluewin.ch', 'employee', 4, null, null, null, null, null, null, null, null, null);
INSERT INTO ikamych.admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (5, 'kamy333', '$2y$10$OTAyYzczMGNmMzI2Y2ZjN.faDoYq2/ZSaAK42684GEbpTJ2/Q2Lyq', 'Kamy Manager', 'kamy333@hotmail.com', 'manager', 2, null, null, null, null, null, null, null, null, null);
INSERT INTO ikamych.admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (7, 'gmail', '$2y$10$MWU4N2E5MDcwNDRjYjM1Mu2URCsGI9fUp9JCdmPZCX1cYOlmzeu5O', 'Kamy employee', 'kamran.nafisspour@gmail.com', 'employee', 4, null, null, null, null, null, null, null, null, null);

# DROP VIEW IF EXISTS summary_by_course_date_program;
DROP VIEW IF EXISTS summary_by_course_date_program;

CREATE VIEW  summary_by_course_date_program AS
  SELECT DISTINCT course_date as course_date
    ,  DATE_SUB(course_date, INTERVAL 1 DAY) AS day_before
    , DATE_ADD(course_date, INTERVAL 1 DAY) AS day_after
    , unix_timestamp(course_date)AS date_unix ,DATE(now()) AS today
    ,  DATEDIFF (course_date,now()) AS diff
    , CASE
      WHEN DATEDIFF (course_date,now()) = -1 then 'yesterday'
      WHEN DATEDIFF (course_date,now()) = 1 then 'tomorrow'
      WHEN DATEDIFF (course_date,now()) < 0 then CONCAT(DATEDIFF (course_date,now()), ' day')
      WHEN DATEDIFF (course_date,now()) > 0 then CONCAT('+', DATEDIFF (course_date,now()), ' day')
      WHEN DATEDIFF (course_date,now()) = 0 then 'now'
      ELSE 'now'
      END as str_time
    ,  CASE
       WHEN DATEDIFF (course_date,now()) = -1 then 'hier'
       WHEN DATEDIFF (course_date,now()) = 1 then 'demain'
       WHEN DATEDIFF (course_date,now()) < 0 then CONCAT('il y a ', -DATEDIFF (course_date,now()), ' jours')
       WHEN DATEDIFF (course_date,now()) > 0 then CONCAT('dans ', DATEDIFF (course_date,now()), ' jours')
       WHEN DATEDIFF (course_date,now()) = 0 then 'aujourd\'hui'
       ELSE 'now'
       END as str_time_fr
    ,DATE_FORMAT(course_date,GET_FORMAT(DATE,'EUR')) AS date_format
    , SEC_TO_TIME((TIME_TO_SEC(now()) DIV 900) * 900) AS now_round_time
    , replace( SUBSTRING(SEC_TO_TIME((TIME_TO_SEC(now()) DIV 900) * 900),1,5),':','h') AS now_time_transmed
    ,  monthname(course_date) AS monthname
    , year(course_date) AS year
    , week (course_date) AS week
    , count(course_date) AS total_course
    , SUM(IF(validated_chauffeur=0, 1, 0)) AS valid_chauf_0
    , SUM(IF(validated_chauffeur=1, 1, 0)) AS valid_chauf_1
    , SUM(IF(validated_chauffeur=2, 1, 0)) AS valid_chauf_2
    , SUM(IF(validated_mgr=0, 1, 0)) AS valid_mgr_0
    , SUM(IF(validated_mgr=1, 1, 0)) AS valid_mgr_1
    , SUM(IF(validated_final=0, 1, 0)) AS valid_fina1_0
    , SUM(IF(validated_final=1, 1, 0)) AS valid_fina1_1
    , SUM(IF(prix_course=0, 1, 0)) AS prix_course_0
    ,sum( chauffeur='' OR chauffeur IS NULL ) AS erreur_chauffeur
    , sum(  (((depart='' OR depart is NULL OR arrivee='' OR arrivee is NULL) )))as erreur_address
    , sum(( pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL)))as erreur_autres
    , sum(((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha')
           AND (nom_patient='' OR nom_patient IS NULL)))as erreur_patients
    , sum((pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL)))as erreur_sang
    , sum(
         (((depart='' OR depart is NULL OR arrivee='' OR arrivee is NULL) ))
         OR ((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha')
             AND (nom_patient='' OR nom_patient IS NULL))
         OR ( pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL))
         OR (pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL)) ) AS erreur_general
  FROM programmed_courses GROUP BY course_date ORDER BY course_date  DESC;


DROP TABLE IF EXISTS links;
DROP TABLE IF EXISTS links_category;



CREATE TABLE links_category (
  id int(11) NOT NULL AUTO_INCREMENT ,
  category varchar(50) NOT NULL UNIQUE ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



CREATE TABLE links (
  id int(11) NOT NULL AUTO_INCREMENT ,
  name varchar(50) NOT NULL ,
  web_address text DEFAULT NULL,
  description text DEFAULT NULL,
  category varchar(50) NOT NULL DEFAULT 'Others',
  sub_category_1 varchar(50) NULL ,
  sub_category_2 varchar(50) NULL ,
  privacy TINYINT(1) DEFAULT 0,
  rank INT(11) DEFAULT 0,
  username varchar(50) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;









