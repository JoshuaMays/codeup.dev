<?

require_once('../../adlisterconnect.php');
require_once('inc/ad.class.php');

// DISPLAY SELECTED AD
if (isset($_GET['id'])) {
    $adID = $_GET['id'];
    $ad = new Ad($dbc, $adID);
    $tags = $ad->showTags();
}
else {
    throw new Exception("YO PICK AN AD, BRO");
}

require_once('header.php');

?>
    <div class="container">
        <div class="jumbotron">
            <!-- DISPLAY AD TITLE AND BODY -->
            <h1><?= $ad->title; ?></h1>
            <p><?= $ad->body; ?></p>
            <!-- LINK TO EDIT PAGE FOR AD -->
            <p class="btn btn-primary"><a href="editad.php?id=<?= $adID ?>">Edit</a></p>
        </div>
        <!-- POST DATE AND CONTACT INFO -->
        <p class="listDate"><em>Posted: <?= $ad->createdAt->format('l, F jS, Y'); ?></em></p>
        <p>Contact: <a href="mailto:<?= $ad->contactEmail; ?>"><?= $ad->contactName; ?></a></p>
        <div id="tags">
            <? foreach ($tags as $tag_id => $tag) : ?>
                <a href="tag-show.php?tag=<?= $tag_id; ?> "><button class="btn btn-info btn-xs"><?= $tag; ?></button></a>
            <? endforeach; ?>
        </div>
        <!-- CLICK AD IMAGE TO LOAD A MODAL IMAGE POPUP -->
        <img id="adImage" src="<?= "img/" . $ad->imagePath; ?>" class="img-responsive" alt="<?= $ad->title ?> Photo" data-toggle="modal" data-target="#modalImage">
        <div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="modalImageLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal"><span id="closeButton" aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="modalImageLabel"><?= $ad->title; ?></h4>
                    </div>
                    <div class="modal-body">
                        <img id="largerModalImage"src="<?= "img/" . $ad->imagePath; ?>" class="img-responsive" alt="<?= $ad->title; ?>">
                    </div>
                </div>
            </div>
        </div><!-- END #modalImage -->
    </div>
<? require_once('footer.php'); ?>