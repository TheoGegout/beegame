<?php


use Bee\Hive;

require_once __DIR__ . '/vendor/autoload.php';

session_start();

if (isset($_SESSION['beeArray'])) {
    $hive = $_SESSION['beeArray'];
    if ($_POST['button'] === 'Submit') {
        $hive->hitRandBee();
    } else {
        $hive->reset();
    }
} else {
    define('BEES', [
        'queens' => ['qty' => 1, 'life' => 100, 'hit' => 15],
        'workers' => ['qty' => 5, 'life' => 50, 'hit' => 20],
        'scouts' => ['qty' => 8, 'life' => 30, 'hit' => 15]
    ]);

    $hive = new Hive(...BEES);
}

$beeArray = $hive->getHive();

$_SESSION['beeArray'] = $hive;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bee Game</title>
</head>
<body>
<h1>BeeGame</h1>
    <div class="row">
        <?php
        foreach ($beeArray as $key => $bee) :
            if ($bee->type() === 'Queen') :
                ?>
            <div>
                    <?php
                    echo $bee->type;
                    ?>
                    Life:
                    <?php
                        echo $bee->lifeSpan;
                    if ($hive->hasGameFinished() && $bee->haveLife()) :
                        ?>
                        WIN!
                            <?php
                    elseif ($hive->hasGameFinished() && !$bee->haveLife()) :
                        ?>
                        LOST!
                            <?php
                    endif;
                    ?>
            </div>
                <?php
            elseif ($bee->type() === 'Worker') :
                ?>
            <div >
                        <?php echo $bee->type ?>
                        Life:
                        <?php echo $bee->lifeSpan ?>
            </div>
                <?php
            else :
                ?>
        <div >

                    <?php echo $bee->type ?>
                    Life:
                    <?php echo $bee->lifeSpan ?>
        </div>

            <?php
            endif;
        endforeach;
        ?>
    </div>
    <form action="" method="post" id="form">
        <?php
        if (!$hive->hasGameFinished()) :
            ?>
        <button type="submit" form="form" name="button" value="Submit">Hit</button>
            <?php
        else :
            ?>
        <button type="submit" form="form" name="button" value="Restart">Restart</button>
            <?php
        endif;
        ?>
    </form>
</body>
</html>
