
<?php echo str_repeat("<br>", 4); ?>

<!--   <div class="" >-->
    <footer class="row text-center nav navbar-fixed-bottom my_footer">
    <p> <small>&#xA9;&nbsp;2014 - <?php echo date("Y"); ?>, ikamy.ch</small></p>
	</footer>

</div>   <!--Div class container-->

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/bootstrap.min.js"></script>







<?php     if ( isset($javascript) && $javascript=="form_course"){?>
    <script src="js/my_form_course_validation.js"></script>
    <?php }?>

    <?php     if ( isset($javascript) && $javascript=="manage_course"){?>
        <script src="js/manage_course_view.js"></script>
    <?php }?>

<?php     if ( isset($javascript) && $javascript=="manage_client"){?>
    <script src="js/manage_client_view .js"></script>
<?php }?>


<!--            testing            -->

    <script src="js/test_tooltips.js"></script>


    </body>

<!--    <script src="javascripts/formvalidation.js"></script>-->
<!--   <script src="javascripts/js_admin.js"></script>-->

    
    
</html>
<?php
  // 5. Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	}
?>
