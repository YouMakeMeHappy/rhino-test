<?php
/**
 * @var $model \app\models\Book
 * @var $authors \app\models\Author[]
 * @var $authors_ids[] Author ids
 */

?>
<form method="post" class="form">

    <div>
        <label for="name">Title</label>
        <input type="text" id="name" name="title" placeholder="title" value="<?=$model->title;?>"/>
    </div>
    <div>
        <label for="name">Author(s)</label>
        <select multiple name="author[]">
        <?php foreach ($authors as $author): ?>
            <option value="<?=$author->id?>" <?=in_array($author->id, $model->authorsIds) ? 'selected=""' : '';?>><?=$author->name;?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div>
        <input type="submit" name="submit" value="submit"/>
    </div>

</form>