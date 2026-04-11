import { defineStore } from "pinia";
import { reactive, ref } from "vue";

export const useUserStore = defineStore("user", () => {
  // State
  const users = ref([]);
  const loading = ref(false);

  // Modal state
  const showModal = ref(false);
  const editingUser = ref(null);

  // Form
  const userForm = reactive({
    name: "",
    email: "",
    phone: "",
    role: "user",
    password: "",
  });

  // ===== Actions =====

  const openAddModal = () => {
    editingUser.value = null;
    resetForm();
    showModal.value = true;
  };

  const openEditModal = (user) => {
    editingUser.value = user;
    userForm.name = user.name;
    userForm.email = user.email;
    userForm.phone = user.phone;
    userForm.role = user.role;
    userForm.password = "";
    showModal.value = true;
  };

  const closeModal = () => {
    showModal.value = false;
  };

  const resetForm = () => {
    userForm.name = "";
    userForm.email = "";
    userForm.phone = "";
    userForm.role = "user";
    userForm.password = "";
  };

  const submitUser = async () => {
    loading.value = true;
    try {
      if (editingUser.value) {
        // UPDATE
        console.log("Update", userForm);
      } else {
        // CREATE
        console.log("Create", userForm);
      }
      closeModal();
    } finally {
      loading.value = false;
    }
  };

  return {
    users,
    loading,
    showModal,
    editingUser,
    userForm,

    openAddModal,
    openEditModal,
    closeModal,
    submitUser,
  };
});