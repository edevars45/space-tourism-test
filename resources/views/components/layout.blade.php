 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>{{ $title ?? 'Space Tourism' }}</title>
     <!-- Polices -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bellefair&family=DynaPuff:wght@400..700&family=Rouge+Script&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
</head>

<body style="background-image: url('{{ $bgImage }}')" class="min-h-screen  bg-cover bg-center ">

 
        {{ $slot }}
 
    
</body>
</html>
 
 