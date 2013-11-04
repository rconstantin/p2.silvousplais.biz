
<form method='POST' action='/posts/p_modify/<?=$post_id?>'>

    <h2><label for='content'>Modify Post:</label></h2>
    <textarea name='content' id='content'><?=$post_text?></textarea>
    <br><br>
    <input type='submit' value='Modify Post' style="background-color: green; color: #ffffff;">

</form>