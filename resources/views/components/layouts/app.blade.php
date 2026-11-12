<!DOCTYPE html>
<html lang="en">
<head>
    <x-partials.header />
</head>

<body class="bg-slate-50 overflow-x-hidden">

<div class="flex min-h-screen">
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-[#0f172a] via-[#131a34] to-[#1e1b4b]
           transition-all duration-300 z-40 overflow-hidden">
        <x-partials.sidebar />
    </aside>

    <!-- ================= RIGHT SECTION ================= -->
    <div class="flex flex-col flex-1">
        <!-- ================= NAVBAR ================= -->
        <div id="navbarWrapper"
            class="fixed top-0 left-64 right-0 transition-all duration-300 z-30">
            <x-partials.navbar />
        </div>
        <!-- ================= MAIN CONTENT ================= -->
        <main id="mainContent"
            class="ml-64 mt-10 p-6 transition-all duration-300 min-h-screen bg-slate-50">
            {{ $slot }}
        </main>
    </div>
     <div id="toast-container" class="fixed top-5 right-5 space-y-2 z-50"></div>
</div>

<x-partials.scripts />
</body>
</html>
