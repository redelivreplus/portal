<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Rede Livre')</title>

  {{-- Font Awesome CDN --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  {{-- Vite CSS e JS --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Estilos customizados --}}
  <style>
    body {
      background-color: #fff;
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
      padding: 30px 15px;
    }

    .profile-container {
      background: #f5f7fa;
      max-width: 900px;
      margin: 0 auto;
      border-radius: 12px;
      padding: 30px 40px;
    }

    .profile-photo {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #156DAF;
      background: #ddd;
    }

    .profile-name {
      font-size: 2rem;
      font-weight: 700;
      color: #156DAF;
    }

    .profile-username {
      color: #777;
    }

    .social-icons a {
      text-decoration: none;
      font-size: 0.9rem;
      color: #156DAF;
      border: 1.5px solid #156DAF;
      padding: 6px 8px;
      border-radius: 5px;
      transition: 0.3s ease;
    }

    .social-icons a:hover {
      background-color: #156DAF;
      color: white;
    }

    .btn-follow.active {
      background-color: #0095f6 !important;
      color: white !important;
    }
  </style>
</head>
<body>
  @yield('content')

  @stack('scripts')
</body>
</html>
