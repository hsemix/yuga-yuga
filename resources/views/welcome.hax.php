<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Yuga</title>

  <link rel="stylesheet" href="{{ assets('assets/css/app.css') }}">
</head>

<body class="min-h-screen bg-slate-950 text-white">
  <main class="min-h-screen flex items-center justify-center px-6">
    <section class="max-w-4xl w-full text-center">

      <h1 class="text-5xl md:text-7xl font-bold tracking-tight">
        Build faster with
        <span class="bg-gradient-to-r from-indigo-400 via-sky-400 to-emerald-400 bg-clip-text text-transparent">
          Yuga
        </span>
      </h1>

      <p class="mt-6 text-lg md:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
        A lightweight PHP framework designed for clean routing, expressive controllers,
        flexible services, and modern runtime support.
      </p>

      <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="https://yuga-framework.gitbook.io"
           target="_blank"
          class="rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-950 shadow-lg hover:bg-slate-200 transition">
          Read Documentation
        </a>

        <a href="https://github.com/hsemix/yuga-framework"
          target="_blank"
          class="rounded-xl border border-white/10 px-6 py-3 text-sm font-semibold text-white hover:bg-white/10 transition">
          View on GitHub
        </a>
      </div>

      <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-4 text-left">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
          <h3 class="font-semibold text-lg">Routing</h3>
          <p class="mt-2 text-sm text-slate-400">
            Clean route definitions with controller support and middleware.
          </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
          <h3 class="font-semibold text-lg">PSR-7 Ready</h3>
          <p class="mt-2 text-sm text-slate-400">
            A modern request and response bridge for future runtime support.
          </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
          <h3 class="font-semibold text-lg">Runtime Friendly</h3>
          <p class="mt-2 text-sm text-slate-400">
            Prepared for FPM, RoadRunner, FrankenPHP, and Swoole.
          </p>
        </div>
      </div>
    </section>
  </main>
  <script src="{{ assets('yuga/js/ys.min.js') }}"></script>
</body>

</html>