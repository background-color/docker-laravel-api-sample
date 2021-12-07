# docker-laravel-api-sample
- dockerでlaravelの環境を作る
- laravelの基本の動作確認、webとapiを動作するようにする
- apiからdbのselect,insert,updateを可能とする

## 前提条件
```bash
docker-compose -v  
docker-compose version 1.29.2
```

## 準備
```
docker-compose up -d --build
docker-compose exec php bash

cd sample
php artisan migrate
php artisan db:seed
```

## 環境
`http://localhost:8080/` でindex画面表示
![スクリーンショット 2021-12-05 15 19 51](https://user-images.githubusercontent.com/10904568/144736297-b12ade73-d80e-472e-86ff-b4e5fb8cb27b.png)



## API仕様

### レスポンス共通
- status : T/F
- results : 結果一覧
- error : エラーの詳細の説明

レスポンスの例
```
{
    status: false,
    results: [ ],
    error: {
        messages: "Bad Request."
    }
}
```

#### /api/category
  - get
  - response
  ```
  {
    status: true,
    results: [
        {
            id: 1,
            name: "歩数"
        },
        {
            id: 2,
            name: "体重"
        }
    ]
  }
  ```

#### /api/graph/all/{category_if}
  - get
  - response
  ```
  {
    status: true,
    results: {
        dates: [
            "2021-12-01",
            "2021-12-02",
            "2021-12-03",
            "2021-12-04",
            "2021-12-05",
            "2021-12-06"
        ],
        values: [
            5000,
            6000,
            5000,
            5500,
            5500,
            7000
        ]
    }
  }
  ```

####  /api/graph/update
  - post
  - request
  ```
    post {
        'category_id' => category_id,
        'date' => date,
        'val' => val
    }
  ```
  - response
  ```
  {
    status: true,
    results: []
  }
  ```
