<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import { RouterLink, useRouter  } from 'vue-router'

const router = useRouter();

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

fetchUserData()

const logout = async () => {
	try {
		await axios.post('http://localhost/api/logout', {}, {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})
		router.push({ name: 'login' })
	} catch (error) {
		console.error('ログアウト失敗:', error)
	}
}
</script>

<template>
	<main>
		Home.vueです。
		<button type="submit" @click="logout" class="w-full py-2 px-4 rounded-md shadow text-white bg-sky-700 transition-all duration-300">ログアウト</button>
	</main>
</template>
