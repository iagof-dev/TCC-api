<?php
error_reporting(-1);

include_once("db.php");

class cliente
{

    public function checkPermission()
    {
        //Token: c38a7e02bfca0da201015ce51931b09d462080b7

        if ($_POST['authpass'] == "c38a7e02bfca0da201015ce51931b09d462080b7") {
            unset($_POST['apipass']);
            return true;
        }
        return false;
    }
}