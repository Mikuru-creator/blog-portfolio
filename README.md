# Inko Blog（portfolio）

ポートフォリオ用にLaravelで作った自分のペット（インコ）のブログサイトです。<br>
Livewireスターターキットを使用しました。
<img width="1919" height="986" alt="Image" src="https://github.com/user-attachments/assets/77bb07d8-8016-4c11-bb21-b612c0316c31" />

## 主な機能
- 公開：TOP / 投稿一覧 / 投稿詳細（コメント投稿）/ ギャラリー
- 管理：管理者登録　/ ログイン / 投稿CRUD / コメント削除
※本来管理者登録をログイン画面と同一画面に出すべきではありませんが、ポートフォリオのため表示しております。

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

php artisan serve
bun run dev
```
