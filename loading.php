<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            height: 95vh;
            width: 95vw;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        main{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        img{
            height: 60px;
            width: 60px;
        }
        p{
            margin: 0.3rem;
        }
    </style>
</head>
<body>
    <main>
        <img src="/project_images/loading.gif" alt="">
        <p>loading please wait....</p>
        <p>Don't reload or redirect to the previous page</p>
    </main>
    <script>
        setTimeout(() => {
            window.location.href='user.php';
        }, 3000);
    </script>
</body>
</html>