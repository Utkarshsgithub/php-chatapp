<?php
if (isset($_POST['submit'])) {
    /* Attempt MySQL server connection. Assuming
you are running MySQL server with default
setting (user 'root' with no password) */
    $link = mysqli_connect(
        "localhost",
        "root",
        "",
        "chat_app"
    );

    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // Escape user inputs for security
    $un = mysqli_real_escape_string(
        $link,
        $_REQUEST['uname']
    );
    $m = mysqli_real_escape_string(
        $link,
        $_REQUEST['msg']
    );
    date_default_timezone_set('Asia/Kolkata');
    $ts = date('y-m-d h:ia');

    // Attempt insert query execution
    $sql = "INSERT INTO chats (uname, msg, dt)
		VALUES ('$un', '$m', '$ts')";
    if (mysqli_query($link, $sql)) {;
    } else {
        echo "ERROR: Message not sent!!!";
    }
    // Close connection
    mysqli_close($link);
}
?>
<html>

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #container {
            width: 500px;
            height: 700px;
            background: #fff;
            font-size: 0;
            border-radius: 3px;
            overflow: hidden;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 50px;
        }

        main {
            width: 500px;
            height: 700px;
            display: inline-block;
            font-size: 15px;
            vertical-align: top;
        }

        main header {
            height: 100px;
            background-color: #414042;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        main header>* {
            display: inline-block;
            vertical-align: top;
        }

        main header div {
            margin-left: 90px;
            margin-right: 90px;
        }

        main header h2 {
            font-size: 25px;
            text-align: center;
            color: #e94e46;
            color: #fff;
        }

        main .inner_div {
            padding-left: 0;
            margin: 0;
            list-style-type: none;
            position: relative;
            overflow: auto;
            height: 500px;
            background: #fff;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            border-top: 2px solid #fff;
            border-bottom: 2px solid #fff;
        }

        main .message {
            padding: 10px;
            color: #fff;
            background-color: #e94e46;
            line-height: 20px;
            max-width: 90%;
            display: inline-block;
            text-align: left;
            border-radius: 5px;
            clear: both;
            border-bottom-left-radius: 0;
            min-width: 100px;
            margin: 25px;
            margin-bottom: 0;
            margin-top: 0;
        }

        main .message1 {
            padding: 10px;
            color: #000;
            margin-right: 15px;
            background-color: #e94e46;
            line-height: 20px;
            max-width: 90%;
            display: inline-block;
            text-align: left;
            border-radius: 5px;
            border-bottom-right-radius: 0;
            float: right;
            clear: both;
            margin: 25px;
            margin-bottom: 0;
            min-width: 100px;
        }

        main footer {
            height: 150px;
            padding: 20px 30px 10px 20px;
            background-color: #414042;
        }

        main footer .input1 {
            resize: none;
            border: 100%;
            display: block;
            width: 120%;
            height: 55px;
            border-radius: 3px;
            padding: 20px;
            font-size: 13px;
            margin-bottom: 13px;
        }

        main footer textarea {
            resize: none;
            border: 100%;
            display: block;
            width: 140%;
            height: 55px;
            border-radius: 3px;
            padding: 20px;
            font-size: 13px;
            margin-bottom: 13px;
            margin-left: 20px;
        }

        main footer .input2 {
            resize: none;
            border: 100%;
            display: block;
            width: 40%;
            height: 55px;
            border-radius: 3px;
            padding: 20px;
            font-size: 13px;
            margin-bottom: 13px;
            margin-left: 100px;
            color: white;
            text-align: center;
            background-color: black;
            border: 2px solid white;
        }

        main footer textarea::placeholder {
            color: #ddd;
        }
    </style>

<body onload="show_func()">
    <div id="container">
        <main>
            <header>
                <div>
                    <h2>ShareYourFeelings</h2>
                </div>
            </header>

            <script>
                function show_func() {

                    var element = document.getElementById("chathist");
                    element.scrollTop = element.scrollHeight;

                }
            </script>

            <form id="myform" action="Group_chat.php" method="POST">
                <div class="inner_div" id="chathist">
                    <?php
                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $db_name = "chat_app";
                    $con = new mysqli($host, $user, $pass, $db_name);

                    $query = "SELECT * FROM chats";
                    $run = $con->query($query);
                    $i = 0;

                    while ($row = $run->fetch_array()) :
                        if ($i == 0) {
                            $i = 5;
                            $first = $row;
                    ?>
                            <div id="message1" class="message1">
                                <span style="color:white;float:right;">
                                    <?php echo $row['msg']; ?></span> <br />
                                <div>
                                    <span style="color:#fff;float:left;clear:both;">
                                        <?php echo $row['uname']; ?>
                                    </span>
                                </div>
                            </div>
                            <br /><br />
                            <?php
                        } else {
                            if ($row['uname'] != $first['uname']) {
                            ?>
                                <div id="message" class="message">
                                    <span style="color:white;float:left;">
                                        <?php echo $row['msg']; ?>
                                    </span> <br />
                                    <div>
                                        <span style="color:#fff;float:left;clear:both;">
                                            <?php echo $row['uname']; ?>
                                        </span>
                                    </div>
                                </div>
                                <br /><br />
                            <?php
                            } else {
                            ?>
                                <div id="message1" class="message1">
                                    <span style="color:white;float:right;">
                                        <?php echo $row['msg']; ?>
                                    </span> <br />
                                    <div>
                                        <span style="color:#fff;float:left;clear:both;">
                                            <?php echo $row['uname']; ?>
                                        </span>
                                    </div>
                                </div>
                                <br /><br />
                    <?php
                            }
                        }
                    endwhile;
                    ?>
                </div>
                <footer>
                    <table>
                        <tr>
                            <th>
                                <input class="input1" type="text" id="uname" name="uname" placeholder="From">
                            </th>
                            <th>
                                <textarea id="msg" name="msg" rows='1' cols='50' placeholder="Share your feelings">
			</textarea>
                            </th>
                            <th>
                                <input class="input2" type="submit" id="submit" name="submit" value="send">
                            </th>
                        </tr>
                    </table>
                </footer>
            </form>
        </main>
    </div>

</body>

</html>