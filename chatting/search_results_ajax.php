<?php
/**
 * Your function names should match their purpose. user_profile() does not accurately define the operations
 * this function will be performing.
 *
 * @param array $usernameToSearch - The username to compare with the database.
 *
 * @return array - A list of users.
 */
function get_users_by_username($usernameToSearch)
{
    /**
     * The query below will fetch all of your users from the database.
     *
     *      SELECT memberID, username FROM members
     *
     * You can narrow the results by using the WHERE clause with the LIKE operator:
     *
     *      $sql = 'SELECT memberID, username FROM members WHERE username LIKE "%' . $username . '%"'
     *
     * Learn more about the LIKE clause at: http://www.w3schools.com/sql/sql_like.asp
     */
    $sql    = 'SELECT memberID, username FROM members WHERE username LIKE "%' . $usernameToSearch . '%"';
    $result = $conn->query($sql);

    $users = array();
    while($row = $result->fetch_assoc()) {
        /** Renamed from $user to $users to match variable definition. */
        $users[] = $row;
    }

    /** Renamed from $user to $users to match variable definition. */
    return $users;
}


/**
 * Your AJAX request sends a parameter called "searchvalue", which contains the value of the textbox
 * on the search page. You can access that parameter through the PHP global, $_POST.
 *
 * (or $_GET, if the parameter is stored in the url. Such as: www.mywebsite.com?searchvalue=my+search+here)
 *
 * Before you execute get_users_by_username(), you must check if the "searchvalue" parameter exists. This
 * can be done through the empty() function, which essentially checks if the value if $_POST['searchvalue'] is:
 *  - false
 *  - an empty string
 *  - null
 *
 * The NOT operator "!" in front of empty() will flip the value returned by empty(). So if empty() returns true, the
 * NOT operator will flip it to false. This important because we only what the code within the "if" statement to
 * execute if $_POST['searchvalue'] is NOT empty.
 */
if(!empty($_POST['searchvalue'])) {
    /** Store the results of get_users_by_username(), so we can count the number of results without re-running the function. */
    $users = get_users_by_username($_POST['searchvalue']);

    /**
     * Foreach loops with through warnings if user_profile() returns an empty value. Make sure count($users) is > 0
     * before running the loop.
     */
    if(count($users) > 0) {
        foreach($users as $user) {
            print '<p>
                  <a href="#">
                      ' . $user['username'] . '
                  </a>
               </p>';
        }
    } else {
        print "<p>No Results</p>";
    }
}

/**
 * In files with only PHP code, you do not need the closing PHP tag.
 *
 * "?>"
 */