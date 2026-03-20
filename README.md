# Hyperf Validation

基于注解的 Hyperf 框架验证器扩展包，通过属性注解实现优雅的数据验证。

## 安装

```bash
composer require kooditorm/hyperf-validation
```

## 特性

- 🚀 基于 PHP8.1+ 属性注解
- 💎 优雅的 AOP 切面验证
- 📦 支持自定义验证规则
- 🎯 自动类型转换
- 🌐 支持自定义错误消息

## ✅ 数据验证

### 内置验证注解

> 需要先安装 Hyperf 验证器：`composer require hyperf/validation`

本库提供了丰富的验证注解，包括：

- `Required` - 必填项
- `Integer` - 整数
- `Numeric` - 数字
- `Between` - 范围验证
- `Min` / `Max` - 最小/最大值
- `Email` - 邮箱格式
- `Url` - URL 格式
- `Date` - 日期格式
- `DateFormat` - 指定日期格式
- `Boolean` - 布尔值
- `Alpha` - 字母
- `AlphaNum` - 字母和数字
- `AlphaDash` - 字母、数字、破折号、下划线
- `Image` - 图片文件
- `Json` - JSON 格式
- `Nullable` - 可为空
- `In` - 在指定值中
- `NotIn` - 不在指定值中
- `Regex` - 正则表达式
- `Unique` - 数据库唯一
- `Exists` - 数据库存在

## 快速开始

### 1. 基础用法

在控制器方法上使用 `#[Validated]` 注解：

```php
<?php
declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\PostMapping;
use Kooditorm\Validation\Annotation\Validated;

#[Controller(prefix: "user")]
class UserController
{
    #[PostMapping(path: "create")]
    #[Validated(instance: CreateUserRequest::class)]
    public function create()
    {
        // 验证通过后的业务逻辑
        return ['message' => '创建成功'];
    }
}
```

### 2. 定义验证规则类

创建验证请求类，使用属性注解定义验证规则：

```php
<?php
declare(strict_types=1);

namespace App\Request;

use Kooditorm\Validation\Annotation\Rules\NotBlank;
use Kooditorm\Validation\Annotation\Rules\Pattern;

class CreateUserRequest
{
    #[NotBlank(message: '用户名不能为空')]
    private string $username;

    #[NotBlank(message: '邮箱不能为空')]
    #[Pattern(value: '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', message: '邮箱格式不正确')]
    private string $email;

    #[NotBlank(message: '密码不能为空')]
    private string $password;

    // Getters and Setters
    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}
```

### 3. 直接使用 Valid 注解

也可以直接在方法参数上使用 `#[Valid]` 注解：

```php
#[PostMapping(path: "update")]
#[Valid]
public function update(UpdateUserRequest $request)
{
    return ['message' => '更新成功'];
}
```

## 内置验证规则

### 类型验证

支持 PHP 原生类型声明，会自动转换为对应的验证规则：

```php
class UserRequest
{
    // 转换为 'integer' 规则
    private int $age;
    
    // 转换为 'string' 规则
    private string $name;
    
    // 转换为 'boolean' 规则
    private bool $status;
    
    // 转换为 'array' 规则
    private array $tags;
}
```

**支持的类型转换：**
- `int` → `integer`
- 其他 PHP 类型保持原名

### 可用注解规则

#### NotBlank

必填项验证：

```php
use Kooditorm\Validation\Annotation\Rules\NotBlank;

#[NotBlank(message: '此项为必填项')]
private string $field;
```

参数说明：
- `message`: 错误消息
- `rule`: 验证规则（默认 `required`）
- `filed`: 字段名（可选）

#### Pattern

正则表达式验证：

```php
use Kooditorm\Validation\Annotation\Rules\Pattern;

#[Pattern(
    value: '/^\d{11}$/', 
    message: '手机号格式不正确'
)]
private string $phone;
```

参数说明：
- `value`: 正则表达式模式
- `message`: 错误消息
- `rule`: 验证规则（默认 `regex:{$value}`）
- `field`: 字段名（可选）

### 自定义验证规则

继承 `ValidatorAnnotation` 抽象类创建自定义规则：

```php
<?php
declare(strict_types=1);

namespace App\Validation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class MaxLength extends ValidatorAnnotation
{
    public function __construct(
        public int $length,
        public string $message = '',
        public string $rule = 'max:{$length}',
    ) {
    }
}
```

使用自定义规则：

```php
class PostRequest
{
    #[MaxLength(length: 100, message: '标题长度不能超过 100 个字符')]
    private string $title;
}
```

## 高级用法

### 可空字段

使用 PHP 的类型系统声明可空字段：

```php
class UserRequest
{
    // 会自动添加 'nullable' 规则
    private ?string $nickname = null;
    
    private ?int $age = null;
}
```

### 多个验证规则

同一个字段可以应用多个验证规则注解：

```php
class RegisterRequest
{
    #[NotBlank(message: '用户名不能为空')]
    #[Pattern(value: '/^[a-zA-Z][a-zA-Z0-9_]{4,19}$/', message: '用户名格式不正确')]
    private string $username;

    #[NotBlank(message: '密码不能为空')]
    #[Pattern(value: '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', message: '密码必须包含字母和数字，且长度不少于 6 位')]
    private string $password;
}
```

## 异常处理

验证失败会抛出 `ValidationException` 异常，默认状态码为 422。

### 自定义异常处理器

包内已提供默认的异常处理器 `ValidateExceptionHandler`，如需自定义：

```php
<?php
declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Kooditorm\Validation\Exception\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CustomValidateExceptionHandler extends \Hyperf\ExceptionHandler\AbstractExceptionHandler
{
    protected array $ignore = [
        ValidationException::class,
    ];

    public function handle(Throwable $throwable, ServerRequestInterface $request): ResponseInterface
    {
        if ($throwable instanceof ValidationException) {
            return $this->response->json([
                'code' => 422,
                'message' => $throwable->getMessage(),
                'data' => null,
            ])->withStatus(422);
        }
        
        return $this->response->json([
            'code' => 500,
            'message' => '服务器内部错误',
        ])->withStatus(500);
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
```

## 工作原理

本包利用 Hyperf 的 AOP 切面编程和注解功能：

1. `ValidatorAspect` 切面拦截标注了 `#[Validated]` 或 `#[Valid]` 的方法
2. 从方法参数或注解中获取验证规则类
3. 通过反射读取属性的类型声明和验证注解
4. 构建验证规则和消息数组
5. 使用 Hyperf 原生的验证器进行验证
6. 验证失败抛出 `ValidationException` 异常

## 注意事项

1. **PHP 版本要求**: 需要 PHP 8.1 或更高版本
2. **Hyperf 版本**: 需要 Hyperf 3.1.0 或更高版本
3. **属性扫描**: 确保配置文件中扫描了相关路径
4. **类型声明**: 建议使用严格的类型声明以获得更好的验证效果

## 许可证

MIT License

## 贡献

欢迎提交 Issue 和 Pull Request！

## 作者

- oswin.hu <oswin.hu@gmail.com>

## 相关链接

- [GitHub](https://github.com/Kooditorm/hyperf-validation)
- [Packagist](https://packagist.org/packages/kooditorm/hyperf-validation)
- [Hyperf 文档](https://hyperf.wiki)