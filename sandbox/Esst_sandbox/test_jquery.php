<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test jquery</title>
<style>
/* remove FOUC out of equation */
#test code,
#test span,
#test div { display: inline; font-family: sans-serif; }
</style>
</head>
<script src="../public/javascripts/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../public/stylesheets/frmcourse.css">
<body>



 <form name="form1" id="frmCourse" class="group" method="post" action="">


<fieldset id="login" title="Course">
    <legend>Login Info</legend>
    <ol>
      <li>
        <label for="DateCourse">Date Course *</label>
        <input  type="date" name="DateCourse" id="DateCourse" value="<?php echo $today; ?>"
        pattern="\d{4}-\d{2}-\d{2}" title="YYYY-MM-DD" required> 
      </li>

      <li>
        <label for="Chauffeur">Nom Chauffeur*</label>
        <select class="chosen-select1" name="Chauffeur" id="Chauffeur" required>
    <option value="<?php echo $_SESSION['nom'];?>" disabled selected><?php echo $_SESSION['nom'];?></option>
    
        <?php include("../includes/dataforms/chauffeur.php"); ?>
           
        </select>
      </li>


        <li>
      <label for="Heure">Heure départ*; </label>
      <select class="chosen-select1" name="Heure" id="Heure" required>
    <option value="" disabled selected>--Choisir l'heure--</option>
      option value = ></option>

        <?php include("../includes/dataforms/hournew.php"); ?>               
        </select>
    </li> 	
			
	    <li class="chosen-results"> 
			<label for="AllerRetour">Aller Retour*</label>
      <select name="AllerRetour" id="AllerRetour" required onchange="myheureRetourchange()">
		  <option value="" disabled selected>-- Choisir Aller simple ou Aller Retour--</option>
		
             <option value='AllerSimple'>Aller Simple</option>
             <option value='AllerRetour'>Aller Retour</option>

        </select>
         </li>	
    
               
            <p style="font-size:10px;color:Red" id="errorMessageHeure"></p>
      
    
    <li class="listheureretour"> 
			<label for="HeureRetour" id="LabelHeureRetour">Heure Retour</label>
            <select class="chosen-select1" name="HeureRetour" id="HeureRetour" onchange="myheureRetourchange()" >
		    <option value="" disabled selected>--Choisir l'heure retour si Aller Retour--</option>
     		<option value = ></option>
			<option value = 'NA'>NA</option>
            <?php include("../includes/dataforms/hournew.php"); ?>               
           </select>
    </li>	
    
    	 	
			<li> 
		<label for="Pseudo">Nom du Client*</label>
        <select class="chosen-select1" name="Pseudo" id="Pseudo" required onchange="mypseudochange()">
		<option value="" disabled selected>-- Choisir le nom du client ou Autres et inscrire Nom --</option>
		 <option value = ></option>
        <option value = 'Autres'>Autres</option>
        <option value = 'Carouge_Sang'> Sang Carouge</option>
        <option value = 'Tour_Sang'> Sang Tour</option>
		<option value = 'Tour_Patient'>Tour Patient</option>


         <?php include("../includes/dataforms/client.php"); ?>      
        
         
        </select>
         </li>
            
            
            <p style="font-size:10px;color:Red" id="errorMessagePseudo"></p>

			  <li class="listnom">
              <label for="name" id="LabelName">Nom</label>
              <input  type="text" name="name" id="name" oninput="mynameChange()" placeholder="Nom du client si autres en selection dessus" >
            </li>
            
             <p style="font-size:10px;color:Red" id="errorNomPatient"></p>
            		
             <li class="listnompatient"><label for="Nom_Patient" id="labelNom_Patient">Tour Nom Patient </label>
             <input  type="text" name="Nom_Patient" id="Nom_Patient" oninput="mypatientChange()" placeholder="Tour Patient insérez nom du patient">
           </li>
            
              
              <p style="font-size:10px;color:Red" id="errorBonNo"></p>
              
              <li class="listbonno">
              <label for="Bon_No" id="labelBon_No">Bon No</label>            
              <input  type="text" name="Bon_No" id="Bon_No" oninput="mysangChange()" placeholder="Tour Carouge Sang Bon   No">
             </li>

            
			    <li>
              <label for="Depart">Départ de*</label>
              <input  type="text" name="Depart" id="Depart" placeholder="Adresse Depart" required >
            </li>
			

              <li>
              <label for="Arrivee">Arrivée à*</label>
              <input  type="text" name="Arrivee" id="Arrivee" placeholder="Adresse Arrivee" required >
             </li>
			
           
                    	   
               <li> 
			   <label for="Remarque">Remarque</label>
			   <textarea name="Remarque" id="Remarque"></textarea> 
			   </li>
            </ol>
        </fieldset>
        <li id="hidelist">
              <p><input  type="hidden" name="DateInput" id="DateInput" value="<?php echo $today; ?>"></p>
              <p><input  type="hidden" name="DateTime" id="DateTime" value="<?php echo $todaytime; ?>"></p>
              <p><input  type="hidden" name="DateMonth" id="DateMonth" value="<?php echo $month; ?>"></p>
               <p><input  type="hidden" name="DateYear" id="DateYear" value="<?php echo $year; ?>"></p>
              <p><input  type="hidden" name="Type_transport" id="Type_transport" value="Standard"></p>
              <p><input  type="hidden" name="Prix_Course" id="Prix_Course" value=0></p>
             </li>
         <button type="submit" name="submit" value="submit">Enter</button>
        <button type="" name="Cancel" value="" ><a style="color:white;text-decoration: none;" href="index.php">Cancel</a></button>
         
         
        
          </form>

  <script>
$("document").ready(function() {
			  alert("fin");
			  
   /* $("#LabelName,#name").hide();
	$("#labelNom_Patient,#Nom_Patient").hide();
		
	$("#HeureRetour,#LabelHeureRetour").hide();
	$("#Bon_No,#labelBon_No").hide();
	$("#hidelist").hide();*/
	
	
	/*$( "button" ).click(function() {
  $( this ).replaceWith( "<div>" + $( this ).text() + "</div>" );
});
*/
    
	
	   
	/*-------------------------------------------nom autres-----------------------------------------------------*/
	
		function p_to_li_nom() {
	   var list_nom="<label for=\"name\" id=\"LabelName\">Nom</label><input  type=\"text\" name=\"name\" id=\"name\" oninput=\"mynameChange()\" placeholder=\"Nom du client si autres en selection dessus\" >"
	   	 $("p.listnom" ).replaceWith( "<li class=\"listnom\">" + list_nom + "</li>" );
		   }
           
		 function li_to_p_nom() {
	   var list_nom="<label for=\"name\" id=\"LabelName\">Nom</label><input  type=\"text\" name=\"name\" id=\"name\" oninput=\"mynameChange()\" placeholder=\"Nom du client si autres en selection dessus\" >"
	   	 $("li.listnom" ).replaceWith( "<p class=\"listnom\">" + list_nom + "</p>" );
		   }
		   
		   function p_to_li_errornom_pseudo() {
           var errorpseudo="<li style=\"font-size:10px;color:Red\" id=\"errorMessagePseudo\"></li>"
	      	  $("p#errorMessagePseudo" ).replaceWith( errorpseudo );
		   }
		   
		   function li_to_p_errornom_pseudo() {
           var errorpseudo="<p style=\"font-size:10px;color:Red\" id=\"errorMessagePseudo\"></p>"
	      	  $("li#errorMessagePseudo" ).replaceWith( errorpseudo );
		   }
		   

/*---------------------------------------------Nom_Patient---------------------------------------------------*/

function p_to_li_nom_patient() {
	   var list_nom_patient="<label for=\"Nom_Patient\" id=\"labelNom_Patient\">Tour Nom Patient </label><input  type=\"text\" name=\"Nom_Patient\" id=\"Nom_Patient\" oninput=\"mypatientChange()\" placeholder=\"Tour Patient insérez nom du patient\">"   
	  $("p.listnompatient" ).replaceWith( "<li class=\"listnompatient\">" + list_nom_patient + "</li>" );
 }
	  
	 function li_to_p_nom_patient() {
	   var list_nom_patient="<label for=\"Nom_Patient\" id=\"labelNom_Patient\">Tour Nom Patient </label><input  type=\"text\" name=\"Nom_Patient\" id=\"Nom_Patient\" oninput=\"mypatientChange()\" placeholder=\"Tour Patient insérez nom du patient\">"   
	  $("li.listnompatient" ).replaceWith( "<p class=\"listnompatient\">" + list_nom_patient + "</p>" );
 }
	
	
	 function p_to_li_errornom_patient() {
      var errornompatient="<li style=\"font-size:10px;color:Red\" id=\"errorNomPatient\"></li>"
      	  $("p#errorNomPatient" ).replaceWith( errornompatient );
	 }
	 
	 
	 function li_to_p_errornom_patient() {
      var errornompatient="<p style=\"font-size:10px;color:Red\" id=\"errorNomPatient\"></p>"
      	  $("li#errorNomPatient" ).replaceWith( errornompatient );
	 }
	
	
	/*-------------------------------bon_no-----------------------------------------------------------------*/
	
	function p_to_li_bon_no() {
	 var list_bon_no ="<label for=\"Bon_No\" id=\"labelBon_No\">Bon No</label><input  type=\"text\" name=\"Bon_No\" id=\"Bon_No\" oninput=\"mysangChange()\" placeholder=\"Tour Carouge Sang Bon   No\">" 
	  $("p.listbonno" ).replaceWith( "<li class=\"listbonno\">" + list_bon_no + "</li>" );
	}
	
	
	function li_to_p_bon_no() {
	 var list_bon_no ="<label for=\"Bon_No\" id=\"labelBon_No\">Bon No</label><input  type=\"text\" name=\"Bon_No\" id=\"Bon_No\" oninput=\"mysangChange()\" placeholder=\"Tour Carouge Sang Bon   No\">" 
	  $("li.listbonno" ).replaceWith( "<p class=\"listbonno\">" + list_bon_no + "</p>" );
	}
	
	function p_to_li_errorbon_no() {
	  var errorbon=" <p style=\"font-size:10px;color:Red\" id=\"errorBonNo\"></p>"
   	  $("p#errorBonNo" ).replaceWith( errorbon );
	}
	
	function li_to_p_errorbon_no() {
	  var errorbon=" <li style=\"font-size:10px;color:Red\" id=\"errorBonNo\"></li>"
   	  $("p#errorBonNo" ).replaceWith( errorbon );
	}

/*------------------------------------------------------------------------------------------------*/

 /*   p_to_li_nom();
    p_to_li_bon_no(); 
	p_to_li_nom_patient();
	
    $(".listnom,#LabelName,#name").hide();
	$(".listnompatient,#labelNom_Patient,#Nom_Patient").hide();
	$(".listheureretour,#HeureRetour,#LabelHeureRetour").hide();
	$(".listbonno,#Bon_No,#labelBon_No").hide();
	$("#hidelist").hide();
	
	li_to_p_nom();
    li_to_p_bon_no(); 
	li_to_p_nom_patient();
	

    $(".listnom,#LabelName,#name").show();
	$(".listnompatient,#labelNom_Patient,#Nom_Patient").show();
		
	$(".listheureretour,#HeureRetour,#LabelHeureRetour").show();
	$(".listbonno,#Bon_No,#labelBon_No").show();
	$("#hidelist").show();
	
	p_to_li_nom();
    p_to_li_bon_no(); 
	p_to_li_nom_patient();*/
	
	
	/*$(".listnom,#name#,LabelName").hide();
	$(".listnompatient,#Nom_Patient,#labelNom_Patient").hide();
	$(".listheureretour,#HeureRetour,#LabelHeureRetour").hide();
	$(".listbonno,#Bon_No,#labelBon_No").hide();*/
	
	
	$(".listheureretour").hide();	
	$(".listnom").hide();
	$(".listnompatient").hide();
	$(".listbonno").hide();
	
	
	$("#errorMessageHeure").hide();
	$("#errorMessagePseudo").hide();
	$("#errorNomPatient").hide();
	$("#errorBonNo").hide();
	
	
  
	/*$("#Bon_No,#labelBon_No").hide();
*/

/*li_to_p_bon_no();
*/

 }); 
</script>
</body>
  
  
  
     
	

</html>