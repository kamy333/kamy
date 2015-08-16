
SELECT *   FROM programmed_courses as sum;



SELECT *

  , CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-','Erreur:','Chauffeur est vide') ELSE '' END as error_chauffeur , CASE WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-','Erreur:','depart / arrivee vide') WHEN ((depart='' OR depart is NULL)  ) then CONCAT_WS('-','Erreur:','depart vide') WHEN ( (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-','Erreur:','arrivee vide') ELSE '' END as error_address , CASE WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN CONCAT_WS('-','Erreur:','nom patient vide') WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN CONCAT_WS('-','Erreur:','Autres Colline vide')  WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-','Erreur:','sang bon no vide') ELSE ''
  END as error_pseudo, CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-','Erreur:','Au moins une erreur') WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then  CONCAT_WS('-','Err:','Au moins une erreur') WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN CONCAT_WS('-','Err:','Au moins une erreur') WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN CONCAT_WS('-','Err:','Au moins une erreur')
  WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-','Err :','Au moins une erreur') ELSE '' END as erreur

FROM programmed_courses ;







# $query=", CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-',id,pseudo) ELSE '' END as error_chauffeur , CASE WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-',id,'depart / arrivee') WHEN ((depart='' OR depart is NULL)  ) then CONCAT_WS('-',id,'depart') WHEN ( (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-',id,'arrivee') ELSE '' END as error_address , CASE WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN 'nom patient' WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN 'autres' WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-',id,'sang') ELSE ''
#   END as error_pseudo, CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-',id,'erreur') WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then  CONCAT_WS('-',id,'erreur') WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN CONCAT_WS('-',id,'erreur') WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN CONCAT_WS('-',id,'erreur')
#   WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-',id,'erreur') ELSE '' END as erreur "  ;




SELECT course_date as dt, pseudo,chauffeur FROM programmed_courses WHERE course_date='2015-06-20';




SELECT DISTINCT course_date
  ,sum( chauffeur='' OR chauffeur IS NULL ) AS error_chauffeur
 , sum(  (((depart='' OR depart is NULL OR arrivee='' OR arrivee is NULL) )))as error_address
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
FROM programmed_courses GROUP BY course_date ;


SELECT Count(id),course_date FROM programmed_courses GROUP BY course_date ORDER BY course_date ASC;




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


 AND ((chauffeur='' OR chauffeur IS NULL ))

 AND (depart='' OR depart is NULL OR arrivee='' OR arrivee is NULL)

AND ((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL))

AND (pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL))

pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) ;
