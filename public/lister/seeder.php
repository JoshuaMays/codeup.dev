<?php

require('../../adlisterconnect.php');

$tags = ['new', 'used', 'stolen', 'free', 'for rent'];

$ads = [
    ['title' => 'hot truck', 'body' => 'oh man this truck is HOT HOT HOT. brand new. big wheels, mud in the engine, I think it is red, but I have only seen it in the dark. $3500.', 'name' => 'John Doe', 'email' => 'sneaky1@mail.com', 'image_path' => 'truck.png'],
    ['title' => 'not creepy van', 'body' => 'just a regular van. not creepy at all. $400 OBO', 'name' => 'Mr. F', 'email' => 'franklin@mail.com', 'image_path' => 'van.jpg'],
    ['title' => 'stair car', 'body' => 'tired of all the hop ons. please buy this from me. $100.', 'name' => 'Michal Bluth', 'email' => 'mbluth@bluthco.com', 'image_path' => 'staircar.png'],
    ['title' => 'lumber', 'body' => 'that tornado we had last week killed my fence. so come get some free lumber. it is just out on the curb. please only take the lumber.', 'name' => 'Mr Man', 'email' => 'winded@mail.com', 'image_path' => 'wood.jpg'],
    ['title' => 'hot cop/illusionist', 'body' => 'I am available for all kinds of crowds. Want to be amazed? Want to be danced all up on? I am your man.', 'name' => 'Job Bluth', 'email' => 'job@thealliance.org', 'image_path' => 'job.jpg']
];

    $tagIds = [];
    $adIds = [];

// POPULATE TAGS TABLE
foreach ($tags  as $tag) {
    $tagSeeder = "INSERT INTO tags (tag)
                  VALUES ('{$tag}')";

    $dbc->exec($tagSeeder);
    
    echo "Inserted ID " . $dbc->lastInsertId() . PHP_EOL;
    $tagIds[] = $dbc->lastInsertId();
}

// POPULATE ADS TABLE
foreach ($ads as $ad) {
    $adSeeder = "INSERT INTO ads (title, body, name, email, image_path)
                 VALUES ('{$ad['title']}', '{$ad['body']}', '{$ad['name']}', '{$ad['email']}', '{$ad['image_path']}')";
    
    $dbc->exec($adSeeder);
    
    echo "Inserted ID " . $dbc->lastInsertId() . PHP_EOL;
    
    $adIds[] = $dbc->lastInsertId();
}

$insertAdTag = $dbc->prepare('INSERT INTO ad_tag VALUES (:adId, :tagId)');

foreach ($adIds as $adId) {
    $insertAdTag->bindValue(':adId', $adId, PDO::PARAM_INT);
    
    $numTags = mt_rand(2,5);
    
    foreach (array_rand($tagIds, $numTags) as $key) {
        $insertAdTag->bindValue(':tagId', $tagIds[$key], PDO::PARAM_INT);
        
        $insertAdTag->execute();
    }
}

?>