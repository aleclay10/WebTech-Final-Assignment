<?php
    include_once ".env.php";

    // Connect to DB
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
    if(!$con) {
        exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");
    }
    
    if (isset($_POST) && !empty($_POST)) {
        if (!empty($_POST['delete'])) {
            // Initialize the Prepared Statement
            $stmt = mysqli_stmt_init($con);
            if(!$stmt) {
                exit("<p class='error'>Failed to Initialize Delete Statement</p>");
            }
    
            // Prepare the statement
            $query = "DELETE FROM COURSES_TABLE WHERE course_num = ?";
            if (!mysqli_stmt_prepare($stmt, $query)) {
                exit("<p class='error'>Failed to Prepare Delete Statement</p>");
            }
    
            // Bind Parameters
            $deleteCoureseNum = explode(" ", $_POST['delete']);
            $courseNumString = $deleteCoureseNum[1] . " " . $deleteCoureseNum[2];
            mysqli_stmt_bind_param($stmt, "s", $courseNumString);
    
            // Execute Query
            // TEST THIS!!!
            if (!mysqli_stmt_execute($stmt)) {
                exit("<p class='error'>Failed to Execute Delete Statement</p>");
            }
    
            mysqli_stmt_close($stmt);
            $_POST['delete'] = NULL;
        }
        else {
            // Sanitization
            foreach ($_POST as $key => $value) {
                $_POST[$key] = mysqli_real_escape_string($con, $value);
            }

            // Set $_POST['currently_enrolled'] to "no" if it is not checked (is empty)
            if (empty($_POST['currently_enrolled'])) {
                $_POST['currently_enrolled'] = "no";
            }

            // Initialize the Prepared Statement
            $stmt = mysqli_stmt_init($con);
            if(!$stmt) {
                exit("<p class='error'>Failed to Initialize Insert Statement</p>");
            }

            // Prepare the Statement
            $query = "INSERT INTO COURSES_TABLE (course_name, course_num, description, final_grade, currently_enrolled) VALUES (?, ?, ?, ?, ?)";
            if (!mysqli_stmt_prepare($stmt, $query)) {
                exit("<p class='error'>Failed to Prepare Insert Statement</p>");
            }

            // Bind the Parameters
            mysqli_stmt_bind_param($stmt, "sssss", $_POST['course_name'], $_POST['course_num'], $_POST['description'], $_POST['final_grade'], $_POST['currently_enrolled']);
            
            // Execute Query
            // TEST THIS!!!
            if (!mysqli_stmt_execute($stmt)) {
                exit("<p class='error'>Failed to Execute Insert Statement</p>");
            }
            
            // Close Connection
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($con);
?>

<html lang="en-US">
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>
            Courses
        </title>
    </head>

    <body>
        <div>
            <h1>
                Courses
            </h1>
        </div>
        <div>
            <table>
                <tr>
                    <th>Course Name</th>
                    <th>Course Number</th>
                    <th>Description</th>
                    <th>Final Grade</th>
                    <th>Currently Enrolled</th>
                    <th>Delete Link</th>
                </tr>
                <?php
                    // Connect to DB
                    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
                    if(!$con) {
                        exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");
                    }

                    // Initialize the Prepared Statement
                    $stmt = mysqli_stmt_init($con);
                    if(!$stmt) {
                        exit("<p class='error'>Failed to Prepare Statement</p>");
                    }

                    // Prepare the statement
                    $query = "SELECT course_num, course_name, description, final_grade, currently_enrolled FROM COURSES_TABLE";
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        exit("<p class='error'>Failed to Prepare Statement</p>");
                    }
            
                    // Execute Query
                    if (!mysqli_stmt_execute($stmt))
                        exit("<p class='error'>Failed to execute statement</p>");

                    // Bind the Result Variables
                    mysqli_stmt_bind_result($stmt, $courseNum, $courseName, $description, $finalGrade, $currentlyEnrolled);

                    // Fetch One Result at a Time
                    while (mysqli_stmt_fetch($stmt) != NULL) {
                        if ($currentlyEnrolled == "no") {
                            echo '<tr id="notEnrolled">';
                        }
                        else {
                            echo '<tr id="enrolled">';
                        }
                        echo "<td>$courseName</td>";
                        echo "<td>$courseNum</td>";
                        echo "<td>$description</td>";
                        echo "<td>$finalGrade</td>";
                        echo "<td>$currentlyEnrolled</td>";
                        //echo '<td><a href="courses.php?delete">Delete ' . $courseNum . '</a></td>';
                        echo '<td><form method="post"><input type="submit" name="delete" value="Delete ' . $courseNum . '"></form></td>';
                        echo "</tr>";
                    }

                    //$_GET['delete'] = $courseNum;
 
                    mysqli_stmt_close($stmt);
                    mysqli_close($con);
                ?>
            </table>
        </div>

        <div>
            <h3>
                Courses Form
            </h3>

            <form method="post">
                <label for="course_name">Course Name</label>
                <input type="text" id="course_name" name="course_name">
                <br>
                <br>
                <label for="course_num">Course Number</label>
                <input type="text" id="course_num" name="course_num">
                <br>
                <br>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" cols="40"></textarea>
                <br>
                <br>
                <label for="final_grade">Final Grade</label>
                <input type="text" id="final_grade" name="final_grade">
                <br>
                <br>
                <label for="currently_enrolled">Currently Enrolled</label>
                <input type="checkbox" id="currently_enrolled" name="currently_enrolled" value="yes"/>
                <br>
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>

        <div>
            <a href="index.php">Back To Home</a>
        </div>
    </body>
</html>