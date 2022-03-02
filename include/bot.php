<!-- Created By CodingNepal -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    Somehow I got an error, so I comment the title, just uncomment to show -->
    <!-- <title>Simple Chatbot in PHP | CodingNepal</title> 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="function.js"></script>
</head>   -->
<div ng-controller="bot">

    <div class="wrapperBot" ng-show="showBot">
        <div class="title"><?php echo $_SESSION["user_country_name"]."情報官" ?></div>
        <div class="formBot">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>指揮官，您好！</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data" id="input-bot">
                <input id="dataBot" type="text" placeholder="請輸入您的說話" required>
                <button id="send-btn">寄出</button>
            </div>
        </div>
    </div>

    <div class="chat_icon">
        <i class="fa fa-comments" aria-hidden="true" ng-click="showBotFunction()"></i>
    </div>
<div>
    
    
