<x-master>
    <div class="row">
        <div class="col-sm">
            @include('_sidebar-links')
        </div>
        <div class="col-sm-8">
            {{ $slot }}
        </div>
        <div class="col-sm" style="background-color: #a7bbff; border-radius: 1.25rem;">
            @include('_friends-list')
        </div>
    </div>
</x-master>