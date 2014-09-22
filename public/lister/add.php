<?php
require '../../adlisterconnect.php';
require_once 'classes/ad.class.php';

// IF A FILE HAS BEEN SUCCESSFULLY UPLOADED TO THE FORM, MOVE IMAGE FILE
// TO THE IMG FOLDER AND SAVE A WEB PATH
if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
    // UPLOAD DIRECTORY PATH
    $uploadDir = '/vagrant/sites/codeup.dev/public/lister/img/';
    $uploadFilename = basename($_FILES['fileUpload']['name']);

    // UPLOADED PATH AND FILENAME
    $savedFile = $uploadDir . $uploadFilename;

    // MOVE TMP FILE TO IMAGE DIRECTORY
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $savedFile);

    // IMAGE PATH TO BE INSERTED INTO DATABASE
    $webPath = "img/" . $uploadFilename;
}

if(!empty($_POST)) {
    // CREATE AND POPULATE AD OBJECT WITH FORM DATA
    $ad = new Ad($dbc);
    $ad->title        = $_POST['title'];
    $ad->body         = $_POST['body'];
    $ad->contactName  = $_POST['contact_name'];
    $ad->contactEmail = $_POST['contact_email'];
    $ad->imagePath    = $_POST['image_path'];
    $ad->save();
    
    // REDIRECT USER TO VIEW PAGE FOR AD JUST CREATED
    header('location: view.php?id=' . $ad->id);
    exit;
}

?>

<? include 'header.php'; ?>

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
<? include 'footer.php'; ?>