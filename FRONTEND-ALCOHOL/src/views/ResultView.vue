<script setup lang="ts">
import { onMounted } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useQuestionsStore } from '@/stores/questions'
import Header from '@/components/Header.vue'

const use_questions_store = useQuestionsStore()

const resultData = use_questions_store.resultData;
console.log('resultData:だよ！！', resultData);

</script>

<template>
	<Header />
	<section class="text-gray-600 body-font">
		<div class="container mx-auto flex px-5 pt-12 items-center justify-center flex-col" v-if="resultData">
			<div class="text-center lg:w-1/2 w-full">
				<h1 class="title-font sm:text-2xl text-2xl mb-4 font-medium text-gray-800">あなたへのおすすめのお酒は</h1>
				<h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">{{ resultData?.name }}</h1>
				<p class="mb-8 mt-8 leading-relaxed text-xl">{{ resultData?.description }}</p>
				<div class="w-full">
					<img class="mt-16 object-cover object-center rounded mx-auto" alt="お酒の画像" :src="resultData?.image" width="500px" height="500px" />
				</div>
			</div>
		</div>
		<div class="flex justify-center mt-8">
			<RouterLink to="/home">
				<button class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">ホームへ</button>
			</RouterLink>
		</div>
	</section>
</template>