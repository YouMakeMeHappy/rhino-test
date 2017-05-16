<a class="add" href="<?=APP_WEB_PATH?>books/create">Add Book</a>
<div class="search">
    <form method="get">
        <label for="filter">Filter by author name</label>
        <input id="filter" name="author_name" value="<?=$authorName?>"/>
    </form>
</div>
<?php

/**
 * @var $books \app\models\Book[]
 */
if (!empty($books)): ?>
    <table class="table-centered">
        <thead>
            <tr><th>Title</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php
            foreach ($books as $book): ?>
                <tr>
                    <td><?=$book->title;?></td>
                    <td>
                        <a href="<?=APP_WEB_PATH;?>books/update?id=<?=$book->id;?>">Edit</a>
                        <a href="<?=APP_WEB_PATH;?>books/delete?id=<?=$book->id;?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
<?php
    endif;