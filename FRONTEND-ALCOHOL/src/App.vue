<script setup>
import { ref } from 'vue'
import axios from 'axios'

const email = ref('')
const password = ref('')
const errorMessage = ref('')

const handleLogin = async () => {
	try {
		// CSRF Cookieの取得
		await axios.get('http://localhost/sanctum/csrf-cookie', { withCredentials: true })

		const response = await axios.post('http://localhost/login', {
			email: email.value,
			password: password.value
		}, {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})

		console.log('ログイン成功:', response.data)
		errorMessage.value = ''
		// ここでrouterで遷移してもOK
	} catch (error) {
		console.error('ログイン失敗:', error)
		errorMessage.value = 'ログインに失敗しました'
	}
}
//認証済みならユーザーデータを取得
const fetchUserData = async () => {
	try {
		const res = await axios.get('http://localhost/api/user', {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})
		console.log('ユーザーデータ:', res.data)
	} catch (error) {
		console.error('ユーザーデータ取得失敗:', error)
	}
}

</script>

<template>
	<div class="login-form">
		<h2>ログイン</h2>
		<form @submit.prevent="handleLogin">
			<div>
				<label for="email">メールアドレス:</label>
				<input type="email" id="email" v-model="email" required />
			</div>
			<div>
				<label for="password">パスワード:</label>
				<input type="password" id="password" v-model="password" required />
			</div>
			<button type="submit">ログイン</button>
		</form>
		<p v-if="errorMessage" style="color:red;">{{ errorMessage }}</p>
		<button type="" @click="fetchUserData">ユーザー取得</button>
	</div>
</template>



<style scoped></style>