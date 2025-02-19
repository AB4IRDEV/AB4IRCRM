
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar flex">
      <i class="bx bx-menu" id="sidebar-open"></i>
      <input type="text" placeholder="Search..." class="search_box" />
      <span class="nav_image">
        <img src="{{ 'storage/'  . $user->file}}" alt="logo_img" />
      </span>
</nav>

