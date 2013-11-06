<form method='POST' action='/posts/p_add'>
    <span class="error"> <?php if (isset($error)) {echo 'Cannot submit an empty Post!';}?></span> <br> 
    <h2><label for='content'>Enter new Post here:</label></h2>
    <textarea name='content' id='content'></textarea>

    <br><br>
    <input type='submit' value='Add post' style="background-color: green; color: #ffffff;">

</form>