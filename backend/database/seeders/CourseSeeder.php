<?php

namespace Database\Seeders;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->truncate();
        DB::table('chapters')->truncate();
        DB::table('lessons')->truncate();
        $data = [
            [
                'title'       => 'Xây dựng Web App với Laravel 11 & Vue.js 3',
                'description' => 'Lộ trình từ Zero đến Deploy: Xây dựng ứng dụng web full-stack chuyên nghiệp với Laravel 11 kết hợp Vue.js 3, bao gồm Authentication (Sanctum), API, Inertia.js, real-time và deployment production-ready.',
                'status'      => 1,
                'thumbnail'   => 'https://i.ytimg.com/vi/EbZoXt-BYn0/maxresdefault.jpg',
                'price'       => 499000,
                'created_at'  => '2026-03-31 16:00:00',
                'chapters'    => [
                    // ==================== CHAPTER 1 ====================
                    [
                        'title'    => 'Chương 1: Khởi tạo Dự án và Môi trường Phát triển',
                        'order'    => 1,
                        'is_free'  => true,
                        'price'    => 0,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Cài đặt Laravel 11 và Vue 3 với Vite từ Zero',
                                'content' => $this->cleanText("Lý thuyết ngắn: Laravel 11 sử dụng skeleton tối giản và Vite làm asset bundler mặc định, giúp giảm đáng kể thời gian build so với các phiên bản trước.\n\nCode mẫu:\n```bash\ncomposer create-project laravel/laravel my-app\ncd my-app\nnpm install\nnpm run dev\n```\n\nVideo minh họa: "),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Cấu hình .env và Kết nối Database MySQL 8+',
                                'content' => $this->cleanText("Lý thuyết ngắn: File .env là trung tâm cấu hình ứng dụng. Laravel 11 hỗ trợ native MySQL 8+ với cải tiến về performance và security.\n\nCode mẫu:\n```env\nDB_CONNECTION=mysql\nDB_HOST=127.0.0.1\nDB_PORT=3306\nDB_DATABASE=laravel_vue_app\nDB_USERNAME=root\nDB_PASSWORD=\n```\n\nVideo minh họa: https://youtube.com/embed/env-mysql-laravel11"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Tạo Migration, Model và Seeder đầu tiên',
                                'content' => $this->cleanText("Lý thuyết ngắn: Migration cho phép version control schema database. Laravel 11 khuyến khích sử dụng factories và seeders hiện đại.\n\nCode mẫu:\n```bash\nphp artisan make:model User -mf\nphp artisan migrate\nphp artisan db:seed\n```\n\nVideo minh họa: https://youtube.com/embed/migration-model-seeder-laravel11"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Giới thiệu MVC Pattern và Route Groups trong Laravel 11',
                                'content' => $this->cleanText("Lý thuyết ngắn: MVC giúp tách biệt logic. Route groups và middleware là nền tảng cho mọi API production.\n\nCode mẫu:\n```php\nRoute::middleware('auth:sanctum')->prefix('api')->group(function () {\n    Route::resource('posts', PostController::class);\n});\n```\n\nVideo minh họa: https://youtube.com/embed/mvc-routing-laravel11"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Setup Tailwind CSS + Alpine.js kết hợp Vue 3',
                                'content' => $this->cleanText("Lý thuyết ngắn: Tailwind + Alpine.js giúp xây dựng UI hiện đại mà không cần framework nặng, kết hợp mượt mà với Vue 3.\n\nCode mẫu:\n```bash\nnpm install -D tailwindcss postcss autoprefixer\nnpx tailwindcss init -p\n```\n\nVideo minh họa: https://youtube.com/embed/tailwind-alpine-vue3-laravel"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 2 ====================
                    [
                        'title'    => 'Chương 2: Xây dựng Backend với Laravel 11',
                        'order'    => 2,
                        'is_free'  => false,
                        'price'    => 199000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Routing nâng cao và Middleware Authentication',
                                'content' => $this->cleanText("Lý thuyết ngắn: Route groups và middleware cho phép bảo vệ route linh hoạt và tái sử dụng.\n\nCode mẫu:\n```php\nRoute::middleware(['auth:sanctum', 'verified'])->group(function () { ... });\n```\n\nVideo minh họa: https://youtube.com/embed/routing-middleware-laravel11"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Resource Controllers và Form Request Validation',
                                'content' => $this->cleanText("Lý thuyết ngắn: Resource Controller tự động sinh 7 actions RESTful. Form Request tách validation ra khỏi controller.\n\nCode mẫu:\n```php\npublic function rules(): array\n{\n    return ['title' => 'required|string|max:255'];\n}\n```\n\nVideo minh họa: https://youtube.com/embed/resource-controller-form-request"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Authentication với Laravel Sanctum cho SPA',
                                'content' => $this->cleanText("Lý thuyết ngắn: Sanctum cung cấp token-based authentication đơn giản và mạnh mẽ cho Vue/React SPA.\n\nCode mẫu:\n```php\nphp artisan sanctum:install\nphp artisan make:controller AuthController\n```\n\nVideo minh họa: https://youtube.com/embed/sanctum-auth-vue3"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'API Resources và Eloquent Serialization',
                                'content' => $this->cleanText("Lý thuyết ngắn: API Resource giúp kiểm soát hoàn toàn dữ liệu trả về cho client Vue.js.\n\nCode mẫu:\n```php\nreturn new PostResource(\$post);\n```\n\nVideo minh họa: https://youtube.com/embed/api-resources-laravel11"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Rate Limiting và API Security Best Practices',
                                'content' => $this->cleanText("Lý thuyết ngắn: Laravel 11 cung cấp rate limiting built-in để bảo vệ API khỏi abuse.\n\nCode mẫu:\n```php\nRoute::middleware('throttle:api')->group(...);\n```\n\nVideo minh họa: https://youtube.com/embed/rate-limiting-security-laravel"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 3 ====================
                    [
                        'title'    => 'Chương 3: Quản lý Dữ liệu với Eloquent ORM',
                        'order'    => 3,
                        'is_free'  => false,
                        'price'    => 249000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Eloquent Relationships và Eager Loading',
                                'content' => $this->cleanText("Lý thuyết ngắn: Eager loading (with()) giúp tránh N+1 query problem trong ứng dụng full-stack.\n\nCode mẫu:\n```php\n\$user = User::with('posts.comments')->find(1);\n```\n\nVideo minh họa: https://youtube.com/embed/eloquent-relationships-laravel11"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Query Scopes, Accessors và Mutators',
                                'content' => $this->cleanText("Lý thuyết ngắn: Local & Global scopes giúp viết query tái sử dụng và sạch sẽ.\n\nCode mẫu:\n```php\npublic function scopeActive(\$query) { return \$query->where('status', 1); }\n```\n\nVideo minh họa: https://youtube.com/embed/eloquent-scopes-accessors"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Polymorphic Relationships và Soft Deletes',
                                'content' => $this->cleanText("Lý thuyết ngắn: Polymorphic cho phép một model liên kết với nhiều model khác (commentable).\n\nCode mẫu:\n```php\npublic function commentable() { return \$this->morphTo(); }\n```\n\nVideo minh họa: https://youtube.com/embed/polymorphic-softdeletes"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Database Transactions và Race Condition Handling',
                                'content' => $this->cleanText("Lý thuyết ngắn: DB::transaction() đảm bảo tính toàn vẹn dữ liệu khi có nhiều thao tác.\n\nCode mẫu:\n```php\nDB::transaction(function () { ... });\n```\n\nVideo minh họa: https://youtube.com/embed/database-transaction-race-condition"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Eloquent Events và Observers',
                                'content' => $this->cleanText("Lý thuyết ngắn: Model events (created, updated, deleted) kết hợp Observer giúp tách logic business.\n\nCode mẫu:\n```php\nphp artisan make:observer UserObserver\n```\n\nVideo minh họa: https://youtube.com/embed/eloquent-events-observers"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 4 ====================
                    [
                        'title'    => 'Chương 4: Xây dựng Frontend với Vue.js 3 & Inertia.js',
                        'order'    => 4,
                        'is_free'  => false,
                        'price'    => 299000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Vue 3 Composition API và Pinia State Management',
                                'content' => $this->cleanText("Lý thuyết ngắn: Composition API + Pinia thay thế hoàn toàn Vuex, mang lại code sạch và reactive mạnh mẽ.\n\nCode mẫu:\n```vue\n<script setup>\nimport { useAuthStore } from '@/stores/auth';\nconst auth = useAuthStore();\n</script>\n```\n\nVideo minh họa: https://youtube.com/embed/vue3-composition-pinia"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Inertia.js – Kết nối Laravel & Vue mà không cần API',
                                'content' => $this->cleanText("Lý thuyết ngắn: Inertia.js cho phép dùng Laravel routes trực tiếp trong Vue mà không cần viết REST API riêng.\n\nCode mẫu:\n```php\nreturn Inertia::render('Dashboard', ['courses' => \$courses]);\n```\n\nVideo minh họa: https://youtube.com/embed/inertiajs-laravel-vue3"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Server-Side Rendering (SSR) với Vite + Vue 3',
                                'content' => $this->cleanText("Lý thuyết ngắn: SSR cải thiện SEO và First Contentful Paint cho ứng dụng full-stack.\n\nCode mẫu:\n```bash\nnpm run build:ssr\n```\n\nVideo minh họa: https://youtube.com/embed/ssr-vite-vue3-laravel"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Reusable Components và Composables trong Vue 3',
                                'content' => $this->cleanText("Lý thuyết ngắn: Composables giúp tái sử dụng logic giữa các component một cách sạch sẽ.\n\nCode mẫu:\n```js\n// useApi.js\nexport function useApi() { ... }\n```\n\nVideo minh họa: https://youtube.com/embed/composables-vue3"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Form Handling và Validation với Vue 3 + Laravel',
                                'content' => $this->cleanText("Lý thuyết ngắn: Kết hợp Inertia form helper với Laravel validation messages.\n\nCode mẫu:\n```vue\nform.post('/courses', { title: '' });\n```\n\nVideo minh họa: https://youtube.com/embed/vue-form-validation-inertia"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 5 ====================
                    [
                        'title'    => 'Chương 5: Tích hợp Full-Stack, Testing và Triển khai Production',
                        'order'    => 5,
                        'is_free'  => false,
                        'price'    => 399000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Real-time với Laravel Reverb và Vue 3',
                                'content' => $this->cleanText("Lý thuyết ngắn: Reverb là WebSocket server chính thức của Laravel, thay thế Pusher.\n\nCode mẫu:\n```php\nBroadcast::channel('course.{id}', function () { ... });\n```\n\nVideo minh họa: https://youtube.com/embed/laravel-reverb-vue3"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Unit & Feature Testing với PHPUnit và Pest',
                                'content' => $this->cleanText("Lý thuyết ngắn: Pest.js là syntax hiện đại trên PHPUnit, giúp viết test ngắn gọn và dễ đọc.\n\nCode mẫu:\n```php\nit('creates a course', function () {\n    \$response = \$this->post('/api/courses', [...]); \n});\n```\n\nVideo minh họa: https://youtube.com/embed/pest-testing-laravel11"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Docker + Laravel Sail cho môi trường Production',
                                'content' => $this->cleanText("Lý thuyết ngắn: Laravel Sail cung cấp Docker environment chuẩn production ngay từ đầu.\n\nCode mẫu:\n```bash\n./vendor/bin/sail up -d\n```\n\nVideo minh họa: https://youtube.com/embed/docker-sail-laravel11"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Deployment lên Laravel Forge + Vapor',
                                'content' => $this->cleanText("Lý thuyết ngắn: Forge + Vapor là giải pháp deploy zero-downtime cho Laravel 11.\n\nCode mẫu:\n```bash\nforge deploy\n```\n\nVideo minh họa: https://youtube.com/embed/laravel-forge-vapor-deploy"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Performance Optimization và Caching Strategies',
                                'content' => $this->cleanText("Lý thuyết ngắn: Cache query, route cache, config cache và Octane giúp ứng dụng đạt tốc độ production.\n\nCode mẫu:\n```bash\nphp artisan route:cache\nphp artisan config:cache\n```\n\nVideo minh họa: https://youtube.com/embed/performance-optimization-laravel11"),
                                'order'   => 5
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title'       => 'Python Masterclass: Từ số 0 đến lập trình AI & Automation',
                'description' => 'Khóa học Python toàn diện từ cơ bản đến nâng cao, tập trung vào AI, Machine Learning, Data Science và Automation thực tế với các công cụ hiện đại nhất năm 2026.',
                'status'      => 1,
                'thumbnail'   => 'https://waytoeasylearn.com/storage/2025/05/python-tutorials.jpg.webp',
                'price'       => 599000,
                'created_at'  => '2026-03-31 16:00:00',
                'chapters'    => [
                    // ==================== CHAPTER 1 ====================
                    [
                        'title'    => 'Chương 1: Khởi tạo Môi trường Python và Cú pháp Cơ bản',
                        'order'    => 1,
                        'is_free'  => true,
                        'price'    => 0,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Cài đặt Python 3.12, Virtual Environment và Poetry',
                                'content' => $this->cleanText("Lý thuyết ngắn: Python 3.12 mang lại hiệu năng cao hơn và hỗ trợ tốt hơn cho type hinting. Virtual environment và Poetry là chuẩn mực để quản lý dependencies trong dự án production.\n\nCode mẫu:\n```bash\npython -m venv venv\nsource venv/bin/activate\npip install poetry\npoetry init\n```\n\nVideo minh họa: https://youtube.com/embed/python312-poetry-setup-2026"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Variables, Type Hinting và Data Types nâng cao',
                                'content' => $this->cleanText("Lý thuyết ngắn: Type hinting giúp code dễ đọc, dễ maintain và hỗ trợ tốt cho IDE và static type checker (mypy).\n\nCode mẫu:\n```python\ndef calculate_discount(price: float, rate: float = 0.1) -> float:\n    return price * (1 - rate)\n```\n\nVideo minh họa: https://youtube.com/embed/python-type-hinting"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Control Flow, List Comprehensions và Pattern Matching',
                                'content' => $this->cleanText("Lý thuyết ngắn: List comprehensions và structural pattern matching (Python 3.10+) giúp viết code ngắn gọn và Pythonic hơn.\n\nCode mẫu:\n```python\nsquares = [x2 for x in range(10) if x % 2 == 0]\nmatch status:\n    case 200: print('Success')\n```\n\nVideo minh họa: https://youtube.com/embed/list-comprehension-pattern-matching"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Functions, Lambda, Decorators và *args/kwargs',
                                'content' => $this->cleanText("Lý thuyết ngắn: Decorators là một trong những tính năng mạnh mẽ nhất của Python, thường dùng cho logging, caching và authentication.\n\nCode mẫu:\n```python\ndef timer(func):\n    def wrapper(*args, kwargs):\n        start = time.time()\n        result = func(*args, kwargs)\n        print(f'Time: {time.time()-start}')\n        return result\n    return wrapper\n```\n\nVideo minh họa: https://youtube.com/embed/python-decorators-lambda"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Modules, Packages và Quản lý Dependencies với pyproject.toml',
                                'content' => $this->cleanText("Lý thuyết ngắn: Cấu trúc package chuẩn PEP 621 giúp dự án chuyên nghiệp và dễ publish lên PyPI.\n\nCode mẫu:\n```toml\n[tool.poetry]\nname = \"ai-automation\"\nversion = \"1.0.0\"\n```\n\nVideo minh họa: https://youtube.com/embed/python-modules-packages-poetry"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 2 ====================
                    [
                        'title'    => 'Chương 2: Python Nâng cao và Cấu trúc Dữ liệu',
                        'order'    => 2,
                        'is_free'  => false,
                        'price'    => 149000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Collections, Itertools và Generators nâng cao',
                                'content' => $this->cleanText("Lý thuyết ngắn: Generators giúp tiết kiệm bộ nhớ khi xử lý dữ liệu lớn, kết hợp itertools tạo ra các công cụ mạnh mẽ cho data processing.\n\nCode mẫu:\n```python\ndef fibonacci():\n    a, b = 0, 1\n    while True:\n        yield a\n        a, b = b, a + b\n```\n\nVideo minh họa: https://youtube.com/embed/python-generators-itertools"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Context Managers và with statement',
                                'content' => $this->cleanText("Lý thuyết ngắn: Context managers đảm bảo resource được giải phóng đúng cách, đặc biệt quan trọng khi làm việc với file và database.\n\nCode mẫu:\n```python\nclass DatabaseConnection:\n    def __enter__(self): ...\n    def __exit__(self, *args): ...\n```\n\nVideo minh họa: https://youtube.com/embed/python-context-managers"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Multithreading, Multiprocessing và Asyncio',
                                'content' => $this->cleanText("Lý thuyết ngắn: Asyncio là cách tối ưu nhất để xử lý I/O-bound tasks trong Python hiện đại.\n\nCode mẫu:\n```python\nasync def fetch_data():\n    async with aiohttp.ClientSession() as session:\n        async with session.get(url) as resp:\n            return await resp.json()\n```\n\nVideo minh họa: https://youtube.com/embed/python-asyncio-multiprocessing"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Error Handling và Custom Exceptions',
                                'content' => $this->cleanText("Lý thuyết ngắn: Xử lý exception chuyên nghiệp giúp ứng dụng ổn định và dễ debug trong production.\n\nCode mẫu:\n```python\nclass APIError(Exception):\n    pass\n\nraise APIError('Invalid response')\n```\n\nVideo minh họa: https://youtube.com/embed/python-error-handling"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Dataclasses, NamedTuple và Pydantic V2',
                                'content' => $this->cleanText("Lý thuyết ngắn: Pydantic V2 là thư viện validation mạnh nhất hiện nay, thường dùng trong FastAPI và AI projects.\n\nCode mẫu:\n```python\nfrom pydantic import BaseModel\nclass User(BaseModel):\n    name: str\n    age: int\n```\n\nVideo minh họa: https://youtube.com/embed/pydantic-v2-dataclasses"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 3 ====================
                    [
                        'title'    => 'Chương 3: Lập trình Hướng đối tượng và Design Patterns',
                        'order'    => 3,
                        'is_free'  => false,
                        'price'    => 229000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'OOP Fundamentals: Class, Object, Inheritance và Polymorphism',
                                'content' => $this->cleanText("Lý thuyết ngắn: Python hỗ trợ lập trình hướng đối tượng mạnh mẽ với dynamic typing và duck typing, giúp code linh hoạt và dễ mở rộng.\n\nCode mẫu:\n```python\nclass Animal:\n    def speak(self):\n        pass\n\nclass Dog(Animal):\n    def speak(self):\n        return 'Woof!'\n```\n\nVideo minh họa: https://youtube.com/embed/python-oop-fundamentals-2026"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Magic Methods (Dunder Methods) và Operator Overloading',
                                'content' => $this->cleanText("Lý thuyết ngắn: Magic methods cho phép tùy chỉnh hành vi của class với các toán tử Python (+, -, [], ...).\n\nCode mẫu:\n```python\nclass Vector:\n    def __add__(self, other):\n        return Vector(self.x + other.x, self.y + other.y)\n```\n\nVideo minh họa: https://youtube.com/embed/python-magic-methods"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Abstract Base Classes, Protocols và Structural Subtyping',
                                'content' => $this->cleanText("Lý thuyết ngắn: ABC và Protocols (Python 3.12+) giúp định nghĩa interface rõ ràng mà không mất tính linh hoạt của Python.\n\nCode mẫu:\n```python\nfrom abc import ABC, abstractmethod\nclass PaymentProcessor(ABC):\n    @abstractmethod\n    def process(self, amount: float): ...\n```\n\nVideo minh họa: https://youtube.com/embed/python-abc-protocols"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Design Patterns: Singleton, Factory và Observer',
                                'content' => $this->cleanText("Lý thuyết ngắn: Factory pattern rất phổ biến khi xây dựng framework AI và automation tools.\n\nCode mẫu:\n```python\nclass LoggerFactory:\n    @staticmethod\n    def get_logger(type: str):\n        if type == 'file': return FileLogger()\n        return ConsoleLogger()\n```\n\nVideo minh họa: https://youtube.com/embed/python-design-patterns"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'SOLID Principles áp dụng trong Python thực tế',
                                'content' => $this->cleanText("Lý thuyết ngắn: SOLID giúp code dễ maintain, đặc biệt khi dự án AI & Automation phát triển lớn.\n\nCode mẫu:\n```python\n# Single Responsibility Example\nclass UserService:\n    def create_user(self, data): ...\n```\n\nVideo minh họa: https://youtube.com/embed/python-solid-principles"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 4 ====================
                    [
                        'title'    => 'Chương 4: Xử lý Dữ liệu với Pandas, NumPy và Visualization',
                        'order'    => 4,
                        'is_free'  => false,
                        'price'    => 279000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'NumPy Arrays và Vectorized Operations',
                                'content' => $this->cleanText("Lý thuyết ngắn: NumPy cho phép tính toán vectorized cực nhanh, là nền tảng của mọi thư viện AI và Data Science.\n\nCode mẫu:\n```python\nimport numpy as np\narr = np.array([1, 2, 3, 4])\nresult = arr * 2 + np.sin(arr)\n```\n\nVideo minh họa: https://youtube.com/embed/numpy-vectorized-operations"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Pandas DataFrame và Series Manipulation',
                                'content' => $this->cleanText("Lý thuyết ngắn: Pandas là công cụ mạnh nhất để xử lý dữ liệu bảng trong Python.\n\nCode mẫu:\n```python\nimport pandas as pd\ndf = pd.read_csv('data.csv')\ndf['total'] = df['price'] * df['quantity']\n```\n\nVideo minh họa: https://youtube.com/embed/pandas-dataframe-series"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Data Cleaning và Transformation Techniques',
                                'content' => $this->cleanText("Lý thuyết ngắn: 80% thời gian của Data Scientist dành cho cleaning data.\n\nCode mẫu:\n```python\ndf.dropna(subset=['age'], inplace=True)\ndf['date'] = pd.to_datetime(df['date'])\n```\n\nVideo minh họa: https://youtube.com/embed/pandas-data-cleaning"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Data Visualization với Matplotlib và Seaborn',
                                'content' => $this->cleanText("Lý thuyết ngắn: Seaborn giúp vẽ biểu đồ đẹp và chuyên nghiệp chỉ với vài dòng code.\n\nCode mẫu:\n```python\nimport seaborn as sns\nsns.heatmap(df.corr(), annot=True, cmap='coolwarm')\n```\n\nVideo minh họa: https://youtube.com/embed/seaborn-matplotlib-visualization"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'GroupBy, Pivot Tables và Time Series Analysis',
                                'content' => $this->cleanText("Lý thuyết ngắn: GroupBy và Time Series là kỹ thuật cốt lõi khi phân tích dữ liệu thực tế.\n\nCode mẫu:\n```python\ndf.groupby('category')['sales'].sum().plot(kind='bar')\n```\n\nVideo minh họa: https://youtube.com/embed/pandas-groupby-time-series"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 5 ====================
                    [
                        'title'    => 'Chương 5: AI, Machine Learning và Automation Thực tế',
                        'order'    => 5,
                        'is_free'  => false,
                        'price'    => 399000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Machine Learning cơ bản với Scikit-learn',
                                'content' => $this->cleanText("Lý thuyết ngắn: Scikit-learn cung cấp API thống nhất cho mọi mô hình ML cổ điển.\n\nCode mẫu:\n```python\nfrom sklearn.model_selection import train_test_split\nfrom sklearn.ensemble import RandomForestClassifier\nX_train, X_test, y_train, y_test = train_test_split(X, y)\nmodel = RandomForestClassifier()\nmodel.fit(X_train, y_train)\n```\n\nVideo minh họa: https://youtube.com/embed/scikit-learn-ml-basics"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Xây dựng Chatbot thông minh với Gemini API và LangChain',
                                'content' => $this->cleanText("Lý thuyết ngắn: LangChain giúp kết nối LLM với dữ liệu và tools một cách dễ dàng.\n\nCode mẫu:\n```python\nfrom langchain_google_genai import ChatGoogleGenerativeAI\nllm = ChatGoogleGenerativeAI(model='gemini-2.0-flash')\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-langchain-chatbot"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Web Automation với Selenium và Playwright',
                                'content' => $this->cleanText("Lý thuyết ngắn: Playwright nhanh và đáng tin cậy hơn Selenium, hỗ trợ async và headless mode.\n\nCode mẫu:\n```python\nfrom playwright.async_api import async_playwright\nasync with async_playwright() as p:\n    browser = await p.chromium.launch(headless=True)\n```\n\nVideo minh họa: https://youtube.com/embed/playwright-web-automation"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Xây dựng AI Agents với CrewAI',
                                'content' => $this->cleanText("Lý thuyết ngắn: CrewAI cho phép tạo multi-agent system để giải quyết nhiệm vụ phức tạp.\n\nCode mẫu:\n```python\nfrom crewai import Agent, Task, Crew\nresearcher = Agent(role='Researcher', goal='Tìm thông tin...')\n```\n\nVideo minh họa: https://youtube.com/embed/crewai-ai-agents"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Triển khai Python AI App với FastAPI và Docker',
                                'content' => $this->cleanText("Lý thuyết ngắn: FastAPI + Docker là combo mạnh nhất để deploy production AI services năm 2026.\n\nCode mẫu:\n```python\nfrom fastapi import FastAPI\napp = FastAPI()\n@app.post('/predict')\nasync def predict(data: dict):\n    return {'result': model.predict(data)}\n```\n\nVideo minh họa: https://youtube.com/embed/fastapi-docker-ai-deployment"),
                                'order'   => 5
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title'       => 'Ứng dụng AI & Gemini API vào dự án thực tế',
                'description' => 'Xây dựng các ứng dụng AI thông minh sử dụng Google Gemini API (Gemini 2.0 Flash & Pro), từ chatbot, image generation, multimodal AI đến xây dựng AI Agents và triển khai production-ready.',
                'status'      => 1,
                'thumbnail'   => 'https://tuyendung.evotek.vn/wp-content/uploads/14394-1024x576.png',
                'price'       => 499000,
                'created_at'  => '2026-03-31 16:00:00',
                'chapters'    => [
                    // ==================== CHAPTER 1 ====================
                    [
                        'title'    => 'Chương 1: Giới thiệu Gemini API và Setup Môi trường',
                        'order'    => 1,
                        'is_free'  => true,
                        'price'    => 0,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Tổng quan Gemini 2.0 Flash & Pro và Google AI Studio',
                                'content' => $this->cleanText("Lý thuyết ngắn: Gemini 2.0 là mô hình multimodal mạnh nhất của Google, hỗ trợ text, image, video và function calling.\n\nCode mẫu:\n```python\nfrom google.generativeai import GenerativeModel\nmodel = GenerativeModel('gemini-2.0-flash-exp')\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-2.0-overview-2026"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Cài đặt Google Generative AI SDK và API Key',
                                'content' => $this->cleanText("Lý thuyết ngắn: Sử dụng SDK chính thức giúp dễ dàng integrate Gemini vào Python, Node.js và Laravel.\n\nCode mẫu:\n```bash\npip install google-generativeai\n\nexport GEMINI_API_KEY=your_key_here\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-sdk-install"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Gọi API đầu tiên: Text Generation và Safety Settings',
                                'content' => $this->cleanText("Lý thuyết ngắn: Safety settings giúp kiểm soát nội dung output theo chính sách của Google.\n\nCode mẫu:\n```python\nresponse = model.generate_content(\n    \"Giải thích về Laravel 11\",\n    generation_config={\"temperature\": 0.7}\n)\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-first-api-call"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Chat Session và History Management',
                                'content' => $this->cleanText("Lý thuyết ngắn: Gemini hỗ trợ conversation history giúp tạo chatbot có trí nhớ.\n\nCode mẫu:\n```python\nchat = model.start_chat(history=[])\nresponse = chat.send_message(\"Hello\")\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-chat-session"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Rate Limits, Quotas và Best Practices khi dùng Gemini API',
                                'content' => $this->cleanText("Lý thuyết ngắn: Hiểu quota và retry strategy giúp tránh lỗi 429 Too Many Requests trong production.\n\nCode mẫu:\n```python\nimport time\nif response.prompt_feedback.block_reason:\n    time.sleep(2)\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-rate-limit-best-practices"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 2 ====================
                    [
                        'title'    => 'Chương 2: Xây dựng Chatbot và Text-based AI Applications',
                        'order'    => 2,
                        'is_free'  => false,
                        'price'    => 179000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Xây dựng AI Chatbot với Stream Response',
                                'content' => $this->cleanText("Lý thuyết ngắn: Stream response giúp giao diện mượt mà như ChatGPT.\n\nCode mẫu:\n```python\nfor chunk in model.generate_content(..., stream=True):\n    print(chunk.text)\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-stream-chatbot"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Function Calling và Tool Use trong Gemini 2.0',
                                'content' => $this->cleanText("Lý thuyết ngắn: Function calling cho phép Gemini gọi API bên ngoài (weather, database, payment...).\n\nCode mẫu:\n```python\ntools = [{'type': 'function', 'function': {...}}]\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-function-calling"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'RAG (Retrieval-Augmented Generation) với Gemini',
                                'content' => $this->cleanText("Lý thuyết ngắn: Kết hợp Gemini với vector database để chatbot trả lời dựa trên tài liệu riêng.\n\nCode mẫu:\n```python\n# Sử dụng Chroma + Gemini embeddings\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-rag-implementation"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Multi-turn Conversation với Memory và Context Window',
                                'content' => $this->cleanText("Lý thuyết ngắn: Quản lý context window 1M tokens của Gemini 2.0 Pro.\n\nCode mẫu:\n```python\nchat.history.append({\"role\": \"user\", \"parts\": [...]}) \n```\n\nVideo minh họa: https://youtube.com/embed/gemini-multi-turn-memory"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Xây dựng AI Customer Support Bot tích hợp Laravel',
                                'content' => $this->cleanText("Lý thuyết ngắn: Kết nối Gemini API qua Laravel controller và Inertia.js frontend.\n\nCode mẫu:\n```php\npublic function askGemini(Request \$request)\n{\n    \$response = Gemini::generateContent(\$request->question);\n}\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-laravel-chatbot"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 3 ====================
                    [
                        'title'    => 'Chương 3: Multimodal AI - Xử lý Hình ảnh, Video và Audio',
                        'order'    => 3,
                        'is_free'  => false,
                        'price'    => 259000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Image Understanding và Vision Capabilities của Gemini',
                                'content' => $this->cleanText("Lý thuyết ngắn: Gemini 2.0 có khả năng phân tích hình ảnh chi tiết và trả lời câu hỏi về ảnh.\n\nCode mẫu:\n```python\nresponse = model.generate_content([\"Mô tả bức ảnh này\", Image.open('photo.jpg')])\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-image-understanding"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Image Generation và Editing với Gemini 2.0',
                                'content' => $this->cleanText("Lý thuyết ngắn: Sử dụng Imagen 3 tích hợp trong Gemini để sinh và chỉnh sửa hình ảnh.\n\nCode mẫu:\n```python\nimage = model.generate_content(\"A futuristic city at night\")\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-image-generation"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Video Analysis và Frame-by-Frame Understanding',
                                'content' => $this->cleanText("Lý thuyết ngắn: Gemini 2.0 Pro hỗ trợ upload video và phân tích nội dung theo từng khung hình.\n\nCode mẫu:\n```python\nvideo_file = genai.upload_file('demo.mp4')\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-video-analysis"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Multimodal Prompt Engineering Best Practices',
                                'content' => $this->cleanText("Lý thuyết ngắn: Kết hợp text + image + video trong cùng một prompt để đạt kết quả tối ưu.\n\nCode mẫu:\n```python\ncontents = [text, image, video]\n```\n\nVideo minh họa: https://youtube.com/embed/multimodal-prompt-engineering"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Xây dựng AI Image Analyzer Web App với Laravel + Vue',
                                'content' => $this->cleanText("Lý thuyết ngắn: Upload ảnh từ frontend Vue 3 và xử lý bằng Gemini API backend.\n\nCode mẫu:\n```php\n\$response = Gemini::analyzeImage(\$request->file('image'));\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-image-analyzer-laravel-vue"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 4 ====================
                    [
                        'title'    => 'Chương 4: Xây dựng AI Agents và Tích hợp Tools',
                        'order'    => 4,
                        'is_free'  => false,
                        'price'    => 319000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Xây dựng AI Agent với Gemini Function Calling',
                                'content' => $this->cleanText("Lý thuyết ngắn: Agent có khả năng tự quyết định gọi tool nào để hoàn thành nhiệm vụ.\n\nCode mẫu:\n```python\nagent = Agent(model=gemini, tools=[search_tool, calculator_tool])\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-ai-agent-function-calling"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'Multi-Agent System với CrewAI + Gemini',
                                'content' => $this->cleanText("Lý thuyết ngắn: CrewAI giúp tạo đội ngũ agent chuyên trách (researcher, writer, reviewer...).\n\nCode mẫu:\n```python\ncrew = Crew(agents=[researcher, writer], tasks=[task1, task2])\n```\n\nVideo minh họa: https://youtube.com/embed/crewai-multi-agent-gemini"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Tích hợp Gemini với External APIs (Database, Payment, Email)',
                                'content' => $this->cleanText("Lý thuyết ngắn: Agent có thể gọi Laravel API, gửi email, hoặc truy vấn database.\n\nCode mẫu:\n```python\ndef get_user_data(user_id): ...\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-external-api-integration"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'ReAct Prompting và Reasoning Chain trong Gemini',
                                'content' => $this->cleanText("Lý thuyết ngắn: ReAct (Reason + Act) giúp agent suy nghĩ logic trước khi hành động.\n\nCode mẫu:\n```python\nThought: Tôi cần tìm thông tin...\nAction: search_tool\n```\n\nVideo minh họa: https://youtube.com/embed/react-prompting-gemini"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Xây dựng AI Research Assistant thực tế',
                                'content' => $this->cleanText("Lý thuyết ngắn: Agent tự động nghiên cứu, tổng hợp và báo cáo theo yêu cầu người dùng.\n\nCode mẫu:\n```python\ntask = Task(description=\"Nghiên cứu về Laravel 11\", agent=researcher)\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-ai-research-assistant"),
                                'order'   => 5
                            ],
                        ],
                    ],
                    // ==================== CHAPTER 5 ====================
                    [
                        'title'    => 'Chương 5: Triển khai Production, Security và Tối ưu',
                        'order'    => 5,
                        'is_free'  => false,
                        'price'    => 399000,
                        'status'   => 1,
                        'lessons'  => [
                            [
                                'title'   => 'Deploy Gemini AI App với Laravel + Docker + Fly.io',
                                'content' => $this->cleanText("Lý thuyết ngắn: Triển khai full-stack AI application lên cloud với zero-downtime.\n\nCode mẫu:\n```bash\nfly deploy\n```\n\nVideo minh họa: https://youtube.com/embed/deploy-gemini-laravel-docker"),
                                'order'   => 1
                            ],
                            [
                                'title'   => 'API Key Security, Rate Limiting và Cost Control',
                                'content' => $this->cleanText("Lý thuyết ngắn: Bảo vệ API key và giới hạn chi phí khi dùng Gemini trong production.\n\nCode mẫu:\n```php\nGemini::setApiKey(env('GEMINI_API_KEY'));\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-security-cost-control"),
                                'order'   => 2
                            ],
                            [
                                'title'   => 'Caching Gemini Responses và Token Optimization',
                                'content' => $this->cleanText("Lý thuyết ngắn: Cache response để giảm chi phí và tăng tốc độ ứng dụng.\n\nCode mẫu:\n```php\nCache::remember('gemini:'.\$key, 3600, fn() => \$response);\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-caching-token-optimization"),
                                'order'   => 3
                            ],
                            [
                                'title'   => 'Monitoring, Logging và Error Handling cho Gemini API',
                                'content' => $this->cleanText("Lý thuyết ngắn: Giám sát usage và log lỗi để duy trì độ ổn định của AI service.\n\nCode mẫu:\n```php\nLog::info('Gemini usage', ['tokens' => \$response->usageMetadata]);\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-monitoring-logging"),
                                'order'   => 4
                            ],
                            [
                                'title'   => 'Tương lai của Gemini API và Best Practices 2026',
                                'content' => $this->cleanText("Lý thuyết ngắn: Cập nhật các tính năng mới nhất và cách xây dựng AI application bền vững.\n\nCode mẫu:\n```python\n# Sử dụng Gemini 2.5 Pro khi ra mắt\n```\n\nVideo minh họa: https://youtube.com/embed/gemini-future-best-practices-2026"),
                                'order'   => 5
                            ],
                        ],
                    ],
                ],
            ]
        ];

        DB::transaction(function () use ($data) {
            foreach ($data as $courseData) {

                // 1. Tạo Course
                $course = Course::create([
                    'title'       => $courseData['title'],
                    'slug'        => Str::slug($courseData['title']),
                    'description' => $courseData['description'],
                    'status'      => $courseData['status'],
                    'thumbnail'   => $courseData['thumbnail'] ?? null,
                    'price'       => $courseData['price'] ?? 0,
                    'created_at'  => $courseData['created_at'],
                ]);

                // 2. Chapters
                foreach ($courseData['chapters'] as $chapterData) {

                    $chapter = $course->chapters()->create([
                        'title'   => $chapterData['title'],
                        'order'   => $chapterData['order'],
                        'is_free' => $chapterData['is_free'],
                        'price'   => $chapterData['price'],
                        'status'  => $chapterData['status'],
                    ]);

                    // 3. Lessons
                    foreach ($chapterData['lessons'] as $lessonData) {

                        $chapter->lessons()->create([
                            'title'   => $lessonData['title'],
                            'content' => $this->cleanText($lessonData['content']),
                            'order'   => $lessonData['order'],
                            'score_requirement' => 70, // mặc định 70 điểm để qua bài
                        ]);
                    }
                }
            }
        });
    }

    private function cleanText($text)
    {
        if (!$text) return $text;

        // 1. normalize newline
        $text = str_replace(["\r\n", "\r"], "\n", $text);

        $text = htmlspecialchars_decode($text, ENT_QUOTES);
        // 2. remove control characters (trừ newline & tab)
        $text = preg_replace('/[^\P{C}\n\t]/u', '', $text);

        // 3. fix encoding mạnh hơn
        if (!mb_check_encoding($text, 'UTF-8')) {
            $text = mb_convert_encoding($text, 'UTF-8', 'auto');
        }

        // 4. đảm bảo JSON encode được
        $text = iconv('UTF-8', 'UTF-8//IGNORE', $text);

        // 5. trim
        return trim($text);
    }
}
