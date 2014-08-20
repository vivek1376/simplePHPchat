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
</head>
<body>

<?php if ((isset($chatFriends1) and !empty($chatFriends1)) or (isset($chatFriends2) and !empty($chatFriends2))): ?>
    <h1>Your Friends</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>status</th>
        </tr>
        <?php if (isset($chatFriends1) and !empty($chatFriends1)): ?>
            <?php foreach ($chatFriends1 as $friend): ?>
                <tr>
                    <td><?php htmlout($friend['name']); ?></td>
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
        <?php if (isset($chatFriends2) and !empty($chatFriends2)): ?>
            <?php foreach ($chatFriends2 as $friend): ?>
                <tr>
                    <td><?php htmlout($friend['name']); ?></td>
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
                <td><?php htmlout($friendRequest['name']); ?></td>
                <td>
                    <form action="" method="post">
                        <div>
                            <input type="hidden" name="approveRequest">
                            <input type="hidden" name="requestorid" value="<?php htmlout($friendRequest['userid']) ?>">

                            <input type="submit" name="action" value="Approve">
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<h1>Add new friends</h1>

<form action="" method="post">
    <label>Enter a name<input type="text" id="friendname" name="friendname"></input></label>
    <input type="submit" name="searchFriend" value="Search">
</form>
<?php if (isset($searchedUsers) and !empty($searchedUsers)): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Add as Friend</th>
        </tr>
        <?php foreach ($searchedUsers as $searchedUser): ?>
            <tr>
                <td><?php htmlout($searchedUser['name']) ?></td>
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
    <p>Sorry, no matching results :(</p>
<?php endif; ?>
</body>
</html>