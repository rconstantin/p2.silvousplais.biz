
<h2> Signup Page </h2>
<p><span class="error">* required field.</span></p>

<form method='POST' action='/users/p_signup'>
    <p1>First Name </p1><br>
    <input type='text' name='first_name' value="<?php if(isset($firstName)) {echo $firstName;} ?>">
    <span class="error">* <?php if (isset($error) AND $error == 'InvalidFirstName') {echo 'Enter a Valid First Name';}?></span>
    <br><br>

    <p1>Last Name</p1><br>
    <input type='text' name='last_name' value="<?php if(isset($lastName)) {echo $lastName;} ?>">
    <span class="error">* <?php if (isset($error) AND $error == 'InvalidLastName') {echo 'Enter a Valid Last Name';}?></span>   
    <br><br>

    <p1>Email</p1><br>
    <input type='text' name='email' value="<?php if(isset($email)) {echo $email;} ?>">
    <span class="error">* <?php if (isset($error) AND $error == 'InvalidEmail') {echo 'Email Already in use. Please Enter Valid/Unique Email';}?></span>   
    <br><br>

    <p1>Password</p1><br>
    <input type='password' name='password'>
    <span class="error">* <?php if (isset($error) AND $error == 'InvalidPassword') {echo 'Enter a Valid Password';}?></span>   
    <br><br>

    <input type='submit' style="background-color: green; color: #ffffff;">

</form>