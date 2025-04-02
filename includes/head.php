<!DOCTYPE html> 
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            Portfolio Website
        </title>

        <!-- css stuff -->
        <link href="./assets/css/reset.css" rel="stylesheet">
        <link href="./assets/css/mobile.css" media="screen and (max-width:500px)" rel="stylesheet">
        <link href="./assets/css/tablet.css" media="screen and (min-width:501px) and (max-width:975px)" rel="stylesheet">
        <link href="./assets/css/normal.css" media="screen and (min-width: 976px) and (max-width:1200px)" rel="stylesheet">
        <link href="./assets/css/widescreen.css" media="screen and (min-width:1201px)" rel="stylesheet">

        <!-- for the hamburger icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <!-- CDN setup for highlight.js module for code syntax highlighting -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/java.min.js"></script>

        
        
    </head>
    <body>
        <?php
            session_start();
            include 'navbar.php';
        ?>
        <main>
