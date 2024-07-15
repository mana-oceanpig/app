<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - メール認証</title>
</head>
<body style="font-family: 'Noto Sans JP', 'Poppins', sans-serif; line-height: 1.6; color: #333333; background-color: #ecf0f1; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 2rem auto; padding: 2rem; background-color: white; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
        <h1 style="color: #3498db; text-align: center; margin-bottom: 1.5rem;">{{ config('app.name') }}</h1>

        <p style="margin-bottom: 1rem;">{{ __('ご登録ありがとうございます。以下のボタンをクリックして、メールアドレスの確認を完了してください。') }}</p>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td align="center">
                    <a href="{{ $actionUrl }}" style="display: inline-block; padding: 0.75rem 1.5rem; font-size: 1rem; font-weight: bold; text-align: center; text-decoration: none; border-radius: 50px; transition: all 0.3s ease; color: white; background: linear-gradient(45deg, #3498db, #2ecc71); border: none;" target="_blank" rel="noopener">{{ $actionText }}</a>
                </td>
            </tr>
        </table>

        <p style="margin-bottom: 1rem;">{{ __('このボタンの有効期限は :count 分です。', ['count' => config('auth.verification.expire', 60)]) }}</p>

        <p style="margin-bottom: 1rem;">{{ __('もしこのメールに心当たりがない場合は、このまま破棄してください。') }}</p>

        <div style="margin-top: 2rem; font-size: 0.9rem; color: #718096; border-top: 1px solid #e8e5ef; padding-top: 1rem;">
            <p>このメールはご入力されたメールアドレスへ自動送信しております。</p>
            <p>どなたかが会員登録の際に誤ってあなたのメールアドレスを入力した可能性がございます。</p>
            <p>お心当たりのない方は破棄して頂ければ仮登録のままとなり、24時間を過ぎますと、このメールアドレス情報は自動的に削除されます。</p>
            <p>ご登録に関するお問合せは、メールまでお問い合わせください。</p>
        </div>

        @isset($actionText)
        <p style="font-size: 0.9rem; color: #718096;">
            @lang(
                "もし \":actionText\" ボタンがクリックできない場合は、以下のURLをコリして\n".
                'ウェブブラウザに貼り付けてください:',
                [
                    'actionText' => $actionText,
                ]
            )
            <span style="word-break: break-all;">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
        </p>
        @endisset
    </div>
</body>
</html>