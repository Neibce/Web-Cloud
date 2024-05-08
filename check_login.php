<?php
function postCaptcha($value)
{
    $data = array('secret' => 'YOUR_SECRET_KEY', 'response' => $value);
    $url = "https://www.google.com/recaptcha/api/siteverify";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response, true);
    if ($response['success']) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

if ($_POST['g-recaptcha-response'] == null) {
    echo "
    <script type=\"text/javascript\">
      parent.login().captchaError();
    </script>
    ";
    exit;
}
if (!isset($_POST['user_pw'])) {
    exit;
}

$user_pw = $_POST['user_pw'];
$pw = crypt('YOUR_PASSWORD');

if (crypt($user_pw, $pw) != $pw) {
    echo "<script type=\"text/javascript\">
parent.login().error();
</script>";
    exit;
}
if (!postCaptcha($_POST['g-recaptcha-response'])) {
    echo "
    <script type=\"text/javascript\">
      parent.login().captchaError();
    </script>
    ";
    exit;
}
session_start();
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SESSION['user_ipadd'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
} else {
    $_SESSION['user_ipadd'] = $_SERVER['REMOTE_ADDR'];
}
?>

<script type="text/javascript">
  parent.login().success();
</script>
