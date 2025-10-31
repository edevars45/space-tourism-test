{{-- extrait propre pour l’onglet actif --}}
<nav class="border-b border-gray-200">
  <ul class="flex gap-6 px-6">
    <li>
      <a href="{{ route('dashboard') }}"
         class="inline-block py-3 {{ request()->routeIs('dashboard') ? 'border-b-2 border-indigo-600 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
         Dashboard
      </a>
    </li>
    <li>
      <a href="{{ route('admin.planets.index') }}"
         class="inline-block py-3 {{ request()->is('admin/planets*') ? 'border-b-2 border-indigo-600 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
         Gestion des planètes
      </a>
    </li>
    <li>
      <a href="{{ route('admin.crew.index') }}"
         class="inline-block py-3 {{ request()->is('admin/crew*') ? 'border-b-2 border-indigo-600 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
         Gestion de l’équipage
      </a>
    </li>
  </ul>
</nav>
