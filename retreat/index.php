<?php
// print_r($_GET);

require_once dirname(__FILE__, 2) . '/common/header.php';
if (!empty($_GET['q']) && !empty($_GET['key']) && array_key_exists('q', $_GET) && array_key_exists('key', $_GET) && strcasecmp($_GET['key'], 'register') === 0) {

    $query = $_GET['q'];
    $key = $_GET['key'];

    $allForms = scandir(ROOT_PATH . '/retreat/forms');
    unset($allForms[0]);
    unset($allForms[1]);
    // print_r($allForms);
    if (in_array($query . '.php', $allForms) && strcasecmp($key, 'register') === 0) {
        foreach ($allForms as $form) {
            if (strcasecmp($query . '.php', $form) === 0) {
?>

                <div class="main form-<?php echo preg_replace('/ /', '-', $query) ?> bg-stone-100">
                    <div class="main-container">
                        <?php require_once ROOT_PATH . 'retreat/forms/' . $query . '.php'; ?>
                    </div>
                </div>

        <?php
            }
        }
    } else {
        ?>
        <div class="main form-not-found ">
            <div class="container">
                <?php require_once  ROOT_PATH . 'retreat/forms/404.php'; ?>
            </div>
        </div>
<?php

    }
} else {
    header('Location: ' . ROOT_URL . '404.php');
}
require_once dirname(__FILE__, 2) . '/common/footer.php';
?>