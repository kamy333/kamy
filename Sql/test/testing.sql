
SELECT *   FROM programmed_courses as sum;


# CREATE VIEW  program_course_error_view AS

SELECT  sum.id, sum.validated_chauffeur ,sum.validated_mgr,sum.validated_final,sum.course_date, sum.client_id,sum.pseudo,sum.pseudo_autres,sum.heure,sum.aller_retour,sum.chauffeur,sum.depart,sum.arrivee,sum.type_transport,sum.nom_patient,sum.bon_no,sum.prix_course,sum.remarque,sum.input_date,sum.username
  ,err.error_pseudo,err.error_address, err.erreur FROM (
SELECT id,pseudo,chauffeur,course_date,
  CASE WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then  'depart arrivee'
WHEN ((depart='' OR depart is NULL)  ) then  'depart'
  WHEN ( (arrivee='' OR arrivee is NULL) ) then  'arrivee'
  ELSE '' END as error_address ,
CASE WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN 'nom patient'
WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN 'autres'
WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN 'sang' ELSE ''
  END as error_pseudo,
  CASE WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then  'erreur'
WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha')
  AND (nom_patient='' OR nom_patient IS NULL) THEN 'erreur'
WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN 'erreur'
WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN 'erreur'
ELSE '' END as erreur FROM programmed_courses )as err JOIN programmed_courses as sum ON  sum.id =err.id WHERE err.erreur ='erreur' ORDER BY sum.course_date DESC
;









SELECT  *,
CASE WHEN (((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) )) then  'erreur'
WHEN ((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha')
AND (nom_patient='' OR nom_patient IS NULL)) THEN 'erreur'
WHEN ( pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL)) THEN 'erreur'
WHEN (pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL)) THEN 'erreur'
ELSE '' END as erreur
FROM programmed_courses ;






((((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ))
OR ((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL))
OR ( pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL))
OR (pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL))),1,0) as error





SELECT DISTINCT course_date ,

  CASE WHEN (((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ))
            OR ((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL))
            OR ( pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL))
            OR (pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL))


  THEN 'erreur'
  ELSE '' END as erreur
FROM programmed_courses GROUP BY course_date;






SELECT DISTINCT course_date ,
    CASE WHEN (((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ))
  OR ((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha')
        AND (nom_patient='' OR nom_patient IS NULL))
  OR ( pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL))
  OR (pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL)) THEN 'erreur'
  ELSE '' END as erreur
FROM programmed_courses GROUP BY course_date;







SELECT id, pseudo,chauffeur FROM programmed_courses WHERE chauffeur ='';


SELECT pseudo, id,nom_patient FROM programmed_courses WHERE pseudo='autres' OR (pseudo ='aloha' AND nom_patient ='');

SELECT pseudo, id,nom_patient FROM programmed_courses WHERE pseudo='autres' OR (pseudo ='aloha' AND nom_patient is NULL );

SELECT pseudo,nom_patient FROM programmed_courses WHERE pseudo='aloha'
                                                        AND (nom_patient='' OR nom_patient IS NULL) ;

SELECT pseudo, id, nom_patient,'nom patient' FROM programmed_courses WHERE
 (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha')
AND (nom_patient='' OR nom_patient IS NULL)
UNION
SELECT pseudo, id, pseudo_autres,'autres' FROM programmed_courses WHERE
  pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL)
UNION
SELECT pseudo, id, bon_no,'sang' FROM programmed_courses WHERE
  pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) ;


SELECT * , 'hi'

FROM programmed_courses