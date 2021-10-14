<ul class="list-group">
    <!-- TODO: extract style to class; conver to card? check mobile view -->
    <li class="list-unstyled mb-2"> 
        <a href="{{ route('home') }}" style="font-size: 1.2rem; font-weight: 700; color:black;">
            Home
        </a>
    </li>
    <li class="list-unstyled mb-2">
        <a href="/explore" style="font-size: 1.2rem; font-weight: 700; color:black;">
            Explore
        </a>
    </li>
    <li class="list-unstyled mb-2">
        <a href="#" style="font-size: 1.2rem; font-weight: 700; color:black;">
            Notifications
        </a>
    </li>
    <li class="list-unstyled mb-2">
        <a href="#" style="font-size: 1.2rem; font-weight: 700; color:black;"">
            Messages
        </a>
    </li>
    <li class="list-unstyled mb-2">
        <a href="#" style="font-size: 1.2rem; font-weight: 700; color:black;">
            Bookmarks
        </a>
    </li>
    <li class="list-unstyled mb-2">
        <a href="#" style="font-size: 1.2rem; font-weight: 700; color:black;">
            Lists
        </a>
    </li>
    <li class="list-unstyled mb-2">
        <a href="{{ route('profiles.show', current_user())}}" style="font-size: 1.2rem; font-weight: 700; color:black;">
            Profile
        </a>
    </li>
    <li class="list-unstyled mb-2">
        <a href="#" style="font-size: 1.2rem; font-weight: 700; color:black;">
            More
        </a>
    </li>
</ul>