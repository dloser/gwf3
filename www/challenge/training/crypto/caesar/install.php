<?php
chdir("../../../../");
require_once("challenge/html_head.php");
if (!GWF_User::isAdminS()) {
	echo GWF_HTML::err('ERR_NO_PERMISSION');
	return;
}

$title = "Training: Crypto - Caesar I";
$solution = false;
$score = 1;
$url = "challenge/training/crypto/caesar/index.php";
$creators = "Gizmore";
$tags = 'Crypto,Training';
WC_Challenge::installChallenge($title, $solution, $score, $url, $creators, $tags, true);
require_once("challenge/html_foot.php");
?>
