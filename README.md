# laravel-repository

用于 Laravel 的 Eloquent Repository 包，要求 PHP >= 8.4。

包含 Repository、查询条件、缓存及缓存清理事件、Presenter / Transformer，以及 `mino:*` Artisan 生成命令。Composer 配置已启用 Laravel 服务提供者自动发现。

发布配置：

```sh
php artisan vendor:publish --provider="Morisawa\Providers\RepositoryServiceProvider"
```

`mino:*` 命令（以下以 `User` 为示例名称）：

| 命令 | 说明 |
| --- | --- |
| `php artisan mino:repo User` | 生成 Repository 接口、Eloquent 实现、Model、Presenter 和 Transformer，并添加容器绑定。 |
| `php artisan mino:ctrl User` | 生成 RESTful 控制器，交互选择是否生成 Create / Update Request。 |
| `php artisan mino:criteria Active` | 生成查询条件类。 |
| `php artisan mino:request User/Create` | 生成 Request 类。 |
| `php artisan mino:model User` | 生成 Model 类。 |
| `php artisan mino:job SyncUsers` | 生成 Job 类。 |
| `php artisan mino:bind User` | 将 Repository 接口与实现的绑定添加到服务提供者。 |
| `php artisan mino:lang` | 扫描 `app/Http/Requests` 中带有 `langPath` 和 `rules()` 的 Request，将验证规则键同步到 `lang/en/_Validation.php`，补充缺失的空白翻译项。 |

控制器的 `--request` 选项支持 `all`、`create`、`update`、`none`（也可分别使用 `a`、`c`、`u`、`n`）：

```sh
php artisan mino:ctrl User --request=all
php artisan mino:ctrl User --request=create
php artisan mino:ctrl User --request=update
php artisan mino:ctrl User --request=none
```

Job 的 `--path`（简写 `-p`）可指定子目录，内置 `business`、`guardian`、`routine`、`support`，对应简写 `b`、`g`、`r`、`s`，也支持自定义路径：

```sh
php artisan mino:job SyncUsers --path=business
php artisan mino:job SyncUsers -p b
```

查看命令的参数说明：

```sh
php artisan help mino:repo
```
