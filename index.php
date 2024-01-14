<!DOCTYPE html>
<html lang="en">
    <head>
    <style>
    /* Style for the form */
form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Style for form labels */
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Style for form input fields */
form input[type="text"], form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Style for form submit button */
form input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect for the submit button */
form input[type="submit"]:hover {
    background-color: #2980b9;
}

/* Style for form update button */
form input[type="button"] {
    background-color: #e74c3c;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect for the update button */
form input[type="button"]:hover {
    background-color: #c0392b;
}

/* Style for form cancel button */
form input[type="reset"] {
    background-color: #95a5a6;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect for the cancel button */
form input[type="reset"]:hover {
    background-color: #7f8c8d;
}
        body{
            background-image: url("images/bg2.jpg")
        };
        /* Place the CSS code here */
        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
    background-color: #3498db;
    color: #fff;
    padding: 15px;
    text-align: left;
}

/* Style for table cells */
td {
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #fff; /* Set the background color to white */
}

/* Style for alternate rows */
tr:nth-child(even) {
    background-color: #f2f2f2;
}
        button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* Style for the navigation */
        nav {
    width: 100%;
    margin: 0 auto;
    margin-bottom: 20px;
}

/* Style for the navigation links */
nav a {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    color: #fff;
    background-color: #3498db;
    border: 1px solid #2980b9;
    border-radius: 5px;
    margin-right: 5px;
}

/* Remove underline on hover */
nav a:hover {
    text-decoration: none;
}

/* Style for the navigation table */
nav table {
    width: 70%;
    margin: 0 auto;
}

/* Style for navigation table cells */
nav td {
    padding: 0;
}

/* Style for navigation table links */
nav td a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #fff;
    background-color: #3498db;
    border: 1px solid #2980b9;
    border-radius: 5px;
    margin-right: 5px;
}

/* Remove underline on hover for navigation table links */
nav td a:hover {
    text-decoration: none;
}

/* Style for the motivation div */
#motivation {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
}

/* Style for the div elements inside motivation */
#motivation div {
    text-align: center;
    background-color: #fff; /* Set the background color to white */
    padding: 10px; /* Add some padding for spacing */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Style for the images inside the div elements */
#motivation img {
    width: 200px; /* Set a fixed width */
    height: 200px; /* Set a fixed height */
    border-radius: 10px;
}
    </style>
    <?php include 'PHP_Animashaun/HeadPartHtml.php'?>
    </head>
<body>
    <?php include 'PHP_Animashaun/header.php'?>
    <?php include 'PHP_Animashaun/article.php'?>
    <div id="motivation">
        <div id="div1">
            <img src="images/img1.webp" alt="Angkat Beban">
        </div>
        <div id="div2">
            <img src="images/pek.jpg" alt="Peck Deck">
        </div>
        <div id="div3">
            <img src="images/thread.jpg" alt="">
        </div>
        
    </div>
    <?php include 'PHP_Animashaun/nav.php'?>
    <?php include 'PHP_Animashaun/footer.php'?>
</body>
</html>