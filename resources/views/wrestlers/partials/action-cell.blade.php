<x-actions-dropdown>
    @can('view', $wrestler)
        <x-buttons.view :route="route('wrestlers.show', $wrestler)" />
    @endcan

    @can('update', $wrestler)
        <x-buttons.edit :route="route('wrestlers.edit', $wrestler)" />
    @endcan

    @can('delete', $wrestler)
        <x-buttons.delete :route="route('wrestlers.destroy', $wrestler)" />
    @endcan

    @if ($actions->contains('retire'))
        @if ($wrestler->canBeRetired())
            @can('retire', $wrestler)
                <x-buttons.retire :route="route('wrestlers.retire', $wrestler)" />
            @endcan
        @endif
    @endif

    @if ($actions->contains('unretire'))
        @if ($wrestler->canBeUnretired())
            @can('unretire', $wrestler)
                <x-buttons.unretire :route="route('wrestlers.unretire', $wrestler)" />
            @endcan
        @endif
    @endif

    @if ($actions->contains('employ'))
        @if ($wrestler->canBeEmployed())
            @can('employ', $wrestler)
                <x-buttons.employ :route="route('wrestlers.employ', $wrestler)" />
            @endcan
        @endif
    @endif

    @if ($actions->contains('release'))
        @if ($wrestler->canBeReleased())
            @can('release', $wrestler)
                <x-buttons.release :route="route('wrestlers.release', $wrestler)" />
            @endcan
        @endif
    @endif

    @if ($actions->contains('suspend'))
        @if ($wrestler->canBeSuspended())
            @can('suspend', $wrestler)
                <x-buttons.suspend :route="route('wrestlers.suspend', $wrestler)" />
            @endcan
        @endif
    @endif

    @if ($actions->contains('reinstate'))
        @if ($wrestler->canBeReinstated())
            @can('reinstate', $wrestler)
                <x-buttons.reinstate :route="route('wrestlers.reinstate', $wrestler)" />
            @endcan
        @endif
    @endif

    @if ($actions->contains('injure'))
        @if ($wrestler->canBeInjured())
            @can('injure', $wrestler)
                <x-buttons.injure :route="route('wrestlers.injure', $wrestler)" />
            @endcan
        @endif
    @endif

    @if ($actions->contains('clearInjury'))
        @if ($wrestler->canBeClearedFromInjury())
            @can('clearFromInjury', $wrestler)
                <x-buttons.recover :route="route('wrestlers.clear-from-injury', $wrestler)" />
            @endcan
        @endif
    @endif
</x-actions-dropdown>
