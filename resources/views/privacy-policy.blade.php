@extends('layouts.app')

@section('title', 'プライバシーポリシー - Regener8r')
@section('description', 'Regener8rのプライバシーポリシーです。当社のサービス利用における個人情報の取り扱いについて説明しています。')

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
    .updated-date {
        font-style: italic;
        color: #718096;
        margin-top: 2rem;
    }
</style>

@section('content')
<div class="container mt-5 pt-5">
    <h1 class="mb-4">プライバシーポリシー</h1>

    <p>Regener8r（以下、「当社」）は、お客様の個人情報保護の重要性について認識し、個人情報の保護に関する法律（以下、「個人情報保護法」）を遵守すると共に、以下のプライバシーポリシー（以下、「本ポリシー」）に従って、個人情報を取り扱います。</p>

    <h2 class="mt-4 mb-3">1. 収集する個人情報</h2>
    <p>当社は、以下の個人情報を収集することがあります：</p>
    <ul>
        <li>氏名</li>
        <li>メールアドレス</li>
        <li>サービス利用履歴</li>
        <li>デバイス情報</li>
    </ul>

    <h2 class="mt-4 mb-3">2. 個人情報の利用目的</h2>
    <p>当社は、収集した個人情報を以下の目的で利用します：</p>
    <ul>
        <li>サービスの提供・運営</li>
        <li>ユーザーサポート</li>
        <li>サービスの改善・新規サービスの開発</li>
        <li>統計データの作成</li>
        <li>マーケティング</li>
    </ul>

    <h2 class="mt-4 mb-3">3. 個人情報の第三者提供</h2>
    <p>当社は、以下の場合を除き、あらかじめユーザーの同意を得ることなく、第三者に個人情報を提供することはありません。</p>
    <ul>
        <li>法令に基づく場合</li>
        <li>人の生命、身体または財産の保護のために必要がある場合</li>
        <li>公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合</li>
        <li>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合</li>
    </ul>

    <h2 class="mt-4 mb-3">4. 個人情報の安全管理</h2>
    <p>当社は、個人情報の紛失、破壊、改ざん及び漏洩などのリスクに対して、適切な安全対策を実施し、個人情報の安全管理に努めます。</p>

    <h2 class="mt-4 mb-3">5. 個人情報の開示・訂正・削除</h2>
    <p>ユーザーから個人情報の開示・訂正・削除のご要望があった場合、本人確認の上、適切に対応いたします。</p>

    <h2 class="mt-4 mb-3">6. プライバシーポリシーの変更</h2>
    <p>当社は、必要に応じて、本ポリシーを変更することがあります。変更後のプライバシーポリシーは、本ウェブサイトに掲載したときから効力を生じるものとします。</p>

    <h2 class="mt-4 mb-3">7. お問い合わせ</h2>
    <p>本ポリシーに関するお問い合わせは、以下の連絡先までお願いいたします。</p>
    <p>
        Regener8r<br>
        メール：info@regener8r.com
    </p>
    
    <p class="updated-date">最終更新日：2024年8月22日</p>
</div>
@endsection