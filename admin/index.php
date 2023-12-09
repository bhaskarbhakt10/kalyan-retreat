<?php
require_once dirname(__FILE__, 2) . '/common/header.php';
require_once ROOT_PATH . 'admin/admin-head/admin-head.php';


if (!empty($_GET['q']) && array_key_exists('q', $_GET)) {

    $query = $_GET['q'];
   

    $allPages = scandir(ROOT_PATH . '/admin/pages');
    unset($allPages[0]);
    unset($allPages[1]);
    // print_r($allPages);
    if (in_array($query . '.php', $allPages)) {
        foreach ($allPages as $form) {
            if (strcasecmp($query . '.php', $form) === 0) {
?>

                <div class="main admin-page-<?php echo preg_replace('/ /', '-', $query) ?>">
                    <div class="main-container">
                        <?php require_once ROOT_PATH . 'admin/pages/' . $query . '.php'; ?>
                    </div>
                </div>

        <?php
            }
        }
    } else {
        ?>
        <div class="main admin-page-not-found ">
            <div class="container">
                <?php require_once  ROOT_PATH . 'admin/log-in.php'; ?>
            </div>
        </div>
<?php

    }
} else {
    header('Location: ' . ROOT_URL . 'admin/404.php');
}
require_once dirname(__FILE__, 2) . '/common/footer.php';
?>