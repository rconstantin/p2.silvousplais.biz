
<h2> login Page </h2>
<p><span class="error">* required field.</span></p>

<form method='POST' action='/users/p_login'>

    <p1>Email</p1><br>
    <input type='text' name='email' value="<?php if(isset($email)) {echo $email;} ?>">
    <span class="error">* <?php if (isset($error) AND $error == 'InvalidEmail') {echo 'Email Required: Please Enter a Valid Email';}?></span>   
    <br><br>

    <p1>Password</p1><br>
    <input type='password' name='password'>
    <span class="error">* <?php if (isset($error) AND $error == 'InvalidPassword') {echo 'Password Required: Enter a Valid Password';}?>
                          <?php if (isset($error) AND $error == 'PasswordMismatch') {echo 'Password Mismatch: Enter a Valid Password';}?> </span>   
    <br><br>

    <input type='submit' value ='Log in' style="background-color: green; color: #ffffff;">

</form>