<?php
/**
 * Created by PhpStorm.
 * User: Kamran
 * Date: 5/5/2015
 * Time: 11:07 PM
 */
?>
<!--   TODO begin testing -->

<?php if (is_admin()&& is_kamy()) {?>
<div class="row">
<pre>
<br>
<?php
if ($_GET) {
    echo 'Contents of the $_GET array: <br>';
    print_r($_GET);
   } elseif ($_POST) {
    echo 'Contents of the $_POST array: <br>';
    print_r($_POST);
}

echo $_SERVER['PHP_SELF']."<br>";
echo $_SERVER['COMPUTERNAME'];
 ?>
</pre>
</div>
<!--  TODO end testing       -->
<?php } ?>