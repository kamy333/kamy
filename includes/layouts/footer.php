    <footer id="footer">
<!--    <div id="footer">Copyright <?php //echo date("Y"); ?>, ikamy.ch</div>
-->     Copyright <?php echo date("Y"); ?>, ikamy.ch
	</footer>


    <?php if($layout_header=="footer")  {?>
        </div><!-- #wrapper -->
        <?php };?>

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
