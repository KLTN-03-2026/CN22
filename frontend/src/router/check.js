import api from './api'

export async function requireStudent(to, from, next) {
    const token = localStorage.getItem('token')

    if (!token) return next('/signin')

    try {
        const res = await api.get('/me')
        const user = res.data

        if (user.role !== 'student') {
            return next('/')
        }

        next()
    } catch (e) {
        localStorage.removeItem('token')
        next('/signin')
    }
}


export async function requireAdmin(to, from, next) {
    const token = localStorage.getItem('token')

    if(!token) return next('/signin')
}