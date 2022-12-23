<?php
    
    session_start();

    if (isset($_POST['colors']) && !empty($_POST['colors'])) {
        if ($_SESSION['colors'] == 0 && $_SESSION['dmode'] == 0) {
            $_SESSION['leftmenu'] = "leftmenuColorsDisabled";
            $_SESSION['rightmenu'] = "rightmenuColorsDisabled";
            $_SESSION['colors'] = 1;
        }
        elseif ($_SESSION['colors'] == 1 && $_SESSION['dmode'] == 0) {
            $_SESSION['leftmenu'] = "leftmenu";
            $_SESSION['rightmenu'] = "rightmenu";
            $_SESSION['colors'] = 0;
        }
        elseif ($_SESSION['colors'] == 0 && $_SESSION['dmode'] == 1) {
            $_SESSION['dmodeToggle'] = "<body id=\"darkmode\">";
            $_SESSION['leftmenu'] = "leftmenuColorsDisabled";
            $_SESSION['rightmenu'] = "rightmenuColorsDisabled";
            $_SESSION['colors'] = 1;
        }
        elseif ($_SESSION['colors'] == 1 && $_SESSION['dmode'] == 1) {
            $_SESSION['dmodeToggle'] = "<body id=\"darkmode\">";
            $_SESSION['leftmenu'] = "leftmenu";
            $_SESSION['rightmenu'] = "rightmenu";
            $_SESSION['colors'] = 0;
        }
    }
    elseif (isset($_POST['dmode']) && !empty($_POST['dmode'])) {
        if ($_SESSION['dmode'] == 0 && $_SESSION['colors'] == 0) {
            $_SESSION['dmodeToggle'] = "<body id=\"darkmode\">";
            $_SESSION['dmode'] = 1;
        }
        elseif ($_SESSION['dmode'] == 1 && $_SESSION['colors'] == 0) {
            $_SESSION['dmodeToggle'] = "<body>";
            $_SESSION['dmode'] = 0;
        }
        elseif ($_SESSION['dmode'] == 0 && $_SESSION['colors'] == 1) {
            $_SESSION['dmodeToggle'] = "<body id=\"darkmode\">";
            $_SESSION['leftmenu'] = "leftmenuColorsDisabled";
            $_SESSION['rightmenu'] = "rightmenuColorsDisabled";
            $_SESSION['dmode'] = 1;
        }
        elseif ($_SESSION['dmode'] == 1 && $_SESSION['colors'] == 1) {
            $_SESSION['dmodeToggle'] = "<body>";
            $_SESSION['leftmenu'] = "leftmenuColorsDisabled";
            $_SESSION['rightmenu'] = "rightmenuColorsDisabled";
            $_SESSION['dmode'] = 0;
        }
    }
    else {
        if ($_SESSION['colors'] == 0) {
            $_SESSION['leftmenu'] = "leftmenu";
            $_SESSION['rightmenu'] = "rightmenu";
        }
        elseif ($_SESSION['colors'] == 1) {
            $_SESSION['leftmenu'] = "leftmenuColorsDisabled";
            $_SESSION['rightmenu'] = "rightmenuColorsDisabled";
        }
    }
?> 




<html lang="en-US">
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>
            Assignment 5 - MySQL
        </title>
    </head>
    <?php echo $_SESSION['dmodeToggle']?>
        <div id="header">
            <div id="duckarea">
                <img id="duck" src="images/Duck1.jpg" alt="Guy Fieri as a Duck" width="150px" height="150px"/>
            </div>
            <h1 id="aleclayton">
                Alec Layton
            </h1>
            <h3 id="profession">
                Software Engineer
            </h3> 
        </div>
        <div>
            <table>
                <tr>
                    <td id=<?php echo $_SESSION['leftmenu'];?>>
                        <p id="menuheader">Menu</p>
                        <ul>
                            <li><a href="https://github.com/aleclay10">GitHub</a></li>
                            <li><a href="courses.php">Courses</a></li>
                            <li><a href="https://www.utsa.edu/">UTSA</a></li>
                        </ul>
                    </td>
                    <td id="aboutme">
                        <h2>About Me</h2>
                        <img id="mansiscoding" src="images/mansIsCoding.webp" alt="MANS IS CODING" width="200px" height="200px"> 
                        <p>
                            I am currently a Senior at UTSA studying Computer Science with Concentrations in Software Engineering and Data Science. At UTSA, I had the opportunity to work on AI projects 
                            with graduate students, develop websites with robust backends, and experiment with Cloud Computing. My last internship I worked as an Enterprise System Development Intern 
                            at Valero Energy Corporation (a Fortune 30 Company). There I developed an SAP GUI application that is still used in production today for their accounts payable team which processes 
                            about 90% of the total U.S. vendor invoices (~ 55 per day). For this, there were some serious data migration considerations. Before, Valero had stored its vendor account information 
                            for invoices in a SQL utilities table (not within SAP).
                            <br>
                            <br>
                            This caused there to be no master data validation and comments were not able to be displayed for the end-user (the Accounts Payable Team). This came with a 
                            challenge, how would I upload the data into SAP efficiently, taking both time and space complexities into account. For this Mass Upload function (as I dubbed it), 
                            I gave the user the ability to go directly into their computer's file system via a button to select a csv file to upload. Once the data was loaded, I dynamically manipulated 
                            the data to fit an SAP Table I had created according to the Functional Specification of the project. Now that the data was within Valeros SAP Database, I was able to provide 
                            the validation of all fields within the table and display crucial information through comments to the Accounts payable team.
                        </p>
                    </td>
                    <td id=<?php echo $_SESSION['rightmenu'];?>>
                        <p id="menuheader">Enrolled Courses</p>
                        <ol>
                            <li>CS4373</li>
                            <li>CS4413</li>
                            <li>CS4743</li>
                        </ol>
                        <p id="menuheader">Theme Toggles</p>
                        <form action="index.php" method="post">
                            <input type="submit" name="colors" value="Colors">
                            <input type="submit" name="dmode" value="Dark Mode">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        <div id="footerbox">
            Copyright 2022 - Alec Layton
        </div>
    </body>
</html>