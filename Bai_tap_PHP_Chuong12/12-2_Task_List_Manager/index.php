\
<?php
// EXERCISE 12-2 - Improve the Task List Manager application
// Store tasks in SESSION instead of hidden HTML fields.
// Session lasts for 1 year.

$one_year = 60 * 60 * 24 * 365;

session_set_cookie_params([
    'lifetime' => $one_year,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [
        'Learn PHP',
        'Learn Sessions'
    ];
}

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $task = trim($_POST['task'] ?? '');

    if ($task !== '') {
        $_SESSION['tasks'][] = $task;
    }

    header('Location: index.php');
    exit;
}

if ($action === 'delete') {
    $task_index = isset($_POST['task_index']) ? (int)$_POST['task_index'] : -1;

    if (isset($_SESSION['tasks'][$task_index])) {
        array_splice($_SESSION['tasks'], $task_index, 1);
    }

    header('Location: index.php');
    exit;
}

if ($action === 'clear') {
    $_SESSION['tasks'] = [];

    header('Location: index.php');
    exit;
}

$tasks = $_SESSION['tasks'];

include 'task_list.php';
