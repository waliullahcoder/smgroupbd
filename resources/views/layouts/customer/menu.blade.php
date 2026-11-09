<div class="user-sidebar-area">
    <div class="collapsible-nav-title d-lg-none"> <strong> My Account </strong></div>
    <div class="collapsible-nav-content">
        <ul class="items">
            @if (Route::is('customer.profile'))
                <li class="item current"><span>My Account</span></li>
            @else
                <li class="item"><a href="{{ Route('customer.profile') }}">My Orders</a></li>
            @endif
            @if (Route::is('customer.orders'))
                <li class="item current"><span>My Orders</span></li>
            @else
                <li class="item"><a href="{{ Route('customer.orders') }}">My Orders</a></li>
            @endif
            @if (Route::is('customer.address'))
                <li class="item current"><span>Address Book</span></li>
            @else
                <li class="item"><a href="{{ Route('customer.address') }}">Address Book</a></li>
            @endif
            <li class="item"><a href="#">Account Information</a></li>
            @if (Route::is('customer.wishlist'))
                <li class="item current"><span>Wishlist</span></li>
            @else
                <li class="item"><a href="{{ Route('customer.wishlist') }}">Wishlist</a></li>
            @endif
            <li class="item"><a href="#">My Product Reviews</a></li>
            <li class="item"><a href="#">My Reward Points</a></li>
            <li class="item"><a href="{{ Route('customer.logout') }}">Logout</a></li>
        </ul>
    </div>
</div>
