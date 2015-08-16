// JavaScript Document


var myDateCourse= document.getElementById("DateCourse");

var myChauffeur= document.getElementById("Chauffeur");

var myPseudo= document.getElementById("Pseudo");
var myName= document.getElementById("name");
var myHeure= document.getElementById("Heure");
var myAllerRetour= document.getElementById("AllerRetour");
var myHeureRetour= document.getElementById("HeureRetour");

var myDepart= document.getElementById("Depart");
var myArrivee= document.getElementById("Arrivee");

var myNom_Patient= document.getElementById("Nom_Patient");
var myBon_No= document.getElementById("Bon_No");
var myType_transport= document.getElementById("Type_transport");
var myPrix_Course= document.getElementById("Prix_Course");




var myError = false;


function myNameForm() {
	//return false;
	
	var mypseudo1=document.getElementById("Pseudo");
	var myBon1= document.getElementById("Bon_No");
    var myName1= document.getElementById("name");
	var myNom_Patient1= document.getElementById("Nom_Patient");


	
	if (((mypseudo1.value == "Autres") || (mypseudo1.value == "AUTRES") ||  (mypseudo1.value == "COLLINE") || (mypseudo1.value == "")) && (document.getElementById("name").value == "")) {
		
		myBon1.value="";
		myNom_Patient1.value="";
		
		//$( "#LabelName,#name").show("normal");
		$(".listnom").show();
		
		var text1= "ATTENTION ! &nbsp;&nbsp;&nbsp; Pseudo ";
		var text2="<span style='color:blue; font-weight: bold;'>";
		var text3 =document.getElementById("Pseudo").value;
		var text4="</span>";
		var text5=" a été choisi donc veuillez ajouter un nom de patient ci-dessous!";
		
		document.getElementById("errorMessagePseudo").innerHTML = text1 + text2 + text3 + text4 + text5 ;
		$("#errorMessagePseudo").show();
		myError = true;
		setFocusToname();
		} else if ((mypseudo1.value == "Autres") || (mypseudo1.value == "AUTRES") || (mypseudo1.value == "")) {
		//$( "#LabelName,#name").show("normal");
		$(".listnom").show();
		  
		document.getElementById("errorMessagePseudo").innerHTML = "";
	    $("#errorMessagePseudo").hide();
		
		} else {
	
		document.getElementById("errorMessagePseudo").innerHTML = "";
		$("#errorMessagePseudo").hide();

	};
	
} //my name



function mynompatient () {
	
	var pseu=document.getElementById("Pseudo");
	var pat=document.getElementById("Nom_Patient");
	var myBon1= document.getElementById("Bon_No");
    var myName1= document.getElementById("name");
	
	
	
	if (((pseu.value == "Tour_Patient") || (pseu.value == "TAG") || (pseu.value == "PARTNERS") || (pseu.value == "Mines_ICBL") || (pseu.value == "CASH") || (pseu.value == "AUDE") || (pseu.value == "ALOHA")) && (pat.value =="")) {
		
			
	myBon1.value ="";
	myName1.value	="";
				
	        //$("#labelNom_Patient,#Nom_Patient").show("normal");
			$(".listnompatient").show();
    
          var texte1 = "ATTENTION ! &nbsp; Avec le nom choisi ";  
		  var texte2 = document.getElementById("Pseudo").value
		  var texte3= " rentrez le nom du patient que vous avez transporté";

		document.getElementById("errorNomPatient").innerHTML = texte1 + "<span style='color:blue; font-weight: bold;'>" + texte2 + "</span>" + texte3;
		$("#errorNomPatient").show();
		
		myError = true;
		setFocusToNomPatient();
		
		} else {
	
		document.getElementById("errorNomPatient").innerHTML = "";
		$("#errorNomPatient").hide();
	   }
		
	}; //mynompatient


function mysang(){
	
	var sangname= document.getElementById("Pseudo");
	var transportname= document.getElementById("Type_transport");
	var mybon= document.getElementById("Bon_No");
	var labelMybon= document.getElementById("labelBon_No");
	var mybonError= document.getElementById("errorBonNo");
	var mynompatient= document.getElementById("Nom_Patient");
	
	
	
	if ((sangname.value=="Tour_Sang") || (sangname.value=="Carouge_Sang")) {
		transportname.value="Sang";
		mynompatient.value="";
		
	//$("#Bon_No,#labelBon_No").show("normal");
	$(".listbonno").show();
	//$("#LabelName,#name").hide("normal");
	$(".listnom").hide();
	//$("#labelNom_Patient,#Nom_Patient").hide("normal");
	$(".listnompatient").hide();
	
	    var text0="<span style='color:blue; font-weight: bold;'> No du bon </span>";
	    var text1= "Transport sang ou materiel rentrez le " + text0 + " si vous le connaissez. Sinon rentrez";
		var text2="<span style='color:blue; font-weight: bold;'>";
		var text3 = " NA.";
		var text4="</span>";
		var text5= text1 + text2 + text3 + text4 ;
	
	
	
	mybonError.innerHTML= text5;
	$("#errorBonNo").show();
	
	   if (mybon.value != "") {
		mybonError.innerHTML="";
		$("#errorBonNo").hide();
		   
	   }
	 setFocusToBonNo(); 
	} 
	
	else {
		transportname.value="Standard";
		//$("#Bon_No,#labelBon_No").hide("normal");
		$(".listbonno").hide();
		mybonError.innerHTML="";
		$("#errorBonNo").hide();
	}
}; //mysang


function myheureForm() {
	
			document.getElementById("errorMessageHeure").innerHTML = "";
			$("#errorMessageHeure").hide();

	if ((document.getElementById("AllerRetour").value == "AllerRetour") && (document.getElementById("HeureRetour").value == "" || document.getElementById("HeureRetour").value == "NA")) {
		
		$("#HeureRetour").val("");
		
		//$("#HeureRetour,#LabelHeureRetour").show("normal");
		$(".listheureretour").show();

        var text1= "ATTENTION ! &nbsp; ";
		var text2="<span style='color:blue; font-weight: bold;'>";
		var text3 =     "Aller-Retour"; 
		var text4="</span>";
		var text5=" a été choisi donc veuillez complèter l'heure de retour!";
		var text6= text1 + text2 + text3 + text4 + text5 ;

		document.getElementById("errorMessageHeure").innerHTML = text6; //"ATTENTION ! &nbsp;&nbsp;&nbsp; <u>'Aller-Retour'</u> a été choisi donc veuillez complèter l'heure de retour!";
		$("#errorMessageHeure").show();
		
		myError = true;
		setFocusToHeureRetour();
		} 
		
		else if ((document.getElementById("AllerRetour").value == "AllerSimple")) { // && (document.getElementById("HeureRetour").value != "")) {
		document.getElementById("HeureRetour").value = "NA";
		//$("#HeureRetour,#LabelHeureRetour").hide("normal");
		$(".listheureretour").hide();

		document.getElementById("errorMessageHeure").innerHTML = "";
		$("#errorMessageHeure").hide();
		} else {
	    
		document.getElementById("errorMessageHeure").innerHTML = "";
		$("#errorMessageHeure").hide();
	};
}; //myheureForm




//set focus

function setFocusToNomPatient(){
    document.getElementById("Nom_Patient").focus();
}

function setFocusToHeureRetour(){
    document.getElementById("HeureRetour").focus();
}

function setFocusToname(){
    document.getElementById("name").focus();
}

function setFocusToBonNo(){
    document.getElementById("Bon_No").focus();
}



mypseudochange = function () {
//  $("#LabelName,#name").hide("normal");
//	$("#labelNom_Patient,#Nom_Patient").hide("normal");
//	$("#Bon_No,#labelBon_No").hide("normal");

//TODO VVVVVVVVVVVVV

    var currentLocation = window.location.pathname;
    if (currentLocation=="/kamy/public/edit_course.php") {


        $(".listnom").show();
        $(".listnompatient").show();
        $(".listbonno").show();


    } else {

        $(".listnom").hide();
        $(".listnompatient").hide();
        $(".listbonno").hide();


        $("#Type_transport").val("Standard");
        $("#Bon_No").val("");
        $("#Nom_Patient").val("");


    };




	myNameForm();
	mynompatient ();
	mysang();
	
};


myheureRetourchange = function () {
	myheureForm();
};





function mynameChange () {
		myNameForm(); 
};

function mypatientChange () {
		mynompatient ();
};

function mysangChange () {
		mysang();
};



// handle the form submit event
function prepareEventHandlers() {
	
	document.getElementById("frmCourse").onsubmit = function() {
		// prevent a form from submitting .
		

$("#HeureRetour,#LabelHeureRetour").show("normal");		
		
		myError= false
		myNameForm();
		myheureForm();
		mynompatient ();
		//myblanks();
		
		if (myError) {
	
			return false;
		} else {
			
			return true;
		}
		
		
		
	};
	
		
}

    
	window.onload = function () {

   /* $("#LabelName,#name").hide();
	$("#labelNom_Patient,#Nom_Patient").hide();
		
	$("#HeureRetour,#LabelHeureRetour").hide();
	$("#Bon_No,#labelBon_No").hide();
	
*/

        var loc = window.location.href;
        var fname  = loc.split('/').pop().split('.').shift()


	//var currentLocation = window.location.pathname;
     //   alert(loc);

        //alert(fname);

        var ar=$("#AllerRetour").val();
        var hr=$("#HeureRetour").val();
        var nm=$("#name").val();
        var np=$("#Nom_Patient").val();
        var bn=$("#Bon_No").val();
        //
        //alert(ar);
        //alert(nm);
        //alert(np);
        //alert(bn);



        //
        //if (fname=="edit_course")
        //    if(ar!="AllerSimple"){$(".listheureretour").show();}
        //    if(nm!=""){$(".listnom").show();}
        //    if(np!=""){$(".listnompatient").show();}
        //    if(bn!=""){$(".listbonno").show();}
        //}


        if (fname=="edit_course")   {
            if(ar!=="AllerSimple"){$(".listheureretour").show();} else{$(".listheureretour").hide();}
            if(nm || nm!==" " ){$(".listnom").show();}else{$(".listnom").hide();}
            if(np || np!==" "){$(".listnompatient").show();}else{$(".listnompatient").hide();}
            if(bn || bn!==" "){$(".listbonno").show();} else {$(".listbonno").hide();}
        }



     if (fname=="new_course")   {
         $(".listheureretour").hide();
         $(".listnom").hide();
         $(".listnompatient").hide();
         $(".listbonno").hide();
     }

    $("#hidelist1").hide();
    $("#hidelist2").hide();
	
    $("#errorMessageHeure").hide();
	$("#errorMessagePseudo").hide();
	$("#errorNomPatient").hide();
	$("#errorBonNo").hide();
	





	
		
//	$("#Pseudo").removeClass("chosen-select1").addClass("chosen-select");
/*    $('a[str!=10]').removeClass('newClass').addClass('OldClass');*/
		
		
	
	 prepareEventHandlers();
    }


