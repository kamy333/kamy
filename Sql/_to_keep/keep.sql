UPDATE courses AS p
  JOIN clients AS c ON p.client_id = c.id
SET p.type_transport =
CASE
WHEN c.pseudo='tour_sang' THEN 'Sang'
WHEN c.pseudo='carouge_sang' THEN 'Sang'
WHEN c.pseudo='tour_patient' THEN 'Liste Patients'
WHEN c.pseudo='tag' THEN 'Liste Patients'
WHEN c.pseudo='partners' THEN 'Liste Patients'
WHEN c.pseudo='mines_icbl' THEN 'Liste Patients'
WHEN c.pseudo='aude' THEN 'Liste Patients'
WHEN c.pseudo='aloha' THEN 'Liste Patients'

WHEN c.pseudo='cash' THEN 'Cash'
ELSE
  'Standard'
END
#     WHERE (c.pseudo='tour_sang' or c.pseudo='carouge_sang')
;






SELECT c.ID,p.client_id, p.heure, c.pseudo FROM programmed_courses_modele as p
JOIN clients as c WHERE c.id=p.client_id AND c.pseudo LIKE '%naf%';

SELECT * from courses WHERE pseudo LIKE '%voll%'or depart LIKE '%voll%' or arrivee LIKE '%naf%';

SELECT * from courses WHERE (courses.pseudo OR courses.depart OR courses.arrivee) LIKE '%naf%';

SELECT c.ID,p.client_id, p.heure, c.pseudo,p.type_transport FROM programmed_courses as p
  JOIN clients as c WHERE c.id=p.client_id
;

