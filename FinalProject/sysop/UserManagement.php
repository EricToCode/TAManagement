    <!-- User Management -->
    <h2>Add a User</h2>
    <form method="post">
    <label for="fname">First Name</label></br>
                <input type="text" id="fname" name="fname"></br>
                </br>
                <label for="lname">Last Name</label></br>
                <input type="text" id="lname" name="lname"></br>
                </br>
                <label for="email">Email</label></br>
                <input type="text" id="email" name="email"></br>
                </br>
                <label for="uname">Username</label></br>
                <input type="text" id="uname" name="uname"></br>
                </br>
                <button class="importBtn" type="submit" name="addUser">Submit</button>

    </form>

    <?php
    if (isset($_POST["addUser"])) {
        $conn = new PDO('sqlite:../307.db');

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $uname = $_POST["uname"];

        // add the assignment records to database
        $stmt = "INSERT INTO users
        (firstname, lastname, email, username)
            VALUES ('$fname', '$lname', '$email', '$uname');";
        $query = $conn->prepare($stmt);
        // echo $stmt, "<br>";
        $query->execute();
        echo "<span style='color: #66AC50;'>ADDED</span>";

        $conn->connection = null;
    }
    ?>

    <h2>Select a user to edit or delete</h2>

    <?php

    $conn = new PDO('sqlite:../307.db');

    $results = $conn->query("SELECT username FROM users;");
    displayUsers($results);


    function displayUsers($results)
    {
        echo "<form method='post'>
            <label for='user'>Select the User you'd like to edit or delete</label></br>";
        echo "<select name='user' id='user' required>";
        echo "<option value=''>-- Select a User --</option>";

        foreach($results as $user){
            $curUser = $user['username'];
            echo "<option value='$curUser'>$curUser</option>";
        }
        echo "</select></br></br>
            <button class='importBtn' type='submit' name='edit'>Edit</button>
            <button class='importBtn' type='submit' name='delete'>Delete</button>  </br>
            </form>";

    }
    $conn->connection = null;
    ?>

    
    


    <?php
    if (isset($_POST["edit"])) {
        
        echo "<form method='post'>
        <label for='fname'>First Name</label></br>
                    <input type='text' id='fname' name='fname'></br>
                    </br>
                    <label for='lname'>Last Name</label></br>
                    <input type='text' id='lname' name='lname'></br>
                    </br>
                    <label for='email'>Email</label></br>
                    <input type='text' id='email' name='email'></br>
                    </br>
                    <label for='uname'>Username</label></br>
                    <input type='text' id='uname' name='uname'></br>
                    </br>
                    <label for='pword'>PassWord</label></br>
                    <input type='text' id='pword' name='pword'></br>
                    </br>
                    <button class='importBtn' type='submit' name='update'>Update!</button>
    
        </form>";
    }
    else if(isset($_POST["delete"])){

        $name = $_POST["user"];

        $conn = new PDO('sqlite:../307.db');

        $stmt = "DELETE FROM users
        WHERE username='$name';";
        $query = $conn->prepare($stmt);
        // echo $stmt, "<br>";
        $query->execute();
        echo "<span style='color: #66AC50;'>DELETED</span>";

        $conn->connection = null;
    }
    ?>

    <?php
    if (isset($_POST["update"])) {
        echo "<span style='color: #66AC50;'>Updated!</span>";
    }
    ?>