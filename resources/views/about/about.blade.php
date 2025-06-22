@extends('layouts.app')
@section('title', '運営者紹介 | クルマの名医ナビ')
@section('meta_description', 'クルマの名医ナビの運営者についてご紹介します。サイトの目的や運営ポリシーなどをご覧いただけます。')
@section('content')
    <div class="about-header">
        <h1><i class="fas fa-user-circle"></i>運営者紹介</h1>
        <p class="mt-3">クルマ修理をもっと安心に。<br>このサイトを運営するメンバーをご紹介します。</p>
    </div>
    <div class="text-center mb-4">
        <img src="{{ asset('images/about/team.png') }}" alt="運営チーム集合イラスト" class="img-fluid rounded shadow w-100" style="max-width: 600px; height: auto;">
    </div>
    <div class="about-content mb-5">
        <h2>開発の想い</h2>
        <p>
            私はクルマが好きで、これまでの転勤生活の中で、何度も新しい整備工場を探してきました。<br>
            その中で感じたのは、「信頼できる整備工場を見つけるのは意外と難しい」ということです。
        </p>
        <p>
            過去には、ディーラーに整備をお願いした際、丁寧ではあるものの、相談なく必要以上の整備をされ、結果的に高額な費用がかかった経験もありました。<br>
            一方で、個人経営の工場の中には技術力が高くて親身に対応してくれる整備士の方が多く、しかも費用も良心的なところがあります。
        </p>
        <p>
            ただ、そういった“隠れた名店”のような整備工場は、ネット検索だけではなかなか見つかりません。<br>
            また、「どんな人が、どんな理由で良いと感じたのか」がわからないと、口コミだけでは判断が難しいのが現状です。
        </p>
        <p>
            さらに、クルマに詳しくない方ほど、不要な整備を提案されたり、納得できないまま支払いをしてしまうという話も耳にしました。
        </p>
        <p>
            ――車に詳しい人も、そうでない人も、安心して整備を任せられる場所を見つけ、充実したカーライフを送れるように――<br>
            そんな想いから、このアプリを開発しました。
        </p>
        <p class="text-right mt-4 font-italic">
            ― たつのり（クルマの名医ナビ 代表）
        </p>
        <h2 class="mt-5">設立</h2>
        <p><i class="fas fa-calendar-alt"></i> 2025年5月</p>
    </div>
    <h2 class="mt-5 mb-3 text-center">
        <i class="fas fa-user-friends mr-2"></i>メンバー紹介
    </h2>
    <div class="container" style="max-width: 720px;">
        <div class="member-list">
            <div class="card mb-4 flex-md-row shadow-sm border-dark">
                <img src="{{ asset('images/about/tatsunori.png') }}" class="member-img" alt="たつのり">
                <div class="card-body">
                    <h5 class="card-title">たつのり（千葉在住／代表・発案者）</h5>
                    <p class="card-text">
                        このサービス「クルマの名医ナビ」の発案者であり、代表エンジニア。<br>
                        「誰でも安心して整備工場を見つけられるようにしたい」という想いから企画を立ち上げ、構想から設計・実装・検証まで、すべての工程において丁寧かつ誠実に向き合いました。<br>
                        基本に忠実でありながらも、着実に成果を積み重ねていく開発スタイルは、チーム全体の信頼を集めました。<br>
                        また、開発中はメンバーの力を自然と引き出し、チームの雰囲気をやさしく整える存在としても活躍。<br>
                        天然な一面や、さりげない褒め言葉で場を和ませつつも、鋭い観察眼と着実な判断力で、技術的にも人間的にも頼れる存在でした。<br>
                        車好きで、愛車は白のポルシェ。<br>
                        愛されキャラの中に、芯のある実力と誠実さが光る、まさにチームの軸となるエンジニアです。
                    </p>
                </div>
            </div>
            <div class="card mb-4 flex-md-row shadow-sm border-dark">
                <img src="{{ asset('images/about/chaco.png') }}" class="member-img" alt="ちゃこ">
                <div class="card-body">
                    <h5 class="card-title">ちゃこ（新潟在住／チームの司令塔）</h5>
                    <p class="card-text">
                        チームをやさしくまとめ、みんなを引っ張る存在。<br>
                        明るい笑顔と丁寧な言葉遣いが印象的なちゃこさん。<br>
                        複数のアプリを完成させてきた実力者で、理解力・開発スピードともに抜群。今回の開発でも、自分のタスクに加え、チーム全体の進行にも目を配る頼れる存在でした。<br>
                        頭の回転が速く、学んだことをすぐに言葉にして共有してくれる姿勢は、まさにリーダータイプ。優しさと芯の強さをあわせ持ち、まわりからも自然と信頼が集まります。<br>
                        健康志向でお酒は弱い。けれど、開発への没頭力と向上心は人一倍。チームに安心感を与えてくれる“開発のお母さん”的存在です。
                    </p>
                </div>
            </div>
            <div class="card mb-4 flex-md-row shadow-sm border-dark">
                <img src="{{ asset('images/about/nari.png') }}" class="member-img" alt="なり">
                <div class="card-body">
                    <h5 class="card-title">なり（兵庫在住／クリエイティブ光る軍師）</h5>
                    <p class="card-text">
                        一見クールでミステリアスな雰囲気をまといながら、会話では鋭いワードセンスと関西人らしいユーモアで場を盛り上げる、チームの“軍師”的存在。<br>
                        観察力に優れ、人の本質を見抜く力を持ちながらも、その分析力は「いじり」や笑いに変換され、周囲を和ませる純粋な愛のパワーを発揮。<br>
                        UIの細部にまでこだわったアイデアや、動画制作などのクリエイティブ業務ではそのセンスが光り、アプリに個性と魅力をプラスしてくれました。<br>
                        本気か冗談かわからないけど、気づけば頼ってしまう、そんな不思議な魅力を持つメンバーです。
                    </p>
                </div>
            </div>
            <div class="card mb-4 flex-md-row shadow-sm border-dark">
                <img src="{{ asset('images/about/shimizu.png') }}" class="member-img" alt="清水">
                <div class="card-body">
                    <h5 class="card-title">清水（福井在住／探究心あふれる知恵袋）</h5>
                    <p class="card-text">
                        脳科学やAI、統計学、Pythonなど多岐にわたる分野を学び続ける探究心の持ち主。<br>
                        これまでの人生で培ってきた豊富な経験と人脈を活かし、チームに広い視野をもたらしてくれました。<br>
                        誰とでもすぐに打ち解けられ、会話の中に時折見せる天然な返しもみんなの癒し。<br>
                        タスクに何度も向き合い、丁寧にやり直す姿勢からは、真摯さと成長意欲が伝わってきました。<br>
                        知識の吸収に貪欲で、なんでも楽しむポジティブな姿勢、そして大きな器で周囲を包み込む、まさにチームの“知恵袋”的存在でした。<br>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection