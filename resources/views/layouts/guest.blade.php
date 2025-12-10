<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Connexion – Mini Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['system-ui', 'sans-serif'],
                    },
                    colors: {
                        page: '#f5f3f0',
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-page text-slate-900 min-h-screen flex items-center justify-center antialiased">
    <div class="w-full max-w-md px-6 py-8 bg-white rounded-2xl shadow-md border border-slate-200">

        {{ $slot }}
        
    </div>

</body>
</html>