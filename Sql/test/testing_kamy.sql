SELECT * FROM programmed_courses_modele WHERE heure='18h00';



/*SELECT * FROM clients INNER JOIN programmed_courses_modele ON clients.id = programmed_courses_modele.client_id   ;
*/


SELECT chauffeur FROM programmed_courses WHERE (chauffeur ='' or chauffeur is null) ;


select DISTINCT course_date,monthname(course_date),year(course_date),day(course_date),week(course_date)
, yearweek(course_date), dayofweek(course_date), dayofyear(course_date),weekofyear(course_date), dayname(course_date) FROM programmed_courses;

SELECT DISTINCT monthname(course_date)as course_date FROM programmed_courses ORDER BY monthname(course_date) DESC ;

INSERT INTO ikamych.programmed_courses_modele (id, week_day_rank, client_habituel, client_id, heure, inverse_addresse, depart, arrivee, prix_course, chauffeur, remarque, input_date, username) VALUES (39, 7, 1, 13, '04h00', 0, 'Travail', 'Domicile', 0, 'Vincent DUBOULOZ ', ' ', '2014-11-29 06:20:44', 'kamy');

SELECT last_insert_id();


SELECT  trim(depart) AS address
FROM courses
UNION
SELECT   trim(arrivee)  as address
FROM courses ;



SELECT pseudo, depart AS address
FROM courses WHERE pseudo=?
UNION
SELECT  pseudo,  arrivee as address
FROM courses WHERE pseudo=?;

SELECT DISTINCT pseudo, trim(depart) AS address
FROM courses WHERE pseudo='NAF_Kamy'
UNION
SELECT DISTINCT pseudo, trim(arrivee ) as address
FROM courses WHERE pseudo='NAF_Kamy';


SELECT pseudo, trim(depart) AS address
FROM courses WHERE pseudo='NAF_Kamy'
UNION
SELECT  pseudo, trim(arrivee ) as address
FROM courses WHERE pseudo='NAF_Kamy';



-- SELECT count(DISTINCT heure) FROM modele_visible_yes ORDER BY heure;
select jour, heure,count(heure)FROM modele_visible_yes GROUP BY heure ORDER BY jour;


INSERT IGNORE INTO programmed_courses_modele (week_day_rank,heure,client_id,inverse_addresse) VALUES
-- nafisspour
  (1,'13h45',12,0);

SELECT * FROM programmed_courses_modele WHERE client_id=12 AND week_day_rank=1 AND heure='13h45';

INSERT INTO programmed_courses_modele (week_day_rank,heure,client_id,inverse_addresse) VALUES

-- nafisspour
  (1,'13h45',12,0),
  (2,'13h45',12,0),
  (3,'13h45',12,0),
  (4,'13h45',12,0),
  (5,'13h45',12,0),
  (1,'18h00',12,1),
  (2,'18h00',12,1),
  (3,'18h00',12,1),
  (4,'18h00',12,1),
  (5,'18h00',12,1),
-- pfauti
  (1,'07h00',173,0),
  (3,'07h00',173,0),
  (5,'07h00',173,0),
-- wood
  (1,'08h00',240,0),
  (2,'08h00',240,0),
  (3,'08h00',240,0),
  (4,'08h00',240,0),
  (5,'08h00',240,0),

-- roberta 120

  (1,'08h30',120,0),
  (2,'08h30',120,0),
  (4,'08h30',120,0),
  (5,'08h30',120,0),

-- chtoui 56
  (1,'10h00',56,0),
  (2,'09h00',56,0),
  (4,'09h00',56,0),

-- pfauti 173
  (1,'11h30',173,0),
  (3,'11h30',173,0),
  (5,'11h30',173,0),

-- wasmer 238
  (1,'10h00',238,0),
  (1,'11h45',238,0),
  (3,'11h45',238,1),


-- aurelie
  (1,'18h00',9,0),
  (1,'21h00',9,0),
  (3,'18h00',9,0),
  (3,'21h00',9,0);



-- TODO make the CHARSET to ut8 so drop database create it again, see in prod if feasible
--  DROP DATABASE IF EXISTS ikamych;
-- CREATE DATABASE IF NOT EXISTS ikamych DEFAULT CHARACTER SET  ut8;

--
-- Dumping data for table `courses`
--

INSERT INTO courses (validated,programed,invoiced,course_date,client_id,pseudo,heure,aller_retour,aller_retour1,chauffeur,depart,arrivee,type_transport) VALUES
  (0,0,0,'2014-10-01',1,'NAF_Kamy','02h05','AllerSimple',0,'Pablo Arza','rue des Vollandes 68','travail','standard'),
  (0,0,0,'2014-08-07',2,'NAFISSPOUR','01h05','AllerSimple',0,'Pablo Arza','domicile','HUG','standard'),
  (0,0,0,'2014-09-12',3,'AURELIE','02h05','AllerSimple',0,'Pablo Arza','travail','domicile','standard' ),
  (0,0,0,'2014-07-01',4,'AURELIE_med','01h05','AllerSimple',0,'Pablo Arza','médecin','travail','standard');




# ALTER TABLE programmed_courses_modele
# ADD COLUMN visible TINYINT(1) NOT NULL DEFAULT 1
# AFTER  id ;

SELECT * FROM chauffeurs;
ALTER TABLE chauffeurs ADD COLUMN initial VARCHAR(3)  UNIQUE DEFAULT NULL AFTER chauffeur_name ;

ALTER TABLE programmed_courses ADD COLUMN validated_mgr TINYINT(1)  NOT NULL DEFAULT 0 AFTER validated_chauffeur ;


DJA
PAB
LU

DROP VIEW IF EXISTS Z_org;
CREATE VIEW Z_org AS
  SELECT week_day_rank,ID,client_id ,now(),DAYOFWEEK(now()) ,WEEKDAY(now())+1,  '2015-12-31' as course FROM
    programmed_courses_modele WHERE week_day_rank=WEEKDAY(now())+1;




SELECT COUNT(*) FROM programmed_courses_modele WHERE week_day_rank=1
AND client_id=16 AND heure='00h30';


SELECT COUNT(*) FROM programmed_courses_modele;


SELECT DISTINCT client_id from programmed_courses_modele WHERE week_day_rank=1;

SHOW VARIABLES LIKE '%time_zone';

SET time_zone ='Europe/Zurich ';
SHOW VARIABLES LIKE '%time_zone';
SELECT now();

SELECT address FROM clients WHERE address LIKE '%XX%';


DROP TABLE IF EXISTS programmed_courses;
CREATE TABLE programmed_courses (
  id int(11) NOT NULL AUTO_INCREMENT,
  week_day_rank tinyint(1) NOT NULL ,
  validated_chauffeur tinyint(1) NOT NULL DEFAULT 0,
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
  FOREIGN KEY (`client_id`) REFERENCES clients(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


DELETE FROM clients WHERE pseudo='XXXX';
SELECT id, pseudo FROM clients WHERE pseudo='XXXX';

INSERT INTO ikamych.clients (pseudo, liste_restrictive, web_view, last_name, first_name, address, cp, city, country, default_price, default_aller, default_arrivee, liste_rank) VALUES ('XXXX', 0, 'ALBER Clotilde', 'ALBER', 'Clotilde', 'Avenue de Champel XXXX 64', '1206', 'Genève', 'Suisse', null, null, null, 1);

DELETE FROM programmed_courses WHERE pseudo='XXXX';
SELECT id, pseudo FROM programmed_courses WHERE pseudo='XXXX';

INSERT INTO ikamych.programmed_courses (id, week_day_rank, validated_chauffeur, validated_final, course_date, modele_id, client_id, pseudo, pseudo_autres, heure, aller_retour, chauffeur, depart, arrivee, type_transport, nom_patient, bon_no, prix_course, remarque, input_date, username) VALUES (5, 1, 0, 0, '2015-05-06', 40, 246, 'XXXX', null, '13h45', 'AllerSimple', null, null, null, null, null, null, 0.00, null, '2015-06-04 09:34:45', null);


SELECT * FROM programmed_courses WHERE course_date='2015-06-08' AND validated_chauffeur=1 ORDER BY heure ASC;


DELETE  FROM programmed_courses;

SELECT week_day_rank, modele_id , client_id, heure,depart,arrivee,prix_course,chauffeur,course_date,pseudo , aller_retour FROM programmed_courses;

INSERT INTO programmed_courses (week_day_rank, modele_id , client_id, heure,depart,arrivee,prix_course,chauffeur,course_date,pseudo )
  SELECT  p.week_day_rank, p.id ,p.client_id, p.heure,p.depart,p.arrivee,
    if(p.prix_course is null,0,p.prix_course ) as prix,
    p.chauffeur,'2015-05-06' as course_date,C.pseudo
  FROM programmed_courses_modele as p
  INNER JOIN clients AS C
    ON P.client_id=C.id
  WHERE P.visible=1 and p.week_day_rank=1;

SELECT count(client_id) FROM programmed_courses WHERE client_id=12 and month(course_date)=4  ;

SELECT count(*) as numb,monthname (course_date)as month ,pseudo FROM programmed_courses GROUP BY month(course_date),pseudo
ORDER BY numb DESC ;

SELECT * FROM programmed_courses WHERE course_date='2015-05-06';


SELECT c.id, c.client_id ,c.pseudo, CL.ID, cl.pseudo
FROM courses as c
INNER JOIN clients as CL
on cl.pseudo=c.pseudo
;

SELECT * FROM clients;

INSERT INTO ikamych.courses (validated, programed, invoiced, invoice_id, course_date, client_id, pseudo, pseudo_autres, heure, aller_retour, aller_retour1, retour_booked, heure_retour, chauffeur, depart, arrivee, type_transport, autres_prestations, prix_course, nom_patient, bon_no, remarque, input_date, username, user_id, user_fullname, username_validation, date_validation, Annulation_course, export_course) VALUES ( 1, 0, 0, null, '2015-05-14', 1000, 'Tour_Sang', '  ', '01h00', 'AllerRetour', 1, 0, '02h45', 'Kamran NAFISSPOUR', '  rue des Vollandes 68', '  travail', 'sang', '', 99.00, '  ', '  lllll', '  ', '2015-05-14 19:24:52', 'kamy', 2, 'Kamran NAFISSPOUR', null, null, 0, 0);



UPDATE courses as c
 INNER JOIN clients as cl ON c.pseudo = cl.pseudo
SET c.client_id = cl.id;

INSERT INTO programmed_courses ( week_day_rank , modele_id , client_id , heure , depart , arrivee , prix_course , chauffeur , course_date, pseudo ) SELECT  programmed_courses_modele.week_day_rank , programmed_courses_modele.id , programmed_courses_modele.client_id , programmed_courses_modele.heure , programmed_courses_modele.depart , programmed_courses_modele.arrivee , if (programmed_courses_modele.prix_course is null , 0 , programmed_courses_modele.prix_course ) , programmed_courses_modele.chauffeur ,'2015-06-04' , clients.pseudo FROM programmed_courses_modele INNER JOIN clients ON programmed_courses_modele.client_id = clients.id WHERE programmed_courses_modele.visible = 1 and programmed_courses_modele.week_day_rank = 4;

SELECT * FROM programmed_courses WHERE course_date='2015-06-05';



SELECT clients.web_view , length(clients.web_view) AS len FROM clients INNER JOIN programmed_courses ON clients.pseudo = programmed_courses. pseudo WHERE programmed_courses.course_date='2015-06-08' ORDER BY len DESC LIMIT 1;


