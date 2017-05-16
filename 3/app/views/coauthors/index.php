<?php

/**
 * @var $books[]
 */
if (!empty($books)): ?>
    <table class="table-centered">
        <thead>
            <tr><th>Title</th><th>Number of authors</th></tr>
        </thead>
        <tbody>
            <?php
            foreach ($books as $book): ?>
                <tr>
                    <td><?=$book['title'];?></td>
                    <td>
                        <?=$book['num'];?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
<?php
    endif;