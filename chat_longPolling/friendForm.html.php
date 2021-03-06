<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 7/6/14
 * Time: 6:44 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="cssreset.css" media="screen">
    <style type="text/css">
        @font-face {
            font-family: 'misoregular';
            src: url('fonts/miso-webfont.eot');
            src: url('fonts/miso-webfont.eot?#iefix') format('embedded-opentype'), url('fonts/miso-webfont.woff') format('woff'), url('fonts/miso-webfont.ttf') format('truetype'), url('fonts/miso-webfont.svg#misoregular') format('svg');
            font-weight: normal;
            font-style: normal;

        }

        html {
            height: 100%;
        }

        body {
            font-family: sans-serif;
            font-size: 14px;
            height: 100%;
            background-image: url("images/backPattern1.png");
            font-family: misoregular;
        }

        #container {
            width: 350px;
            margin: 0 auto;
            height: 100%;
            width: 640px;
            background-image: url("images/backPattern.png");
            border-left: 1px solid #beb3a7;
            border-right: 1px solid #beb3a7;
        }

        h1 {
            font-size: 32px;
            text-align: center;
            padding-top: 50px;
        }

        table {
            margin: 0 auto;
            font-size: 20px;
        }

        table tr.top {
            border: 0;
            visibility: hidden;
        }

        table tr {
            height: 24px;
            border-bottom: 1px solid #cbc9c3;
        }

        table td {
            padding: 6px;
        }

        table tr.name {
            width: 150px;
        }

        table th.name {
            width: 150px;
        }

        table td.status {
            width: 80px;
        }

        table input[type='submit'] {
            border: 0;
            background-color: #59cbc7;
            height: 22px;
            width: 46px;
            box-sizing: border-box;
            margin: 0;
            border-bottom: 1px solid #48b3af;
            border-top: 1px solid #59cbc7;
            font-size: 16px;
            color: #6bfbf8;
            font-family: misoregular;
        }

        input#friendname {
            box-shadow: none;
            height: 26px;
            margin: 0 auto;
            z-index: 11;
            border: 1px solid #91aaa9;
            box-sizing: border-box;
            font-size: 14px;
            padding: 7px;
            color: #5f5f5f;
            font-family: misoregular;
            font-size: 18px;
            padding: 1px;
            margin: 0;
        }

        input#searchfriend {
            border: 0;
            background-color: #59cbc7;
            height: 26px;
            width: 56px;
            box-sizing: border-box;
            margin: 0;
            border-bottom: 1px solid #48b3af;
            border-top: 1px solid #59cbc7;
            font-size: 16px;
            color: #6bfbf8;
            font-family: misoregular;
            margin: 0;
        }

        label#entername {
            display: none;
        }

        form#findfriend {
            width: 217px;
            margin: 0 auto;
        }

        table#searchedfriends tr#top {
            visibility: hidden;
            border: 0;
        }

        table#searchedfriends input[type='submit'] {
            width: 80px;
        }

        div#navbar {
            height: 30px;
            background-color: #363636;
        }

        div#navbar form {
            float: right;

        }

        div#navbar input[type='submit'] {
            border: none;
            background-color: #692328;
            color: #ffd3cd;
            height: 30px;
            width: 90px;
            font-family: misoregular;
            font-size: 18px;
        }

        div#navbar input[type='submit']:hover {
            background-color: #8e2f36;
        }

        div#navbar p {
            color: white;
            height: 30px;
            font-size: 22px;
            padding: 4px;
            float: left;
            text-transform: capitalize;
        }

        div#navbar span.uname {
            font-weight: bold;
        }

        p.noresult {
            text-align: center;
            font-size: 18px;
            margin: 20px;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="navbar">
        <p>Hi <span class="uname"> <?php htmlout($_SESSION['username']); ?></span>&nbsp;&excl;</p>
        <?php include 'logout.inc.html.php'; ?>
    </div>


    <?php if ((isset($chatFriends1) and !empty($chatFriends1)) or (isset($chatFriends2) and !empty($chatFriends2))): ?>
        <h1>Your Friends</h1>
        <table>
            <tr class="top">
                <th class="name">Name</th>
                <th>status</th>
                <th>click to chat</th>
            </tr>
            <?php if (isset($chatFriends1) and !empty($chatFriends1)): ?>
                <?php foreach ($chatFriends1 as $friend): ?>
                    <tr>
                        <td class="name"><?php htmlout($friend['first_name']); ?></td>
                        <td class="status">
                            <?php if ($friend['online'] == 1): ?>
                                online
                            <?php else: ?>
                                offline
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if ($friend['online'] == 1): ?>
                                <form action="" method="post">
                                    <input type="hidden" name="chatFriend" value="<?php htmlout($friend['id']) ?>">
                                    <input type="submit" value="Chat">
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($chatFriends2) and !empty($chatFriends2)): ?>
                <?php foreach ($chatFriends2 as $friend): ?>
                    <tr>
                        <td><?php htmlout($friend['first_name']); ?></td>
                        <td>
                            <?php if ($friend['online'] == 1): ?>
                                online
                            <?php else: ?>
                                offline
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if ($friend['online'] == 1): ?>
                                <form action="" method="post">
                                    <input type="hidden" name="chatFriend" value="<?php htmlout($friend['id']) ?>">
                                    <input type="submit" value="Chat">
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    <?php else: ?>
        <p>No Friends :(</p>
    <?php endif; ?>

    <!--show friend requests -->
    <?php if (isset($friendRequests) and !empty($friendRequests)): ?>
        <h1>Your Friend Requests</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($friendRequests as $friendRequest): ?>
                <tr>
                    <td><?php htmlout($friendRequest['first_name']); ?></td>
                    <td>
                        <form action="" method="post">
                            <div>
                                <input type="hidden" name="approveRequest">
                                <input type="hidden" name="requestorid"
                                       value="<?php htmlout($friendRequest['userid']) ?>">

                                <input type="submit" name="action" value="Approve">
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <h1>Find new friends</h1>

    <form id="findfriend" action="" method="post">
        <label id="entername">Enter a name</label><input type="text" id="friendname" name="friendname"></input>
        <input type="submit" id="searchfriend" name="searchFriend" value="Search">
    </form>
    <?php if (isset($searchedUsers) and !empty($searchedUsers)): ?>
        <table id="searchedfriends">
            <tr id="top">
                <th>Name</th>
                <th>Add as Friend</th>
            </tr>
            <?php foreach ($searchedUsers as $searchedUser): ?>
                <tr>
                    <td><?php htmlout($searchedUser['first_name']) ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="requesteeid" value="<?php htmlout($searchedUser['id']); ?>">
                            <input type="submit" name="friendRequest" value="Send Request">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($searchedUsers) and empty($searchedUsers)): ?>
        <p class="noresult">Sorry, no matching results :(</p>
    <?php endif; ?>
</div>
</body>
</html>