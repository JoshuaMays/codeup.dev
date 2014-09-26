<?php
require('../../adlisterconnect.php');
require_once('inc/ad.class.php');

$ad = new Ad($dbc);

// IF A FILE HAS BEEN SUCCESSFULLY UPLOADED TO THE FORM, MOVE IMAGE FILE
// TO THE IMG FOLDER AND SAVE A WEB PATH
if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
    // CAPTURE WEB PATH FROM UPLOADED FILE
    $webPath = $ad->addImage($_FILES);
}

if(!empty($_POST)) {
    // SANITIZE AND FILTER USER INPUT DATA
    $ad->sanitize($_POST);
    
    // REDIRECT USER TO VIEW PAGE FOR AD JUST CREATED
    header('location: view.php?id=' . $ad->id);
    exit;
}

require_once('header.php');

?>
<div class="container">
    <h2 class="text-center">List an Item</h2>
    <div class="row">
        <? // DISPLAY IMAGE UPLOAD FORM BEFORE USER CAN POST AN AD ?>
        <? if (count($_FILES) == 0): ?>
        <form method="POST" enctype="multipart/form-data" action="/lister/add.php" role="form" class="form-horizontal">
            <p class="text-center"><em>Please upload an image before starting an ad.</em></p>
            <div class="form-group">
                <label for="upload" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-9">
                    <input type="file" name="fileUpload" id="upload" class="form-control"><br>
                    <a href="index.php" class="btn btn-default">Go Back</a>
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </div>
        </form>
        <?  endif; ?>
        <? // DISPLAY MAIN FORM AFTER USER HAS UPLOADED AN IMAGE ?>
        <? if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK): ?>
            <form method="POST" role="form" class="form-horizontal">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-9">
                        <select type="selection" class="form-control" name="category" id="category">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label">Body:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="body" id="body" rows="10" placeholder="Describe the item that you're listing here. Be creative..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_name" class="col-sm-2 control-label">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Paul Bunyan">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_email" class="col-sm-2 control-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="paul.bunyan@email.com">
                    </div>
                </div>
                <? // HIDDEN INPUT TO POST UPLOADED IMAGE INFORMATION ?>
                <? if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK):?>
                    <input type="hidden" value="<?= $webPath; ?>" name="image_path">
                <? endif; ?>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="/lister/" class="btn btn-default">Go Back</a>
                        <button type="submit" class="btn btn-primary">List It</button>
                    </div>
                </div>
            </form>
        <? endif; ?>
    </div>
</div>
<? require_once('footer.php'); ?>