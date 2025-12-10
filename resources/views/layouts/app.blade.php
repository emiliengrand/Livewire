<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mini Blog - {{ date('Y') }}</title>
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

    @livewireStyles
</head>
<body class="bg-page text-slate-900 antialiased min-h-screen flex flex-col">

    <header class="border-b border-slate-200 bg-white/70 backdrop-blur">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between text-xs tracking-wide uppercase">
            <div class="font-semibold">Mini Blog</div>
            <nav class="space-x-6">
                <a href="{{ route('home') }}" class="hover:text-slate-500">Accueil</a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-500">Admin</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-slate-500">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-slate-500">Connexion</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-grow w-full">
        <div class="max-w-6xl mx-auto px-6 py-10">
            {{ $slot ?? '' }}
        </div>
    </main>

    <footer class="mt-auto border-t border-slate-200 bg-white/70">
        <div class="max-w-6xl mx-auto px-6 py-6 text-[11px] flex justify-between text-slate-500 uppercase tracking-[0.18em]">
            <span>Mini Blog © {{ date('Y') }}</span>
            <span>Tous droits réservés</span>
        </div>
    </footer>

    @livewireScripts
</body>
</html>