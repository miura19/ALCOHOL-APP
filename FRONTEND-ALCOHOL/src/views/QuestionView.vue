<script setup lang="ts">
import { onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAlcoholGenreMasterStore } from '@/stores/alcoholGenreMaster'
import { useQuestionsStore } from '@/stores/questions'
import Header from '@/components/Header.vue'

const alcohol_genre_master_store = useAlcoholGenreMasterStore()
const use_questions_store = useQuestionsStore()

const router = useRouter();
const route = useRoute();
const genreId = Number(route.query.genre);
console.log('genreId:', genreId);

onMounted(() => {
	alcohol_genre_master_store.fetchAlcoholGenreMasterDetail(genreId)
})

const choiceClickHandler = async (id: number, score: number) => {
	const finishedFlag = await use_questions_store.nextQuestion(id, score, genreId, alcohol_genre_master_store.questions.length);
	if (finishedFlag) {
		router.push({ name: 'result'})
	}
}
</script>

<template>
	<Header />
	<main>
		<section class="dark:bg-gray-100 dark:text-gray-800">
			<div class="container p-4 mx-auto space-y-4 sm:p-6">
				<div class="space-y-4">
					<h3 class="text-2xl font-bold leading-none sm:text-5xl text-center">{{ alcohol_genre_master_store.questions[use_questions_store.questionNumber]?.question_text }}</h3>
				</div>
				<div class="grid w-full grid-cols-1 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 p-8">
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							:src="alcohol_genre_master_store.genre?.image">
					</div>
				</div>
			</div>
		</section>
		<section class="text-gray-600 body-font">
			<div class="container px-5 py-4 mx-auto">
				<div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
					<div v-for="choice in alcohol_genre_master_store.questions[use_questions_store.questionNumber]?.question_choices" :key="choice.id" class="p-2 sm:w-1/2 w-full">
						<div class="bg-gray-100 rounded flex p-4 h-full items-center" @click="choiceClickHandler(alcohol_genre_master_store.questions[use_questions_store.questionNumber].id, choice.score)">
							<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
								stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
								<path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
								<path d="M22 4L12 14.01l-3-3"></path>
							</svg>
							<span class="title-font font-medium">{{ choice.choice_text }}</span>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</template>
