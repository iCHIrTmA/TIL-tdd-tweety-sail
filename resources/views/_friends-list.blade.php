<h3 class="my-4" style="font-size: 1.2rem; font-weight: 700; color:black;">Friends</h3>
<ul class="list-group">
    @foreach(range(1, 8) as $index)
        <li class="list-unstyled mb-2" style="font-size: 1rem; font-weight: 700;">
            <div>
                <img src="{{ asset('images/default-avatar.jpg') }}" 
                alt=""
                class="rounded-circle mr-2"
                style="max-width: 25%"
                >
                John Doe
            </div>
        </li>
    @endforeach
</ul>