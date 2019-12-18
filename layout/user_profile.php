<?php
namespace RegisterTest;

require("header.php"); ?>

<?php if(isset($_GET['id'])) {
    require_once("../User.php");
    $user = new User();
    $user_info = $user->getUser($_GET['id'])[0];
} ?>

<h2 style="text-align:center">User Profile Card</h2>

<div class="card">
    <img src="../img/<?php echo $user_info["image"]; ?>" alt="profile-img" style="width:100%">
    <h1><?php echo $user_info["user_name"]; ?></h1>
    <p class="title"><?php echo $user_info["first_name"]; ?></p>
    <p><?php echo $user_info["email"]; ?></p>
    <p><a class="contact-button" href="mailto:<?php echo $user_info["email"]; ?>">Contact</a></p>
</div>

<?php require("footer.php"); ?>