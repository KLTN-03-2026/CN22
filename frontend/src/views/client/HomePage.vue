<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section
            class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-blue-600 to-teal-500 py-20 px-4 md:py-32">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative mx-auto max-w-6xl text-center">
                <h1 class="mb-6 text-4xl font-bold text-white md:text-5xl lg:text-6xl">
                    Learn Programming Smarter
                </h1>
                <p class="mb-8 text-lg text-white/90 md:text-xl">
                    Nâng cao kỹ năng lập trình với lộ trình học tập cá nhân hóa và hàng trăm bài tập thực tế
                </p>
                <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
                    <button
                        class="rounded-lg bg-white px-8 py-3 font-semibold text-blue-600 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        Bắt đầu học
                    </button>
                    <button
                        class="rounded-lg border-2 border-white px-8 py-3 font-semibold text-white transition-all duration-300 hover:bg-white hover:text-blue-600">
                        Xem khóa học
                    </button>
                </div>
            </div>
        </section>

        <!-- Continue Learning Section -->
        <section v-if="continueLearningCourses.length > 0" class="py-12 px-4">
            <div class="mx-auto max-w-6xl">
                <h2 class="mb-6 text-2xl font-bold text-gray-800">Tiếp tục học</h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <CardCourse v-for="course in continueLearningCourses" :key="course.id" :title="course.title"
                        :subtitle="course.subtitle" :chapters="course.chapters" :items="course.items"
                        :progress="course.progress" :show-continue-button="true" @card-click="handleCourseClick"
                        @continue-click="handleContinueClick" />
                </div>
            </div>
        </section>

        <!-- Filter Tabs -->
        <section class="py-6 px-4">
            <div class="mx-auto max-w-6xl">
                <div class="flex flex-wrap gap-2 border-b border-gray-200 pb-2">
                    <button v-for="filter in filters" :key="filter.value"
                        class="rounded-t-lg px-4 py-2 font-medium transition-colors duration-200" :class="[
                            activeFilter === filter.value
                                ? 'border-b-2 border-blue-500 text-blue-600'
                                : 'text-gray-600 hover:text-gray-800'
                        ]" @click="setActiveFilter(filter.value)">
                        {{ filter.label }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Courses Section -->
        <section class="pb-16 px-4">
            <div class="mx-auto max-w-6xl">
                <h2 class="mb-6 text-2xl font-bold text-gray-800">Tất cả khóa học</h2>
                <div v-if="filteredCourses.length > 0"
                    class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <CardCourse v-for="course in filteredCourses" :key="course.id" :title="course.title"
                        :subtitle="course.subtitle" :chapters="course.chapters" :items="course.items"
                        :progress="course.progress" :show-continue-button="false" @card-click="handleCourseClick" />
                </div>
                <div v-else class="py-12 text-center text-gray-500">
                    <p class="text-lg">Không tìm thấy khóa học phù hợp với bộ lọc đã chọn.</p>
                </div>
            </div>
        </section>


        <!-- CTA Section -->
        <section class="bg-gradient-to-r from-indigo-600 to-teal-500 py-16 px-4">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl">
                    Bắt đầu hành trình học ngay hôm nay
                </h2>
                <p class="mb-8 text-lg text-white/90">
                    Tham gia cộng đồng hàng ngàn lập trình viên và nâng cao kỹ năng của bạn
                </p>
                <router-link to="/signup">
                    <button
                        class="rounded-lg bg-white px-8 py-3 font-semibold text-blue-600 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        Bắt đầu miễn phí
                    </button>
                </router-link>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-16 px-4">
            <div class="mx-auto max-w-3xl">
                <h2 class="mb-8 text-center text-3xl font-bold text-gray-900">Câu hỏi thường gặp</h2>

                <div class="space-y-4">
                    <div v-for="(faq, index) in faqs" :key="index"
                        class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                        <button @click="toggleFaq(index)"
                            class="flex w-full items-center justify-between p-5 text-left transition-colors duration-200 hover:bg-gray-50">
                            <h3 class="font-semibold text-gray-900">{{ faq.question }}</h3>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-500 transition-transform duration-200"
                                :class="{ 'rotate-180': faq.isOpen }" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="overflow-hidden transition-all duration-300"
                            :style="{ maxHeight: faq.isOpen ? '200px' : '0' }">
                            <div class="px-5 pb-5 text-gray-600">
                                {{ faq.answer }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import CardCourse from '../../components/CardCourse.vue';

// State for filters
const activeFilter = ref('all');
const filters = [
    { label: 'Tất cả', value: 'all' },
    { label: 'Dễ', value: 'easy' },
    { label: 'Trung bình', value: 'medium' },
    { label: 'Khó', value: 'hard' }
];

// State for courses
const courses = ref([]);
const continueLearningCourses = ref([]);

// State for register form
const email = ref('');
const emailError = ref('');
const registerMessage = ref('');
const registerSuccess = ref(false);

// State for FAQ
const faqs = reactive([
    {
        question: 'Làm thế nào để bắt đầu học?',
        answer: 'Bạn có thể bắt đầu bằng cách đăng ký tài khoản miễn phí và chọn khóa học phù hợp với trình độ của mình. Mỗi khóa học có lộ trình rõ ràng và các bài tập thực hành.',
        isOpen: false
    },
    {
        question: 'Tôi có thể học trên nhiều thiết bị không?',
        answer: 'Có, nền tảng của chúng tôi hỗ trợ học trên nhiều thiết bị khác nhau bao gồm máy tính, máy tính bảng và điện thoại di động. Tiến độ học của bạn sẽ được đồng bộ trên tất cả các thiết bị.',
        isOpen: false
    },
    {
        question: 'Khóa học có phù hợp với người mới bắt đầu không?',
        answer: 'Chúng tôi có các khóa học dành cho mọi trình độ, từ người mới bắt đầu đến lập trình viên có kinh nghiệm. Bạn có thể làm bài kiểm tra đầu vào để xác định trình độ và nhận lộ trình học phù hợp.',
        isOpen: false
    }
]);

// Computed property for filtered courses
const filteredCourses = computed(() => {
    if (activeFilter.value === 'all') {
        return courses.value;
    }
    return courses.value.filter(course => course.difficulty === activeFilter.value);
});

// Methods
const setActiveFilter = (filter) => {
    activeFilter.value = filter;
};

const handleCourseClick = (courseId) => {
    console.log('Course clicked:', courseId);
    // Future router integration:
    // router.push(`/courses/${courseId}`);
};

const handleContinueClick = (courseId) => {
    console.log('Continue clicked:', courseId);
    // Future router integration:
    // router.push(`/courses/${courseId}/learn`);
};

const validateEmail = (email) => {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
};

const handleRegister = () => {
    // Reset previous messages
    emailError.value = '';
    registerMessage.value = '';

    // Validate email
    if (!email.value) {
        emailError.value = 'Vui lòng nhập email của bạn';
        return;
    }

    if (!validateEmail(email.value)) {
        emailError.value = 'Email không hợp lệ';
        return;
    }

    // Simulate API call
    setTimeout(() => {
        registerSuccess.value = true;
        registerMessage.value = 'Đăng ký thành công! Chúng tôi sẽ gửi thông tin đến email của bạn.';
        email.value = '';
    }, 1000);
};

const toggleFaq = (index) => {
    faqs[index].isOpen = !faqs[index].isOpen;
};

// Mock data fetching (simulating API call)
const fetchCourses = async () => {
    // Simulating API delay
    await new Promise(resolve => setTimeout(resolve, 500));

    // Mock courses data
    courses.value = [
        {
            id: 1,
            title: "Recursion I",
            subtitle: "Introduction to Algorithms",
            chapters: 5,
            items: 24,
            progress: 0,
            difficulty: "easy"
        },
        {
            id: 2,
            title: "Dynamic Programming",
            subtitle: "Advanced Problem Solving",
            chapters: 8,
            items: 42,
            progress: 0,
            difficulty: "medium"
        },
        {
            id: 3,
            title: "Graph Theory",
            subtitle: "Network Algorithms",
            chapters: 6,
            items: 31,
            progress: 0,
            difficulty: "hard"
        },
        {
            id: 4,
            title: "Binary Search",
            subtitle: "Search Algorithms",
            chapters: 4,
            items: 18,
            progress: 0,
            difficulty: "easy"
        },
        {
            id: 5,
            title: "Tree Traversal",
            subtitle: "Data Structures",
            chapters: 7,
            items: 35,
            progress: 0,
            difficulty: "medium"
        },
        {
            id: 6,
            title: "Greedy Algorithms",
            subtitle: "Optimization Techniques",
            chapters: 5,
            items: 28,
            progress: 70,
            difficulty: "hard"
        },
        {
            id: 7,
            title: "Array Manipulation",
            subtitle: "Basic Data Structures",
            chapters: 3,
            items: 15,
            progress: 0,
            difficulty: "easy"
        },
        {
            id: 8,
            title: "Backtracking",
            subtitle: "Problem Solving Strategies",
            chapters: 6,
            items: 32,
            progress: 0,
            difficulty: "medium"
        }
    ];

    // Mock continue learning courses (courses with progress > 0)
    continueLearningCourses.value = [
        {
            id: 9,
            title: "Sorting Algorithms",
            subtitle: "Fundamental Algorithms",
            chapters: 4,
            items: 22,
            progress: 65,
            difficulty: "easy"
        },
        {
            id: 10,
            title: "Hash Tables",
            subtitle: "Data Structures",
            chapters: 5,
            items: 27,
            progress: 40,
            difficulty: "medium"
        }
    ];
};

onMounted(() => {
    fetchCourses();
});
</script>