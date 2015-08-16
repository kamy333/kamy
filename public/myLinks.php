<?php require_once('../includes/initialize.php'); ?>
<?php // require_once('../includes/function_links.php'); ?>

<?php $layout_context = "public"; // public or admin?>
<?php $fluid_view=true ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php  $active_menu="links" ?>
<?php include("../includes/layouts/nav.php"); ?>

<!--<div class="page-header">
  <h2> <small>My links</small></h2>
</div>-->


<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>




    <div class="row">
        <div class="col-lg-11 col-lg-offset-1 col-md-11 col-md-offset-1 col-sm-5">
            <?php echo get_search_category(); ?>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-3 col-lg-offset-1">
            <?php //echo get_search_category(); ?>

            <?php echo output_links(); ?>
        </div>

        <div class="col-lg-3 col-lg-offset-1">
            <?php //echo get_search_category(); ?>

            <?php echo output_links('PHP'); ?>
        </div>

        <div class="col-lg-2 ">
            <?php //echo get_search_category(); ?>

            <?php echo output_links('Bootstrap'); ?>
        </div>
        </div>

        <div class="row">
    <div class="col-lg-2 col-lg-offset-1 ">

        <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
<tr>
<th class="text-center">Social</th>
</tr>
          <tr>	<td><a target="_blank" href="https://www.facebook.com/">Facebook</a> </td></tr>
          <tr>  <td><a target="_blank" href="https://www.linkedin.com/" >linkedin</a> </td></tr>
          <tr>  <td><a target="_blank" href="https://www.google.com/finance"> Google finance</a> </td></tr>
          <tr>  <td><a target="_blank" href="https://www.t411.io/top/100/">t411</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://kickass.to/">kickass</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://www.bluewin.ch/fr/index.html">bluewin</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://web.tvonline.swisscom.ch/#en/TV/Guide/Date/20121207/Browse" >TV air</a> </td></tr>
          <tr>  <td><a target="_blank" href="https://accounts.logme.in/login.aspx?clusterid=03&returnurl=https%3A%2F%2Fsecure.logmein.com%2Ffederated%2Floginsso.aspx&headerframe=https%3A%2F%2Fsecure.logmein.com%2Ffederated%2Fresources%2Fheaderframe.aspx&productframe=https%3A%2F%2Fsecure.logmein.com%2Fcommon%2Fpages%2Fcls%2Flogin.aspx&lang=en-US&skin=logmein&regtype=R&trackingproducttype=2">logmein</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://kickass.to/usearch/ufc/?field=time_add&sorder=desc">Dnld UFC</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://kickass.to/usearch/category:movies%20lang_id:5/">Dnld French Movie</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://www.cpasbienstreaming.fr/2015/02/une-merveilleuse-histoire-du-temps.html">Film</a> </td></tr>
          <tr>  <td><a target="_blank" href=" http://www.amazon.fr/Alyah-Eliette-Ab%C3%A9cassis-ebook/dp/B00XM0DZ2A/ref=sr_1_1_twi_2_kin?ie=UTF8&qid=1431734922&sr=8-1&keywords=Eliette+Abecassis
">Amazon Eliette Abecassis </a></td></tr>

 
 
 
 </table>

    </div>

<!--
          <tr>  <td><a target="_blank" href=""> </a></td></tr>
          <tr>  <td><a target="_blank" href=""> </a></td></tr>
          <tr>  <td><a target="_blank" href=""> </a></td></tr>
          <tr>  <td><a target="_blank" href=""> </a></td></tr>

-->




 <div class="col-lg-2 ">
<table class="table table-striped table-bordered table-hover table-condensed table-responsive">
<tr>
  <th class="text-center">Israel</th>
</tr>
          <tr>  <td><a target="_blank" href="http://www.akadem.org/sommaire/themes/politique/geopolitique/guerre-et-paix/terrorisme-et-antisemitisme-la-france-sous-influence-16-03-2015-68384_193.php">Antisémite et terrorisme 1h00 </a> </td></tr>
          <tr>  <td><a target="_blank" href="http://www.akadem.org/sommaire/cours/l-antisemitisme-contemporain-en-france/dans-la-tete-des-antisemites-05-02-2015-67195_4566.php">Dans la tête des antisémites</a> </td></tr>
          <tr>  <td><a target="_blank" href="https://www.youtube.com/watch?v=GwBVHxjlMfU">the believers english</a> </td></tr>
          <tr>  <td><a target="_blank" href="https://www.youtube.com/watch?v=i9zKhAi0CRQ">the believers french</a> </td></tr>
          <tr>  <td><a target="_blank" href="https://www.marxists.org/francais/leon/CMQJ00.htm">La conception matérialiste de la question juive</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://www.lejdd.fr/Societe/Pierre-Andre-Taguieff-du-CNRS-Les-nouvelles-passions-antijuives-677752">Taguieff : "Les nouvelles passions antijuives"</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://www.franceculture.fr/oeuvre-la-deraison-antisemite-et-son-langage-dialogue-sur-l-histoire-et-l-identite-juive-alerte-de-j">La déraison antisémite et son langage</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://www.lemondedesreligions.fr/entretiens/videos/au-dela-de-la-violence-dialogue-entre-delphine-horvilleur-et-abdennour-bidar-02-04-2015-4617_207.php">Delphine Horvilleur</a> </td></tr>
          <tr>  <td><a target="_blank" href="http://lemondejuif.blogspot.fr/2013/03/parcours-de-lecture-yeshayahou-leibowitz.html">yeshayahou-leibowitz</a> </td></tr>
    	  <tr>  <td><a target="_blank" href="http://www.washingtonpost.com/posteverything/wp/2015/04/22/iran-executed-my-grandfather-now-the-regime-is-trying-to-hide-the-way-it-has-treated-other-jews/?postshare=591430489911647">Iran executed my grandfather </a></td></tr>
    	  <tr>  <td><a target="_blank" href="http://www.memorial98.org/2015/05/dieudonne-le-fond-dutroux.html">Dindonné</a></td></tr>


</table>
</div>



<!--
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
            
-->
    
    
    


<div class="col-lg-2">
    <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
        <tr>
            <th class="text-center">Antisémitisme</th>
        </tr>
        <tr>  <td><a target="_blank" href="http://ukmediawatch.org/2014/10/14/Shlomo-sands-sickening-guardian-article-slams-both-israel-and-judaism/">Shlomo Sand’s sickening Guardian articl</a>e</td></tr>
        <tr>  <td><a target="_blank" href="http://www.massorti.com/Comment-le-peuple-juif-fut-invente">Comment le peuple juif fut inventé</a></td></tr>
        <tr>  <td><a target="_blank" href="http://www.massorti.com/Comment-la-terre-d-Israel-fut">Comment la terre d’Israël fut inventée</a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>

        <!--
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>
        <tr>  <td><a target="_blank" href=""> </a></td></tr>

        -->

    </table>
</div>
            </div>



    <div class=" hide col-lg-3">
        <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
            <tr>
                <th class="text-center">Learning</th>
            </tr>

            <tr>  <td><a target="_blank" href="http://www.lynda.com/">lynda.com</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/PHP-tutorials/Introducing-PHP/123485-2.html"> Introducing-PHP</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html">PHP-MySQL-Essential-Training</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/PHP-tutorials/php-with-OOP-beyond-the-basics/653-2.html">php-with-OOP-beyond-the-basics </a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/MySQL-tutorials/Up-Running-MySQL-Development/158373-2.html">Up-Running-MySQL-Development</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/PHP-tutorials/Setting-date-time-independently/188214/375112-4.html">PHP Date Time</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/PHP-tutorials/Exporting-Data-Files-PHP/158375-2.html?srchtrk=index:1%0Alinktypeid:2%0Aq:php%0Apage:1%0As:relevance%0Asa:true%0Aproducttypeid:2">Exporting Data to Files with PHP</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/PHP-tutorials/Uploading-Files-Securely-PHP/158374-2.html?srchtrk=index:1%0Alinktypeid:2%0Aq:php%0Apage:1%0As:relevance%0Asa:true%0Aproducttypeid:2">Uploading Files Securely with PHP</a></td></tr>

            <tr>  <td><a target="_blank" href="http://www.lynda.com/phpMyAdmin-tutorials/Up-Running-phpMyAdmin/144202-2.html">Up-Running-phpMyAdmin</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/MySQL-tutorials/MySQL-Essential-Training/139986-2.html">MySQL-Essential-Training</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/HTML-tutorials/HTML-Essential-Training-2012/99326-2.html">HTML-Essential-Training</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/CSS-tutorials/Accessing-code-HTML-CSS-Dreamweaver/110716/114021-4.html?autoplay=true">Creating a Responsive Web Design</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/Web-Responsive-Design-tutorials/Responsive-Design-Fundamentals/104969-2.html">Responsive-Design-Fundamentals</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/jQuery-tutorials/jQuery-Essential-Training/183382-2.html?srchtrk=index:1%0Alinktypeid:2%0Aq:jquery%0Apage:1%0As:relevance%0Asa:true%0Aproducttypeid:2">JQuery-Essential</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/jQuery-Mobile-tutorials/jQuery-Mobile-Essential-Training/167067-2.html">Jquery Mobile Esstl </a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/search?q=jquery">Lynda search jquery</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/search?q=jquery+mobile">Lynda Search Jquery mobile </a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/search?q=php">Lynda Search PHP</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/Ajax-tutorials/Updating-information-without-reloading-page-using-AJAX/150163/155367-4.html">Ajax Lynda</a></td></tr>
            <!--
                      <tr>  <td><a target="_blank" href=""> </a></td></tr>
                      <tr>  <td><a target="_blank" href=""> </a></td></tr>
                      <tr>  <td><a target="_blank" href=""> </a></td></tr>
                      <tr>  <td><a target="_blank" href=""> </a></td></tr>
                      <tr>  <td><a target="_blank" href=""> </a></td></tr>


            -->

        </table>
    </div>

    <div class=" hide col-lg-2 col-sm-5">
        <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
            <tr>
                <th class="text-center">Bootstrap</th>
            </tr>
            <tr>  <td><a target="_blank" href="http://getbootstrap.com/">Bootstrap</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/search?q=bootstrap">bootstrap search Lynda </a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/Bootstrap-tutorials/Using-exercise-files/133339/151271-4.html?autoplay=true">Bootstrap-Lynda Basic</a> </td></tr>
            <tr>  <td><a target="_blank" href="http://www.lynda.com/Bootstrap-tutorials/Planning-thumbnail-gallery/161098/176516-4.html">Bootstrap Lynda interactive </a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/bootstrap-forms.php">bootstrap-forms </a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/bootstrap-tables.php">bootstrap-tables </a></td></tr>
            <tr>  <td><a target="_blank" href="https://gist.github.com/koenpunt/6424137#file-chosen-bootstrap-css">Bootstrap 3.0 theme for Chosen</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.sitepoint.com/find-a-route-using-the-geolocation-and-the-google-maps-api/">Google map geolocalisation</a></td></tr>
            <tr>  <td><a target="_blank" href="http://www.paulund.co.uk/add-delete-confirmation-to-form"> </a>modal on form</td></tr>

        </table>
    </div>

 <div class="container"   >
     <div class="row">

    <div class ="col-md-3">
    <ul class="list-group">
<li  class="list-group-item"><strong><u>cinema israelien</u></strong></li>
<li  class="list-group-item"> Hatoufim Les prisonniers de guerre</li>
<li  class="list-group-item"> Les citronniers</li>
<li  class="list-group-item">Tu n'aimeras point</li>
<li  class="list-group-item">Jaffa</li>
<li  class="list-group-item">Valse avec Bachir</li>
<li  class="list-group-item">La visite de la fanfare</li>
<li  class="list-group-item">Zaytoune</li>
<li  class="list-group-item">Une vie précieuse</li>
<li  class="list-group-item">Va, vis et deviens !</li>
<li  class="list-group-item">Le procès de Viviane Amsalem</li>
<li  class="list-group-item">5 caméras brisées</li>

</ul>

</div>
</div>


 <!--</div> --> <!--row-->



<div class="row">



<div class="col-md-8 text-justify" style="border-style: dotted;border-color: #0000ff; padding: 2em 2em 2em 2em;">
<h4>blague</h4>

<p>Le rabbin avec f2, le chauffeur vila</p>

<p>"Quelques Juifs (genre apprentis Inglorious Basterds) organisent secrètement un attentat contre Adolf
Hitler qui doit passer en voiture près de leur schtettl à midi. Ils préparent leur arme de
destruction massive, la planquent sous le pont à l'entrée du village et attendent. Passe midi, 12.30, 13
heures, Hitler n'arrive pas... Ils commencent à s'inquiéter et l'un dit à l'autre: "Pourvu
qu'il ne lui soit rien arrivé!"</p>
<hr>
<p>Une des préférées de mon père (rapportée ici par Emmanuelle Attali) :
Salomon est sur son lit de mort. Sa fidèle Sarah se tient comme il se doit auprès de lui, et se saisit
tendrement de sa main. Salomon lève vers elle un regard attendri et demande à sa femme d'une voix
fatiguée : <br>
- Dis moi, Sarah, mon amour, ma vie, quand nous vivions en Pologne et que les paysans du village voisin ont fait un
pogrom et ont brûlé notre maison, et que nous avons tout perdu, tu étais avec moi, comme
aujourd'hui, me tenant par la main, n'est-ce pas ?<br>
- Mais oui, Salomon, bien sûr, j'étais avec toi !<br>
- Et en 42, à Paris, quand nous avons dû fuir les rafles et une fois de plus tout laisser derrière
nous, nous étions encore ensemble, main dans la main, n'est-ce pas ?<br>
- Oui, Salomon, j'étais avec toi !<br>
- Et en 68, quand ils ont détruit le magasin, que l'entrepôt a pris feu et que l'assurance a
refusé de nous rembourser, tu étais encore là, comme aujourd'hui, à me tenir la main,
n'est-ce pas ?<br>
- Mais oui, Salomon, évidemment que j'étais avec toi !<br>
- Alors, tu sais quoi, Sarah, mon amour ... je crois que maintenant, tu peux me lâcher la main ... parce
qu'à force, après toutes ces épreuves que nous avons traversées ensemble ... je me demande
quand même si ce n'est pas toi qui me portes la poisse !!!</p>

<hr>
    Histoire juive :<br>

    Ca se passe dans les années 70 . Des immigrants juifs soviétiques arrivent en Israël. Un journaliste les interroge:<br>
    - Comment ca va l'antisémitisme en URSS?<br>
    - On ne peut pas se plaindre<br>
    - Comment est le climat en URSS?<br>
    - On ne peut pas se plaindre<br>
    - Et l'économie?<br>
    - On ne peut pas se plaindre<br>
    Eh bien alors, demande le journaliste pourquoi êtes vous venus en Israël?<br>
    - Parce qu'ici on peut se plaindre<br>

</div>
</div>
</div>  <!--container-->
<?php include ("../includes/layouts/footer_2.php");?>


