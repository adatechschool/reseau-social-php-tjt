<?php
if ($_SESSION['connected_id'] == "") {
    header("Location: login.php");
}
?>