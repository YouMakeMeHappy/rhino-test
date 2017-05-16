<?php
/**
 * @var $model \app\models\Author
 */
?>
<form method="post" class="form">

    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="name" value="<?=$model->name;?>"/>
    </div>
    <div>
        <input type="submit" name="submit" value="submit"/>
    </div>

</form>