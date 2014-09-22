<?
require '../../adlisterconnect.php';

require_once 'inc/ad.class.php';

// CREATE AD OBJECT FROM GET REQUESTED AD ID TO EDIT THE RECORD
$adId = $_GET['id'];
$ad = new Ad($dbc, $adId);

// IF A FILE HAS BEEN SUCCESSFULLY UPLOADED TO THE FORM, MOVE IMAGE FILE
// TO THE IMG FOLDER AND UPDATE THE IMG PATH
if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
    // CAPTURE WEB PATH FROM UPLOADED FILE
    $ad->addImage($_FILES);
}
 
if (!empty($_POST)) {
    // SANITIZE AND FILTER USER INPUT DATA
    $ad->sanitize($_POST);

    // WHEN AD IS SAVED, RELOCATE USER TO AD VIEW PAGE
    header('location: view.php?id=' . $ad->id);
    exit;
}

require_once('header.php');

?>
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
            <input type="hidden" name="image_path" value="<?= $ad->imagePath; ?>">
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