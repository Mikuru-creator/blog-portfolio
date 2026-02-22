# Inko Blog（portfolio）

ポートフォリオ用にLaravelで作った自分のペット（インコ）のブログサイトです。

<p>
    <img width="32%" alt="Image" src="https://github.com/user-attachments/assets/77bb07d8-8016-4c11-bb21-b612c0316c31" />
    <img width="32%" alt="Image" src="https://github.com/user-attachments/assets/d86e8d75-eb1c-4861-b386-d139ac749bc3" />
    <img width="32%" alt="Image" src="https://github.com/user-attachments/assets/9314051e-c6a5-40ae-b716-5e34c929184b" />
</p>
<p>
    <img width="32%" alt="Image" src="https://github.com/user-attachments/assets/5b7ec292-3c49-4071-b32e-eb7ced5748c7" />
    <img width="32%" alt="Image" src="https://github.com/user-attachments/assets/9702f144-7fba-4c4a-8a92-e9d4adc9ee3d" />
</p>

## 主な機能
公開機能
- TOP表示
- 投稿一覧表示
- 投稿詳細表示（コメント投稿あり）
- ギャラリー（画像一覧）

管理機能
- 管理者登録（ポートフォリオ確認用に一時的に公開）
- ログイン / ログアウト（スターターキットの認証を流用）
- 投稿CRUD（画像複数枚アップロード可）
- 投稿編集機能（画像削除、コメント削除あり）

その他
- ページネーション
- バリデーション（投稿/コメント/画像）
- DBトランザクション
- TOPの最新投稿スライダーにはLivewireを使用
- レスポンシブ対応

## 技術
- PHP 8.4.0
- Laravel 12.51.0
- Livewire
- SQLite
- Bun / Vite / Tailwind CSS

## ローカル起動手順
```bash
composer install
bun install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link

php artisan serve
bun run dev
```
