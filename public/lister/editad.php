<?
require '../../adlisterconnect.php';

require_once 'classes/ad.class.php';

// CREATE AD OBJECT FROM GET REQUESTED AD ID TO EDIT THE RECORD
$adId = $_GET['id'];
$ad = new Ad($dbc, $adId);

// IF A FILE HAS BEEN SUCCESSFULLY UPLOADED TO THE FORM, MOVE IMAGE FILE
// TO THE IMG FOLDER AND SAVE A WEB PATH
if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
    // UPLOAD DIRECTORY PATH
    $uploadDir = '/vagrant/sites/codeup.dev/public/lister/img/';
    $uploadFilename = basename($_FILES['fileUpload']['name']);
    $savedFile = $uploadDir . $uploadFilename;

    // MOVE TMP FILE TO UPLOADS DIRECTORY
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $savedFile);

    // PATH THAT WILL BE INSERTED INTO DATABASE
    $webPath = "img/" . $uploadFilename;
}
 
if (!empty($_POST)) {
    // WHEN USER SUBMITS EDIT AD FORM, ASSIGN UPDATED FIELDS
    // TO OBJECT PROPERTIES AND SAVE THE AD
    $ad->title        = $_POST['title'];
    $ad->body         = $_POST['body'];
    $ad->contactName  = $_POST['contact_name'];
    $ad->contactEmail = $_POST['contact_email'];
    $ad->imagePath    = $_POST['postImage'];

    $ad->save();

    // WHEN AD IS SAVED, RELOCATE USER TO AD VIEW PAGE
    header('location: view.php?id=' . $ad->id);
    exit;
}


?>
<? include 'header.php'; ?>

<div class="container">
    <h2 class="text-center">Edit Your Ad</h2>
    <div class="row">
        <form method="POST" enctype="multipart/form-data" action="/lister/editad.php?id=<?= $adId ?>" role="form" class="form-horizontal">
            <div class="form-group">
                <label for="upload" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-9">
                    <input type="file" name="fileUpload" id="upload" class="form-control"><br>
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </div>
        </form>
        <form method="POST" action="/lister/editad.php?id=<?= $adId ?>" role="form" class="form-horizontal">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title:</label>
                <div class="col-sm-9">
                    <input type="text" value="<?= $ad->title; ?>" class="form-control" name="title" id="title" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Body:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="body" id="body" rows="10" placeholder="Describe the item that you're listing here. Be creative..."><?= $ad->body; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="contact_name" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-9">
                    <input type="text" value="<?= $ad->contactName; ?>" class="form-control" name="contact_name" id="postAuthor" placeholder="Janice Smithereens">
                </div>
            </div>
            <div class="form-group">
                <label for="postEmail" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-9">
                    <input type="email" value="<?= $ad->contactEmail; ?>" class="form-control" name="contact_email" id="postEmail" placeholder="janice.smithereens@email.com">
                </div>
            </div>
            <? // IF USER HAS SUCCESSFULLY UPLOADED A NEW IMAGE ASSIGN NEW IMAGE PATH TO FORM IMAGE FIELD ?>
            <? if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK):?>
                <input type="hidden" name="postImage" value="<?= $webPath; ?>">
            <? // OR USE CURRENT IMAGE PATH ?>
            <? else: ?>
                <input type="hidden" name="postImage" value="<?= $ad->imagePath; ?>">
            <? endif; ?>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <a href="index.php" class="btn btn-default">Go Back</a>
                    <button type="submit" class="btn btn-primary">List It</button>
                </div>
            </div>
        </form>
    </div>
</div>
<? include 'footer.php'; ?>