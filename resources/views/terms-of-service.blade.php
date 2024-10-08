@extends('layouts.app')

@section('title', '利用規約 - Regener8r')
@section('description', 'Regener8rのLuminaMindサービス利用規約です。AIカウンセリングサービスをご利用いただく際の規約について説明しています。')

@section('additional_head')
<style>
    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.5;
        color: #1a202c;
    }
    .terms-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }
    h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
    }
    h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    p, ul {
        margin-bottom: 1rem;
    }
    ul {
        padding-left: 1.5rem;
    }
    updated-date {
        font-style: italic;
        color: #718096;
        margin-top: 2rem;
    }
    
</style>
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <h1 class="mb-4">利用規約</h1>

    <p>この利用規約（以下、「本規約」）は、Regener8r（以下、「当社」）が提供するAIカウンセリングサービス「LuminaMind」（以下、「本サービス」）の利用条件を定めるものです。ユーザーの皆さま（以下、「ユーザー」）には、本規約に従って、本サービスをご利用いただきます。</p>

    <h2>1. 適用</h2>
    <p>本規約は、ユーザーと当社との間の本サービスの利用に関わる一切の関係に適用されるものとします。</p>

    <h2>2. 利用登録</h2>
    <p>登録希望者が当社の定める方法によって利用登録を申請し、当社がこれを承認することによって、利用登録が完了するものとします。</p>

    <h2>3. AIカウンセリングサービスの特性</h2>
    <p>本サービスは、AI技術を用いたカウンセリングサービスです。ユーザーは以下の点を理解し、同意した上で本サービスを利用するものとします：</p>
    <ul>
        <li>本サービスは、専門家による対面カウンセリングの代替となるものではありません。</li>
        <li>緊急時や危機的状況下では、適切な専門家や緊急サービスに相談してください。</li>
        <li>AIの回答は、統計的なデータに基づいて生成されており、個々の状況に完全に適合しない場合があります。</li>
        <li>本サービスの利用結果について、当社は一切の責任を負いません。</li>
    </ul>

    <h2>4. データの取り扱い</h2>
    <p>当社は、本サービスの提供にあたり、以下のようにユーザーデータを取り扱います：</p>
    <ul>
        <li>ユーザーとAIとの対話内容は、サービス改善のために匿名化された形で保存・分析されます。</li>
        <li>個人を特定できる情報は、厳重に管理され、第三者に提供されることはありません。</li>
        <li>ユーザーは、自身のデータの削除を要求する権利を有します。</li>
        <li>当社は、データの安全性を確保するため、適切なセキュリティ対策を講じます。</li>
    </ul>

    <h2>5. 料金および支払い</h2>
    <p>本サービスの利用料金は以下の通りです：</p>
    <ul>
        <li>ベーシックプラン：月額980円（税込）</li>
        <li>スタンダードプラン：月額1,980円（税込）</li>
        <li>プレミアムプラン：月額3,980円（税込）</li>
    </ul>
    <p>支払いは、クレジットカード、銀行振込、またはその他当社が定める方法で行うものとします。料金は前払いとし、利用開始日から1ヶ月ごとに自動更新されます。</p>

    <h2>6. 返金ポリシー</h2>
    <p>原則として、利用開始後のサービス料金の返金は行いません。ただし、当社の責めに帰すべき事由によりサービスが長期間利用できなかった場合など、特段の事情がある場合には、個別に対応いたします。</p>

    <h2>7. 禁止事項</h2>
    <p>ユーザーは、本サービスの利用にあたり、以下の行為をしてはなりません。</p>
    <ul>
        <li>法令または公序良俗に違反する行為</li>
        <li>犯罪行為に関連する行為</li>
        <li>当社、本サービスの他のユーザー、または第三者の知的財産権、肖像権、プライバシー、名誉その他の権利または利益を侵害する行為</li>
        <li>本サービスの運営を妨害するおそれのある行為</li>
        <li>不正アクセスをし、またはこれを試みる行為</li>
        <li>他のユーザーに関する個人情報等を収集または蓄積する行為</li>
        <li>不正な目的を持って本サービスを利用する行為</li>
        <li>本サービスの他のユーザーまたはその他の第三者に不利益、損害、不快感を与える行為</li>
        <li>他のユーザーに成りすます行為</li>
        <li>面識のない異性との出会いを目的とした行為</li>
        <li>反社会的勢力に対して直接または間接に利益を供与する行為</li>
        <li>その他、当社が不適切と判断する行為</li>
    </ul>

    <h2>8. 本サービスの提供の停止等</h2>
    <p>当社は、以下のいずれかの事由があると判断した場合、ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。</p>
    <ul>
        <li>本サービスにかかるコンピュータシステムの保守点検または更新を行う場合</li>
        <li>地震、落雷、火災、停電または天災などの不可抗力により、本サービスの提供が困難となった場合</li>
        <li>コンピュータまたは通信回線等が事故により停止した場合</li>
        <li>その他、当社が本サービスの提供が困難と判断した場合</li>
    </ul>

    <h2>9. サービスの限界と免責事項</h2>
    <p>当社は、本サービスに関して、以下の点について一切の保証を行いません：</p>
    <ul>
        <li>AIによる回答の正確性、適時性、有用性</li>
        <li>ユーザーの特定の目的に適合すること</li>
        <li>ユーザーの期待する効果が得られること</li>
        <li>サービスが中断されないこと、エラーがないこと</li>
    </ul>
    <p>当社は、本サービスの利用により生じた損害について、一切の責任を負いません。ただし、当社の故意または重大な過失による場合はこの限りではありません。</p>

    <h2>10. 規約の変更</h2>
    <p>当社は、必要と判断した場合には、ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお、本規約の変更後、本サービスの利用を開始した場合には、当該ユーザーは変更後の規約に同意したものとみなします。</p>

    <h2>11. 準拠法・裁判管轄</h2>
    <p>本規約の解釈にあたっては、日本法を準拠法とします。本サービスに関して紛争が生じた場合には、当社の本店所在地を管轄する裁判所を専属的合意管轄とします。</p>

    <p class="updated-date">最終更新日：2024年8月22日</p>
</div>
@endsection