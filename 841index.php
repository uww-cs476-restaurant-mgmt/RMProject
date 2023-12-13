<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Index</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #FFA500; /* Orange background color */
            padding: 15px;
            text-align: center;
        }

        .navbar button {
            background-color: #FFD700; /* Gold button color */
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        main {
            text-align: center;
            margin: 20px;
        }

        main img {
            max-width: 100%;
            height: auto;
        }
    </style>
    
</head>
<body>

    <div class="navbar">
        <button onclick="navigateTo('starters.php')">Starters</button>
        <button onclick="navigateTo('salad.php')">Salads</button>
        <button onclick="navigateTo('entrees.php')">Entrees</button>
        <button onclick="navigateTo('wraps.php')">Wraps</button>
        <button onclick="navigateTo('sandwich.php')">Sandwiches</button>
        <button onclick="navigateTo('basket.php')">Baskets</button>
		<button onclick="navigateTo('myOrder.php')">My Order</button>
    </div>

    <h1>Welcome to the 841 Brewhouse Online Menu</h1>

    <main>
        <img src="https://popmenucloud.com/cdn-cgi/image/width=300,height=300,format=auto,fit=scale-down/mdovaexr/341f50f7-25e2-43f2-bb0c-46584ee40d3b.png" alt="Menu Image">
    </main>

    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>

</body>
</html>
