<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth hover:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @routes
    @vite(['admin/admin.js', "admin/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-vazirmatn antialiased">
    @inertia
</body>

</html>
