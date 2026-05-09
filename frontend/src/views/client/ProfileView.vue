<script setup>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// Form states
const activeTab = ref('profile')
const isLoading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

// User data (hardcoded)
const user = reactive({
  id: 1,
  name: 'Nguyễn Văn A',
  email: 'nguyena@example.com',
  phone: '0901234567',
  avatar: 'https://via.placeholder.com/150',
  bio: 'Tôi là một developer đam mê học hỏi công nghệ mới.',
  birthday: '1990-01-01',
  gender: 'male',
  address: '123 Nguyễn Huệ, Quận 1, TP.HCM'
})

// Password form
const passwordForm = reactive({
  currentPassword: '',
  newPassword: '',
  confirmPassword: ''
})

// Notification preferences
const notifications = reactive({
  email: true,
  browser: true,
  courseUpdates: true,
  practiceReminders: false
})

// Privacy settings
const privacy = reactive({
  profileVisibility: 'public',
  showEmail: false,
  showPhone: false
})

// Methods
const handleUpdateProfile = async () => {
  isLoading.value = true
  errorMessage.value = ''

  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000))

    successMessage.value = 'Cập nhật thông tin thành công!'
    setTimeout(() => {
      successMessage.value = ''
    }, 3000)
  } catch (error) {
    errorMessage.value = 'Cập nhật thất bại. Vui lòng thử lại.'
  } finally {
    isLoading.value = false
  }
}

const handleChangePassword = async () => {
  isLoading.value = true
  errorMessage.value = ''

  // Validation
  if (passwordForm.newPassword !== passwordForm.confirmPassword) {
    errorMessage.value = 'Mật khẩu mới không khớp'
    isLoading.value = false
    return
  }

  if (passwordForm.newPassword.length < 8) {
    errorMessage.value = 'Mật khẩu mới phải có ít nhất 8 ký tự'
    isLoading.value = false
    return
  }

  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000))

    successMessage.value = 'Đổi mật khẩu thành công!'
    passwordForm.currentPassword = ''
    passwordForm.newPassword = ''
    passwordForm.confirmPassword = ''

    setTimeout(() => {
      successMessage.value = ''
    }, 3000)
  } catch (error) {
    errorMessage.value = 'Đổi mật khẩu thất bại. Vui lòng thử lại.'
  } finally {
    isLoading.value = false
  }
}

const handleLogout = () => {
  if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
    // Clear localStorage/sessionStorage if needed
    localStorage.removeItem('token')
    router.push('/login')
  }
}

const handleAvatarUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      user.avatar = e.target.result
    }
    reader.readAsDataURL(file)
  }
}
</script>

<template>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Hồ sơ của tôi</h1>
      <p class="mt-2 text-gray-600">Quản lý thông tin cá nhân và cài đặt tài khoản</p>
    </div>

    <!-- Success/Error Messages -->
    <div v-if="successMessage" class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
      <div class="flex">
        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
            clip-rule="evenodd" />
        </svg>
        <p class="ml-3 text-sm text-green-800">{{ successMessage }}</p>
      </div>
    </div>

    <div v-if="errorMessage" class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
      <div class="flex">
        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
            clip-rule="evenodd" />
        </svg>
        <p class="ml-3 text-sm text-red-800">{{ errorMessage }}</p>
      </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <!-- Tabs -->
      <div class="border-b border-gray-200">
        <nav class="flex -mb-px">
          <button v-for="tab in ['profile', 'password', 'notifications', 'privacy']" :key="tab" @click="activeTab = tab"
            :class="[
              'py-4 px-6 border-b-2 font-medium text-sm',
              activeTab === tab
                ? 'border-indigo-500 text-indigo-600'
                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
            ]">
            {{ getTabName(tab) }}
          </button>
        </nav>
      </div>

      <!-- Tab Content -->
      <div class="p-6">
        <!-- Profile Tab -->
        <div v-show="activeTab === 'profile'" class="space-y-6">
          <!-- Avatar Upload -->
          <div class="flex items-center space-x-6">
            <div class="relative">
              <img :src="user.avatar" :alt="user.name" class="w-24 h-24 rounded-full object-cover" />
              <label
                class="absolute bottom-0 right-0 bg-indigo-600 text-white rounded-full p-2 cursor-pointer hover:bg-indigo-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <input type="file" @change="handleAvatarUpload" class="hidden" accept="image/*" />
              </label>
            </div>
            <div>
              <h3 class="text-lg font-medium text-gray-900">Ảnh đại diện</h3>
              <p class="text-sm text-gray-500">JPG, PNG hoặc GIF. Kích thước tối đa 5MB.</p>
            </div>
          </div>

          <!-- Form Fields -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
              <input v-model="user.name" type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input v-model="user.email" type="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
              <input v-model="user.phone" type="tel"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
              <input v-model="user.birthday" type="date"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Giới tính</label>
              <select v-model="user.gender"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
                <option value="other">Khác</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
              <input v-model="user.address" type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Giới thiệu</label>
            <textarea v-model="user.bio" rows="4"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"></textarea>
          </div>

          <div class="flex justify-end">
            <button @click="handleUpdateProfile" :disabled="isLoading"
              class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
              {{ isLoading ? 'Đang cập nhật...' : 'Lưu thay đổi' }}
            </button>
          </div>
        </div>

        <!-- Password Tab -->
        <div v-show="activeTab === 'password'" class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu hiện tại</label>
            <input v-model="passwordForm.currentPassword" type="password"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
            <input v-model="passwordForm.newPassword" type="password"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
            <p class="mt-1 text-sm text-gray-500">Mật khẩu mới phải có ít nhất 8 ký tự</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
            <input v-model="passwordForm.confirmPassword" type="password"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
          </div>

          <div class="flex justify-end">
            <button @click="handleChangePassword" :disabled="isLoading"
              class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
              {{ isLoading ? 'Đang cập nhật...' : 'Đổi mật khẩu' }}
            </button>
          </div>
        </div>

        <!-- Notifications Tab -->
        <div v-show="activeTab === 'notifications'" class="space-y-6">
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-gray-900">Email notifications</h3>
                <p class="text-sm text-gray-500">Nhận thông báo qua email</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input v-model="notifications.email" type="checkbox" class="sr-only peer" />
                <div
                  class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                </div>
              </label>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-gray-900">Browser notifications</h3>
                <p class="text-sm text-gray-500">Nhận thông báo trên trình duyệt</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input v-model="notifications.browser" type="checkbox" class="sr-only peer" />
                <div
                  class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                </div>
              </label>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-gray-900">Cập nhật khóa học</h3>
                <p class="text-sm text-gray-500">Thông báo khi có bài mới</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input v-model="notifications.courseUpdates" type="checkbox" class="sr-only peer" />
                <div
                  class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                </div>
              </label>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-gray-900">Nhắc nhở luyện tập</h3>
                <p class="text-sm text-gray-500">Nhắc nhở hàng ngày</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input v-model="notifications.practiceReminders" type="checkbox" class="sr-only peer" />
                <div
                  class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                </div>
              </label>
            </div>
          </div>

          <div class="flex justify-end">
            <button @click="handleUpdateProfile" :disabled="isLoading"
              class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
              {{ isLoading ? 'Đang cập nhật...' : 'Lưu cài đặt' }}
            </button>
          </div>
        </div>

        <!-- Privacy Tab -->
        <div v-show="activeTab === 'privacy'" class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Hiển hồ sơ</label>
            <select v-model="privacy.profileVisibility"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
              <option value="public">Công khai</option>
              <option value="private">Riêng tư</option>
              <option value="friends">Chỉ bạn bè</option>
            </select>
          </div>

          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-gray-900">Hiển thị email</h3>
                <p class="text-sm text-gray-500">Cho người khác thấy email của bạn</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input v-model="privacy.showEmail" type="checkbox" class="sr-only peer" />
                <div
                  class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                </div>
              </label>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-gray-900">Hiển thị số điện thoại</h3>
                <p class="text-sm text-gray-500">Cho người khác thấy số điện thoại của bạn</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input v-model="privacy.showPhone" type="checkbox" class="sr-only peer" />
                <div
                  class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                </div>
              </label>
            </div>
          </div>

          <div class="pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-red-600 mb-4">Xóa tài khoản</h3>
            <p class="text-sm text-gray-600 mb-4">Khi bạn xóa tài khoản, tất cả dữ liệu của bạn sẽ bị xóa vĩnh viễn và
              không thể khôi phục.</p>
            <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
              Xóa tài khoản
            </button>
          </div>

          <div class="flex justify-end">
            <button @click="handleUpdateProfile" :disabled="isLoading"
              class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
              {{ isLoading ? 'Đang cập nhật...' : 'Lưu cài đặt' }}
            </button>
          </div>
        </div>
      </div>

      <!-- Logout Button -->
      <div class="border-t border-gray-200 p-6">
        <button @click="handleLogout"
          class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
          Đăng xuất
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    getTabName(tab) {
      const names = {
        profile: 'Thông tin cá nhân',
        password: 'Đổi mật khẩu',
        notifications: 'Thông báo',
        privacy: 'Quyền riêng tư'
      }
      return names[tab] || tab
    }
  }
}
</script>