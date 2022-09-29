<?php
require "init.php";
$function = new Database();
$id = $_GET['id'];

$res = $function->Delete($id);
if($res){
    echo "<script>
        alert ('Data Berhasil Dihapus');
            document.location.href = 'index.php'
            </script>";
} else {
    echo "Failed to Delete";
}


?>