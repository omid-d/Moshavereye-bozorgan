<?php
$question = '';
$msg = 'بپرس سوالت رو!';
$asami=file_get_contents("people.json");
$araye=json_decode($asami,true);
if(!$_POST["person"]){
    $en_name=array_rand($araye,1);
    $fa_name=$araye[$en_name];
}
else{
    $en_name=$_POST["person"];
    $fa_name=$araye[$en_name];
    $payam=file("messages.txt");
    $question=$_POST["question"];
    $hash=hash('sha256',"$question"."$en_name");
    $msg=$payam[$hash%count($payam)];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>
<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
        <?php
        if($question){echo '<span id="label">پرسش:</span>';}
        ?>
        <span id="label">پرسش:</span>
        <span id="question"><?php echo $question ?></span>
    </div>
    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
                <?php
                foreach($araye as $esm => $esm1){
                    if($esm==$en_name){
                        echo '<option value='."$esm".' selected>'."$esm1".'</option>';
                    }
                    else {
                        echo '<option value='."$esm".'>'."$esm1".'</option>';
                    }
                }
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>