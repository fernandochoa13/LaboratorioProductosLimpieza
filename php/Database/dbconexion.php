<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'laboratorioquimico'
);

if(isset($conn)) {
} else {
    echo "No se logro conectar";
}




?>



