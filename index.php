<?php require "layout/header.php" ?>

<form name="frmRegistration" method="post" action="register.php" enctype="multipart/form-data">
    <div class="demo-table">
        <div class="form-head">Sign Up</div>

        <?php if (! empty($errorMessage) && is_array($errorMessage)) : ?>
            <div class="error-message">
            <?php foreach($errorMessage as $message) {
                echo $message . "<br/>";
            } ?>
            </div>
        <?php endif; ?>


        <div class="field-column">
            <label for="userName">Username</label>
            <input type="text" class="demo-input-box"
                   required
                   name="userName" id="userName"
                   autocomplete="username"
                   onfocusout="validateUsername()"
                   value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>">
            <span class="error"></span>
        </div>


        <div class="field-column">
            <label for="password">Password</label>
            <input type="password" class="demo-input-box"
                   required
                   name="password" id="password"
                   autocomplete="new-password"
                   onfocusout="validatePassword()"
                   value="">
            <span class="error"></span>
        </div>
        <div class="field-column">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="demo-input-box"
                   required
                   name="confirm_password" id="confirm_password"
                   autocomplete="new-password"
                   onfocusout="validateConfirmPassword()"
                   value="">
            <span class="error"></span>
        </div>


        <div class="field-column">
            <label for="firstName">First Name</label>
            <input type="text" class="demo-input-box"
                   required
                   name="firstName" id="firstName"
                   onfocusout="validateFirstName()"
                   value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>">
            <span class="error"></span>
        </div>

        <div class="field-column">
            <label for="userEmail">Email</label>
            <input type="text" class="demo-input-box"
                   required
                   name="userEmail" id="userEmail"
                   onfocusout="validateEmail()"
                   value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>">
            <span class="error"></span>
        </div>

        <div class="field-column">
            <label for="image">Image</label>
            <input type="file" name="file" required>
        </div>


        <div class="field-column">
            <input type="submit" name="register-user" value="Register" class="btnRegister">
        </div>
    </div>
</form>

<?php require "layout/footer.php" ?>