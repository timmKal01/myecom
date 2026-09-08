@php
    $roleLabels = [0 => 'Administrator', 1 => 'Vendor', 2 => 'Customer'];
@endphp
<x-dashboard-layout role="admin" active="users" title="Users">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $users->total() }} {{ Str::plural('user', $users->total()) }}</p>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($users->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No users yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Name</th>
                            <th class="px-6 py-3 font-medium">Email</th>
                            <th class="px-6 py-3 font-medium">Role</th>
                            <th class="px-6 py-3 font-medium">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-ink text-white flex items-center justify-center text-xs font-semibold shrink-0">
                                            {{ Str::of($user->name)->explode(' ')->map(fn ($p) => Str::substr($p, 0, 1))->take(2)->join('') }}
                                        </div>
                                        <span class="font-medium">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-ink-muted">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-line/60 text-ink text-xs font-medium px-2.5 py-1">
                                        {{ $roleLabels[$user->role] ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-ink-muted">{{ $user->created_at->format('M j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-line">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>
