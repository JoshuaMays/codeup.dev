<?php

require_once('adlisterconnect.php');

$query = 'CREATE TABLE tags (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tag VARCHAR(20) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY tag_type_unique (tag)
)';

$dbc->exec($query);

$query = 'CREATE TABLE ad_tag (
    ad_id INT UNSIGNED NOT NULL,
    tag_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (ad_id, tag_id),
    FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ad_id) REFERENCES ads (id) ON DELETE CASCADE ON UPDATE CASCADE
)';

$dbc->exec($query);

?>