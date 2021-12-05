# docker-laravel-form
laravelでフォーム作ってみる


準備
docker-compose up -d --build
docker-compose exec php bash
cd sample
php artisan migrate
php artisan db:seed


API仕様


status : T/F
results : 結果一覧
error : エラーの詳細の説明
レスポンスの例
{
    status: false,
    results: [ ],
    error: {
        messages: "Bad Request."
    }
}

/api/category
/api/graph/all/{category_if}
/api/graph/update
post {
    'category_id' => category_id,
    'date' => date,
    'val' => val
}
