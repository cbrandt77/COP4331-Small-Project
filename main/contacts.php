<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Contact Manager</title>
        <link href='css/index.css' rel='stylesheet'>
        <script src="ts/main.js"></script>
    </head>
    <body>
        <h1>
		    <a href="index.html">Home</a> &ensp;
		    <a href="signup.html">Sign Up</a> &ensp;
		    <span class = "active">
		        <a href="contacts.php">Contacts</a>
		    </span>
		    <br/>
        </h1>

        <?php if (isset($_COOKIE['user_id'])) { ?> <!-- see /ts/login.ts -->
	        <p class="scripttest">Give us your information, we love you so much.</p>
	        <form class="loginform" id="loginform" name="loginform">
	            <label for="username">Username:</label>
	            <input type="text" name="username" id="username"/>
	            <br/>

	            <label for="password">Password:</label>
	            <input type="password" name="password" id="password"/>
	            <br/>

	            <button type="submit">Submit</button>
	        </form>

	        <textarea id="responsearea"></textarea>
		<?php } else { ?>
            <h1>You do not have access to this page. Please log in!</h1>
		<?php } ?>
    </body>
</html>
<!--Cop-->

<!--Test for Justin and Gavin (Part 2)-->

<!--Test for Manas part 2-->