<?php

require '../../adlisterconnect.php';
require_once 'classes/ad_manager.class.php';

// CREATE AD MANAGER AND ADS ARRAY
$adManager = new AdManager($dbc);
$ads = $adManager->loadAds();
?>

<? include 'header.php'; ?>
<div id="pageWrap">
    <div class="page-header">
        <div class="col-sm-8 col-sm-offset-2">
            <h1>Welcome to Lister <br><small>Search for an Ad, List an Ad. We don't care.</small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <? // LOOP THROUGH ADS TO DISPLAY ALL ADS IN DATABASE ?>
                <? foreach($ads as $adIndex => $adContent): ?>
                    <!-- ASSIGN CLEAR CLASS TO EVERY THIRD AD, SO ROWS OF THREE ADS LINE UP CORRECTLY -->
                    <div class="col-sm-4 col-md-4 <?= $adIndex % 3 == 0 ? 'clear' : ''; ?>">
                        <div class="thumbnail adListing">
                            <a href="view.php?id=<?= $adContent->id; ?>"><img src="<?= "img/" . $adContent->imagePath; ?>" alt="<?= $adContent->title ?> Photo"></a>
                            <div class="caption">
                                <h3><a href="view.php?id=<?= $adContent->id; ?>"><?= $adContent->title; ?></a></h3>
                                <p>Contact: <?= $adContent->contactName; ?></p>
                                <p><em><?= $adContent->createdAt->format('l, F jS, Y');  ?></em></p>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<? include 'footer.php'; ?>