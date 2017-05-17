@include('broadcast.default.business-ads-master')

<div class="numbers-area {{ $num_class }} abs">
    <div class="boxed business-spec" id="broadcast-spec">
        <div class="title">
            <h3><span id="callednums-title">{{ $business_name }}</span></h3>
        </div>
        <div class="parent-num" id="parent-num-spec">
            <div class="numbers t@{{ rank1 }} @{{ color1 }} ">
                <div class="wrap-nums">
                    <p class="callnum ">@{{ box1 }}</p>
                    <p class="service " id="blinking-service">@{{ service1 }}</p>
                    <p class="terminal ">@{{ name1 }}</p>
                    <p class="terminal ">@{{ user1 }}</p>
                    <!-- below is the same color as parent div -->
                    <div class="dark-orange blink-num"></div>
                </div>
            </div>
        </div>
        <div class="child-nums ten-nums">
            <div class="wrap-nums">
                <div class="number @{{ color2 }}">
                    <p>@{{ box2 }}</p>
                    <p class="service ">@{{ service2 }}</p>
                    <p class="terminal ">@{{ name2 }}</p>
                    <p class="terminal ">@{{ user2 }}</p>
                </div>
                <div class="number @{{ color3 }}">
                    <p>@{{ box3 }}</p>
                    <p class="service ">@{{ service3 }}</p>
                    <p class="terminal ">@{{ name3 }}</p>
                    <p class="terminal ">@{{ user3 }}</p>
                </div>
                <div class="number @{{ color4 }}">
                    <p>@{{ box4 }}</p>
                    <p class="service ">@{{ service4 }}</p>
                    <p class="terminal ">@{{ name4 }}</p>
                    <p class="terminal ">@{{ user4 }}</p>
                </div>
                <div class="number @{{ color5 }}">
                    <p>@{{ box5 }}</p>
                    <p class="service ">@{{ service5 }}</p>
                    <p class="terminal ">@{{ name5 }}</p>
                    <p class="terminal ">@{{ user5 }}</p>
                </div>
                <div class="number @{{ color6 }}">
                    <p>@{{ box6 }}</p>
                    <p class="service ">@{{ service6 }}</p>
                    <p class="terminal ">@{{ name6 }}</p>
                    <p class="terminal ">@{{ user6 }}</p>
                </div>
                <div class="number @{{ color7 }}">
                    <p>@{{ box7 }}</p>
                    <p class="service ">@{{ service7 }}</p>
                    <p class="terminal ">@{{ name7 }}</p>
                    <p class="terminal ">@{{ user7 }}</p>
                </div>
                <div class="number @{{ color8 }}">
                    <p>@{{ box8 }}</p>
                    <p class="service ">@{{ service8 }}</p>
                    <p class="terminal ">@{{ name8 }}</p>
                    <p class="terminal ">@{{ user8 }}</p>
                </div>
                <div class="number @{{ color9 }}">
                    <p>@{{ box9 }}</p>
                    <p class="service ">@{{ service9 }}</p>
                    <p class="terminal ">@{{ name9 }}</p>
                    <p class="terminal ">@{{ user9 }}</p>
                </div>
                <div class="number @{{ color10 }}">
                    <p>@{{ box10 }}</p>
                    <p class="service ">@{{ service10 }}</p>
                    <p class="terminal ">@{{ name10 }}</p>
                    <p class="terminal ">@{{ user10 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>