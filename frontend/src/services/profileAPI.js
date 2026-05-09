import api from '../api/axios.js'

export const getProfileAPI = () => {
  return api.get('/profile')
}

export const updateProfileAPI = (payload) => {
  return api.put('/profile', payload)
}