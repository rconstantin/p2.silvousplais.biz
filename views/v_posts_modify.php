
<form method='POST' action='/posts/p_modify/<?=$post_id?>'>

    <h3><label for='content'>Modify Post:</label></h3>
    <textarea name='content' id='styled'><?=$post_text?></textarea>
    <br><br>
    <input type='submit' value='Modify Post' style="background-color: green; color: #ffffff;">

</form>