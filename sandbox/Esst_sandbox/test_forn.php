<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>


<?php 
$today = date("Y-m-d"); 
$todaytime = date("Y-m-d H:i:s");  
$year=date("Y");
$month=date ("M");
?>





<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
  
  <br />
		<a href="../public/index.php">&laquo; Public area</a><br />
        <a href="../public/admin.php">&laquo; Main Admin menu</a><br />
    <?php echo navigation($current_subject, $current_page); ?>
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
 
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
        <button type="" name="Cancel" value="" ><a style="color:white;text-decoration: none;" href="../public/index.php">Cancel</a></button>
         
         
        
          </form>

          
          
          
 <?php include("../includes/layouts/footer.php"); ?>

