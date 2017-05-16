<html>
    <title>Test tasks (Victor Shirokiy)</title>
    <head>
        <link type="text/css" rel="stylesheet" charset="UTF-8" href="/assets/css/style.css"/>
        <script src="/assets/js/scripts.js"></script>
    </head>
    <body>
    <div class="tab">
        <button class="tablinks" onclick="openTask(event, '1')">Task 1</button>
        <button class="tablinks" onclick="openTask(event, '2')">Task 2</button>
        <button class="tablinks" onclick="openTask(event, '3')">Task 3</button>
    </div>

    <div id="1" class="tabcontent">
        <h3>Task 1</h3>
        <table>
            <tr><td>Result</td><td>Code</td></tr>
            <tr><td><?php require_once '1/index.php';?></td><td><?php show_source('1/index.php');?></td></tr>
        </table>
    </div>

    <div id="2" class="tabcontent">
        <h3>Task 2</h3>
        <table>
            <tr><td>Result</td><td>Code</td></tr>
            <tr><td><?php require_once '2/index.php';?></td><td><?php show_source('2/index.php');?></td></tr>
        </table>
    </div>

    <div id="3" class="tabcontent">
        <h3>Task 3</h3>
        <button class="fullscreen-btn" onclick="fullScreen('task3')">Full screen</button>
        <iframe id="task3" src="/3"></iframe>
    </div>
    </body>
</html>