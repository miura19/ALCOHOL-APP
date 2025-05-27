<script setup lang="ts">
import { onMounted } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useAuthUserStore } from '@/stores/authUser'

const auth_user_data_store = useAuthUserStore()

onMounted(() => {
	auth_user_data_store.fetchAuthUserData()
	auth_user_data_store.fetchAllUserData()
})

const router = useRouter();

const logout = async () => {
    try {
        await auth_user_data_store.logout()
        router.push({ name: 'login' })
    } catch (error) {
        alert('ログアウトに失敗しました。再度お試しください。')
        console.error('Logout error:', error)
    }
}
</script>

<template>
	<header class="text-gray-600 body-font">
		<div class="container mx-auto flex items-center justify-between p-5 flex-col md:flex-row">
			<div class="flex title-font font-medium items-center text-gray-900">
				<RouterLink to="/home">
					<div class="ml-3 text-xl">ALCOLE-RECOMMENDATION</div>
				</RouterLink>
			</div>
			<div class="flex items-center space-x-6">
				<div v-if="auth_user_data_store.user">
					<div class="font-medium text-gray-900 text-xl">{{ auth_user_data_store.user.name }}</div>
				</div>
				<button type="submit" @click="logout"
					class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">ログアウト</button>
			</div>
		</div>
	</header>
</template>
