<?php

//Setting created_at to Now
>>> $user = App\User::find(1); // Find the user
>>> $user->created_at = now(); // Set created_at to the current time
>>> $user->save(); // Save the changes

//Setting created_at to a Specific Time
    //Using a Carbon Instance
>>> $user->created_at = \Carbon\Carbon::create(2022, 1, 1, 12, 0, 0); // Set created_at to January 1, 2022, 12:00:00
>>> $user->save();
    //Using a Date String
>>> $user->created_at = '2023-12-30 15:00:00'; // Set created_at to a specific date and time
>>> $user->save();


//アップデート時データーベースの中に'profile_picture'あるかどうかの話
if ($request->hasFile('profile_picture')) {
    $path = $request->file('profile_picture')->store('profile_pictures', 'public');
    $user->profile_picture = $path;
}

//userのnickname
<h1>{{ $user->nickname ?? '' }}</h1>
<p>性別: {{ $user->gender == 'male' ? '男性' : ($user->gender == 'female' ? '女性' : '特殊') }}</p>
<p>
    プロファイル写真: 
    @if ($user->profile_picture)
    //写真あればそれ使う    
    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="プロフィール写真">
    @else
    //  無ければ性別ごとに指摘されたファイル（名）、を使う  
    <img src="{{ asset('images/default_' . $user->gender . '.png') }}" alt="デフォルト写真">
    @endif
</p>