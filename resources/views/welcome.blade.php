<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
        <style>
            @font-face {
                font-family: ubuntumono;
                src: url(font/UbuntuMono-R.ttf);
            }

            html, body {
                height: 100%;
            }

            body {
                font-family: ubuntumono; 
                color: white;
                background-color: black;
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
            }

            .container {
                display: table-cell;
            }

            .row {
                padding-left: 3px;
                padding-bottom: 3px;
            }

            input[type="text"], input[type="text"]:focus {
                outline: none;
                background-color: black;
                color: black;
                font-family: inherit;
                font-size: inherit;
                border: 0;
            }

            .noselect {
                -webkit-touch-callout: none; /* iOS Safari */
                -webkit-user-select: none;   /* Chrome/Safari/Opera */
                -khtml-user-select: none;    /* Konqueror */
                -moz-user-select: none;      /* Firefox */
                -ms-user-select: none;       /* IE/Edge */
                user-select: none; 
            }
            ::selection { 
               background: transparent; 
            }
            .blink {
              -webkit-animation: blink 1s step-end infinite;
              -moz-animation: blink 1s step-end infinite;
              -o-animation: blink 1s step-end infinite;
              animation: blink 1s step-end infinite;
            }

            @-webkit-keyframes blink {
              67% { opacity: 0 }
            }

            @-moz-keyframes blink {
              67% { opacity: 0 }
            }

            @-o-keyframes blink {
              67% { opacity: 0 }
            }

            @keyframes blink {
              67% { opacity: 0 }
            }
            .break-word {
              word-wrap: break-word;
            }
        </style>
    </head>
    <body onload="document.getElementById('command').focus()" >
        <div class="container" ng-app>
            <div id="content">
                <div class="row">
                    login as: Warit
                </div>  
                <div class="row">
                    Warit@Profile's password: 
                </div>
                <div class="row">
                    Type 'help' for more information.
                </div>
            </div>
            <div class="row">
                [Warit@Profile ~]$ <span ng-bind="sname" class="break-word" id="commandtext"></span><span class="blink">_</span>
            </div>
            <input class="noselect" type="text" ng-model="sname" id="command" onblur="this.focus()" 
                unselectable="on" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" 
                maxlength="70" onkeypress="sendCommand(event)"/>
        </div>
        <script type="text/javascript">

            $('#command').css("cursor","default");

            function send(command){
                $.ajax({
                    url: "sendCommand",
                    type: "GET",
                    timeout: 3000,
                    data: {
                        "text": command,
                    },
                    dataType: "text",
                    success: function (data,status) {
                        insertLine(data);
                    },
                    error: function (response) {
                        insertLine("Connection Timeout. Command is " + command + ".");
                    }            
                })
            };

            function sendCommand(e) {
                if (e.keyCode == 13) {
                    var text = '[Warit@Profile ~]$ ';
                    text += $('#commandtext').html();
                    insertLine(text);
                    send($('#command').val());
                    $('#commandtext').html("");
                    $('#command').val("");
                }else{
                    return e;
                }
            }

            function insertLine(text){
                var value = "<div class='row'>" + text + "</div>"
                $('#content').html($('#content').html() + value);
            }
        </script>
    </body>
</html>
