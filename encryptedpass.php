<?php

$conexion = mysqli_connect("localhost","root","","pass");



//THE KEY FOR ENCRYPTION AND DECRYPTION
$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//ENCRYPT FUNCTION
function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}

//DECRYPT FUNCTION
function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
if(isset($_POST['submit'])){

    //GET POST VARIABLES
    $password = $_POST['contrasena'];
        
    //THE ENCRYPTION PROCESS
    $passencrypted=encryptthis($password, $key);
        
    //THE DECRYPTION PROCESS
    $passdecrypted=decryptthis($password, $key);
}

?>
