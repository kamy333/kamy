<?php require_once('../includes/initialize.php'); ?>
<?php // confirm_logged_in(); ?>

<?php $layout_context = "public"; ?>
<?php $active_menu="about"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=false; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=false; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>
</div> <!--close default container-->

<!--  <div class="container-fluid about_us">-->

    <h4 class="text-center"><mark><a href="<?php echo $_SERVER["PHP_SELF"] ?>">About us</a> </mark></h4>



<div class="row">
            <ul>
<!--                <li class="thumbnail col-sm-3 col-xs-6 ">-->
<!--                    <a href="#pablo_arza"  data-toggle="modal"><img src="img/pablo.JPG" style="width: 65%;height: 25%;" alt="Pablo Arza fondateur et directeur general" class="img-responsive"></a>-->
<!--                    <div class="caption">-->
<!--                        <h3>Pablo Arza</h3>-->
<!--                        <p>Fondateur &amp; Directeur général</p>-->
<!--                        <p><a href="#pablo_arza" data-toggle="modal" class="btn btn-primary" role="button">Lire plus</a></p>-->
<!--                    </div>-->
<!---->
<!--                </li>-->
<!---->
<!---->
<!---->
<!--                <li class="thumbnail col-sm-3 col-xs-6 ">-->
<!--                    <a href="#djamila_amrani" data-toggle="modal"><img src="img/no_user.jpg" alt="Djamila Amrani chauffeur"  class="img-responsive"> ></a>-->
<!--                    <div class="caption">-->
<!--                        <h3>Djamila Amrani</h3>-->
<!--                        <p>Chauffeur</p>-->
<!--                         <p><a href="#djamila_amrani" data-toggle="modal" class="btn btn-primary" role="button">Lire plus</a></p>-->
<!--                    </div>-->
<!--                </li>-->

<!--                <li class="thumbnail col-sm-3 col-xs-6 ">-->
<!--                    <a href="#pierre_alain_bonfils" data-toggle="modal"><img src="img/no_user.jpg" alt="Pierre-Alain Bonfils chauffeur" class="img-responsive">></a>-->
<!--                    <div class="caption">-->
<!--                        <h3>Pierre-Alain Bonfils</h3>-->
<!--                        <p>Chauffeur</p>-->
<!--                         <p><a href="#pierre_alain_bonfils" data-toggle="modal" class="btn btn-primary" role="button">Lire plus</a></p>-->
<!--                    </div>-->
<!--                </li>-->
<!---->
<!---->
<!--                <li class="thumbnail col-sm-3 col-xs-6 ">-->
<!--                    <a href="#luan_haziri" data-toggle="modal"><img src="img/no_user.jpg" alt="Luan Haziri chauffeur" class="img-responsive">></a>-->
<!--                    <div class="caption">-->
<!--                        <h3>Luan Haziri</h3>-->
<!--                        <p>Chauffeur</p>-->
<!--                        <p><a href="#luan_haziri" data-toggle="modal" class="btn btn-primary" role="button">Lire plus</a></p>-->
<!--                    </div>-->
<!--                </li>-->

</ul>
</div>

<div class="row">
<ul>
<!--                                <li class="thumbnail col-sm-3 col-xs-6 ">-->
<!--                    <a href="#vincent_dubouloz" data-toggle="modal"><img src="img/no_user.jpg" alt="Vicent Dubouloz, chauffeur" class="img-responsive">></a>-->
<!--                    <div class="caption">-->
<!--                        <h3>Vincent Dubouloz</h3>-->
<!--                        <p>Chauffeur</p>-->
<!--                        <p><a href="#vincent_dubouloz" data-toggle="modal" class="btn btn-primary" role="button">Lire plus</a></p>-->
<!--                    </div>-->
<!--                </li>-->

<!--                <li class="thumbnail col-sm-3 col-xs-6 ">-->
<!--                    <a href="#secretaire" data-toggle="modal"><img src="img/no_user.jpg" alt="secretaire"  class="img-responsive">></a>-->
<!--                    <div class="caption">-->
<!--                        <h3>Nom secrétaire</h3>-->
<!--                        <p>secrétaire</p>-->
<!--                        <p><a href="#secretaire" data-toggle="modal" class="btn btn-primary" role="button">Lire plus</a></p>-->
<!--                    </div>-->
<!--                </li>-->

                <li class="thumbnail col-sm-3 col-xs-6 ">
                    <a href="#kamran_nafisspour" data-toggle="modal"><img src="img/kamy.JPG" style="width: 65%;height: 25%;" alt="Kamran Nafisspour informaticien"  class="img-responsive">></a>
                    <div class="caption">
                        <h3>Kamran Nafisspour</h3>
                        <p>Consultant Informatique</p>
                        <p><a href="#kamran_nafisspour"  data-toggle="modal" class="btn btn-primary" role="button">Lire plus</a></p>
                    </div>
                </li>


            </ul>
		</div>

<!--</div>-->
    <!-- modal windows -->

<?php $nom_modal_id="pablo_arza"; $nom_employee="Pablo Arza" ?>

    <div id="<?php echo $nom_modal_id ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
                    <h3 class="modal-title"><?php echo $nom_employee ?></h3>
                </div>
                <div class="modal-body">
                    <p><img src="img/pablo_2.JPG" alt="<?php echo $nom_employee ?>" class="img-responsive pull-left"> Pablo is the founder, owner and manager of Transmed SA founded in 1999. The compagny is becoming more and more successfull and now have 5 full time employees. The strengh of the compagny is the flexibility for clients to use the services even at late hours or week-end . Transmed have few adapted vehicles for wheelchairs. The price are of the most competitive in the market</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>





<?php $nom_modal_id="djamila_amrani"; $nom_employee=ucwords(str_replace("_"," ",$nom_modal_id));?>

    <div id="<?php echo $nom_modal_id ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
                    <h3 class="modal-title"><?php echo $nom_employee ?></h3>
                </div>
                <div class="modal-body">
                    <p><img src="img/no_user.jpg" style="width: 40%;height: 40%;" alt="<?php echo $nom_employee ;?>" class="img-responsive pull-left ">Djamilla is a full-time driver and been with the company for more than eight years. Before joining our compagny she was driving ambulances  She is a very warm person and attentive to your cares and need. She always ready to help and accomodate the customer wishes</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<?php $nom_modal_id="pierre_alain_bonfils"; $nom_employee="Pierre-Alain Bonfils";?>

    <div id="<?php echo $nom_modal_id ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
                    <h3 class="modal-title"><?php echo $nom_employee ?></h3>
                </div>
                <div class="modal-body">
                    <p><img src="img/no_user.jpg" style="width: 40%;height: 40%;" alt="<?php echo $nom_employee ;?>" class="img-responsive pull-left ">Pierre-Alain works at Transmed since 2010. Previously he worked as a Taxi driver. Nice, generous Pierre Alain love to interact with people and to help them.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




<?php $nom_modal_id="luan_haziri"; $nom_employee=ucwords(str_replace("_"," ",$nom_modal_id));?>

    <div id="<?php echo $nom_modal_id ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
                    <h3 class="modal-title"><?php echo $nom_employee ?></h3>
                </div>
                <div class="modal-body">
                    <p><img src="img/no_user.jpg"  alt="<?php echo $nom_employee ;?>" class="img-responsive pull-left "></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<?php $nom_modal_id="vincent_dubouloz"; $nom_employee=ucwords(str_replace("_"," ",$nom_modal_id));?>

    <div id="<?php echo $nom_modal_id ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
                    <h3 class="modal-title"><?php echo $nom_employee ?></h3>
                </div>
                <div class="modal-body">
                    <p><img src="img/no_user.jpg"  alt="<?php echo $nom_employee ;?>" class="img-responsive pull-left ">Vincent joined the company in 2011 and he works 80% part-time. He is a father of 2.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<?php $nom_modal_id="secretaire"; $nom_employee=ucwords(str_replace("_"," ",$nom_modal_id));?>

    <div id="<?php echo $nom_modal_id ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
                    <h3 class="modal-title"><?php echo $nom_employee ?></h3>
                </div>
                <div class="modal-body">
                    <p><img src="img/no_user.jpg" style="width: 40%;height: 40%;" alt="<?php echo $nom_employee ;?>" class="img-responsive pull-left ">She has recently joined the team as a secretary in order to help on administrative tasks. She is a part-time employee and was previously a nurse.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php $nom_modal_id="kamran_nafisspour"; $nom_employee="Kamran Nafisspour" ;?>

    <div id="<?php echo $nom_modal_id ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
                    <h3 class="modal-title"><?php echo $nom_employee ?></h3>
                </div>
                <div class="modal-body">
                    <p><img src="img/kamy.JPG" style="width: 40%;height: 40%;" alt="<?php echo $nom_employee ;?>" class="img-responsive pull-left ">Kamran or Kamy is a client and friend for more than 10 years. He is struck with a genetic diseases named Inclusion Body Myositis. He always been active and works in a bank as a Director and is a certified public accountant but also have good knowledge of productivity tools like Microsoft Excel or Access.  Two years ago an invoicing system in Microsoft Access which I use now</p>
                    <p>Last year he started to learn web related programing and he designed this website but also an enterprise system were planning is made, travel are recorded by each driver which then can be collected for invoicing. </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid">
<?php include("../includes/layouts/footer_2.php"); ?>