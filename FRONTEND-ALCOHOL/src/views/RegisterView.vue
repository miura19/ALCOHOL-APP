<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import { RouterLink, useRouter  } from 'vue-router'

const router = useRouter();

const name = ref<string>("");
const email = ref('')
const password = ref('')
const password_confirm = ref('')
const errorMessage = ref('')

const register = async () => {
	try {
		// CSRF Cookieの取得
		await axios.get('http://localhost/sanctum/csrf-cookie', { withCredentials: true })

		const response = await axios.post('http://localhost/api/register', {
			name: name.value,
			email: email.value,
			password: password.value,
			password_confirmation: password_confirm.value
		}, {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})

		console.log('登録成功:', response.data)
		errorMessage.value = ''
		router.push({ name:'home'});
	} catch (error) {
		console.error('登録失敗:', error)
		errorMessage.value = '登録に失敗しました'
	}
}
</script>

<template>
	<main>
		<div class="bg-gray-100 min-h-screen flex items-center justify-center">
			<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl">
				<h2 class="text-2xl font-bold mb-6 text-center text-gray-800">ユーザー登録</h2>
				<form action="#" method="POST" @submit.prevent="register">
					<div class="mb-4">
						<label for="text" class="block text-sm font-medium text-gray-700">名前</label>
						<input v-model="name" type="text" id="text" name="text" placeholder="田中太郎" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
					</div>
					<div class="mb-4">
						<label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
						<input v-model="email" type="email" id="email" name="email" placeholder="your@example.com" autocomplete="username" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
					</div>
					<div class="mb-6 relative">
						<label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
						<div class="relative">
							<input v-model="password" type="password" minlength="8" maxlength="16" id="password" name="password" placeholder="••••••••" autocomplete="current-password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
						</div>
					</div>
					<div class="mb-6 relative">
						<label for="password_confirm" class="block text-sm font-medium text-gray-700">パスワード確認</label>
						<div class="relative">
							<input v-model="password_confirm" type="password" minlength="8" maxlength="16" id="password_confirm" name="password_confirm" autocomplete="current-password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
						</div>
					</div>
					<button type="submit" class="w-full text-white py-2 px-4 rounded-md shadow bg-sky-700 transition-all duration-300">登録</button>
				</form>
				<p v-if="errorMessage" style="color:red;">{{ errorMessage }}</p>
				<p class="mt-4 text-cyan-800 underline"><RouterLink to="/login">登録済みの方はこちらからログイン</RouterLink></p>
			</div>
		</div>
	</main>
</template>



<style scoped></style>