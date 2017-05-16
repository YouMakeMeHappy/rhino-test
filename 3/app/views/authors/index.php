<a class="add" href="<?=APP_WEB_PATH?>authors/create">Add Author</a>
<div class="search">
    <form method="get">
        <label for="filter">Filter by book title</label>
        <input id="filter" name="book_title" value="<?=$bookTitle?>" placeholder="Book title"/>
    </form>
</div>
<?php

/**
 * @var $authors \app\models\Author[]
 */
if (!empty($authors)): ?>
    <table class="table-centered">
        <thead>
            <tr><th>Name</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php
            foreach ($authors as $author): ?>
                <tr>
                    <td><?=$author->name;?></td>
                    <td>
                        <a href="<?=APP_WEB_PATH;?>authors/update?id=<?=$author->id;?>">Edit</a>
                        <a href="<?=APP_WEB_PATH;?>authors/delete?id=<?=$author->id;?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
<?php
    endif;